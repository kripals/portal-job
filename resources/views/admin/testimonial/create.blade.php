@extends('layouts.admin.layouts')


@section('title', 'Create a Testimonial')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'testimonial.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('admin.testimonial.form',['header' => 'Create a Testimonial'])
            {{ Form::close() }}
        </div>
    </section>


@endsection

