@extends('frontend.candidate.layouts.layout')
@section('page-specific-styles')
    <link href="{{ asset('resources/frontend/assets/css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend/assets/css/bootstrap-datepicker.css') }}" rel="stylesheet">
@endsection

@section('candidate-content')

    <div class="dashboard-caption-header">
        <h4><i class="ti-id-badge"></i>Basic Information</h4>
    </div>

    <div class="dashboard-caption-wrap">
        <form class="form form-validate floating-label "
              action="{{route('candidate.store.basic.info',$candidate)}}"
              method="POST" enctype="multipart/form-data" data-parsley-validate="">
            @csrf

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>First Name*</label>
                        <input type="text" name="first_name" value="{{ $candidate->user->first_name }}" class="form-control" placeholder="First Name" required/>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name" value="{{ $candidate->user->middle_name }}" class="form-control" placeholder="Middle Name"/>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Last Name*</label>
                        <input type="text" name="last_name" value="{{ $candidate->user->last_name }}" class="form-control" placeholder="Last Name" required/>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Gender*</label>
                        <select id="jb-level" class="form-control jb-minimal" name="gender" required>
                            <option value="">Select Gender</option>
                            <option
                                value="male" {{ isset($candidate->gender) ? $candidate->gender == 'male' ? 'selected' : '' : '' }}>
                                Male
                            </option>
                            <option
                                value="female" {{ isset($candidate->gender) ? $candidate->gender == 'female' ? 'selected' : '' : '' }}>
                                Female
                            </option>
                            <option
                                value="other" {{ isset($candidate->gender) ? $candidate->gender == 'other' ? 'selected' : '' : '' }}>
                                Other
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <div class="input-daterange form-group">
                            <label>Date of Birth*</label>
                            <input type="text" class="form-control datePick" name="birth_date"
                                   value="{{ old('birth_date', isset($candidate->birth_date) ? $candidate->birth_date : '') }}" onkeydown="return false" placeholder="DD Month YYYY" required/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Nationality*</label>
                        <input type="text" name="nationality" class="form-control"
                               value="{{ old('nationality', isset($candidate->nationality) ? $candidate->nationality : '') }}" placeholder="Enter nationality eg: Nepali" required/>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Marital status*</label>
                        <select class="form-control jb-minimal" name="marital_status" required>
                            <option value="">Select Relationship Status</option>
                            <option
                                value="single" {{ isset($candidate->marital_status) ? $candidate->marital_status == 'single' ? 'selected' : '' : '' }}>
                                Single
                            </option>
                            <option
                                value="married" {{ isset($candidate->marital_status) ? $candidate->marital_status == 'married' ? 'selected' : '' : '' }}>
                                Married
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Religion*</label>
                        <select class="form-control jb-minimal" name="religion" required>
                            <option value="">Select Religion</option>
                            <option
                                value="hinduism" {{ isset($candidate->religion) ? $candidate->religion == 'hinduism' ? 'selected' : '' : '' }}>
                                Hinduism
                            </option>
                            <option
                                value="buddhism" {{ isset($candidate->religion) ? $candidate->religion == 'buddhism' ? 'selected' : '' : '' }}>
                                Buddhism
                            </option>
                            <option
                                value="christianity" {{ isset($candidate->religion) ? $candidate->religion == 'christianity' ? 'selected' : '' : '' }}>
                                Christianity
                            </option>
                            <option
                                value="jainism" {{ isset($candidate->religion) ? $candidate->religion == 'jainism' ? 'selected' : '' : '' }}>
                                Jainism
                            </option>
                            <option
                                value="bahai" {{ isset($candidate->religion) ? $candidate->religion == 'bahai' ? 'selected' : '' : '' }}>
                                Bahai
                            </option>
                            <option
                                value="islam" {{ isset($candidate->religion) ? $candidate->religion == 'islam' ? 'selected' : '' : '' }}>
                                Islam
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Current Address*</label>
                        <input type="text" class="form-control" name="current_address"
                               value="{{ old('current_address', isset($candidate->current_address) ? $candidate->current_address : '') }}" placeholder="Enter current address" required/>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Permanent Address*</label>
                        <input type="text" class="form-control" name="permanent_address"
                               value="{{ old('permanent_address', isset($candidate->permanent_address) ? $candidate->permanent_address : '') }}"  placeholder="Enter permanent address" required/>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Upload Photo</label>
                        @if(isset($candidate->user->avatar))
                            @if(!empty($candidate->user->avatar))
                                <a href="{{ asset($candidate->user->image_path) }}" target="_blank"
                                   class="btn btn-info ink-reaction" style="width: 100%;margin-top: -30px;"><i
                                        class="md md-description"></i>View Image</a>
                                <input type="file" name="avatar" class="dropify"
                                       data-default-file="{{ asset($candidate->user->thumbnail_path) }}"/>
                            @else
                                <input type="file" name="avatar" class="dropify"/>
                            @endif
                        @else
                            <input type="file" name="avatar" class="dropify"/>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Upload Resume</label>
                        @if(isset($candidate->resume))
                            @if(!empty($candidate->resume))
                                <a href="{{ asset($candidate->resume_path) }}" target="_blank"
                                   class="btn btn-info ink-reaction" style="width: 100%;margin-top: -30px;"><i
                                        class="md md-description"></i>View Resume</a>
                                <input type="file" name="resume" class="dropify"
                                       data-default-file="{{ asset($candidate->resume_path) }}"/>
                            @else
                                <input type="file" name="resume" class="dropify"/>
                            @endif
                        @else
                            <input type="file" name="resume" class="dropify"/>
                        @endif
                        <span id="textarea1-error"
                              class="text-danger">{{ $errors->first('resume') }}</span>
                    </div>
                </div>
            </div>
            <br>
            <!-- row -->
            @if(!$contactDetails->isEmpty())
                <div class="clonedInput contactDetails" id="removeId1" data-fieldname="contactDetails">
                    <div id="clonedInput" class="appendContactDetail">
                        @foreach($contactDetails as $contactDetail)
                            <div id="parentId">
                                <input type="hidden" name="contact_detail_ref_id[]" value="{{$contactDetail->ref_id}}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Contact Type*</label>
                                            <select class="form-control jb-minimal" name="detail_key[]">
                                                <option
                                                    value="mobile" {{ isset($contactDetail->detail_key) ? $contactDetail->detail_key == 'mobile' ? 'selected' : '' : '' }}>
                                                    Mobile
                                                </option>
                                                <option
                                                    value="home" {{ isset($contactDetail->detail_key) ? $contactDetail->detail_key == 'home' ? 'selected' : '' : '' }}>
                                                    Home
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" class="form-control" placeholder="Contact Number"
                                                   name="detail_value[]"
                                                   data-rule-url="true"
                                                   value="{{ old('detail_value', isset($contactDetail->detail_value) ? $contactDetail->detail_value : '') }}"/>
                                            <span id="textarea1-error"
                                                  class="text-danger">{{ $errors->first('media_url') }}</span>
                                        </div>
                                    </div>
                                    @if(!$loop->first)
                                        <div class="form-group mrg-top-30">
                                            <button class="btn btn-danger removeThis"
                                                    data-url="{{route('candidate.front.removeFields')}}"
                                                    data-item-name="contact_details"
                                                    data-ref-id="{{$contactDetail->ref_id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
{{--                <div class="clonedInput contactDetails" id="removeId1" data-fieldname="contactDetails">--}}
{{--                    <div id="clonedInput" class="appendContactDetail">--}}
{{--                        <div id="parentId">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-4 col-md-4 col-sm-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Contact Type*</label>--}}
{{--                                        <select class="form-control jb-minimal" name="detail_key[]">--}}
{{--                                            <option value="mobile">Mobile</option>--}}
{{--                                            <option value="home">Home</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-4 col-md-4 col-sm-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Contact Number</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="number"--}}
{{--                                               name="detail_value[]"--}}
{{--                                               data-rule-url="true"--}}
{{--                                               value="{{ old('detail_value', isset($contactDetail->detail_value) ? $contactDetail->detail_value : '') }}"/>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            @endif
            <div class="dynamicAddBtn">
                <button type="button" class="btn btn-success createCandidateClone" data-clone=".contactDetails" data-fieldname="contactDetails"
                        data-appendto=".appendContactDetail"><i class="fa fa-plus"></i> Add Contact Number
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
    <!-- General Detail End -->
@endsection

@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
    <script src="{{ asset('resources/frontend/assets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('resources/frontend/assets/js/dropify.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
            $('.select2-list').select2();
            $('.datePick').datepicker({
                format: "dd MM yyyy",
                autoclose: true
            });
        });
    </script>
@endsection
