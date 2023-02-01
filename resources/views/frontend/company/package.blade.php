@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
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
                                <h4><i class="ti-wallet"></i>Job Packages</h4>
                            </div>

                            <div class="dashboard-caption-wrap">
                                <form action="{{route('company.package.purchase')}}" method="post">
                                    @csrf
                                <div class="table-responsive">
                                    <table class="table table-responsive">
                                        <thead>
                                        <tr>
                                            <th scope="col">Select</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col">Jobs</th>
                                            <th scope="col">Duration</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($jobPackages as $jobPackage)
                                        <tr>
                                            <th scope="row">
                                                <label class="custom-radio">
                                                    <input type="radio" checked="checked" name="package" value="{{$jobPackage->slug}}">
                                                    <input type="hidden" name="type" value="job">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </th>
                                            <td>{{$jobPackage->title}}</td>
                                            <td>{{$jobPackage->rate}}</td>
                                            <td>{{$jobPackage->quantity}}</td>
                                            <td>{{$jobPackage->expiry_text}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn-savepreview"><i class="ti-angle-double-right"></i>Continue</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-body">
                        <div class="dashboard-caption">

                            <div class="dashboard-caption-header">
                                <h4><i class="ti-wallet"></i>Resume Packages</h4>
                            </div>

                            <div class="dashboard-caption-wrap">
                                <form action="{{route('company.package.purchase')}}" method="post">
                                    @csrf
                                <div class="table-responsive">
                                    <table class="table table-responsive">
                                        <thead>
                                        <tr>
                                            <th scope="col">Select</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col">No. of C.V</th>
                                            <th scope="col">Duration</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($resumePackages as $resumePackage)
                                        <tr>
                                            <th scope="row">
                                                <label class="custom-radio">
                                                    <input type="radio" checked="checked" name="package" value="{{$resumePackage->slug}}">
                                                    <input type="hidden" name="type" value="resume">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </th>
                                            <td>{{$resumePackage->title}}</td>
                                            <td>{{$resumePackage->rate}}</td>
                                            <td>{{$resumePackage->quantity}}</td>
                                            <td>{{$resumePackage->expiry_text}}</td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn-savepreview"><i class="ti-angle-double-right"></i>Continue</button>
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
