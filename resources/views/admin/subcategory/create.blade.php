@extends('layouts.admin.layouts')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>['category.subcategory.store',$category->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('admin.subcategory.form',['header' => 'Create a SubCategory Of <span class="text-primary">'.($category->name).'</span>'])
            {{ Form::close() }}
        </div>
    </section>
@endsection
