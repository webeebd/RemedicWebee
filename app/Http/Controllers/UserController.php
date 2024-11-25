<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class UserController extends Controller
{
    public function index(Request $request)
    {
		//dd($request->route()->getPrefix());
		if ($request->route()->getPrefix() == "/admin-api") {
            $search = $request->input('search');
            if(isset($search)) {
                return User::join('roles','users.idRole','=','roles.id')->select('users.*','roles.title')->where('idRole','!=',1)->where('name','LIKE',"%{$search}%")->orWhere('description','LIKE',"%{$search}%")->paginate();
            } else {
                return User::join('roles','users.idRole','=','roles.id')->select('users.*','roles.title')->where('idRole','!=',1)->paginate();
            }
        } else {
            return view('admin.master.users');
        }
        
    }

    public function fetchusers(){
        return users::select('id','name')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'idRole' => 'required',
            'active' => 'required',
        ]);
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'idRole' => $request->input('idRole'),
            'active' => $request->input('active'),
        ]);
        $user->save();
        return redirect('admin/users');
    }

    public function show($id)
    {
        $user = User::join('roles','users.idRole','=','roles.id')->select('users.*','roles.title as role')->find($id);
        return response()->json($user);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.master.users',compact('user'));
    }

    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'idRole' => 'required',
        ]);

        $duplicate = User::where('name',$request->name)->first();
        if($duplicate != null){
            if($duplicate->id != $id)
            {
                Session::flash('message','Name already exits');
                Session::flash('alert-class', 'alert-danger'); 
                return redirect()->back();
            }
        }

        $duplicate = User::where('email',$request->email)->first();
        if($duplicate != null){
            if($duplicate->id != $id){
                Session::flash('message','Email has already been taken');
                Session::flash('alert-class', 'alert-danger'); 
                return redirect()->back();
            }
        }
        $user = User::find($id);
        $user->update($request->all());
        return redirect('admin/users');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json('Role deleted!');
    }
}
