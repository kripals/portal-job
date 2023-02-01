@extends('layouts.administrator.layouts')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <form action="{{route('user.user-detail.store', $user->id)}}" method="post" class="uk-form-stacked" id="user_edit_form"  data-parsley-validate>
                @include('administrator.user.user-detail.form')
            </form>

        </div>
    </div>

@stop
@section('page-specific-scripts')

@endsection
