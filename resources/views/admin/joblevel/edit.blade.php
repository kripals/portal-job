@extends('layouts.admin.layouts')

@section('title',$jobLevel->title)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('job-level.update',$jobLevel->id)}}"
                  method="POST"
                  enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('admin.joblevel.form', ['header' => 'Edit Job Level <span class="text-primary">('.str_limit($jobLevel->title, 47).')</span>'])
        </div>
    </section>

@endsection

