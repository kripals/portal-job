<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <input type="text" name="interest" data-role="tagsinput"
                   value="{{ old('interest', isset($candidate->interest) ? $candidate->interest : '') }}"/>
            <span id="textarea1-error" class="text-danger">{{ $errors->first('interest') }}</span>
            <label for="Name">Interest</label>
        </div>
    </div>
</div>
@if(isset($languages))
    <div class="clonedInput languages" id="removeId1" data-fieldname="languages">
        <div class="appendLanguage" id="clonedInput">
            @foreach($languages as $language)
                <div id="parentId">
                    <input type="hidden" name="languages_ref_id[]" value="{{$language->ref_id}}">
                    <div class="row">
                        <div class="col-sm-11">
                            <div class="form-group">
                                <input type="text" name="language_name[]" class="form-control"
                                       value="{{ old('name', isset($language->name) ? $language->name : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('name') }}</span>
                                <label for="Title">Known Language</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            @if(!$loop->first)
                                <button class="btn btn-danger removeThis" data-url="{{route('remove.candidateFields')}}"
                                        data-item-name="languages" data-ref-id="{{$language->ref_id}}"><i
                                        class="fa fa-trash"></i></button>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="language_reading[]" class="form-control"
                                       value="{{ old('reading', isset($language->reading) ? $language->reading : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('reading') }}</span>
                                <label for="Title">Reading</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="language_writing[]" class="form-control"
                                       value="{{ old('writing', isset($language->writing) ? $language->writing : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('writing') }}</span>
                                <label for="Title">Writing</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="language_speaking[]" class="form-control"
                                       value="{{ old('speaking', isset($language->speaking) ? $language->speaking : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('speaking') }}</span>
                                <label for="Title">Speaking</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="language_listening[]" class="form-control"
                                       value="{{ old('listening', isset($language->listening) ? $language->listening : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('listening') }}</span>
                                <label for="Title">Listening</label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
{{--    <div class="clonedInput languages" id="removeId1" data-fieldname="languages">--}}
{{--        <div class="appendLanguage" id="clonedInput">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="language_name[]" class="form-control"--}}
{{--                               value="{{ old('name') }}"/>--}}
{{--                        <label for="Title">Known Language</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="language_reading[]" class="form-control"--}}
{{--                               value="{{ old('reading') }}"/>--}}
{{--                        <label for="Title">Reading</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="language_writing[]" class="form-control"--}}
{{--                               value="{{ old('writing') }}"/>--}}
{{--                        <label for="Title">Writing</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="language_speaking[]" class="form-control"--}}
{{--                               value="{{ old('speaking') }}"/>--}}
{{--                        <label for="Title">Speaking</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="language_listening[]" class="form-control"--}}
{{--                               value="{{ old('listening') }}"/>--}}
{{--                        <label for="Title">Listening</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endif
<div class="dynamicAddBtn">
    <button type="button" class="btn btn-success createClone" data-clone=".languages"
            data-appendto=".appendLanguage"><i class="fa fa-plus"></i> Add Languages
    </button>
</div>
@if(isset($socialMedias))
    <div class="clonedInput social_medias" id="removeId1" data-fieldname="social_medias">
        <div class="appendSocialMedia" id="clonedInput">
            @foreach($socialMedias as $socialMedia)
                <div id="parentId">
                    <input type="hidden" name="social_medias_ref_id[]" value="{{$socialMedia->ref_id}}">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <select name="social_media_key[]" class="form-control"
                                        data-placeholder="Company Size">
                                    <option value="">Select Media Type</option>
                                    <option
                                        value="facebook" {{  isset($socialMedia->media_key) ? $socialMedia->media_key == 'facebook' ? 'selected' : '': '' }}>
                                        Facebook
                                    </option>
                                    <option
                                        value="twitter" {{  isset($socialMedia->media_key) ? $socialMedia->media_key == 'twitter' ? 'selected' : '': '' }}>
                                        Twitter
                                    </option>
                                    <option
                                        value="linkedin" {{  isset($socialMedia->media_key) ? $socialMedia->media_key == 'linkedin' ? 'selected' : '': ''  }}>
                                        LinkedIn
                                    </option>
                                    <option
                                        value="youtube" {{  isset($socialMedia->media_key) ? $socialMedia->media_key == 'youtube' ? 'selected' : '': ''  }}>
                                        Youtube
                                    </option>
                                    <option
                                        value="instagram" {{  isset($socialMedia->media_key) ? $socialMedia->media_key == 'instagram' ? 'selected' : '': '' }}>
                                        Instagram
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="social_media_value[]" class="form-control" data-rule-url="true"
                                       value="{{ old('medial_value', isset($socialMedia->media_value) ? $socialMedia->media_value : '') }}"/>
                                <label for="Title">Media URL</label>
                                <p class="help-block">Starts with http://</p>
                            </div>
                        </div>
                        <div class="col-md-1">
                            @if(!$loop->first)
                                <button class="btn btn-danger removeThis" data-url="{{route('remove.candidateFields')}}"
                                        data-item-name="social_medias" data-ref-id="{{$socialMedia->ref_id}}"><i
                                        class="fa fa-trash"></i></button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
{{--    <div class="clonedInput social_medias" id="removeId1" data-fieldname="social_medias">--}}
{{--        <div class="appendSocialMedia" id="clonedInput">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <select name="social_media_key[]" class="form-control"--}}
{{--                                data-placeholder="Company Size">--}}
{{--                            <option value="">Select Media Type</option>--}}
{{--                            <option--}}
{{--                                value="facebook">--}}
{{--                                Facebook--}}
{{--                            </option>--}}
{{--                            <option--}}
{{--                                value="twitter">--}}
{{--                                Twitter--}}
{{--                            </option>--}}
{{--                            <option--}}
{{--                                value="linked-in">--}}
{{--                                LinkedIn--}}
{{--                            </option>--}}
{{--                            <option--}}
{{--                                value="youtube">--}}
{{--                                Youtube--}}
{{--                            </option>--}}
{{--                            <option--}}
{{--                                value="instagram">--}}
{{--                                Instagram--}}
{{--                            </option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="social_media_value[]" class="form-control" data-rule-url="true"--}}
{{--                               value="{{ old('medial_value') }}"/>--}}
{{--                        <label for="Title">Media URL</label>--}}
{{--                        <p class="help-block">Starts with http://</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endif
<div class="dynamicAddBtn">
    <button type="button" class="btn btn-success createClone" data-clone=".social_medias"
            data-appendto=".appendSocialMedia"><i class="fa fa-plus"></i> Add Social Medias
    </button>
</div>
<div class="card-head">
    <div class="side-label">
        <div class="label-head">
            <span>Are you willing to travel outside of your residing location during the job? </span>
        </div>
        <div class="label-body">
            <input type="checkbox" id="switch_demo_1" name="travel_outside"
                   {{ old('travel_outside', isset($candidate->travel_outside) ? $candidate->travel_outside : '')=='yes' ? 'checked':'' }} data-switchery/>
        </div>
    </div>
    <div class="side-label">
        <div class="label-head">
            <span>Are you willing to temporarily relocate outside of your residing location during the job period? </span>
        </div>
        <div class="label-body">
            <input type="checkbox" id="switch_demo_2" name="relocate_location"
                   {{ old('relocate_location', isset($candidate->relocate_location) ? $candidate->relocate_location : '')=='yes' ? 'checked':'' }} data-switchery/>
        </div>
    </div>
    <div class="side-label">
        <div class="label-head">
            <span>Do you have Two wheeler License?</span>
        </div>
        <div class="label-body">
            <input type="checkbox" id="switch_demo_3" name="two_wheeler_license"
                   {{ old('two_wheeler_license', isset($candidate->two_wheeler_license) ? $candidate->two_wheeler_license : '')=='yes' ? 'checked':'' }} data-switchery/>
        </div>
    </div>
    <div class="side-label">
        <div class="label-head">
            <span>Do you have Four wheeler License?</span>
        </div>
        <div class="label-body">
            <input type="checkbox" id="switch_demo_4" name="four_wheeler_license"
                   {{ old('four_wheeler_license', isset($candidate->four_wheeler_license) ? $candidate->four_wheeler_license : '')=='yes' ? 'checked':'' }} data-switchery/>
        </div>
    </div>
    <div class="side-label">
        <div class="label-head">
            <span>Do you have Two wheeler Vehicle?</span>
        </div>
        <div class="label-body">
            <input type="checkbox" id="switch_demo_5" name="two_wheeler_vehicle"
                   {{ old('two_wheeler_vehicle', isset($candidate->two_wheeler_vehicle) ? $candidate->two_wheeler_vehicle : '')=='yes' ? 'checked':'' }} data-switchery/>
        </div>
    </div>
    <div class="side-label">
        <div class="label-head">
            <span>Do you have Four wheeler Vehicle?</span>
        </div>
        <div class="label-body">
            <input type="checkbox" id="switch_demo_6" name="four_wheeler_vehicle"
                   {{ old('four_wheeler_vehicle', isset($candidate->four_wheeler_vehicle) ? $candidate->four_wheeler_vehicle : '')=='yes' ? 'checked':'' }} data-switchery/>
        </div>
    </div>
</div>

