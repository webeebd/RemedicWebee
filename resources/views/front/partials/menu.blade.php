 <!-- Header Start  -->
    <header class="header header-sticky">
        <div class="container">
            <!-- Header Top Start -->
            <div class="header__top">
                <div class="header__left">
                    <!-- Header Toggle Start -->
                    <div class="header__toggle d-lg-none">
                        <button class="toggler__btn">
                            <svg width="18" height="12" viewBox="0 0 18 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0 12H18V10H0V12ZM0 7H18V5H0V7ZM0 0V2H18V0H0Z" fill="#667085" />
                            </svg>
                        </button>
                    </div>
                    <!-- Header Toggle End -->
                    <div class="header__logo">
                        <a href="{{url('/')}}"><img src="{{asset('assets/img/remedic-logo.png')}}" alt="logo" style="height:60px;"/> </a>
                    </div>
                    <div class="search__form__wrapper">
                        <form action="{{url('/shop')}}" method="GET" class="search__form">
                            <div class="select__style">
                                <select name="category" class="category-select">
                                    @foreach(categories_filter() as $k=>$v)
                                    <option value="{{$v}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="search" class="form-control product-autocomplete" name="search"
                                placeholder="What are you looking for..." />
                            <button type="submit">
                                <img src="{{asset('front/assets/images/search.png')}}" alt="search" />
                            </button>
                        </form>
                    </div>
                </div>
                <div class="header__meta">
                    <ul class="meta__item d-xl-block d-none">
                        <li><i class="fa-solid fa-location-dot"></i>Dhaka, Bangladesh</li>
                    </ul>
                    <ul class="meta__item">
                        <ul class="meta__item">
                            @if(Auth::guard('web')->check())
                            <li>
                                <div class="avatar__dropdown">
                                    <a href="#" class="avatar__profile">
                                        @if(Auth::guard('web')->user()->picture != null)
                                        <img src="{{ asset('storage/customers/'.Auth::guard('web')->user()->picture)}}" alt="avatar-img">
                                        @else
                                        <img src="{{asset('front/assets/images/avatar/avatar-04.png')}}" alt="avatar-img">
                                        
                                        @endif
                                    </a>
                                    <ul class="list">
                                        <li class="active"><a href="{{url('/profile')}}">My Account</a></li>
                                        <!--<li><a href="{{url('/profile')}}">Profile</a></li>-->
                                        <li><a href="{{ route('customer.logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a></li>
                                        <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                                                       {{ csrf_field() }}
                                        </form>
                                    </ul>
                                </div>
                            </li>
                            @else
                            <li>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#login">
                                    <i class="fa-solid fa-user-plus"></i>
                                    <span>Sign In</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </ul>
                   
                    <div class="miniCart">
                        <div class="header__cart">
                            <a href="#" class="cart__btn">
                                <div class="cart__btn-img">
                                    <img src="{{asset('front/assets/images/cart-icon.png')}}" alt="cart-icon" />
                                    <span class="value" id='cartcounttotal'>{{cartcount()}}</span>
                                </div>
                                <span class="title">cart</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Header Top End -->
            </div>
            <!-- Search Form -->
            <form action="{{url('/shop')}}" method="GET" class="search__form full__width d-lg-none d-flex">
                <input type="search" class="form-control product-autocomplete" name="search" placeholder="What are you looking for..." />
                <button type="submit">
                    <img src="{{asset('front/assets/images/search.png')}}" alt="search" />
                </button>
            </form>
            <!-- Search Form -->
        </div>
        <nav class="nav d-none d-lg-flex">
            <div class="container">
                <!-- Header Wrap Start  -->
                <div class="header__wrapper">
                    <div class="header__menu">
                        <ul class="main__menu">
                            <li>
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li>
                                <a href="{{url('about')}}">About</a>
                            </li>
                            <!--<li><a href="#">Hot Offers</a></li>-->
                            <li>
                                <a href="{{url('shop')}}">Products</a>
                            </li>
                           
                            <li>
                                <a href="{{url('contact-us')}}">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="header__meta">
                        <ul class="meta__item">
                            <li>
                                <a href="tel: +880-2912-0848"><i class="fa-solid fa-phone-flip"></i> +880-2912-0848</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Header Wrap End  -->
            </div>
        </nav>
    </header>
    <!-- Header End -->