@extends('front.layout')
@section('content')
<style>
    .socials a i{
        font-size: 20px;
        margin-left: 10px;
    }
</style>
<section class="blog-single__section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="cart-order cart-order__v2">
                    <h4 class="cart-order__title">GET IN TOUCH WITH US</h4>
                    @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif
                    <form action="{{url('contactus')}}" class="form__wrapper" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text"  required="required" name="name" id="name" maxlength="100" class="form-control" placeholder="Enter your name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emails">Email</label>
                                    <input type="email" required="required" name="email" id="emails" maxlength="50" class="form-control" placeholder="Enter your email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="area">Subject</label>
                            <input type="text" required="required" name="subject" id="subject" class="form-control" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <label for="area">Message</label>
                            <textarea name="message" cols="30" rows="5" id="area" class="form-control form-area" placeholder="Type a Message"></textarea>
                        </div>
                        <div class="input-info__save">
                            <input class="checkbox" id="checkbox-2" type="checkbox" value="value2">
                            <label for="checkbox-2"> Save my name, email in this browser for the next time.</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-5"> 
                <div class="cart-order cart-order__v2">
                    <h4 class="cart-order__title">CONTACT US</h4>
                    <div class="cart__items">
                        <!-- Shopping Cart Item Start -->
                        <div class="shopping-card shopping-card__v2">
                            <div class="shopping-card__content">
                                <div class="shopping-card__content-top">
                                    <h5 class="product__title">
                                        <a href="#"><i class="fa fa-phone-flip"></i> +880-2912-0848</a>
                                    </h5>
                                </div>
                                <div class="shopping-card__content-top">
                                    <h5 class="product__title">
                                        <a href="#"><i class="fa fa-phone-flip"></i> +880 1990-700007</a>
                                    </h5>
                                </div>
                                <div class="shopping-card__content-top">
                                    <h5 class="product__title">
                                        <a href="#"><i class="fa fa-phone-flip"></i> +880 1990-800008</a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="bar"></div>
                    </div>

                    <div class="cart__total cart__total__v2">
                        <h3>Email : admin@hema-bd.com</h3>
                    </div>
                    <hr>
                    <div class="cart__total cart__total__v2">
                        <h3>
                            99 Kazi Nazrul Islam Avenue,
                            Dhaka Trade Cente,
                            Kawran Bazar Commercial Area,
                            Dhaka 1215
                        </h3>
                    </div>
                    <div class="socials" style="margin-top: 20px;">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i> </a>
                        <a href="#"><i class="fa-brands fa-twitter"></i> </a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop