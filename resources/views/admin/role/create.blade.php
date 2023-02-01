@extends('layouts.admin.layouts')

@section('title', 'Create a Role')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('role.store')}}" method="POST"
                  enctype="multipart/form-data" novalidate>
                @include('admin.role.form',['header' => 'Create a Role'])
            </form>
        </div>
    </section>
@endsection
