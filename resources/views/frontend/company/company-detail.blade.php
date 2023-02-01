@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
<div class="clearfix"></div>

<!-- Title Header Start -->
<section class="inner-header-title" style="background-image:url({{asset('resources/frontend/assets/img/banner-10.jpg')}});">
    <div class="container">
        <h1>{{$company->company_name}}</h1>
    </div>
</section>
<div class="clearfix"></div>
<!-- Title Header End -->

<!-- Company Detail Start -->
<section class="detail-desc">
    <div class="container">

        <div class="ur-detail-wrap top-lay">

            <div class="ur-detail-box">

                <div class="ur-thumb">
                    <img src="{{asset($company->image_path)}}" class="img-responsive" alt="" />
                </div>
                <div class="ur-caption">
                    <h4 class="ur-title">{{$company->company_name}}</h4>
                    <p class="ur-location"><i class="ti-location-pin mrg-r-5"></i>{{$company->address ?? 'N/A'}}</p>
                    <span class="ur-designation">{{$company->category->name ?? 'N/A'}}</span>
                    <div class="shortlisted-can">{{$company->ownership ?? 'N/A'}}</div>
{{--                    <div class="rateing">--}}
{{--                        <i class="fa fa-star filled"></i>--}}
{{--                        <i class="fa fa-star filled"></i>--}}
{{--                        <i class="fa fa-star filled"></i>--}}
{{--                        <i class="fa fa-star filled"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                    </div>--}}
                </div>

            </div>

            <div class="ur-detail-btn">
{{--                <a href="#" class="btn btn-warning mrg-bot-10 full-width">Follow Now</a><br>--}}
{{--                <a href="#" class="btn btn-primary full-width">Follow</a>--}}
            </div>

        </div>

    </div>
</section>
<!-- Company Detail End -->

<!-- company full detail Start -->
<section class="full-detail-description full-detail">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-8">

                <div class="row-bottom">
                    <h2 class="detail-title">About Company</h2>
                    {!! str_replace('&nbsp;',' ',$company->description) !!}
                </div>

                <div class="row-bottom">
                    <h2 class="detail-title">Current Opening</h2>
                    <h4 class="mrg-bot-15">Total {{$companyJobs->count()}} New Openings</h4>
                    @if($companyJobs)
                    <!--Browse Job In Grid-->
                    <div class="row extra-mrg">
                        @foreach($companyJobs as $job)
                            <div class="col-md-4 col-sm-6">
                                <div class="grid-view brows-job-list">
                                    <div class="brows-job-company-img">
                                        <img src="{{asset($job->company->image_path)}}"
                                             class="img-responsive" alt=""/></div>
                                    <div class="brows-job-position">
                                        <h3><a href="{{route('job.detail',$job->ref_id)}}">{{$job->title}}</a></h3>
                                        <a href="{{route('job.detail',$job->ref_id)}}"><span>{{$job->company->company_name}}</span></a>
                                    </div>
                                    <div class="job-position"><span class="job-num">{{$job->vacancy_number}} Position</span>
                                    </div>
                                    <div class="brows-job-type"><span class="part-time">{{$job->job_type->title}}</span>
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
                    </div>
                    @endif
                    <!--/.Browse Job In Grid-->
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="full-sidebar-wrap">

                    <!-- Company overview -->
                    <div class="sidebar-widgets">

                        <div class="ur-detail-wrap">
                            <div class="ur-detail-wrap-header">
                                <h4>Company Overview</h4>
                            </div>
                            <div class="ur-detail-wrap-body">
                                <ul class="ove-detail-list">

                                    <li>
                                        <i class="ti-ruler-pencil"></i>
                                        <h5>Member Since</h5>
                                        <span>{{prettyDate($company->created_at)}}</span>
                                    </li>

                                    <li>
                                        <i class="ti-user"></i>
                                        <h5>Employees</h5>
                                        <span>{{$company->company_size}}</span>
                                    </li>

{{--                                    <li>--}}
{{--                                        <i class="ti-face-smile"></i>--}}
{{--                                        <h5>Owner Name</h5>--}}
{{--                                        <span>{{$company->user->full_name}}</span>--}}
{{--                                    </li>--}}

{{--                                    <li>--}}
{{--                                        <i class="ti-email"></i>--}}
{{--                                        <h5>Email</h5>--}}
{{--                                        <span>{{$company->user->email}}</span>--}}
{{--                                    </li>--}}

{{--                                    <li>--}}
{{--                                        <i class="ti-mobile"></i>--}}
{{--                                        <h5>Call</h5>--}}
{{--                                        @foreach($company->contact_details as $contacts)--}}
{{--                                        <span>{{$contacts->detail_value}}</span>@if(!$loop->last)|@endif--}}
{{--                                        @endforeach--}}
{{--                                    </li>--}}

                                    <li>
                                        <i class="ti-receipt"></i>
                                        <h5>Registration Number</h5>
                                        <span>{{$company->company_reg_no}}</span>
                                    </li>

                                </ul>
                            </div>
                        </div>

                    </div>
                    <!-- /Company overview -->

                    <!-- Working Days -->
{{--                    <div class="sidebar-widgets">--}}

{{--                        <div class="ur-detail-wrap">--}}
{{--                            <div class="ur-detail-wrap-header">--}}
{{--                                <h4>Working Days</h4>--}}
{{--                            </div>--}}
{{--                            <div class="ur-detail-wrap-body">--}}
{{--                                <ul class="working-days">--}}

{{--                                    <li>Monday<span>9AM - 5PM</span></li>--}}
{{--                                    <li>Tuesday<span>9AM - 5PM</span></li>--}}
{{--                                    <li>Wednesday<span>9AM - 5PM</span></li>--}}
{{--                                    <li class="active">Thursday<span>9AM - 5PM</span></li>--}}
{{--                                    <li>Friday<span>9AM - 5PM</span></li>--}}
{{--                                    <li>Saturday<span>9AM - 5PM</span></li>--}}
{{--                                    <li class="close-day">Sunday<span>Close</span></li>--}}

{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
                    <!-- /Working Days -->
{{--                    {{dd($company->social_medias)}}--}}
                    @if(!$company->social_medias->isEmpty())
                    <!-- Follow Links -->
                    <div class="sidebar-widgets">

                        <div class="ur-detail-wrap">
                            <div class="ur-detail-wrap-header">
                                <h4>Follow Links</h4>
                            </div>
                            <div class="ur-detail-wrap-body">
                                <ul class="follow-links">
                                    @foreach($company->social_medias as $socialMedia)
                                    <li><a href="{{$socialMedia->media_value}}" target="_blank"><i class="ti-{{$socialMedia->media_key}}"></i>{{ucwords($socialMedia->media_key)}}</a></li>
                                    @endforeach
{{--                                    <li><a href="#"><i class="ti-twitter-alt"></i>Twitter</a></li>--}}
{{--                                    <li><a href="#"><i class="ti-linkedin"></i>Linked In</a></li>--}}
{{--                                    <li><a href="#"><i class="ti-instagram"></i>Instagram</a></li>--}}

                                </ul>
                            </div>
                        </div>

                    </div>
                    @endif
                    <!-- /Working Days -->

{{--                    @include('frontend.quick-inquiry')--}}

                </div>
            </div>

        </div>
    </div>
</section>
<!-- company full detail End -->
@endsection
