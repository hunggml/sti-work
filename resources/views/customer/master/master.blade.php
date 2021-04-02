<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('titleCustomer')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    {{-- Toastr --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
    @toastr_css
    {{-- css/style --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   @stack('mycss')

</head>

<body class="sidebar-mini layout-fixed sidebar-mini sidebar-collapse" data-panel-auto-height-mode="height">
    <div class="wrapper">

        <!-- Navbar -->
        @include('customer.core.header')

        <!-- Content Wrapper. Contains page content -->


        @yield('contain')


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    @include('customer.core.footer')

    <!-- ./wrapper -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  
    @stack('script')

    <script>
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
   
    </script>
     <script>
        function time() {
            let time = new Date();
            let day = time.getDate();
            let month = time.getMonth() + 1;
            let years = time.getFullYear();
            let hour = time.getHours();
            let minute = time.getMinutes();
            let sescord = time.getSeconds();
            if (hour < 10) {
                hour = "0" + hour;
            }
            if (minute < 10) {
                minute = "0" + minute;
            }
            if (sescord < 10) {
                sescord = "0" + sescord;
            }
            document.getElementById('time').innerHTML = day + "/" + month + "/" + years + "-" + hour + ":" + minute + ":" +
                sescord;
            setTimeout("time()", 1000);
        }
        time();

    </script>
    {{-- @jquery --}}
    @toastr_js
    @toastr_render
</body>

</html>
