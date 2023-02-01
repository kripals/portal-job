@extends('frontend.candidate.layouts.layout')
@section('page-specific-styles')
    <link rel="stylesheet" href="{{asset('resources/frontend/assets/css/bootstrap-tagsinput.css')}}">
@endsection
@section('candidate-content')

    <div class="dashboard-caption-header">
        <h4><i class="ti-briefcase"></i>Job Preference</h4>
    </div>

    <div class="dashboard-caption-wrap">
        <form class="post-form" action="{{ route('candidate.update.job-pref', $candidate) }}" method="POST" enctype="multipart/form-data" data-parsley-validate="">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Job Category*</label>
                        <select id="jb-category" class="job-categories form-control" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($candidateCategories as $category)
                                <option
                                        value="{{$category->id}}" {{ isset($candidate->category_id) ? $candidate->category_id == $category->id ? 'selected' : '' : '' }}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        <span id="textarea1-error"
                              class="text-danger">{{ $errors->first('category_id') }}</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Job Level*</label>
                        <select id="jb-level" class="job-level jb-minimal form-control" name="job_level_id" required>
                            <option value="">Select Job Level</option>
                            @foreach($jobLevels as $jobLevel)
                                <option
                                        value="{{$jobLevel->id}}" {{ isset($candidate->job_level_id) ? $candidate->job_level_id == $jobLevel->id ? 'selected' : '' : '' }}>{{$jobLevel->title}}</option>
                            @endforeach
                        </select>
                        <span id="textarea1-error"
                              class="text-danger">{{ $errors->first('job_level') }}</span>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Job Type*</label>
                        <select class="job-level jb-minimal form-control" name="job_types[]" required>
                            <option value="">Select Job Type</option>
                            @foreach($jobTypes as $type)
                                @if(isset($candidate->job_types) && !$candidate->job_types->isEmpty())
                                    @foreach($candidate->job_types as $jobTypes)
                                        <option
                                            value="{{$type->id}}"
                                            {{ $jobTypes->id == $type->id ? 'selected' : '' }}
                                        >{{$type->title}}</option>
                                    @endforeach
                                @else
                                    <option
                                        value="{{$type->id}}"
                                    >{{$type->title}}</option>
                                @endif
                            @endforeach
                        </select>
                        <span id="textarea1-error"
                              class="text-danger">{{ $errors->first('job_types') }}</span>
                    </div>
                </div>


            </div>
            <!-- row -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Specialization*</label>
                        <input type="text" class="form-control" name="specialization"
                               value="{{ old('specialization', isset($candidate->specialization) ? $candidate->specialization : '') }}"
                               placeholder="Course of work or position i.e. General Manager, Web Developer, Cashier etc." required>
                        <span id="textarea1-error" class="text-danger">{{ $errors->first('specialization') }}</span>
                    </div>
                </div>
            </div>

            <!-- row -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Skills*</label>
                        <select class="multiple-skill form-control" name="skill_id[]" multiple="multiple" required>
                            @foreach($skills as $skill)
                                @if(isset($candidate->known_skills) && !$candidate->known_skills->isEmpty())
                                    @foreach($candidate->known_skills as $knownSkill)
                                <option
                                        value="{{$skill->id}}" {{ $knownSkill->id == $skill->id ? 'selected' : '' }}>{{$skill->title}}</option>
                                    @endforeach
                                @else
                                    <option
                                        value="{{$skill->id}}"
                                    >{{$skill->title}}</option>
                                @endif
                            @endforeach
                        </select>
                        <span id="textarea1-error"
                              class="text-danger">{{ $errors->first('skill_id') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Preferred Country*</label>
                        <select class="preferred-country form-control" name="job_country_id" id="job_country_id" data-placeholder="Select Country" required>
                            <option value="">Select Country</option>
                            @foreach($jobCountries as $country)
                                <option
                                        value="{{$country->id}}" {{ isset($candidate->job_country_id) ? $candidate->job_country_id == $country->id ? 'selected' : '' : '' }}>{{$country->title}}</option>
                            @endforeach
                        </select>
                        <span id="textarea1-error"
                              class="text-danger">{{ $errors->first('job_country_id') }}</span>

                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Job Preference Location</label>
                            <select class="preferred-location form-control" name="location_id[]" id="location_id" multiple="multiple" data-placeholder="Select Location">
                            @foreach($jobLocations as $jobLocation)
                                @if(isset($candidate->preferred_locations) && !$candidate->preferred_locations->isEmpty())
                                    @foreach($candidate->preferred_locations as $preLocation)
                                <option
                                        value="{{$jobLocation->id}}" {{ $preLocation->id == $jobLocation->id ? 'selected' : '' }}>{{$jobLocation->title}}</option>
                                    @endforeach
                                @else
                                    <option
                                        value="{{$jobLocation->id}}"
                                    >{{$jobLocation->title}}</option>
                                @endif
                            @endforeach
                        </select>
                        <span id="textarea1-error"
                              class="text-danger">{{ $errors->first('location_id') }}</span>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Experience*</label>
{{--                        <input type="text" class="form-control" name="experience_period"--}}
{{--                               value="{{ old('experience_period', isset($candidate->experience_period) ? $candidate->experience_period : '') }}"/>--}}
                        <select name="experience_period" class="form-control jb-minimal" required>
                            <option value="0" {{ isset($candidate->experience_period) ? $candidate->experience_period == '0' ? 'selected' : '' : '' }}>No Experience</option>
                            <option value="1" {{ isset($candidate->experience_period) ? $candidate->experience_period == '1' ? 'selected' : '' : '' }}>1 Year</option>
                            <option value="2" {{ isset($candidate->experience_period) ? $candidate->experience_period == '2' ? 'selected' : '' : '' }}>2 Years</option>
                            <option value="3" {{ isset($candidate->experience_period) ? $candidate->experience_period == '3' ? 'selected' : '' : '' }}>3 Years</option>
                            <option value="4" {{ isset($candidate->experience_period) ? $candidate->experience_period == '4' ? 'selected' : '' : '' }}>4 Years</option>
                            <option value="5" {{ isset($candidate->experience_period) ? $candidate->experience_period == '5' ? 'selected' : '' : '' }}>5 Years</option>
                            <option value="6" {{ isset($candidate->experience_period) ? $candidate->experience_period == '6' ? 'selected' : '' : '' }}>6 Years</option>
                            <option value="7" {{ isset($candidate->experience_period) ? $candidate->experience_period == '7' ? 'selected' : '' : '' }}>7 Years</option>
                            <option value="8" {{ isset($candidate->experience_period) ? $candidate->experience_period == '8' ? 'selected' : '' : '' }}>8 Years</option>
                            <option value="9" {{ isset($candidate->experience_period) ? $candidate->experience_period == '9' ? 'selected' : '' : '' }}>9 Years</option>
                            <option value="10" {{ isset($candidate->experience_period) ? $candidate->experience_period == '10' ? 'selected' : '' : '' }}>10 Years</option>
                            <option value="11" {{ isset($candidate->experience_period) ? $candidate->experience_period == '11' ? 'selected' : '' : '' }}>11 Years</option>
                            <option value="12" {{ isset($candidate->experience_period) ? $candidate->experience_period == '12' ? 'selected' : '' : '' }}>12 Years</option>
                            <option value="13" {{ isset($candidate->experience_period) ? $candidate->experience_period == '13' ? 'selected' : '' : '' }}>13 Years</option>
                            <option value="14" {{ isset($candidate->experience_period) ? $candidate->experience_period == '14' ? 'selected' : '' : '' }}>14 Years</option>
                            <option value="15" {{ isset($candidate->experience_period) ? $candidate->experience_period == '15' ? 'selected' : '' : '' }}>15 Years</option>
                            <option value="16" {{ isset($candidate->experience_period) ? $candidate->experience_period == '16' ? 'selected' : '' : '' }}>16 Years</option>
                            <option value="17" {{ isset($candidate->experience_period) ? $candidate->experience_period == '17' ? 'selected' : '' : '' }}>17 Years</option>
                            <option value="18" {{ isset($candidate->experience_period) ? $candidate->experience_period == '18' ? 'selected' : '' : '' }}>18 Years</option>
                            <option value="19" {{ isset($candidate->experience_period) ? $candidate->experience_period == '19' ? 'selected' : '' : '' }}>19 Years</option>
                            <option value="20" {{ isset($candidate->experience_period) ? $candidate->experience_period == '20' ? 'selected' : '' : '' }}>20+ Years</option>
                        </select>
                        <span id="textarea1-error"
                              class="text-danger">{{ $errors->first('experience_period') }}</span>

                    </div>
                </div>
            </div>


            <!-- row -->
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Expected Salary*</label>
                        <select  name="exp_salary_currency" id="exp_salary_currency" class="form-control" required>
                            <option
                                    value="nrs" {{ isset($candidate->exp_salary_currency) ? $candidate->exp_salary_currency == 'nrs' ? 'selected' : '' : '' }}>
                                NRs
                            </option>
                            <option
                                    value="dollar" {{ isset($candidate->exp_salary_currency) ? $candidate->exp_salary_currency == 'dollar' ? 'selected' : '' : '' }}>
                                $
                            </option>
                            <option
                                    value="eur" {{ isset($candidate->exp_salary_currency) ? $candidate->exp_salary_currency == 'eur' ? 'selected' : '' : '' }}>
                                EUR
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label></label>
                        <select  name="exp_salary_type" id="exp_salary_type" class="form-control" required>
                            <option
                                    value="above" {{ isset($candidate->exp_salary_type) ? $candidate->exp_salary_type == 'above' ? 'selected' : '' : '' }}>
                                Above
                            </option>
                            <option
                                    value="equals" {{ isset($candidate->exp_salary_type) ? $candidate->exp_salary_type == 'equals' ? 'selected' : '' : '' }}>
                                Equals
                            </option>
                            <option
                                    value="below" {{ isset($candidate->exp_salary_type) ? $candidate->exp_salary_type == 'below' ? 'selected' : '' : '' }}>
                                Below
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label></label>
                        <input type="number" name="exp_salary_amount" min='0' class="form-control" placeholder="Amount" value="{{ isset($candidate->exp_salary_amount) ? $candidate->exp_salary_amount : '' }}" required data-parsley-type="number">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label></label>
                        <select  name="exp_salary_rate" id="exp_salary_rate" class="form-control" required>
                            <option
                                    value="hourly" {{ isset($candidate->exp_salary_rate) ? $candidate->exp_salary_rate == 'hourly' ? 'selected' : '' : '' }}>
                                Hourly
                            </option>
                            <option
                                    value="daily" {{ isset($candidate->exp_salary_rate) ? $candidate->exp_salary_rate == 'daily' ? 'selected' : '' : '' }}>
                                Daily
                            </option>
                            <option
                                    value="weekly" {{ isset($candidate->exp_salary_rate) ? $candidate->exp_salary_rate == 'weekly' ? 'selected' : '' : '' }}>
                                Weekly
                            </option>
                            <option
                                    value="monthly" selected {{ isset($candidate->exp_salary_rate) ? $candidate->exp_salary_rate == 'monthly' ? 'selected' : '' : '' }}>
                                Monthly
                            </option>
                            <option
                                    value="yearly" {{ isset($candidate->exp_salary_rate) ? $candidate->exp_salary_rate == 'yearly' ? 'selected' : '' : '' }}>
                                Yearly
                            </option>
                        </select>
                    </div>
                </div>
            </div>


            <!-- row -->
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Current Salary*</label>
                        <select  name="cur_salary_currency" id="cur_salary_currency" class="form-control" disabled required>
                            <option
                                    value="nrs" {{ isset($candidate->cur_salary_currency) ? $candidate->cur_salary_currency == 'nrs' ? 'selected' : '' : '' }}>
                                NRs
                            </option>
                            <option
                                    value="dollar" {{ isset($candidate->cur_salary_currency) ? $candidate->cur_salary_currency == 'dollar' ? 'selected' : '' : '' }}>
                                $
                            </option>
                            <option
                                    value="eur" {{ isset($candidate->cur_salary_currency) ? $candidate->cur_salary_currency == 'eur' ? 'selected' : '' : '' }}>
                                EUR
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label></label>
                        <select  name="cur_salary_type" id="cur_salary_type" class="form-control" disabled required>
                            <option
                                    value="above" {{ isset($candidate->cur_salary_type) ? $candidate->cur_salary_type == 'above' ? 'selected' : '' : '' }}>
                                Above
                            </option>
                            <option
                                    value="equals" {{ isset($candidate->cur_salary_type) ? $candidate->cur_salary_type == 'equals' ? 'selected' : '' : '' }}>
                                Equals
                            </option>
                            <option
                                    value="below" {{ isset($candidate->cur_salary_type) ? $candidate->cur_salary_type == 'below' ? 'selected' : '' : '' }}>
                                Below
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label></label>
                        <input type="number" name="cur_salary_amount" min="0" class="form-control" placeholder="Amount" value="{{ isset($candidate->cur_salary_amount) ? $candidate->cur_salary_amount : '' }}" required data-parsley-type="number">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label></label>
                        <select class="form-control" name="cur_salary_rate" id="cur_salary_rate" disabled required>
                            <option
                                    value="hourly" {{ isset($candidate->cur_salary_rate) ? $candidate->cur_salary_rate == 'hourly' ? 'selected' : '' : '' }}>
                                Hourly
                            </option>
                            <option
                                    value="daily" {{ isset($candidate->cur_salary_rate) ? $candidate->cur_salary_rate == 'daily' ? 'selected' : '' : '' }}>
                                Daily
                            </option>
                            <option
                                    value="weekly" {{ isset($candidate->cur_salary_rate) ? $candidate->cur_salary_rate == 'weekly' ? 'selected' : '' : '' }}>
                                Weekly
                            </option>
                            <option
                                    value="monthly" selected {{ isset($candidate->cur_salary_rate) ? $candidate->cur_salary_rate == 'monthly' ? 'selected' : '' : '' }}>
                                Monthly
                            </option>
                            <option
                                    value="yearly" {{ isset($candidate->cur_salary_rate) ? $candidate->cur_salary_rate == 'yearly' ? 'selected' : '' : '' }}>
                                Yearly
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Description*</label>
                        <textarea name="description" class="form-control about height-120" required>
                            {{old('description',isset($candidate->description)?$candidate->description : '')}}
                        </textarea>
                        <span id="textarea1-error"
                              class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                </div>
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
    <script src="{{ asset('resources/frontend/assets/js/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
    <script>
        $('#job_country_id').on('change',function () {
            if($(this).val() != '')
            {
                var value = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('candidate.fetch.location') }}",
                    method:"POST",
                    data:{country_id:value, _token:_token},
                    success:function(result)
                    {
                        $('#location_id').html(result)
                    }
                })
            }
        })

        $('#exp_salary_currency').on('change',function(){
            var val = $(this).val();
            var child = $('#cur_salary_currency');
            child.val(val);
        });
        $('#exp_salary_rate').on('change',function(){
            var val = $(this).val();
            var child = $('#cur_salary_rate');
            child.val(val);
        });
        $('#exp_salary_type').on('change',function(){
            var val = $(this).val();
            var child = $('#cur_salary_type');
            if(val == 'above'){
                child.val('below');
            }else if(val == 'below'){
                child.val('above');
            }else{
                child.val(val);
            }
        });
    </script>
@endsection
