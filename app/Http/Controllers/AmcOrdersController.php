<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\AmcOrders;
use Illuminate\Pagination\Paginator;
use App\Models\PanelData;

class AmcOrdersController extends Controller
{
    //
    static $complaintStatus = array('New Complaint','In Progress','Resolved Offline','Resolved Online');
    static $amcStatus = array('Total AMC','Claimed AMC');
    public function index(Request $request)
    {
        $data = [];
		return view('admin.master.amc',compact('data'));        
    }

    public function fetchamc(Request $request){
        $response = [];
            $draw = $_POST['draw'];
            $row = $_POST['start'];
            $rowperpage = $_POST['length']; // Rows display per page
            $columnIndex = $_POST['order'][0]['column']; // Column index
            $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
            $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
            $searchValue = $_POST['search']['value']; // Search value
            $currentPage = ($row/$rowperpage) + 1;
            Paginator::currentPageResolver(function() use ($currentPage) {
                return $currentPage;
            });

            $result = AmcOrders::join('orders','order_amcs.idOrder','=','orders.id')
                    ->join('customer_address','orders.idAddress','=','customer_address.id')
                    ->join('amc_master','order_amcs.idAmc','=','amc_master.id')
                    ->join('customers','orders.idUser','=','customers.id')
                    ->join('products','order_amcs.idProduct','=','products.id')
                    ->select('amcNumber','order_amcs.id as idOrder','products.title','amc_master.name','amc_master.duration','amc_master.unit','amc_master.price','amc_master.type','order_amcs.amount','qty','order_amcs.created_at','claimed','validity','status','mobile','email',DB::raw('CONCAT(address_house," ",address_street," ",area," ",IFNULL(landmark,"")," ",city," ",IFNULL(state,"")," ",pincode) as address'));
            if($searchValue != ''){
                $result = $result->where('name','LIKE','%'. $searchValue .'%')
                        ->orWhere('mobile','LIKE','%'. $searchValue .'%')
                        ->orWhere('amcNumber','LIKE','%'. $searchValue .'%')
                        ->orWhere('email','LIKE','%'. $searchValue .'%');
            }

            $totalRecords = AmcOrders::join('orders','order_amcs.idOrder','=','orders.id')
            ->join('customer_address','orders.idAddress','=','customer_address.id')
            ->join('customers','orders.idUser','=','customers.id')
            ->join('products','order_amcs.idProduct','=','products.id')->count();
            if($searchValue != ''){
                $totalRecordwithFilter  = AmcOrders::join('orders','order_amcs.idOrder','=','orders.id')
                ->join('customer_address','orders.idAddress','=','customer_address.id')
                ->join('customers','orders.idUser','=','customers.id')
                ->join('products','order_amcs.idProduct','=','products.id')->where('name','LIKE','%'. $searchValue .'%')
                ->orWhere('mobile','LIKE','%'. $searchValue .'%')
                ->orWhere('amcNumber','LIKE','%'. $searchValue .'%')
                ->orWhere('email','LIKE','%'. $searchValue .'%')->count();
            }else $totalRecordwithFilter = $totalRecords;
            $result = $result->orderBy('orders.id','DESC')->paginate($rowperpage)->items();
            
            $data = [];
            $t = $row;
            foreach($result as $var) {
                $status = '<span class="badge bg-success">'.$var->status.'</span>';
                if($var->status == "Cancelled")
                $status = '<span class="badge bg-danger">'.$var->status.'</span>';
                $data[] = array( 
                    "product"=> $var->title,
                    "name"=> $var->name,
                    "order_no"=> $var->amcNumber,
                    "qty"=> $var->qty,
                    "validity"=> $var->validity,
                    "mobile"=>$var->mobile,
                    "total" => '৳'.$var->amount,
                    "status"=> $status,
                    "action"=>  '<a class="btn btn-outline-primary" href="/admin/amc/'.$var->idOrder.'">View Details</a>'
                );
                $t++;
            }
            ## Response
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
                );      
    
            return json_encode($response);
    }        

    public function show($id){
        $orders = AmcOrders::leftJoin('customer_address','order_amcs.idAddress','=','customer_address.id')->join('orders','order_amcs.idOrder','=','orders.id')->join('products','order_amcs.idProduct','=','products.id')->join('amc_master','order_amcs.idAmc','=','amc_master.id')->join('customers','orders.idUser','=','customers.id')->select('order_amcs.id as id','products.title','amc_master.name as amcName','amc_master.unit','amc_master.duration','amc_master.offerings','orders.order_date','amcNumber','status','orders.total','modelNumber',DB::raw('IFNULL(city," ") as city'),DB::raw('IFNULL(area," ") as area'),DB::raw('IFNULL(state," ") as state'),DB::raw('IFNULL(address_street," ") as address_street'),DB::raw('IFNULL(address_house," ") as address'),DB::raw('IFNULL(landmark," ") as landmark'),DB::raw('IFNULL(pincode," ") as pincode'),'customers.name as username','customers.email','customers.mobile','pic')->where('order_amcs.id',$id)->first();
        $response = array(
            'order' => $orders
        );
        return response()->json($response);
    }
}
