<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale())}}">
<head>
    <!--Meta configuration links-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Set csrf token to every request-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--Vendor cdn links for css-->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">-->
    <link href="{{ asset('css/vendor/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Css files-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
    <link href="{{ asset('css/product-list.css') }}" rel="stylesheet">
    <link href="{{ asset('css/product-categories.css') }}" rel="stylesheet">
    <link href="{{ asset('css/product-add.css') }}" rel="stylesheet">
    <link href="{{ asset('css/product-tags.css') }}" rel="stylesheet">
    <link href="{{ asset('css/product-orders.css') }}" rel="stylesheet">
    <link href="{{ asset('css/product-edit.css') }}" rel="stylesheet">
    <link href="{{ asset('css/transactions-history.css') }}" rel="stylesheet">
    <link href="{{ asset('css/clients-reviews.css') }}" rel="stylesheet">
    <link href="{{ asset('css/clients-list.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/banner.css') }}" rel="stylesheet">
    <link href="{{ asset('css/gallery.css') }}" rel="stylesheet">
    <!--Vendor cdn links for javascript-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>-->
    <script src="{{asset('js/vendor/bootstrap.bundle.min.js')}}"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>-->
    <script src="{{asset('js/vendor/vue.js')}}"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
    <script src="{{asset('js/vendor/axios.min.js')}}"></script>
    <!--Javascript files-->
    <script src="{{asset('js/setCookie.js')}}"></script>
    <script src="{{asset('js/getCookie.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <!--favicon-->
    <link rel="icon" href="{{ url('css/favicon.ico') }}">
    <!--Title of the website-->
    <title>Document</title>
</head>
<body>
    @yield('content')
</body>
</html>