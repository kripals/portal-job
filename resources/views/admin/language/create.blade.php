@extends('layouts.admin.layouts')

@section('title', 'Create a Language')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'language.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('admin.language.form',['header' => 'Create a Language'])
            {{ Form::close() }}
        </div>
    </section>


@endsection
