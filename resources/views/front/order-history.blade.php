@extends('front.layout')
@section('content')
<!-- SideBar start -->
<div class="user__dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
               @include('front.partials.dashboard-sidebar')
            </div>

            <div class="col-lg-9">
                <div class="main__wrapper">
                    <div class="dashboard__title">
                        <h4 class="title">Order List</h4>
                    </div>
                    <div class="dashboard__inner">
                        <form method="GET" class="search__form m-0">
                            <input type="search" class="form-control" name="search"
                                   placeholder="Search Your Order" />
                            <button type="submit">
                                <img src="front/assets/images/search.png" alt="search" />
                            </button>
                        </form>
                        <div class="custom__dropdown">
                            <div class="selected">
                                <div class="title">show:</div>
                                <div class="selected_item selected_item-v2">Last 6 Months</div>
                            </div>
                            <ul class="list list__v2">
                                <li>Last 6 Months</li>
                                <li>Last 5 Months</li>
                                <li>Last 4 Months</li>
                                <li>Last 3 Months</li>
                                <li>Last 2 Months</li>
                            </ul>
                        </div>
                    </div>
                    @foreach($orders as $ord)
                    <div class="cart__form cart__form--v2">
                        <table>
                            <thead>
                                <tr>
                                    <th class="cart-pd__thumb">
                                        Order Id : #{{$ord->billNumber}}
                                        <span>Order on {{\Carbon\Carbon::parse($ord->order_date)->format('d-m-Y')}}</span>
                                    </th>
                                    <td class="cart-pd__status" data-title="Status">
                                        <div class="status">&nbsp;</div>
                                    </td>
                                    <th class="cart-pd__qty">&nbsp;</th>
                                    <th class="cart-pd__action text-end">
                                        ৳ {{$ord->total}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $order_dets = \App\Models\OrderDetails::where('idOrder', '=', $ord->id)->orderBy('id', 'desc')->get(); @endphp
                                @foreach($order_dets as $det)
                                @php $product = \App\Models\Products::where('id','=',$det->idProduct)->first(); @endphp
                                <tr>
                                    <td class="cart-pd__price"> {{$det->orderNumber}}</td>
                                    <td class="cart-pd__thumb">
                                        <div class="product-card--inline">
                                            <a href="product-single.html" class="product__image">
                                                <img src="{{ asset('storage/products/'.$product->pic)}}" alt="product" />
                                            </a>
                                            <div class="product__content">
                                                <h5 class="product__title">
                                                    <a href="#">{{$product->title}}</a>
                                                </h5>
                                                <h5 class="product__price">Price: <span>৳ {{$det->unit_price}} x {{$det->qty}}</span></h5>
                                            </div>
                                        </div>
                                        <div class="product-card--inline">
                                            @php $order_amc = \App\Models\AmcOrders::where('idOrder','=',$ord->id)
                                                                    ->where('idProduct','=',$product->id)
                                                                    ->first();
                                            @endphp
                                            @if(!empty($order_amc))
                                            @php $amc = \App\Models\AmcMaster::where('id','=',$product->amc_id)->first(); @endphp

                                            <ul class="product__info">
                                                <li class="info-item"  style="color:green;font-weight:bold;">
                                                    AMC Included.
                                                    ৳  {{$amc->price * $det->qty}}
                                                </li>
                                                @if(!empty($amc))
                                                <li class="info-item"  style="color:green;font-weight:bold;">
                                                    {{$amc->name}} 


                                                </li>
                                                @endif
                                            </ul>
                                            @endif
                                        </div>
                                    </td>
                                   
                                    <td class="cart-pd__price" data-title="Unit Price">৳ {{$det->subtotal}}</td>
                                    <td class="cart-pd__action text-end" data-title="Action">
                                        <div class="btn__group">
                                            <a href="#" class="success__btn">{{$det->status}}</a>
<!--                                            <button type="button"
                                                    class="btn-small-outline btn-gray ml-10">Cancel</button>-->
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SideBar end -->
@stop