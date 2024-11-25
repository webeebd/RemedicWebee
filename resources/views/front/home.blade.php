@extends('front.layout')
@section('content')
<!-- Banner Section Start -->
@foreach($homebuilder as $builder)
@if($builder->type == 'slider')
<section class="banner__slider__section" style="padding-top: 10px;">
    <div class="container">
        <div class="row align-items-center column-reverse">
            <div class="col-lg-6 col-md-6">
                <div class="banner__content">
                    <h4>{{$builder->subtitle}}</h4>
                    <h1>{{$builder->title}}</h1>
                    <p>{{$builder->body}}</p>
                    @if($builder->actionName != null)
                    <div class="hero-btn">
                        <a href="http://remedic.oakmis.com/shop" class="btn btn-primary" data-bs-target="#signup" data-bs-toggle="modal" data-bs-dismiss="modal">Sign Up</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="hero__swiper__slider">
                    <div class="swiper hero__mySwiper">
                        <div class="swiper-wrapper">
                            @foreach($builder->data as $sdata)
                            <div class="swiper-slide">
                                <div class="slider__image">
                                    <img src="{{$sdata->imageUrl}}" alt="banner-bg" />
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next">
                            <svg width="35" height="16" viewBox="0 0 35 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 8L34 8" stroke="#D0D5DD" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" />
                                <path d="M27 1L34 8L27 15" stroke="#D0D5DD" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="swiper-button-prev">
                            <svg width="23" height="16" viewBox="0 0 23 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 8H1" stroke="#D0D5DD" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" />
                                <path d="M8 15L1 8L8 1" stroke="#D0D5DD" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Banner Slider Section End -->
@if($builder->type == 'banners')
<!-- Banner Ads Section Start -->
<section class="banner__ads__section">
    <div class="container">
        <div class="row">
            
            <div class="col-12">
                <div class="banner__ads__main">
                    @foreach($builder->data as $bdata)
                    <div class="banner__ads__wrapper">
                        <div class="banner__ads__single__item">
                            <span class="banner__ads__subtitle">Weekend Discount 20%</span>
                            <h5 class="banner__ads__title">
                                Leading medical<br> supplier in bangladesh
                            </h5>
                            @if($bdata->actionName != 'NA')
                            <div class="shop__btn">
                                <a href="http://remedic.oakmis.com/shop" class="btn btn-primary">{{$bdata->actionName}}</a>
                            </div>
                            @endif
                        </div>
                        <div class="banner__ads__image">
                            <img src="{{$bdata->imageUrl}}" alt="banner-ads-image" />
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            
        </div>
    </div>
</section>
@endif
<!-- Banner Ads Section End -->
@if($builder->type == 'products')
@if($builder->title == 'New Arrivals')
<!-- Arrival Section Start -->
<section class="arrival__section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>New Arrivals</h2>
                    <a href="{{url('/shop')}}" class="solid-btn">View All <i class="fa-solid fa-angle-right"></i></a> 
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                         aria-labelledby="home-tab" tabindex="0">
                        <div class="content__body">
                            <div class="product__wrapper swiper__pagination">
                                <div class="swiper arrival__Swiper">
                                    <div class="swiper-wrapper">
                                        @foreach($builder->data as $pa)
                                                  
                                        <div class="swiper-slide">
                                            <div class="product-card">
                                                <div class="product__image__wrapper">
                                                    <a href="@if($pa->slug != 'NA') {{url('/product/'.$pa->slug)}} @else # @endif " class="product__image">
                                                        <img src="{{ asset('storage/products/'.$pa->imageUrl)}}"
                                                             alt="icon" />
                                                    </a>
                                                    @if($pa->discount >0 )
                                                    <div class="badge">{{$pa->discount}} %</div>
                                                    @endif
                                                    <div class="product__actions">
                                                        
                                                        <a href="@if($pa->slug != 'NA') {{url('/product/'.$pa->slug)}} @else # @endif" class="action__btn">
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10 9.33329L13.3333 5.99996L10 2.66663"
                                                                      stroke="#252522" stroke-linecap="round"
                                                                      stroke-linejoin="round" />
                                                                <path
                                                                    d="M2.66699 13.3333V8.66667C2.66699 7.95942 2.94794 7.28115 3.44804 6.78105C3.94814 6.28095 4.62641 6 5.33366 6H13.3337"
                                                                    stroke="#252522" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product__content">
                                                    <div class="product__title">
                                                        <h5><a href="@if($pa->slug != 'NA') {{url('/product/'.$pa->slug)}} @else # @endif">{{$pa->name}}</a></h5>
                                                    </div>
                                                    <div class="product__bottom">
                                                        <div class="product__price">
                                                            ৳ {{$pa->price}}
                                                            <del>৳ {{$pa->mrp}}</del>
                                                        </div>
                                                        <div class="cart__action__btn">
                                                            <div class="cart__btn">
                                                                <a onclick="addToCart({{$pa->id}},'1','N')" class="btn btn-outline">Add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      @endforeach
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="swiper-button-next">
                                            <svg width="35" height="16" viewBox="0 0 35 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 8L34 8" stroke="#D0D5DD" stroke-width="2"
                                                      stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M27 1L34 8L27 15" stroke="#D0D5DD" stroke-width="2"
                                                      stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="swiper-button-prev">
                                        <svg width="23" height="16" viewBox="0 0 23 16" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22 8H1" stroke="#D0D5DD" stroke-width="2"
                                                  stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M8 15L1 8L8 1" stroke="#D0D5DD" stroke-width="2"
                                                  stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Arrival Section End -->
