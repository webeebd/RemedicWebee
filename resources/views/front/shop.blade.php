@extends('front.layout')
@section('content')
<style>
    .ui-widget-header{
        background: #eb5e28;
    }
    a.accordion-button.active{
        color: #eb5e28;
    }
</style>
<!-- All Category Section Start -->
<section class="archive-category">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>All Categories</h2>
                    <!-- <a href="product.html" class="solid-btn">all <i class="fa-solid fa-angle-right"></i></a> -->
                    <div class="shortBy-select select__style">
                        <label for="sortBy">Sort by:</label>
                        <select name="sortBy" id="sortBy">
                            <option value="0">Relevance</option>
                            <option value="0">Name (A-Z)</option>
                            <option value="0">Name (Z-A)</option>
                            <option value="0">Date</option>
                            <option value="0">Sale</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row archive-category__inner">
            <div class="category-sidebar accordion" id="categorySidebar">
                <div class="category-sidebar__inner" >
                    @foreach(categories_filter() as $cf)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <a class="accordion-button @if(isset($_GET['category']) && ($_GET['category'] == $cf)) active @endif" type="button" href="{{url('/shop?category='.$cf)}}" >{{$cf}}</a>
                        </h2>
                    </div>
                    @endforeach
                   
                    <p style="margin-top:50px;"><b>FILTER BY PRICE</b></p>
                    <div id="slider-range" ></div>
                    <p style="margin: 20px 0px;">
                        <input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" readonly="readonly"/>
                    </p>
                    <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary" style="padding:10px 30px;">FILTER</button>
                    </div>
                </div>
                
            </div>
            
            <div class="product-card__wrapper">
               @foreach($products as $vp)
                <div class="product-card">
                    <div class="product__image__wrapper">
                        <a href="@if($vp->slug != 'NA') {{url('/product/'.$vp->slug)}} @else # @endif" class="product__image">
                            <img src="{{ asset('storage/products/'.$vp->imageUrl)}}" alt="icon" />
                        </a>
                        @if($vp->discount > 0)
                        <div class="badge">
                            {{$vp->discount}}%
                        </div>
                        @endif
                        <div class="product__actions">
                            
                            <a href="@if($vp->slug != 'NA') {{url('/product/'.$vp->slug)}} @else # @endif" class="action__btn">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 9.33329L13.3333 5.99996L10 2.66663" stroke="#252522"
                                      stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M2.66699 13.3333V8.66667C2.66699 7.95942 2.94794 7.28115 3.44804 6.78105C3.94814 6.28095 4.62641 6 5.33366 6H13.3337"
                                    stroke="#252522" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="product__content">
                       
                        <div class="product__title">
                            <h5><a href="@if($vp->slug != 'NA') {{url('/product/'.$vp->slug)}} @else # @endif">{{$vp->name}}</a></h5>
                        </div>
                        <div class="product__bottom">
                            <div class="product__price">
                                ৳ {{$vp->price}}
                                <del> ৳ {{$vp->mrp}}</del>
                            </div>
                            <div class="cart__action__btn">
                                <div class="cart__btn">
                                    <a onclick="addToCart({{$vp->id}},'1','N')" class="btn btn-outline">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               @endforeach
            </div>
        </div>
    </div>
</section>
<!-- All Category Section End -->

@include('front.partials.newsletters')

@stop