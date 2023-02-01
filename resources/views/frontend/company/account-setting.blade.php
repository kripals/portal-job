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

            @include('layouts.frontend.company.main-side')

            <!-- Content Wrap -->
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-body">
                        <div class="dashboard-caption">

                            <div class="dashboard-caption-header">
                                <h4><i class="ti-setting"></i>Account Settings</h4>
                            </div>
                            <div class="clearfix"></div>
                            <!-- Title Header End -->

                            <div class="dashboard-caption-wrap">
                                <div class="deatil-tab-employ tool-tab">
                                    <ul class="nav simple nav-tabs" id="simple-design-tab">
                                        <li class="active"><a href="#change-email">Change Password</a></li>
                                        <li><a href="#change-display">Change Display Picture</a></li>
{{--                                        <li><a href="#page-setting">Company Page Setting</a></li>--}}
                                    </ul>
                                    <!-- Start All Sec -->
                                    <div class="tab-content">

                                        <!-- Start change-email Sec -->
                                        <div id="change-email" class="tab-pane fade in active">
                                            <div class="row no-mrg">
                                                <h3>Change Password</h3>
                                                <form class="post-form" action="{{route('company.store.change-password')}}"
                                                      method="POST" data-parsley-validate="">
                                                    @csrf
                                                    <div class="edit-pro">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label>New Password</label>
                                                            <input type="password" class="form-control" name="password" required>
                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label>Confirm New Password</label>
                                                            <input type="password" class="form-control" name="password_confirmation" required>
                                                            @error('password_confirmation')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <button type="submit" class="update-btn">Change</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End change-email Sec -->
                                        <!-- End Page Setting Sec -->

                                        <!-- Start change-display -->
                                        <div id="change-display" class="tab-pane fade">
                                            <form action="{{route('company.store.display-picture')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                            <div class="row no-mrg">
                                                <h3>Change Display Picture</h3>
                                                <div class="edit-pro">
                                                    <div class="form-group">
                                                        <label>Upload Photo</label>
                                                        @if(isset($company->image_path))
                                                            @if(!empty($company->image_path))
{{--                                                                <a href="{{ asset($company->image_path) }}" target="_blank"--}}
{{--                                                                   class="btn btn-info ink-reaction" style="width: 100%;margin-top: -30px;"><i--}}
{{--                                                                        class="md md-description"></i>View Image</a>--}}
                                                                <input type="file" name="image" class="dropify"
                                                                       data-default-file="{{ asset($company->image_path) }}"/>
                                                            @else
                                                                <input type="file" name="image" class="dropify"/>
                                                            @endif
                                                        @else
                                                            <input type="file" name="image" class="dropify"/>
                                                        @endif
                                                        <div class="col-sm-12">
                                                            <button type="submit" class="update-btn">Update Picture Now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                        <!-- End change-display -->
                                    </div>
                                    <!-- Start All Sec -->
                                </div>

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
