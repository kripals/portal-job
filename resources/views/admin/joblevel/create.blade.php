@extends('layouts.admin.layouts')

@section('title', 'Create a Job Level')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('job-level.store')}}" method="POST"
                  enctype="multipart/form-data" novalidate>
            @include('admin.joblevel.form',['header' => 'Create a Job Level'])
            </form>
        </div>
    </section>


@endsection
