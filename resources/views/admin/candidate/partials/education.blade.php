@if(isset($educations))
    <div class="clonedInput educations" id="removeId1" data-fieldname="educations">
        <div class="appendEducation" id="clonedInput">
            @foreach($educations as $education)
                <div id="parentId">
                    <input type="hidden" name="educations_ref_id[]" value="{{$education->ref_id}}">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <select name="qualification_level[]" class="form-control select2-list"
                                        data-placeholder="Education Level">
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
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input type="text" name="program_name[]" class="form-control" id="number2"
                                       value="{{ old('program_name', isset($education->program_name) ? $education->program_name : '') }}"/>
                                <span id="textarea1-error"
                                      class="text-danger">{{ $errors->first('program_name') }}</span>
                                <label for="KeyWords">Education Program Name</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            @if(!$loop->first)
                                <button class="btn btn-danger removeThis" data-url="{{route('remove.candidateFields')}}"
                                        data-item-name="educations" data-ref-id="{{$education->ref_id}}"><i
                                        class="fa fa-trash"></i></button>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select name="education_board[]" class="form-control select2-list"
                                        data-placeholder="Education Board">
                                    <option value="">Select Education Board</option>
                                    @foreach($educationBoards as $key=>$board)
                                        <option
                                            value="{{$board->id}}"
                                            {{ isset($education->education_board_id) ? $education->education_board_id == $board->id ? 'selected' : '' : ''}}
                                        >{{$board->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" name="institute_name[]" class="form-control"
                                       value="{{ old('institute_name', isset($education->institute_name) ? $education->institute_name : '') }}"/>
                                <span id="textarea1-error"
                                      class="text-danger">{{ $errors->first('institute_name') }}</span>
                                <label for="Name">Institution Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="checkbox checkbox-styled">
                                    <label>
                                        <input type="checkbox" name="education_is_current[]" class="ifCheck" value="yes"
                                               data-hide=".educationToggle{{$education->ref_id}}"
                                            {{ old('education_is_current', isset($education->is_current) ? $education->is_current : '')=='yes' ? 'checked':'' }}/>
                                        <span>Are you studying now?</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="educationToggle{{$education->ref_id}}" @if($education->is_current == 'yes')style="display: none;"@endif>
                            <div class="col-sm-4">
                                <div class="form-group control-width-normal">
                                    <div class="input-group date" id="demo-date">
                                        <div class="input-group-content">
                                            <input type="text" name="passing_year[]" class="form-control"
                                                   value="{{ old('passing_year', isset($education->passing_year) ? $education->passing_year : '') }}">
                                            <label>Passing Year</label>
                                        </div>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" name="marks_obtained[]" class="form-control"
                                           value="{{ old('marks_obtained', isset($education->marks_obtained) ? $education->marks_obtained : '') }}"/>
                                    <span id="textarea1-error"
                                          class="text-danger">{{ $errors->first('marks_obtained') }}</span>
                                    <label for="Name">Marks Secured</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <select name="marks_type[]" class="form-control select2-list"
                                            data-placeholder="Education Board">
                                        <option
                                            value="cgpa" {{ isset($education->marks_type) ? $education->marks_type == 'cgpa' ? 'selected' : '' : '' }}>
                                            CGPA
                                        </option>
                                        <option
                                            value="percent" {{ isset($education->marks_type) ? $education->marks_type == 'percent' ? 'selected' : '' : '' }}>
                                            %
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
{{--    <div class="clonedInput educations" id="removeId1" data-fieldname="educations">--}}
{{--        <div class="appendEducation" id="clonedInput">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-4">--}}
{{--                    <div class="form-group">--}}
{{--                        <select name="qualification_level[]" class="form-control"--}}
{{--                                data-placeholder="Education Level">--}}
{{--                            <option--}}
{{--                                value="phd">--}}
{{--                                Ph.D.--}}
{{--                            </option>--}}
{{--                            <option--}}
{{--                                value="master">--}}
{{--                                Masters--}}
{{--                            </option>--}}
{{--                            <option--}}
{{--                                value="bachelor">--}}
{{--                                Bachelor--}}
{{--                            </option>--}}
{{--                            <option--}}
{{--                                value="intermediate">--}}
{{--                                Intermediate--}}
{{--                            </option>--}}
{{--                            <option--}}
{{--                                value="slc">--}}
{{--                                SLC/SEE--}}
{{--                            </option>--}}
{{--                            <option--}}
{{--                                value="other">--}}
{{--                                Other--}}
{{--                            </option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-8">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="program_name[]" class="form-control" id="number2"--}}
{{--                               value=""/>--}}
{{--                        <span id="textarea1-error" class="text-danger">{{ $errors->first('program_name') }}</span>--}}
{{--                        <label for="KeyWords">Education Program Name</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <select name="education_board[]" class="form-control select2-list"--}}
{{--                                data-placeholder="Education Board">--}}
{{--                            <option--}}
{{--                                value="tribhuwan">--}}
{{--                                Tribuwan University--}}
{{--                            </option>--}}
{{--                            <option--}}
{{--                                value="kathmandu">--}}
{{--                                Kathmandu University--}}
{{--                            </option>--}}
{{--                            <option--}}
{{--                                value="purbanchal">--}}
{{--                                Purbanchal University--}}
{{--                            </option>--}}
{{--                            <option--}}
{{--                                value="pokhara">--}}
{{--                                Pokhara University--}}
{{--                            </option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="institute_name[]" class="form-control"--}}
{{--                               value=""/>--}}
{{--                        <span id="textarea1-error"--}}
{{--                              class="text-danger">{{ $errors->first('institute_name') }}</span>--}}
{{--                        <label for="Name">Institution Name</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-3">--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="checkbox checkbox-styled">--}}
{{--                            <label>--}}
{{--                                <input type="checkbox" name="education_is_current[]" class="ifCheck" value="yes"--}}
{{--                                       data-hide=".educationToggle"/>--}}
{{--                                <span>Are you studying now?</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="educationToggle">--}}
{{--                    <div class="col-sm-4">--}}
{{--                        <div class="form-group control-width-normal">--}}
{{--                            <div class="input-group date" id="demo-date">--}}
{{--                                <div class="input-group-content">--}}
{{--                                    <input type="text" name="passing_year[]" class="form-control"--}}
{{--                                           value="">--}}
{{--                                    <label>Passing Year</label>--}}
{{--                                </div>--}}
{{--                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-3">--}}
{{--                        <div class="form-group">--}}
{{--                            <input type="text" name="marks_obtained[]" class="form-control"--}}
{{--                                   value=""/>--}}
{{--                            <span id="textarea1-error"--}}
{{--                                  class="text-danger">{{ $errors->first('marks_obtained') }}</span>--}}
{{--                            <label for="Name">Marks Secured</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <div class="form-group">--}}
{{--                            <select name="marks_type[]" class="form-control"--}}
{{--                                    data-placeholder="Education Board">--}}
{{--                                <option--}}
{{--                                    value="cgpa">--}}
{{--                                    CGPA--}}
{{--                                </option>--}}
{{--                                <option--}}
{{--                                    value="percent">--}}
{{--                                    %--}}
{{--                                </option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endif
<div class="dynamicAddBtn">
    <button type="button" class="btn btn-success createClone" data-clone=".educations" data-fieldname="educations"
            data-appendto=".appendEducation"><i class="fa fa-plus"></i> Add Education Account
    </button>
</div>


