@extends('layouts.admin.layouts')

@section('title',$company->company_name)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('company.update',$company->id)}}" method="POST" enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('admin.company.form', ['header' => 'Edit Company'])
        </div>
    </section>

@endsection

