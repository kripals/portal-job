@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
    <!-- End Navigation -->
    <div class="clearfix"></div>

    <!-- Header Title Start -->

    <div class="clearfix"></div>
{{--    <!-- Header Title End -->--}}

    <!-- General Detail Start -->
    <section class="dashboard-wrap">
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar Wrap -->
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
                        <div class="dashboard-menu">
                            @include('frontend.candidate.layouts.sidebar')
                        </div>
                    </div>
                </div>
                <!-- Content Wrap -->
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-body">
                        <div class="dashboard-caption">
                            @yield('candidate-content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- General Detail End -->



@endsection
