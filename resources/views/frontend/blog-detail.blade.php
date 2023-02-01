@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
<div class="clearfix"></div>

<!-- Title Header Start -->
<section class="inner-header-title" style="background-image:url(http://via.placeholder.com/1920x850);">
    <div class="container">
        <h1>Blog Detail</h1>
    </div>
</section>
<div class="clearfix"></div>
<!-- Title Header End -->

<!-- Blog Detail -->
<section class="section">
    <div class="container">
        <div class="row no-mrg">
            <div class="col-md-8">
                <article class="blog-news">
                    <div class="full-blog">

                        <figure class="img-holder">
                            <a href="{{route('blog-detail')}}"><img src="{{asset('resources/frontend/assets/img/blog/1.jpg')}}" class="img-responsive" alt="News"></a>
                            <div class="blog-post-date">
                                Mar 12, 2017
                            </div>
                        </figure>

                        <div class="full blog-content">
                            <div class="post-meta">
                                <span class="author"><i class="ti-user"></i><a href="#" title="Posts by admin">Admin</a></span>
                                <span class="author"><i class="ti-calendar"></i>March 6, 2019</span>
                                <span class="author"><i class="ti-comment-alt"></i>0 Comments</span>
                            </div>
                            <h2 class="blog-sing-title">Helping Kids Grow Up Stronger</h2>
                            <div class="blog-text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
                                <blockquote class="margin-top-20 margin-bottom-20">
                                    Mauris aliquet ultricies ante, non faucibus ante gravida sed. Sed ultrices pellentesque purus, vulputate volutpat ipsum hendrerit sed neque sed sapien rutrum.
                                </blockquote>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.</p>
                                <div class="post-tags">
                                    <strong>Tags:</strong>
                                    <a href="#">Groups</a>
                                    <a href="#">Parkings</a>
                                    <a href="#">Spa</a>
                                    <a href="#">Team</a>
                                    <a href="#">Food</a>
                                </div>
                            </div>
                            <div class="row no-mrg">
                                <div class="blog-footer-social">
                                    <span>Share <i class="fa fa-share-alt"></i></span>
                                    <ul class="list-inline social">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </article>

                <!-- Comment -->
                <div class="row no-mrg">
                    <div class="comments">
                        <h3 class="mrg-top-40">Comments <span class="comments-amount">(5)</span></h3>

                        <ul>
                            <li>
                                <div class="avatar"><img src="assets/img/can-1.png" alt=""></div>
                                <div class="comment-content"><div class="arrow-comment"></div>
                                    <div class="comment-by">Kathy Brown<span class="date">12th, June 2019</span>
                                        <a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
                                    </div>
                                    <p>Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus</p>
                                </div>

                                <ul>
                                    <li>
                                        <div class="avatar"><img src="assets/img/can-1.png" alt=""></div>
                                        <div class="comment-content"><div class="arrow-comment"></div>
                                            <div class="comment-by">Tom Smith<span class="date">12th, June 2019</span>
                                                <a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
                                            </div>
                                            <p>Rrhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="avatar"><img src="assets/img/can-1.png" alt=""></div>
                                        <div class="comment-content"><div class="arrow-comment"></div>
                                            <div class="comment-by">Kathy Brown<span class="date">12th, June 2019</span>
                                                <a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
                                            </div>
                                            <p>Nam posuere tristique sem, eu ultricies tortor.</p>
                                        </div>

                                        <ul>
                                            <li>
                                                <div class="avatar"><img src="assets/img/can-1.png" alt=""></div>
                                                <div class="comment-content"><div class="arrow-comment"></div>
                                                    <div class="comment-by">John Doe<span class="date">12th, June 2019</span>
                                                        <a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
                                                    </div>
                                                    <p>Great template!</p>
                                                </div>
                                            </li>
                                        </ul>

                                    </li>
                                </ul>

                            </li>

                            <li>
                                <div class="avatar"><img src="assets/img/can-1.png" alt=""> </div>
                                <div class="comment-content"><div class="arrow-comment"></div>
                                    <div class="comment-by">John Doe<span class="date">15th, May 2015</span>
                                        <a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
                                    </div>
                                    <p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.</p>
                                </div>

                            </li>
                        </ul>

                    </div>
                </div>

                <!-- Comment Form -->
                <div class="row no-mrg">
                    <div class="comments-form">
                        <div class="section-title2">
                            <h3 class="mrg-top-40">Drop Your Comment</h3>
                        </div>
                        <form>
                            <div class="col-md-6 col-sm-6">
                                <input type="text" class="form-control" placeholder="Your Name">
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <input type="email" class="form-control" placeholder="Your Email">
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <textarea class="form-control" placeholder="Comment"></textarea>
                            </div>
                            <button class="thm-btn btn-comment" type="submit">submit now</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Start Sidebar -->
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

                </div>
            </div>
            <!-- End Start Sidebar -->
        </div>
    </div>
</section>
<!-- Blog Detail End -->
@endsection