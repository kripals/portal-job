@extends('layouts.admin.layouts')

@section('title', 'Create a Job Skill')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('job-skill.store')}}" method="POST"
                  enctype="multipart/form-data" novalidate>
                @include('admin.jobskill.form',['header' => 'Create a Job Skill'])
            </form>
        </div>
    </section>


@endsection

