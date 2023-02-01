@extends('layouts.admin.layouts')

@section('title', 'Create a Advertisement')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('advertisement.store')}}" method="POST"
                  enctype="multipart/form-data" novalidate>
                @include('admin.advertisement.form',['header' => 'Create a Advertisement'])
            </form>
        </div>
    </section>


@endsection

