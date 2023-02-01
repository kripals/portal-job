@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')

    <!-- End Navigation -->
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
                                <h4><i class="ti-home"></i>Company Profile</h4>
                            </div>
                            <div class="clearfix"></div>
                            <!-- Title Header End -->

                            <div class="dashboard-caption-wrap">
                                <div class="deatil-tab-employ tool-tab">
                                    <ul class="nav simple nav-tabs" id="simple-design-tab">
                                        <li class="active"><a href="#about">About</a></li>
                                        <li><a href="#contact">Contact Info</a></li>
{{--                                        <li><a href="#post-job">Job Posted</a></li>--}}
                                    </ul>
                                    <!-- Start All Sec -->
                                    <div class="tab-content">
                                        <!-- Start About Sec -->
                                        <div id="about" class="tab-pane fade in active">
                                            <h3>About {{$company->company_name}}
                                                <a class="btn btn-warning pull-right" href="{{route('company.edit-profile')}}"><i class="fa fa-pencil"></i> Edit Profile</a>
                                            </h3>
                                            <ul class="job-detail-des">
                                                <li><span>Verified Email</span>{{$company->user->email}}</li>
                                                <li><span>Company Type</span><a href="#">{{$company->category->name}}</a></li>
                                                <li><span>Registration Number</span>{{$company->company_reg_no ?? 'N/A'}}</li>
                                                <li><span>Ownership</span>{{$company->ownership ?? 'N/A'}}</li>
                                                <li><span>Status</span><label class="label label-success">{{$company->status_text}}</label>
                                                    <span>Verified</span><label class="label label-success">{{$company->verified_text}}</label></li>
                                                @if($company->description)<li>{!! str_replace('&nbsp;',' ',$company->description) !!}</li>@endif
                                            </ul>
                                        </div>
                                        <!-- End About Sec -->

                                        <!-- Start Address Sec -->
                                        <div id="contact" class="tab-pane fade">
                                            <h3>Contact Info</h3>
                                            <ul class="job-detail-des">
                                                <li><span>Address:</span>{{$company->address ?? 'N/A'}}</li>
                                                <li><span>Telephone:</span>
                                                    @if($company->contact_details)
                                                    <ol>
                                                        @foreach($company->contact_details as $contacts)
                                                            <li>{{ucfirst($contacts->detail_key)}} : {{$contacts->detail_value}}</li>
                                                        @endforeach
                                                    </ol>
                                                    @else
                                                        {{'N/A'}}
                                                    @endif
                                                </li>
                                                <li><span>Website:</span><a href="{{$company->website}}" target="_blank">{{$company->website ?? 'N/A'}}</a></li>
                                                <li><span>Social Accounts:</span>
                                                    @if(!$company->social_medias->isEmpty())
{{--                                                    <ol>--}}
                                                        @foreach($company->social_medias as $socials)
                                                            <a href="{{$socials->media_value}}" target="_blank"><i class="fa fa-{{$socials->media_key}}"></i></a>
{{--                                                            <li>--}}
{{--                                                                {{ucfirst($socials->media_key)}} : {{$socials->media_value}}--}}
{{--                                                            </li>--}}
                                                        @endforeach
{{--                                                    </ol>--}}
                                                    @else
                                                        {{'N/A'}}
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- End Address Sec -->

                                        <!-- Start Job List -->
{{--                                        <div id="post-job" class="tab-pane fade">--}}
{{--                                            <h3>You have {{$company->jobs->count()}} job post</h3>--}}
{{--                                            <div class="row">--}}
{{--                                                @foreach($company->jobs as $job)--}}
{{--                                                <article>--}}
{{--                                                    <div class="mng-company">--}}
{{--                                                        <div class="col-md-2 col-sm-2">--}}
{{--                                                            <div class="mng-company-pic"><img src="assets/img/com-1.jpg" class="img-responsive" alt=""></div>--}}
{{--                                                        </div>--}}

{{--                                                        <div class="col-md-5 col-sm-5">--}}
{{--                                                            <div class="mng-company-name">--}}
{{--                                                                <h4>{{$job->title}} <span class="cmp-tagline">({{$job->job_level->title}})</span></h4><span class="cmp-time">{{$job->category->name}}</span></div>--}}
{{--                                                        </div>--}}

{{--                                                        <div class="col-md-4 col-sm-4">--}}
{{--                                                            <div class="mng-company-location">--}}
{{--                                                                <p><i class="fa fa-map-marker"></i> Street #210, Make New London</p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                        <div class="col-md-1 col-sm-1">--}}
{{--                                                            <div class="mng-company-action"><a href="#"><i class="fa fa-edit"></i></a><a href="#"><i class="fa fa-trash-o"></i></a></div>--}}
{{--                                                        </div>--}}

{{--                                                    </div>--}}
{{--                                                    <span class="tg-themetag tg-featuretag">{{$job->job_service->title}}</span>--}}
{{--                                                </article>--}}
{{--                                                @endforeach--}}
{{--                                            </div>--}}
{{--                                            <div class="row">--}}
{{--                                                <ul class="pagination">--}}
{{--                                                    <li><a href="#">«</a></li>--}}
{{--                                                    <li class="active"><a href="#">1</a></li>--}}
{{--                                                    <li><a href="#">2</a></li>--}}
{{--                                                    <li><a href="#">3</a></li>--}}
{{--                                                    <li><a href="#">4</a></li>--}}
{{--                                                    <li><a href="#"><i class="fa fa-ellipsis-h"></i></a></li>--}}
{{--                                                    <li><a href="#">»</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <!-- End Job List -->
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
