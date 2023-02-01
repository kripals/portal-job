@extends('layouts.admin.layouts')

@section('title', 'Create a Skill')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'skill.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('admin.skill.form',['header' => 'Create a Skill'])
            {{ Form::close() }}
        </div>
    </section>


@endsection