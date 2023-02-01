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
                                <h4><i class="ti-ruler-pencil"></i>Contact Detail</h4>
                            </div>
                            <div class="dashboard-caption-wrap">
                                <form class="post-form" action="{{route('company.store.contact-person', $company)}}" method="POST" data-parsley-validate="">
                                    @csrf
                                    @if(!$contactPersons->isEmpty())
                                        <div class="clonedInput contact_persons" id="removeId1" data-fieldname="contact_persons">
                                            <div id="clonedInput" class="appendContactPerson">
                                                @foreach($contactPersons as $person)
                                                    <div class="row" id="parentId">
                                                        <input type="hidden" name="contact_persons_ref_id[]" value="{{$person->ref_id}}">
                        {{--                                <div class="row">--}}
                                                            <div class="col-lg-11 col-md-11 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="person_name">Person Name*</label>
                                                                    <input type="text" class="form-control" name="person_name[]"
                                                                           value="{{ old('person_name', $person->person_name ?? '') }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1">
                                                                <div class="form-group mrg-top-30">
                                                                    @if(!$loop->first)
                                                                        <button class="btn btn-danger removeThis" data-url="{{route('company.front.removeFields')}}"
                                                                                data-item-name="contact_persons" data-ref-id="{{$person->ref_id}}"><i
                                                                                class="fa fa-trash"></i></button>
                                                                    @endif
                                                                </div>
                                                            </div>
                        {{--                                </div>--}}
                                                        <!-- row -->
                        {{--                                <div class="row">--}}
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Designation*</label>
                                                                    <input type="text" class="form-control" name="person_designation[]"
                                                                           value="{{ old('person_designation', $person->person_designation ?? '') }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Email Address</label>
                                                                    <input type="email" name="person_email[]" class="form-control"
                                                                           value="{{ old('person_email', $person->person_email ?? '') }}" required>
                                                                </div>
                                                            </div>
                        {{--                                </div>--}}
                                                        <!-- row -->
                        {{--                                <div class="row">--}}
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Contact Type</label>
                                                                    <select name="person_contact_type[]" class="form-control jb-minimal" data-placeholder="Contact Type">
                                                                        <option
                                                                            value="work" {{ $person->contact_type ==  'work' ? 'selected' :''}}>
                                                                            Work
                                                                        </option>
                                                                        <option
                                                                            value="mobile" {{ $person->contact_type ==  'mobile' ? 'selected':''}}>
                                                                            Mobile
                                                                        </option>
                                                                        <option
                                                                            value="personal" {{ $person->contact_type ==  'personal' ? 'selected':''}}>
                                                                            Personal
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Contact Number</label>
                                                                    <input type="text" name="person_number[]" class="form-control" id="number2"
                                                                           data-rule-number="true"
                                                                           value="{{ old('person_number',  $person->person_number ?? '') }}">
                                                                </div>
                                                            </div>
                        {{--                                </div>--}}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
{{--                                        <div class="clonedInput contact_persons" id="removeId1" data-fieldname="contact_persons">--}}
{{--                                            <div class="appendContactPerson" id="clonedInput">--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="col-lg-12 col-md-12 col-sm-12">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="person_name">Person Name*</label>--}}
{{--                                                            <input type="text" class="form-control"  name="person_name[]"  value="{{ old('person_name')}}" required>--}}
{{--                                                            <span id="textarea1-error"--}}
{{--                                                                  class="text-danger">{{ $errors->first('person_name') }}--}}
{{--                                                            </span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <!-- row -->--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="col-lg-6 col-md-6 col-sm-12">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label>Designation*</label>--}}
{{--                                                            <input type="text" class="form-control" name="person_designation[]"--}}
{{--                                                                   value="{{ old('person_designation')}}"required>--}}
{{--                                                            <span id="textarea1-error"--}}
{{--                                                                  class="text-danger">{{ $errors->first('person_designation') }}--}}
{{--                                                            </span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-lg-6 col-md-6 col-sm-12">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label>Email Address</label>--}}
{{--                                                            <input type="email" name="person_email[]" class="form-control"--}}
{{--                                                                   id="Email1" value="{{ old('person_email') }}" required>--}}
{{--                                                            <span id="textarea1-error"--}}
{{--                                                                  class="text-danger">{{ $errors->first('person_email') }}--}}
{{--                                                            </span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <!-- row -->--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="col-lg-6 col-md-6 col-sm-12">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="contact_type">Contact Type</label>--}}
{{--                                                            <select id="jb-level" name="person_contact_type[]" class="form-control"--}}
{{--                                                                    data-placeholder="Company Size">--}}
{{--                                                                <option value="work">Work</option>--}}
{{--                                                                <option value="mobile">Mobile</option>--}}
{{--                                                                <option value="personal">Personal</option>--}}
{{--                                                            </select>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-lg-6 col-md-6 col-sm-12">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label>Contact Number</label>--}}
{{--                                                            <input type="text" name="person_number[]" class="form-control"--}}
{{--                                                                   id="number2" data-rule-number="true" value="{{ old('person_number') }}" />--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    @endif
                                    <div class="dynamicAddBtn">
                                        <button type="button" class="btn btn-success createClone" data-clone=".contact_persons" data-fieldname="contact_persons"
                                                data-appendto=".appendContactPerson"><i class="fa fa-plus"></i> Add Contact Person
                                        </button>
                                    </div>
                                    <!-- row -->
                                    <div class="row mrg-top-30">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn-savepreview">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- General Detail End -->
        </div>
    </section>
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
@endsection
