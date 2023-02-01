@extends('layouts.admin.layouts')

@section('title', 'Create a Job')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('job.store')}}" method="POST" enctype="multipart/form-data" novalidate>
            @include('admin.job.form',['header' => 'Create Job'])
            </form>
        </div>
    </section>
@endsection


