@extends('layouts.admin.layouts')

@section('title',$jobLocation->title)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('country.job-location.update',[$jobCountry->id,$jobLocation->id])}}" method="POST"
                  enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('admin.joblocation.form', ['header' => 'Edit Job Location <span class="text-primary">('.str_limit($jobLocation->title, 47).')</span>'])
            </form>
        </div>
    </section>

@endsection


