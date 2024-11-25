<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discounts;
use App\Models\Categories;
use Carbon\Carbon;
use App\Models\Permissions;
use App\Models\RolePermissions;
use Auth;

class DiscountsController extends Controller
{
    public function index(Request $request)
    {
		//dd($request->route()->getPrefix());
		if ($request->route()->getPrefix() == "/admin-api") {
            $search = $request->input('search');
            if(isset($search)) {
                return Discounts::leftJoin('categories','discounts.idCategory','=','categories.id')->select('discounts.*','categories.name as category')->where('discounts.name','LIKE',"%{$search}%")->orWhere('discounts.description','LIKE',"%{$search}%")->paginate();
            } else {
                return Discounts::leftJoin('categories','discounts.idCategory','=','categories.id')->select('discounts.*','categories.name as category')->paginate();
            }
        } else {
            $categories = Categories::select('name','id')->where('active','Y')->get();
            return view('admin.master.discounts',compact('categories'));
        }
        
    }

    public function checkPermission(){
        $user = Auth::user();
        $idPermission = Permissions::where('slug', '/discount')->first()->id;
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

    public function fetchdiscounts(){
        return discounts::select('id','name')->get();
    }

    public function store(Request $request)
    {
        if(!$this->checkPermission()){
            return redirect('admin/discount');
        }
        $validated = $request->validate([
            'name' => 'required|unique:discounts',
            'type' => 'required',
            'total' => 'required',
            'expire_date' => 'required',
            'active' => 'required',
        ]);
        $discounts = new Discounts([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'unit' => $request->input('unit'),
            'total' => $request->input('total'),
            'idCategory' => $request->input('idCategory'),
            'expire_date' => Carbon::parse($request->input('expire_date'))->format('Y-m-d'),
            'max_redeem' => $request->input('max_redeem'),
            'min_amount' => $request->input('min_amount'),
            'active' => $request->input('active'),
        ]);
        $discounts->save();
        return redirect('admin/discounts');
    }

    public function show($id)
    {
        $discounts = Discounts::find($id);
        return response()->json($discounts);
    }

    public function edit($id)
    {
        $discount = Discounts::find($id);
        $categories = Categories::select('name','id')->where('active','Y')->get();
        return view('admin.master.discounts',compact('discount','categories'));
    }

    public function update($id, Request $request)
    {
        if(!$this->checkPermission()){
            return redirect('admin/discount');
        }
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'total' => 'required',
            'expire_date' => 'required',
            'active' => 'required',
        ]);
        $duplicate = Discounts::where('name',$request->name)->first();
        if($duplicate != null){
            if($duplicate->id != $id)
            return response()->json([
                'message' => 'Name already exits'
            ],422);
        }

        $discounts = Discounts::find($id);
        $discounts->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'type' => substr($request->input('type'),0,1),
            'unit' => $request->input('unit'),
            'total' => $request->input('total'),
            'idCategory' => $request->input('idCategory'),
            'min_amount' => $request->input('min_amount'),
            'expire_date' => Carbon::parse($request->input('expire_date'))->format('Y-m-d'),
            'max_redeem' => $request->input('max_redeem'),
            'active' => $request->input('active'),
        ]);
        return redirect('admin/discounts');
    }
    public function destroy($id)
    {
        if(!$this->checkPermission()){
            return response()->json('Unauthorized deleted!');
        }
        $discounts = Discounts::find($id);
        $discounts->delete();
        return response()->json('Data deleted!');
    }
}
