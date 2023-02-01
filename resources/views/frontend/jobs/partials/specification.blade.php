 <div class="row extra-mrg">
    <h2 class="detail-title">Required Education</h2>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="form-group">
            <div class="checkbox checkbox-styled">
                <label>
                    <input type="checkbox" name="education_requirement"
                           @if(isset($jobDetail) && $jobDetail->education_requirement == 'yes') checked @endif/>
                    <span>Is Education Specific?</span>
                    @error('education_requirement')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </label>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="form-group">
            <label>Education Level*</label>
            <select class="form-control jb-minimal" name="education_level">
                <option value="">Select Education Level</option>
                <option value="slc" @if(isset($jobDetail) && $jobDetail->education_level == 'slc') selected @endif>SLC</option>
                <option value="intermediate"
                        @if(isset($jobDetail) && $jobDetail->education_level == 'intermediate') selected @endif>Intermediate
                </option>
                <option value="bachelor" @if(isset($jobDetail) && $jobDetail->education_level == 'bachelor') selected @endif>
                    Bachelors
                </option>
                <option value="diploma" @if(isset($jobDetail) && $jobDetail->education_level == 'diploma') selected @endif>
                    Diploma
                </option>
                <option value="master" @if(isset($jobDetail) && $jobDetail->education_level == 'master') selected @endif>Masters
                </option>
                <option value="phd" @if(isset($jobDetail) && $jobDetail->education_level == 'phd') selected @endif>PHD</option>
                <option value="other" @if(isset($jobDetail) && $jobDetail->education_level == 'other') selected @endif>other
                </option>
            </select>

            @error('education_level')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<!-- row -->
<div class="row extra-mrg">
    <h2 class="detail-title">Required Work Experience</h2>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="form-group">
            <div class="checkbox checkbox-styled">
                <label>
                    <input type="checkbox" name="experience_requirement"
                           @if(isset($jobDetail) && $jobDetail->experience_requirement == 'yes') checked @endif/>
                    <span>Is Experience Specific?</span>
                    @error('experience_requirement')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <label>Experience(In Years)</label>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <select class="form-control jb-minimal" name="experience_type">
                <option value="">Select Job Level</option>
                <option value="more-than" @if(isset($jobDetail) && $jobDetail->experience_type == 'more-than') selected @endif>More
                    than
                </option>
                <option value="less-than" @if(isset($jobDetail) && $jobDetail->experience_type == 'less-than') selected @endif>Less
                    than
                </option>
                <option value="more-than-equal"
                        @if(isset($jobDetail) && $jobDetail->experience_type == 'more-than-equal') selected @endif>More than or
                    equals to
                </option>
                <option value="less-than-equal"
                        @if(isset($jobDetail) && $jobDetail->experience_type == 'less-than-equal') selected @endif>Less than or
                    equals to
                </option>
            </select>

            @error('experience_type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <select class="form-control jb-minimal" name="experience_value">
                <option value="">Select Experience Year(s)</option>
                <option value="0" @if(isset($jobDetail) && $jobDetail->experience_value == '0') selected @endif>No Experience
                </option>
                <option value="1" @if(isset($jobDetail) && $jobDetail->experience_value == '1') selected @endif> 1 Years</option>
                <option value="2" @if(isset($jobDetail) && $jobDetail->experience_value == '2') selected @endif> 2 Years</option>
                <option value="3" @if(isset($jobDetail) && $jobDetail->experience_value == '3') selected @endif> 3 Years</option>
                <option value="4" @if(isset($jobDetail) && $jobDetail->experience_value == '4') selected @endif> 4 Years</option>
                <option value="5" @if(isset($jobDetail) && $jobDetail->experience_value == '5') selected @endif> 5 Years</option>
                <option value="6" @if(isset($jobDetail) && $jobDetail->experience_value == '6') selected @endif> 6 Years</option>
                <option value="7" @if(isset($jobDetail) && $jobDetail->experience_value == '7') selected @endif> 7 Years</option>
                <option value="8" @if(isset($jobDetail) && $jobDetail->experience_value == '8') selected @endif> 8 Years</option>
                <option value="9" @if(isset($jobDetail) && $jobDetail->experience_value == '9') selected @endif> 9 Years</option>
                <option value="10" @if(isset($jobDetail) && $jobDetail->experience_value == '10') selected @endif> 10+ Years
                </option>
            </select>

            @error('experience_value')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<!-- row -->
<div class="row extra-mrg">
    <h2 class="detail-title">Required Skill</h2>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="form-group">
            <div class="checkbox checkbox-styled">
                <label>
                    <input type="checkbox" name="skill_requirement"
                           @if(isset($jobDetail) && $jobDetail->skill_requirement == 'yes') checked @endif/>
                    <span>Is Skill Specific?</span>
                    @error('skill_requirement')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </label>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="form-group">
            <label>Skills Required</label>
            <select class="multiple-skill form-control" multiple="multiple" name="skills[]">
                @foreach($jobSkills as $skill)
                    <option value="{{$skill->slug}}">{{$skill->title}}</option>
                @endforeach
            </select>

            @error('skills')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="form-group">
            <label>Other Job Specification</label>
            <textarea class="form-control textarea" name="specification"
                      required>{{isset($jobDetail) ? $jobDetail->specification : null }}</textarea>

            @error('specification')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<!-- row -->
<!-- row -->
<div class="row mrg-top-30">
    <div class="col-md-6 col-sm-6">
        <div class="form-group text-center">
            @if(isset($type) && $type == 'edit')
                    <a type="button" href="{{route('company.job.edit',$jobDetail->ref_id)}}" class="btn-savepreview">Back to Job Information</a>
            @else
            <a type="button" href="{{route('company.job.create')}}" class="btn-savepreview">Back to Job Information</a>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="form-group text-center">
            <button type="submit" name="submit" value="job_specific" class="btn-savepreview">Continue to Job
                Description
            </button>
        </div>
    </div>
</div>
