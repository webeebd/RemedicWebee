@extends('layouts.app')
@section('content')
    <div class="modal fade" id="edit_shipment" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-vertical right-side modal-dialog-scrollable">
            <div class="modal-content">
                <div class="px-xl-4 modal-header">
                    <h5 class="modal-title">Shipment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="px-xl-4 modal-body custom_scroll">
                    <form class="card-body" style="width:400px;">
                        <div class="setting-more mb-4">
                            <div class="mb-2">
                                <label class="form-label small mb-0 p-1">Shipment Company</label>
                                <input id="font_url" type="text" class="form-control" placeholder="DHL">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small mb-0 p-1">Shipment Number</label>
                                <input id="font_family" type="text" class="form-control" placeholder="DR958958">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small mb-0 p-1">Shipment Date</label>
                                <input id="font_family" type="text" class="form-control datepicker" placeholder="12-01-2022">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small mb-0 p-1">Tracking Url</label>
                                <input id="font_family" type="text" class="form-control" placeholder="https://e.com/958674">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small mb-0 p-1">Helpline Number</label>
                                <input id="font_family" type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        
                     </form>    
                </div>
                <div class="px-xl-4 modal-footer d-flex justify-content-start text-center">
                    <div class="spinner-border text-primary" role="status" style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    <button type="button" class="btn flex-fill btn-primary lift"  @click="updateShipment()">Save Changes</button>
                    <button type="button" class="btn flex-fill btn-white border lift" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
       </div>
    </div>

    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><router-link to="/admin/orders">Orders</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">Orders Details</li>
                </ol>
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h2 mb-md-0 text-white fw-light">Order No : # {{$response['order']['orderNumber']}}</h1>
                    <div class="page-action">
                        <button class="btn d-none d-sm-inline-flex rounded-pill" data-bs-toggle="modal" data-bs-target="#edit_shipment" type="button">
                        <span class="me-1 d-none d-lg-inline-block">Shipment</span>
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0V0Z" fill="white"></path>
                        </svg>
                        </button>
                        <button class="btn d-none d-sm-inline-flex bg-secondary rounded-pill" type="button">
                        <span class="me-1 d-none d-lg-inline-block">Invoice</span>
                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.64602 9.354C7.69247 9.40056 7.74764 9.43751 7.80839 9.46271C7.86913 9.48792 7.93425 9.50089 8.00002 9.50089C8.06579 9.50089 8.13091 9.48792 8.19165 9.46271C8.2524 9.43751 8.30758 9.40056 8.35402 9.354L10.354 7.354C10.4005 7.30751 10.4374 7.25232 10.4625 7.19158C10.4877 7.13084 10.5007 7.06574 10.5007 7C10.5007 6.93426 10.4877 6.86916 10.4625 6.80842C10.4374 6.74768 10.4005 6.69249 10.354 6.646C10.3075 6.59951 10.2523 6.56264 10.1916 6.53748C10.1309 6.51232 10.0658 6.49937 10 6.49937C9.93428 6.49937 9.86918 6.51232 9.80844 6.53748C9.7477 6.56264 9.69251 6.59951 9.64602 6.646L8.50002 7.793V4C8.50002 3.86739 8.44734 3.74021 8.35358 3.64645C8.25981 3.55268 8.13263 3.5 8.00002 3.5C7.86741 3.5 7.74024 3.55268 7.64647 3.64645C7.5527 3.74021 7.50002 3.86739 7.50002 4V7.793L6.35402 6.646C6.26013 6.55211 6.1328 6.49937 6.00002 6.49937C5.86725 6.49937 5.73991 6.55211 5.64602 6.646C5.55213 6.73989 5.49939 6.86722 5.49939 7C5.49939 7.13278 5.55213 7.26011 5.64602 7.354L7.64602 9.354Z" fill="white"></path>
                            <path d="M4.406 1.842C5.40548 0.980135 6.68024 0.504139 8 0.5C10.69 0.5 12.923 2.5 13.166 5.079C14.758 5.304 16 6.637 16 8.273C16 10.069 14.502 11.5 12.687 11.5H3.781C1.708 11.5 0 9.866 0 7.818C0 6.055 1.266 4.595 2.942 4.225C3.085 3.362 3.64 2.502 4.406 1.842ZM5.059 2.599C4.302 3.252 3.906 4.039 3.906 4.655V5.103L3.461 5.152C2.064 5.305 1 6.452 1 7.818C1 9.285 2.23 10.5 3.781 10.5H12.687C13.98 10.5 15 9.488 15 8.273C15 7.057 13.98 6.045 12.687 6.045H12.187V5.545C12.188 3.325 10.328 1.5 8 1.5C6.91988 1.50431 5.87684 1.89443 5.059 2.6V2.599Z" fill="white"></path>
                        </svg>
                        </button>
                        <div class="btn-group">
                        <button type="button" class="btn dropdown-toggle after-none rounded-pill" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg viewBox="0 0 16 16" width="16px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10H5C5.26522 10 5.51957 10.1054 5.70711 10.2929C5.89464 10.4804 6 10.7348 6 11V14C6 14.2652 5.89464 14.5196 5.70711 14.7071C5.51957 14.8946 5.26522 15 5 15H2C1.73478 15 1.48043 14.8946 1.29289 14.7071C1.10536 14.5196 1 14.2652 1 14V11C1 10.7348 1.10536 10.4804 1.29289 10.2929C1.48043 10.1054 1.73478 10 2 10ZM11 1H14C14.2652 1 14.5196 1.10536 14.7071 1.29289C14.8946 1.48043 15 1.73478 15 2V5C15 5.26522 14.8946 5.51957 14.7071 5.70711C14.5196 5.89464 14.2652 6 14 6H11C10.7348 6 10.4804 5.89464 10.2929 5.70711C10.1054 5.51957 10 5.26522 10 5V2C10 1.73478 10.1054 1.48043 10.2929 1.29289C10.4804 1.10536 10.7348 1 11 1ZM11 10C10.7348 10 10.4804 10.1054 10.2929 10.2929C10.1054 10.4804 10 10.7348 10 11V14C10 14.2652 10.1054 14.5196 10.2929 14.7071C10.4804 14.8946 10.7348 15 11 15H14C14.2652 15 14.5196 14.8946 14.7071 14.7071C14.8946 14.5196 15 14.2652 15 14V11C15 10.7348 14.8946 10.4804 14.7071 10.2929C14.5196 10.1054 14.2652 10 14 10H11ZM11 0C10.4696 0 9.96086 0.210714 9.58579 0.585786C9.21071 0.960859 9 1.46957 9 2V5C9 5.53043 9.21071 6.03914 9.58579 6.41421C9.96086 6.78929 10.4696 7 11 7H14C14.5304 7 15.0391 6.78929 15.4142 6.41421C15.7893 6.03914 16 5.53043 16 5V2C16 1.46957 15.7893 0.960859 15.4142 0.585786C15.0391 0.210714 14.5304 0 14 0L11 0ZM2 9C1.46957 9 0.960859 9.21071 0.585786 9.58579C0.210714 9.96086 0 10.4696 0 11L0 14C0 14.5304 0.210714 15.0391 0.585786 15.4142C0.960859 15.7893 1.46957 16 2 16H5C5.53043 16 6.03914 15.7893 6.41421 15.4142C6.78929 15.0391 7 14.5304 7 14V11C7 10.4696 6.78929 9.96086 6.41421 9.58579C6.03914 9.21071 5.53043 9 5 9H2ZM9 11C9 10.4696 9.21071 9.96086 9.58579 9.58579C9.96086 9.21071 10.4696 9 11 9H14C14.5304 9 15.0391 9.21071 15.4142 9.58579C15.7893 9.96086 16 10.4696 16 11V14C16 14.5304 15.7893 15.0391 15.4142 15.4142C15.0391 15.7893 14.5304 16 14 16H11C10.4696 16 9.96086 15.7893 9.58579 15.4142C9.21071 15.0391 9 14.5304 9 14V11Z" fill="white"></path>
                            <path class="fill-secondary" d="M0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V5C0 5.53043 0.210714 6.03914 0.585786 6.41421C0.960859 6.78929 1.46957 7 2 7H5C5.53043 7 6.03914 6.78929 6.41421 6.41421C6.78929 6.03914 7 5.53043 7 5V2C7 1.46957 6.78929 0.960859 6.41421 0.585786C6.03914 0.210714 5.53043 0 5 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786Z"></path>
                            </svg>
                        </button>
                        <ul class="dropdown-menu border-0 shadow" style="">
                            <li><a class="dropdown-item" href="#">Cancel Order</a></li>
                            <li><a class="dropdown-item" href="#">Mark as Packing</a></li>
                            <li><a class="dropdown-item" href="#">Mark as Delivered</a></li>
                        </ul>
                        </div>                        
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body page-layout-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="app-social d-flex flex-nowrap align-items-start">
                        <div class="order-1 sticky-lg-top shadow-sm">
                            <ul class="nav nav-tabs menu-list list-unstyled mb-0 border-0" role="tablist">
                                <li class="text-uppercase text-muted"><small>Booking Information</small></li>
                                <hr/>
                                <li class="text-muted"><small>Booking No</small></li>
                                <li class="mb-3"><i class="fa fa-hashtag"></i><span><b>{{$response['order']['billNumber']}}</b></span></li>
                                <li class="text-muted"><small>Total Amount (৳)</small></li>
                                <li class="mb-3"><b>৳{{$response['order']['totalAmount']}}</b></li>
                                <li class="text-muted"><small>Booking Date</small></li>
                                <li class="mb-3"><b>{{\Carbon\Carbon::parse($response['order']['order_date'])->format('d-m-Y')}}</b></li>
                                @if(count($response['items']) > 0)
                                <li class="divider mt-4 py-2 border-top text-uppercase text-muted">
                                    <small>Related Orders</small>
                                </li>
                                @foreach($response['items'] as $key => $value)
                                <li>
                                    <a class="m-link" @if($value == $response['order']['orderNumber']) href="#" @else href="/admin/orders/{{$key}}" @endif><i class="fa fa-hashtag"></i><span>{{$value}}</span></a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                            
                        </div>
                        <div class="order-2 flex-grow-1 ps-md-3 ps-0">
                            <div class="row g-3">
                                <div class="col-sm-12">
                                    <div class="card mb-3">
                                       <div class="card-body">
                                        <h6 class="card-title d-flex justify-content-between align-items-center">Order Summary</h6>
                                        <table id="contact_list" class="table align-middle mb-0 card-table mt-4">
                                        <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Qty.</th>
                                            <th>Price</th>
                                            <th>Total Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody> 
                                            <tr>
                                                <td>{{$response['order']['title']}}</td>
                                                <td>{{$response['order']['qty']}}</td>
                                                <td>৳{{$response['order']['unit_price']}}</td>
                                                <td>৳{{$response['order']['unit_price'] * $response['order']['qty']}}</td>
                                            </tr>
                                        </tbody>
                                        </table> 
                                        
                                        <ul class="resume-box ps-0 pb-0 mb-0">
                                            <li>
                                                <div class="icon text-center">
                                                <i class="fa fa-map-marker"></i>
                                                </div>
                                                <div class="fw-bold mb-0">Delivery Address</div>
                                                <span>{{$response['order']['address_street']}} {{$response['order']['address']}}, {{$response['order']['area']}} {{$response['order']['landmark']}} {{$response['order']['city']}}, {{$response['order']['pincode']}}</span>
                                            </li>
                                            <li>
                                                <div class="icon text-center">
                                                <i class="fa fa-mobile"></i>
                                                </div>
                                                <div class="fw-bold mb-0">Mobile</div>
                                                <span>+880 {{$response['order']['mobile']}}</span>
                                            </li>
                                            <li>
                                                <div class="icon text-center">
                                                <i class="fa fa-envelope"></i>
                                                </div>
                                                <div class="fw-bold mb-0">Email Address</div>
                                                <span>{{$response['order']['email']}}</span>
                                            </li>
                                        </ul>  

                                       </div>         
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body row">
                                            <div class="col-sm-6">
                                                <h6 class="card-title d-flex justify-content-between align-items-center">Order Timeline</h6>
                                                
                                                <div class="card-body custom_scroll" style="height: 300px; scroll-behavior: smooth;">
                                                        <ul class="timeline-activity list-unstyled mb-0">
                                                        <li class="activity px-3 py-2 mb-1" data-date="{{\Carbon\Carbon::parse($response['order']['order_date'])->format('d-m-Y')}}">
                                                            <div class="fw-bold small d-flex justify-content-between align-items-center">New Order <span class="badge bg-warning">#{{$response['order']['orderNumber']}}</span></div>
                                                            <div>
                                                            <small class="text-muted">{{$response['order']['qty']}}, {{$response['order']['title']}}</small>
                                                            </div>
                                                        </li>
                                                        <li class="activity px-3 py-2 mb-1" data-date="{{\Carbon\Carbon::parse($response['order']['order_date'])->format('d-m-Y')}}">
                                                            <div class="fw-bold small">Order Received</div>
                                                            <div>
                                                            </div>
                                                        </li>
                                                        @php $payment = DB::table('order_payments')->where('idOrder',$response['order']['idBill'])->first();@endphp
                                                        <li class="activity px-3 py-2 mb-1" data-date="{{\Carbon\Carbon::parse($response['order']['order_date'])->format('d-m-Y')}}">
                                                            <div class="fw-bold small">Payment Verify</div>
                                                            <div>
                                                            <p class="mb-0 text-success">{{strtoupper($payment->payment_mode)}}</p>
                                                            @if($payment->payment_mode == "cash")
                                                            <small class="text-muted">৳{{$response['order']['total']}} - Not Paid</small>
                                                            @else
                                                            <small class="text-muted">৳{{$response['order']['total']}} - Done</small>
                                                            @endif
                                                            </div>
                                                        </li>

                                                        @if($response['order']['status'] == "Cancelled")
                                                        <li class="activity px-3 py-2 mb-1" data-date="{{\Carbon\Carbon::parse($response['order']['order_date'])->format('d-m-Y')}}">
                                                            <div class="fw-bold small d-flex justify-content-between align-items-center">Order Cancelled<span class="badge bg-danger">Cancelled</span></div>
                                                        </li>
                                                        @endif

                                                        <!--
                                                        <li class="activity px-3 py-2 mb-1" data-date="12:35 - Sun">
                                                            <div class="fw-bold small">Order inprogress</div>
                                                            <div>
                                                            <label class="me-2"></label>
                                                            </div>
                                                        </li>

                                                        <li class="activity px-3 py-2 mb-1" data-date="12:55 - Sun">
                                                            <div class="fw-bold small">Delivery on the way</div>
                                                            <div>
                                                            <p class="mb-1 small text-muted"><i class="fa fa-map-marker ps-1"></i> {{$response['order']['address_street']}} {{$response['order']['address']}}, {{$response['order']['area']}} {{$response['order']['landmark']}}</p>
                                                            <label class="ms-1">{{$response['order']['city']}}, {{$response['order']['pincode']}}</label>
                                                            </div>
                                                        </li>
                                                        <li class="activity px-3 py-2 mb-1" data-date="01:10 - Sun">
                                                            <div class="fw-bold small d-flex justify-content-between align-items-center">Delivery<span class="badge bg-success">Done</span></div>
                                                        </li>-->
                                                        </ul>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <h6 class="card-title mb-3">Order Information</h6>
                                                <div class="d-flex align-items-center my-4">
                                                    <img class="avatar lg rounded" src="/storage/products/{{$response['order']['pic']}}" width="50" height="50">
                                                        <div class="flex-fill ms-3">
                                                            <div class="h6 mb-1">{{$response['order']['title']}}</div>

                                                            @if($response['order']['status'] == "New Order")
                                                            <span class="badge bg-primary">New Order</span>
                                                            @endif
                                                            @if($response['order']['status'] == "Shipped")
                                                            <span class="badge bg-warning">Shipped</span>
                                                            @endif
                                                            @if($response['order']['status'] == "In Progress")
                                                            <span class="badge bg-info">In Progress</span>
                                                            @endif
                                                            @if($response['order']['status'] == "Delivered")
                                                            <span class="badge bg-success">Delivered</span>
                                                            @endif
                                                            @if($response['order']['status'] == "Cancelled")
                                                            <span class="badge bg-danger">Cancelled</span>
                                                            @endif
                                                        </div>
                                                </div>
                                                <div>
                                                    <span class="text-muted d-block">Total Amount</span>
                                                    <h4>৳{{$response['order']['total']}}</h4>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-bordered mb-0">
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">Subtotal:</th>
                                                            <td>৳{{$response['order']['subtotal']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Payment: </th>
                                                            <td><span class="badge bg-primary">{{strtoupper($payment->payment_status)}}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Tax:</th>
                                                            <td>৳{{$response['order']['tax']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Delivery Fee:</th>
                                                            <td>৳{{$response['order']['delivery_charges'] ?? '0'}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body">

                                        <h6 class="card-title d-flex justify-content-between align-items-center">Bill Item</h6>
                                        <table class="table display dataTable table-hover nowrap no-footer dtr-inline collapsed">
                                        <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Qty.</th>
                                            <th>Price</th>
                                            <th>Total Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody> 
                                            @foreach($response['bill'] as $var)
                                            <tr>
                                                <td>{{$var['title']}}</td>
                                                <td>{{$var['qty']}}</td>
                                                <td>৳{{$var['unit_price']}}</td>
                                                <td>৳{{$var['unit_price'] * $var['qty']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>  

                                                                                  
                                        </div>
                                    </div>
                                </div>
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
    $(function() {

    })
</script>
@stop