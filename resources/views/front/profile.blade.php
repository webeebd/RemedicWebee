@extends('front.layout')
@section('content')
<div class="user__dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                 @include('front.partials.dashboard-sidebar')
            </div>

            <div class="col-lg-9">
                <div class="main__wrapper">
                    <!-- Profile Card -->
                    <div class="profile__card">
                        <div class="profile__card__content">
                            <h2 class="title">Welcome back <span class="text-primary">{{Auth::user()->name}}</span></h2>
                        </div>
                        <div class="profile__card__avater">
                            <img src="{{ asset('storage/customers/'.Auth::guard('web')->user()->picture)}}" alt="Avatar" />
                        </div>
                    </div>
                    <!-- Profile Card -->
                    <!-- Profile TrackOrder -->
                    <div class="profile__trackOrder">
                        <div class="confirm__details__item confirm__details__item--v2">
                            <div class="s-header__flex">
                                <div class="step-header">
                                    <h3 class="step-title">Track Your Orders</h3>
                                </div>
                                <a href="#" class="edit__btn">Track</a>
                            </div>
                            <p class="para"></p>
                            <ul class="information">
                                <li>
                                    <div class="icon"><img src="front/assets/images/location.png" alt="location" /></div>
                                   @if(!empty($latest)) #{{$latest->id}}{{$latest->billNumber}} @endif
                                </li>
                            </ul>
                            <div class="line__chart">
                                <img src="front/assets/images/line-chart.png" alt="line-chart" />
                            </div>
                        </div>
                        <div class="confirm__details__item confirm__details__item--v2">
                            <div class="s-header__flex">
                                <div class="step-header">
                                    <h3 class="step-title">Personal Details</h3>
                                </div>
                            </div>
                            <ul class="information">
                                <li>
                                    <div class="icon"><img src="front/assets/images/mail.png" alt="mail" /></div>
                                   {{Auth::user()->email}}
                                </li>
                                <li>
                                    <div class="icon"><img src="front/assets/images/phone.png" alt="phone" /></div>
                                    {{Auth::user()->mobile}}
                                </li>
                                <li>
                                    <div class="icon"><img src="front/assets/images/location.png" alt="location" /></div>
                                    @php $address = \App\Models\CustomerAddress::where('idUser', '=', Auth::user()->id)->first(); @endphp
                                    @if(!empty($address)) {{$address->address_house}}{{$address->area}},{{$address->city}},{{$address->pincode}} @endif
                                </li>
                            </ul>
                        </div>
                        <div class="confirm__details__item confirm__details__item--v2">
                            <div class="s-header__flex">
                                <div class="step-header">
                                    <h3 class="step-title">Shipping Details</h3>
                                </div>
                            </div>
                            <ul class="information">
                                <li>
                                    <div class="icon"><img src="front/assets/images/card.png" alt="card" /></div>
                                    FedEx - $19.00
                                </li>
                                <li>
                                    <div class="icon"><img src="front/assets/images/location.png" alt="location" /></div>
                                    Kuril - NSU Rd, Dhaka 1229 Pragati Ave, Dhaka, Bangladesh
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Profile Table Start -->
                    <div class="cart__form">
                        <table>
                            <thead>
                                <tr>
                                    <th class="cart-pd__thumb">Order No</th>
                                    <th class="cart-pd__thumb">Product</th>
                                    <th class="cart-pd__qty">Quantity</th>
                                    <th class="cart-pd__price">Price</th>
                                    <th class="cart-pd__status">Status</th>
                                    <th class="cart-pd__date text-start">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($orders as $ord)
                               @php $product = \App\Models\Products::where('id','=',$ord->idProduct)->first(); @endphp
                               @if(!empty($product))
                               <tr>
                                    <td class="cart-pd__qty" data-title="Quantity">{{$ord->orderNumber}}</td>
                                    <td class="cart-pd__thumb">
                                        <div class="product-card--inline">
                                            <a href="#" class="product__image">
                                                <img src="{{ asset('storage/products/'.$product->pic)}}" alt="product" />
                                            </a>
                                            <div class="product__content">
                                                <h5 class="product__title">
                                                    <a href="#">{{$product->title}}</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart-pd__qty" data-title="Quantity">{{$ord->qty}}</td>
                                    <td class="cart-pd__Price" data-title="Price">৳ {{$ord->total}}</td>
                                    <td class="cart-pd__status" data-title="Status">
                                        <div class="status">{{$ord->status}}</div>
                                    </td>
                                    <td class="cart-pd__date text-start" data-title="Date">
                                        Order on <br />
                                        {{\Carbon\Carbon::parse($ord->order_date)->format('d-m-Y')}}
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Profile Card End -->
                </div>
            </div>
        </div>
    </div>
</div>

@stop