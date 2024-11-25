<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Log;
use Cache;
use DB;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $products = fetchProducts($request);
        $filters = DB::table('app_filter')->whereNull('value')->get()->pluck('key')->toArray();
        $response = array(
            "products" => $products,
            "filters" => $filters
        );
        return response()->json(['response' => $response]);
    }

    public function filters(Request $request){
        if($request->filter == "Categories"){
            $response = array(
                "filter_data" =>  \App\Models\Categories::select('id','name')->get()
            );
            return response()->json(['response' => $response]);
        }else if($request->filter == "Price"){
            $response = array(
                "filter_data" => categories()
            );
            return response()->json(['response' => $response]);
        }else if($request->filter == "Brand"){
            $response = array(
                "filter_data" => \App\Models\Brands::select('id','name')->get()
            );
            return response()->json(['response' => $response]);
        }else if($request->filter == "Discount"){
            $response = array(
                "filter_data" => DB::table('app_filter')->select('value as name')->whereNotNull('value')->where('key',"Discount")->get()
            );
            return response()->json(['response' => $response]);
        }else if($request->filter == "Ratings"){
            $response = array(
                "filter_data" => DB::table('app_filter')->select('value as name')->whereNotNull('value')->where('key',"Ratings")->get()
            );
            return response()->json(['response' => $response]);
        }
    }

    public function productDetails(Request $request) {
        $amc = [];
        $offers = [];
        $products = \App\Models\Products::join('categories', 'products.category_id', '=', 'categories.id')
        ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
        ->select('products.slug','rating', 'products.short_description as description','products.description as overview', 'products.title as name', 'products.pic as imageUrl', 'max_retail_price as mrp', 'sales_price as price', 'pre_discount as discount','maxStock as maxItem', 'products.id','categories.name as category','brands.name as brand','amc_id')->where('products.id', '=', $request->id)->first();
        $media =  \App\Models\ProductsMedia::select('url')->where('type', '=',"image")->where('active', '=',"Y")->where('idProduct', '=', $request->id)->get()->pluck('url')->toArray();
        if(isset($products->category)){
            $offers = \App\Models\Discounts::select('name','description','type','total','min_amount as minimum','expire_date as expiry')->where('active', 'Y')->whereDate('expire_date','>', date('Y-m-d'))->where('type', 'C')->whereJsonContains('logic', $products->category)->get();
        }        
        if($products->amc_id == null){
            $response = array(
                "product" => $products,
                "images" => $media,
                "amc" => $amc,
                "offer" => $offers
            );
        }else{
            $amc = \App\Models\AmcMaster::where('id', '=', $products->amc_id)->get();
            $response = array(
                "product" => $products,
                "images" => $media,
                "amc" => $amc,
                "offer" => $offers
            );
        }
        return response()->json(['response' => $response]);
    }
}
