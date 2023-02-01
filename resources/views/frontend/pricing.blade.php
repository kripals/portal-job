@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
<div class="clearfix"></div>

<!-- Title Header Start -->
<section class="inner-header-title" style="background-image:url(assets/img/banner-10.jpg);">
    <div class="container">
        <h1>Our Package</h1>
    </div>
</section>
<div class="clearfix"></div>
<!-- Title Header End -->

<!-- pricing Section Start -->
<section class="pricing">
    <div class="container">

        <div class="col-md-4 col-sm-4">
            <div class="pr-table">
                <div class="pr-header">
                    <div class="pr-plan">
                        <h4>Basic</h4>
                    </div>
                    <div class="pr-price">
                        <h3><sup>$</sup>29<sub>/Mon</sub></h3>
                    </div>
                </div>
                <div class="pr-features">
                    <ul>
                        <li>1 GB Ram</li>
                        <li>2 GB Memory</li>
                        <li>1 Core Processor</li>
                        <li>32 GB SSD Disk</li>
                        <li>1 TB Transfer</li>
                    </ul>
                </div>
                <div class="pr-buy-button">
                    <a href="#" class="pr-btn" title="Price Button">Get Started</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="pr-table">
                <div class="pr-header active">
                    <div class="pr-plan">
                        <h4>Premium</h4>
                    </div>
                    <div class="pr-price">
                        <h3><sup>$</sup>40<sub>/Mon</sub></h3>
                    </div>
                </div>
                <div class="pr-features">
                    <ul>
                        <li>1 GB Ram</li>
                        <li>2 GB Memory</li>
                        <li>1 Core Processor</li>
                        <li>32 GB SSD Disk</li>
                        <li>1 TB Transfer</li>
                    </ul>
                </div>
                <div class="pr-buy-button">
                    <a href="#" class="pr-btn active" title="Price Button">Get Started</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="pr-table">
                <div class="pr-header">
                    <div class="pr-plan">
                        <h4>Ultimate</h4>
                    </div>
                    <div class="pr-price">
                        <h3><sup>$</sup>120<sub>/Mon</sub></h3>
                    </div>
                </div>
                <div class="pr-features">
                    <ul>
                        <li>1 GB Ram</li>
                        <li>2 GB Memory</li>
                        <li>1 Core Processor</li>
                        <li>32 GB SSD Disk</li>
                        <li>1 TB Transfer</li>
                    </ul>
                </div>
                <div class="pr-buy-button">
                    <a href="#" class="pr-btn" title="Price Button">Get Started</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="pr-table">
                <div class="pr-header">
                    <div class="pr-plan">
                        <h4>Pro Basic</h4>
                    </div>
                    <div class="pr-price">
                        <h3><sup>$</sup>150<sub>/Mon</sub></h3>
                    </div>
                </div>
                <div class="pr-features">
                    <ul>
                        <li>1 GB Ram</li>
                        <li>2 GB Memory</li>
                        <li>1 Core Processor</li>
                        <li>32 GB SSD Disk</li>
                        <li>1 TB Transfer</li>
                    </ul>
                </div>
                <div class="pr-buy-button">
                    <a href="#" class="pr-btn" title="Price Button">Get Started</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="pr-table">
                <div class="pr-header active">
                    <div class="pr-plan">
                        <h4>Pro Ultimate</h4>
                    </div>
                    <div class="pr-price">
                        <h3><sup>$</sup>180<sub>/Mon</sub></h3>
                    </div>
                </div>
                <div class="pr-features">
                    <ul>
                        <li>1 GB Ram</li>
                        <li>2 GB Memory</li>
                        <li>1 Core Processor</li>
                        <li>32 GB SSD Disk</li>
                        <li>1 TB Transfer</li>
                    </ul>
                </div>
                <div class="pr-buy-button">
                    <a href="#" class="pr-btn active" title="Price Button">Get Started</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="pr-table">
                <div class="pr-header">
                    <div class="pr-plan">
                        <h4>Pro Ultimate</h4>
                    </div>
                    <div class="pr-price">
                        <h3><sup>$</sup>199<sub>/Mon</sub></h3>
                    </div>
                </div>
                <div class="pr-features">
                    <ul>
                        <li>1 GB Ram</li>
                        <li>2 GB Memory</li>
                        <li>1 Core Processor</li>
                        <li>32 GB SSD Disk</li>
                        <li>1 TB Transfer</li>
                    </ul>
                </div>
                <div class="pr-buy-button">
                    <a href="#" class="pr-btn" title="Price Button">Get Started</a>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- End Pricing Section -->

<!-- ============================ Call To Action ================================== -->
<section class="theme-bg call-to-act-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="call-to-act">
                    <div class="call-to-act-head">
                        <h3>Want to Become a Success Employers?</h3>
                        <span>We'll help you to grow your career and growth.</span>
                    </div>
                    <a href="#" class="btn btn-call-to-act">SignUp Today</a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection