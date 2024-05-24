<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title', '| E-commerce') </title>
    <link rel="stylesheet" href="/assets/css/animate.css">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/asset s/css/all.min.css" />
    <link rel="stylesheet" href="/assets/css/ionicons.min.css" />
    <link rel="stylesheet" href="/assets/css/themify-icons.css" />
    <link rel="stylesheet" href="/assets/css/linearicons.css" />
    <link rel="stylesheet" href="/assets/css/flaticon.css" />
    <link rel="stylesheet" href="/assets/css/simple-line-icons.css" />
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.css" />
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="/assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="/assets/css/slick.css" />
    <link rel="stylesheet" href="/assets/css/slick-theme.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/css/responsive.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .alert{
            z-index: 9999999999999;
        }
    </style>
   

    @yield('styles')
</head>
<body>
    @include('jstore/components/header')

   
        @yield('content')


    @include('jstore/components/footer')
    <!-- script js  -->
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/owlcarousel/js/owl.carousel.min.js"></script>
    <script src="/assets/js/magnific-popup.min.js"></script>
    <script src="/assets/js/waypoints.min.js"></script>
    <script src="/assets/js/parallax.js"></script>
    <script src="/assets/js/jquery.countdown.min.js"></script>
    <script src="/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/js/isotope.min.js"></script>
    <script src="/assets/js/jquery.dd.min.js"></script>
    <script src="/assets/js/slick.min.js"></script>
    <script src="/assets/js/jquery.elevatezoom.js"></script>
    <script src="/assets/js/scripts.js"></script>
    @yield('scripts')
</body>
</html>
