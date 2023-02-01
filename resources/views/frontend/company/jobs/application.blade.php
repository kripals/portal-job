@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
    <!-- General Detail Start -->
    <section class="dashboard-wrap">
        <div class="container-fluid">
            <div class="row">

                <!-- Sidebar Wrap -->
                @include('layouts.frontend.company.main-side')
            <!-- Content Wrap -->
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-body">
                        <div class="dashboard-caption">

                            <div class="dashboard-caption-header">
                                <h4><i class="ti-user"></i>Applications for {{$job->title}}</h4>
                            </div>

                            <div class="dashboard-caption-wrap">

                                <!-- row -->
{{--                                <div class="row">--}}

{{--                                    <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <input type="text" class="form-control" placeholder="Search Name">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <select id="jb-filter" class="form-control">--}}
{{--                                                <option>Choose Job Status</option>--}}
{{--                                                <option>All Jobs</option>--}}
{{--                                                <option>Approved Jobs</option>--}}
{{--                                                <option>Expire Jobs</option>--}}
{{--                                                <option>Pending Payment</option>--}}
{{--                                                <option>Rejected Jobs</option>--}}
{{--                                                <option>Draft Jobs</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <select id="application-status" class="form-control">--}}
{{--                                                <option>Status</option>--}}
{{--                                                <option>Approved</option>--}}
{{--                                                <option>Pending</option>--}}
{{--                                                <option>Rejected</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
                                <!-- row -->

                                <ul class="list">
                                    @forelse($candidates as $candidate)

                                    <li class="manage-list-row clearfix">
                                        <div class="job-info">
                                            <div class="job-img">
                                                <img src="{{asset($candidate->user->thumbnail_path)}}" class="attachment-thumbnail" alt="{{$candidate->user->full_name}}">
                                            </div>
                                            <div class="job-details">
                                                <h3 class="candidate-name"><a class="candidate_name_tag" href="{{route('candidate.detail',$candidate->ref_id)}}">{{$candidate->user->full_name}}</a>
                                                    @if($candidate->pivot->status == 'shortlisted')<div class="shortlisted-can">Shortlisted</div>@endif @if($candidate->pivot->status == 'rejected')<div class="rejected-can">Rejected</div>@endif
                                                </h3>
                                                <small class="candidate-post"><i class="ti-home"></i>{{$candidate->category->name}}</small>
                                                <small class="candidate-experience"><i class="ti-time"></i>{{$candidate->experience_text}}</small>
                                                <small class="candidate-address"><i class="ti-location-pin"></i>{{$candidate->current_address}}</small>
                                                <div class="shortlisted-can">{{$candidate->job_level->title}}</div>
                                                <div class="candi-skill">
                                                    @foreach($candidate->known_skills as $skills)
                                                    <span class="skill-tag">{{$skills->title}}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-buttons">
                                            <a href="{{route('candidate.download.resume',$candidate->ref_id)}}" target="_blank" class="btn btn-gary manage-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download Resume"><i class="ti-download"></i></a>
{{--                                            <a href="{{$candidate->user->email}}" data-toggle="modal" class="btn btn-blue manage-btn" data-placement="top" title="Message"><i class="ti-email"></i></a>--}}
                                            @if($candidate->pivot->status == 'pending')
                                            <a href="{{route('company.job.action',[$candidate->pivot->ref_id,'shortlisted'])}}"
                                               class="btn btn-shortlist manage-btn" data-toggle="tooltip"
                                               data-placement="top" title="" data-original-title="Shortlist"><i
                                                    class="ti-check"></i></a>
                                            <a href="{{route('company.job.action',[$candidate->pivot->ref_id,'rejected'])}}"
                                               class="btn btn-cancel manage-btn" data-toggle="tooltip"
                                               data-placement="top" title="" data-original-title="Remove"><i
                                                    class="ti-close"></i></a>
                                                @endif
                                        </div>
                                    </li>
                                    @empty
                                        <p class="text-center">No Jobs have been posted yet. <a href="{{route('company.job.create')}}">Post job</a></p>
                                    @endforelse

                                </ul>
                                {!! $candidates->render() !!}
{{--                                <ul class="pagination">--}}
{{--                                    <li class="page-item">--}}
{{--                                        <a class="page-link" href="#" aria-label="Previous">--}}
{{--                                            <i class="ti-arrow-left"></i>--}}
{{--                                            <span class="sr-only">Previous</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                    <li class="page-item">--}}
{{--                                        <a class="page-link" href="#" aria-label="Next">--}}
{{--                                            <i class="ti-arrow-right"></i>--}}
{{--                                            <span class="sr-only">Next</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
