@extends('layouts.admin.layouts')

@section('title', 'Create a Candidate')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('candidate.store')}}" method="POST" enctype="multipart/form-data" novalidate>
            @include('admin.candidate.form',['header' => 'Create a Candidate'])
            </form>
        </div>
    </section>

@endsection


