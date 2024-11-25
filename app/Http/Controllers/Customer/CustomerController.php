<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\School;
use Auth;
use Carbon\Carbon;
use DB;
use Session;

class CustomerController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $redirectTo = '/';

    public function __construct() {
        $this->middleware('auth:web');
    }

    public function manageProfile() {
        return view('front.manage-profile');
    }

    public function updateProfile(Request $request) {
//        dd($request->all());
        $customer = \App\Models\Customers::where('id', '=', Auth::user()->id)->first();
        $customer->fill($request->all());
        $image = 'profile_pic' . $customer->id . '.' . $request->file('picture')->getClientOriginalExtension();
        $request->file('picture')->storeAs('public/customers/', $image);
        $customer->picture = $image;
        $customer->update();
        return redirect('/manage-profile')->with('message', 'Profile Data Updated');
    }

    public function profile() {
        $latest = \App\Models\Orders::where('idUser', '=', Auth::user()->id)->latest()->first();
        if (!empty($latest)) {
            $orders = \App\Models\OrderDetails::where('idOrder', '=', $latest->id)->orderBy('id', 'desc')->limit('5')->get();
        } else {
            $orders = [];
        }

        return view('front.profile', compact('orders', 'latest'));
    }

    public function orderHistory() {
        $orders = \App\Models\Orders::where('idUser', '=', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('front.order-history', compact('orders'));
    }

    public function amcHistory() {
        $orders = \App\Models\Orders::where('idUser', '=', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('front.amc-history', compact('orders'));
    }
    
    public function addresses() {
        $addresses = customerAddreses();
        return view('front.customer-addresses', compact('addresses'));
    }

    public function addAddresses(Request $request) {
        $address = new \App\Models\CustomerAddress();
        $address->fill($request->all());
        $address->idUser = Auth::user()->id;
        $address->active = 'Y';
        $address->save();
        return redirect('addresses')->with('message', 'Address Added !!');
    }

    public function editAddress($id) {
        $addresses = customerAddreses();
        $address = \App\Models\CustomerAddress::where('id', '=', $id)->where('idUser', '=', Auth::user()->id)->first();
        return view('front.edit-customer-address', compact('addresses', 'address'));
    }

    public function updateAddress(Request $request) {
        $address = \App\Models\CustomerAddress::where('id', '=', $request->idAddress)->where('idUser', '=', Auth::user()->id)->first();
        $address->fill($request->all());
        $address->idUser = Auth::user()->id;
        $address->update();
        return redirect('addresses')->with('message', 'Address Added !!');
    }

}
