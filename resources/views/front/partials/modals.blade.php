<style>
    .form__wrapper .form-group{
        margin-bottom: 10px;
    }
</style> 
<!-- Login Modal Start -->
    <div class="modal fade popup__modal" id="login" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="popup__form">
                        <div class="popup__logo">
                            <a href="{{url('/')}}"><img src="{{asset('assets/img/remedic-logo.png')}}" alt="logo" style="height:60px;" /></a>
                        </div>
                        <div class="popup__bg">
                            <img src="{{asset('front/assets/images/popup/p-bg-02.jpg')}}" alt="popup-bg" />
                        </div>
                        <form action="#" class="form__wrapper" id='form-login'>
                            @csrf
                            <div class="popup__title">
                                <h2>Login</h2>
                            </div>
                            <!--<div class="devider text-center">- OR -</div>-->
                            <span id='wrongcredentials'></span>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required
                                    data-error="Please enter email" placeholder="Enter your email" />
                            </div>
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" name="password" id="pass" class="form-control" required maxlength="15"
                                    data-error="Please enter password" placeholder="Password" />
                            </div>
                            <div class="submit__btn">
                                <button type="submit" class="btn btn-primary mt-0 w-100">Login</button>
                            </div>
                            <div class="account__desc">
                                <div class="account__meta">
                                    Don’t have an account?
                                    <a href="#" data-bs-target="#signup" data-bs-toggle="modal"
                                        data-bs-dismiss="modal">Sign up</a>
                                </div>
                                <a href="#" data-bs-target="#forget" data-bs-toggle="modal"
                                    data-bs-dismiss="modal">Forgot Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Modal End -->
    <!-- SingUp Modal Start -->
    <div class="modal fade popup__modal" id="signup" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="popup__form">
                        <div class="popup__logo">
                            <a href="{{url('/')}}"><img src="{{asset('assets/img/remedic-logo.png')}}" alt="logo" style="height:60px;" /></a>
                        </div>
                        <div class="popup__bg">
                            <img src="{{asset('front/assets/images/popup/p-bg-02.jpg')}}" alt="popup-bg" />
                        </div>
                        <form action="#" class="form__wrapper" id='signup-form'>
                            <div class="popup__title">
                                <h2>Create Account</h2>
                            </div>
                           @csrf
                           <span id='successmsg'></span>
                            <!--<div class="devider text-center">- OR -</div>-->
                            <div class="form-group">
                                <label for="name2">Full Name</label>
                                <input type="text" name="name" id="name2" class="form-control" required
                                    data-error="Please enter name" placeholder="Full name" />
                            </div>
                            <div class="form-group">
                                <label for="name2">Business Name</label>
                                <input type="text" name="business_name" id="name2" class="form-control" required
                                    data-error="Please enter Business Name" placeholder="Enter your Business Name" />
                               
                            </div>
                            <div class="form-group">
                                <label for="email2">Email</label>
                                <input type="email" name="email" id="email2" class="form-control" required
                                    data-error="Please enter email" placeholder="Enter your email" />
                                 <span id='emailerror'></span>
                            </div>
                            <div class="form-group">
                                <label for="email2">Mobile</label>
                                <input type="text" name="mobile" class="form-control" required
                                       data-error="Please enter Mobile" placeholder="Enter your Mobile No" maxlength="10" minlength="10"/>
                                <span id='mobileerror'></span>
                            </div>
                            <div class="form-group">
                                <label for="pass2">Password</label>
                                <input type="password" name="password" id="pass2" class="form-control" required
                                       data-error="Please enter password" placeholder="Password" maxlength="15" />
                            </div>
                            <div class="submit__btn">
                                <button type="submit" class="btn btn-primary mt-0 w-100">Create Account</button>
                            </div>
                            <div class="account__desc justify-content-center">
                                <div class="account__meta">
                                    Already have an account?
                                    <a href="#" data-bs-target="#login" data-bs-toggle="modal"
                                        data-bs-dismiss="modal">Login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SingUp Modal End -->
    <!-- Forget Modal Start -->
    <div class="modal fade popup__modal" id="forget" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="popup__form">
                        <div class="popup__logo">
                            <a href="{{url('/')}}"><img src="{{asset('assets/img/remedic-logo.png')}}" alt="logo" style="height:60px;" /></a>
                        </div>
                        <div class="popup__bg">
                            <img src="{{asset('front/assets/images/popup/p-bg-02.jpg')}}" alt="popup-bg" />
                        </div>
                        <form action="#" class="form__wrapper">
                            <div class="popup__title">
                                <h2>Forgot password</h2>
                                <p>No worries, We’ll send you reset your passward.</p>
                            </div>
                            <div class="form-group">
                                <label for="email3">Email</label>
                                <input type="email" name="email" id="email3" class="form-control" required
                                    data-error="Please enter email" placeholder="Enter your email" />
                            </div>
                            <div class="submit__btn">
                                <button type="submit" class="btn btn-primary mt-0 w-100">Reset Passward</button>
                            </div>
                            <div class="account__desc">
                                <div class="account__meta">
                                    Remember password? Back to
                                    <a href="#" data-bs-target="#login" data-bs-toggle="modal"
                                        data-bs-dismiss="modal">login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Forget Modal End -->

    <!-- Product Preview Modal Start -->
    <div class="modal fade cart-success-model" id="cart_success" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row product-detail align-items-center">
                            <div class="col-md-12 col-sm-12 m-auto">
                                <div class="product-gallery product-gallery__v2">
                                    <p><strong>Product Added To Cart Successfully !!</strong></p>
                                    <a href="#" class="btn btn-primary" onclick='showCartFlyout()'>View Cart</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>