<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="form-group">
            <label> Job Description</label>
            <textarea class="form-control textarea" name="description"
                      required>{{isset($jobDetail) ? $jobDetail->description : null}}</textarea>

            @error('description')
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
            <a type="button" href="{{route('company.job.specification',$jobDetail->ref_id)}}" class="btn-savepreview">Back
                to Job Specification</a>
            @else
                <a type="button" href="{{route('company.job.specification')}}" class="btn-savepreview">Back
                    to Job Specification</a>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="form-group text-center">
            <button type="submit" name="submit" value="job_desc" class="btn-savepreview">Continue to Vacancy Settings
            </button>
        </div>
    </div>
</div>
