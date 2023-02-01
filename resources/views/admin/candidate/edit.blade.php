@extends('layouts.admin.layouts')

@section('title',$candidate->id)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('candidate.update', $candidate->id)}}" method="POST" enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('admin.candidate.form', ['header' => 'Edit Candidate <span class="text-primary">('.str_limit($candidate->id, 47).')</span>'])
            </form>
        </div>
    </section>

@endsection

