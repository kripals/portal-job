@extends('layouts.admin.layouts')

@section('title',$category->name)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('category.update',[$type,$category->id])}}"
                  method="POST" enctype="multipart/form-data" novalidate>
                @include('admin.category.form', ['header' => 'Edit '.ucwords($type).' Category <span class="text-primary">('.str_limit($category->name, 47).')</span>'])
            </form>
        </div>
    </section>

@endsection



