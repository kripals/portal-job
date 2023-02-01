@extends('frontend.candidate.layouts.layout')
@section('page-specific-styles')
    <link href="{{ asset('resources/admin/css/theme-default/libs/bootstrap-datepicker/datepicker3.css?1424887858') }}"
          rel="stylesheet">
@endsection
@section('candidate-content')

    <div class="dashboard-caption-header">
        <h4><i class="ti-bookmark-alt"></i>Work Experience</h4>
    </div>

    <div class="dashboard-caption-wrap">
        <form class="form form-validate floating-label" action="{{route('candidate.store.experience', $candidate)}}"
              method="POST" enctype="multipart/form-data" data-parsley-validate="">
            @csrf
            @if(!$experiences->isEmpty())
                <div class="clonedInput experiences" id="removeId1" data-fieldname="experiences">
                    <div class="appendExperiences" id="clonedInput">
                        @foreach($experiences as $experience)
                            <div id="parentId">
                                <input type="hidden" name="experiences_ref_id[]" value="{{$experience->ref_id}}"
                                       required>
                                @if(!$loop->first)
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-1" style="float: right">
                                            <div class="form-group">
                                                <button class="btn btn-danger removeThis"
                                                        data-url="{{route('candidate.front.removeFields')}}"
                                                        data-item-name="experiences"
                                                        data-ref-id="{{$experience->ref_id}}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Organization name*</label>
                                            <input type="text" name="company_name[]" class="form-control"
                                                   value="{{ old('company_name', isset($experience->company_name) ? $experience->company_name : '') }}"
                                                   placeholder="Enter name of the organization of experience"
                                                   required/>
                                            <span id="textarea1-error"
                                                  class="text-danger">{{ $errors->first('company_name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Nature of Organization*</label>
                                            <select class="language form-control" name="company_category_id[]" required>
                                                <option value="">Select the nature of the organization</option>
                                                @foreach($companyCategories as $category)
                                                    <option
                                                        value="{{$category->id}}" {{ isset($experience->company_category_id) ? $experience->company_category_id == $category->id ? 'selected' : '' : '' }}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- row -->
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Job Title*</label>
                                            <input type="text" name="experience_job_title[]" class="form-control"
                                                   value="{{ old('job_title', isset($experience->job_title) ? $experience->job_title : '') }}"
                                                   placeholder="Enter the job title Eg: General Manager, Security Guard, Cashier etc"
                                                   required/>
                                            <span id="textarea1-error"
                                                  class="text-danger">{{ $errors->first('job_title') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Job Categories*</label>
                                            <select class="language form-control" name="candidate_category_id[]"
                                                    required>
                                                <option value="">Select the category of the work/job</option>
                                                @foreach($candidateCategories as $category)
                                                    <option
                                                        value="{{$category->id}}" {{ isset($experience->candidate_category_id) ? $experience->candidate_category_id == $category->id ? 'selected' : '' : '' }}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- row -->
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Job level*</label>
                                            <select class="language form-control" name="experience_job_level_id[]"
                                                    required>
                                                <option value="">Select Job Level</option>
                                                @foreach($jobLevels as $jobLevel)
                                                    <option
                                                        value="{{$jobLevel->id}}" {{ isset($jobLevel->job_level_id) ? $experience->job_level_id == $jobLevel->id ? 'selected' : '' : '' }}>{{$jobLevel->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Job location*</label>
                                            <select class="language form-control" name="experience_location_id[]"
                                                    required>
                                                <option value="">Select the location of experience</option>
                                                @foreach($jobLocations as $location)
                                                    <option
                                                        value="{{$location->id}}" {{ isset($experience->location_id) ? $experience->location_id == $location->id ? 'selected' : '' : '' }}>{{$location->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-styled">
                                                <label>
                                                    <input type="checkbox" name="experience_is_current[]"
                                                           class="ifCheck" value="yes"
                                                           data-hide=".experienceToggle{{$experience->ref_id}}"
                                                           value="yes"
                                                        {{ old('is_current', isset($experience->is_current) ? $experience->is_current : '')=='yes' ? 'checked':'' }}/>
                                                    <span>Is Current Job ?</span>
                                                    @error('is_current')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="experienceToggle{{$experience->ref_id}}"
                                     @if($experience->is_current == 'yes')style="display: none;"@endif>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <div class="input-daterange form-group date-range" id="demo-date-range">
                                                <label>Start Date (From)*</label>
                                                <input type="text" class="form-control experience_period"
                                                       name="experience_start_date[]" placeholder="DD Month YYYY" onkeydown="return false"
                                                       value="{{ old('experience_start_date', isset($experience->start_date) ? $experience->start_date : '') }}"
                                                       required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <div class="input-daterange form-group date-range" id="demo-date-range">
                                                <label>End Date (To)*</label>
                                                <input type="text" class="form-control experience_period"
                                                       name="experience_end_date[]" placeholder="DD Month YYYY" onkeydown="return false"
                                                       value="{{ old('experience_end_date', isset($experience->end_date) ? $experience->end_date : '') }}"
                                                       required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="experience_description[]"
                                                      class="form-control about height-120" placeholder="Duties and responsibilities to highlight your work experience">
                                                {{old('description',isset($experience->description)?$experience->description : '')}}
                                            </textarea>
                                            <span id="textarea1-error"
                                                  class="text-danger">{{ $errors->first('description') }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                {{--                <div class="clonedInput experiences" id="removeId1" data-fieldname="experiences">--}}
                {{--                    <div class="appendExperiences" id="clonedInput">--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-12 col-sm-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <label>Organization name*</label>--}}
                {{--                                    <input type="text" name="company_name[]" class="form-control"--}}
                {{--                                           value="{{ old('company_name') }}" required/>--}}
                {{--                                    <span id="textarea1-error"--}}
                {{--                                          class="text-danger">{{ $errors->first('company_name') }}</span>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- row -->--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-12 col-sm-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <label>Nature of Organization*</label>--}}
                {{--                                    <select class="language form-control" name="company_category_id[]" required>--}}
                {{--                                        @foreach($companyCategories as $category)--}}
                {{--                                            <option--}}
                {{--                                                    value="{{$category->id}}" {{ isset($experience->category_id) ? $experience->category_id == $category->id ? 'selected' : '' : '' }}>{{$category->name}}</option>--}}
                {{--                                        @endforeach--}}
                {{--                                    </select>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- row -->--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-12 col-sm-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <label>Job Title*</label>--}}
                {{--                                    <input type="text" name="experience_job_title[]" class="form-control"--}}
                {{--                                           value="{{ old('job_title') }}" required/>--}}

                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- row -->--}}

                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-12 col-sm-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <label>Job Categories*</label>--}}
                {{--                                    <select class="language form-control" name="candidate_category_id[]" required>--}}
                {{--                                        @foreach($candidateCategories as $category)--}}
                {{--                                            <option--}}
                {{--                                                    value="{{$category->id}}" {{ isset($experience->category_id) ? $experience->category_id == $category->id ? 'selected' : '' : '' }}>{{$category->name}}</option>--}}
                {{--                                        @endforeach--}}
                {{--                                    </select>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- row -->--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-12 col-sm-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <label>Job level*</label>--}}
                {{--                                    <select class="language form-control" name="experience_job_level_id[]" required>--}}
                {{--                                        @foreach($jobLevels as $jobLevel)--}}
                {{--                                            <option--}}
                {{--                                                    value="{{$jobLevel->id}}" {{ isset($jobLevel->job_level_id) ? $experience->job_level_id == $jobLevel->id ? 'selected' : '' : '' }}>{{$jobLevel->title}}</option>--}}
                {{--                                        @endforeach--}}
                {{--                                    </select>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- row -->--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-12 col-sm-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <label>Job location*</label>--}}
                {{--                                    <select class="language form-control" name="experience_location_id[]" required>--}}
                {{--                                        @foreach($jobLocations as $location)--}}
                {{--                                            <option--}}
                {{--                                                    value="{{$location->id}}" {{ isset($location->location_id) ? $experience->location_id == $location->id ? 'selected' : '' : '' }}>{{$location->title}}</option>--}}
                {{--                                        @endforeach--}}
                {{--                                    </select>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}

                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-3 col-sm-3">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <div class="checkbox checkbox-styled">--}}
                {{--                                        <label>--}}
                {{--                                            <input type="checkbox" name="experience_is_current[]" class="ifCheck"--}}
                {{--                                                   value="yes" data-hide=".experienceToggle"--}}
                {{--                                                    {{ old('is_current') }}/>--}}
                {{--                                            <span>Is Current Job ?</span>--}}
                {{--                                        </label>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="experienceToggle">--}}
                {{--                            <div class="row">--}}
                {{--                                <div class="col-lg-3 col-md-3 col-sm-12">--}}
                {{--                                    <div class="input-daterange form-group date-range" id="demo-date-range">--}}
                {{--                                        <label>Start Date (From)*</label>--}}
                {{--                                        <input type="text" class="form-control experience_period" name="experience_start_date[]"--}}
                {{--                                               value="{{ old('start_date') }}" required/>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-lg-3 col-md-3 col-sm-12">--}}
                {{--                                    <div class="input-daterange form-group date-range" id="demo-date-range">--}}
                {{--                                        <label>End Date (To)*</label>--}}
                {{--                                        <input type="text" class="form-control experience_period" name="experience_end_date[]"--}}
                {{--                                               value="{{ old('end_date') }}" required/>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-12 col-sm-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <label>Description</label>--}}
                {{--                                    <textarea name="experience_description[]" class="form-control about height-120"--}}
                {{--                                              required>{{old('description')}}</textarea>--}}
                {{--                                    <span id="textarea1-error"--}}
                {{--                                          class="text-danger">{{ $errors->first('description') }}</span>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            @endif
            <div class="dynamicAddBtn">
                <button type="button" class="btn btn-success createCandidateClone" data-clone=".experiences"
                        data-fieldname="experiences"
                        data-appendto=".appendExperiences"><i class="fa fa-plus"></i> Add Work Experience
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
    <script src="{{ asset('resources/admin/js/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script>
        $('body').on('focus', ".experience_period", function () {
            $(this).datepicker({
                format: "dd MM yyyy",
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


