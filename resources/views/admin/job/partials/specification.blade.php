<div class="row">
    <div class="col-md-12">
        <h4>Required Education</h4>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox checkbox-styled">
                <label>
                    <input type="checkbox" name="education_requirement" value="yes"
                        {{ old('education_requirement', isset($job->education_requirement) ? $job->education_requirement : '')=='yes' ? 'checked':'' }}/>
                    <span>Is Education Specific?</span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
            <select name="education_level" class="form-control">
                <option value="">Select Education Level</option>
                <option
                    value="phd" {{ isset($job->education_level) ? $job->education_level =='phd' ? 'selected':'':'' }}>
                    Ph.D.
                </option>
                <option
                    value="master" {{ isset($job->education_level) ? $job->education_level =='master' ? 'selected':'':'' }}>
                    Masters
                </option>
                <option
                    value="bachelor" {{ isset($job->education_level) ? $job->education_level =='bachelor' ? 'selected':'':'' }}>
                    Bachelor
                </option>
                <option
                    value="intermediate" {{ isset($job->education_level) ? $job->education_level =='intermediate' ? 'selected':'':'' }}>
                    Intermediate
                </option>
                <option
                    value="slc" {{ isset($job->education_level) ? $job->education_level =='slc' ? 'selected':'':'' }}>
                    SLC/SEE
                </option>
                <option
                    value="other" {{ isset($job->education_level) ? $job->education_level =='other' ? 'selected':'':'' }}>
                    Other
                </option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4>Required Work Experience</h4>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox checkbox-styled">
                <label>
                    <input type="checkbox" name="experience_requirement" value="yes"
                        {{ old('experience_requirement', isset($job->experience_requirement) ? $job->experience_requirement : '')=='yes' ? 'checked':''  }}/>
                    <span>Is Experience Specific?</span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <select name="experience_type" class="form-control">
                <option
                    value="more-than" {{ isset($job->experience_type) ? $job->experience_type =='more-than' ? 'selected':'':'' }}>
                    More Than
                </option>
                <option
                    value="less-than" {{ isset($job->experience_type) ? $job->experience_type =='less-than' ? 'selected':'':'' }}>
                    Less Than
                </option>
                <option
                    value="more-than-equal" {{ isset($job->experience_type) ? $job->experience_type =='more-than-equal' ? 'selected':'':'' }}>
                    More Than or Equals to
                </option>
                <option
                    value="less-than-equal" {{ isset($job->experience_type) ? $job->experience_type =='less-than-equal' ? 'selected':'':'' }}>
                    Less Than or Equals to
                </option>
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <input type="number" name="experience_value" class="form-control" min="0"
                   value="{{old('experience_value',isset($job->experience_value) ? $job->experience_value: '')}}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4>Required Skill</h4>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <div class="checkbox checkbox-styled">
                <label>
                    <input type="checkbox" name="skill_requirement" value="yes"
                        {{ old('skill_requirement', isset($job->skill_requirement) ? $job->skill_requirement : '')=='yes' ? 'checked':'' }}/>
                    <span>Is Skill Specific?</span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-sm-10">
        <div class="form-group">
            <select class="form-control select2-list" name="skills[]"
                    multiple required>
                @foreach($jobSkills as $key=>$skillData)
                    @if(isset($job->skills) && !$job->skills->isEmpty())
                        @foreach($job->skills as $skill)
                            <option
                                value="{{$skillData->slug}}" {{$skillData->id == $skill->id  ? 'selected' : '' }}>{{$skillData->title}}</option>
                        @endforeach
                    @else
                        <option
                            value="{{$skillData->slug}}"
                        >{{$skillData->title}}</option>
                    @endif
                @endforeach
            </select>
            <label>Skill Required</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <strong>Job Specification</strong>
            <textarea name="specification" id=""
                      class="ckeditor">{{old('specification',isset($job->specification)?$job->specification : '')}}</textarea>
            <span id="textarea1-error"
                  class="text-danger">{{ $errors->first('specification') }}</span>
        </div>
    </div>
</div>
