@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
    <div class="clearfix"></div>

    <!-- Title Header Start -->
    <section class="inner-header-title"
             style="background-image:url({{ asset('resources/frontend/assets/img/banner-10.jpg') }});">
        <div class="container">
            <h1>Contact Us</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- Contact Page Section Start -->
    <section class="contact-page">
        <div class="container">
            <h2>Contact Details</h2>

            <div class="col-md-4 col-sm-4">
                <div class="contact-box">
                    <i class="fa fa-map-marker"></i>
                    <p>Mahalaxmisthan, Ringroad, Lalitpur<br>Nepal</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="contact-box">
                    <i class="fa fa-envelope"></i>
                    <p><a href="mailto:info@legendszone.com.np" class="__cf_email__">info@legendszone.com.np</a><br>
                        {{--                        <a href="#" class="__cf_email__" data-cfemail="ec9f999c9c839e98ac8f8d9e89899e88899f87c28f8381">[email&#160;protected]</a>--}}
                    </p>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="contact-box">
                    <i class="fa fa-phone"></i>
                    <p>Kathmandu<br>
                        <a href="tel:+977-9802088552">+977-9802088552 /</a>
                        <a href="tel:+977-1-5171124">+977-1-5171124</a>
                    </p>
                </div>
            </div>

        </div>
    </section>
    <!-- contact section End -->

    <!-- contact form -->
    <section class="contact-form">
        <div class="container">
            <h2>Drop A Mail</h2>
            <form action="{{route('contact.mail')}}" method="post" data-parsley-validate="">
                @csrf
                <div class="col-md-6 col-sm-6">
                    <input type="text" name="full_name" class="form-control" placeholder="Your Name" required>
                </div>

                <div class="col-md-6 col-sm-6">
                    <input type="email" name="email_address" class="form-control" placeholder="Your Email" required>
                </div>

                <div class="col-md-6 col-sm-6">
                    <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
                </div>

                <div class="col-md-6 col-sm-6">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                </div>

                <div class="col-md-12 col-sm-12">
                    <textarea class="form-control" name="inquiry_message" placeholder="Message"></textarea>
                </div>

                <div class="col-md-12 col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <!-- Contact form End -->
@endsection
