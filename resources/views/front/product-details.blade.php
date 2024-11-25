@extends('front.layout')
@section('content')
<style>
    .widget__sidebar .widget .category-item ul{
        list-style-type: square;
    }
</style>
@php $amc = \App\Models\AmcMaster::where('id','=',$product->amc_id)->first(); @endphp
<!-- product detail section start  -->
<section class="product-main">
    <div class="container">
        <div class="row product-detail">
            <div class="col-md-5">
                <div class="product-gallery">
                    <div class="product-gallery__thumb swiper productGallerySwiperThumb">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="gallery-item">
                                    <img src="{{ asset('storage/products/'.$product->pic)}}" alt="product iamge" />
                                </div>
                            </div>
<!--                            <div class="swiper-slide">
                                <div class="gallery-item">
                                    <img src="assets/images/products/prod-02.png" alt="product iamge" />
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="gallery-item">
                                    <img src="assets/images/products/prod-03.png" alt="product iamge" />
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="gallery-item">
                                    <img src="assets/images/products/prod-04.png" alt="product iamge" />
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="product-gallery__main swiper productGallerySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="gallery-item">
                                    <img src="{{ asset('storage/products/'.$product->pic)}}" alt="product iamge" />
                                </div>
                            </div>
<!--                            <div class="swiper-slide">
                                <div class="gallery-item">
                                    <img src="assets/images/products/prod-02.png" alt="product iamge" />
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="gallery-item">
                                    <img src="assets/images/products/prod-03.png" alt="product iamge" />
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="gallery-item">
                                    <img src="assets/images/products/prod-04.png" alt="product iamge" />
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="product-detail__wrapper">
                    <h2 class="product-detail__title">{{$product->title}}</h2>
                    <div class="product-detail__meta">
                        <ul class="right-meta">
                            <li>
                                <div class="stock__item">In-stock</div>
                            </li>
                        </ul>
                    </div>
                    <h3 class="product-detail__price"> 
                        ৳ {{$product->sales_price}}
                         @if($product->pre_discount > 0)<del> ৳ {{$product->max_retail_price}}</del>@endif
                    </h3>
                    @if($product->pre_discount > 0)
                    <div class="product__attr">
                    <span class="product-detail--stroke"><strong>Discount : {{$product->pre_discount}} % </strong></span>
                    </div>
                    @endif
                    <p class="product-detail__short_desc">
                        @php echo $product->short_description; @endphp
                    </p>
                    
                       <input type="hidden" name="idProduct" value="{{$product->id}}" id='prdid'>
                       <div class="product-detail__qty">
                           <span class="product-detail--stroke">quantity</span>
                           <div class="quantity quantity--outline">
                               <button type="button" class="decressQnt">
                                   <span class="bar"></span>
                               </button>
                               <input class="qnttinput" type="number" name="qty" value="1" min="1" max="10" id='prdqty'/>
                               <button type="button" class="incressQnt">
                                   <span class="bar"></span>
                               </button>
                           </div>

                       </div>
                       @if(!empty($amc))
                       <div class="form-check" style="margin-top:20px;">
                           <input class="form-check-input" type="checkbox" value="Y" id="amccheck" name="amc">
                           <label class="form-check-label" for="flexCheckDefault">
                               {{$amc->name}} - {{$amc->description}} 
                           </label>
                       </div>
                       @endif
                       <div class="product-detail__action">
                           <div class="item">
                               <button class="btn btn-primary btn-filled" onclick='saveCartData()'>Add to Cart</button>
                           </div>
                       </div>
                   
                    <div class="product-detail__accordion accordion" id="productDetailAccordion" style="margin-top: 50px;">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="accordionOne">
                                <button class="accordion-button product-detail__price collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#accordion_one"
                                        aria-controls="accordion_one" aria-expanded="true">
                                    Additional Information
                                </button>
                            </h2>
                            <div id="accordion_one" class="accordion-collapse collapse show"
                                 aria-labelledby="accordionOne" data-bs-parent="#productDetailAccordion">
                                <div class="accordion-body">
                                     @php echo $product->description; @endphp
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            
                @if(!empty($amc))
                <div class="widget__sidebar">
                    <aside class="widget">
                        <h4 class="widget__title" style="color:#eb5e28;">AMC Details</h4>
                        <div class="category-item">
                            <p><strong>Offerings</strong></p>
                            @php echo $amc->offerings; @endphp
                            <p style="margin-top:10px;"><strong>Validity : </strong> {{$amc->duration}} {{$amc->unit}}</p>
                        </div>
                    </aside>
                </div>
                @endif
            </div>
        </div>

        
    </div>
</section>
@include('front.partials.newsletters')
@stop