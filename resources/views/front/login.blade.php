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
            <div class="col-lg-3">

            </div>
            <div class="col-lg-6">
                <div class="main__wrapper">
                    <div class="dashboard__title" style="text-align:center;">
                        <h4 class="title">SIGN IN TO CONTINUE </h4>
                    </div>
                    <!-- User Form Start -->
                    <div class="checkout__form mb-50">

                        <form action="{{url('login')}}" class="form__wrapper form-padding" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <label for="emil">Email</label>
                                    <input type="email" name="email" id="emil" class="form-control"
                                           placeholder="Enter Email"  />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-30">
                                <div class="account__desc">
                                    <div class="account__meta">
                                        Don’t have an account?
                                        <a href="{{url('signup')}}">Sign up</a>
                                        <a href="#" data-bs-target="#forget" data-bs-toggle="modal" data-bs-dismiss="modal" style="float: right;">Forgot Password?</a>
                                
                                    </div>
                                </div>
                            </div>
                            <!-- Avatar Upload -->
                            <div class="submit__btn">
                                <button type="submit" class="btn btn-primary mt-0 w-100">Login</button>
                            </div>
                        </form>
                    </div>
                    <!-- User Form End -->
                </div>
            </div>
            <div class="col-lg-3">

            </div>
        </div>
    </div>
</div>

<!-- SideBar end -->
@stop