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
                    
                    @foreach($orders as $ord)
                     @php $order_amc = \App\Models\AmcOrders::where('idOrder','=',$ord->id)
                                                                    ->first();
                     @endphp
                    @if(!empty($order_amc))
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
                               
                                
                            </tbody>
                        </table>
                        
                    </div>
                    @endif
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SideBar end -->
@stop