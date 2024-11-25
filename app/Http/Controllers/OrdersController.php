<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Carbon\Carbon;
use DB;
use App\Models\Orders;
use App\Models\OrderDetails;
use Illuminate\Pagination\Paginator;
use App\Models\PanelData;

class OrdersController extends Controller
{
    static $status = array('New Order','In Progress','Shipped','Delivered','Delivered');
    static $details = array('Order Created','Processing Order','Order Shipped','Order Delivered');
        

        public function index(Request $request)
        {
            $data = [];
            $data["total"] = OrderDetails::count();
            $data["new"] = OrderDetails::where('status',"New Order")->count();
            $data["accept"] = OrderDetails::where('status',"In Progress")->count();
            $data["shipped"] = OrderDetails::where('status',"Shipped")->count();
            $data["deliver"] = OrderDetails::where('status',"Delivered")->count();
            return view('admin.master.orders',compact('data'));
        }
    
        public function fetchorders(Request $request){
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

            $result = OrderDetails::join('orders','order_details.idOrder','=','orders.id')
                    ->join('customer_address','orders.idAddress','=','customer_address.id')
                    ->join('customers','orders.idUser','=','customers.id')
                    ->join('products','order_details.idProduct','=','products.id')
                    ->select('order_details.id as idOrder','products.title','order_details.total','qty','order_details.order_date','status','orderNumber','billNumber','name','mobile','email',DB::raw('CONCAT(address_house," ",address_street," ",area," ",IFNULL(landmark,"")," ",city," ",IFNULL(state,"")," ",pincode) as address'));
            if($searchValue != ''){
                $result = $result->where('name','LIKE','%'. $searchValue .'%')
                        ->orWhere('mobile','LIKE','%'. $searchValue .'%')
                        ->orWhere('orderNumber','LIKE','%'. $searchValue .'%')
                        ->orWhere('billNumber','LIKE','%'. $searchValue .'%')
                        ->orWhere('email','LIKE','%'. $searchValue .'%');
            }

            $totalRecords = OrderDetails::join('orders','order_details.idOrder','=','orders.id')
            ->join('customer_address','orders.idAddress','=','customer_address.id')
            ->join('customers','orders.idUser','=','customers.id')
            ->join('products','order_details.idProduct','=','products.id')->count();
            if($searchValue != ''){
                $totalRecordwithFilter  =OrderDetails::join('orders','order_details.idOrder','=','orders.id')
                ->join('customer_address','orders.idAddress','=','customer_address.id')
                ->join('customers','orders.idUser','=','customers.id')
                ->join('products','order_details.idProduct','=','products.id')->where('name','LIKE','%'. $searchValue .'%')
                ->orWhere('mobile','LIKE','%'. $searchValue .'%')
                ->orWhere('orderNumber','LIKE','%'. $searchValue .'%')
                ->orWhere('billNumber','LIKE','%'. $searchValue .'%')
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
                    "order_no"=> $var->orderNumber,
                    "bill_no"=> '<b>'.$var->billNumber.'</b>',
                    "qty"=> $var->qty,
                    "mobile"=>$var->mobile,
                    "total" => '৳'.$var->total,
                    "order_date"=> Carbon::parse($var->order_date)->format('d-m-Y'),
                    "status"=> $status,
                    "action"=>  '<a class="btn btn-outline-primary" href="/admin/orders/'.$var->idOrder.'">View Details</a>'
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

    static $detailsLabel = array(
        'New Order' => 'Process Order',
        'In Progress' => 'Ship Order',
        'Shipped' => 'Mark as Delivered',
        'Cancelled' => 'Order Cancelled',
        'Delivered' => '');
    static $detailsMaping = array(
        'New Order' => 'Order Created',
        'In Progress' => 'Processing Order',
        'Cancelled' => 'Order Cancelled',
        'Shipped' =>'Order Shipped',
        'Delivered' => 'Order Delivered');
    public function show($id){
        $orders = OrderDetails::join('customer_address','order_details.idAddress','=','customer_address.id')
        ->join('orders','order_details.idOrder','=','orders.id')
        ->join('products','order_details.idProduct','=','products.id')
        ->join('customers','orders.idUser','=','customers.id')
        ->select('order_details.unit_price','order_details.subtotal','order_details.tax','order_details.delivery_charges','order_details.id as id','pic','orders.id as idBill','products.title','order_details.order_date','orderNumber','billNumber','orders.total as totalAmount','qty','status','order_details.total','modelNumber','city','area','state',DB::raw('IFNULL(address_street," ") as address_street'),DB::raw('IFNULL(address_house," ") as address'),DB::raw('IFNULL(landmark," ") as landmark'),'pincode','customers.name as username','customers.email','customers.mobile','order_details.updated_at','shipment_partner as partner','shipmentNumber as shipNo','ship_date as shipDate','shipment_detail as details','shipment_link as link')->where('order_details.id',$id)->first();
        if($orders == null) return redirect('/admin/orders');
        $orderItems = OrderDetails::where('idOrder',$orders->idBill)->get()->pluck('orderNumber','id')->toArray();
        $billItems = OrderDetails::join('products','order_details.idProduct','=','products.id')
        ->select('order_details.unit_price','order_details.subtotal','order_details.tax','pic','products.title','order_details.order_date','orderNumber','qty','status','order_details.total','order_details.updated_at')
        ->where('idOrder',$orders->idBill)->get();
        $orders->time = Carbon::parse($orders->updated_at)->format('h:i:s');
        unset($orders["updated_at"]);
        $response = array(
            'order' => $orders,
            'items' => $orderItems,
            'bill' => $billItems,
            'status' => OrdersController::$details,
            'current'=> OrdersController::$detailsMaping[$orders->status],
            'nextStatus' =>  OrdersController::$status[array_search($orders->status, OrdersController::$status)+1],
            'statusLabel' => OrdersController::$detailsLabel[$orders->status]
        );
        return view('admin.master.order-details',compact('response'));
    }

    public function update($id,Request $request){
        $orders = OrderDetails::find($id);
        $oldStatus = $orders->status;
        $data = $request->all();
        $data['ship_date'] = Carbon::parse($request['ship_date'])->format('Y-m-d');
        $orders->update($data);
        $panel = PanelData::whereIn('name',OrdersController::$status)->get();
        $isUpdated = false;
        if($panel->count() == 0){
            PanelData::insert([
                'name' => $data['status'],
                'value' => 1,
                'record_date' => Carbon::now()->format('Y-m-d')
            ]);
        }else{
            foreach($panel as $overview){
                if($overview->name == $oldStatus){
                    $map = PanelData::find($overview->id);
                    $addValue = $overview->value - 1 ;
                    if($addValue >= 0){
                        $map->update([
                            'value' => $addValue
                        ]);
                    }
                }
                if($overview->name == $data['status']){
                    $map = PanelData::find($overview->id);
                    $addValue = $overview->value + 1 ;
                    $map->update([
                        'value' => $addValue
                    ]);
                    $isUpdated = true;
                }
            }

            if(!$isUpdated){
                PanelData::insert([
                    'name' => $data['status'],
                    'value' => 1,
                    'record_date' => Carbon::now()->format('Y-m-d')
                ]);
            }
        }
        return response()->json([
            'result' => 1,
            'message' => 'Order updated'
        ]);
    }
}
