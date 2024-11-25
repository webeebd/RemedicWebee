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
                        <h4 class="title">Address List</h4>
                        <a onclick="showAddressForm()" class="btn btn-primary">Add New Address</a>
                    </div>
                    <div class="checkout__form mb-50" id='add-address' style="display: none;">
                        <div class="dashboard__title dashboard__title--v2">
                            <h4 class="title">Add Address</h4>
                        </div>
                        <form action="{{url('/add-address')}}" class="form__wrapper form-padding" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="flex__form c-2">
                                <div class="form-group">
                                    <label for="f_name"> House/Flat No</label>
                                    <input type="text" name="address_house" id="f_name" class="form-control"
                                           placeholder="House/Flat No" />
                                </div>
                                <div class="form-group">
                                    <label for="f_name">Street Name</label>
                                    <input type="text" name="address_street" id="f_name" class="form-control"
                                           placeholder="Street Name"/>
                                </div>
                            </div>
                            <div class="flex__form c-2">
                                <div class="form-group">
                                    <label for="f_name">Area</label>
                                    <input type="text" name="area" id="f_name" class="form-control"
                                           placeholder="Enter Area" />
                                </div>
                                <div class="form-group">
                                    <label for="f_name">Landmark</label>
                                    <input type="text" name="landmark" id="f_name" class="form-control"
                                           placeholder="Landmark"  />
                                </div>
                            </div>
                            <div class="flex__form c-2">
                                <div class="form-group">
                                    <label for="f_name">City</label>
                                    <input type="text" name="city" id="f_name" class="form-control"
                                           placeholder="Enter Area" />
                                </div>
                                <div class="form-group">
                                    <label for="f_name">State</label>
                                    <input type="text" name="state" id="f_name" class="form-control"
                                           placeholder="State"  />
                                </div>
                                <div class="form-group">
                                    <label for="f_name">Pincode</label>
                                    <input type="text" name="pincode" id="f_name" class="form-control"
                                           placeholder="Pincode"  />
                                </div>
                            </div>
                            <!-- Avatar Upload -->
                            <div class="btn__group">
                                <button type="submit" class="btn btn-gray-filled">ADD</button>
                            </div>
                        </form>
                     </div>
                    <!-- Profile Table Start -->
                    <div class="cart__form cart__form--v2">
                        
                        <table>
                            <thead>
                                <tr>
                                    <th class="cart-pd__thumb">Address</th>
                                    <th class="cart-pd__phone">Area/Landmark</th>
                                    <th class="cart-pd__name">City/State</th>
                                    <th class="cart-pd__name">Contact Info</th>
                                    <th class="cart-pd__action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($addresses as $ad)
                                <tr>
                                    <td class="cart-pd__thumb">
                                        <div class="product-card--inline">
                                            
                                            <div class="product__content product__content--v2">
                                                <h5 class="product__title">
                                                    {{$ad->address_house}} <br>
                                                    {{$ad->address_street}}
                                                </h5>
                                             
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="cart-pd__phone" data-title="Landmark">{{$ad->area}}/{{$ad->landmark}}</td>
                                    <td class="cart-pd__name" data-title="City/State">{{$ad->city}}, {{$ad->state}} - {{$ad->pincode}}</td>
                                    <td class="cart-pd__name" data-title="Contact Info"></td>
                                    <td class="cart-pd__action text-end" data-title="Action">
                                        <div class="btn__group">
                                            <a href="{{url('/addresses/'.$ad->id.'/edit')}}" class="success__btn">Edit</a>
                                            <button type="button" class="danger__btn ml-10">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.25 3.5H2.75M2.75 3.5H14.75M2.75 3.5V14C2.75 14.3978 2.90804 14.7794 3.18934 15.0607C3.47064 15.342 3.85218 15.5 4.25 15.5H11.75C12.1478 15.5 12.5294 15.342 12.8107 15.0607C13.092 14.7794 13.25 14.3978 13.25 14V3.5H2.75ZM5 3.5V2C5 1.60218 5.15804 1.22064 5.43934 0.93934C5.72064 0.658035 6.10218 0.5 6.5 0.5H9.5C9.89782 0.5 10.2794 0.658035 10.5607 0.93934C10.842 1.22064 11 1.60218 11 2V3.5M6.5 7.25V11.75M9.5 7.25V11.75" stroke="#667085" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Profile Card End -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SideBar end -->
@stop