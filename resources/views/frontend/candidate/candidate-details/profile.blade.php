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
                        <div class="dashboard-caption-wrap">

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <a href="{{route('candidate.download.resume',$candidate->ref_id)}}" target="_blank"
                                       class="btn btn-info"><i class="fa fa-download"></i> Download Resume</a>
                                    <div class="full-card">
                                        <div class="deatil-tab-employ tool-tab">
                                            <!-- Start About Sec -->
                                            <div id="about">
                                                <h2 class="detail-title">About Candidate</h2>
                                                <ul class="job-detail-des">
                                                    <li><span>Name:</span>{{$candidate->user->full_name}}</li>
                                                    <li><span>Gender:</span>{{ucwords($candidate->gender) ?? 'N/A'}}
                                                    </li>
                                                    <li>
                                                        <span>Nationality:</span>{{ucwords($candidate->nationality) ?? 'N/A'}}
                                                    </li>
                                                    <li>
                                                        <span>Marital Status:</span>{{ucwords($candidate->marital_status) ?? 'N/A'}}
                                                    </li>
                                                    <li>
                                                        <span>Religion:</span>{{ucwords($candidate->religion) ?? 'N/A'}}
                                                    </li>
                                                    <li>
                                                        <span>Permanent Address:</span>@if(!empty($candidate->permanent_address)){{ucwords($candidate->filter_permanent_address)}}@else {{'N/A'}} @endif
                                                    </li>
                                                    <li>
                                                        <span>Current Address:</span>@if(!empty($candidate->current_address)){{ucwords($candidate->filter_current_address)}}@else {{'N/A'}} @endif
                                                    </li>
                                                    <li><span>Email:</span>{{$candidate->user->email}}
                                                    </li>
                                                    @foreach($candidate->contact_details as $contact_details)
                                                        <li>
                                                            <span>Telephone ({{ $contact_details->detail_key }})</span>{{ $contact_details->detail_value ?? 'N/A' }}
                                                        </li>
                                                    @endforeach
                                                    <li>
                                                        <span>Date Of Birth:</span>{{$candidate->filter_dob ?? 'N/A'}}
                                                    </li>
                                                    @if($candidate->job_level)
                                                        <li>
                                                            <span>Job Level:</span>{{ $candidate->job_level->title  ?? 'N/A'}}
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <span>Job Categories:</span>{{ $candidate->category->name }}
                                                    </li>
                                                    <li><span>Available For:</span>
                                                        @foreach($candidate->job_types as $job_type)
                                                            {{ $job_type->title}} @if(!$loop->last),@endif
                                                        @endforeach
                                                    </li>
                                                    <li>
                                                        <span>Total Experience:</span>{{ $candidate->experience_text  ?? 'N/A'}}
                                                    </li>
                                                    <li><span>Preferred Location:</span>
                                                        @foreach($candidate->preferred_locations as $preferred_location)
                                                            {{$preferred_location->title}} @if(!$loop->last),@endif
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- End About Sec -->
                                        @if($candidate->experience->isNotEmpty())
                                            <!-- Start Address Sec -->
                                                <div id="job-pref">
                                                    <h2 class="detail-title">Experience</h2>
                                                    @foreach($candidate->experience as $experience)
                                                        <div class="experience-detail">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <h3 class="exp-jb-title">{{$experience->job_title}}</h3>
                                                                    <div
                                                                        class="exp-jb-comp">{{ $experience->company_name  }}</div>
                                                                    {!! $experience->description !!}
                                                                </div>
                                                                <div class="col-md-3"><span
                                                                        class="text-primary">{{ ($experience->is_current == 'yes') ? 'Currently Working' : date('M Y',strtotime($experience->start_date)). ' - ' .date('M Y',strtotime($experience->end_date)) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                            @if($candidate->education->isNotEmpty())
                                                <div id="job-pref">
                                                    <h2 class="detail-title">Education</h2>
                                                    @foreach($candidate->education as $education)
                                                        <div class="experience-detail">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h3 class="exp-jb-title">{{$education->institute_name ?? 'N/A'}}</h3>
                                                                    <div
                                                                        class="exp-jb-comp">{{ $education->program_name ?? 'N/A' }}</div>
                                                                    <span
                                                                        class="exp-jb-comp">
                                                                        @if($education->is_current == 'yes')
                                                                            {{'Currently Studying'}}
                                                                        @elseif(!empty($education->passing_year))
                                                                            {{'Passing Year: '.$education->passing_year }}
                                                                        @else
                                                                            {{'Passing Year: N/A'}}
                                                                        @endif
                                                                    </span>
                                                                    <br/>
                                                                    <span
                                                                        class="exp-jb-comp">
                                                                        @if($education->marks_type == 'cgpa')
                                                                            CGPA: {{$education->marks_obtained ?? 'N/A'}}
                                                                        @elseif($education->marks_type == 'percent')
                                                                            @if(!empty($education->marks_obtained))
                                                                                {{$education->marks_obtained.'%'}}
                                                                            @else
                                                                                {{'Marks Obtained : N/A'}}
                                                                            @endif
                                                                        @else
                                                                            {{'Marks Obtained : N/A'}}
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        <!-- End Address Sec -->
                                            @if(!$candidate->known_skills->isEmpty() || !empty($candidate->interest))
                                            <!-- Start Job List -->
                                                <div id="spec-skill">
                                                    <h2 class="detail-title">Interests & Skill</h2>
                                                    <ul class="job-detail-des">
                                                        @if(!empty($candidate->known_skills))
                                                            <li><span>Skills:</span>
                                                                @foreach($candidate->known_skills as $skills)
                                                                    {{ $skills->title }} @if(!$loop->last),@endif
                                                                @endforeach
                                                            </li>
                                                        @endif
                                                        @if(!empty($candidate->interest))
                                                            <li><span>Interests:</span>
                                                                @foreach(explode(',',$candidate->interest) as $interest)
                                                                    {{ $interest }} @if(!$loop->last),@endif
                                                                @endforeach
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endif
                                            @if($candidate->training->isNotEmpty())
                                                <div id="spec-skill">
                                                    <h2 class="detail-title">Trainings</h2>
                                                    @foreach($candidate->training as $training)
                                                        <div class="experience-detail">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h3 class="exp-jb-title">{{$training->name}}</h3>
                                                                    <div
                                                                        class="exp-jb-comp">{{ $training->agency_name }}</div>
                                                                    <div
                                                                        class="exp-jb-comp">
                                                                        From: {{ prettyDate($training->start_date) }}</div>
                                                                    <div
                                                                        class="exp-jb-comp">
                                                                        To: {{ prettyDate($training->end_date) }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            @if($candidate->language->isNotEmpty())
                                                <div id="spec-skill">
                                                    <h2 class="detail-title">Languages</h2>
                                                    <div class="experience-detail">
                                                        <div class="row">
                                                            <table class="table no-margin">
                                                                <thead>
                                                                <tr>
                                                                    <th>Language</th>
                                                                    <th>Reading</th>
                                                                    <th>Writing</th>
                                                                    <th>Speaking</th>
                                                                    <th>Listening</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($candidate->language as $language)
                                                                    <tr>
                                                                        <td>{{ ucwords($language->name)}}</td>
                                                                        <td>{{ ucwords($language->reading)}}</td>
                                                                        <td>{{ ucwords($language->writing)}}</td>
                                                                        <td>{{ ucwords($language->speaking)}}</td>
                                                                        <td>{{ ucwords($language->listening)}}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($candidate->social_medias->isNotEmpty())
                                                <div id="spec-skill">
                                                    <h2 class="detail-title">Social Medias</h2>
                                                    <div class="experience-detail">
                                                        <div class="row">
                                                            <table class="table no-margin">
                                                                <thead>
                                                                <tr>
                                                                    <th>Media</th>
                                                                    <th>URL</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($candidate->social_medias as $media)
                                                                    <tr>
                                                                        <td>{{ ucwords($media->media_key)}}</td>
                                                                        <td><a href="{{ $media->media_value}}"
                                                                               target="_blank">{{ $media->media_value}}</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div id="spec-skill">
                                                <h2 class="detail-title">Additional Info</h2>
                                                <div class="experience-detail">
                                                    <div class="row">
                                                        <table class="table no-margin">
                                                            <tr>
                                                                <td>Willing to travel outside of your residing location
                                                                    during the job
                                                                </td>
                                                                <td>{{ ucwords($candidate->travel_outside) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Willing to temporarily relocate outside of residing
                                                                    location during the job period
                                                                </td>
                                                                <td>{{ ucwords($candidate->relocate_location) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Has Two wheeler License</td>
                                                                <td>{{ ucwords($candidate->two_wheeler_license) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Has Four wheeler License</td>
                                                                <td>{{ ucwords($candidate->four_wheeler_license) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Has Two wheeler Vehicle</td>
                                                                <td>{{ ucwords($candidate->two_wheeler_vehicle) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Has Four wheeler Vehicle</td>
                                                                <td>{{ ucwords($candidate->four_wheeler_vehicle) }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($candidate->reference->isNotEmpty())
                                                <div id="spec-skill">
                                                    <h2 class="detail-title">References</h2>
                                                    @foreach($candidate->reference as $reference)
                                                        <div class="experience-detail">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h3 class="exp-jb-title">{{$reference->name}}</h3>
                                                                    <div
                                                                        class="exp-jb-comp">{{ $reference->designation }}</div>
                                                                    <p>
                                                                        Company: {{$reference->company_name}}<br/>
                                                                        Email: <a
                                                                            href="mailto:{{ $reference->email }}">{{ $reference->email ?? 'N/A' }}</a><br/>
                                                                        Phone: <a
                                                                            href="tel:{{$reference->phone}}">{{$reference->phone ?? 'N/A'}}</a><br/>
                                                                        Alternate Number: <a
                                                                            href="tel:{{$reference->phone2}}">{{$reference->phone2 ?? 'N/A'}}</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
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
    <script>
        $body.on("click", "#page_print", function (e) {
            e.preventDefault(),
                window.print()
        });
    </script>
@endsection
