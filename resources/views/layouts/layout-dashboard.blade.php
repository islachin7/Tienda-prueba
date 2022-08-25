<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <!--===== Header =====-->
    @include('partials.header-dashboard')
    <!--=====End Header =====-->
</head>

<body>
    <div class="wrapper">
        
        <!--===== sideBar =====-->
        @include('partials.sidebar-dashboard')
        <!--=====End sideBar =====-->

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-warning">
                        <i class="fas fa-align-justify"></i>
                    </button>
                </div>
            </nav>

            @yield('content')

            </div>
    </div>

    <a href="javascript:" id="return-to-top"><i class="ti-angle-double-up"></i></a>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/font-aweosme.min.js') }}"></script>
<script src="{{ asset('js/mega_menu.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/swiper.min.js') }}"></script>

<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
<script src="{{ asset('js/svgxuse.min.js') }}"></script>

<script>
    var plugin_path = 'js/';
</script>
<!-- custom -->
<script src="{{ asset('js/custom.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>
