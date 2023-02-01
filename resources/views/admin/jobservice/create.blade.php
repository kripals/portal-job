@extends('layouts.admin.layouts')

@section('title', 'Create a Job Service')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('job-service.store')}}" method="POST"
                  enctype="multipart/form-data" novalidate>
            @include('admin.jobservice.form',['header' => 'Create a Job Service'])
            </form>
        </div>
    </section>


@endsection

