@extends('layouts.admin.layouts')

@section('title',$testimonial->name)

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($testimonial, ['route' =>['testimonial.update', $testimonial->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }}
            @include('admin.testimonial.form', ['header' => 'Edit Category <span class="text-primary">('.str_limit($testimonial->name, 47).')</span>'])
            {{ Form::close() }}
        </div>
    </section>

@endsection


