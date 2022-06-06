<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('metatags')

    <title>@yield('title')</title>

    <!-- custom css -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/swiper.bundle.min.css">
    <link rel="stylesheet" href="/css/fontawesome.min.css">
    <link rel="stylesheet" href="/css/unicode.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/blog-card.css">
    @yield('css')
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-LCW68E9BTT"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-LCW68E9BTT');
    </script> --}}

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset("favicon/apple-touch-icon.png")}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset("favicon/favicon-32x32.png")}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset("favicon/favicon-16x16.png")}}">
    <link rel="manifest" href="{{asset("favicon/site.webmanifest")}}">
</head>
<body>
    @include('layouts/navbar')

    @yield('content')

    @include('layouts/footer')

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/up.js"></script>
    <script src="js/swiper.bundle.min.js"></script>
    @yield("script")
    <script>
        function updateCount() {
            fetch("https://api.countapi.xyz/update/phonestl/website/?amount=1");
        }

        updateCount();
    </script>
</body>
</html>