<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\User;
use Auth;

class RolesController extends Controller
{
    public function index(Request $request)
    {
		if ($request->route()->getPrefix() == "/admin-api") {
            $search = $request->input('search');
            if(isset($search)) {
                return Roles::where('name','LIKE',"%{$search}%")->orWhere('description','LIKE',"%{$search}%")->paginate();
            } else {
                return Roles::paginate();
            }
        } else {
            return view('admin.master.roles');
        }
        
    }

    public function fetchroles(){
        return roles::select('id','name')->get();
    }

    public function fetchSelectRoles(Request $request){
        $search = $request->input('q');
        if(isset($search))
        $data = Roles::select('id','name as text','manufacturer as tag')->where('name','LIKE',"%{$search}%")->get()->toArray();
        else  $data = Roles::select('id','name as text','manufacturer as tag')->get()->toArray();
        return response()->json([
            'results' => $data,
            'pagination' => [
                "more" => false
            ]
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->idRole != 1){
            return response()->json('Unauthorized access will be reported to the admininstrator');
        }
        $validated = $request->validate([
            'title' => 'required|unique:roles',
            'description' => 'required',
            'active' => 'required'
        ]);
        $roles = new Roles([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'active' => $request->input('active'),
        ]);
        $roles->save();
        if(isset($request->redirect)){
            return redirect('admin/permissions/'.$roles->id);        
        }else
        return redirect('admin/roles');        
    }

    public function show($id)
    {
        $role = Roles::find($id);
        return view('admin.master.roles',compact('role'));
    }

    public function edit($id)
    {
        $role = Roles::find($id);
        return view('admin.master.roles',compact('role'));
    }

    public function update($id, Request $request)
    {
        $user = Auth::user();
        if($user->idRole != 1){
            return response()->json('Unauthorized access will be reported to the admininstrator');
        }
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $duplicate = Roles::where('title',$request->title)->first();
        if($duplicate != null){
            if($duplicate->id != $id)
            return response()->json([
                'message' => 'Title has already been taken'
            ],422);
        }
        $role = Roles::find($id);
        $role->update($request->all());
        return redirect('admin/roles');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if($user->idRole != 1){
            return response()->json('Unauthorized access will be reported to the admininstrator');
        }
        if(User::where('idRole',$id)->first() != null){
            return response()->json('Users are assigned this role so it cannot be deleted. To delete reassign the role to users.');
        }
        $role = Roles::find($id);
        $role->delete();
        return response()->json('Role deleted!');
    }
}
