@extends('front.layout')
@section('content')
<section class="cart__section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="table-cart__title">
                    <h2 class="cart-title">Your Wishlist</h2>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="cart__form">
                    <table>
                        <thead>
                            <tr>
                                <th class="cart-pd__thumb">Product</th>
                                <th class="cart-pd__price">Unit Price</th>
<!--                                <th class="cart-pd__qty">Quantity</th>
                                <th class="cart-pd__total">SubTotal</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="cart-pd__thumb">
                                    <div class="product-card--inline">
                                        <a href="product-single.html" class="product__image">
                                            <img src="assets/images/cart/cart-01.png" alt="product" />
                                        </a>
                                        <div class="product__content">
                                            <h5 class="product__title">
                                                <a href="#">Italian Chicken Meatballs</a>
                                            </h5>
                                            <ul class="product__info">
                                                <li class="info-item">Color: <span>Red</span></li>
                                                <li class="info-item">Size: <span>M</span></li>
                                                <li class="stock__item info-item">In Stock</li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart-pd__price" data-title="Unit Price">$12.22</td>
                               
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