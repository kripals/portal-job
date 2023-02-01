@extends('layouts.admin.layouts')

@section('title',$skill->title)

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($skill, ['route' =>['skill.update', $skill->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }}
            @include('admin.skill.form', ['header' => 'Edit Skill <span class="text-primary">('.str_limit($skill->title, 47).')</span>'])
            {{ Form::close() }}
        </div>
    </section>

@endsection


