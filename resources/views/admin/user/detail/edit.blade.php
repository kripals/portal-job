
@extends('layouts.administrator.layouts')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <form action="{{route('user.detail.update', [$user->slug, $userDetail->id])}}" method="post" class="uk-form-stacked" id="user_edit_form">
                @method('put')
                @include('administrator.user.detail.form')
            </form>
        </div>
    </div>

@stop
