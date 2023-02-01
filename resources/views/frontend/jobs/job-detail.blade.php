@extends('layouts.frontend.app')
@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('resources/frontend/assets/css/lightbox.min.css') }}"/>
@endsection
@section('content')
    @include('layouts.frontend.page-specific-header')
    <div class="clearfix"></div>

    <!-- Title Header Start -->
    <section class="inner-header-title"
             style="background-image:url({{asset('resources/frontend/assets/img/banner-10.jpg')}}">
        <div class="container">
            <h1>{{$job->title}}</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- Candidate Detail Start -->
    <section class="detail-desc">
        <div class="container">

            <div class="ur-detail-wrap top-lay">

                <div class="ur-detail-box">
                    @if($job->company_id)
                        <a href="{{route('company.detail',$job->company->ref_id)}}">
                            <div class="ur-thumb">
                                <img src="{{asset($job->company->image_path)}}" class="img-responsive" alt=""/>
                            </div>
                        </a>
                    @endif
                    <div class="ur-caption">
                        <h4 class="ur-title">{{$job->title}}</h4>
                        @if($job->company_id)
                            <p class="ur-location">
                                <i class="ti-location-pin mrg-r-5"></i>{{$job->company->address ?? 'N/A'}}</p>
                        @endif
                        <span class="ur-designation">
                            <i class="ti-home mrg-r-5"></i>
                            @if($job->company_id)
                                <a href="{{route('company.detail',$job->company->ref_id)}}">{{$job->company->company_name ?? 'N/A'}}</a>
                            @else
                                {{$job->company_name ?? 'N/A'}}
                            @endif
                        </span>
                        @if($job->company_id)
                            <span class="ur-designation">
                            <i class="ti-receipt mrg-r-5"></i>{{$job->company->company_reg_no ?? 'N/A'}}</span>
                        @endif
                        @if($job->source)
                            <span class="ur-designation">
                            <i class="ti-receipt mrg-r-5"></i>Source: {{ucwords($job->source) ?? 'N/A'}}</span>
                        @endif
                    </div>
                </div>

                <div class="ur-detail-btn">
                    @if($job->apply_online == 'yes')
                        @if($job->end_date > \Carbon\Carbon::now())
                            @if($job->is_verified === 'yes')
                                @if(auth()->check() && auth()->user()->hasRole(['ROLE_CANDIDATE']))
                                    @if(!in_array($job->ref_id,$appliedJobsArr))
                                        <a href="{{route('candidate.job.apply.process',$job->ref_id)}}"
                                           class="btn btn-info mrg-bot-10 full-width"><i class="ti-star mrg-r-5"></i>Apply
                                            This
                                            Job</a><br>
                                    @else
                                        <button class="btn btn-warning full-width" disabled><i
                                                class="ti-close mrg-r-5"></i>Job
                                            Applied
                                        </button>
                                    @endif
                                @else
                                    <a class="btn btn-warning full-width" href="javascript:void(0)" data-toggle="modal"
                                       data-target="#signup"><i class="ti-star mrg-r-5"></i>Apply This
                                        Job
                                    </a>
                                    <p>Log in as a jobseeker</p>
                                @endif
                            @endif
                        @else
                            <button class="btn btn-danger full-width" disabled><i class="ti-close mrg-r-5"></i>Expired
                                Job
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Job full detail Start -->
    <section class="full-detail-description full-detail">
        <div class="container">
            <!-- Job Description -->
            <div class="col-md-8 col-sm-12">
                <div class="full-card">
                    <div class="row row-bottom mrg-0">
                        <h2 class="detail-title">Job Detail</h2>
                        <ul class="job-detail-des">
                            <li><span>Offered Salary:</span>{{$job->offered_salary}}</li>
                            <li><span>Job Role:</span>{{$job->category->name}}</li>
                            <li><span>Number of Vacancy:</span>{{$job->vacancy_number}}</li>
                            <li><span>Job Level:</span>{{$job->job_level->title}}</li>
                            <li><span>Job Type:</span>{{$job->job_type->title}}</li>
                            <li><span>Address:</span>{{$job->location ?? "N/A"}}</li>
                        </ul>
                    </div>
                    @if(!$job->skills->isEmpty())
                    <div class="row row-bottom mrg-0">
                        <div class="apply-job-detail">
                            <h2 class="detail-title">Skills Required</h2>
                            <ul class="skills">
                                @foreach($job->skills as $skill)
                                    <li>{{$skill->title}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    {{--                    <div class="row row-bottom mrg-0">--}}
                    {{--                        <h2 class="detail-title">Contact Info</h2>--}}
                    {{--                        <ul class="job-detail-des">--}}

                    {{--                            --}}{{--                            <li><span>City:</span>Mohali</li>--}}
                    {{--                            --}}{{--                            <li><span>State:</span>Punjab</li>--}}
                    {{--                            --}}{{--                            <li><span>Country:</span>India</li>--}}
                    {{--                            --}}{{--                            <li><span>Zip:</span>520 548</li>--}}
                    {{--                            <li>--}}
                    {{--                                <span>Telephone:</span>--}}
                    {{--                                @foreach($job->company->contact_details as $contacts)--}}
                    {{--                                    <a href="tel:{{$contacts->detail_value}}" class="__cf_tel__">--}}
                    {{--                                        {{$contacts->detail_value}}@if(!$loop->last),@endif--}}
                    {{--                                    </a>--}}
                    {{--                                @endforeach</li>--}}
                    {{--                            --}}{{--                            <li><span>Fax:</span>(622) 123 456</li>--}}
                    {{--                            <li><span>Email:</span>--}}
                    {{--                                <a href="mailto:{{$job->company->user->email}}"--}}
                    {{--                                   class="__cf_email__">{{$job->company->user->email}}</a>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}
                    {{--                    </div>--}}
                    @if(!empty($job->description))
                    <div class="row row-bottom mrg-0">
                        <h2 class="detail-title">Job Description</h2>
                        {!! str_replace('&nbsp;',' ',$job->description) ?? '<p>No Job Responsibility Specified</p>' !!}
                    </div>
                    @endif
                    @if(!empty($job->image))
                        <a class="example-image-link" href="{{asset($job->image_path)}}" data-lightbox="example-{{$job->ref_id}}" data-title="{{$job->title}}">
                            <img class="img img-responsive" src="{{asset($job->thumbnail_path)}}" alt="{{$job->title}}"/>
                        </a>
                    @endif
                    @if(!empty($job->specification))
                    <div class="row row-bottom mrg-0">
                        <h2 class="detail-title">Job Specification</h2>
                        {!! str_replace('&nbsp;',' ', $job->specification) ?? '<p>No Job Specification Specified</p>' !!}
                    </div>
                    @endif
                    @if(!empty($job->apply_procedure))
                        <div class="row row-bottom mrg-0">
                            <h2 class="detail-title">Apply Procedure</h2>
                            {!! str_replace('&nbsp;',' ', $job->apply_procedure) !!}
                        </div>
                    @endif
                    <div class="row row-bottom mrg-0">
                        <!--                        <h2 class="detail-title">Map Location</h2>-->
                        <!--                        <div id="map_full_width_one" class="full-width" style="height:400px;"></div>-->
                    </div>
                </div>
            </div>
            <!-- End Job Description -->

            <!-- Start Sidebar -->
            <div class="col-md-4 col-sm-12">
                <div class="sidebar right-sidebar">

                    <!-- Job Alert -->
                {{--                    <a href="javascript:void(0)" class="btn btn-info full-width mrg-bot-20" data-toggle="modal"--}}
                {{--                       data-target="#job-alert">Get Job Alert!</a>--}}
                <!-- /Job Alert -->

                    <div class="side-widget">
                        <h2 class="side-widget-title">Job Overview</h2>
                        <div class="widget-text padd-0">
                            <div class="ur-detail-wrap">
                                <div class="ur-detail-wrap-body padd-top-20">
                                    <ul class="ove-detail-list">

                                        <li>
                                            <i class="ti-user"></i>
                                            <h5>Gender</h5>
                                            @if($job->gender_specific == 'no')
                                                <span>Any</span>
                                            @else
                                                <span>{{ucwords($job->gender)}}</span>
                                            @endif
                                        </li>

                                        <li>
                                            <i class="ti-ink-pen"></i>
                                            <h5>Career Level</h5>
                                            <span>{{$job->job_level->title}}</span>
                                        </li>

                                        <li>
                                            <i class="ti-home"></i>
                                            <h5>Category</h5>
                                            <span>{{$job->category->name}}</span>
                                        </li>

                                        <li>
                                            <i class="ti-shield"></i>
                                            <h5>Experience Required</h5>
                                            <span>{{!empty($job->experience_value) ? $job->experience_text : 'No Experience'}}</span>
                                        </li>

                                        <li>
                                            <i class="ti-book"></i>
                                            <h5>Qualification Required</h5>
                                            <span>{{ucwords($job->education_level) ?? 'Any Level'}}</span>
                                        </li>

                                        <li>
                                            <i class="ti-time"></i>
                                            <h5> Apply Before (Deadline)</h5>
                                            <span>
                                                {{\Carbon\Carbon::parse($job->end_date)->format('d M, Y h:m A')}} ({{$job->job_expiry}})
                                            </span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--                    <div class="statistic-item flex-middle">--}}
                    {{--                        <div class="icon text-theme">--}}
                    {{--                            <i class="ti-time theme-cl"></i>--}}
                    {{--                        </div>--}}
                    {{--                        <span class="text"><span class="number">--}}
                    {{--                                Apply Before: 6 days, 10 hours from now--}}
                    {{--                               Apply Before (deadline):--}}
                    {{--                                <p>{{$job->job_expiry}}</p>--}}
                    {{--                            </span>--}}
                    {{--                        </span>--}}
                    {{--                    </div>--}}

                    <div class="statistic-item flex-middle">
                        <div class="icon text-theme">
                            <i class="ti-zoom-in theme-cl"></i>
                        </div>
                        <span class="text"><span class="number">{{$job->views}}</span> Views</span>
                    </div>
                    <div class="statistic-item flex-middle">
                        <div class="icon text-theme">
                            <i class="ti-write theme-cl"></i>
                        </div>
                        <span class="text"><span class="number">{{$job->applicants->count()}}</span> Applicants</span>
                    </div>
                    <div class="sidebar-widgets">

                        <div class="ur-detail-wrap">
                            <div class="ur-detail-wrap-header">
                                <h4>Share This Job</h4>
                            </div>
                            <div class="ur-detail-wrap-body">
                                <!-- AddToAny BEGIN -->
                                <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                    <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                    <a class="a2a_button_facebook"></a>
                                    <a class="a2a_button_twitter"></a>
                                    <a class="a2a_button_linkedin"></a>
                                    <a class="a2a_button_whatsapp"></a>
                                    <a class="a2a_button_viber"></a>
                                    <a class="a2a_button_email"></a>
                                </div>
                                <script async src="https://static.addtoany.com/menu/page.js"></script>
                                <!-- AddToAny END -->
{{--                                <ul class="simple-list-sshare">--}}
{{--                                    <li><a href="#"><i class="ti-facebook"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="ti-linkedin"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="ti-twitter"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="ti-instagram"></i></a></li>--}}
{{--                                </ul>--}}
                            </div>
                        </div>

                    </div>
                    {{--                   @include('frontend.quick-inquiry')--}}

                </div>
            </div>
            <!-- End Sidebar -->
        </div>
    </section>
    <!-- Job full detail End -->
    @if(!$relatedJobs->isEmpty())
        <!-- More Jobs -->
        <section class="padd-top-20">
            <div class="container">

                <div class="row mrg-0">
                    <div class="col-md-12 col-sm-12">
                        <h3>Related Jobs</h3>
                    </div>
                </div>
                <!--Browse Job In Grid-->
                <div class="row mrg-0">
                    @foreach($relatedJobs as $relJob)
                        <div class="col-md-3 col-sm-6">
                            <div class="grid-view brows-job-list">

                                <div class="brows-job-company-img">
                                    @if($relJob->company_id)
                                        <img src="{{asset($relJob->company->image_path)}}"
                                             class="img-responsive" alt=""/>
                                    @endif

                                </div>
                                <div class="brows-job-position">
                                    <h3>
                                        <a href="{{route('job.detail',$relJob->ref_id)}}">{{$relJob->title}}</a>
                                    </h3>

                                    <a href="{{route('job.detail',$relJob->ref_id)}}"><span>@if($relJob->company_id){{$relJob->company->company_name}}@else{{$relJob->company_name}}@endif</span></a>
                                </div>
                                <div class="job-position"><span
                                        class="job-num">{{$relJob->vacancy_number}} Position</span>
                                </div>
                                <div class="brows-job-type"><span class="part-time">{{$relJob->job_type->title}}</span>
                                </div>
                                <ul class="grid-view-caption">
                                    {{--                                <li>--}}
                                    {{--                                    <div class="brows-job-location">--}}
                                    {{--                                        <p><i class="fa fa-map-marker"></i>{{$job->location}}</p>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </li>--}}
                                    {{--                                <li>--}}
                                    {{--                                    <p><span class="brows-job-sallery"><i class="fa fa-money"></i>$110 - 200</span></p>--}}
                                    {{--                                </li>--}}
                                </ul>
                            </div>
                        </div>
                    @endforeach
                    {{--                <div class="col-md-4 col-sm-6">--}}
                    {{--                    <div class="grid-view brows-job-list">--}}
                    {{--                        <div class="brows-job-company-img">--}}
                    {{--                            <img src="assets/img/com-2.jpg" class="img-responsive" alt=""/>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="brows-job-position">--}}
                    {{--                            <h3><a href="job-detail.php">Web Developer</a></h3>--}}
                    {{--                            <p><span>Google</span></p>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="job-position">--}}
                    {{--                            <span class="job-num">5 Position</span>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="brows-job-type">--}}
                    {{--                            <span class="part-time">Part Time</span>--}}
                    {{--                        </div>--}}
                    {{--                        <ul class="grid-view-caption">--}}
                    {{--                            <li>--}}
                    {{--                                <div class="brows-job-location">--}}
                    {{--                                    <p><i class="fa fa-map-marker"></i>QBL Park, C40</p>--}}
                    {{--                                </div>--}}
                    {{--                            </li>--}}
                    {{--                            <li>--}}
                    {{--                                <p><span class="brows-job-sallery"><i class="fa fa-money"></i>$110 - 200</span></p>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}

                    {{--                <div class="col-md-4 col-sm-6">--}}
                    {{--                    <div class="grid-view brows-job-list">--}}
                    {{--                        <div class="brows-job-company-img">--}}
                    {{--                            <img src="assets/img/com-1.jpg" class="img-responsive" alt=""/>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="brows-job-position">--}}
                    {{--                            <h3><a href="job-detail.php">Web Developer</a></h3>--}}
                    {{--                            <p><span>Google</span></p>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="job-position">--}}
                    {{--                            <span class="job-num">5 Position</span>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="brows-job-type">--}}
                    {{--                            <span class="freelanc">Freelancer</span>--}}
                    {{--                        </div>--}}
                    {{--                        <ul class="grid-view-caption">--}}
                    {{--                            <li>--}}
                    {{--                                <div class="brows-job-location">--}}
                    {{--                                    <p><i class="fa fa-map-marker"></i>QBL Park, C40</p>--}}
                    {{--                                </div>--}}
                    {{--                            </li>--}}
                    {{--                            <li>--}}
                    {{--                                <p><span class="brows-job-sallery"><i class="fa fa-money"></i>$110 - 200</span></p>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}
                    {{--                        <span class="tg-themetag tg-featuretag">Premium</span>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}

                </div>
                <!--/.Browse Job In Grid-->
            </div>
        </section>
        <!-- More Jobs End -->
    @endif
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/lightbox.min.js') }}"></script>
@endsection
