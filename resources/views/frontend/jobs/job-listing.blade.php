@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
    <!-- End Navigation -->
    <div class="clearfix"></div>
    <!-- Title Header Start -->
    <section class="inner-header-page">
        <div class="container">
            <div class="inner-header-desc">
                <h2>Job Listing</h2>
                <p>Choose a job you love and you will never have to work a day in your life.</p>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->
    <section class="advance-search">
        <div class="container">
            <!-- Company Searrch Filter Start -->

            <!-- Company Searrch Filter End -->
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div class="row extra-mrg">
                        <div class="wrap-search-filter">
                            <form action="{{route('search')}}" method="get">
                                <div class="col-md-10 col-sm-10">
                                    <input type="hidden" name="search_for" value="job">
                                    <input type="text" class="form-control" name="search_keyword"
                                           placeholder="Keyword: Name, Tag">
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <button type="submit" class="btn btn-primary full-width">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--Filter -->
                {{--                    <div class="row">--}}
                {{--                        <div class="col-md-12">--}}
                {{--                            <div class="filter-wraps">--}}

                {{--                                <div class="filter-wraps-one">--}}
                {{--                                    <i class="ti-search"></i>--}}
                {{--                                    <ul>--}}
                {{--                                        <li><a href="#">CSS3<i class="ti-close"></i></a></li>--}}
                {{--                                        <li><a href="#">Wordpress<i class="ti-close"></i></a></li>--}}
                {{--                                        <li><a href="#">Photoshop<i class="ti-close"></i></a></li>--}}
                {{--                                    </ul>--}}
                {{--                                </div>--}}
                {{--                                <div class="filter-wraps-two">--}}
                {{--                                    <h5><a href="#">RESET FILTERS</a></h5>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                <!--/.Filter -->
                    <!--Browse Job -->
                    @if(!$jobs->isEmpty())
                        <div class="row extra-mrg">
                        @foreach($jobs as $job)
                            <!-- Single New Job -->
                                <div class="col-md-4">
                                    <div class="jn-employee">
                                        <div class="member-profile-list">
                                            <div class="member-profile-thumb">
                                                <a href="{{route('job.detail',$job->ref_id)}}">
                                                    @if(!empty($job->company_id))
                                                    <img src="{{asset($job->company->image_path)}}"
                                                        class="img-responsive img-circle" alt="">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="member-profile-detail">
                                                <h4>
                                                    <a href="{{route('job.detail',$job->ref_id)}}">{{$job->title}}</a>
                                                </h4>
                                                <span>@if(!empty($job->company_id)){{$job->company->company_name}}@else {{$job->company_name}} @endif</span>
                                                @if($job->vacancy_number)
                                                    <span class="cl-success">{{$job->vacancy_number}} Position</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {!! $jobs->appends($_GET)->render() !!}
                    @else
                        <div class="row extra-mrg">
                            <p class="text-center">No Jobs Found. Try Different Keywords.</p>
                        </div>
                @endif

                <!--/.Browse Job-->
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="full-sidebar-wrap">
                        <div class="show-hide-sidebar hidden-xs hidden-sm">
                            <!-- Search Job -->
                            <div class="sidebar-widgets">
                                <div class="ur-detail-wrap-body">
                                    <div class="job-notice-section">
                                        <div class="main-heading job-notice">
                                            <h2>Top Hiring <span>Companies</span></h2>
                                        </div>
                                        <div id="notice-slider" class="owl-carousel">
                                            @foreach($featuredCompanies as $company)
                                                <div class="top-job-company-img">
                                                    <a href="{{route('company.detail',$company->ref_id)}}">
                                                        <img src="{{asset($company->image_path)}}"
                                                             class="img-responsive" alt="">
                                                    </a>
                                                </div>
                                            @endforeach
                                            {{--                                            <div class="top-job-company-img">--}}
                                            {{--                                                <a href="#">--}}
                                            {{--                                                    <img src="{{asset('resources/frontend/assets/img/com-2.jpg')}}"--}}
                                            {{--                                                    class="img-responsive" alt="">--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="top-job-company-img">--}}
                                            {{--                                                <a href="#">--}}
                                            {{--                                                    <img src="{{asset('resources/frontend/assets/img/com-3.jpg')}}"--}}
                                            {{--                                                    class="img-responsive" alt="">--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="top-job-company-img">--}}
                                            {{--                                                <a href="#">--}}
                                            {{--                                                    <img src="{{asset('resources/frontend/assets/img/com-4.jpg')}}"--}}
                                            {{--                                                    class="img-responsive" alt="">--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="top-job-company-img">--}}
                                            {{--                                                <a href="#">--}}
                                            {{--                                                    <img src="{{asset('resources/frontend/assets/img/com-5.jpg')}}"--}}
                                            {{--                                                    class="img-responsive" alt="">--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </div>--}}
                                        </div>
                                    </div>
                                    @forelse($ads as $ad)
                                        <a href="{{$ad->link}}" target="_blank">
                                            <img src="{{asset($ad->image_path)}}" width="270" height="275" alt="">
                                        </a>
                                    @empty
                                        <img src="{{asset('resources/frontend/assets/img/noAds.jpg')}}" width="270"
                                             height="275" alt="">
                                    @endforelse
                                    {{--                                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-1.jpg')}}" width="270" height="275" alt="">--}}
                                    {{--                                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-2.jpg')}}" width="270" height="275" alt="">--}}
                                    {{--                                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-3.jpg')}}" width="270" height="275" alt="">--}}
                                    {{--                                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-4.jpg')}}" width="270" height="275" alt="">--}}
                                    {{--                                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-5.jpg')}}" width="270" height="275" alt="">--}}
                                    {{--                                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-6.jpg')}}" width="270" height="275" alt="">--}}
                                    {{--                                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-7.jpg')}}" width="270" height="275" alt="">--}}
                                </div>
                            </div>
                            <!-- /Search Job -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Category Section Start -->
    @if(!empty($searchCategories))
        <section class="gray">
            <div class="container">
                <div class="row">
                    <div class="main-heading">
                        <h2>Browse Jobs By <span>Category</span></h2>
                        {{--                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris aliquip.</p>--}}
                    </div>
                </div>
                <div class="row">
                    @foreach($featuredCategories as $category)
                        <div class="col-md-2 col-sm-6">
                            <a href="{{route('category.job',$category->slug)}}">
                                <div class="category-box" data-aos="fade-up">
                                    <div class="category-desc">
                                        <div class="category-icon">
                                            <img src="{{asset($category->thumbnail_path)}}" class="img-responsive"
                                                 alt=""/>
                                        </div>
                                        <div class="category-detail category-desc-text">
                                            <h4>{{$category->name}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
