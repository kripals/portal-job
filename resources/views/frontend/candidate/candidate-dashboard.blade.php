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
                                <h4><i class="ti-settings"></i>Candidate Dashboard</h4>
                                <a href="{{route('candidate.download.resume',$candidate->ref_id)}}" class="btn btn-info"
                                   target="_blank"><i class="fa fa-download"></i> Download Resume</a>
                                <a href="{{route('candidate.basic-information')}}" class="btn btn-warning"><i
                                        class="fa fa-upload"></i> Upload Resume</a>
                            </div>
                            <div class="dashboard-caption-wrap">

                                <!-- Overview -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="dashboard-stat widget-1">
                                            <div class="dashboard-stat-content"><h4>{{$appliedJobsCount->count()}}</h4>
                                                <span>Job Applied</span>
                                            </div>
                                            <div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="dashboard-stat widget-2">
                                            <div class="dashboard-stat-content"><h4>{{$matchingJobs->count()}}</h4> <span>Job Alert</span>
                                            </div>
                                            <div class="dashboard-stat-icon"><i class="ti-bell"></i></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="dashboard-stat widget-3">
                                            <div class="dashboard-stat-content"><h4>{{$candidate->views}}</h4> <span>Total Views</span>
                                            </div>
                                            <div class="dashboard-stat-icon"><i class="ti-pie-chart"></i></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="dashboard-stat widget-4">
                                            <div class="dashboard-stat-content"><h4>{{$shortlisted->count()}}</h4> <span>Shortlisted</span>
                                            </div>
                                            <div class="dashboard-stat-icon"><i class="ti-bookmark"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notifications -->
                                <div class="row">
                                    <div class="dashboard-caption-header">
                                        <h4><i class="ti-bell"></i>Alerts Jobs</h4>
                                    </div>
                                    <div class="dashboard-caption-wrap">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Position</th>
                                                    <th scope="col">Criteria</th>
                                                    <th scope="col">Company</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($matchingJobs as $job)
                                                        <tr>
                                                            <th scope="row"><a
                                                                    href="{{ route('job.detail',$job->ref_id)  }}">{{$job->title}}</a>
                                                            </th>
                                                            <td>{{$job->category->name}}</td>
                                                            <td>
                                                                @if($job->company_id)
                                                                <a href="{{ route('company.detail' ,$job->company->ref_id)  }}">{{$job->company->company_name}}</a>
                                                                @else
                                                                    {{$job->company_name ?? 'N/A'}}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="job-buttons">
                                                                    @if(!in_array($job->ref_id,$appliedJobsArr))
                                                                        <a href="{{route('candidate.job.apply.process',$job->ref_id)}}"
                                                                           class="btn btn-info manage-btn"
                                                                           data-toggle="tooltip" data-placement="top"
                                                                           title="" data-original-title="Apply Job"><i
                                                                                class="ti-hand-point-right"></i></a>
                                                                    @endif
                                                                    <a href="{{ route('job.detail',$job->ref_id)  }}"
                                                                       class="btn btn-success manage-btn"
                                                                       data-toggle="tooltip" data-placement="top"
                                                                       title="" data-original-title="View Detail"><i
                                                                            class="ti-eye"></i></a>
                                                                    <a href="#" class="btn btn-cancel manage-btn"
                                                                       data-toggle="tooltip" data-placement="top"
                                                                       title="" data-original-title="Remove"><i
                                                                            class="ti-close"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="4">
                                                                <p class="text-center">No Alert Jobs. <a href="{{route('job.list','nepal')}}">View All Jobs</a></p>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="dashboard-caption-header">
                                        <h4><i class="ti-briefcase"></i>Applied Jobs</h4>
                                    </div>

                                    <div class="dashboard-caption-wrap">
                                        <!-- row -->
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Applied Job</th>
                                                    <th scope="col">Employer</th>
                                                    <th scope="col">Criteria</th>
                                                    <th scope="col">Applied Date</th>
                                                    <th scope="col">Status</th>
{{--                                                    <th scope="col">Action</th>--}}
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
{{--                                                            <td>--}}
{{--                                                                <div class="job-buttons">--}}
{{--                                                                    --}}{{--                                                    <a href="job-detail-3.html" class="btn btn-gary manage-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Apply Job"><i class="ti-hand-point-right"></i></a>--}}
{{--                                                                    <a href="#" class="btn btn-cancel manage-btn"--}}
{{--                                                                       data-toggle="tooltip" data-placement="top"--}}
{{--                                                                       title="" data-original-title="Remove"><i--}}
{{--                                                                            class="ti-close"></i></a>--}}
{{--                                                                </div>--}}
{{--                                                            </td>--}}
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

            </div>
        </div>
    </section>
    <!-- General Detail End -->
@endsection
