<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Carbon\Carbon;
use DB;
use App\Models\CustomerAddress;
use App\Models\OrderDetails;
use App\Models\CustomerCart;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
		//dd($request->route()->getPrefix());
		if ($request->route()->getPrefix() == "/admin-api") {
            $search = $request->input('search');
            if(isset($search)) {
                return customers::where('name','LIKE',"%{$search}%")->orWhere('description','LIKE',"%{$search}%")->paginate();
            } else {
                return customers::paginate();
            }
        } else {
            return view('admin.master.customers');
        }
        
    }

    public function fetchbrands(){
        return brands::select('id','name')->get();
    }


    public function customerSummary($id,Request $request){
        $user = Customers::find($id);
        if($user == null){
            $response = array(
                'result' => 0,
                'message' => 'User not found'
            );
            return response()->json($response);
        }

        if($request->input('page') != null){
            $orders = OrderDetails::join('customer_address','order_details.idAddress','=','customer_address.id')->join('orders','order_details.idOrder','=','orders.id')->join('products','order_details.idProduct','=','products.id')->select('name','order_details.order_date','orderNumber','qty','status','order_details.total','modelNumber','city','area','state',DB::raw('IFNULL(address_street," ") as address_street'),DB::raw('IFNULL(address_house," ") as address'),DB::raw('IFNULL(landmark," ") as landmark'),'pincode')->where('orders.idUser',$user->id)->orderBy('order_details.id','DESC')->paginate();
            $response = array(
                'order' => $orders
            );
            return response()->json($response);
        }

        $address = CustomerAddress::where('idUser',$user->id)->get();
        $cart = CustomerCart::join('products','customer_cart.idProduct','=','products.id')->select('name','modelNumber','customer_cart.id','customer_cart.updated_at','customer_cart.qty')->where('idUser',$user->id)->get();
        $orders = OrderDetails::join('customer_address','order_details.idAddress','=','customer_address.id')->join('orders','order_details.idOrder','=','orders.id')->join('products','order_details.idProduct','=','products.id')->select('name','order_details.order_date','orderNumber','qty','status','order_details.total','modelNumber','city','area','state',DB::raw('IFNULL(address_street," ") as address_street'),DB::raw('IFNULL(address_house," ") as address'),DB::raw('IFNULL(landmark," ") as landmark'),'pincode')->where('orders.idUser',$user->id)->orderBy('order_details.id','DESC')->paginate();
        $response = array(
            'details' => $user ,
            'cart' => $cart ,
            'address' => $address,
            'order' => $orders
        );
        return response()->json($response);
    }

    public function show($id)
    {
        $customers = Customers::find($id);
        return response()->json($customers);
    }

    public function update($id, Request $request)
    {
        /*$validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required',
            'manufacturer' => 'required',
        ]);
        $duplicate = Customers::where('name',$request->name)->first();
        if($duplicate != null){
            if($duplicate->id != $id)
            return response()->json([
                'message' => 'Name already exits'
            ],422);
        }
        $duplicate = Customers::where('slug',$request->slug)->first();
        if($duplicate != null){
            if($duplicate->id != $id)
            return response()->json([
                'message' => 'Slug already exits'
            ],422);
        }
        $customers = Customers::find($id);
        $customers->update($request->all());*/
        return $this->show($id);
    }
    public function destroy($id)
    {

    }
}
