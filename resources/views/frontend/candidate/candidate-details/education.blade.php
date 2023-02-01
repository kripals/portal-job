@extends('frontend.candidate.layouts.layout')
@section('page-specific-styles')
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/frontend/assets/css/bootstrap-datepicker.css') }}"/>
@endsection
@section('candidate-content')

    <div class="dashboard-caption-header">
        <h4><i class="ti-ruler-pencil"></i>Education</h4>
    </div>

    <div class="dashboard-caption-wrap">
        {{--        <form class="post-form" action="{{ route('candidate.store-edu') }}" method="POST">--}}
        <form class="form form-validate floating-label" action="{{route('candidate.store.education', $candidate)}}"
              method="POST" enctype="multipart/form-data" data-parsley-validate="">
            @csrf
            @if(!$educations->isEmpty())
                <div class="clonedInput educations" id="removeId1" data-fieldname="educations">
                    <div class="appendEducation" id="clonedInput">
                        @foreach($educations as $education)
                            <div id="parentId">
                                <input type="hidden" name="educations_ref_id[]" value="{{$education->ref_id}}">
                                @if(!$loop->first)
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-1" style="float: right">
                                            <div class="form-group text-center">
                                                <button class="btn btn-danger removeThis"
                                                        data-url="{{route('candidate.front.removeFields')}}"
                                                        data-item-name="educations"
                                                        data-ref-id="{{$education->ref_id}}">
                                                    <i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Degree*</label>
                                            <select class="form-control input-lg jb-minimal"
                                                    name="qualification_level[]" required>
                                                <option value="">Select the degree achieved</option>
                                                <option
                                                    value="phd" {{ isset($education->qualification_level) ? $education->qualification_level == 'phd' ? 'selected' : '' : '' }}>
                                                    Ph.D.
                                                </option>
                                                <option
                                                    value="master" {{ isset($education->qualification_level) ? $education->qualification_level == 'master' ? 'selected' : '' : '' }}>
                                                    Masters
                                                </option>
                                                <option
                                                    value="diploma" {{ isset($education->qualification_level) ? $education->qualification_level == 'diploma' ? 'selected' : '' : '' }}>
                                                    Diploma
                                                </option>
                                                <option
                                                    value="bachelor" {{ isset($education->qualification_level) ? $education->qualification_level == 'bachelor' ? 'selected' : '' : '' }}>
                                                    Bachelor
                                                </option>
                                                <option
                                                    value="intermediate" {{ isset($education->qualification_level) ? $education->qualification_level == 'intermediate' ? 'selected' : '' : '' }}>
                                                    Intermediate
                                                </option>
                                                <option
                                                    value="school" {{ isset($education->qualification_level) ? $education->qualification_level == 'school' ? 'selected' : '' : '' }}>
                                                    School
                                                </option>
                                                <option
                                                    value="other" {{ isset($education->qualification_level) ? $education->qualification_level == 'other' ? 'selected' : '' : '' }}>
                                                    Other
                                                </option>
                                            </select>
                                            @error('qualification_level')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Education Program*</label>
                                            <input type="text" name="program_name[]" class="form-control"
                                                   value="{{ old('program_name', isset($education->program_name) ? $education->program_name : '') }}" placeholder="Enter the program name eg: BBA in case of SEE enter school"
                                                   required/>
                                            @error('program_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Education Board*</label>
                                            <select class="form-control input-lg jb-minimal" name="education_board[]" required>
                                                <option value="">Select education board of study</option>
                                                @foreach($educationBoards as $key=>$board)
                                                    <option
                                                        value="{{$board->id}}"
                                                        {{ isset($education->education_board_id) ? $education->education_board_id == $board->id ? 'selected' : '' : ''}}
                                                    >{{$board->title}}</option>
                                                @endforeach
                                            </select>
                                            @error('education_board')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Name of Institute*</label>
                                            <input type="text" class="form-control" name="institute_name[]"
                                                   value="{{ old('institute_name', isset($education->institute_name) ? $education->institute_name : '') }}"
                                                   placeholder="Enter name of the institute/college" required/>
                                            @error('institute_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- row -->

                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-styled">
                                                <label>
                                                    <input type="checkbox" name="education_is_current[]" class="ifCheck"
                                                           value="yes" data-hide=".educationToggle"
                                                           {{ old('education_is_current', isset($education->is_current) ? $education->is_current : '')=='yes' ? 'checked':'' }}/>
                                                    <span>Currently Studying ?</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="educationToggle"
                                         @if($education->is_current == 'yes')style="display: none;"@endif>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label>Graduation Year</label>
                                                <input type="text" class="form-control graduation_year"
                                                       name="passing_year[]"
                                                       id="graduation_year"
                                                       value="{{ old('passing_year', isset($education->passing_year) ? $education->passing_year : '') }}" placeholder="YYYY" onkeydown="return false"/>
                                                @error('passing_year')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label>Marks Secured</label>
                                                <input type="text" name="marks_obtained[]" class="form-control"
                                                       placeholder="Marks Secured"
                                                       value="{{ old('marks_obtained', isset($education->marks_obtained) ? $education->marks_obtained : '') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <div class="form-group" style="margin-top: 6px;">
                                                    <label></label>
                                                    <select class="form-control input-lg jb-minimal" name="marks_type[]">
                                                        <option value="">Select Marks Type</option>
                                                        <option
                                                            value="cgpa" {{ isset($education->marks_type) ? $education->marks_type == 'cgpa' ? 'selected' : '' : '' }}>
                                                            CGPA
                                                        </option>
                                                        <option
                                                            value="percent" {{ isset($education->marks_type) ? $education->marks_type == 'percent' ? 'selected' : '' : '' }}>
                                                            %
                                                        </option>
                                                    </select>
                                                    @error('marks_type')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                {{--                <div class="clonedInput educations" id="removeId1" data-fieldname="educations">--}}
                {{--                    <div class="appendEducation" id="clonedInput">--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-12 col-sm-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <label>Degree*</label>--}}
                {{--                                    <select class="form-control input-lg" name="qualification_level[]">--}}
                {{--                                        <option--}}
                {{--                                            value="phd">--}}
                {{--                                            Ph.D.--}}
                {{--                                        </option>--}}
                {{--                                        <option--}}
                {{--                                            value="master">--}}
                {{--                                            Masters--}}
                {{--                                        </option>--}}
                {{--                                        <option--}}
                {{--                                            value="bachelor">--}}
                {{--                                            Bachelor--}}
                {{--                                        </option>--}}
                {{--                                        <option--}}
                {{--                                            value="intermediate">--}}
                {{--                                            Intermediate--}}
                {{--                                        </option>--}}
                {{--                                        <option--}}
                {{--                                            value="slc">--}}
                {{--                                            SLC/SEE--}}
                {{--                                        </option>--}}
                {{--                                        <option--}}
                {{--                                            value="other">--}}
                {{--                                            Other--}}
                {{--                                        </option>--}}
                {{--                                    </select>--}}
                {{--                                    @error('qualification_level')--}}
                {{--                                    <span class="invalid-feedback" role="alert">--}}
                {{--                                        <strong>{{ $message }}</strong>--}}
                {{--                                    </span>--}}
                {{--                                    @enderror--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- row -->--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-12 col-sm-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <label>Education Program*</label>--}}
                {{--                                    <input type="text" name="program_name[]" class="form-control"--}}
                {{--                                           value="{{ old('program_name') }}"/>--}}
                {{--                                    @error('program_name')--}}
                {{--                                    <span class="invalid-feedback" role="alert">--}}
                {{--                                        <strong>{{ $message }}</strong>--}}
                {{--                                    </span>--}}
                {{--                                    @enderror--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}

                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-12 col-sm-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <label>Education Board*</label>--}}
                {{--                                    <select class="form-control input-lg" name="education_board[]">--}}
                {{--                                        <option--}}
                {{--                                            value="tribhuwan">--}}
                {{--                                            Tribuwan University--}}
                {{--                                        </option>--}}
                {{--                                        <option--}}
                {{--                                            value="kathmandu">--}}
                {{--                                            Kathmandu University--}}
                {{--                                        </option>--}}
                {{--                                        <option--}}
                {{--                                            value="purbanchal">--}}
                {{--                                            Purbanchal University--}}
                {{--                                        </option>--}}
                {{--                                        <option--}}
                {{--                                            value="pokhara">--}}
                {{--                                            Pokhara University--}}
                {{--                                        </option>--}}
                {{--                                    </select>--}}
                {{--                                    @error('education_board')--}}
                {{--                                    <span class="invalid-feedback" role="alert">--}}
                {{--                                        <strong>{{ $message }}</strong>--}}
                {{--                                    </span>--}}
                {{--                                    @enderror--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- row -->--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-12 col-sm-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <label>Name of Institute*</label>--}}
                {{--                                    <input type="text" class="form-control" name="institute_name[]"--}}
                {{--                                           value="{{ old('institute_name') }}"/>--}}
                {{--                                    @error('institute_name')--}}
                {{--                                    <span class="invalid-feedback" role="alert">--}}
                {{--                                        <strong>{{ $message }}</strong>--}}
                {{--                                    </span>--}}
                {{--                                    @enderror--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}

                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-3 col-sm-3">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <div class="checkbox checkbox-styled">--}}
                {{--                                        <label>--}}
                {{--                                            <input type="checkbox" name="education_is_current[]" class="ifCheck"--}}
                {{--                                                   value="yes"--}}
                {{--                                                   data-hide=".educationToggle"--}}
                {{--                                                {{ old('education_is_current') }}/>--}}
                {{--                                            <span>Currently Studying ?</span>--}}
                {{--                                            @error('is_current')--}}
                {{--                                            <span class="invalid-feedback" role="alert">--}}
                {{--                                        <strong>{{ $message }}</strong>--}}
                {{--                                    </span>--}}
                {{--                                            @enderror--}}
                {{--                                        </label>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- row -->--}}
                {{--                        <div class="educationToggle">--}}
                {{--                            <div class="row">--}}
                {{--                                <div class="col-lg-3 col-md-3 col-sm-12">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label>Graduation Year*</label>--}}
                {{--                                        <input type="text" class="form-control" name="passing_year[]"/>--}}
                {{--                                        @error('passing_year')--}}
                {{--                                        <span class="invalid-feedback" role="alert">--}}
                {{--                                        <strong>{{ $message }}</strong>--}}
                {{--                                    </span>--}}
                {{--                                        @enderror--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-lg-3 col-md-3 col-sm-12">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label>Marks Secured *</label>--}}
                {{--                                        <input type="text" name="marks_obtained[]" class="form-control"--}}
                {{--                                               placeholder="Marks Secured">--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-lg-3 col-md-3 col-sm-12">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <div class="form-group" style="margin-top: 6px;">--}}
                {{--                                            <label></label>--}}
                {{--                                            <select class="form-control input-lg" name="marks_type[]">--}}
                {{--                                                <option--}}
                {{--                                                    value="cgpa" {{ isset($education->marks_type) ? $education->marks_type == 'cgpa' ? 'selected' : '' : '' }}>--}}
                {{--                                                    CGPA--}}
                {{--                                                </option>--}}
                {{--                                                <option--}}
                {{--                                                    value="percent" {{ isset($education->marks_type) ? $education->marks_type == 'percent' ? 'selected' : '' : '' }}>--}}
                {{--                                                    %--}}
                {{--                                                </option>--}}
                {{--                                            </select>--}}
                {{--                                            @error('marks_type')--}}
                {{--                                            <span class="invalid-feedback" role="alert">--}}
                {{--                                        <strong>{{ $message }}</strong>--}}
                {{--                                    </span>--}}
                {{--                                            @enderror--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}

                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            @endif
            <div class="dynamicAddBtn">
                <button type="button" class="btn btn-success createCandidateClone" data-clone=".educations"
                        data-fieldname="educations"
                        data-appendto=".appendEducation"><i class="fa fa-plus"></i> Add Education
                </button>
            </div>
            <!-- row -->
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
    <script>
        $('body').on('focus', ".graduation_year", function () {
            $(this).datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true
            });
        });
    </script>
    <script>
        $(document).on('change', '.ifCheck', function () {
            var hide = $(this).data('hide');
            if (this.checked)
                $(hide).fadeOut('slow');
            else
                $(hide).fadeIn('slow');
        });
    </script>
@endsection
