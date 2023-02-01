@extends('layouts.admin.layouts')

@section('title', 'Create a Category')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('category.store',$type)}}" method="POST" enctype="multipart/form-data" novalidate>
            @include('admin.category.form',['header' => 'Add '.ucwords($type).' Category'])
            </form>
        </div>
    </section>

@endsection


