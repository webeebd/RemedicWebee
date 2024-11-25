<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Carbon\Carbon;
use App\Models\Permissions;
use App\Models\RolePermissions;
use Auth;
use Image;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
		//dd($request->route()->getPrefix());
		if ($request->route()->getPrefix() == "/admin-api") {
			$search = $request->input('search');
			if(isset($search))
			return Categories::where('name','LIKE',"%{$search}%")->orWhere('description','LIKE',"%{$search}%")->paginate();
			else return Categories::paginate();
		}else{
			return view('admin.master.categories');
		}
    }

    public function fetchCategories(){
        return Categories::select('id','name')->get();
    }

    public function fetchSelectCategories(Request $request){
        $search = $request->input('q');
        if(isset($search))
        $data = Categories::select('id','name as text')->where('name','LIKE',"%{$search}%")->get()->toArray();
        else  $data = Categories::select('id','name as text')->get()->toArray();
        return response()->json([
            'results' => $data,
            'pagination' => [
                "more" => false
            ]
        ]);
    }
    public function checkPermission(){
        $user = Auth::user();
        $idPermission = Permissions::where('slug', '/categories')->first()->id;
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

    public function store(Request $request)
    {
        if(!$this->checkPermission()){
            return redirect('admin/categories');
        }
        $validated = $request->validate([
            'name' => 'required|unique:categories',
            'slug' => 'nullable|unique:categories',
            'logo' => 'max:5120|mimes:jpeg,png,jpg'
        ]);
        $categories = new Categories([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'slug' => $request->input('slug'),
            'active' => $request->input('active'),
        ]);
        $categories->save();
        if($request->hasFile('logo')){
            $image = 'category_' . $categories->id . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('public/categories/', $image);
            $categories->thumbnail = $image;
            $categories->update();

            /*$destinationPath = public_path('categories/thumbnail');
            if (!file_exists(public_path($destinationPath))) { //Verify if the directory exists
                mkdir(public_path($destinationPath), 666, true); //create it if do not exists
            }
            $imgFile = Image::make($request->file('logo')->getRealPath());
            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$image);*/
        }
        return redirect('admin/categories');
    }

    public function show($id)
    {
       
        $categories = Categories::find($id);
        return response()->json($categories);
    }

    public function edit($id)
    {
        $category = Categories::find($id);
        return view('admin.master.categories',compact('category'));
    }

    public function update($id, Request $request)
    {
        if(!$this->checkPermission()){
            return redirect('admin/categories');
        }
        $validated = $request->validate([
            'name' => 'required',
            'logo' => 'max:5120|mimes:jpeg,png,jpg'
        ]);
        $duplicate = Categories::where('name',$request->name)->first();
        if($duplicate != null){
            if($duplicate->id != $id)
            return response()->json([
                'message' => 'Name already exits'
            ],422);
        }
        if(isset($request->slug)){
            $duplicate = Categories::where('slug',$request->slug)->first();
            if($duplicate != null){
                if($duplicate->id != $id)
                return response()->json([
                    'message' => 'Slug already exits'
                ],422);
            }
        }
        
        $categories = Categories::find($id);
        $categories->update($request->all());

        if($request->hasFile('logo')){
            $image = 'category_' . $categories->id . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('public/categories/', $image);
            $categories->thumbnail = $image;
            $categories->update();

            /*$destinationPath = public_path('categories/thumbnail');
            if (!file_exists(public_path($destinationPath))) { //Verify if the directory exists
                mkdir(public_path($destinationPath), 666, true); //create it if do not exists
            }
            $imgFile = Image::make($request->file('logo')->getRealPath());
            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$image);*/
        }
        return redirect('admin/categories');
    }
    public function destroy($id)
    {
        if(!$this->checkPermission()){
            return response()->json('Unauthorized delete!');
        }
        $categories = Categories::find($id);
        $categories->delete();
        return response()->json('Data deleted!');
    }
}
