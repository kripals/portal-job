@if(isset($socialMedias) && !$socialMedias->isEmpty())
    <div class="clonedInput social_medias" id="removeId1" data-fieldname="social_medias">
        <div class="row appendSocialMedia" id="clonedInput">
            @foreach($socialMedias as $media)
                <div id="parentId">
                    <input type="hidden" name="social_medias_ref_id[]" value="{{$media->ref_id}}">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <select name="media_key[]" class="form-control"
                                    data-placeholder="Company Size">
                                <option value="">Select Media Type</option>
                                <option
                                    value="facebook" {{  $media->media_key == 'facebook' ? 'selected' : ''  }}>
                                    Facebook
                                </option>
                                <option
                                    value="twitter" {{  $media->media_key == 'twitter' ? 'selected' : ''  }}>
                                    Twitter
                                </option>
                                <option
                                    value="linkedin" {{  $media->media_key == 'linkedin' ? 'selected' : ''  }}>
                                    LinkedIn
                                </option>
                                <option
                                    value="youtube" {{  $media->media_key == 'youtube' ? 'selected' : ''  }}>
                                    Youtube
                                </option>
                                <option
                                    value="instagram" {{  $media->media_key == 'instagram' ? 'selected' : ''  }}>
                                    Instagram
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="media_value[]" class="form-control" id="number2"
                                   data-rule-url="true" value="{{ old('media_value', $media->media_value ?? '') }}"/>
                            <label for="Name">Media URL</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        @if(!$loop->first)
                            <button class="btn btn-danger removeThis" data-url="{{route('remove.companyFields')}}"
                                    data-item-name="social_medias" data-ref-id="{{$media->ref_id}}"><i
                                    class="fa fa-trash"></i></button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="clonedInput social_medias" id="removeId1" data-fieldname="social_medias">
        <div class="row appendSocialMedia" id="clonedInput">
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="media_key[]" class="form-control"
                            data-placeholder="Company Size">
                        <option value="">Select Media Type</option>
                        <option value="facebook">Facebook</option>
                        <option value="twitter">Twitter</option>
                        <option value="linkedin">LinkedIn</option>
                        <option value="youtube">Youtube</option>
                        <option value="instagram">Instagram</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="media_value[]" class="form-control" id="number2"
                           data-rule-url="true"
                           value=""/>
                    <label for="Name">Media URL</label>
                </div>
            </div>
        </div>
    </div>
@endif
<div class="dynamicAddBtn">
    <button type="button" class="btn btn-success createClone" data-clone=".social_medias"
            data-appendto=".appendSocialMedia"><i class="fa fa-plus"></i> Add Social Account
    </button>
</div>
