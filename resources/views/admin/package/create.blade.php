@extends('layouts.admin.layouts')

@section('title', 'Create a Package')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('package.store',$type)}}" method="POST"
                  enctype="multipart/form-data" novalidate>
            @include('admin.package.form',['header' => 'Create '.ucwords($type).' Package'])
            </form>
        </div>
    </section>


@endsection
