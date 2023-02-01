@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
    <div class="clearfix"></div>

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
                        @include('frontend.candidate.layouts.main-sidebar')
                    </div>
                </div>

                <!-- Content Wrap -->
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-body">
                        <div class="dashboard-caption">

                            <div class="dashboard-caption-header">
                                <h4><i class="ti-bell"></i>Applied Jobs</h4>
                            </div>

                            <div class="dashboard-caption-wrap">

{{--                                <a href="javascript:void(0)" class="btn-savepreview small-btn mrg-bot-30" data-toggle="modal" data-target="#job-alert"><i class="ti-bell"></i>New Alert</a>--}}

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Applied Job</th>
                                            <th scope="col">Employer</th>
                                            <th scope="col">Criteria</th>
                                            <th scope="col">Applied Date</th>
                                            <th scope="col">Status</th>
{{--                                            <th scope="col">Action</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($appliedJobs)
                                            @foreach($appliedJobs as $job)
                                        <tr>
                                            <th scope="row">
                                                <a href="{{ route('job.detail' ,$job->ref_id)  }}">{{$job->title}}</a>
                                            </th>
                                            <td>
                                                <a href="{{ route('company.detail' ,$job->company->ref_id)  }}">{{$job->company->company_name}}</a>
                                            </td>
                                            <td>{{$job->category->name}}</td>
                                            <td>{{prettyDate($job->pivot->created_at)}}</td>
                                            <td>{{$job->pivot->status}}</td>
{{--                                            <td>--}}
{{--                                                <div class="job-buttons">--}}
{{--                                                    <a href="job-detail-3.html" class="btn btn-gary manage-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Apply Job"><i class="ti-hand-point-right"></i></a>--}}
{{--                                                    <a href="#" class="btn btn-cancel manage-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"><i class="ti-close"></i></a>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
                                        </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
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
