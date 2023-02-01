@extends('layouts.frontend.app')
@section('content')
    @include('layouts.frontend.page-specific-header')
    <div class="clearfix"></div>
    <section class="inner-header-page">
        <div class="container">
            <div class="col-md-7">
                <div class="left-side-container">
                    <div class="freelance-image"><img src="{{asset($candidate->user->thumbnail_path)}}"
                                                      class="img-responsive img-circle" alt=""></div>
                    <div class="header-details">
                        <h4>{{$candidate->user->full_name}}<span
                                class="pull-right"><i class="fa fa-money"></i> {{$candidate->expected_salary}}</span>
                        </h4>
                        <p>{{$candidate->specialization ?? 'N/A'}}</p>
                        <ul>
                            <li><i class="fa fa-building"></i> {{$candidate->category->name}}
                            </li>
                            <li><i class="fa fa-home"></i> {{$candidate->filter_current_address ?? 'N/A'}}
                            </li>
                            @if($candidate->is_verified == 'yes')
                                <li>
                                    <div class="verified-action">Verified</div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-5 bl-1 br-gary">
                <div class="right-side-detail">
                    <ul>
                        <li><span class="detail-info">Availability</span>
                            @if(!$candidate->job_types->isEmpty())
                                @foreach($candidate->job_types()->get() as $jobType)
                                    {{$jobType->title}}
                                @endforeach
                            @else
                                {{'N/A'}}
                            @endif
                            <span class="available-status">{{$candidate->availability_text}}</span>
                        </li>
                        <li><span class="detail-info">Preferred Location</span>
                            @if(!$candidate->preferred_locations->isEmpty())
                                @foreach($candidate->preferred_locations()->get() as $preferredLocation)
                                    {{$preferredLocation->title}}@if(!$loop->last),@endif
                                @endforeach
                            @else
                                {{"N/A"}}
                            @endif
                        </li>
                        <li><span class="detail-info">Experience</span>{{$candidate->experience_text}}</li>
                        <li><span class="detail-info">Date of Birth</span>{{$candidate->filter_dob ?? 'N/A'}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Candidate Detail End -->
    <div class="clearfix"></div>
    <!-- Candidate full detail Start -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="container-detail-box">
                        <div class="apply-job-detail">
                            {!! str_replace('&nbsp;',' ',$candidate->description) !!}
                        </div>
                        <div class="apply-job-detail">
                            <h5>Skills</h5>
                            @if(!$candidate->known_skills->isEmpty())
                                <ul class="skills">
                                    @foreach($candidate->known_skills as $skills)
                                        <li>{{ $skills->title }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No Skills Specified</p>
                            @endif
                        </div>
                    </div>
                    <div class="row-bottom">
                        <h2 class="detail-title">Education</h2>
                        @if(!$candidate->education->isEmpty())
                            <ul class="trim-edu-list">
                                @foreach($candidate->education as $education)
                                    <li>
                                        <div class="trim-edu">
                                            <h4 class="trim-edu-title">{{ucwords($education->qualification_level)}}
                                                ({{ $education->program_name }})</h4>
                                            <strong><i class="fa fa-graduation-cap"></i> {{$education->institute_name}} {{ !empty($education->board) ? '('.ucwords($education->board->title).')' : ''}}</strong>
                                            <span
                                                class="title-est">| <i class="fa fa-calendar"></i> {{ ($education->is_current == 'yes') ? 'Currently Studying' : (!empty($education->passing_year) ? $education->passing_year : 'N/A') }}</span>
                                            <p></p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No Education Specified</p>
                        @endif
                    </div>
                    <div class="row-bottom">
                        <h2 class="detail-title">Work & Experience</h2>
                        @if(!$candidate->experience->isEmpty())
                            <ul class="trim-edu-list">
                                @foreach($candidate->experience as $experience)
                                    <li>
                                        <div class="trim-edu">
                                            <h4 class="trim-edu-title">{{ $experience->company_name  }}<span
                                                    class="title-est">{{ ($experience->is_current == 'yes') ? 'Currently Working' : prettyDate($experience->start_date) . '-' .prettyDate($experience->end_date) }}</span>
                                            </h4>
                                            <strong>{{$experience->job_title}}</strong>
                                            <p></p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No Experience Specified</p>
                        @endif
                    </div>
                    <div class="row-bottom">
                        <h2 class="detail-title">Training</h2>
                        @if(!$candidate->training->isEmpty())
                            <ul class="trim-edu-list">
                                @foreach($candidate->training as $training)
                                    <li>
                                        <div class="trim-edu">
                                            <h4 class="trim-edu-title">{{ $training->name  }}<span
                                                    class="title-est">{{  prettyDate($training->start_date) . '-' .prettyDate($training->end_date) }}</span>
                                            </h4>
                                            <strong>{{$training->agency_name}}</strong>
                                            <p></p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No Training Specified</p>
                        @endif
                    </div>
                    @if(!$candidate->language->isEmpty())
                        <div class="row-bottom">
                            <h2 class="detail-title">Language</h2>
                            <div class="col-sm-12">
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
                                            <td>{{ucwords($language->name)  ?? 'N/A'}}</td>
                                            <td>{{ucwords($language->reading)  ?? 'N/A'}}</td>
                                            <td>{{ucwords($language->writing) ?? 'N/A'}}</td>
                                            <td>{{ucwords($language->speaking) ?? 'N/A'}}</td>
                                            <td>{{ucwords($language->listening) ?? 'N/A'}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <br/>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="full-sidebar-wrap">
                        <div class="sidebar-widgets">
                            <div class="ur-detail-wrap">
                                <div class="ur-detail-wrap-header">
                                    <h4>Candidate Overview</h4>
                                </div>
                                <div class="ur-detail-wrap-body">
                                    <ul class="ove-detail-list">
                                        <li>
                                            <i class="ti-wallet"></i>
                                            <h5>Expected Salary</h5>
                                            <span>{{$candidate->expected_salary}}</span>
                                        </li>
                                        <li>
                                            <i class="ti-user"></i>
                                            <h5>Gender</h5>
                                            <span>{{ucwords($candidate->gender)}}</span>
                                        </li>
                                        <li>
                                            <i class="ti-ink-pen"></i>
                                            <h5>Career Level</h5>
                                            <span>{{$candidate->job_level->title ?? 'N/A'}}</span>
                                        </li>
                                        <li>
                                            <i class="ti-home"></i>
                                            <h5>Industry</h5>
                                            <span>{{$candidate->category->name}}</span>
                                        </li>
                                        <li>
                                            <i class="ti-shield"></i>
                                            <h5>Experience</h5>
                                            <span>{{$candidate->experience_text}}</span>
                                        </li>
                                            <a href="{{route('candidate.download.resume',$candidate->ref_id)}}" class="btn btn-info"
                                               target="_blank"><i class="ti-download mrg-r-5"></i> Download Resume</a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /Candidate overview -->
{{--                        @include('frontend.quick-inquiry')--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- company full detail End -->
@endsection
