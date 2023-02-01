@extends('layouts.frontend.app')
@section('page-specific-styles')
    <link href="{{ asset('resources/frontend/assets/css/dropify.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @include('layouts.frontend.page-specific-header')

    <!-- End Navigation -->
    <div class="clearfix"></div>

    <!-- General Detail Start -->
    <section class="dashboard-wrap">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-3 col-md-4">
                    <div class="side-dashboard">
                        <div class="dashboard-avatar">
                            <div class="dashboard-avatar-thumb">
                                <a href="{{ route('candidate.profile') }}" style="color: #ce024b">
                                    <img src="{{asset($candidate->user->thumbnail_path)}}" class="img-avater" alt=""/>
                                </a>
                            </div>
                            <br>
                            <div class="dashboard-avatar-text">
                                <a href="{{ route('candidate.profile') }}" style="color: #ce024b">
                                    <h4>{{ $candidate->user->full_name }}</h4>
                                </a>
                            </div>
                        </div>
                        @include('frontend.candidate.layouts.main-sidebar')
                    </div>
                </div>

                <!-- Content Wrap -->
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-body">
                        <div class="dashboard-caption">

                            <div class="dashboard-caption-header">
                                <h4><i class="ti-setting"></i>Privacy Settings</h4>
                            </div>
                            <div class="clearfix"></div>
                            <!-- Title Header End -->

                            <div class="dashboard-caption-wrap">
                                <form class="form form-validate floating-label "
                                      action="{{route('candidate.store.privacy',$candidate)}}"
                                      method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf

                                    <div class="card-head setting-list">
                                        <div class="side-label">
                                            <div class="label-head">
                                                <span>Hide Profile Picture</span>
                                            </div>
                                            <div class="label-body">
                                                <input type="hidden" name="profile_image" value="off">
                                                <input type="checkbox" id="switch_demo_1" name="profile_image"
                                                       {{ old('profile_image', isset($privacyControls[0]['control_key']) ? $privacyControls[0]['control_value'] : '')=='on' ? 'checked':'' }} data-switchery/>
                                                @if(isset($privacyControls[0]['control_key']))
                                                    <input type="hidden" name="control_ref_id[]" value="{{$privacyControls[0]['ref_id']}}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="side-label">
                                            <div class="label-head">
                                                <span>Hide Address</span>
                                            </div>
                                            <div class="label-body">
                                                <input type="hidden" name="address" value="off">
                                                <input type="checkbox" id="switch_demo_2" name="address"
                                                       {{ old('address', isset($privacyControls[1]['control_key']) ? $privacyControls[1]['control_value'] : '')=='on' ? 'checked':'' }} data-switchery/>
                                                @if(isset($privacyControls[1]['control_key']))
                                                    <input type="hidden" name="control_ref_id[]" value="{{$privacyControls[1]['ref_id']}}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="side-label">
                                            <div class="label-head">
                                                <span>Hide Contact Number</span>
                                            </div>
                                            <div class="label-body">
                                                <input type="hidden" name="contact_number" value="off">
                                                <input type="checkbox" id="switch_demo_3" name="contact_number"
                                                       {{ old('contact_number', isset($privacyControls[2]['control_key']) ? $privacyControls[2]['control_value'] : '')=='on' ? 'checked':'' }} data-switchery/>
                                                @if(isset($privacyControls[2]['control_key']))
                                                    <input type="hidden" name="control_ref_id[]" value="{{$privacyControls[2]['ref_id']}}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="side-label">
                                            <div class="label-head">
                                                <span>Hide Date of Birth</span>
                                            </div>
                                            <div class="label-body">
                                                <input type="hidden" name="dob_age" value="off">
                                                <input type="checkbox" id="switch_demo_4" name="dob_age"
                                                       {{ old('dob', isset($privacyControls[3]['control_key']) ? $privacyControls[3]['control_value'] : '')=='on' ? 'checked':'' }} data-switchery/>
                                                @if(isset($privacyControls[3]['control_key']))
                                                    <input type="hidden" name="control_ref_id[]" value="{{$privacyControls[3]['ref_id']}}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="side-label">
                                            <div class="label-head">
                                                <span>Hide From Company (Enter Company PAN Number)</span>
                                            </div>
                                            <div class="label-body">
                                                <div class="form-group">
                                                    <input type="text" name="company_pan" class="form-control"
                                                        value="{{ old('company_pan', isset($privacyControls[4]['control_key']) ? $privacyControls[4]['control_value'] : '') }}"/>
                                                    @if(isset($privacyControls[4]['control_key']))
                                                        <input type="hidden" name="control_ref_id[]" value="{{$privacyControls[4]['ref_id']}}">
                                                    @endif
                                                    @error('company_pan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
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
            </div>
        </div>
    </section>
    <!-- General Detail End -->
@endsection

@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
    <script src="{{ asset('resources/frontend/assets/js/dropify.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
@endsection
