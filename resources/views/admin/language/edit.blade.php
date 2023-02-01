@extends('layouts.admin.layouts')

@section('name',$language->name)

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($language, ['route' =>['language.update', $language->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }}
            @include('admin.language.form', ['header' => 'Edit Language <span class="text-primary">('.str_limit($language->name, 47).')</span>'])
            {{ Form::close() }}
        </div>
    </section>

@endsection

