<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('img/logoformalweb.ico') }}" rel="icon" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/fontawesome-free/all.min.css') }}">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('pluguins/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('pluguins/css/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('pluguins/css/jqvmap.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('pluguins/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('pluguins/css/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('pluguins/css/summernote-bs4.min.css') }}">

    <!-- Styles -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/admin/adminlte.css') }}">

    @stack('styles')

</head>
<body>
    <div id="app">
        @if(!Route::is('login'))
            @include('admin.partials.navbar')

            @include('admin.partials.sidebar')

            <main class="py-4">
        @endif
        
            @yield('content')
        
        @if(!Route::is('login'))
            </main>

            @include('admin.partials.footer')
        @endif
    </div>

    <!-- jQuery -->
    <script src="{{ asset('pluguins/js/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('pluguins/js/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('pluguins/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('pluguins/js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('pluguins/js/sparkline.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('pluguins/js/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('pluguins/js/moment.min.js') }}"></script>
    <script src="{{ asset('pluguins/js/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('pluguins/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('pluguins/js/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('pluguins/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.js') }}" defer></script>

    @stack('scripts')
</body>
</html>
