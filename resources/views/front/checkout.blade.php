@extends('front.layout')
@section('content')
<style>
    .form__wrapper .checkbox, .form__wrapper [type="checkbox"]{
        opacity: 1;
        position: relative;
    }
</style>
<!-- Checkout Section Start -->
<section class="checkout__section">
    <div class="container">
        <form method="post" action="{{url('/checkout')}}" class="form__wrapper">
            @csrf
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="checkout__form" id="shipping_details">
                        <div class="step-header mb-30">
                            <span class="step-num">1</span>
                            <h3 class="step-title">Shipping Details</h3>
                        </div>
                        <h5 class="sub-title">Select Shipping Address</h5>
                        @foreach($user_addresses as $addr)
                        <div class="form-group form-check">
                            <input type="radio" name="idAddress" style="width: 22px;height: 22px;" value="{{$addr->id}}" class="form-check-input">
                            <label class="form-check-label" style="padding-top:5px;">
                                <span>{{$addr->address_house}} , {{$addr->address_street}}</span>
                                <span class="desc">{{$addr->area}},{{$addr->landmark}},{{$addr->city}},{{$addr->state}},{{$addr->pincode}}</span>
                            </label>
                        </div>
                        @endforeach
                        @if ($errors->has('idAddress'))
                        <label id="minmaxlength-error" class="error" for="minmaxlength" style="color:red;">
                            <strong>{{ $errors->first('idAddress') }}</strong>
                        </label>
                        @endif
                        <div class="devider text-center" style="padding: 30px 0px">- OR -</div>
                        <h5 class="sub-title">Enter New Shipping Address</h5>

                            <div class="flex__form c-2">
                                <div class="form-group">
                                    <label for="f_name"> House/Flat No</label>
                                    <input type="text" name="address_house" id="f_name" class="form-control"
                                           placeholder="House/Flat No" />
                                </div>
                                <div class="form-group">
                                    <label for="f_name">Street Name</label>
                                    <input type="text" name="address_street" id="f_name" class="form-control"
                                           placeholder="Street Name"/>
                                </div>
                            </div>
                            <div class="flex__form c-2">
                                <div class="form-group">
                                    <label for="f_name">Area</label>
                                    <input type="text" name="area" id="f_name" class="form-control"
                                           placeholder="Enter Area" />
                                </div>
                                <div class="form-group">
                                    <label for="f_name">Landmark</label>
                                    <input type="text" name="landmark" id="f_name" class="form-control"
                                           placeholder="Landmark"  />
                                </div>
                            </div>
                            <div class="flex__form c-2">
                                <div class="form-group">
                                    <label for="f_name">City</label>
                                    <input type="text" name="city" id="f_name" class="form-control"
                                           placeholder="Enter Area" />
                                </div>
                                <div class="form-group">
                                    <label for="f_name">State</label>
                                    <input type="text" name="state" id="f_name" class="form-control"
                                           placeholder="State"  />
                                </div>
                                <div class="form-group">
                                    <label for="f_name">Pincode</label>
                                    <input type="text" name="pincode" id="f_name" class="form-control"
                                           placeholder="Pincode"  />
                                </div>
                            </div>

                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="cart-order cart-order__v2">
                        <h4 class="cart-order__title">Your Order Details</h4>
                        <div class="cart__items">
                            @php $subtotal = 0; $discount = 0; @endphp

                            @if(!empty($cart))
                            @foreach($cart as $var)

                                @php
                                $product = \App\Models\Products::where('id','=',$var['idProduct'])->first();
                                

                                @endphp
                                @if($product->pre_discount > 0 )
                                @php $discount += ($product->max_retail_price * $product->pre_discount /100);@endphp
                                @endif
                            <!-- Shopping Cart Item Start -->
                                <div class="shopping-card shopping-card__v2">
                                    <a href="#" class="shopping-card__image">
                                        <img src="{{ asset('storage/products/'.$product->pic)}}" alt="cart-product" />
                                    </a>
                                    <div class="shopping-card__content">
                                        <div class="shopping-card__content-top">
                                            <h5 class="product__title">
                                                <a href="#">{{$product->name}}</a>
                                            </h5>
                                            <h5 class="product__price" style="color:orangered;">৳ {{$product->max_retail_price * $var['qty']}}</h5>
                                        </div>
                                        <div class="shopping-card__content-bottom">
                                            <button type="button" class="action__btn qty">Qty: {{$var['qty']}}</button>
                                           
                                        </div>
                                        @php $amc = \App\Models\AmcMaster::where('id','=',$product->amc_id)->first(); @endphp
                                        @if(isset($var['amc']) && $var['amc'] == 'Y') 
                                        
                                        <div class="shopping-card__content-bottom">
                                              <p style="color:green;"><strong>AMC Included @if(!empty($amc)): ৳ {{$amc->price * $var['qty']}} @endif</strong></p>
                                             
                                        </div>
                                        @endif
                                        @if(isset($var['amc']) && $var['amc'] == 'Y') 
                                        <div class="shopping-card__content-bottom">
                                             <p>@if(!empty($amc)) AMC Details: {{$amc->name}} {{$amc->description}} @endif</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @if(!empty($amc))
                                 @php $subtotal += ($product->max_retail_price * $var['qty'])+ ($amc->price * $var['qty']) @endphp
                                @else
                                    @php $subtotal += $product->max_retail_price * $var['qty']; @endphp
                                @endif
                            @endforeach
                            @endif
                            <!-- Shopping Cart Item End -->
                            <!-- Shopping Cart Item Start -->

                        </div>
                        <ul class="cart__subtotal cart__subtotal__v2">
                            
                            <li>
                                <span class="label">Subtotal</span>
                                <span class="value">৳ {{$subtotal}}</span>
                                <input type="hidden" name="subtotal" value="{{$subtotal}}">
                            </li>
                            <li>
                                <span class="label">Discount:</span>
                                <span class="value">৳ {{$discount}}</span>
                                <input type="hidden" name="discount" value="{{$discount}}">
                            </li>
                            <li>
                                <span class="label">Discount Coupon:</span>
                                <span class="value"></span>
                            </li>
                        </ul>
                        <div class="cart__total cart__total__v2">
                            <h3>Total <span>(Incl. VAT)</span></h3>
                            @php $total = $subtotal - $discount;@endphp
                            <div class="total">৳ {{$subtotal - $discount}}</div>
                            <input type="hidden" name="total" value="{{$total}}">
                        </div>
                    </div>
                    <div class="checkout__form" id="payment_details" style="margin-top:20px;">
                        <div class="step-header mb-30">
                            <span class="step-num">3</span>
                            <h3 class="step-title">Payment Details</h3>
                        </div>

                            <div class="form__wrapper">
                                <!-- Accordion Start -->
                                <div class="accordion__wrapper payment__wrapper">
                                    <div class="accordion accordion-flush" id="accordionFlushExample02">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapse001" aria-expanded="true" aria-controls="flush-collapse001" id="flush-heading001" style="padding:10px;height:50px;">
                                                <span style="width: auto;float:left;font-size: 14px;font-weight: 500;">Credit / Debit Card</span>
                                                <input type="radio" name="payment_mode" value="Paypal" style="float:right;height:18px;width: 18px;">
                                            </h2>
                                            <div id="flush-collapse001" class="accordion-collapse collapse"
                                                 aria-labelledby="flush-heading001"
                                                 data-bs-parent="#accordionFlushExample02">
                                                <div class="accordion-body">
                                                    <div class="form-group">
                                                        <label for="number">Card number</label>
                                                        <input type="number" name="cardNumber" id="number"
                                                               class="form-control"  placeholder="Card number" />
                                                        <div class="c-icon"><i
                                                                class="fa-regular fa-circle-question"></i></div>
                                                    </div>
                                                    <div class="flex__form col_2">
                                                        <div class="form-group">
                                                            <label for="date">Expiration Date</label>
                                                            <input type="number" name="expirationDate" id="date"
                                                                   class="form-control"  placeholder="MM / YY" />
                                                            <div class="c-icon"><i class="fa-regular fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cvc">CVC</label>
                                                            <input type="number" name="cvc" id="cvc"
                                                                   class="form-control" 
                                                                   placeholder="Enter your CVC" />
                                                            <div class="c-icon"><i
                                                                    class="fa-solid fa-circle-exclamation"></i></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Cardholder Name</label>
                                                        <input type="text" name="cardholder" id="name" class="form-control"
                                                                placeholder="Enter your cardholder name" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapse002" aria-expanded="true" aria-controls="flush-collapse002" id="flush-heading002" style="padding:10px;height:50px;">
                                                <img src="front/assets/images/paypal.png" alt="Paypal" style="height:30px;width: auto;float:left;"/>
                                                <input type="radio" name="payment_mode" value="Paypal" style="float:right;height:18px;width: 18px;">
                                            </h2>
                                            <div id="flush-collapse002" class="accordion-collapse collapse"
                                                 aria-labelledby="flush-heading002"
                                                 data-bs-parent="#accordionFlushExample02">
                                                <div class="accordion-body">
                                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vitae
                                                        quidem magnam nam, optio unde perferendis? Harum modi sunt
                                                        necessitatibus minima.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapse003" aria-expanded="true" aria-controls="flush-collapse003" id="flush-heading003" style="padding:10px;height:50px;">
                                                <img src="front/assets/images/cash.png" alt="cash" style="height:30px;width: auto;float:left;"/>
                                                <span style="font-size:14px;width: auto;float:left;padding-left: 10px">Cash</span>
                                                <input type="radio" name="payment_mode" value="COD" style="float:right;height:18px;width: 18px;">
                                            </h2>
                                            <div id="flush-collapse003" class="accordion-collapse collapse  show"
                                                 aria-labelledby="flush-heading003"
                                                 data-bs-parent="#accordionFlushExample02">
                                                <div class="accordion-body">
                                                    <p>Cash On Delivery</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Accordion End -->
                            </div>
                            <div class="coupon"><a href="#">Do you have a coupon?</a></div>
                            <div class="cta__form justify-content-start align-items-end mt-15">
                                <div class="form-group">
                                    <label for="numbers">Coupon</label>
                                    <input type="number" name="discount_coupon" id="numbers" class="form-control border"
                                           placeholder="Enter Coupon Code" />
                                </div>
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>
                            <div class="form__wrapper">
                                <div class="input-info__save mt-15">
                                    <input class="checkbox" id="checkbox-3" type="checkbox" value="value2" />
                                    <label for="checkbox-3">By making this purchase you agree to our <a
                                            href="{{url('terms-conditions')}}">terms and conditions.</a></label>
                                </div>
                            </div>
                            <button type="submit" class="btn  mt-20 btn-primary final-submit-btn">Place Order</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@stop