{{--<script type="text/javascript" src="{{asset('resources/admin/js/libs/utils/html5shiv.js?1403934957')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('resources/admin/js/libs/utils/respond.min.js?1403934956')}}"></script>--}}
<script src="{{asset('resources/admin/js/libs/jquery/jquery-1.11.2.min.js')}}"></script>
<script src="{{asset('resources/admin/js/libs/jquery/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('resources/admin/js/libs/bootstrap/bootstrap.min.js')}}"></script>
{{--<script src="{{asset('resources/admin/js/libs/spin.js/spin.min.js')}}"></script>--}}
{{--<script src="{{asset('resources/admin/js/libs/autosize/jquery.autosize.min.js')}}"></script>--}}
{{--<script src="{{asset('resources/admin/js/libs/nanoscroller/jquery.nanoscroller.min.js')}}"></script>--}}
<script src="{{asset('resources/admin/js/core/source/App.js')}}"></script>
<script src="{{asset('resources/admin/js/core/source/AppNavigation.js')}}"></script>
<script src="{{asset('resources/admin/js/core/source/AppCard.js')}}"></script>
<script src="{{asset('resources/admin/js/core/source/AppForm.js')}}"></script>
{{--<script src="{{asset('resources/admin/js/core/source/AppNavSearch.js')}}"></script>--}}
<script src="{{asset('resources/admin/js/core/source/AppVendor.js')}}"></script>
<script src="{{ asset('resources/admin/js/libs/bootbox/bootbox.min.js') }}"></script>
<script src="{{ asset('resources/admin/js/libs/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('resources/admin/js/altair_admin_common.js')}}"></script>
{{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
{{--<script src="{{asset('resources/admin/js/libs/inputmask/jquery.inputmask.bundle.min.js') }}"></script>--}}
{{--<script src="{{asset('resources/admin/js/core/demo/DemoPageContacts.js') }}"></script>--}}

{{--<script src="{{ asset('resources/admin/js/core/source/AppBootBox.min.js') }}"></script>--}}
{{--<script src="{{asset('resources/admin/js/core/demo/Demo.js')}}"></script>--}}
@yield('page-specific-scripts')
<script src="{{asset('resources/admin/js/app.js')}}"></script>

{!! Toastr::render() !!}


