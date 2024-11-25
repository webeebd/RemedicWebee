<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')
<body data-avio="theme-indigo">
        <main class="avio">
			@include('layouts.nav')
            @yield('content')
        </main>
    @include('layouts.scripts')
    @yield('script')
</body>
</html>
