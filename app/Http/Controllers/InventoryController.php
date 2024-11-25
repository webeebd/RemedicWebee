<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\OrderDetails;
use App\Models\Permissions;
use App\Models\ProductsWarehouse;
use App\Models\RolePermissions;
use Carbon\Carbon;
use Auth;
use DB;
use Session;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
		if ($request->route()->getPrefix() == "/admin-api"){
            $search = $request->input('search');
            if(isset($search)) {
                return Products::select('pic','products.active','products.id','products.title','stock',DB::raw('(SELECT SUM(qty) FROM order_details where order_details.idProduct = products.id) as sold'),DB::raw('(SELECT qty FROM order_details where order_details.idProduct = products.id order by id DESC LIMIT 1) as last_sold'))->where('title','LIKE',"%{$search}%")->paginate();
            } else {
                return Products::select('pic','products.active','products.id','products.title','stock',DB::raw('(SELECT SUM(qty) FROM order_details where order_details.idProduct = products.id) as sold'),DB::raw('(SELECT qty FROM order_details where order_details.idProduct = products.id order by id DESC LIMIT 1) as last_sold'))->paginate();
            }
        } else {
            $chartWeek = [];
            $sale =[];
            $now = Carbon::now();
            array_push($chartWeek, $now->format('d-M-Y'));
            $details = OrderDetails::whereDate('order_date', $now->format('Y-m-d'))->sum('qty');
            array_push($sale, $details);
            for( $i = 1; $i < 6; $i++ ){
                $current = $now->subDays(1);
                array_push($chartWeek, $current->format('d-M-Y'));
                $details = OrderDetails::whereDate('order_date', $current->format('Y-m-d'))->sum('qty');
                array_push($sale, $details);
            }

            return view('admin.master.inventory',compact('chartWeek','sale'));
        }
        
    }

    public function checkPermission(){
        $user = Auth::user();
        $idPermission = Permissions::where('slug', '/manage-inventory')->first()->id;
        if($idPermission != null){
            $fetchRoles = RolePermissions::where('idRole', $user->idRole)->where('idPermission', $idPermission)->first();
            if($fetchRoles != null){
                if($fetchRoles->active == 'Y'){
                    return true;
                }
            }
        }
        return false;
    }

    public function update($id, Request $request)
    {
        if(!$this->checkPermission()){
            return response()->json('Your account do not have permission to update inventory');
        }
        $product = Products::find($id);
        if($product == null){
            return response()->json('Product not found');
        }
        if($request->qty == null){
            return response()->json('Quanity is required cannot be empty');
        }
        $product->stock = $product->stock + $request->qty;
        $product->update();
        $now = Carbon::now();
        $warehouse = new ProductsWarehouse();
        $warehouse->idProduct = $id;
        $warehouse->qty = $request->qty;
        $warehouse->date_key = Carbon::now()->format('Y-m-d');
        $warehouse->month_key =$now->month;
        $warehouse->week_key = $now->weekOfYear;
        $warehouse->remarks = $request->remarks;
        $warehouse->billNo = $request->bill;
        $warehouse->supplier = $request->supplier;
        $warehouse->save();

        return response()->json('Data Updated!');
    }
}
