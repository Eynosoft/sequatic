<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Seaquatic Aquarums</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('public/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/css/sweetalert.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet" type="text/css">
       
        <script src="{{ asset('') }}/public/js/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('') }}/public/js/jsvalidation.js"></script>
        <script src="{{ asset('') }}/public/js/sweetalert-dev.js"></script>
        
    </head>

    <body>
        @yield('content')
    </body>
</html>
