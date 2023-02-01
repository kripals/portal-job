@extends('layouts.admin.layouts')

@section('title',$role->name)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('role.update',$role->id)}}" method="POST"
                  enctype="multipart/form-data" novalidate>
                @method('PUT')
                @include('admin.role.form', ['header' => 'Edit Role <span class="text-primary">('.str_limit($role->name, 47).')</span>'])
            </form>
        </div>
    </section>
@endsection

