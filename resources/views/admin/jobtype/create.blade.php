@extends('layouts.admin.layouts')

@section('title', 'Create a Job Type')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('job-type.store')}}" method="POST"
                  enctype="multipart/form-data" novalidate>
            @include('admin.jobtype.form',['header' => 'Create a Job Type'])
            </form>
        </div>
    </section>


@endsection

