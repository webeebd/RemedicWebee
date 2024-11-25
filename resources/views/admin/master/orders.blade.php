@extends('layouts.app')
@section('content')
<div class="page-header pattern-bg">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12 mb-2">
            <ol class="breadcrumb mb-2">
               <li class="breadcrumb-item"><a href="{{url('admin/home')}}" class="">Dashboard</a></li>
               <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
            <div class="d-flex justify-content-between align-items-center">
               <h1 class="h2 mb-md-0 text-white fw-light">Order Management</h1>
                <div class="page-action">
                    <div class="btn-group">
                        <button type="button" class="btn dropdown-toggle after-none rounded-pill" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg viewBox="0 0 16 16" width="16px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10H5C5.26522 10 5.51957 10.1054 5.70711 10.2929C5.89464 10.4804 6 10.7348 6 11V14C6 14.2652 5.89464 14.5196 5.70711 14.7071C5.51957 14.8946 5.26522 15 5 15H2C1.73478 15 1.48043 14.8946 1.29289 14.7071C1.10536 14.5196 1 14.2652 1 14V11C1 10.7348 1.10536 10.4804 1.29289 10.2929C1.48043 10.1054 1.73478 10 2 10ZM11 1H14C14.2652 1 14.5196 1.10536 14.7071 1.29289C14.8946 1.48043 15 1.73478 15 2V5C15 5.26522 14.8946 5.51957 14.7071 5.70711C14.5196 5.89464 14.2652 6 14 6H11C10.7348 6 10.4804 5.89464 10.2929 5.70711C10.1054 5.51957 10 5.26522 10 5V2C10 1.73478 10.1054 1.48043 10.2929 1.29289C10.4804 1.10536 10.7348 1 11 1ZM11 10C10.7348 10 10.4804 10.1054 10.2929 10.2929C10.1054 10.4804 10 10.7348 10 11V14C10 14.2652 10.1054 14.5196 10.2929 14.7071C10.4804 14.8946 10.7348 15 11 15H14C14.2652 15 14.5196 14.8946 14.7071 14.7071C14.8946 14.5196 15 14.2652 15 14V11C15 10.7348 14.8946 10.4804 14.7071 10.2929C14.5196 10.1054 14.2652 10 14 10H11ZM11 0C10.4696 0 9.96086 0.210714 9.58579 0.585786C9.21071 0.960859 9 1.46957 9 2V5C9 5.53043 9.21071 6.03914 9.58579 6.41421C9.96086 6.78929 10.4696 7 11 7H14C14.5304 7 15.0391 6.78929 15.4142 6.41421C15.7893 6.03914 16 5.53043 16 5V2C16 1.46957 15.7893 0.960859 15.4142 0.585786C15.0391 0.210714 14.5304 0 14 0L11 0ZM2 9C1.46957 9 0.960859 9.21071 0.585786 9.58579C0.210714 9.96086 0 10.4696 0 11L0 14C0 14.5304 0.210714 15.0391 0.585786 15.4142C0.960859 15.7893 1.46957 16 2 16H5C5.53043 16 6.03914 15.7893 6.41421 15.4142C6.78929 15.0391 7 14.5304 7 14V11C7 10.4696 6.78929 9.96086 6.41421 9.58579C6.03914 9.21071 5.53043 9 5 9H2ZM9 11C9 10.4696 9.21071 9.96086 9.58579 9.58579C9.96086 9.21071 10.4696 9 11 9H14C14.5304 9 15.0391 9.21071 15.4142 9.58579C15.7893 9.96086 16 10.4696 16 11V14C16 14.5304 15.7893 15.0391 15.4142 15.4142C15.0391 15.7893 14.5304 16 14 16H11C10.4696 16 9.96086 15.7893 9.58579 15.4142C9.21071 15.0391 9 14.5304 9 14V11Z" fill="white"></path>
                            <path class="fill-secondary" d="M0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V5C0 5.53043 0.210714 6.03914 0.585786 6.41421C0.960859 6.78929 1.46957 7 2 7H5C5.53043 7 6.03914 6.78929 6.41421 6.41421C6.78929 6.03914 7 5.53043 7 5V2C7 1.46957 6.78929 0.960859 6.41421 0.585786C6.03914 0.210714 5.53043 0 5 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786Z"></path>
                            </svg>
                        </button>
                        <ul class="dropdown-menu border-0 shadow" style="">
                            <li><a class="dropdown-item" href="#"><b>Filter By</b></a></li>
                            <li>
                            <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">New Order</a></li>
                            <li><a class="dropdown-item" href="#">Shipped</a></li>
                            <li><a class="dropdown-item" href="#">Delivered</a></li>
                            <li><a class="dropdown-item" href="#">Cancelled</a></li>
                        </ul>
                        </div>  
                </div>  
            </div>
         </div>
      </div>
   </div>
</div>
<div class="page-body">
   <div class="container-fluid">
    <div class="row" id="catform">
                <div class="col-12" style="margin-bottom: 10px;">
                <div class="col-12">
                    <div class="card overflow-hidden">
                        <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 10%" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3 col-sm-6">
                                    <div class="card p-3">
                                        <div class="text-muted text-uppercase"><i class="fa fa-circle me-2 text-danger"></i>New Orders</div>
                                        <div class="mt-1">
                                        <span class="fw-bold h4 mb-0">{{$data["new"]}}</span>
                                        <span class="ms-1">0% <i class="fa fa-caret-up"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                <div class="card p-3">
                                    <div class="text-muted text-uppercase"><i class="fa fa-circle me-2 text-info"></i>In Progress</div>
                                    <div class="mt-1">
                                    <span class="fw-bold h4 mb-0">{{$data["accept"]}}</span>
                                    <span class="ms-1">0% <i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                <div class="card p-3">
                                    <div class="text-muted text-uppercase"><i class="fa fa-circle me-2 text-warning"></i>Shipped</div>
                                    <div class="mt-1">
                                    <span class="fw-bold h4 mb-0">{{$data["shipped"]}}</span>
                                    <span class="ms-1">0% <i class="fa fa-caret-up"></i></span>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                <div class="card p-3">
                                    <div class="text-muted text-uppercase"><i class="fa fa-circle me-2 text-success"></i>Delivered</div>
                                    <div class="mt-1">
                                    <span class="fw-bold h4 mb-0">{{$data["deliver"]}}</span>
                                    <span class="ms-1">0% <i class="fa fa-caret-up"></i></span>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <h5 class="mb-0 mt-3">Showing {{$data["total"]}} Orders</h5>
                        <span class="text-muted small">Based your preferences</span>
                    </div>
                    <div class="col-12 mt-3 card">
                    <div class="table-responsive card-body">
                        <table class="table align-middle" id="orders">
                            <thead>
                                <tr>
                                <th></th>
                                <th>Bill No</th>
                                <th>Order No</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Total Amount</th>
                                <th>Last Update</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
		</div>
   </div>
</div>
@stop
@section('script')
<script>
$(document).ready(function(){
	$('#orders').DataTable({
            "pageLength": 100,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': @if(isset($data['url'])) "{{url('/admin-api/orders').'?'.$data['url']}}" @else "{{url('/admin-api/orders')}}" @endif,
                'beforeSend': function (request) {
                    request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
                }
            },
            'columns': [
                { data: 'order_date' },
                { data: 'bill_no' },
                { data: 'order_no' },
                { data: 'name' },
                { data: 'mobile' },
                { data: 'product' },
                { data: 'qty' },
                { data: 'total' },
                { data: 'status' },
                { data: 'action' },
            ]
        });
});
</script>
@stop