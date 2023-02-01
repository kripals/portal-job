@extends('frontend.candidate.layouts.layout')

@section('candidate-content')

    <div class="dashboard-caption-header">
        <h4><i class="ti-sharethis"></i>Social Account</h4>
    </div>

    <div class="dashboard-caption-wrap">
        <form class="form form-validate floating-label" action="{{route('candidate.store.social.media', $candidate)}}"
              method="POST" enctype="multipart/form-data" data-parsley-validate="">
            @csrf
            @if(!$socialMedias->isEmpty())
                <div class="clonedInput social_medias" id="removeId1" data-fieldname="social_medias">
                    <div id="clonedInput" class="appendSocialMedia">
                        @foreach($socialMedias as $media)
                            <div class="row" id="parentId">
                                <input type="hidden" name="social_medias_ref_id[]" value="{{$media->ref_id}}">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-group">
                                        <label>Media Type*</label>
                                        <select name="social_media_key[]" class="form-control select2-list" required>
                                            <option value="">Select Media Type</option>
                                            <option
                                                    value="facebook" {{  isset($media->media_key) ? $media->media_key == 'facebook' ? 'selected' : '': '' }}>
                                                Facebook
                                            </option>
                                            <option
                                                    value="twitter" {{  isset($media->media_key) ? $media->media_key == 'twitter' ? 'selected' : '': '' }}>
                                                Twitter
                                            </option>
                                            <option
                                                    value="linkedin" {{  isset($media->media_key) ? $media->media_key == 'linkedin' ? 'selected' : '': ''  }}>
                                                LinkedIn
                                            </option>
                                            <option
                                                    value="youtube" {{  isset($media->media_key) ? $media->media_key == 'youtube' ? 'selected' : '': ''  }}>
                                                Youtube
                                            </option>
                                            <option
                                                    value="instagram" {{  isset($media->media_key) ? $media->media_key == 'instagram' ? 'selected' : '': '' }}>
                                                Instagram
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-group">
                                        <label>Media URL*</label>
                                        <input type="text" name="social_media_value[]" class="form-control" data-rule-url="true"
                                               value="{{ old('media_value', isset($media->media_value) ? $media->media_value : '') }}" placeholder="Starts with https://facebook.com/yourusername" required/>
                                        <span id="textarea1-error"
                                              class="text-danger">{{ $errors->first('media_value') }}</span>
{{--                                        <p class="help-block" style="float: right">Starts with http://</p>--}}
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    @if(!$loop->first)
                                        <div class="form-group mrg-top-30">
                                            <button class="btn btn-danger removeThis"
                                                    data-url="{{route('candidate.front.removeFields')}}"
                                                    data-item-name="social_medias" data-ref-id="{{$media->ref_id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
{{--                <div class="clonedInput social_medias" id="removeId1" data-fieldname="social_medias">--}}
{{--                    <div id="clonedInput" class="appendSocialMedia">--}}
{{--                        <div class="row" id="parentId">--}}
{{--                            <div class="col-lg-5 col-md-5 col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Social Media Type</label>--}}
{{--                                    <select id="jb-level" class="form-control" name="social_media_key[]" required>--}}
{{--                                        <option value="facebook">Facebook</option>--}}
{{--                                        <option value="twitter">Twitter</option>--}}
{{--                                        <option value="linked-in">LinkedIn</option>--}}
{{--                                        <option value="youtube">Youtube</option>--}}
{{--                                        <option value="instagram">Instagram</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-5 col-md-5 col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Media URL</label>--}}
{{--                                    <input type="text" class="form-control" name="social_media_value[]" id="number2"--}}
{{--                                           data-rule-url="true"--}}
{{--                                           value="{{ old('media_value') }}" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            @endif
            <div class="dynamicAddBtn">
                <button type="button" class="btn btn-success createCandidateClone" data-clone=".social_medias" data-fieldname="social_medias"
                        data-appendto=".appendSocialMedia"><i class="fa fa-plus"></i> Add Social Media
                </button>
            </div>
            <div class="row mrg-top-30">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group text-center">
                        <button type="submit" class="btn-savepreview">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- General Detail End -->
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
@endsection
