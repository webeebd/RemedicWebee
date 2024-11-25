@extends('front.layout')
@section('content')
<!-- cart section start -->
<section class="cart__section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="table-cart__title">
                    <h2 class="cart-title">your cart</h2>
                    
                </div>
            </div>
            <div class="col-lg-8">
                <div class="cart__form">
                    <table>
                        <thead>
                            <tr>
                                <th class="cart-pd__thumb">Product</th>
                                <th class="cart-pd__price">Unit Price</th>
                                <th class="cart-pd__qty">Quantity</th>
                                <th class="cart-pd__total">SubTotal</th>
                                <th class="cart-pd__action">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $subtotal = 0; $discount = 0; @endphp
                            
                            @if(!empty($cart))
                            @foreach($cart as $var)
                            
                            @php
                                $product = \App\Models\Products::where('id','=',$var['idProduct'])->first();
                                $subtotal += $product->sales_price * $var['qty'];
                               
                            @endphp
                            @if($product->pre_discount > 0 )
                            @php $discount += $product->max_retail_price - ($product->max_retail_price * $product->pre_discount /100);@endphp
                            @endif
                            <tr>
                                <td class="cart-pd__thumb">
                                    <div class="product-card--inline">
                                        <a href="#" class="product__image">
                                            <img src="{{ asset('storage/products/'.$product->pic)}}" alt="product" />
                                        </a>
                                        <div class="product__content">
                                            <h5 class="product__title">
                                                <a href="#">{{$product->name}}</a>
                                            </h5>
                                            <ul class="product__info">
                                                <li class="stock__item info-item">
                                                    @if(isset($var['amc']) && $var['amc'] == 'Y') 
                                                    AMC Included
                                                    @endif
                                                </li>
                                                <li style="font-size: 12px;">
                                                    @php $amc = \App\Models\AmcMaster::where('id','=',$product->amc_id)->first(); @endphp
                                                    @if(!empty($amc)) {{$amc->name}} {{$amc->description}} @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart-pd__price" data-title="Unit Price">৳ {{$product->sales_price}}</td>
                                <td class="cart-pd__qty" data-title="Quantity">
                                    <div class="quantity">
                                        <button type="button" class="decressQnt">
                                            <span class="bar"></span>
                                        </button>
                                        <input class="qnttinput" type="number" disabled value="{{$var['qty']}}" min="1"
                                               max="10" id='prdqty'/>
                                        <button type="button" class="incressQnt">
                                            <span class="bar"></span>
                                        </button>
                                    </div>
                                </td>
                                <td class="cart-pd__total" data-title="Total">৳ {{$product->sales_price * $var['qty']}}</td>
                                <td class="cart-pd__action" data-title="Action">
                                    <a type="button" class="action__btn" href="{{url('cart/'.$product->id.'/delete')}}">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.25 3.5H2.75M2.75 3.5H14.75M2.75 3.5V14C2.75 14.3978 2.90804 14.7794 3.18934 15.0607C3.47064 15.342 3.85218 15.5 4.25 15.5H11.75C12.1478 15.5 12.5294 15.342 12.8107 15.0607C13.092 14.7794 13.25 14.3978 13.25 14V3.5H2.75ZM5 3.5V2C5 1.60218 5.15804 1.22064 5.43934 0.93934C5.72064 0.658035 6.10218 0.5 6.5 0.5H9.5C9.89782 0.5 10.2794 0.658035 10.5607 0.93934C10.842 1.22064 11 1.60218 11 2V3.5M6.5 7.25V11.75M9.5 7.25V11.75"
                                                stroke="#667085" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                        <span>Delete</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">Your Cart is Empty.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                @if(!empty($cart))
                <div class="cart-order">
                    <h4 class="cart-order__title">Your Order Details</h4>
                    <ul class="cart__subtotal">
                        <li>
                            <span class="label">Subtotal</span>
                            <span class="value">৳ {{$subtotal}}</span>
                        </li>
                        <li>
                            <span class="label">Discount:</span>
                            <span class="value">৳ {{$discount}}</span>
                        </li>
                    </ul>
                    <div class="cart__total">
                        <h3>Total <span>(Incl. VAT)</span></h3>
                        <div class="total">৳ {{$subtotal - $discount}}</div>
                    </div>

                    <div class="cart__btns">
                        <a href="{{url('checkout')}}" class="btn btn-primary">Go To Checkout</a>
                        <!--<a href="{{url('shop')}}" class="btn btn-outline">Continue shopping</a>-->
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- cart section end -->
@stop