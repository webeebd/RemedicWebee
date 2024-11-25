<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use PaytmWallet;
use Mail;

class CheckoutController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user_loggedin = Auth::user();
        if ($user_loggedin != null) {
            $user_addresses = \App\Models\CustomerAddress::where('idUser', '=', $user_loggedin->id)->get();
            $cart = \App\Models\Cart::where('idUser', '=', $user_loggedin->id)->get();
            return view('front.checkout', compact('user_loggedin', 'cart', 'user_addresses'));
        } else {
            return redirect('sign-in');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//        dd($request->all());
        $rules = [
            'idAddress' => 'required_without:addressline1',
            'address_house' => 'required_without:idAddress',
        ];
        $messages = [
            'idAddress.required_without' => 'Either Select Addrees or add a new One',
            'address_house.required_without' => 'Either Select Addrees or add a new One',
        ];
        $this->validate($request, $rules, $messages);
        // New Order
        if ($request->payment_mode == 'Paypal') {
            dd('In Progress');
        } elseif ($request->payment_mode == 'Card') {
            dd('In Progress');
        } elseif ($request->payment_mode == 'COD') {
            return $this->saveCODOrder($request);
        }
//        if ($request->ajax()) {
//            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function saveCODOrder($request) {
        // Add Address if address is changed during checkout
        if ($request->idAddress == null) {
            $address = new \App\Models\CustomerAddress();
            $address->fill($request->all());
            $address->idUser = Auth::user()->id;
            $address->save();
        } else {
            // find already added address
            $address = \App\Models\CustomerAddress::where('id', '=', $request->idAddress)->first();
        }
        //if payment is done through Cash
        $customer = \App\Models\Customers::where('id', '=', Auth::user()->id)->first();
        $order = new \App\Models\Orders();
        $order->fill($request->all());
        $order->idUser = Auth::user()->id;
        $order->order_date = Carbon::today();
        $order->idAddress = $address->id;
        $order->billNumber = 'REMDBILL' . rand();
        DB::beginTransaction();
        $order->save();
        $cart_items = \App\Models\Cart::where('idUser', '=', Auth::user()->id)->get();
        foreach ($cart_items as $var) {
            $product = \App\Models\Products::where('id', '=', $var['idProduct'])->first();
            // New Order Details
            $order_details = new \App\Models\OrderDetails();
            $order_details->idOrder = $order->id;
            $order_details->idProduct = $var['idProduct'];
            $order_details->qty = $var['qty'];
            $order_details->subtotal = ($var['qty'] * $product->sales_price);
            $order_details->total = ($var['qty'] * $product->sales_price);
            $order_details->unit_price = $product->sales_price;
            $order_details->order_date = Carbon::today();
            $order_details->orderNumber = 'REMD' . rand();
            $order_details->status = 'New Order';
            $order_details->idAddress = $address->id;
            $order_details->save();

            //Order Paymewnt
            $order_payment = new \App\Models\OrderPayments();
            $order_payment->idOrder = $order->id;
            $order_payment->payment_mode = 'COD';
            $order_payment->save();

            // Order AMC
            if (isset($var['amc']) && $var['amc'] == 'Y') {
                $amc = \App\Models\AmcMaster::where('id', '=', $product->amc_id)->first();
                $order_amc = new \App\Models\AmcOrders();
                $order_amc->idOrder = $order->id;
                $order_amc->idProduct = $var['idProduct'];
                $order_amc->idAmc = $product->amc_id;
                $order_amc->status = 'New Order';
                $order_amc->amcNumber = 'REMDAMC' . rand();
                $order_amc->idAddress = $address->id;
                if (!empty($amc)) {
                    if ($amc->unit == 'Year') {
                        $validity = Carbon::now()->addYear($amc->duration);
                    } else if($amc->unit == 'month'){
                        $validity = Carbon::now()->addMonth($amc->duration);
                    }else{
                        $validity = Carbon::now();
                    }
                }
                $order_amc->validity = $validity;
                $order_amc->save();
            }
        }
        DB::commit();
        // Empty the cart after Successful Order 
        $cart_data = \App\Models\Cart::where('idUser', '=', Auth::user()->id);
        $cart_data->delete();
        session::forget('cart');
        Session::save();

        return redirect('order-confirmation');
    }

    public function orderConfirmation() {
        $order = \App\Models\Orders::where('idUser', '=', Auth::user()->id)->latest()->first();
        $order_payment = \App\Models\OrderPayments::where('idOrder', '=', $order->id)->first();
        $order_details = \App\Models\OrderDetails::where('idOrder', '=', $order->id)->get();
        return view('front.order-confirmation', compact('order', 'order_details', 'order_payment'));
    }

}
