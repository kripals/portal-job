@extends('layouts.admin.layouts')

@section('title',$jobService->title)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('job-service.update', $jobService->id)}}"
                  method="POST"
                  enctype="multipart/form-data" novalidate>
                @method('PUT')
                @include('admin.jobservice.form', ['header' => 'Edit Job Service <span class="text-primary">('.str_limit($jobService->title, 47).')</span>'])
            </form>
        </div>
    </section>

@endsection


