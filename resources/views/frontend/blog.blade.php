@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- All blog List Start -->
    <section class="section">
        <div class="container">
            <div class="row .no-mrg">
                <!-- Start Blogs -->
                <div class="col-md-8">

                    <article class="blog-news">
                        <div class="short-blog">
                            <figure class="img-holder">
                                <a href="{{route('blog-detail')}}"><img src="{{asset('resources/frontend/assets/img/blog/1.jpg')}}" class="img-responsive" alt="News"></a>
                                <div class="blog-post-date">
                                    Mar 12, 2017
                                </div>
                            </figure>
                            <div class="blog-content">
                                <div class="post-meta">By: <span class="author">Daniel Dax</span> | 10 Comments </div>
                                <a href="{{route('blog-detail')}}"><h2>Helping Kids Grow Up Stronger</h2></a>
                                <div class="blog-text">
                                    <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                                    <div class="post-meta">Filed Under: <span class="category"><a href="#">Technology</a></span></div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="blog-news">
                        <div class="short-blog">
                            <figure class="img-holder">
                                <a href="{{route('blog-detail')}}"><img src="assets/img/blog/2.jpg" class="img-responsive" alt="News"></a>
                                <div class="blog-post-date">
                                    Mar 12, 2017
                                </div>
                            </figure>
                            <div class="blog-content">
                                <div class="post-meta">By: <span class="author">Daniel Dax</span> | 10 Comments </div>
                                <a href="{{route('blog-detail')}}"><h2>Helping Kids Grow Up Stronger</h2></a>
                                <div class="blog-text">
                                    <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                                    <div class="post-meta">Filed Under: <span class="category"><a href="#">Technology</a></span></div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="blog-news">
                        <div class="short-blog">
                            <figure class="img-holder">
                                <a href="{{route('blog-detail')}}"><img src="assets/img/blog/3.jpg" class="img-responsive" alt="News"></a>
                                <div class="blog-post-date">
                                    Mar 12, 2017
                                </div>
                            </figure>
                            <div class="blog-content">
                                <div class="post-meta">By: <span class="author">Daniel Dax</span> | 10 Comments </div>
                                <a href="{{route('blog-detail')}}"><h2>Helping Kids Grow Up Stronger</h2></a>
                                <div class="blog-text">
                                    <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                                    <div class="post-meta">Filed Under: <span class="category"><a href="#">Technology</a></span></div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <!-- End Blogs -->

                <!-- Sidebar Start -->
                <div class="col-md-4">
                    <div class="blog-sidebar">

                        <form action="#">
                            <div class="search-form">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search…">
                                    <span class="input-group-btn">
												<button type="button" class="btn btn-default">Go</button>
											</span>
                                </div>
                            </div>
                        </form>

                        <div class="sidebar-widget">
                            <h4>Popular Category</h4>
                            <ul class="sidebar-list">
                                <li><a href="#">About Donation <span>(8)</span></a></li>
                                <li><a href="#">About Donation <span>(8)</span></a></li>
                                <li><a href="#">About Donation <span>(8)</span></a></li>
                                <li><a href="#">About Donation <span>(8)</span></a></li>
                                <li><a href="#">About Donation <span>(8)</span></a></li>
                                <li><a href="#">About Donation <span>(8)</span></a></li>
                            </ul>
                        </div>

                        <div class="sidebar-widget">
                            <h4>Popular Category</h4>
                            <div class="blog-item">
                                <div class="post-thumb"><a href="{{route('blog-detail')}}"><img src="assets/img/blog/1.jpg" class="img-responsive" alt=""></a></div>
                                <div class="blog-detail">
                                    <a href="#"><h4>Enim Ad Minim Veniam, Quis Nostrud Exercitation</h4></a>
                                    <div class="post-info">Aug 10 2016</div>
                                </div>
                            </div>
                            <div class="blog-item">
                                <div class="post-thumb"><a href="{{route('blog-detail')}}"><img src="assets/img/blog/2.jpg" class="img-responsive" alt=""></a></div>
                                <div class="blog-detail">
                                    <a href="#"><h4>Enim Ad Minim Veniam, Quis Nostrud Exercitation</h4></a>
                                    <div class="post-info">Aug 10 2016</div>
                                </div>
                            </div><div class="blog-item">
                                <div class="post-thumb"><a href="{{route('blog-detail')}}"><img src="assets/img/blog/3.jpg" class="img-responsive" alt=""></a></div>
                                <div class="blog-detail">
                                    <a href="#"><h4>Enim Ad Minim Veniam, Quis Nostrud Exercitation</h4></a>
                                    <div class="post-info">Aug 10 2016</div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h4>Recent Category</h4>
                            <div class="blog-item">
                                <div class="post-thumb"><a href="{{route('blog-detail')}}"><img src="assets/img/blog/1.jpg" class="img-responsive" alt=""></a></div>
                                <div class="blog-detail">
                                    <a href="#"><h4>Enim Ad Minim Veniam, Quis Nostrud Exercitation</h4></a>
                                    <div class="post-info">Aug 10 2016</div>
                                </div>
                            </div>
                            <div class="blog-item">
                                <div class="post-thumb"><a href="{{route('blog-detail')}}"><img src="assets/img/blog/2.jpg" class="img-responsive" alt=""></a></div>
                                <div class="blog-detail">
                                    <a href="#><h4>Enim Ad Minim Veniam, Quis Nostrud Exercitation</h4></a>
                                <div class="post-info">Aug 10 2016</div>
                            </div>
                        </div><div class="blog-item">
                            <div class="post-thumb"><a href="{{route('blog-detail')}}"><img src="assets/img/blog/3.jpg" class="img-responsive" alt=""></a></div>
                            <div class="blog-detail">
                                <a href="#"><h4>Enim Ad Minim Veniam, Quis Nostrud Exercitation</h4></a>
                                <div class="post-info">Aug 10 2016</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Sidebar Start -->
        </div>
        <div class="row">
            <ul class="pagination">
                <li><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#"><i class="fa fa-ellipsis-h"></i></a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>
    </section>
    <!-- All Blog List End -->
    @endsection