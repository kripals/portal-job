@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')

    <!-- End Navigation -->
    <div class="clearfix"></div>

    <!-- Header Title Start -->

    <div class="clearfix"></div>
    <!-- Header Title End -->

    <!-- General Detail Start -->
    <section class="dashboard-wrap">
        <div class="container-fluid">
            <div class="row">
            @include('layouts.frontend.company.edit-profile-sidebar')
            <!-- Content Wrap -->
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-body">
                        <div class="dashboard-caption">
                            <div class="dashboard-caption-header">
                                <h4><i class="ti-ruler-pencil"></i>Contact Detail</h4>
                            </div>
                            <div class="dashboard-caption-wrap">
                                <form class="post-form" action="{{route('company.store.social-media', $company)}}" method="POST">
                                    @csrf
                                    @if(!$socialMedias->isEmpty())
                                        <div class="clonedInput social_medias" id="removeId1" data-fieldname="social_medias">
                                            <div id="clonedInput" class="appendSocialMedia">
                                            @foreach($socialMedias as $media)
                                                    <div class="row" id="parentId">
                                                        <input type="hidden" name="social_medias_ref_id[]" value="{{$media->ref_id}}">
                                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Social Media Type</label>
                                                                <select id="jb-level" class="form-control" name="media_key[]" data-placeholder="Company Size">
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
                                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Media URL</label>
                                                                <input type="text" class="form-control" name="media_value[]"
                                                                       id="number2" data-rule-url="true"
                                                                       value="{{ old('media_value', $media->media_value ?? '') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            @if(!$loop->first)
                                                                <div class="form-group mrg-top-30">
                                                                    <button class="btn btn-danger removeThis"
                                                                            data-url="{{route('company.front.removeFields')}}"
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
{{--                                        <div class="clonedInput social_medias" id="removeId1" data-fieldname="social_medias">--}}
{{--                                            <div id="clonedInput" class="appendSocialMedia">--}}
{{--                                                <div class="row" id="parentId">--}}
{{--                                                    <div class="col-lg-5 col-md-5 col-sm-12">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label>Social Media Type</label>--}}
{{--                                                            <select id="jb-level" class="form-control" name="media_key[]" data-placeholder="Company Size">--}}
{{--                                                                <option value="facebook">Facebook</option>--}}
{{--                                                                <option value="twitter">Twitter</option>--}}
{{--                                                                <option value="linked-in">LinkedIn</option>--}}
{{--                                                                <option value="youtube">Youtube</option>--}}
{{--                                                                <option value="instagram">Instagram</option>--}}
{{--                                                            </select>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-lg-5 col-md-5 col-sm-12">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label>Media URL</label>--}}
{{--                                                            <input type="text" class="form-control" name="media_value[]" id="number2"--}}
{{--                                                                   data-rule-url="true"--}}
{{--                                                                   value="{{ old('media_value') }}">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    @endif
                                    <div class="dynamicAddBtn">
                                        <button type="button" class="btn btn-success createClone" data-clone=".social_medias" data-fieldname="social_medias"
                                                data-appendto=".appendSocialMedia"><i class="fa fa-plus"></i> Add Social Media
                                        </button>
                                    </div>
                                    <!-- row -->
                                    <div class="row mrg-top-30">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn-savepreview">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- General Detail End -->
            </div>
        </div>
    </section>
@endsection
