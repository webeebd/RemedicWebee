<!-- Header Flyout Menu Start -->
<div class="flyoutMenu">
    <div class="flyout__flip">
        <div class="flyout__inner">
            <div class="menu__header-top">
                <div class="brand__logo">
                    <a href="{{url('/')}}"><img src="{{asset('assets/img/remedic-logo.png')}}" alt="logo" style="height:60px;"/>></a>
                </div>
                <!-- Close -->
                <div class="closest__btn action__btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="#344054" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M6 6L18 18" stroke="#344054" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                    <!-- Close -->
                </div>
            </div>
            <!-- Search Form -->
            <form action="{{url('/shop')}}" method="GET" class="search__form full__width">
                <input type="search" class="form-control product-autocomplete" name="search" placeholder="What are you looking for..." />
                <button type="submit">
                    <img src="{{asset('front/assets/images/search.png')}}" alt="search" />
                </button>
            </form>
            <!-- Search Form -->
            <div class="flyout__menu">
                <ul class="flyout-main__menu">
                    <li>
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{url('about')}}">About</a>
                    </li>
                    <li>
                        <a href="{{url('shop')}}">Products</a>
                    </li>
                    <li>
                        <a href="{{url('contact-us')}}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Header Flyout Menu End -->

<!-- Header FlyoutCart Start -->
<div class="flyoutCart" id='fc'>
    <div class="flyout__flip">
        <div class="flyout__inner">
            <div class="cart__header-top">
                <div class="main__title">Your Cart</div>
                <div class="close__btn action__btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="#344054" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M6 6L18 18" stroke="#344054" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                    <!-- Close -->
                </div>
            </div>
            
            <div class="cart__title">
                <h3>Product</h3>
                <h3>Price</h3>
            </div>
            <div class="cart__items"  id='shoppingcart'>
                <!-- Shopping Cart Item Start -->
                <div class="shopping-card">
                    
                </div>
                
            </div>
            <!-- Cart Items End -->
            <!-- Cart SubTotal Start -->
            <ul class="cart__subtotal">
                <li>
                    <span class="label">Subtotal</span>
                    <span class="value">৳ <span id='subtotalcart'>0.00</span></span>
                </li>
                <li>
                    <span class="label">Discount:</span>
                    <span class="value">৳ <span id='distotalcart'>0.00</span></span>
                </li>
            </ul>
            <!-- Cart SubTotal End -->
            <!-- Total Start -->
            <div class="cart__total">
                <h3>Total <span>(Incl. VAT)</span></h3>
                <div class="total">৳ <span id='totalamtcart'>0.00</span></div>
            </div>
            <!-- Total End -->
            
        </div>
        <!-- Cart Button Start -->
        <div  style="display: none;text-align: center;" id='checkout_btns'>
            <a href="{{url('/checkout')}}" class="btn btn-primary">Go To Checkout</a>
        </div>
        <!-- Cart Button End -->
    </div>
</div>
<!-- Header FlyoutCart End -->