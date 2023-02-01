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
                    <a href="{{route('signup')}}" class="btn btn-call-to-act">SignUp Today</a>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- ============================ Call To Action End ================================== -->
<!-- ============================ Before Footer ================================== -->
<div class="before-footer">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <div class="jb4-form-fields">
                    <div class="input-group">
                        <form class="post-form" action="#" id="subscribe_form" data-parsley-validate="">
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="subscribe_email"
                                       placeholder="Enter your email address" required>
                            </div>
                            <div class="col-sm-2">
                        <span class="input-group-btn">
                            <button class="btn theme-bg" type="submit"><span
                                    class="fa fa-paper-plane-o"></span></button>
                        </span>
                            </div>
                        </form>
                        <p id="subscribe_msg" style="color:#B94A48"></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 hill">
                <ul class="job stock-facts">
                    {{--                    <li><span>2744</span></br>Jobs Posted</li>--}}
                    <li><span>{{jobCount()}}</span></br>Jobs Posted</li>
                    <li><span>{{candidateCount()}}</span></br>Candidates</li>
                    <li><span>{{companyCount()}}</span></br>Companies</li>
                </ul>
            </div>

        </div>
    </div>
</div>
<footer class="dark-footer skin-dark-footer">
    <div>
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-3">
                    <div class="footer-widget">
                        <img src="{{asset('resources/frontend/assets/img/logo9.png')}}" class="img-footer" alt=""
                             style="width:130px;"/>
                        <div class="footer-add">
                            <p>Mahalaxmisthan, Ringroad, Lalitpur </br> Nepal</p>
                            <p><strong>Email:</strong></br><a href="mailto:info@legendszone.com.np"
                                                              class="__cf_email__">info@legendszone.com.np</a></p>
                            <p><strong>Call:</strong></br><a href="tel:+977-9802088552">+977-9802088552</a> | <a href="tel:+977-1-5171124">+977-1-5171124</a></p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="footer-widget">
                        <h4 class="widget-title">QUICK LINKS</h4>
                        <ul class="footer-menu">
                            <li><a href="#">About Us</a></li>
                            <li><a href="{{route('job.list','nepal')}}">Job Listing</a></li>
                            <li><a href="#">Job Detail</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="{{route('contact')}}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="footer-widget">
                        <h4 class="widget-title">EMPLOYERS</h4>
                        <ul class="footer-menu">
                            <li><a href="{{route('login')}}">Login</a></li>
                            <li><a href="#">Post a Job</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Testimonial</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="footer-widget">
                        <h4 class="widget-title">MY ACCOUNT</h4>
                        <ul class="footer-menu">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Applications</a></li>
                            <li><a href="#">Packages</a></li>
                            <li><a href="#">Resume</a></li>
                            <li><a href="{{route('signup')}}">SignUp Page</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 col-md-6">
                    <p class="mb-0">© {{date('Y')}} Legends Zone. All Rights Reserved</p>
                </div>

                <div class="col-lg-6 col-md-6 text-right">
                    <ul class="footer-bottom-social">
                        <li><a href="https://www.facebook.com/legendszonejobportal" target="_blank"><i
                                    class="ti-facebook"></i></a></li>
                        {{--                        <li><a href="https://twitter.com" target="_blank"><i class="ti-twitter"></i></a></li>--}}
                        <li><a href="https://www.instagram.com/legends_zone_jobs/" target="_blank"><i
                                    class="ti-instagram"></i></a></li>
                        <li><a href="https://www.linkedin.com/in/legends-zone-job-portal-35bb2b1a5/" target="_blank"><i
                                    class="ti-linkedin"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UCsSDOayeS03Yr3tIPoiwbxw" target="_blank"><i
                                    class="ti-youtube"></i></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</footer>
<!-- ============================ Footer End ================================== -->
<!-- Signin Window Code -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="new-logwrap">
                    <form action="{{route('login')}}" method="post" data-parsley-validate="">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-with-icon">
                                <input type="email" name="email" class="form-control" placeholder="Enter Your Email" required>
                                <i class="theme-cl ti-email"></i>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-with-icon">
                                <input type="password" name="password" class="form-control" placeholder="Enter Your Password" required>
                                <i class="theme-cl ti-lock"></i>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-groups">
                            <button type="submit" class="btn btn-primary theme-bg full-width">login</button>
                        </div>
                    </form>
                    <div class="register-account text-center">
                        Don't have an account? <a class="theme-cl" href="{{route('signup')}}">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Signin Window -->

