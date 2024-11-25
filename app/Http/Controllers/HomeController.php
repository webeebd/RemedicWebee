<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permissions;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function kpi(){
        $user = Auth::user();
        $permission = Permissions::join('role_permissions','permissions.id','role_permissions.idPermission')->where('idRole',$user->idRole)->where('slug','/analytic')->get();
        return view('admin.kpi',compact('permission'));
    }
}
