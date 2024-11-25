@extends('front.layout')
@section('content')
<section class="order__confirm">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="returm__message text-center">
                    <h5 class="sub__title"><i class="fa-regular fa-circle-check"></i>Your Order Successfully
                        Submitted</h5>
                    <h2 class="title">Thanks for your purchase</h2>
                    <p class="content">Hi {{Auth::user()->name}}, we have received your order and are getting it ready to be shipped.
                        We will notify you when it’s on its way!</p>
                </div>
                <div class="order__details text-center">
                    <div class="order__info">Order No<span>#{{$order->billNumber}}</span></div>
                    <div class="order__info">Order Date<span>{{\Carbon\Carbon::parse($order->order_date)->format('d-m-Y')}}</span></div>
                    <div class="order__info">Shipping Address
                        @php $address = \App\Models\CustomerAddress::where('id','=',$order->idAddress)->first(); @endphp
                        <span>
                            {{$address->area}},{{$address->city}}
                        </span>
                    </div>
                    <div class="order__info">Payment Method<span>{{$order_payment->payment_mode}}</span></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Order Confirm Section End -->
<!-- cart section start -->
<section class="cart__section">
    <div class="container">
       
        <div class="row">
            <div class="col-12">
                <div class="cart__form">
                    <table>
                        <thead>
                            <tr>
                                <th class="cart-pd__thumb">Product</th>
                                <th class="cart-pd__qty">Quantity</th>
                                <th class="cart-pd__date">Date</th>
                                <th class="cart-pd__status">Status</th>
                                <th class="cart-pd__price">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_details as $det)
                            @php $product = \App\Models\Products::where('id','=',$det->idProduct)->first(); @endphp
                            @if(!empty($product))
                            <tr>
                                <td class="cart-pd__thumb">
                                    <div class="product-card--inline">
                                        <a href="#" class="product__image">
                                            <img src="{{ asset('storage/products/'.$product->pic)}}" alt="product" />
                                        </a>
                                        <div class="product__content">
                                            <h5 class="product__title">
                                                <a href="#">{{$product->title}}</a>
                                            </h5>
                                            @php $order_amc = \App\Models\AmcOrders::where('idOrder','=',$order->id)
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
                                    </div>
                                </td>
                                <td class="cart-pd__qty" data-title="Quantity">{{$det->qty}}</td>
                                <td class="cart-pd__date text-start" data-title="Date">
                                    Order on <br />
                                    {{\Carbon\Carbon::parse($det->order_date)->format('d-m-Y')}}
                                </td>
                                <td class="cart-pd__status" data-title="Status">
                                    <div class="status">{{$det->status}}</div>
                                </td>
                                <td class="cart-pd__Price" data-title="Price">৳ {{$det->subtotal}}</td>
                            </tr>
                            @endif
                            @endforeach
                            
                            <tr>
                                <td class="border-none pb-0">&nbsp;</td>
                                <td class="border-none pb-0">&nbsp;</td>
                                <td class="border-none pb-0">&nbsp;</td>
                                <td class="border-none pb-0 text-end">Subtotal</td>
                                <td class="border-none pb-0">৳ {{$order->subtotal}}</td>
                            </tr>
                            <tr>
                                <td class="border-none pb-0">&nbsp;</td>
                                <td class="border-none pb-0">&nbsp;</td>
                                <td class="border-none pb-0">&nbsp;</td>
                                <td class="border-none pb-0 text-end">Delivery Charge</td>
                                <td class="border-none pb-0"></td>
                            </tr>
                            <tr>
                                <td class="border-none pb-0">&nbsp;</td>
                                <td class="border-none pb-0">&nbsp;</td>
                                <td class="border-none pb-0">&nbsp;</td>
                                <td class="text-end">Discount</td>
                                <td>৳ {{$order->discount}}</td>
                            </tr>
                            <tr>
                                <td class="border-none pt-10">&nbsp;</td>
                                <td class="border-none pt-10">&nbsp;</td>
                                <td class="border-none pt-10">&nbsp;</td>
                                <td class="border-none pt-10 text-end"><strong>Total</strong></td>
                                <td class="border-none pt-10"><strong>৳ {{$order->total}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- cart section end -->
@stop