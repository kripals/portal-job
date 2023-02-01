<head>

    <title>Legends Zone Admin-@yield('title')</title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="your,keywords">
    <meta name="description" content="Short explanation about this website">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- END META -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- BEGIN STYLESHEETS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
    <link type="text/css" rel="stylesheet" href="{{asset('resources/admin/css/theme-default/bootstrap.css?1422792965') }}" />
    <link type="text/css" rel="stylesheet" href="{{asset('resources/admin/css/theme-default/materialadmin.css?1425466319') }}" />
    <link type="text/css" rel="stylesheet" href="{{asset('resources/admin/css/theme-default/font-awesome.min.css?1422529194') }}" />
    <link type="text/css" rel="stylesheet" href="{{asset('resources/admin/css/theme-default/material-design-iconic-font.min.css?1421434286') }}" />
    <link type="text/css" rel="stylesheet" href="{{asset('resources/admin/css/theme-default/libs/toastr/toastr.min.css') }}" />
{{--    <link type="text/css" rel="stylesheet" href="{{asset('resources/admin/css/theme-default/libs/rickshaw/rickshaw.css?1422792967')}}" />--}}
{{--    <link type="text/css" rel="stylesheet" href="{{asset('resources/admin/css/theme-default/libs/morris/morris.core.css?1420463396')}}" />--}}
    <link rel="stylesheet" href="{{ asset('resources/admin/css/app.css') }}">
    <!-- END STYLESHEETS -->
    @yield('page-specific-styles')
</head>
