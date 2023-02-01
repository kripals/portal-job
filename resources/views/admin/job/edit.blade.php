@extends('layouts.admin.layouts')

@section('title',$job->title)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('job.update',$job->id)}}" method="POST" enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('admin.job.form', ['header' => 'Edit Job'])
        </div>
    </section>

@endsection

