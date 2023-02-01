@extends('layouts.admin.layouts')

@section('title',$jobSkill->title)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('job-skill.update', $jobSkill->id)}}" method="POST"
                  enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('admin.jobskill.form', ['header' => 'Edit Job Level <span class="text-primary">('.str_limit($jobSkill->title, 47).')</span>'])
            </form>
        </div>
    </section>

@endsection

