@extends('layouts.app')
@section('content')
<div class="page-header pattern-bg">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12 mb-2">
            <ol class="breadcrumb mb-2">
               <li class="breadcrumb-item"><a href="{{url('admin/home')}}" class="">Dashboard</a></li>
               <li class="breadcrumb-item active" aria-current="page">AMC Orders</li>
            </ol>
            <div class="d-flex justify-content-between align-items-center">
               <h1 class="h2 mb-md-0 text-white fw-light">AMC Management</h1>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="page-body">
        <div class="container-fluid">
            <div class="row g-2 row-deck">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                    <div class="card-body d-flex align-items-center p-xl-4 p-lg-3 p-2">
                        <div class="avatar lg rounded-circle no-thumbnail">
                            <i class="fa fa-folder-open fa-lg"></i>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                        <div class="text-muted">Total AMC Orders</div>
                        <div><span class="h6 fw-bold">0</span></div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                    <div class="card-body d-flex align-items-center p-xl-4 p-lg-3 p-2">
                        <div class="avatar lg rounded-circle no-thumbnail">
                            <i class="fa fa-folder-open fa-lg"></i>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                        <div class="text-muted">AMC Requests</div>
                        <div><span class="h6 fw-bold">0</span></div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                    <div class="card-body d-flex align-items-center p-xl-4 p-lg-3 p-2">
                        <div class="avatar lg rounded-circle no-thumbnail">
                            <i class="fa fa-cogs fa-lg"></i>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                        <div class="text-muted">In Progress</div>
                        <div><span class="h6 fw-bold">0</span></div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                    <div class="card-body d-flex align-items-center p-xl-4 p-lg-3 p-2">
                        <div class="avatar lg rounded-circle no-thumbnail">
                            <i class="fa fa-check-square-o fa-lg"></i>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                        <div class="text-muted">Closed AMC</div>
                        <div><span class="h6 fw-bold">0</span></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                           <span class="text-muted small mt-3">Based your preferences</span>
                           <h5 class="mb-0">Showing AMC Orders</h5><br>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0" id="amcorders">
                                <thead>
                                    <tr>
                                       <th>Order No</th>
                                       <th>AMC Name</th>
                                       <th>Product</th>
                                       <th>Quantity</th>
                                       <th>Validity</th>
                                       <th>Total Amount</th>
                                       <th>Status</th>
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
	$('#amcorders').DataTable({
            "pageLength": 100,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': @if(isset($data['url'])) "{{url('/admin-api/amc').'?'.$data['url']}}" @else "{{url('/admin-api/amc')}}" @endif,
                'beforeSend': function (request) {
                    request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
                }
            },
            'columns': [
                { data: 'order_no' },
                { data: 'name' },
                { data: 'product' },
                { data: 'qty' },
                { data: 'validity' },
                { data: 'total' },
                { data: 'status' },
                { data: 'action' },
            ]
        });
});
</script>
@stop