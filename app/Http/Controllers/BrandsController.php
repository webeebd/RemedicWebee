<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brands;
use App\Models\Permissions;
use App\Models\RolePermissions;
use Auth;
use Session;

class BrandsController extends Controller
{
    public function index(Request $request)
    {
		//dd($request->route()->getPrefix());
		if ($request->route()->getPrefix() == "/admin-api"){
            $search = $request->input('search');
            if(isset($search)) {
                return Brands::where('name','LIKE',"%{$search}%")->orWhere('description','LIKE',"%{$search}%")->paginate();
            } else {
                return Brands::paginate();
            }
        } else {
            return view('admin.master.brands');
        }
        
    }

    public function fetchbrands(){
        return brands::select('id','name')->get();
    }

    public function checkPermission(){
        $user = Auth::user();
        $idPermission = Permissions::where('slug', '/brand')->first()->id;
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

    public function fetchSelectBrands(Request $request){
        $search = $request->input('q');
        if(isset($search))
        $data = Brands::select('id','name as text','manufacturer as tag')->where('name','LIKE',"%{$search}%")->get()->toArray();
        else  $data = Brands::select('id','name as text','manufacturer as tag')->get()->toArray();
        return response()->json([
            'results' => $data,
            'pagination' => [
                "more" => false
            ]
        ]);
    }

    public function store(Request $request)
    {
        if(!$this->checkPermission()){
            return redirect('admin/brands');
        }
        $validated = $request->validate([
            'name' => 'required|unique:brands',
            'slug' => 'nullable|unique:brands',
            'logo' => 'max:5120|mimes:jpeg,png,jpg',
        ]);

        $brands = new Brands([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'slug' => $request->input('slug'),
            'manufacturer' => $request->input('manufacturer'),
            'active' => $request->input('active'),
        ]);
        $brands->save();
        if($request->hasFile('logo')){
            $image = 'brand_' . $brands->id . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('public/brands/', $image);
            $brands->thumbnail = $image;
            $brands->update();

            /*$destinationPath = public_path('brands/thumbnail');
            if (!file_exists(public_path($destinationPath))) { //Verify if the directory exists
                mkdir(public_path($destinationPath), 666, true); //create it if do not exists
            }
            $imgFile = Image::make($request->file('logo')->getRealPath());
            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$image);*/
        }
        return redirect('admin/brands');
        
    }

    public function show($id)
    {
        $brands = Brands::find($id);
        return response()->json($brands);
    }

    public function edit($id)
    {
        $brand = Brands::find($id);
        return view('admin.master.brands',compact('brand'));
    }

    public function update($id, Request $request)
    {
        if(!$this->checkPermission()){
            return redirect('admin/brands');
        }
        $validated = $request->validate([
            'name' => 'required',
            'logo' => 'max:5120|mimes:jpeg,png,jpg'
        ]);
        $duplicate = Brands::where('name',$request->name)->first();
        if($duplicate != null){
            if($duplicate->id != $id){
                Session::flash('message','Name already exits');
                Session::flash('alert-class', 'alert-danger'); 
                return redirect()->back();
            }
        }
        if(isset($request->slug)){
            $duplicate = Brands::where('slug',$request->slug)->first();
            if($duplicate != null){
                if($duplicate->id != $id){
                    Session::flash('message','Slug already exits');
                    Session::flash('alert-class', 'alert-danger'); 
                    return redirect()->back();
                }
            }
        }
        
        $brands = Brands::find($id);
        $brands->update($request->all());
        if($request->hasFile('logo')){
            $image = 'brand_' . $brands->id . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('public/brands/', $image);
            $brands->thumbnail = $image;
            $brands->update();
        }
        return redirect('admin/brands');
    }
    public function destroy($id)
    {
        if(!$this->checkPermission()){
            return response()->json('Unauthorized deleted!');
        }
        $brands = Brands::find($id);
        $brands->delete();
        return response()->json('Data deleted!');
    }
}
