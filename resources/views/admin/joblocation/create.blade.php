@extends('layouts.admin.layouts')

@section('title', 'Create a Job Location')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('country.job-location.store',$jobCountry->id)}}" method="POST"
                  enctype="multipart/form-data" novalidate>
            @include('admin.joblocation.form',['header' => 'Create a Job Location'])
            </form>
        </div>
    </section>


@endsection

