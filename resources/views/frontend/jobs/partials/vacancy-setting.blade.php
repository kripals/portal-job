<div class="row extra-mrg">
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="form-group">
            <div class="checkbox checkbox-styled">
                <label>
                    <input type="checkbox" name="apply_online" id="online_toggle"
                           @if(isset($jobDetail) && $jobDetail->apply_online == 'yes') checked @else checked @endif/>
                    <span>Apply Online?</span>
                    @error('apply_online')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </label>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="form-group">
            <div class="checkbox checkbox-styled">
                <label>
                    <input type="checkbox" name="gender_specific"
                           @if(isset($jobDetail) && $jobDetail->gender_specific == 'yes') checked @endif/>
                    <span>Is Gender Specific?</span>
                    @error('gender_specific')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </label>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="form-group">
            <select id="jb-level" class="form-control jb-minimal" name="gender">
                <option value="">Select Gender</option>
                <option value="all" @if(isset($jobDetail) && $jobDetail->gender == 'all') selected @endif>All
                </option>
                <option value="male" @if(isset($jobDetail) && $jobDetail->gender == 'male') selected @endif>Male
                </option>
                <option value="female" @if(isset($jobDetail) && $jobDetail->gender == 'female') selected @endif>Female
                </option>
                <option value="other" @if(isset($jobDetail) && $jobDetail->gender == 'other') selected @endif>Other
                </option>
            </select>

            @error('gender_specific')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<!-- row -->
<div class="row extra-mrg">
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="form-group">
            <div class="checkbox checkbox-styled">
                <label>
                    <input type="checkbox" name="age_specific"
                           @if(isset($jobDetail) && $jobDetail->age_specific == 'yes') checked @endif />
                    <span>Is Age Specific?</span>
                    @error('age_specific')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-5 col-sm-5">
        <div class="form-group">
            <select class="form-control jb-minimal" name="age_type">
                <option value="">Select Age Type</option>
                <option value="more-than" @if(isset($jobDetail) && $jobDetail->age_type == 'more-than') selected @endif>
                    More than
                </option>
                <option value="less-than" @if(isset($jobDetail) && $jobDetail->age_type == 'less-than') selected @endif>
                    Less than
                </option>
                <option value="more-than-equal"
                        @if(isset($jobDetail) && $jobDetail->age_type == 'more-than-equal') selected @endif>More than or
                    equals to
                </option>
                <optionc value="less-than-equal"
                         @if(isset($jobDetail) && $jobDetail->age_type == 'less-than-equal') selected @endif>Less than
                    or equals to
                </optionc>
            </select>

            @error('age_type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="number" min="1" class="form-control" name="age_value"
                   value="{{isset($jobDetail) ? $jobDetail->age_value : null}}" placeholder="Enter Age">
            @error('age_value')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12" id="apply_procedure">
        <div class="form-group">
            <label> Apply Procedure</label>
            <textarea class="form-control textarea" name="apply_procedure">
                {{isset($jobDetail) ? $jobDetail->apply_procedure : null}}
            </textarea>
            @error('apply_procedure')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<!-- row -->
<div class="row mrg-top-30">
    <div class="col-md-6 col-sm-6">
        <div class="form-group text-center">
            @if(isset($type) && $type == 'edit')
                <a type="button" href="{{route('company.job.description',$jobDetail->ref_id)}}" class="btn-savepreview">Back
                    to Job Description</a>
            @else
                <a type="button" href="{{route('company.job.description')}}" class="btn-savepreview">Back
                    to Job Description</a>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="form-group text-center">
            @if(isset($type) && $type == 'edit')
                <button type="submit" name="submit" value="vacancy_setting" class="btn-savepreview">Edit Job</button>
            @else
                <button type="submit" name="submit" value="vacancy_setting" class="btn-savepreview">Create Job</button>
            @endif
        </div>
    </div>
</div>
