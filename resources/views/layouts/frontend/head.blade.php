<head>
    <!-- Basic Page Needs==================================================-->
    <title>Legends Zone</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS==================================================-->
    <link rel="stylesheet" href="{{asset('resources/frontend/assets/plugins/css/plugins.css')}}">
    <link href="{{asset('resources/frontend/assets/css/style.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" id="jssDefault" href="{{asset('resources/frontend/assets/css/colors/green-style.css')}}">
    <link type="text/css" rel="stylesheet" id="jssDefault" href="{{asset('resources/frontend/assets/css/toastr/toastr.min.css')}}">
    <link type="text/css" rel="stylesheet" id="jssDefault" href="{{asset('resources/frontend/assets/css/switchery.css')}}">
    @yield('page-specific-styles')
</head>
