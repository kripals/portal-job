@extends('layouts.admin.layouts')

@section('title',$jobType->title)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('job-type.update', $jobType->id)}}"
                  method="POST"
                  enctype="multipart/form-data" novalidate>
                @method('PUT')
                @include('admin.jobtype.form', ['header' => 'Edit Job Type <span class="text-primary">('.str_limit($jobType->title, 47).')</span>'])
            </form>
        </div>
    </section>

@endsection


