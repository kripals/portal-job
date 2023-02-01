@extends('layouts.admin.layouts')

@section('title',$subcategory->name)

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($subcategory, ['route' =>['category.subcategory.update',$category->slug,$subcategory->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }}
            @include('admin.subcategory.form', ['header' => 'Update SubCategory<span class="text-primary">('.str_limit($subcategory->name, 47).')</span>'])
            {{ Form::close() }}
        </div>
    </section>

@endsection

