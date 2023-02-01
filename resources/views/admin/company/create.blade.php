@extends('layouts.admin.layouts')

@section('title', 'Create a Company')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('company.store')}}" method="POST"
                  enctype="multipart/form-data" novalidate>
                @include('admin.company.form',['header' => 'Create Company'])
            </form>
        </div>
    </section>
@endsection


