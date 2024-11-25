<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolePermissions;
use App\Models\Permissions;
use App\Models\Roles;
use Auth;

class PermissionsController extends Controller
{

    static $permissions = array(
        "Dashboard",
        "Roles",
        "Permissions",
        "Departments",
        "Brand",
        "Categories",
        "AMC Master",
        "Discount",
        "Customers",
        "Create Products",
        "Update Products",
        "View Inventory",
        "Update Inventory",
        "Create Users",
        "View Orders",
        "View Transaction",
        "Update Tracking",
        "Cancel Orders",
        "Generate Invoice",
        "Initiate Return",
        "Initiate Refunds",
        "View AMC",
        "Update AMC",
        "View Support Tickets",
        "Update Support Tickets",
    );

    static $permissionsUrl = [
        "/dashboard",
        "/roles",
        "/permissions",
        "/departments",
        "/brand",
        "/categories",
        "/amc-master",
        "/discount",
        "/customers",
        "/create-products",
        "/edit-Products",
        "/inventory",
        "/manage-inventory",
        "/users",
        "/orders",
        "/transaction",
        "/order-tracking",
        "/cancel-orders",
        "/generate-invoice",
        "/initiate-return",
        "/initiate-refunds",
        "/amc-order",
        "/edit-amc-order",
        "/support-tickets",
        "/manage-tickets",
    ];

    static $analyticsData = [
        "Orders",
        "Net Profit",
        "Sales",
        "Transaction",
        "Warranty",
        "AMC Order",
        "Support Tickets",
        "Return Orders",
        "Roles Data",
        "Products",
        "Discount Data",
        "Inventory Health",
        "Total Customers",
    ];
    static $description = [
        "How many people have ordered in your app from which how may have shipped, preapred and returned.",
        "Calculate net profit from your product sold and not returned.",
        "Calculate sales from your product and amc services sold.",
        "Track your overall transaction from orders.",
        "How many people have claimed warranty.",
        "How many people have brought amc on the equipments",
        "The percentage of your support ticket closed from the opened state",
        "How many people have claimed returned the orders",
        "How many roles has been created in the system to implement RBAC",
        "How many products we have in our database from which how many are in published state and unplished state",
        "How many coupons or promo codes have been claimed.",
        "How many product are out of stock and how many have been filled",
        "How many customer are using the application.",
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index(Request $request)
    {
        //dd($request->route()->getPrefix());
        if ($request->route()->getPrefix() == "/admin-api") {
            $search = $request->input('search');
            if (isset($search)) {
                return Permissions::where('name', 'LIKE', "%{$search}%")->orWhere('description', 'LIKE', "%{$search}%")->paginate();
            } else {
                return Permissions::paginate();
            }
        } else {
            return view('admin.master.permissions');
        }

    }

    public function show($id){
        $idRole = $id;
        $allowed = RolePermissions::where('idRole',$idRole)->where('active','Y')->get()->pluck('idPermission')->toArray();
        $roles = Roles::select('id','title')->where('id','!=','1')->get();
        $permissions = Permissions::where('slug','!=', '/analytic')->get();
        $analytics = Permissions::where('slug', '/analytic')->get();
        return view('admin.master.permissions',compact('permissions','analytics','roles','idRole','allowed'));
    }

    public function fetchpermissions()
    {
        return permissions::select('id', 'name')->get();
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->idRole != 1){
            return response()->json('Unauthorized access will be reported to the admininstrator');
        }
        if($request->idRole == 1){
            return response()->json('Unauthorized access will be reported to the admininstrator');
        }

        $validated = $request->validate([
            'idRole' => 'required'
        ]);
        
        RolePermissions::where('idRole',$request->idRole)->update(['active' => 'N','visible' => null]);

        if (isset($request->permissions)) {
            foreach ($request->permissions as $permission) {
                $idPermission = Permissions::where('id', $permission)->first()->id;
                if (isset($idPermission)) {
                    $fetchRoles = RolePermissions::where('idRole',$request->idRole)->where('idPermission', $idPermission)->first();
                    if ($fetchRoles != null) {
                        $fetchRoles->active = "Y";
                        $fetchRoles->update();
                    } else {
                        $permitObj = new RolePermissions([
                            'idRole' => $request->idRole,
                            'idPermission' => $idPermission,
                            'active' => 'Y'
                        ]);
                        $permitObj->save();
                    }

                }
            }
        }
        if (isset($request->kpi)) {
            $dashboard = $request->kpi;
            foreach($dashboard as $items){
                $idPermission = Permissions::where('id',$items)->first()->id;
                if(isset( $idPermission )){
                    $fetchRoles = RolePermissions::where('idRole',$request->idRole)->where('idPermission',$idPermission)->first();
                    if($fetchRoles != null){
                        $fetchRoles->active = "Y";
                        $fetchRoles->visible = "Y";
                        $fetchRoles->update();
                    }else{
                        $permitObj = new RolePermissions([
                            'idRole' => $request->idRole,
                            'idPermission' => $idPermission,
                            'active' => 'Y',
                            'visible' => 'Y'
                        ]);
                        $permitObj->save();
                    }
                }
            }
        }
        return $this->show($request->idRole);
    }

    public function storeKpis(Request $request)
    {
        $user = Auth::user();
        $idPermission = Permissions::where('id', $request->idPermission)->first()->id;
        if (isset($idPermission)) {
            $fetchRoles = RolePermissions::where('idRole', $user->idRole)->where('idPermission', $request->idPermission)->first();
            if ($fetchRoles != null) {
                $fetchRoles->active = "Y";
                $fetchRoles->visible = "Y";
                $fetchRoles->update();
            } else {
                $permitObj = new RolePermissions([
                    'idRole' => $user->idRole,
                    'idPermission' => $request->idPermission,
                    'active' => 'Y',
                    'visible' => 'Y'
                ]);
                $permitObj->save();
            }

        }
        return response()->json([
            'result' => 1,
            'message' => 'Kpi successfully updated'
        ], 200);
    }

    /*public function show($id)
    {
        $permission = RolePermissions::select('title', 'slug')->join('permissions', 'role_permissions.idPermission', 'permissions.id')->where('idRole', $id)->where('role_permissions.active', "Y")->get()->toArray();
        return response()->json($permission);
    }*/
}
