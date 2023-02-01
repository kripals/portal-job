@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')

    <!-- End Navigation -->
    <div class="clearfix"></div>

    <!-- Header Title Start -->

    <div class="clearfix"></div>
    <!-- Header Title End -->

    <!-- General Detail Start -->
    <section class="dashboard-wrap">
        <div class="container-fluid">
            <div class="row">
            @include('layouts.frontend.company.edit-profile-sidebar')

            <!-- Content Wrap -->
            <div class="col-lg-9 col-md-8">
                <div class="dashboard-body">
                    <div class="dashboard-caption">
                        <div class="dashboard-caption-header">
                            <h4><i class="ti-id-badge"></i>Basic Information</h4>
                        </div>

                        <div class="dashboard-caption-wrap">
                            <form class="post-form" action="{{route('company.update.edit-profile', $company)}}"
                                  method="POST" data-parsley-validate="">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Organization Name*</label>
                                            <input type="text" class="form-control" name="organization_name"
                                                   value="{{isset($company) ? $company->company_name : null}}"
                                                   required>

                                            @error('organization_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
{{--                                    <div class="col-lg-6 col-md-6 col-sm-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Registration No*</label>--}}
{{--                                            <input type="number" class="form-control" name="reg_no"--}}
{{--                                                   value="{{isset($company) ? $company->company_reg_no : null}}"--}}
{{--                                                   required/>--}}

{{--                                            @error('reg_no')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                                <!-- row -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Industry Type*</label>
                                            <select class="form-control jb-minimal" name="industry" required>
                                                <option>Select Company Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->slug}}"
                                                            @if(isset($company) ? $company->category_id == $category->id :null) selected="selected" @endif>{{$category->name}}</option>
                                                @endforeach
                                            </select>

                                            @error('industry')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Ownership</label>
                                            <select class="form-control jb-minimal" name="ownership" required>
                                                <option>Ownership Type</option>
                                                <option
                                                    @if(isset($company) ? $company->ownership == "Government" :null) selected="selected" @endif>
                                                    Government
                                                </option>
                                                <option
                                                    @if(isset($company) ? $company->ownership == "Private" :null) selected="selected" @endif>
                                                    Private
                                                </option>
                                                <option
                                                    @if(isset($company) ? $company->ownership == "Public" :null) selected="selected" @endif>
                                                    Public
                                                </option>
                                                <option
                                                    @if(isset($company) ? $company->ownership == "Non-profit" :null) selected="selected" @endif>
                                                    Non-profit
                                                </option>
                                            </select>

                                            @error('ownership')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- row -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Organization Size</label>
                                            <select class="form-control jb-minimal" name="organization_size" required>
                                                <option>Organization Size</option>
                                                <option
                                                    @if(isset($company) ? $company->company_size == "1-50 Employees" :null) selected="selected" @endif>
                                                    1-50 Employees
                                                </option>
                                                <option
                                                    @if(isset($company) ? $company->company_size == "50-100 Employees" :null) selected="selected" @endif>
                                                    50-100 Employees
                                                </option>
                                                <option
                                                    @if(isset($company) ? $company->company_size == "100-300 Employees" :null) selected="selected" @endif>
                                                    100-300 Employees
                                                </option>
                                                <option
                                                    @if(isset($company) ? $company->company_size == "300-500 Employees" :null) selected="selected" @endif>
                                                    300-500 Employees
                                                </option>
                                                <option
                                                    @if(isset($company) ? $company->company_size == "500++ Employees" :null) selected="selected" @endif>
                                                    500++ Employees
                                                </option>
                                                <option
                                                    @if(isset($company) ? $company->company_size == "Confidential" :null) selected="selected" @endif>
                                                    Confidential
                                                </option>
                                            </select>

                                            @error('ownership')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Website
                                            </label>
                                            <input type="text" class="form-control" name="website"
                                                   value="{{isset($company) ? $company->website : null}}"
                                                   placeholder="www.sample.com">

                                            @error('website')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- row -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>About Company</label>
                                            <textarea class="form-control textarea" name="description"
                                                      placeholder="About Company">{{isset($company) ? $company->description : null}}</textarea>

                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mrg-top-30">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn-savepreview">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- General Detail End -->
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>

@endsection
@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
@endsection
