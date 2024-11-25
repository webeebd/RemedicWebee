<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Brands;
use App\Models\Products;
use DB;
use App\Models\AmcMaster;
use Auth;
use App\Models\Permissions;
use App\Models\RolePermissions;
use App\Models\ProductMedia;
use App\Models\ProductKeyword;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
		//dd($request->route()->getPrefix());
		if ($request->route()->getPrefix() == "/admin-api") {
            $search = $request->input('search');
            if(isset($search)) {
                return Products::leftJoin('categories','products.category_id','=','categories.id')
                ->select('products.active','products.id','max_retail_price as mrp','pic','sales_price as price','pre_discount','flat_discount','products.title','products.updated_at','categories.name as category')->where('title','LIKE',"%{$search}%")->paginate();
            } else {
                return Products::leftJoin('categories','products.category_id','=','categories.id')
                ->select('products.active','products.id','max_retail_price as mrp','pic','sales_price as price','pre_discount','flat_discount','products.title','products.updated_at','categories.name as category')->paginate();
            }
        } else {
            return view('admin.master.products');
        }
        
    }

    public function checkPermission($slug){
        $user = Auth::user();
        $idPermission = Permissions::where('slug', $slug)->first()->id;
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

    public function fetchproducts(){
        return products::select('id','name')->get();
    }

    public function storeImages(Request $request){
        if(!$this->checkPermission('/create-products')){
            return response()->json(['success'=>'You are not permitted to upload file.'],500);
        }
        $validated = $request->validate([
            'file' => 'required|max:5120|mimes:jpeg,png,jpg'
        ]);
        if($request->hasFile('file')){
            $image = 'product_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->storeAs('public/products/', $image);

            /*$destinationPath = public_path('products/thumbnail');
            if (!file_exists(public_path($destinationPath))) { //Verify if the directory exists
                mkdir(public_path($destinationPath), 666, true); //create it if do not exists
            }
            $imgFile = Image::make($request->file('logo')->getRealPath());
            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$image);*/

            return response()->json(['success'=>'You have successfully upload file.', 'id' => $image]);
        }
        return response()->json(['success'=>'You have successfully upload file.']);
    }

    public function create(){
        if(!$this->checkPermission('/create-products')){
            return redirect('admin/products');
        }
        
        $categories = Categories::select('name','id')->where('active','Y')->get();
        $department = Departments::select('name','id')->where('active','Y')->get();
        $brands = Brands::select('name','id')->where('active','Y')->get();
        $amc = AmcMaster::select(DB::raw('CONCAT(name,"- ৳",price) as name'),'id')->where('active','Y')->get();
        return view('admin.master.add-products',compact('amc','brands','categories','department'));
    }

    public function store(Request $request)
    {
        if(!$this->checkPermission('/create-products')){
            return redirect('admin/products');
        }
        $validated = $request->validate([
            'featureImg' => 'required|max:5120|mimes:jpeg,png,jpg',
            'title' => 'required|unique:products',
            'short_description' => 'required',
            'description' => 'required',
            'sales_price' => 'required',
            'max_retail_price' => 'required',
            'tax_amount' => 'required',
        ]);
        $products = new Products([
            'title' => $request->input('title'),
            'category_id' =>$request->input('category_id'),
            'department_id'=>$request->input('department'),
            'modelNumber' => $request->input('modelNumber'),
            'brand_id' => $request->input('brand_id'),
            'genericName' => $request->input('genericName'),
            'manufacture' => $request->input('manufacture'),
            'skuc_code'=>$request->input('skuc_code'),
            'hsn_code' => $request->input('hsn_code'),
            'country_origin'=>$request->input('country_origin'),
            'pack_size'=>$request->input('pack_size'), 
            'purchase_price' => $request->input('purchase_price'),
            'sales_price' => $request->input('sales_price'),
            'max_retail_price' => $request->input('max_retail_price'),
            'tax_amount' => 0.00,
            'tax' => $request->input('tax_amount'),
            'slug'=>time(),
            'minStock' => $request->input('minStock'),
            'maxStock' => $request->input('maxStock'),
            'stock' => $request->input('stock'),
            'stockAlert' => $request->input('stockAlert'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'warranty'=>$request->input('warranty'),
            'amc_id' => $request->input('amc_id'),
            'pre_discount' => 0.00,
            'minBuy' => 'Y',
            'maxBuy' => 'Y',
            'active' => 'Y',
        ]);
        $products->save();
        if($request->input('pre_discount') != null){
            if($request->input('discount_type') == "P")
            $products->pre_discount = $request->input('pre_discount');
            else $products->flat_discount = $request->input('pre_discount');
        }
        if($request->input('tax_amount') != null){
            //$products->tax_amount = $request->input('tax_amount');
        }
        if($request->input('media') != null){
            foreach($request->input('media') as $key => $value){
                $media = new ProductMedia([
                    'url' => $value,
                    'idProduct' => $products->id,
                    'active' => 'Y',
                    'type' => 'image'
                ]);
                $media->save();
            }
        }
        if($request->input('keypoints') != null){
            $explode = explode(",",$request->input('keypoints'));
            foreach($explode as $key => $value){
                $points =  new ProductKeyword([
                    'word' => trim($value),
                    'idProduct' => $products->id
                ]);
                $points->save();
            }
        }
        if($request->hasFile('featureImg')){
            $image = 'product_' . $products->id . '.' . $request->file('featureImg')->getClientOriginalExtension();
            $request->file('featureImg')->storeAs('public/products/', $image);
            $products->pic = $image;

            /*$destinationPath = public_path('products/thumbnail');
            if (!file_exists(public_path($destinationPath))) { //Verify if the directory exists
                mkdir(public_path($destinationPath), 666, true); //create it if do not exists
            }
            $imgFile = Image::make($request->file('logo')->getRealPath());
            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$image);*/
        }
        $products->update();
        return redirect('admin/products');
    }

    public function show($id)
    {
        $products = Products::join('roles','users.idRole','=','roles.id')->select('users.*','roles.title as role')->find($id);
        return response()->json($products);
    }

    public function update($id, Request $request)
    {
        if(!$this->checkPermission('/edit-Products')){
            return redirect('admin/products');
        }
        $validated = $request->validate([
            'featureImg' => 'max:5120|mimes:jpeg,png,jpg',
            'short_description' => 'required',
            'description' => 'required',
            'sales_price' => 'required',
            'max_retail_price' => 'required',
            'tax_amount' => 'required'
        ]);
        $products = Products::find($id);
        if($request->input('media') != null){
            foreach($request->input('media') as $key => $value){
                if(ProductMedia::where('url',$value)->first() == null){
                    $media = new ProductMedia([
                        'url' => $value,
                        'idProduct' => $products->id,
                        'active' => 'Y',
                        'type' => 'image'
                    ]);
                    $media->save();
                }
                
            }
        }
        if($request->input('keypoints') != null){
            $explode = explode(",",$request->input('keypoints'));
            ProductKeyword::where('idProduct',$products->id)->delete();
            foreach($explode as $key => $value){
                if(ProductKeyword::where('word',$value)->where('idProduct',$products->id)->first() == null){
                    $points =  new ProductKeyword([
                        'word' => trim($value),
                        'idProduct' => $products->id
                    ]);
                    $points->save();
                }
            }
        }
        unset($request->keypoints);
        $products->update($request->all());
        if($request->hasFile('featureImg')){
            $image = 'product_' . $products->id . '.' . $request->file('featureImg')->getClientOriginalExtension();
            $request->file('featureImg')->storeAs('public/products/', $image);
            $products->pic = $image;

            /*$destinationPath = public_path('products/thumbnail');
            if (!file_exists(public_path($destinationPath))) { //Verify if the directory exists
                mkdir(public_path($destinationPath), 666, true); //create it if do not exists
            }
            $imgFile = Image::make($request->file('logo')->getRealPath());
            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$image);*/
        }
        
        return redirect('admin/products');
    }
    
    public function edit($id)
    {
        $product = Products::find($id);
        $categories = Categories::select('name','id')->where('active','Y')->get();
        $department = Departments::select('name','id')->where('active','Y')->get();
        $brands = Brands::select('name','id')->where('active','Y')->get();
        $keywords = ProductKeyword::select('word')->where('idProduct',$id)->get();
        $media = ProductMedia::select('url','id')->where('idProduct',$id)->get();
        $amc = AmcMaster::select(DB::raw('CONCAT(name,"- ৳",price) as name'),'id')->where('active','Y')->get();
        return view('admin.master.add-products',compact('amc','brands','categories','department','product','keywords','media'));
    }

    public function destroy($id)
    {
        if(!$this->checkPermission('/edit-Products')){
            return response()->json('Unauthorized delete!');
        }

        $products = Products::find($id);
        $products->active = 'N';
        $products->update();
        return response()->json('Data deleted!');
    }

    public function manageStatus($status,$id){
        if(!$this->checkPermission('/edit-Products')){
            return response()->json('Unauthorized status change !');
        }

        $products = Products::find($id);
        if($status == "unpublish")
        $products->active = 'N';
        else $products->active = 'Y';
        return response()->json('Status Updated!');
    }
}
