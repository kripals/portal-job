@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
    <div class="clearfix"></div>

    <!-- Title Header Start -->
    <section class="inner-header-title"
             style="background-image:url('{{ asset('resources/frontend/assets/img/banner-10.jpg') }}');">
        <div class="container">
            <h1>Job Application</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <section class="pricing">
        <div class="container">
            <div class="row">
                <div class="top-candidate-wrap style-2">
                    <div class="top-candidate-box">
                        <div class="text-center">
                            <h5>Review your profile before applying for this job!</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6 table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th colspan="3"><span class="icon-user mr-2"></span>Your Profile</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td colspan="3">
                                            <div class="media">
                                                <div class="job-candidate-box-thumb">
                                                    <img src="{{asset($candidate->user->thumbnail_path)}}"
                                                         class="img-responsive img-circle" alt=""/>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="text-info">{{$candidate->user->full_name}}</h5>
                                                    <p class=""><span
                                                                class="icon-pin"></span>Address: {{ $candidate->current_address }}
                                                    </p>
{{--                                                    @foreach($candidate->contact_details as $contact_details)--}}
{{--                                                        <p class=""><span class="icon-call"></span>Phone:--}}
{{--                                                            ({{ $contact_details->detail_key }}--}}
{{--                                                            ){{ $contact_details->detail_value }}</p>--}}
{{--                                                    @endforeach--}}
{{--                                                    <p class=""><span class="icon-email"></span>Email:--}}
{{--                                                        {{$candidate->user->email}}</p>--}}
                                                    <p class=""><span
                                                                class="icon-star"></span>Age: {{$candidate->candidate_age}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr class="border-top">
                                        <td>Your Skills</td>
                                        <td>
                                            @if(!$candidate->known_skills->isEmpty())
                                                @foreach($candidate->known_skills as $skills)
                                                    <span title="Web Development"
                                                          class="jpc-status">{{ $skills->title }}</span>
                                                @endforeach
                                            @else
                                                <span>No skill Found</span>
                                            @endif
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Your Education Level</td>
                                        <td>
                                            @if(!$candidate->education->isEmpty())
                                                @foreach($candidate->education as $education)
                                                    <span title="Web Development"
                                                          class="jpc-status">{{ $education->qualification_level}}</span>
                                                @endforeach
                                            @else
                                                <span>No education found</span>
                                            @endif
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Your Experience</td>
                                        <td>
                                            <span class="jpc-status">{{($candidate->experience_period)?$candidate->experience_text : 'No Experience Added'}}</span>
                                            <ul class="list-group small">
                                            </ul>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Your Salary Expectation</td>
                                        <td>
                                            <span>{{($candidate->expected_salary) ? $candidate->expected_salary : 'Not Mentioned'}}</span>
                                        </td>
                                    </tr>


                                    <tr class="border-top">
                                        <td colspan="3">
                                            <a href="{{ route('candidate.profile') }}" target="_blank">
                                                <span class="icon-preview mr-1"></span>View My Profile</a>|
                                            <a href="{{ route('candidate.edit-profile') }}" target="_blank">
                                                <span class="icon-profile-edit mr-1"></span>Update Profile
                                            </a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6 table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th colspan="3"><span class="icon-job"></span>Key Job Requirements</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="border-left" colspan="3">
                                            <div class="media">
                                                <div class="job-candidate-box-thumb">
                                                    <img src="{{asset($job->company->image_path)}}"
                                                         class="img-responsive img-circle" alt=""/>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="text-muted">{{$job->title}}</h5>
                                                    <h6 class="text-primary" title="">
                                                        <a href="{{ route('company.detail', $job->company->ref_id) }}">
                                                            {{$job->company->company_name}}</a>
                                                    </h6>

                                                    <div class="">
                                                        <span class="icon-pin"></span>
                                                        <span class="text-muted">
                                                            {{ $job->company->address }}
                                                        </span>
                                                    </div>

                                                    <div class="media">
                                                        <div class="media-left">
                                                            <span class="icon-time"></span>
                                                        </div>
                                                        <div class="media-body">
                                                            <span class="text-muted">Apply Before: {{$job->expiry_date}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-top">
                                        <td class="border-left">Required Skills</td>
                                        <td>
                                            <span>No skills required for this job.</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-left">Required Education Level</td>
                                        <td>
                                            <span class="jpc-status">{{ ($job->education_level) ?? 'No Level Specified'  }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-left">Required Experience</td>
                                        <td>
                                            <span class="jpc-status">{{ $job->experience_text ?? 'N/A'}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-left">Offered Salary</td>
                                        <td>
                                            {{ $job->minimum_salary  }} - {{ $job->maximum_salary  }}
                                        </td>
                                    </tr>


                                    <tr class="border-top">
                                        <td colspan="3">
                                            <div class="float-right">
                                                <a href="{{ route('job.detail', $job->ref_id )}}" target="_blank">
                                                    <span class="icon-job mr-1"></span>View This Job</a>
                                                {{--                                            |--}}
                                                {{--                                            <a href="#" data-link="/jobseeker/add-favorite/113322/" id="save-job">--}}
                                                {{--                                                <span class="icon-star-job mr-1"></span>Save This Job--}}
                                                {{--                                            </a>--}}
                                            </div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            <div class="btn-group">
                                <a href="{{route('job.detail',$job->ref_id)}}" class="btn btn-outline-secondary">Cancel</a>
                                <a class="btn btn-success" href="{{route('candidate.job.apply',$job->ref_id)}}">
                                    Send Application<span class="icon-arrow-right"></span>
                                </a>
                            </div>
                        </div>
                        <div class="float-left">
{{--                            <p class="text-danger">--}}
{{--                                <span class="icon-circle-cancel"></span>Your profile needs few improvements, <a--}}
{{--                                        href="#" class="text-danger"><strong>update--}}
{{--                                        profile</strong></a>. Yet, you can apply for this job!--}}
{{--                            </p>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
