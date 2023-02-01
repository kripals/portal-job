@extends('layouts.admin.layouts')

@section('title',$package->title)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('package.update',[$type,$package->id])}}"
                  method="POST"
                  enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('admin.package.form', ['header' => 'Edit '.ucwords($type).' Package <span class="text-primary">('.str_limit($package->title, 47).')</span>'])
        </div>
    </section>

@endsection

