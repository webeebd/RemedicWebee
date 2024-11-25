@extends('front.layout')
@section('content')
<style>
    .form-padding{
        box-shadow: 10px 10px 30px 0px #1018281a;
    }
</style>
<!-- SideBar start -->
<div class="user__dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">

            </div>

            <div class="col-lg-8">
                <div class="main__wrapper">
                    <div class="dashboard__title" style="text-align:center;">
                        <h4 class="title">SIGN UP </h4>
                    </div>
                    <!-- User Form Start -->
                    <div class="checkout__form mb-50">

                        <form action="{{url('signup')}}" class="form__wrapper form-padding" method="post">
                            @csrf
                            <div class="row">
                                <div class="flex__form c-2">
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
                                </div>
                                <div class="flex__form c-2">
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
                                </div>
                                <div class="form-group">
                                    <label for="pass2">Password</label>
                                    <input type="password" name="password" id="pass2" class="form-control" required
                                           data-error="Please enter password" placeholder="Password" maxlength="15" />
                                </div>
                            </div>
                            <div class="row mb-30">
                                <div class="account__desc">
                                    <div class="account__meta">
                                        Already have an account?
                                        <a href="{{url('sign-in')}}">Login</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Avatar Upload -->
                            <div class="submit__btn">
                                <button type="submit" class="btn btn-primary mt-0 w-100">SIGNUP</button>
                            </div>
                        </form>
                    </div>
                    <!-- User Form End -->
                </div>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    </div>
</div>

<!-- SideBar end -->
@stop