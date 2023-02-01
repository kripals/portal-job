<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <strong>Job Description</strong>
            <textarea name="description" id=""
                      class="ckeditor">{{old('description',isset($job->description)?$job->description : '')}}</textarea>
            <span id="textarea1-error"
                  class="text-danger">{{ $errors->first('description') }}</span>
        </div>
    </div>
</div>
