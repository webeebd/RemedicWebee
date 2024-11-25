<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departments;
use Auth;
use App\Models\Categories;
use App\Models\Permissions;
use App\Models\RolePermissions;
use Image;
use DB;

class DepartmentsController extends Controller
{
    public function index(Request $request)
    {
		//dd($request->route()->getPrefix());
		if ($request->route()->getPrefix() == "/admin-api") {
            $search = $request->input('search');
            if(isset($search)) {
                return departments::leftJoin('departments_categories','departments.id','=','departments_categories.idDepartment')
                        ->leftJoin('categories','departments_categories.idCategory','=','categories.id')
                        ->select('departments.*','categories.name as category','departments_categories.id as idMap')
                        ->where('departments.name','LIKE',"%{$search}%")->orWhere('departments.description','LIKE',"%{$search}%")->paginate();
            } else {
                return departments::leftJoin('departments_categories','departments.id','=','departments_categories.idDepartment')
                ->leftJoin('categories','departments_categories.idCategory','=','categories.id')
                ->select('departments.*','categories.name as category','departments_categories.id as idMap')->paginate();
            }
        } else {
            $categories = Categories::select('name','id')->where('active','Y')->get();
            return view('admin.master.departments',compact('categories'));
        }
        
    }

    public function fetchdepartments(){
        return departments::select('id','name')->get();
    }

    public function fetchSelectDepartments(Request $request){
        $search = $request->input('q');
        if(isset($search))
        $data = Departments::select('id','name as text')->where('name','LIKE',"%{$search}%")->get()->toArray();
        else  $data = Departments::select('id','name as text')->get()->toArray();
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
            return redirect('admin/departments');
        }
        $validated = $request->validate([
            'name' => 'required|unique:departments',
            'slug' => 'nullable|unique:departments',
            'logo' => 'max:5120|mimes:jpeg,png,jpg',
        ]);
        $departments = new Departments([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'active' => $request->input('active'),
        ]);
        $departments->save();

        if(isset($request->categories)){
            foreach($request->categories as $category){
                DB::table('departments_categories')->insert([
                    'idDepartment' =>  $departments->id,
                    'idCategory' => $category
                ]);
            }
        }

        if($request->hasFile('logo')){
            $image = 'department_' . $departments->id . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('public/departments/', $image);
            $departments->thumbnail = $image;
            $departments->update();

            /*$destinationPath = public_path('departments/thumbnail');
            if (!file_exists(public_path($destinationPath))) { //Verify if the directory exists
                mkdir(public_path($destinationPath), 666, true); //create it if do not exists
            }
            $imgFile = Image::make($request->file('logo')->getRealPath());
            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$image);*/
        }
        return redirect('admin/departments');
    }

    public function show($id)
    {
        $departments = Departments::find($id);
        return response()->json($departments);
    }

    public function edit($id)
    {
        $department = Departments::find($id);
        $mapping = DB::table('departments_categories')->where('idDepartment',$id)->get()->pluck('idCategory')->toArray();
        $categories = Categories::select('name','id')->where('active','Y')->get();
        return view('admin.master.departments',compact('department','categories','mapping'));
    }

    public function update($id, Request $request)
    {
        if(!$this->checkPermission()){
            return redirect('admin/departments');
        }
        $validated = $request->validate([
            'name' => 'required',
            'logo' => 'max:5120|mimes:jpeg,png,jpg'
        ]);
        $duplicate = Departments::where('name',$request->name)->first();
        if($duplicate != null){
            if($duplicate->id != $id){
                Session::flash('message','Name already exits');
                Session::flash('alert-class', 'alert-danger'); 
                return redirect()->back();
            }
        }
        if(isset($request->slug)){
            $duplicate = Departments::where('slug',$request->slug)->first();
            if($duplicate != null){
                if($duplicate->id != $id){
                    Session::flash('message','Slug already exits');
                    Session::flash('alert-class', 'alert-danger'); 
                    return redirect()->back();
                }
            }
        }       

        if(isset($request->selectAll)){
            DB::table('departments_categories')->where('idDepartment',$id)->delete();
        }

        $departments = Departments::find($id);
        $departments->update($request->all());
        
        if(isset($request->categories)){
            foreach($request->categories as $category){
                if(DB::table('departments_categories')->where('idDepartment',$id)->where('idCategory',$category)->first() == null){
                    DB::table('departments_categories')->insert([
                        'idDepartment' =>  $departments->id,
                        'idCategory' => $category
                    ]);
                }    
                DB::table('departments_categories')->whereNotIn('idCategory',$request->categories)->delete();            
            }
        }

        if($request->hasFile('logo')){
            $image = 'department_' . $departments->id . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('public/departments/', $image);
            $departments->thumbnail = $image;
            $departments->update();
        }
        return redirect('admin/departments');
    }
    public function destroy($id)
    {
        if(!$this->checkPermission()){
            return response()->json('Unauthorized delete!');
        }
        if(substr($id, 0, 1) == 'd'){
            $mapping = DB::table('departments_categories')->where('id',substr($id,1))->first();
            if($mapping != null){
                $idDepartment = $mapping->idDepartment;
                DB::table('departments_categories')->where('id',substr($id,1))->delete();
                if(DB::table('departments_categories')->where('idDepartment',$idDepartment)->first() == null){
                    $departments = Departments::find($idDepartment);
                    $departments->delete();
                }
            }
        }else{
            $departments = Departments::find($id);
            $departments->delete();
        }
        return response()->json('Data deleted!');
    }

    public function checkPermission(){
        $user = Auth::user();
        $idPermission = Permissions::where('slug', '/departments')->first()->id;
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
}
