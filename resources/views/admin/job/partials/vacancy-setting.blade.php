<div class="row extra-mrg">
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="form-group">
            <div class="checkbox checkbox-styled">
                <label>
                    <input type="checkbox" name="apply_online" id="online_toggle"
                           @if(isset($job) && $job->apply_online == 'yes') checked @else checked @endif/>
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
                           @if(isset($job) && $job->gender_specific == 'yes') checked @endif/>
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
                <option value="male" @if(isset($job) && $job->gender == 'male') selected @endif>Male</option>
                <option value="female" @if(isset($job) && $job->gender == 'female') selected @endif>Female</option>
                <option value="other" @if(isset($job) && $job->gender == 'other') selected @endif>Others</option>
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
                           @if(isset($job) && $job->age_specific == 'yes') checked @endif />
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
                <option value="more-than" @if(isset($job) && $job->age_type == 'more-than') selected @endif>More than
                </option>
                <option value="less-than" @if(isset($job) && $job->age_type == 'less-than') selected @endif>Less than
                </option>
                <option value="more-than-equal" @if(isset($job) && $job->age_type == 'more-than-equal') selected @endif>
                    More than or equals to
                </option>
                <option value="less-than-equal"
                         @if(isset($job) && $job->age_type == 'less-than-equal') selected @endif>Less than or equals to
                </option>
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
            <input type="number" min="1" step="5" class="form-control" name="age_value"
                   value="{{isset($job) ? $job->age_value : null}}" placeholder="Enter Age">
            @error('age_value')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12" id="apply_procedure">
        <div class="form-group">
            <strong>Apply Procedure</strong>
            <textarea name="apply_procedure" id=""
                      class="ckeditor">{{old('apply_procedure',isset($job->apply_procedure)?$job->apply_procedure : '')}}</textarea>
            <span id="textarea1-error"
                  class="text-danger">{{ $errors->first('apply_procedure') }}</span>
        </div>
    </div>
</div>
