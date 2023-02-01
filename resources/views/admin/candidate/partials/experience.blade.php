@if(isset($experiences))
    <div class="clonedInput experiences" id="removeId1" data-fieldname="experiences">
        <div class="appendExperience" id="clonedInput">
            @foreach($experiences as $experience)
                <div id="parentId">
                    <input type="hidden" name="experiences_ref_id[]" value="{{$experience->ref_id}}">
                    <div class="row">
                        <div class="col-sm-11">
                            <div class="form-group">
                                <input type="text" name="company_name[]" class="form-control" id="number2"
                                       value="{{ old('company_name', isset($experience->company_name) ? $experience->company_name : '') }}"/>
                                <span id="textarea1-error"
                                      class="text-danger">{{ $errors->first('company_name') }}</span>
                                <label for="Company">Company Name</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            @if(!$loop->first)
                                <button class="btn btn-danger removeThis" data-url="{{route('remove.candidateFields')}}"
                                        data-item-name="experiences" data-ref-id="{{$experience->ref_id}}"><i
                                        class="fa fa-trash"></i></button>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-content">
                                        <select class="form-control select2-list" name="company_category_id[]"
                                                data-placeholder="Nature of Organisation">
                                            @foreach($companyCategories as $category)
                                                <option
                                                    value="{{$category->id}}" {{ isset($candidate->category_id) ? $experience->category_id == $category->id ? 'selected' : '' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        <label>Nature of Organisation</label>
                                        <span id="textarea1-error"
                                              class="text-danger">{{ $errors->first('category_id') }}</span>
                                    </div>
                                    <div class="input-group-btn">
                                        <a href="{{route('category.create','company')}}">
                                            <button class="btn btn-default" type="button"><i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select class="form-control select2-list" name="experience_location_id[]">
                                    @foreach($jobLocations as $location)
                                        <option
                                            value="{{$location->id}}" {{ isset($candidate->location_id) ? $experience->location_id == $location->id ? 'selected' : '' : '' }}>{{$location->title}}</option>
                                    @endforeach
                                </select>
                                <label>Select Location</label>
                                <span id="textarea1-error"
                                      class="text-danger">{{ $errors->first('location_id') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select class="form-control select2-list" name="experience_job_level_id[]"
                                        data-placeholder="Select job level">
                                    @foreach($jobLevels as $level)
                                        <option
                                            value="{{$level->id}}" {{ isset($candidate->job_level_id) ? $experience->job_level_id == $level->id ? 'selected' : '' : '' }}>{{$level->title}}</option>
                                    @endforeach
                                </select>
                                <label>Job Level</label>
                                <span id="textarea1-error"
                                      class="text-danger">{{ $errors->first('job_level') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="experience_job_title[]" class="form-control"
                                       value="{{ old('job_title', isset($experience->job_title) ? $experience->job_title : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('job_title') }}</span>
                                <label for="Name">Job Title</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select class="form-control select2-list" name="candidate_category_id[]"
                                        data-placeholder="Job Category">
                                    @foreach($candidateCategories as $category)
                                        <option
                                            value="{{$category->id}}" {{ isset($candidate->category_id) ? $experience->category_id == $category->id ? 'selected' : '' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <label>Job Category</label>
                                <span id="textarea1-error"
                                      class="text-danger">{{ $errors->first('category_id') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="checkbox checkbox-styled">
                                    <label>
                                        <input type="checkbox" name="experience_is_current[]" class="ifCheck"
                                               data-hide=".experienceToggle{{$experience->ref_id}}" value="yes"
                                            {{ old('is_current', isset($experience->is_current) ? $experience->is_current : '')=='yes' ? 'checked':'' }}/>
                                        <span>is Current Job?</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="experienceToggle{{$experience->ref_id}}" @if($experience->is_current == 'yes')style="display: none;"@endif>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <div class="input-daterange date-range input-group" id="demo-date-range">
                                        <div class="input-group-content">
                                            <input type="text" class="form-control" name="experience_start_date[]"
                                                   value="{{ old('start_date', isset($experience->start_date) ? $experience->start_date : '') }}"/>
                                            <label>Start Date</label>
                                        </div>
                                        <span class="input-group-addon">to</span>
                                        <div class="input-group-content">
                                            <input type="text" class="form-control" name="experience_end_date[]"
                                                   value="{{ old('end_date', isset($experience->end_date) ? $experience->end_date : '') }}"/>
                                            <label for="Name">End Date</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <strong>Description</strong>
                                <textarea name="experience_description[]" id=""
                                          class="ckeditor">{{old('description',isset($experience->description)?$experience->description : '')}}</textarea>
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
{{--    <div class="clonedInput experiences" id="removeId1" data-fieldname="experiences">--}}
{{--        <div class="appendExperience" id="clonedInput">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="company_name[]" class="form-control" id="number2"--}}
{{--                               value=""/>--}}
{{--                        <label for="Company">Company Name</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-content">--}}
{{--                                <select class="form-control select2-list" name="company_category_id[]"--}}
{{--                                        data-placeholder="Nature of Organisation">--}}
{{--                                    @foreach($companyCategories as $category)--}}
{{--                                        <option--}}
{{--                                            value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <label>Nature of Organisation</label>--}}
{{--                                <span id="textarea1-error"--}}
{{--                                      class="text-danger">{{ $errors->first('category_id') }}</span>--}}
{{--                            </div>--}}
{{--                            <div class="input-group-btn">--}}
{{--                                <a href="{{route('category.create','company')}}">--}}
{{--                                    <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <select class="form-control select2-list" name="experience_location_id[]">--}}
{{--                            @foreach($jobLocations as $location)--}}
{{--                                <option--}}
{{--                                    value="{{$location->id}}">{{$location->title}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <label>Select Location</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <select class="form-control select2-list" name="experience_job_level_id[]"--}}
{{--                                data-placeholder="Select job level">--}}
{{--                            @foreach($jobLevels as $level)--}}
{{--                                <option--}}
{{--                                    value="{{$level->id}}">{{$level->title}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <label>Job Level</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="experience_job_title[]" class="form-control"--}}
{{--                               value=""/>--}}
{{--                        <label for="Name">Job Title</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <select class="form-control select2-list" name="candidate_category_id[]"--}}
{{--                                data-placeholder="Job Category">--}}
{{--                            @foreach($candidateCategories as $category)--}}
{{--                                <option--}}
{{--                                    value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <label>Job Category</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-4">--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="checkbox checkbox-styled">--}}
{{--                            <label>--}}
{{--                                <input type="checkbox" name="experience_is_current[]" class="ifCheck" value="yes"--}}
{{--                                       data-hide=".experienceToggle"/>--}}
{{--                                <span>is Current Job?</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="experienceToggle">--}}
{{--                    <div class="col-sm-8">--}}
{{--                        <div class="form-group">--}}
{{--                            <div class="input-daterange date-range input-group" id="demo-date-range">--}}
{{--                                <div class="input-group-content">--}}
{{--                                    <input type="text" class="form-control" name="experience_start_date[]"--}}
{{--                                           value=""/>--}}
{{--                                    <label>Start Date</label>--}}
{{--                                </div>--}}
{{--                                <span class="input-group-addon">to</span>--}}
{{--                                <div class="input-group-content">--}}
{{--                                    <input type="text" class="form-control" name="experience_end_date[]"--}}
{{--                                           value=""/>--}}
{{--                                    <label for="Name">End Date</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <strong>Description</strong>--}}
{{--                        <textarea name="experience_description[]" id=""--}}
{{--                                  class="ckeditor"></textarea>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endif
<div class="dynamicAddBtn">
    <button type="button" class="btn btn-success createClone" data-clone=".experiences"
            data-appendto=".appendExperience"><i class="fa fa-plus"></i> Add Experiences
    </button>
</div>
