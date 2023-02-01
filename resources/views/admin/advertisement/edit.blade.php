@extends('layouts.admin.layouts')

@section('title',$advertisement->title)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('advertisement.update', $advertisement->id)}}" method="POST"
                  enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('admin.advertisement.form', ['header' => 'Edit Advertisement <span class="text-primary">('.str_limit($advertisement->title, 47).')</span>'])
            </form>
        </div>
    </section>

@endsection

