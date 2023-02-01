@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header)

    <div class="clearfix"></div>

    <!-- Title Header Start -->
    <section class="inner-header-title" style="background-image:url('{{ asset('resources/frontend/assets/img/bn2.jpg') }}');">
        <div class="container">
            <h1>Candidate Search</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <section class="advance-search">
        <div class="container">
            <div class="row">

                <div class="col-md-4 col-sm-12">
                    <div class="full-sidebar-wrap">

                        <a href="javascript:void(0)" onclick="openNav()" class="btn btn-dark full-width mrg-bot-20 hidden-lg hidden-md hidden-xl"><i class="ti-filter mrg-r-5"></i>Filter Search</a>

                        <!-- Job Alert -->
                        <a href="javascript:void(0)" class="btn btn-info full-width mrg-bot-20" data-toggle="modal" data-target="#job-alert">Get Job Alert!</a>
                        <!-- /Job Alert -->

                        <div class="show-hide-sidebar hidden-xs hidden-sm">

                            <!-- Search Job -->
                            <div class="sidebar-widgets">

                                <div class="ur-detail-wrap">
                                    <div class="ur-detail-wrap-header">
                                        <h4>Find Candidates</h4>
                                    </div>
                                    <div class="ur-detail-wrap-body">
                                        <form>
                                            <div class="form-group">
                                                <label>Keyword</label>
                                                <input type="text" class="form-control" placeholder="Keywords or Title">
                                            </div>
                                            <div class="form-group">
                                                <label>Location</label>
                                                <input type="text" class="form-control" placeholder="All Locations">
                                            </div>
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select id="choose-category" class="form-control">
                                                    <option>Choose Category</option>
                                                    <option>Banking Job</option>
                                                    <option>IT / Software</option>
                                                    <option>Medical & Hospital</option>
                                                    <option>Networking</option>
                                                    <option>Automotive</option>
                                                    <option>Business Development</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary full-width">Find Jobs</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <!-- /Search Job -->

                            <!-- Top Designation -->
                            <div class="sidebar-widgets">
                                <div class="ur-detail-wrap">

                                    <div class="ur-detail-wrap-header">
                                        <h4>Top Designation</h4>
                                    </div>
                                    <div class="ur-detail-wrap-body">
                                        <ul class="advance-list">
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="aw">
															<label for="aw"></label>
														</span>
                                                Project Manager
                                                <span class="pull-right">102</span>
                                            </li>
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="dd">
															<label for="dd"></label>
														</span>
                                                Business Executive
                                                <span class="pull-right">78</span>
                                            </li>
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="er">
															<label for="er"></label>
														</span>
                                                Supervisor
                                                <span class="pull-right">12</span>
                                            </li>
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="tr">
															<label for="tr"></label>
														</span>
                                                Team Leader
                                                <span class="pull-right">85</span>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <!-- /Top Designation -->

                            <!-- Experince -->
                            <div class="sidebar-widgets">
                                <div class="ur-detail-wrap">

                                    <div class="ur-detail-wrap-header">
                                        <h4>Experince</h4>
                                    </div>
                                    <div class="ur-detail-wrap-body">
                                        <ul class="advance-list">
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="uy">
															<label for="uy"></label>
														</span>
                                                0 - 1 Year
                                                <span class="pull-right">102</span>
                                            </li>
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="io">
															<label for="io"></label>
														</span>
                                                1 - 2 Year
                                                <span class="pull-right">78</span>
                                            </li>
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="lo">
															<label for="lo"></label>
														</span>
                                                2 - 4 Year
                                                <span class="pull-right">12</span>
                                            </li>
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="kj">
															<label for="kj"></label>
														</span>
                                                4 - 6 Year
                                                <span class="pull-right">85</span>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <!-- /Experince -->

                            <!-- Job Type -->
                            <div class="sidebar-widgets">
                                <div class="ur-detail-wrap">

                                    <div class="ur-detail-wrap-header">
                                        <h4>Job Type</h4>
                                    </div>
                                    <div class="ur-detail-wrap-body">
                                        <ul class="advance-list">
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="1">
															<label for="1"></label>
														</span>
                                                Full Time
                                                <span class="pull-right">102</span>
                                            </li>
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="2">
															<label for="2"></label>
														</span>
                                                Part Time
                                                <span class="pull-right">78</span>
                                            </li>
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="3">
															<label for="3"></label>
														</span>
                                                Internship
                                                <span class="pull-right">12</span>
                                            </li>
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="4">
															<label for="4"></label>
														</span>
                                                Freelancer
                                                <span class="pull-right">85</span>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <!-- /Job Type -->

                            <!-- Location -->
                            <div class="sidebar-widgets">
                                <div class="ur-detail-wrap">

                                    <div class="ur-detail-wrap-header">
                                        <h4>Popular Locations</h4>
                                    </div>
                                    <div class="ur-detail-wrap-body">
                                        <ul class="advance-list">
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="1">
															<label for="1"></label>
														</span>
                                                Mohali
                                                <span class="pull-right">102</span>
                                            </li>

                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="2">
															<label for="2"></label>
														</span>
                                                Chandigarh
                                                <span class="pull-right">78</span>
                                            </li>

                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="3">
															<label for="3"></label>
														</span>
                                                Chennai
                                                <span class="pull-right">12</span>
                                            </li>

                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="4">
															<label for="4"></label>
														</span>
                                                Delhi
                                                <span class="pull-right">85</span>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <!-- /Popular Locations -->

                            <!-- Compensation -->
                            <div class="sidebar-widgets">
                                <div class="ur-detail-wrap">

                                    <div class="ur-detail-wrap-header">
                                        <h4>Compensation</h4>
                                    </div>
                                    <div class="ur-detail-wrap-body">
                                        <ul class="advance-list">
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="1">
															<label for="1"></label>
														</span>
                                                Under $10,000
                                                <span class="pull-right">102</span>
                                            </li>
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="2">
															<label for="2"></label>
														</span>
                                                $10,000 - $15,000
                                                <span class="pull-right">78</span>
                                            </li>
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="3">
															<label for="3"></label>
														</span>
                                                $15,000 - $20,000
                                                <span class="pull-right">12</span>
                                            </li>
                                            <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="4">
															<label for="4"></label>
														</span>
                                                $20,000 - $30,000
                                                <span class="pull-right">85</span>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <!-- /Compensation -->
                        </div>

                    </div>
                </div>

                <div class="col-md-8 col-sm-12">

                    <!--Filter -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="filter-wraps">

                                <div class="filter-wraps-one">
                                    <i class="ti-search"></i>
                                    <ul>
                                        <li><a href="#">CSS3<i class="ti-close"></i></a></li>
                                        <li><a href="#">Wordpress<i class="ti-close"></i></a></li>
                                        <li><a href="#">Photoshop<i class="ti-close"></i></a></li>
                                    </ul>
                                </div>
                                <div class="filter-wraps-two">
                                    <h5><a href="#">RESET FILTERS</a></h5>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--/.Filter -->

                    <!--Browse Candidates -->
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Single Candidate List -->
                            <div class="candidate-list-layout">
                                <div class="cll-wrap">
                                    <div class="cll-thumb">
                                        <a href="#"><img src="assets/img/can-1.png" class="img-responsive img-circle" alt="" /></a>
                                    </div>
                                    <div class="cll-caption">
                                        <h4><a href="#">Travis A. Cook</a><span><i class="ti-briefcase"></i>SEO Expert</span></h4>
                                        <ul>
                                            <li><i class="ti-location-pin cl-danger"></i>801 Harper Street, India</li>
                                            <li><i class="ti-time cl-success"></i>Last Activity 04 min ago</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="cll-right">
                                    <a href="#" class="btn theme-btn btn-shortlist"><i class="ti-plus"></i>Shortlist</a>
                                </div>
                            </div>

                            <!-- Single Candidate List -->
                            <div class="candidate-list-layout">
                                <div class="cll-wrap">
                                    <div class="cll-thumb">
                                        <a href="#"><img src="assets/img/can-2.png" class="img-responsive img-circle" alt="" /></a>
                                    </div>
                                    <div class="cll-caption">
                                        <h4><a href="#">Shaurya Preet</a><span><i class="ti-briefcase"></i>Graphic Designer</span></h4>
                                        <ul>
                                            <li><i class="ti-location-pin cl-danger"></i>208 Hampton Meadows, Newzeland</li>
                                            <li><i class="ti-time cl-success"></i>Last Activity 10 days ago</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="cll-right">
                                    <a href="#" class="btn theme-btn btn-shortlist"><i class="ti-plus"></i>Shortlist</a>
                                </div>
                            </div>

                            <!-- Single Candidate List -->
                            <div class="candidate-list-layout">
                                <div class="cll-wrap">
                                    <div class="cll-thumb">
                                        <a href="#"><img src="assets/img/can-3.png" class="img-responsive img-circle" alt="" /></a>
                                    </div>
                                    <div class="cll-caption">
                                        <h4><a href="#">Robert C. Kelly</a><span><i class="ti-briefcase"></i>iPhone Developer</span></h4>
                                        <ul>
                                            <li><i class="ti-location-pin cl-danger"></i>2283 Poco Mas Drive, Canada</li>
                                            <li><i class="ti-time cl-success"></i>Last Activity 07 min ago</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="cll-right">
                                    <a href="#" class="btn theme-btn btn-shortlist"><i class="ti-plus"></i>Shortlist</a>
                                </div>
                            </div>

                            <!-- Single Candidate List -->
                            <div class="candidate-list-layout">
                                <div class="cll-wrap">
                                    <div class="cll-thumb">
                                        <a href="#"><img src="assets/img/can-4.png" class="img-responsive img-circle" alt="" /></a>
                                    </div>
                                    <div class="cll-caption">
                                        <h4><a href="#">Jazmin D. Starks</a><span><i class="ti-briefcase"></i>Magento Expert</span></h4>
                                        <ul>
                                            <li><i class="ti-location-pin cl-danger"></i>2860 Park Boulevard, USA</li>
                                            <li><i class="ti-time cl-success"></i>Last Activity 5 days ago</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="cll-right">
                                    <a href="#" class="btn theme-btn btn-shortlist"><i class="ti-plus"></i>Shortlist</a>
                                </div>
                            </div>

                            <!-- Single Candidate List -->
                            <div class="candidate-list-layout">
                                <div class="cll-wrap">
                                    <div class="cll-thumb">
                                        <a href="#"><img src="assets/img/can-5.jpg" class="img-responsive img-circle" alt="" /></a>
                                    </div>
                                    <div class="cll-caption">
                                        <h4><a href="#">Shirley C. Maggi</a><span><i class="ti-briefcase"></i>Wordpress Expert</span></h4>
                                        <ul>
                                            <li><i class="ti-location-pin cl-danger"></i>1081 Wayback Lane, London</li>
                                            <li><i class="ti-time cl-success"></i>Last Activity 2 days ago</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="cll-right">
                                    <a href="#" class="btn theme-btn btn-shortlist"><i class="ti-plus"></i>Shortlist</a>
                                </div>
                            </div>

                            <!-- Single Candidate List -->
                            <div class="candidate-list-layout">
                                <div class="cll-wrap">
                                    <div class="cll-thumb">
                                        <a href="#"><img src="assets/img/can-1.png" class="img-responsive img-circle" alt="" /></a>
                                    </div>
                                    <div class="cll-caption">
                                        <h4><a href="#">Stewart C. Thomas</a><span><i class="ti-briefcase"></i>Stack Developer</span></h4>
                                        <ul>
                                            <li><i class="ti-location-pin cl-danger"></i>4167 Ashwood Drive, UK</li>
                                            <li><i class="ti-time cl-success"></i>Last Activity 02 min ago</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="cll-right">
                                    <a href="#" class="btn theme-btn btn-shortlist"><i class="ti-plus"></i>Shortlist</a>
                                </div>
                            </div>

                            <!-- Single Candidate List -->
                            <div class="candidate-list-layout">
                                <div class="cll-wrap">
                                    <div class="cll-thumb">
                                        <a href="#"><img src="assets/img/can-2.png" class="img-responsive img-circle" alt="" /></a>
                                    </div>
                                    <div class="cll-caption">
                                        <h4><a href="#">Michael S. Brown</a><span><i class="ti-briefcase"></i>PHP Developer</span></h4>
                                        <ul>
                                            <li><i class="ti-location-pin cl-danger"></i>4012 Still Street, USA</li>
                                            <li><i class="ti-time cl-success"></i>Last Activity 2 days ago</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="cll-right">
                                    <a href="#" class="btn theme-btn btn-shortlist"><i class="ti-plus"></i>Shortlist</a>
                                </div>
                            </div>

                            <!-- Single Candidate List -->
                            <div class="candidate-list-layout">
                                <div class="cll-wrap">
                                    <div class="cll-thumb">
                                        <a href="#"><img src="assets/img/can-3.png" class="img-responsive img-circle" alt="" /></a>
                                    </div>
                                    <div class="cll-caption">
                                        <h4><a href="#">Angela A. Vizcaino</a><span><i class="ti-briefcase"></i>UX Designer</span></h4>
                                        <ul>
                                            <li><i class="ti-location-pin cl-danger"></i>3444 North Bend River, Canada</li>
                                            <li><i class="ti-time cl-success"></i>Last Activity 07 min ago</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="cll-right">
                                    <a href="#" class="btn theme-btn btn-shortlist"><i class="ti-plus"></i>Shortlist</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--/.Browse Job-->


                    <div class="row mrg-0">
                        <ul class="pagination">
                            <li><a href="#"><i class="ti-arrow-left"></i></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#"><i class="fa fa-ellipsis-h"></i></a></li>
                            <li><a href="#"><i class="ti-arrow-right"></i></a></li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </section>

    @endsection