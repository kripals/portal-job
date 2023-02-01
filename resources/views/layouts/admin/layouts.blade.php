<!DOCTYPE html>
<html lang="en">
@include('layouts.admin.head')

    <body class="menubar-hoverable header-fixed">
    @if (auth()->guest())
        @yield('guest')
    @else
    @include('layouts.admin.header')
    <!-- BEGIN BASE-->
    <div id="base">
        <div id="content">
            @yield('content')
        </div>
        <!-- END CONTENT-->
        @include('layouts.admin.sidebar')
    </div><!--end #base-->
    <!-- END BASE -->
    @endif
    @include('layouts.admin.footer')
    </body>
</html>

