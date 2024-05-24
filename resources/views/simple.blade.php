<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title', ' | E-commerce') </title>
    <link rel="stylesheet" href="/assets/css/animate.css">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/css/all.min.css" />
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
    {{-- <style>
        body {
            font-family: sans-serif;
        }

        .box-container {
            width: 80%;
            padding: 2rem;
            border: 1px solid #f2f2f2;
            border-radius: 5px;
            background-color: #ffffff;
            margin-left: 10%;
            margin-right: 10%;
        }

        .box-container .title {
            font-weight: bold;
            padding: 1rem;
            border-bottom: 1px solid #f2f2f2;
            background-color: #f2f2f2;
        }

        .transaction-box {
            margin-top: 1rem;
        }

        .transaction-box .item {
            display: table;
            width: 100%;
            margin-bottom: 1rem;
        }

        .transaction-box .item>* {
            display: table-cell;
            vertical-align: middle;
        }

        .transaction-box .item> :first-child {
            text-align-last: left;
        }

        .transaction-box .item> :last-child {
            text-align-last: right;
            font-weight: bold;
        }

        .transaction_details_box {
            margin-top: 3rem;
            border-radius: 5px;
            display: table;
            width: 100%;
            margin-bottom: 3rem;
        }

        .transaction_details_box .left {
            display: table;
            margin-bottom: 1rem;
            width: 100%;
        }

        .transaction_details_box .left>* {
            display: table-cell;
            vertical-align: middle;
        }



        .transaction_details_box .left .item {
            display: table;
            width: 100%;
            float: left;
            margin-bottom: 1rem;
        }

        .transaction_details_box .left .item>* {
            display: table-cell;
            vertical-align: middle;

            width: 100%;
            margin-bottom: 1rem;
        }

        .transaction_details_box .left .item> :first-child {
            text-align: left;
        }

        .transaction_details_box .left .item> :last-child {
            text-align: right;
        }

        .transaction_details_box .right {
            display: table;
            width: 100%;
        }

        .transaction_details_box .right table {
            width: 100%;
        }

        .transaction_details_box .right .payment_tile {
            margin-top: 2rem;
            margin-bottom: 2rem;
            text-transform: uppercase;
            font-weight: bold;
        }

        th {
            background: #8a97a0;
            color: #fff;
        }

        tr {
            background: #f4f7f8;
        }

        tr:nth-child(even) {
            background: #e8eeef;
        }

        th,
        td {
            padding: 0.5rem;
        }

        .single_item .value {
            font-weight: bold;
        }
    </style> --}}
    @yield('styles')
</head>
<body>


    @yield('content')


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
