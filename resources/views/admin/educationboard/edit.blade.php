@extends('layouts.admin.layouts')

@section('title',$educationBoard->title)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('education-board.update',$educationBoard->id)}}"
                  method="POST"
                  enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('admin.educationboard.form', ['header' => 'Edit Education Board <span class="text-primary">('.str_limit($educationBoard->title, 47).')</span>'])
        </div>
    </section>

@endsection

