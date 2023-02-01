@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.index-header')

    <div class="clearfix"></div>

    <div class="banner trans" style="background-image:url(resources/frontend/assets/img/slider-1.jpg);"
         data-overlay="6">
        <div class="container">
            <div class="banner-caption">
                <div class="col-md-12 col-sm-12 banner-text">
                    <h1>Browse Jobs & Candidates</h1>
                    <div class="full-search-2 eclip-search italian-search hero-search-radius">
                        <div class="hero-search-content">
                            <form action="{{route('search')}}" method="get" data-parsley-validate="">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 small-padd b-r">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <select id="choose-city" name="search_for" class="form-control"
                                                        required>
                                                    <option value="">Search For</option>
                                                    <option value="job">Job</option>
                                                    <option value="candidate">Candidate</option>
                                                </select>
                                                <i class="ti-layers"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 small-padd">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <select id="choose-category" name="search_category" class="form-control">
                                                    <option value="">Search All Categories</option>
                                                    @foreach($searchCategories as $category)
                                                        <option value="{{$category->slug}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                <i class="ti-layers"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 small-padd">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="text" name="search_keyword" class="form-control b-r"
                                                       placeholder="Search Keywords">
                                                <i class="ti-search"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 small-padd">
                                        <div class="form-group">
                                            <button href="#" type="submit" class="btn btn-primary search-btn">Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-contact-block">
                <div class="col-md-12">
                    <div class="home-contact-box">
                        <p>For any queries call or email us at</p>
                        <ul class="quick-contact-details">
                            <li><i class="fa fa-phone"></i><a href="tel:+977-9802088552"><strong>+977-9802088552</strong></a></li>
                            <li><i class="fa fa-mobile"></i><a href="tel:+977-1-5171124"><strong>+977-1-5171124</strong></a></li>
                            <li><i class="fa fa-envelope"></i><a href="mailto:info@legendszone.com.np"><strong>info@legendszone.com.np</strong></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @foreach($categories as $category)
                <div class="col-md-2 col-sm-3">
                    <div class="category-box" data-aos="fade-up">
                        <div class="category-desc">
                            <div class="category-icon">
                                <a href="{{route('category.job',$category->slug)}}">
                                    <img src="{{asset($category->thumbnail_path)}}" class="img-responsive" alt=""/>
                                </a>
                                {{--                                        <i class="icon-bargraph abs-icon" aria-hidden="true"></i>--}}
                            </div>
                            <div class="category-detail category-desc-text">
                                <h4><a href="{{route('category.job',$category->slug)}}">{{$category->name}}</a>
                                </h4>
                                <p>{!! $category->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <div class="clearfix"></div>

    <!-- Candidate Section Start -->
    @if(!$candidates->isEmpty())
        <section class="pricing">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-heading">
                            <p>Best Candidate of The Year</p>
                            <h2>Hire Expert <span>Candidate</span></h2>
                        </div>
                    </div>
                </div>
                <!--/row-->
                <div class="row">
                    @foreach($candidates as $candidate)
                        <div class="col-md-3 col-sm-6">
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

                <!-- Single Freelancer -->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="text-center job-list">
                            <a href="{{route('candidate.list')}}" class="btn btn-primary">Load More</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    @endif
    <!-- End Candidate Section -->

    <!-- Job Section Start -->
    @if(!$featuredJobs->isEmpty())
        <section class="gray">
            <div class="container">
                <div class="row">
                    <div class="main-heading">
{{--                        <p>Most View Jobs</p>--}}
                        <h2>Featured <span>Jobs</span></h2></div>
                </div>
                <!--/.row-->

                <div class="row">
                    @foreach($featuredJobs as $job)
                        <div class="col-md-3">
                            <div class="jn-employee">
                                <div class="member-profile-list">
                                    <div class="member-profile-thumb">
                                        <a href="{{route('job.detail',$job->ref_id)}}"><img
                                                src="{{asset($job->company->image_path)}}"
                                                class="img-responsive img-circle" alt=""></a>
                                    </div>
                                    <div class="member-profile-detail">
                                        <h4>
                                            <a href="{{route('job.detail',$job->ref_id)}}">{{$job->title}}</a>
                                        </h4>
                                        <span>{{$job->company->company_name}}</span>
                                        @if($job->vacancy_number)
                                            <span class="cl-success">{{$job->vacancy_number}} Position</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="text-center">
                            <a href="{{route('job.list',['nepal','featured'])}}" class="btn btn-primary">Load More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- End Job Section -->
    <div class="clearfix"></div>
    <!-- Job Section Start -->
    @if(!$hotJobs->isEmpty())
        <section class="pricing">
            <div class="container">
                <div class="row">
                    <div class="main-heading">
{{--                        <p>Most View Jobs</p>--}}
                        <h2>Hot <span>Jobs</span></h2></div>
                </div>
                <!--/.row-->

                <div class="row">
                    @foreach($hotJobs as $job)
                        <div class="col-md-3">
                            <div class="jn-employee">
                                <div class="member-profile-list">
                                    <div class="member-profile-thumb">
                                        <a href="{{route('job.detail',$job->ref_id)}}"><img
                                                src="{{asset($job->company->image_path)}}"
                                                class="img-responsive img-circle" alt=""></a>
                                    </div>
                                    <div class="member-profile-detail">
                                        <h4>
                                            <a href="{{route('job.detail',$job->ref_id)}}">{{$job->title}}</a>
                                        </h4>
                                        <span>{{$job->company->company_name}}</span>
                                        @if($job->vacancy_number)
                                            <span class="cl-success">{{$job->vacancy_number}} Position</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="text-center">
                            <a href="{{route('job.list',['nepal','hot-jobs'])}}" class="btn btn-primary">Load More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- End Job Section -->
    <div class="clearfix"></div>
    <!-- Job Section Start -->
    @if(!$newspaperJobs->isEmpty())
        <section class="how-it-works">
            <div class="container">
                <div class="row">
                    <div class="main-heading">
                        <p>General</p>
                        <h2>Government/Newspaper <span>Jobs</span></h2></div>
                </div>
                <!--/.row-->

                <div class="row">
                    @foreach($newspaperJobs as $job)
                        <div class="col-md-3 col-sm-6">
                            <div class="grid-view brows-job-list">
                                <div class="brows-job-position">
                                    <h3>
                                        <a href="{{route('job.detail',$job->ref_id)}}">{{$job->title}}</a>
                                    </h3>
                                    <a href="{{route('job.detail',$job->ref_id)}}"><span>{{$job->company_name}}</span></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="text-center job-list">
                            <a href="{{route('job.list',['nepal','government-newspaper-job'])}}" class="btn btn-primary">Load More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- End Job Section -->
    <div class="clearfix"></div>
    <!-- Category Section Start -->
{{--    @if(!empty($categories))--}}
{{--        <section class="gray">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="main-heading">--}}
{{--                        <h2>Browse Jobs By <span>Category</span></h2>--}}
{{--                        --}}{{--                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris aliquip.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    @foreach($categories as $category)--}}
{{--                        <div class="col-md-2 col-sm-3">--}}
{{--                            <div class="category-box" data-aos="fade-up">--}}
{{--                                <div class="category-desc">--}}
{{--                                    <div class="category-icon">--}}
{{--                                        <img src="{{asset($category->thumbnail_path)}}" class="img-responsive" alt=""/>--}}
{{--                                        --}}{{--                                        <i class="icon-bargraph abs-icon" aria-hidden="true"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="category-detail category-desc-text">--}}
{{--                                        <h4><a href="{{route('category.job',$category->slug)}}">{{$category->name}}</a>--}}
{{--                                        </h4>--}}
{{--                                        <p>{!! $category->description !!}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    @endif--}}
    <!-- End Category Section -->
    <div class="clearfix"></div>

    <!-- Testimonial Section Start -->
    @if(!$testimonials->isEmpty())
        <section class="testimonial" id="testimonial">
            <div class="container">
                <div class="row">
                    <div class="main-heading">
                        <p>What Say Our Client</p>
                        <h2>Our Success <span>Stories</span></h2></div>
                </div>
                <div class="row">
                    <div id="client-testimonial-slider" class="owl-carousel">
                        @foreach($testimonials as $testimonial )
                            <div class="client-testimonial">
                                <div class="pic"><img src="{{asset($testimonial->image_path)}}" alt=""></div>
                                <p class="client-description">{!! $testimonial->description !!}</p>
                                <h3 class="client-testimonial-title">{{$testimonial->name}}</h3>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
@endsection



