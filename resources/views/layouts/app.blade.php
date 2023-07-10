<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('seo')
    
    <!-- Favicons -->
    <link href="{{ asset('img/logoformalweb.ico') }}" rel="icon">
    <link href="{{ asset('img/web/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- TEMPLATE CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('css/web/animate.css') }}"> --}}
    <!-- css file link -->
    {{-- <link rel="stylesheet" href="{{ asset('css/web/all.css') }}"> --}}
    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="{{ asset('css/web/bootstrap.min.css') }}">
    <!-- box-icon -->
    <link rel="stylesheet" href="{{ asset('css/web/boxicons.min.css') }}">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="{{ asset('css/web/bootstrap-icons.css') }}">
    <!-- jquery ui -->
    {{-- <link rel="stylesheet" href="{{ asset('css/web/jquery-ui.css') }}"> --}}
    <!-- swiper-slide -->
    <link rel="stylesheet" href="{{ asset('css/web/swiper-bundle.min.css') }}">
    <!-- slick-slide -->
    {{-- <link rel="stylesheet" href="{{ asset('css/web/slick-theme.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/web/slick.css') }}"> --}}
    <!-- select 2 -->
    {{-- <link rel="stylesheet" href="{{ asset('css/web/nice-select.css') }}"> --}}
    <!-- animate css -->
    {{-- <link rel="stylesheet" href="{{ asset('css/web/magnific-popup.css') }}"> --}}
    <!-- odometer css -->
    <link rel="stylesheet" href="{{ asset('css/web/odometer.css') }}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('css/web/style.css') }}">

    <!-- Cookies -->
    <!-- Load plugin css -->
    <!-- Optimized css loading -->
    <link rel="stylesheet" href="{{ asset('cookies/cookieconsent.css') }}" media="print" onload="this.media='all'">

    @stack('styles')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script
        rel="dns-prefetch"
        src="https://www.googletagmanager.com/gtag/js?id=G-EPWXYKMD2W"
        ></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-EPWXYKMD2W");
        </script>

    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != "dataLayer" ? "&l=" + l : "";
        j.async = true;
        j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
        f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-WW8CBXL");
    </script>
    <!-- End Google Tag Manager -->

    <!-- Progressive web app -->
    <meta name="theme-color" content="#226600" />
    <link rel="apple-touch-icon" href="{{ asset('img/web/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    

</head>
<body>
    <!-- Google Tag Manager (noscript) -->
  <noscript><iframe rel="dns-prefetch" title="Google Tag Manager for browsers with javascript off" aria-alabel="Google Tag Manager for browsers with javascript off" src="https://www.googletagmanager.com/ns.html?id=GTM-WW8CBXL" height="0"
    width="0" style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div id="app">
        @include('partials.preloader')

        @include('partials.navbar')
        
        @yield('content')
        
        @include('partials.footer')
    </div>

    {{-- <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a> --}}


    <script defer src="{{ asset('cookies/cookieconsent.js') }}"></script>

    @if(app()->getLocale() == 'ca')
        <!-- CAT -->
        <script defer src="{{ asset('cookies/cookieconsent-init-ca.js') }}"></script>
    @elseif(app()->getLocale() == 'es')
        <!-- ES -->
        <script defer src="{{ asset('cookies/cookieconsent-init-es.js') }}"></script>
    @else
        <!-- EN -->
        <script defer src="{{ asset('cookies/cookieconsent-init-en.js') }}"></script>
    @endif
    
    <!-- js file link -->
    <script src="{{ asset('js/web/jquery-3.6.0.min.js') }}"></script>
    {{-- <script src="{{ asset('js/web/jquery-ui.js') }}"></script> --}}
    <script src="{{ asset('js/web/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/web/wow.min.js') }}"></script>
    <script src="{{ asset('js/web/swiper-bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('js/web/slick.js') }}"></script> --}}
    <script src="{{ asset('js/web/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('js/web/odometer.min.js') }}"></script>
    <script src="{{ asset('js/web/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/web/viewport.jquery.js') }}"></script>
    <script src="{{ asset('js/web/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/web/main.js') }}"></script>

    <script src="{{ asset('js/web/lazysizes.min.js') }}" async></script>
   

    @stack('scripts')

    <script src="{{ asset('sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function (reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>
    
</body>
</html>