@endif
@if($builder->type == 'categories')
<!-- Category Section Start -->
<section class="category__section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Category</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="content__body">
                    <div class="product__wrapper swiper__pagination">
                        <div class="swiper arrival__Swiper">
                            <div class="swiper-wrapper">
                                @foreach($builder->data as $kc=>$vc)
                                <div class="swiper-slide">
                                    <div class="product-card">
                                        <div class="product__image__wrapper" style="background: {{$vc->background}}">
                                              <a href="{{url('/shop?category='.$vc->name)}}" class="product__image">
                                                <img src="{{ asset('storage/categories/'.$vc->imageUrl)}}"
                                                     alt="icon" />
                                            </a>

                                        </div>
                                        <div class="product__content">
                                            <div class="product__title">
                                                <h5><a href="{{url('/shop?category='.$vc->name)}}">{{$vc->name}}</a></h5>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                            <div class="swiper-slide">
                                <div class="swiper-button-next">
                                    <svg width="35" height="16" viewBox="0 0 35 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 8L34 8" stroke="#D0D5DD" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M27 1L34 8L27 15" stroke="#D0D5DD" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="swiper-button-prev">
                                <svg width="23" height="16" viewBox="0 0 23 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 8H1" stroke="#D0D5DD" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8 15L1 8L8 1" stroke="#D0D5DD" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endif
<!-- Category Section End -->
@if($builder->type == 'products')
@if($builder->title == 'On Sales')
<!-- Sale Section Start -->
<section class="sale__section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <div class="section-title__wrap">
                        <h2>On Sales</h2>
                        <div class="sales__countdown countdown__wrapper">
                            <div id="salesCountdown"></div>
                        </div>
                    </div>
                    <a href="{{url('shop')}}" class="solid-btn">View All <i class="fa-solid fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product__wrapper swiper__pagination">
                    <div class="swiper sale__Swiper">
                        <div class="swiper-wrapper">
                                @foreach($builder->data as $pa)
                                <div class="swiper-slide">
                                    <div class="product-card">
                                        <div class="product__image__wrapper">
                                            <a href="@if($pa->slug != 'NA') {{url('/product/'.$pa->slug)}} @else # @endif" class="product__image">
                                                <img src="{{ asset('storage/products/'.$pa->imageUrl)}}"
                                                     alt="icon" />
                                            </a>
                                            @if($pa->discount >0 )
                                            <div class="badge">{{$pa->discount}} %</div>
                                            @endif
                                            <div class="product__actions">
                                                <a href="@if($pa->slug != 'NA') {{url('/product/'.$pa->slug)}} @else # @endif" class="action__btn">
                                                    <svg width="16" height="16" viewBox="0 0 16 16"
                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 9.33329L13.3333 5.99996L10 2.66663"
                                                              stroke="#252522" stroke-linecap="round"
                                                              stroke-linejoin="round" />
                                                        <path
                                                            d="M2.66699 13.3333V8.66667C2.66699 7.95942 2.94794 7.28115 3.44804 6.78105C3.94814 6.28095 4.62641 6 5.33366 6H13.3337"
                                                            stroke="#252522" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product__content">
                                            <div class="product__title">
                                                <h5><a href="@if($pa->slug != 'NA') {{url('/product/'.$pa->slug)}} @else # @endif">{{$pa->name}}</a></h5>
                                            </div>
                                            <div class="product__bottom">
                                                <div class="product__price">
                                                    ৳ {{$pa->price}}
                                                    <del>৳ {{$pa->mrp}}</del>
                                                </div>
                                                <div class="cart__action__btn">
                                                    <div class="cart__btn">
                                                        <a onclick="addToCart({{$pa->id}},'1','N')" class="btn btn-outline">Add to cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              @endforeach
                            </div>

                        <div class="swiper-slide">
                            <div class="swiper-button-next">
                                <svg width="35" height="16" viewBox="0 0 35 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 8L34 8" stroke="#D0D5DD" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" />
                                    <path d="M27 1L34 8L27 15" stroke="#D0D5DD" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="swiper-button-prev">
                            <svg width="23" height="16" viewBox="0 0 23 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 8H1" stroke="#D0D5DD" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" />
                                <path d="M8 15L1 8L8 1" stroke="#D0D5DD" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endif
