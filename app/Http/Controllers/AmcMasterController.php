<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AmcMaster;
use App\Models\Permissions;
use App\Models\RolePermissions;
use Auth;
use Session;

class AmcMasterController extends Controller
{
    public function index(Request $request)
    {
		//dd($request->route()->getPrefix());
		if ($request->route()->getPrefix() == "/admin-api") {
            $search = $request->input('search');
            if(isset($search)) {
                return AMCMaster::where('name','LIKE',"%{$search}%")->orWhere('description','LIKE',"%{$search}%")->paginate();
            } else {
                return AMCMaster::paginate();
            }
        } else {
            return view('admin.master.amc-master');
        }
        
    }

    public function checkPermission(){
        $user = Auth::user();
        $idPermission = Permissions::where('slug', '/amc-master')->first()->id;
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

    public function fetchAMCMaster(){
        return amcMaster::select('id','name')->get();
    }

    public function fetchSelectPlans(Request $request){
        $search = $request->input('q');
        if(isset($search))
        $data = AmcMaster::select('id','name as text','description as tag','duration','unit')->where('name','LIKE',"%{$search}%")->get()->toArray();
        else  $data = AmcMaster::select('id','name as text','description as tag','duration','unit')->get()->toArray();
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
            return redirect('admin/amc-master');
        }
        $validated = $request->validate([
            'name' => 'required|unique:amc_master',
            'price' => 'required',
            'duration' => 'required',
            'type' => 'required'
        ]);
        $amcMaster = new AmcMaster([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'duration' => $request->input('duration'),
            'type' => $request->input('type'),
            'unit' => $request->input('unit'),
            'offerings' => $request->input('offerings'),
            'terms' => $request->input('terms'),
            'active' => $request->input('active'),
        ]);
        $amcMaster->save();
        return redirect('admin/amcMaster');
    }

    public function show($id)
    {
        $amcMaster = AmcMaster::find($id);
        return response()->json($amcMaster);
    }

    public function edit($id)
    {
        $amcMaster = AMCMaster::find($id);
        return view('admin.master.amc-master',compact('amcMaster'));
    }

    public function update($id, Request $request)
    {
        if(!$this->checkPermission()){
            return redirect('admin/amc-master');
        }
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'type' => 'required'
        ]);
        $duplicate = AmcMaster::where('name',$request->name)->first();
        if($duplicate != null){
            if($duplicate->id != $id)
            return response()->json([
                'message' => 'Name already exits'
            ],422);
        }
        $amcMaster = AmcMaster::find($id);
        $amcMaster->update($request->all());
        return redirect('admin/amc-master');
    }
    public function destroy($id)
    {
        if(!$this->checkPermission()){
            return response()->json('Unauthorized deleted!');
        }
        $amcMaster = AmcMaster::find($id);
        $amcMaster->delete();
        return response()->json('Data deleted!');
    }
}
