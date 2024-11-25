<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerCart;
use App\Models\CustomerAddress;
use App\Models\OrderReceipt;
use App\Models\Discounts;
use App\Models\Orders;
use App\Models\OrderPayments;
use App\Models\OrderStatus;
use App\Models\OrderDetails;
use App\Models\AmcOrders;
use Carbon\Carbon;
use Log;
use Cache;
use DB;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addAddress(Request $request) {
        if(isset($request->id)){
            $address = CustomerAddress::findOrFail($request->id);
            $address->fill($request->all());
            $address->update();
        }else {
            $address = new CustomerAddress();
            $address->fill($request->all());
            $address->idUser = Auth::guard('api')->user()->id;
            $address->active = "Y";
            $address->save();
        }
        return response()->json(['result' => 1,'message' => "Address Saved"]);
    }

    public function removeAddress($id){
        $address = CustomerAddress::findOrFail($id);
        if($address->idUser == Auth::guard('api')->user()->id){
            $address->active = "N";
            $address->update();
        }
        return response()->json(['result' => 1,'message' => "Address Removed"]);
    }

    public function fetchAddress(Request $request) {
        $address = CustomerAddress::where('idUser', '=', Auth::guard('api')->user()->id)->where('active',"Y")->paginate();
        $response = array(
            "address" => $address
        );
        return response()->json(['response' => $response]);
    }

    public function fetchProfile(Request $request){
        $user = Auth::guard('api')->user();
        $profile = array(
            'business_name' => $user->business_name,
            'mobile' => $user->mobile,
            'email' => $user->email,
            'picture' => $user->picture,
            'name' => $user->name
        );
        $response = array(
            "profile" => $profile
        );
        return response()->json(['response' => $response]);
    }

    public function updatePassword(Request $request){
        $user = Auth::guard('api')->user();
        $password = \App\Models\Customers::findOrFail($user->id);
        if($password != null){
            if(bcrypt($request->password) != $password->password){
                return response()->json(['result' => 0,'message' => "Current password is incorrect"]);
            }else{
                $password->password = bcrypt($request->newPwd);
                $password->update();
                return response()->json(['result' => 1,'message' => "Password updated"]);
            }
        }
        return response()->json(['result' => 0,'message' => "Invalid username"]);
    }

    public function addItem(Request $request){
        $request->validate([
            'idProduct' => 'required',
        ]);
        $qty = 1;
        $cart = new CustomerCart();
        if(isset($request->id))
        {
            $cart = CustomerCart::findOrFail($request->id);
            $qty = $cart->qty + 1;
        }
        else
        $cart->idProduct =  $request->idProduct;

        if(Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            $cart->idUser =  $user->id;
        }

        if(isset($request->qty))
            $cart->qty = $request->qty;
        else $cart->qty = $qty;

        if(isset($request->idAmc)){
            $cart->amc = 'Y';
            $cart->idAmc = $request->idAmc;
        }

        if(isset($request->removeAmc)){
            $cart->amc = 'N';
            $cart->idAmc = null;
        }

        if(isset($request->id)) {
            $cart->update();
            if($request->cart == 'Y')
            return $this->fetchItem($request);
        }
        else $cart->save();

        return response()->json(['result' => 1,'message' => "Cart Added", 'id' => $cart->id]); 
    }

    public function fetchItem(Request $request){
        if(Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            $cart = CustomerCart::join('products','customer_cart.idProduct','=','products.id')
            ->leftJoin('amc_master','customer_cart.idAmc','=','amc_master.id')
            ->select('products.id as idProduct','customer_cart.id as idCart','products.title','products.pic','products.stock','products.maxStock'
            ,'max_retail_price','sales_price','pre_discount','qty','name','duration','price','type','amc')
            ->where('customer_cart.idUser',$user->id)->paginate();
            return response()->json(['result' => 1,'message' => "Cart", 'records' => $cart->items()]); 
        }else{
            $request->validate([
                'idProduct' => 'required',
            ]);
            $cart = CustomerCart::join('products','customer_cart.idProduct','=','products.id')
            ->leftJoin('amc_master','customer_cart.idAmc','=','amc_master.id')
            ->select('products.id as idProduct','customer_cart.id as idCart','products.title','products.pic','products.stock','products.maxStock'
            ,'max_retail_price','sales_price','pre_discount','qty','name','duration','price','type','amc')
            ->whereIn('customer_cart.id',json_decode($request->idProduct,true))->paginate();
            return response()->json(['result' => 1,'message' => "Cart", 'records' => $cart->items()]); 
        }
    }

    public function removeItem($id,Request $request){
        if(Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            $cart = CustomerCart::findOrFail($id);
            if($cart->idUser == $user->id)
            $cart->delete();
            $cart = CustomerCart::join('products','customer_cart.idProduct','=','products.id')
            ->leftJoin('amc_master','customer_cart.idAmc','=','amc_master.id')
            ->select('products.id as idProduct','customer_cart.id as idCart','products.title','products.pic','products.stock','products.maxStock'
            ,'max_retail_price','sales_price','pre_discount','qty','name','duration','price','type','amc')
            ->where('customer_cart.idUser',$user->id)->paginate();
            return response()->json(['result' => 1,'message' => "Cart", 'records' => $cart->items()]); 
        }else{
            $cart = CustomerCart::findOrFail($id);
            if($cart->idUser == null) $cart->delete();
            $request->validate([
                'idProduct' => 'required',
            ]);
            $cart = CustomerCart::join('products','customer_cart.idProduct','=','products.id')
            ->leftJoin('amc_master','customer_cart.idAmc','=','amc_master.id')
            ->select('products.id as idProduct','customer_cart.id as idCart','products.title','products.pic','products.stock','products.maxStock'
            ,'max_retail_price','sales_price','pre_discount','qty','name','duration','price','type','amc')
            ->whereIn('customer_cart.id',json_decode($request->idProduct,true))->paginate();
            return response()->json(['result' => 1,'message' => "Cart", 'records' => $cart->items()]); 
        }
    }

    public function checkout(Request $request){
        $user = Auth::guard('api')->user();
        if(CustomerAddress::where('idUser', '=',$user->id)->where('active','Y')->count() == 0){
            return response()->json(['result' => 2,'message' => "Please add a delivery address in order to checkout in profile."]); 
        }
        $checkout = [];
        $checkout['name'] = $user->name;
        $checkout['business_name'] = $user->business_name;
        $checkout['mobile'] = $user->mobile;
        $checkout['email'] = $user->email;

        if(isset($request->coupon)){
            $coupon = Discounts::where('name',$request->coupon)->whereDate('expire_date','>',Carbon::now())->first();
            if($coupon == null){
                return response()->json(['result' => 3,'message' => "Invalid discount coupon or expired"]);
            }
        }
        $address = CustomerAddress::select('id',DB::raw('CONCAT(address_house," ",address_street," ",area," ",IFNULL(landmark,"")," ",city," ",IFNULL(state,"")," ",pincode) as address'))->where('idUser', '=',$user->id)->where('active','Y')->get();
        $checkout['address'] = $address;
        $carts = CustomerCart::join('products','customer_cart.idProduct','=','products.id')
            ->leftJoin('amc_master','customer_cart.idAmc','=','amc_master.id')
            ->select('products.id as idProduct','category_id','customer_cart.id as idCart','products.title','products.pic','products.stock','products.maxStock'
            ,'max_retail_price','sales_price','pre_discount','qty','name','duration','price','type','amc','customer_cart.idAmc','duration','unit')
            ->where('customer_cart.idUser',$user->id)->get();
        $subtotal = 0;
        $total = 0;
        $discount = 0;

        $category = [];
        foreach($carts as $cart){
            $itemMrp = $cart->qty * $cart->max_retail_price;
            $itemCost = $cart->qty * $cart->sales_price;
            if($cart->amc == 'Y'){
                $itemMrp = $itemMrp + ($cart->qty * $cart->price);
                $itemCost = $itemCost + ($cart->qty * $cart->price);
            }
            $subtotal = $subtotal + $itemMrp;
            $discount = $discount + ($itemMrp - $itemCost);
            $total = $total + $itemCost;
            array_push($category,$cart->category_id);
        }

        $additional = 0;
        if(isset($request->coupon)){
            if($coupon != null){
                if($coupon->min_amount < $total && $coupon->max_redeem != $coupon->current_redeem){
                    if($coupon->type == 'A'){
                        $additional = $coupon->total;
                        if($coupon->description != null)
                        $checkout['description'] = $coupon->description;
                    }else{
                        $additional = ($total * $coupon->total/100);
                        if($coupon->description != null)
                        $checkout['description'] = $coupon->description;
                    }  
                    
                    if($coupon->idCategory != null){
                        if (!in_array($coupon->idCategory,  $category)){
                            $additional = 0;
                            $checkout['description'] = "";
                        }
                    }
                }

                
            }
        }

        $checkout['subtotal'] = $subtotal;
        $checkout['discount'] = $discount + $additional;
        $checkout['total'] =  $total - $additional;
        if(isset($request->coupon)){
            $checkout['coupon'] = $request->coupon;
        }
        if(isset($request->mode) && isset($request->idAddress)){
            $checkout['cart'] = $carts;
            $checkout['mode'] = $request->mode;
            $checkout['idAddress'] = $request->idAddress;
            $order = new OrderReceipt();
            $order->idUser = $user->id;
            $order->amount = $checkout['total'];
            $order->orderID = "RC".time();
            $order->orderData = json_encode($checkout);
            $order->orderDate = Carbon::now()->format('Y-m-d');
            $order->save();
            if($request->mode == "online")
            $checkout['txId'] =  "ODR00".$order->id;
            else return $this->generateOrder($order->orderData);
            unset($checkout['cart']);
            unset($checkout['mode']);
            unset($checkout['idAddress']);
        }       
        
        return response()->json(['result' => 1,'message' => "Checkout",'checkout' => $checkout]);
    }


    private function generateOrder($orderJSON){
        $checkout = [];
        $user = Auth::guard('api')->user();
        $orderData = json_decode($orderJSON,true);
        $order = new Orders();
        $order->idUser = $user->id;
        $order->idAddress = $orderData['idAddress'];
        $order->discount = $orderData['discount'];
        $order->tax = 0.00;
        $order->subtotal = $orderData['subtotal'];
        $order->delivery_charges = 0.00;
        $order->cod_charges = 0.00;
        if(isset($orderData['coupon']))
        $order->discount_coupon = $orderData['coupon'];
        $order->total = $orderData['total'];
        $order->order_date = Carbon::now()->format('Y-m-d');
        $order->billNumber = "RBIL0".nextBill();
        $order->save();

        $payments = new OrderPayments();
        $payments->idOrder = $order->id;
        $payments->payment_status = "Pay On Delivery";
        $payments->payment_mode = $orderData['mode'];
        $payments->save();

        $status = new OrderStatus();
        $status->idOrder = $order->id;
        $status->status = "Order Confirmed";
        $status->save();

        $cart = [];
        foreach($orderData['cart'] as $item){
            $details = new OrderDetails();
            $details->idOrder = $order->id;
            $details->idProduct = $item['idProduct'];
            $details->idAddress = $orderData['idAddress'];
            $details->orderNumber = "ODRL00".nextOrder();
            $details->qty = $item['qty'];
            $details->unit_price = $item['sales_price'];
            $details->base_price = $item['max_retail_price'];
            $details->discount =  ($item['max_retail_price'] - $item['sales_price']) * $item['qty'];
            $details->tax = 0.00;
            $details->subtotal = $item['max_retail_price']  * $item['qty'];
            $details->order_date = Carbon::now()->format('Y-m-d');
            $details->total = $item['sales_price']  * $item['qty'];
            $details->status = "New Order";
            $details->save();
            array_push($cart,$item['idCart']);

            if($item['amc'] == 'Y'){
                $now = Carbon::now();
                $amc = new AmcOrders();
                $amc->idAmc = $item['idAmc'];
                $amc->idProduct = $item['idProduct'];
                $amc->idOrder =  $order->id;
                $amc->idAddress = $orderData['idAddress'];
                $amc->amount = $item['price'];
                $amc->qty = $item['qty'];
                $amc->amcNumber = "RAM00".nextAmc();
                $amc->status = "New Order";
                if($item['unit'] == "Year"){
                    $now->addYears($item['duration']);
                    $amc->validity = $now->format('Y-m-d');
                }else if($item['unit'] == "Months"){
                    $now->addMonth($item['duration']);
                    $amc->validity = $now->format('Y-m-d');
                }else{
                    $now->addDays($item['duration']);
                    $amc->validity = $now->format('Y-m-d');
                }                
                $amc->save();
            }
        }

        CustomerCart::whereIn('id',$cart)->where('idUser',$user->id)->delete();
        return response()->json(['result' => 4,'message' => "Checkout",'orderNo' => $order->billNumber,'amount' => $orderData['total']]);
    }


    public function fetchOrders(Request $request){
        $user = Auth::guard('api')->user();
        $order = OrderDetails::join('customer_address','order_details.idAddress','=','customer_address.id')
        ->leftJoin('products','order_details.idProduct','=','products.id')
        ->select('order_details.id',DB::raw('CONCAT(address_house," ",address_street," ",area," ",IFNULL(landmark,"")," ",city," ",IFNULL(state,"")," ",pincode) as address'),'title','pic','qty','order_date','status','total','orderNumber')
        ->where('idUser',$user->id)->paginate();
        return response()->json(['result' => 1,'message' => "Order",'orders' => $order->items()]);
    }

    public function orderDetails(Request $request){
        $user = Auth::guard('api')->user();
        $order = OrderDetails::join('customer_address','order_details.idAddress','=','customer_address.id')
        ->leftJoin('products','order_details.idProduct','=','products.id')
        ->select('order_details.id',DB::raw('CONCAT(address_house," ",address_street," ",area," ",IFNULL(landmark,"")," ",city," ",IFNULL(state,"")," ",pincode) as address'),'title','pic','qty','order_date','status','total','orderNumber')
        ->where('idUser',$user->id)->where('order_details.id',$request->id)->first();

        if($order == null){
            return response()->json(['result' => 1,'message' => "Order Details not found"]);
        }

        $shipping = OrderDetails::select('shipment_detail','shipment_partner','shipment_link','ship_date','idOrder')->where('order_details.id',$request->id)->first();
        $bill = Orders::select('total','order_date','discount_coupon','discount')->where('idUser',$user->id)->where('id',$shipping->idOrder)->first();
        $billItems =  OrderDetails::leftJoin('products','order_details.idProduct','=','products.id')
        ->select('order_details.id','title','pic','qty')->where('order_details.idOrder',$shipping->idOrder)->get();
        unset($shipping->idOrder);
        return response()->json(['result' => 1,'message' => "Order Details",'order-details' => $order,'order-bill' => $bill , 'shipping' => $shipping, 'billItems' => $billItems]);
    }

    public function cancelOrder($id,Request $request){
        $user = Auth::guard('api')->user();
        $isUpdated = OrderDetails::join('customer_address','order_details.idAddress','=','customer_address.id')
        ->where('idUser',$user->id)->where('order_details.id',$id)->update(['status' => 'Cancelled']);
        if($isUpdated){
            AmcOrders::where('idOrder',$id)->update(['status' => 'Cancelled']);
        }
        return response()->json(['result' => 2,'message' => "Order Cancelled", "position" => $request->get('page')]);
    }
}


