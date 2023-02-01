@extends('layouts.admin.layouts')

@section('title', 'Create a user')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('user.store')}}" method="POST"
                  enctype="multipart/form-data" novalidate>
                @include('admin.user.form',['header' => 'Create a User'])
            </form>
        </div>
    </section>
@endsection
