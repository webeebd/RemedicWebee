@extends('front.layout')
@section('content')
<!-- SideBar start -->
<div class="user__dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
               @include('front.partials.dashboard-sidebar')
            </div>

            <div class="col-lg-9">
                @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
                <div class="main__wrapper">
                    <div class="dashboard__title">
                        <h4 class="title">Update Account Info</h4>
                    </div>
                    <!-- User Form Start -->
                    <div class="checkout__form mb-50">
                        <div class="dashboard__title dashboard__title--v2">
                            <h4 class="title">Personal info</h4>
                            <!-- <button type="button" class="danger__btn">Edit</button> -->
                        </div>
                        <form action="{{url('/update-profile')}}" class="form__wrapper form-padding" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="flex__form c-2">
                                <div class="form-group">
                                    <label for="f_name"> Name</label>
                                    <input type="text" name="f_name" id="f_name" class="form-control"
                                           placeholder="Enter your  name" value="{{Auth::user()->name}}" />
                                </div>
                                <div class="form-group">
                                    <label for="f_name">Business Name</label>
                                    <input type="text" name="f_name" id="f_name" class="form-control"
                                           placeholder="Business Name" value="{{Auth::user()->business_name}}" />
                                </div>
                            </div>
                            <div class="flex__form c-2">
                                <div class="form-group">
                                    <label for="emil">Email</label>
                                    <input type="email"  id="emil" class="form-control"
                                           placeholder="Enter your email" value="{{Auth::user()->email}}" disabled="disabled"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <div class="input-group">
                                        <input type="text"  id="phone" class="form-control"
                                               placeholder="0987654321" value="{{Auth::user()->mobile}}" disabled="disabled"/>
                                    </div>
                                </div>
                            </div>
                           
                            <!-- Avatar Upload -->
                            <div class="avatar-wrapper">
                                <div class="avatar-preview">
                                    <div id="imagePreview"></div>
                                </div>
                                <div class="avatar-upload">
                                    <label for="imageUpload">
                                        <img src="front/assets/images/upload-icon.png" class="upload-icon" alt="icon" />
                                        <span>
                                            <a href="#">Click to upload</a>
                                            or drag and drop</span>
                                        <span>SVG, PNG, JPG or GIF (max. 2Mb)</span>
                                    </label>
                                    <input type="file" name="picture" id="imageUpload" accept=".png, .jpg, .jpeg, .svg, .gif" />
                                </div>
                            </div>
                            <!-- Avatar Upload -->
                            <div class="btn__group">
                                <button type="button" class="btn btn-outline">Cancel</button>
                                <button type="submit" class="btn btn-gray-filled">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- User Form End -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SideBar end -->
@stop