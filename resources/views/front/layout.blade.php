<!DOCTYPE html>
<html lang="en">
    @include('front.partials.head')

    <body>
        <!-- Header Start  -->
        @include('front.partials.menu')
        <!-- Header End -->

        <!-- Feature Section End -->
        @yield('content')
        <!-- Footer Section Start -->
        @include('front.partials.footer')
        <!-- Footer Section End -->
        <!-- Header Flyout Menu Start -->
        @include('front.partials.menuandcart')
        <!-- Header Flyout Menu End -->
        @include('front.partials.modals')

        <!-- Preloader Start -->
                <div id="preloader">
                    <div id="status"><img src="{{asset('assets/img/remedic-logo.png')}}" alt="logo" /></div>
                </div>
        <!-- Preloader End -->

        <!-- Scroll-top -->
        <button class="scroll-top scroll-to-target" data-target="html">scroll</button>
        <!-- Scroll-top-end-->

        <!-- JS -->
        
        @include('front.partials.scripts')
    </body>
</html>