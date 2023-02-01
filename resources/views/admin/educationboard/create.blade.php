@extends('layouts.admin.layouts')

@section('title', 'Create a Education Board')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('education-board.store')}}" method="POST"
                  enctype="multipart/form-data" novalidate>
            @include('admin.educationboard.form',['header' => 'Create a Education Board'])
            </form>
        </div>
    </section>


@endsection
