@extends('layouts.admin.layouts')

@section('page-specific-styles')
<link href="{{ asset('admin/css/libs/dropify/dropify.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection

@section('title', $siteSetting->name)

@section('content')
<section>
  <div class="section-body">
    {{ Form::model($siteSetting, ['route' =>['sitesetting.update', $siteSetting->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
    {{ method_field('PUT') }}
    @include('admin.sitesetting.form', ['header' => 'Edit Site Setting'])
    {{ Form::close() }}
  </div>
</section>
@endsection

@section('page-specific-scripts')
<script src="{{ asset('admin/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
<script src="{{ asset('admin/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin/js/libs/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap-toggle.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
  $('.dropify').dropify();
});
</script>
@endsection
