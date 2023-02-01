@extends('layouts.admin.layouts')

@section('title', $candidate->user->full_name)

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <!-- BEGIN CONTACT DETAILS -->
                <div class="card-tiles">
                    <div class="hbox-md col-md-12">
                        <div class="hbox-column col-md-9">
                            <div class="row">

                                <!-- BEGIN CONTACTS MAIN CONTENT -->
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="margin-bottom-xxl">
                                        <div class="pull-left width-3 clearfix hidden-xs">
                                            <img class="img-circle size-2"
                                                 src="{{asset($candidate->user->thumbnail_path)}}"
                                                 alt=""/>
                                        </div>
                                        <h1 class="text-light no-margin">{{$candidate->user->full_name}}</h1>
                                        <h5>
                                            {{$candidate->category->name}}
                                            @if($candidate->is_verified == 'yes')
                                                <span data-uk-tooltip="" title="verified"
                                                      class="label label-success">Verified</span>
                                            @else
                                                <span data-uk-tooltip="" title="verified"
                                                      class="label label-warning">Not verified</span>
                                            @endif
                                            @if($candidate->status == 'active')
                                                <span data-uk-tooltip="" title="verified"
                                                      class="label label-success">Active</span>
                                            @else
                                                <span data-uk-tooltip="" title="verified"
                                                      class="label label-danger">Inactive</span>
                                            @endif
                                        </h5>
                                    </div><!--end .margin-bottom-xxl -->
                                    <ul class="nav nav-tabs" data-toggle="tabs">
                                        <li class="active"><a href="#basic-info">Basic Info</a></li>
                                        <li><a href="#job-info">Job Preference</a></li>
                                        <li><a href="#educations">Educations</a></li>
                                        <li><a href="#experiences">Experiences</a></li>
                                        <li><a href="#trainings">Trainings</a></li>
                                        <li><a href="#references">References</a></li>
                                        <li><a href="#others">Others</a></li>
                                    </ul>
                                    <div class="tab-content">

                                        <!-- BEGIN CONTACTS NOTES -->
                                        <div class="tab-pane active" id="basic-info">
                                            <br/>
                                            <div class="row">
                                                {{--                                                <div class="col-sm-12">--}}
                                                {{--                                                    <h3 class="opacity-50">Summary</h3>--}}
                                                {{--                                                    <article class="text-columns-2">--}}
                                                {{--                                                        {!! $candidate->description !!}--}}
                                                {{--                                                    </article>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <br/>--}}
                                                <div class="col-sm-12">
                                                    <table class="table no-margin">
                                                        <tbody>
                                                        <tr>
                                                            <td>Current Address</td>
                                                            <td>{{ $candidate->current_address ?? 'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Permanent Address</td>
                                                            <td>{{ $candidate->permanent_address ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Gender</td>
                                                            <td>{{ ucwords($candidate->gender) ?? 'N/A' }}</td>
                                                        <tr>
                                                            <td>Date of Birth</td>
                                                            <td>{{ prettyDate($candidate->birth_date) ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nationality</td>
                                                            <td>{{ ucwords($candidate->nationality) ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Marital Status</td>
                                                            <td>{{ ucwords($candidate->marital_status) ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Religion</td>
                                                            <td>{{ ucwords($candidate->religion) ?? 'N/A' }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div><!--end #notes -->
                                        <div class="tab-pane" id="job-info">
                                            <br/>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table no-margin">
                                                        <tbody>
                                                        <tr>
                                                            <td>Preferred Job Category</td>
                                                            <td>{{ $candidate->category->name  ?? 'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Job Level</td>
                                                            <td>{{ $candidate->job_level->title  ?? 'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Job Types</td>
                                                            <td>
                                                                @if($candidate->job_types)
                                                                    @foreach($candidate->job_types as $jobType)
                                                                        {{rtrim($jobType->title.', ')}}
                                                                    @endforeach
                                                                @else
                                                                    {{'N/A'}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Preferred Locations</td>
                                                            <td>
                                                                @if($candidate->preferred_locations)
                                                                    @foreach($candidate->preferred_locations as $location)
                                                                        {{rtrim($location->title.', ')}}
                                                                    @endforeach
                                                                @else
                                                                    {{'N/A'}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Specializations</td>
                                                            <td>{{ rtrim($candidate->specialization) ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Skills</td>
                                                            <td>
                                                                @if($candidate->known_skills)
                                                                    @foreach($candidate->known_skills as $skill)
                                                                        {{rtrim($skill->title.', ')}}
                                                                    @endforeach
                                                                @else
                                                                    {{'N/A'}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Expected Salary</td>
                                                            <td>{{ $candidate->expected_salary ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Current Salary</td>
                                                            <td>{{ $candidate->current_salary ?? 'N/A' }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="col-sm-12">
                                                        <h3 class="opacity-50">Summary</h3>
                                                        <article class="text-columns-2">
                                                            {!! $candidate->description !!}
                                                        </article>
                                                    </div>
                                                    <br/>
                                                </div>
                                            </div>
                                        </div><!--end #notes -->
                                        <div class="tab-pane" id="educations">
                                            <br/>
                                            <div class="row">
                                                @if($educations)
                                                    @foreach($educations as $education)
                                                        <div class="col-sm-12">
                                                            <h3 class="opacity-50">{{ucwords($education->qualification_level)}}</h3>
                                                            <table class="table no-margin">
                                                                <tbody>
                                                                <tr>
                                                                    <td>Program Name</td>
                                                                    <td>{{ $education->program_name  ?? 'N/A'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Education Board</td>
                                                                    <td>{{ $education->education_board  ?? 'N/A'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Institute Name</td>
                                                                    <td>{{$education->institute_name ?? 'N/A'}}</td>
                                                                </tr>
                                                                @if($education->is_current == 'yes')
                                                                    <tr>
                                                                        <td>Currently Studying</td>
                                                                        <td>{{ ucwords($education->is_current) ?? 'N/A' }}</td>
                                                                    </tr>
                                                                @else
                                                                    <tr>
                                                                        <td>Passing Year</td>
                                                                        <td>{{ $education->passing_year  ?? 'N/A'}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Marks Obtained</td>
                                                                        <td>{{ $education->marks_obtained_type  ?? 'N/A'}}</td>
                                                                    </tr>
                                                                @endif
                                                                </tbody>
                                                            </table>
                                                            <br/>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div><!--end #notes -->
                                        <div class="tab-pane" id="experiences">
                                            <br/>
                                            <div class="row">
                                                @if($experiences)
                                                    @foreach($experiences as $experience)
                                                        <div class="col-sm-12">
                                                            <h3 class="opacity-50">{{ucwords($experience->company_name)}}</h3>
                                                            <table class="table no-margin">
                                                                <tbody>
                                                                <tr>
                                                                    <td>Job Title</td>
                                                                    <td>{{ $experience->job_title  ?? 'N/A'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Job Location</td>
                                                                    <td>{{ $experience->location->title  ?? 'N/A'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Industry Type</td>
                                                                    <td>{{$experience->company_category->name ?? 'N/A'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Job Type</td>
                                                                    <td>{{$experience->candidate_category->name ?? 'N/A'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Job Level</td>
                                                                    <td>{{$experience->job_level->title ?? 'N/A'}}</td>
                                                                </tr>
                                                                @if($experience->is_current == 'yes')
                                                                    <tr>
                                                                        <td>Currently Working</td>
                                                                        <td>{{ ucwords($experience->is_current) ?? 'N/A' }}</td>
                                                                    </tr>
                                                                @else
                                                                    <tr>
                                                                        <td>Start date</td>
                                                                        <td>{{ prettyDate($experience->start_date)  ?? 'N/A'}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>End Date</td>
                                                                        <td>{{ prettyDate($experience->end_date)  ?? 'N/A'}}</td>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h4 class="opacity-50">Job Description</h4>
                                                                        {!! $experience->description !!}
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <br/>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div><!--end #notes -->
                                        <div class="tab-pane" id="trainings">
                                            <br/>
                                            <div class="row">
                                                @if($trainings)
                                                    @foreach($trainings as $training)
                                                        <div class="col-sm-12">
                                                            <h3 class="opacity-50">{{ucwords($training->name)}}</h3>
                                                            <table class="table no-margin">
                                                                <tbody>
                                                                <tr>
                                                                    <td>Agency Name</td>
                                                                    <td>{{ $training->agency_name  ?? 'N/A'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Start Date</td>
                                                                    <td>{{ prettyDate($training->start_date) ?? 'N/A'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>End Date</td>
                                                                    <td>{{ prettyDate($training->end_date) ?? 'N/A'}}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <br/>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div><!--end #notes -->
                                        <div class="tab-pane" id="references">
                                            <br/>
                                            <div class="row">
                                                @if($references)
                                                    @foreach($references as $reference)
                                                        <div class="col-sm-12">
                                                            <h3 class="opacity-50">{{ucwords($reference->name)}}</h3>
                                                            <table class="table no-margin">
                                                                <tbody>
                                                                <tr>
                                                                    <td>Designation</td>
                                                                    <td>{{ $reference->designation  ?? 'N/A'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Company Name</td>
                                                                    <td>{{ $reference->company_name  ?? 'N/A'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email Address</td>
                                                                    <td>{{ $reference->email_address  ?? 'N/A'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Phone Number</td>
                                                                    <td>{{$reference->phone ?? 'N/A'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Alternate Phone Number</td>
                                                                    <td>{{$reference->phone2 ?? 'N/A'}}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <br/>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div><!--end #notes -->
                                        <div class="tab-pane" id="others">
                                            <br/>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="opacity-50">Other Details</h3>
                                                    <table class="table no-margin">
                                                        <tbody>
                                                        <tr>
                                                            <td>Interests</td>
                                                            <td>{{ $candidate->interest  ?? 'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Willing to travel outside of your residing location
                                                                during the job.
                                                            </td>
                                                            <td>{{ ucwords($candidate->travel_outside)  ?? 'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Willing to temporarily relocate outside of residing
                                                                location during the job period.
                                                            </td>
                                                            <td>{{ucwords($candidate->relocate_location) ?? 'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Has Two wheeler License.</td>
                                                            <td>{{ucwords($candidate->two_wheeler_license) ?? 'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Has Four wheeler License.</td>
                                                            <td>{{ucwords($candidate->four_wheeler_license) ?? 'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Has Two wheeler Vehicle</td>
                                                            <td>{{ucwords($candidate->two_wheeler_vehicle) ?? 'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Has Four wheeler Vehicle</td>
                                                            <td>{{ucwords($candidate->four_wheeler_vehicle) ?? 'N/A'}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @if($languages)
                                                    <div class="col-sm-12">
                                                        <h3 class="opacity-50">Languages</h3>
                                                        <table class="table no-margin">
                                                            <thead>
                                                            <tr>
                                                                <th>Language Name</th>
                                                                <th>Reading</th>
                                                                <th>Writing</th>
                                                                <th>Speaking</th>
                                                                <th>Listening</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($languages as $language)
                                                                <tr>
                                                                    <td>{{ $language->name  ?? 'N/A'}}</td>
                                                                    <td>{{ $language->reading  ?? 'N/A'}}</td>
                                                                    <td>{{$language->writing ?? 'N/A'}}</td>
                                                                    <td>{{$language->speaking ?? 'N/A'}}</td>
                                                                    <td>{{$language->listening ?? 'N/A'}}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                        <br/>
                                                    </div>
                                                @endif
                                                @if($socialMedias)
                                                    <div class="col-sm-12">
                                                        <h3 class="opacity-50">Social Medias</h3>
                                                        <table class="table no-margin">
                                                            <thead>
                                                            <tr>
                                                                <th>Media Type</th>
                                                                <th>Media URL</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($socialMedias as $social_media)
                                                                <tr>
                                                                    <td>{{ ucwords($social_media->media_key)  ?? 'N/A'}}</td>
                                                                    <td>{{ $social_media->media_value  ?? 'N/A'}}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                        <br/>
                                                    </div>
                                                @endif
                                            </div>
                                        </div><!--end #notes -->
                                        <!-- END CONTACTS NOTES -->
                                    </div><!--end .tab-content -->
                                </div><!--end .col -->
                                <!-- END CONTACTS MAIN CONTENT -->

                            </div><!--end .row -->
                        </div><!--end .hbox-column -->

                        <!-- BEGIN CONTACTS COMMON DETAILS -->
                        <div class="hbox-column col-md-3 style-default-light">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>Contact info</h4>
                                    <br/>
                                    <dl class="dl-horizontal dl-icon">
                                        <dt><span class="fa fa-fw fa-envelope-square fa-lg opacity-50"></span></dt>
                                        <dd>
                                            <span class="opacity-50">Registered Email</span><br/>
                                            <a class="text-medium" href="mailto:{{$candidate->user->email}}">{{$candidate->user->email}}</a>
                                        </dd>
                                        <dt><span class="fa fa-fw fa-mobile fa-lg opacity-50"></span></dt>
                                        <dd>
                                            <span class="opacity-50">Phone</span><br/>
                                            @if($contactDetails)
                                                @foreach($contactDetails as $contactDetail)
                                                    <span class="text-medium">{{$contactDetail->detail_value}}</span>
                                                    &nbsp;<span
                                                        class="opacity-50">{{ucwords($contactDetail->detail_key)}}</span>
                                                    <br/>
                                                @endforeach
                                            @endif
                                        </dd>
                                        <dt><span class="fa fa-fw fa-location-arrow fa-lg opacity-50"></span></dt>
                                        <dd>
                                            <span class="opacity-50">Address</span><br/>
                                            <span class="text-medium">
														{{$candidate->current_address}}
													</span>
                                        </dd>
                                        <dt><span class="fa fa-fw fa-edit fa-lg opacity-50"></span></dt>
                                        <dd>
                                            <span class="opacity-50">Registration Date</span><br/>
                                            <span class="text-medium">
														{{$candidate->created_at->format('d M Y')}}
													</span>
                                        </dd>
                                        {{--                                        <dd class="full-width"><div id="map-canvas" class="border-white border-xl height-5"></div></dd>--}}
                                    </dl><!--end .dl-horizontal -->
                                </div><!--end .col -->
                            </div><!--end .row -->
                        </div><!--end .hbox-column -->
                        <!-- END CONTACTS COMMON DETAILS -->

                    </div><!--end .hbox-md -->
                </div><!--end .card-tiles -->
                <!-- END CONTACT DETAILS -->

            </div><!--end .card -->
        </div><!--end .section-body -->
    </section>
@endsection