<!--<button class="w3-button w3-teal w3-xlarge w3-right" onclick="openRightMenu()"><i class="spin fa fa-cog" aria-hidden="true"></i></button>-->
{{--<div class="w3-sidebar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="rightMenu">--}}
{{--    <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>--}}
{{--    <ul id="styleOptions" title="switch styling">--}}
{{--        <li>--}}
{{--            <a href="javascript: void(0)" class="cl-box blue" data-theme="colors/blue-style"></a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="javascript: void(0)" class="cl-box red" data-theme="colors/red-style"></a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="javascript: void(0)" class="cl-box purple" data-theme="colors/purple-style"></a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="javascript: void(0)" class="cl-box green" data-theme="colors/green-style"></a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="javascript: void(0)" class="cl-box dark-red" data-theme="colors/dark-red-style"></a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="javascript: void(0)" class="cl-box orange" data-theme="colors/orange-style"></a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="javascript: void(0)" class="cl-box sea-blue" data-theme="colors/sea-blue-style "></a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="javascript: void(0)" class="cl-box pink" data-theme="colors/pink-style"></a>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--</div>--}}

<!-- Scripts
================================================== -->
<script data-cfasync="false"
        src="{{asset('resources/frontend/../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/viewportchecker.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/bootsnav.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/wysihtml5-0.3.0.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/bootstrap-wysihtml5.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/datedropper.min.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/dropzone.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/loader.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/gmap3.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('resources/frontend/assets/plugins/js/jquery.easy-autocomplete.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/frontend/assets/js/altair_admin_common.js')}}"></script>
<script src="{{ asset('resources/frontend/assets/js/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
@yield('page-specific-scripts')
<!-- Custom Js -->
<script src="{{asset('resources/frontend/assets/js/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/frontend/assets/plugins/js/counterup.min.js')}}"></script>
<script src="{{asset('resources/frontend/assets/js/jQuery.style.switcher.js')}}"></script>

<!-- Map -->
<script src="https://maps.google.com/maps/api/js?key="></script>
<script src="{{asset('resources/frontend/assets/js/map_infobox.js')}}"></script>
<script src="{{asset('resources/frontend/assets/js/markerclusterer.js')}}"></script>
<script src="{{asset('resources/frontend/assets/js/map.js')}}"></script>
<script src="{{asset('resources/frontend/assets/js/dashboard-custom.js')}}"></script>
<script src="{{asset('resources/frontend/assets/js/bootbox/bootbox.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#styleOptions').styleSwitcher();
    });
</script>
<script>
    function openRightMenu() {
        document.getElementById("rightMenu").style.display = "block";
    }

    function closeRightMenu() {
        document.getElementById("rightMenu").style.display = "none";
    }
</script>
{{--<script>--}}
{{--    $('#end_date').dateDropper();--}}
{{--</script>--}}
<script>
    $(document).on("click", ".createClone", function (e) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // var cloneInput = $('.clonedInput');
        var cloneClass = $(this).data('clone');
        var cloneField = $(this).data('fieldname');
        var cloneInput = $(cloneClass);
        // var appendTo = $($(this).data('appendto'));
        var appendTo = $('.createClone');
        $.ajax({
            url: '{{route('company.front.cloneFields')}}',
            method: 'post',
            data: {
                '_token': CSRF_TOKEN,
                'div_count': cloneInput.length + 1,
                // 'field_name': cloneInput.data('fieldname')
                'field_name': cloneField
            },
        }).success(function (data) {
            var obj = JSON.parse(data);
            appendTo.before(obj);
        });
    });

    function removedClone(id) {
        // var r = confirm("Are you sure you want to delete?");
        // if (r == true) {
        $(id).remove();
        // }
    }
</script>
<script>
    $(document).on("click", ".createCandidateClone", function (e) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // var cloneInput = $('.clonedInput');
        var cloneClass = $(this).data('clone');
        var cloneField = $(this).data('fieldname');
        var cloneInput = $(cloneClass);
        var appendTo = $('.createCandidateClone');
        $.ajax({
            url: '{{route('candidate.front.cloneFields')}}',
            method: 'post',
            data: {
                '_token': CSRF_TOKEN,
                'div_count': cloneInput.length + 1,
                'field_name': cloneField
            },
        }).success(function (data) {
            var obj = JSON.parse(data);
            appendTo.before(obj);
        });
    });

    function removedCandidateClone(id) {
        // var r = confirm("Are you sure you want to delete?");
        // if (r == true) {
        $(id).remove();
        // }
    }

    $('#subscribe_form').on('submit', function (e) {
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var email = $('#subscribe_email').val();
        if ($(this).parsley().isValid()) {
            $.ajax({
                url: '{{route('newsletter.subscribe')}}',
                method: 'get',
                data: {
                    '_token': CSRF_TOKEN,
                    'email': email
                },
            }).success(function (data) {
                $('#subscribe_msg').empty().append(data);
            });
        }
    })

</script>
<script src="{{asset('resources/frontend/assets/js/app.js')}}"></script>
{!! Toastr::render() !!}
