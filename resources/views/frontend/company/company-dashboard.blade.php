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
                                <h4><i class="ti-settings"></i>Company Dashboard</h4>
                            </div>

                            <div class="dashboard-caption-wrap">

                                <!-- Overview -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="dashboard-stat widget-1">
                                            <div class="dashboard-stat-content"><h4>{{$jobs->count()}}</h4> <span>Job Posted</span>
                                            </div>
                                            <div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="dashboard-stat widget-2">
                                            <div class="dashboard-stat-content"><h4>{{$applicants->count()}}</h4> <span>Applicants</span>
                                            </div>
                                            <div class="dashboard-stat-icon"><i class="ti-layers"></i></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="dashboard-stat widget-3">
                                            <div class="dashboard-stat-content"><h4>{{$company->views}}</h4> <span>Total Views</span>
                                            </div>
                                            <div class="dashboard-stat-icon"><i class="ti-pie-chart"></i></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="dashboard-stat widget-4">
                                            <div class="dashboard-stat-content"><h4>{{$expiredJobs->count()}}</h4> <span>Expire Jobs</span>
                                            </div>
                                            <div class="dashboard-stat-icon"><i class="ti-bookmark"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="dashboard-gravity-list invoices with-icons">
                                            <h4>Recently Posted Jobs</h4>
                                            <ul>
                                                @forelse($recentJobs as $job)
                                                    <li><i class="dash-icon-box ti-files"></i>
                                                        <strong>{{$job->title}}</strong>
                                                        <ul>
                                                            <li class="category">{{$job->category->name}}</li>
                                                            <li>{{$job->job_type->title}}</li>
                                                            <li>Deadline: {{$job->end_date}}</li>
                                                        </ul>
                                                        <div class="buttons-to-right">
                                                            <a href="{{route('job.detail',$job->ref_id)}}"
                                                               class="button gray">View Details</a>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li>
                                                        <p class="text-center">No Jobs have been posted yet.<a
                                                                href="{{route('company.job.create')}}"
                                                                class="button gray pull-right">Post A Job</a></p>
                                                    </li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="dashboard-caption-header">
                                        <h4><i class="ti-briefcase"></i>Matching Candidates</h4>
                                    </div>
                                    <!-- Notifications -->
                                    <div class="company-dashboard">
                                        @forelse($matchingCandidates as $candidate)
                                            <div class="col-md-6">
                                                <div class="manage-list-row">
                                                    <div class="job-info">
                                                        <div class="job-img">
                                                            <img src="{{asset($candidate->user->thumbnail_path)}}"
                                                                 class="attachment-thumbnail"
                                                                 alt="{{$candidate->user->full_name}}">
                                                        </div>
                                                        <div class="job-details">
                                                            <h3 class="job-name">
                                                                <a class="job_name_tag"
                                                                                    href="{{route('candidate.detail',$candidate->ref_id)}}">{{$candidate->user->full_name}}
                                                                </a>
                                                                @if(!empty($candidate->job_level->title))
                                                                    <div
                                                                        class="shortlisted-can">{{$candidate->job_level->title}}</div>
                                                                @endif
                                                            </h3>
                                                            <small class="job-company"><i
                                                                    class="ti-home"></i>{{$candidate->category->name}}
                                                            </small>
                                                            <small class="job-sallery"><i
                                                                    class="ti-time"></i>{{$candidate->experience_period ? $candidate->experience_text : 'N/A'}}
                                                            </small>
                                                            <small class="job-sallery"><i
                                                                    class="ti-location-pin"></i>{{$candidate->current_address ?? 'N/A'}}
                                                            </small>
                                                            {{--                                                    <div class="candi-skill">--}}
                                                            {{--                                                        @foreach($candidate->known_skills as $skills)--}}
                                                            {{--                                                            <span class="skill-tag">{{$skills->title}}</span>--}}
                                                            {{--                                                        @endforeach--}}
                                                            {{--                                                    </div>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-center">Post jobs to view qualified candidates.</p>
                                        @endforelse
                                    </div>
{{--                                    <div class="dashboard-caption-header">--}}
{{--                                        <h4><i class="ti-briefcase"></i>Applications</h4>--}}
{{--                                    </div>--}}
                                    <!-- Notifications -->
{{--                                    <ul class="list">--}}
{{--                                        @forelse($applicants as $candidate)--}}
{{--                                            <li class="manage-list-row clearfix">--}}
{{--                                                <div class="job-info">--}}
{{--                                                    <div class="job-img">--}}
{{--                                                        <img src="{{asset($candidate->user->thumbnail_path)}}"--}}
{{--                                                             class="attachment-thumbnail"--}}
{{--                                                             alt="{{$candidate->user->full_name}}">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="job-details">--}}
{{--                                                        <h3 class="job-name"><a class="job_name_tag"--}}
{{--                                                                                href="{{route('candidate.detail',$candidate->ref_id)}}">{{$candidate->user->full_name}}</a>--}}
{{--                                                        </h3>--}}
{{--                                                        <small class="job-company"><i--}}
{{--                                                                class="ti-home"></i>{{$candidate->category->name}}--}}
{{--                                                        </small>--}}
{{--                                                        <small class="job-sallery"><i--}}
{{--                                                                class="ti-time"></i>{{$candidate->experience_text}}--}}
{{--                                                        </small>--}}
{{--                                                        <small class="job-sallery"><i--}}
{{--                                                                class="ti-location-pin"></i>{{$candidate->current_address}}--}}
{{--                                                        </small>--}}
{{--                                                        @if(!empty($candidate->job_level->title))--}}
{{--                                                            <div--}}
{{--                                                                class="shortlisted-can">{{$candidate->job_level->title}}</div>--}}
{{--                                                        @endif--}}
{{--                                                        <div class="candi-skill">--}}
{{--                                                            @foreach($candidate->known_skills as $skills)--}}
{{--                                                                @if( $loop->iteration <= 4)--}}
{{--                                                                <span class="skill-tag">{{$skills->title}}</span>--}}
{{--                                                                @endif--}}
{{--                                                            @endforeach--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="job-buttons">--}}
{{--                                                    --}}{{--                                                <a href="{{route('company.job.candidate-resume', $candidate->ref_id)}}" class="btn btn-gary manage-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download Resume"><i class="ti-download"></i></a>--}}
{{--                                                    --}}{{--                                                <a href="#SendMessage" data-toggle="modal" class="btn btn-blue manage-btn" data-placement="top" title="Message"><i class="ti-email"></i></a>--}}
{{--                                                    <a href="{{route('company.job.action',[$candidate->pivot->ref_id,'shortlisted'])}}"--}}
{{--                                                       class="btn btn-shortlist manage-btn" data-toggle="tooltip"--}}
{{--                                                       data-placement="top" title="" data-original-title="Shortlist"><i--}}
{{--                                                            class="ti-check"></i></a>--}}
{{--                                                    <a href="{{route('company.job.action',[$candidate->pivot->ref_id,'rejected'])}}"--}}
{{--                                                       class="btn btn-cancel manage-btn" data-toggle="tooltip"--}}
{{--                                                       data-placement="top" title="" data-original-title="Remove"><i--}}
{{--                                                            class="ti-close"></i></a>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                        @empty--}}
{{--                                            <p class="text-center">Post jobs to get applications.</p>--}}
{{--                                        @endforelse--}}
{{--                                    </ul>--}}
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
