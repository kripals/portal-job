@extends('layouts.administrator.layouts')
@section('content')
    <div id="page_content">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="/">Home</a></li>
                <li><a href="{{route('permission.index')}}">Permission</a></li>
            </ul>
        </div>
        <div id="page_content_inner">

            <div class="md-card">
                <div class="md-card-content">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <i class="md-icon material-icons md-card-fullscreen-activate">&#xE5D0;</i>

                        </div>
                        <h3 class="md-card-toolbar-heading-text">
                            Add New Permission
                        </h3>
                    </div>

                    <form action="{{route('permission.store')}}" method="POST"  >
                        @include('administrator.permission.form')
                    </form>
                </div>
            </div>


        </div>
    </div>

@stop
@section('page-specific-scripts')

@endsection
