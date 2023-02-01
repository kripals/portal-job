@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
    <div class="clearfix"></div>
    <!-- Title Header Start -->
    <section class="inner-header-title"
             style="background-image:url('{{ asset('resources/frontend/assets/img/banner-10.jpg') }}');">
        <div class="container">
            <h1>Candidate List</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- Browse Resume List Start -->
    <section class="manage-company">
        <div class="container">
            <!-- Company Searrch Filter Start -->
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div class="row extra-mrg">
                        <div class="wrap-search-filter">
                            <form action="{{route('search')}}" method="get">
                                <div class="col-md-5 col-sm-5">
                                    <input type="hidden" name="search_for" value="candidate">
                                    <input type="text" class="form-control" name="search_keyword"
                                           placeholder="Keyword: Name, Tag">
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <select class="form-control" name="search_category" id="j-category">
                                        <option value="">Search By Category</option>
                                        @foreach($searchCategories as $category)
                                            <option value="{{$category->slug}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <button type="submit" class="btn btn-primary full-width">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Company Searrch Filter End -->
                    @if(!$candidates->isEmpty())
                        <div class="row extra-mrg">
                        @foreach($candidates as $candidate)
                            <div class="col-md-4 col-sm-6">
                                <div class="grid-view brows-job-list">
                                    <div class="brows-job-company-img">
                                        <img src="{{asset($candidate->user->thumbnail_path)}}"
                                             class="img-responsive img-circle" alt=""/></div>
                                    <div class="brows-job-position">
                                        <h3>
                                            <a href="{{route('candidate.detail',$candidate->ref_id)}}">{{$candidate->user->full_name}}</a>
                                        </h3>
                                        <a href="{{route('candidate.detail',$candidate->ref_id)}}"><span>{{$candidate->category->name}}</span></a>
                                    </div>
                                    <div class="job-position"><span class="job-num">{{$candidate->job_level->title}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @else
                        <div class="row extra-mrg">
                            <p class="text-center">No Candidates Found. Try Different Keywords.</p>
                        </div>
                    @endif
                    {!! $candidates->appends($_GET)->render() !!}
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
                                    {{--                                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-1.jpg')}}" width="270"--}}
                                    {{--                                         height="275" alt="">--}}
                                    {{--                                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-2.jpg')}}" width="270"--}}
                                    {{--                                         height="275" alt="">--}}
                                    {{--                                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-3.jpg')}}" width="270"--}}
                                    {{--                                         height="275" alt="">--}}
                                    {{--                                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-4.jpg')}}" width="270"--}}
                                    {{--                                         height="275" alt="">--}}
                                    {{--                                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-5.jpg')}}" width="270"--}}
                                    {{--                                         height="275" alt="">--}}
                                    {{--                                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-6.jpg')}}" width="270"--}}
                                    {{--                                         height="275" alt="">--}}
                                </div>
                            </div>
                            <!-- /Search Job -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Browse Resume List End -->
@endsection