@endif
@if($builder->type == 'collection')
<section class="product__collection__section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="product__collection__wrapper">
                    <div class="product__collection__item text-center">
                        <div class="product__collection__image">
                            <img src="front/assets/images/collection/collection-01.jpg" alt="collection-image" />
                        </div>
                        <div class="product__collection__content">
                            <div class="product__content__wrapper">
                                <!--<span>Woman</span>-->
                                <h4>BiPAP/ CPAP Collection</h4>
                                <div class="collection__btn">
                                    <a href="{{url('/shop?category=BiPAP')}}" class="btn btn-primary">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="product__collection__wrapper">
                    <div class="product__collection__item text-center">
                        <div class="product__collection__image">
                            <img src="front/assets/images/collection/collection-02.jpg" alt="collection-image" />
                        </div>
                        <div class="product__collection__content">
                            <div class="product__content__wrapper">
                                <!--<span>Man & Woman</span>-->
                                <h4>Oxygen concentrator Collection</h4>
                                <div class="collection__btn">
                                    <a href="{{url('/shop?category=Oxygen Concentrator')}}" class="btn btn-primary">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="product__collection__wrapper">
                    <div class="product__collection__item text-center">
                        <div class="product__collection__image">
                            <img src="front/assets/images/collection/collection-03.jpg" alt="collection-image" />
                        </div>
                        <div class="product__collection__content">
                            <div class="product__content__wrapper">
                                <!--<span>Electronics</span>-->
                                <h4>High Flow Humidifier Collection</h4>
                                <div class="collection__btn">
                                    <a href="{{url('/shop?category=High Flow Humidifier')}}" class="btn btn-primary">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if($builder->type == 'products')
@if($builder->title == 'trending')
<section class="trending__section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Trending</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product__wrapper swiper__pagination">
                    <div class="swiper trending__Swiper">
                    <div class="swiper-wrapper">
                            @foreach($builder->data as $ta)

                            <div class="swiper-slide">
                                <div class="product-card">
                                    <div class="product__image__wrapper">
                                        <a href="@if($ta->slug != 'NA') {{url('/product/'.$pa->slug)}} @else # @endif" class="product__image">
                                            <img src="{{ asset('storage/products/'.$ta->imageUrl)}}"
                                                 alt="icon" />
                                        </a>
                                        @if($ta->discount >0 )
                                        <div class="badge">{{$ta->discount}} %</div>
                                        @endif
                                        <div class="product__actions">
                                            <a href="@if($ta->slug != 'NA') {{url('/product/'.$pa->slug)}} @else # @endif" class="action__btn">
                                                <svg width="16" height="16" viewBox="0 0 16 16"
                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10 9.33329L13.3333 5.99996L10 2.66663"
                                                          stroke="#252522" stroke-linecap="round"
                                                          stroke-linejoin="round" />
                                                    <path
                                                        d="M2.66699 13.3333V8.66667C2.66699 7.95942 2.94794 7.28115 3.44804 6.78105C3.94814 6.28095 4.62641 6 5.33366 6H13.3337"
                                                        stroke="#252522" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product__content">
                                        <div class="product__title">
                                            <h5><a href="@if($ta->slug != 'NA') {{url('/product/'.$ta->slug)}} @else # @endif">{{$ta->name}}</a></h5>
                                        </div>
                                        <div class="product__bottom">
                                            <div class="product__price">
                                                ৳ {{$ta->price}}
                                                <del>৳ {{$ta->mrp}}</del>
                                            </div>
                                            <div class="cart__action__btn">
                                                <div class="cart__btn">
                                                    <a onclick="addToCart({{$pa->id}},'1','N')" class="btn btn-outline addproduct-tocart">Add to cart</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          @endforeach
                        </div>

                        <div class="swiper-slide">
                            <div class="swiper-button-next">
                                <svg width="35" height="16" viewBox="0 0 35 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 8L34 8" stroke="#D0D5DD" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" />
                                    <path d="M27 1L34 8L27 15" stroke="#D0D5DD" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="swiper-button-prev">
                            <svg width="23" height="16" viewBox="0 0 23 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 8H1" stroke="#D0D5DD" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" />
                                <path d="M8 15L1 8L8 1" stroke="#D0D5DD" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endif

@endforeach                
@include('front.partials.newsletters')
@stop