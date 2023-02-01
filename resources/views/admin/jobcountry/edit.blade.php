@extends('layouts.admin.layouts')

@section('title',$jobCountry->title)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('job-country.update',$jobCountry->id)}}" method="POST"
                  enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('admin.jobcountry.form', ['header' => 'Edit Job Country <span class="text-primary">('.str_limit($jobCountry->title, 47).')</span>'])
            </form>
        </div>
    </section>

@endsection


