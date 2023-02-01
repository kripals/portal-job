@extends('layouts.admin.layouts')

@section('title', 'Create a Job Country')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('job-country.store')}}" method="POST"
                  enctype="multipart/form-data" novalidate>
            @include('admin.jobcountry.form',['header' => 'Create a Job Country'])
            </form>
        </div>
    </section>


@endsection

