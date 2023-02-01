<!doctype html>
<html lang="en">
@include('layouts.frontend.head')
<body>
{{--<div class="Loader"></div>--}}
<div class="wrapper">
@yield('content')
    <script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/bootstrap.min.js')}}"></script>
    @yield('page-specific-scripts')
</div>
</body>
</html>
