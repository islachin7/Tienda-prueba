<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <!--===== Header =====-->
    @include('partials.header')
    <!--=====End Header =====-->
</head>

<body style="background-color:#f5f5f5;">

    <div id="app" >
        <!--===== NavBar =====-->
        @include('partials.navbar')
        <!--=====End Footer =====-->
        <main>
            @yield('content')
        </main>
    </div>

    <a href="javascript:" id="return-to-top"><i class="ti-angle-double-up"></i></a>

    <!--===== Footer =====-->
    @unless(isset($noFooter))
        @include('partials.footer')
    @endunless
    <!--=====End Footer =====-->    

</body>
</html>
