@extends('layouts.frontend.app')
@section('content')
    @include('layouts.frontend.page-specific-header')
    <div class="clearfix"></div>
    <!-- Title Header Start -->
    <section class="inner-header-title"
             style="background-image:url({{ asset('resources/frontend/assets/img/bn2.jpg') }});">
        <div class="container">
            <h1>Create Account</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->
    <!-- Tab Section Start -->
    <section class="tab-sec gray">
        <div class="container">
{{--            <div class="col-lg-8 col-md-8 col-sm-12 col-lg-offset-2 col-md-offset-2">--}}
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="new-logwrap">

                    <ul class="nav modern-tabs nav-tabs theme-bg" id="simple-design-tab">
                        <li class="active"><a href="#candidate">Candidate</a></li>
                        <li><a href="#employer">Employer/Agent</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="candidate" class="tab-pane fade in active">
                            <form action="{{route('candidate.register')}}" method="post" data-parsley-validate="">
                                @csrf
                                <div class="form-group">
                                    <label>First Name</label>
                                    <div class="input-with-icon">
                                        <input type="text" class="form-control" name="first_name"
                                               placeholder="Enter Your First Name" required>
                                        <i class="theme-cl ti-user"></i>
                                    </div>
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <div class="input-with-icon">
                                        <input type="text" class="form-control" name="last_name"
                                               placeholder="Enter Your Last Name" required>
                                        <i class="theme-cl ti-user"></i>
                                    </div>
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Job Category</label>
                                    <div class="input-with-icon">
                                        @if($candidateCategories)
                                            <select name="job_type" class="form-control" id="candidate-category" required>
                                                <option value="">Select Preferred Job Category</option>
                                                @foreach($candidateCategories as $category)
                                                    <option value="{{$category->slug}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <i class="theme-cl ti-user"></i>
                                    </div>
                                    @error('job_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-with-icon">
                                        <input type="email" class="form-control" name="email"
                                               placeholder="Enter Your email" required>
                                        <i class="theme-cl ti-user"></i>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <div class="input-with-icon">
                                        <input type="text" name="contact_number" class="form-control"
                                               placeholder="Contact Number" required>
                                        <i class="theme-cl ti-mobile"></i>
                                    </div>
                                    @error('contact_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-with-icon">
                                            <input type="password" id="candidate_password" name="password"
                                               class="form-control" placeholder="Enter Your Password" required>
                                        <i class="theme-cl ti-lock"></i>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <div class="input-with-icon">
                                        <input type="password" name="password_confirmation" class="form-control"
                                               placeholder="Confirm Your Password"
                                               data-parsley-equalto="#candidate_password" required>
                                        <i class="theme-cl ti-lock"></i>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="register-account text-center">
                                    By hitting the <span class="theme-cl">"Register"</span> button, you agree to the <a
                                            class="theme-cl" href="#">Terms conditions</a> and <a class="theme-cl"
                                                                                                  href="#">Privacy
                                        Policy</a>
                                </div>

                                <div class="form-groups">
                                    <button type="submit" class="btn btn-primary theme-bg full-width">Register</button>
                                </div>
                            </form>
                        </div>

                        <div id="employer" class="tab-pane fade">
                            <form action="{{route('company.register')}}" method="post" data-parsley-validate="">
                                @csrf
                                <div class="form-group">
                                    <label>Organization Name</label>
                                    <div class="input-with-icon">
                                        <input type="text" name="organization_name" class="form-control"
                                               placeholder="Enter Organization Name" required>
                                        <i class="theme-cl ti-home"></i>
                                    </div>
                                    @error('organization_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Select Organization Industry Type</label>
                                    <div class="input-with-icon">
                                        @if($companyCategories)
                                            <select name="organization_type" class="form-control" id="company-category" required>
                                                <option value="">Select Organization Industry Type</option>
                                                @foreach($companyCategories as $category)
                                                    <option value="{{$category->slug}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <i class="theme-cl ti-user"></i>
                                    </div>
                                    @error('organization_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Organization Contact Number</label>
                                    <div class="input-with-icon">
                                        <input type="text" name="contact_number" class="form-control"
                                               placeholder="Contact Number" required>
                                        <i class="theme-cl ti-mobile"></i>
                                    </div>
                                    @error('contact_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Official Email Address</label>
                                    <div class="input-with-icon">
                                        <input type="email" name="email" class="form-control"
                                               placeholder="Official Email Address" required>
                                        <i class="theme-cl ti-email"></i>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Company Registration Number</label>
                                    <div class="input-with-icon">
                                        <input type="number" name="reg_id" class="form-control"
                                               placeholder="Company Registration Number" required>
                                        <i class="theme-cl ti-email"></i>
                                    </div>
                                    @error('pan_vat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-with-icon">
                                        <input type="password" id="company_password" name="password"
                                               class="form-control"
                                               placeholder="Enter Your Password" data-parsley-minlength="8" required>
                                        <i class="theme-cl ti-lock"></i>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <div class="input-with-icon">
                                        <input type="password" name="password_confirmation" class="form-control"
                                               placeholder="Confirm Your Password"
                                               data-parsley-equalto="#company_password" required>
                                        <i class="theme-cl ti-lock"></i>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="register-account text-center">
                                    By clicking the <span class="theme-cl">"Register"</span> button, you agree to the <a
                                            class="theme-cl" href="#">Terms conditions</a> and <a class="theme-cl"
                                                                                                  href="#">Privacy
                                        Policy</a>of Legends Zone.
                                </div>

                                <div class="form-groups">
                                    <button type="submit" class="btn btn-primary theme-bg full-width">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="signup-ad-section">
                    @forelse($ads as $ad)
                        <a href="{{$ad->link}}" target="_blank">
                            <img src="{{asset($ad->image_path)}}" width="370" height="340" alt="">
                        </a>
                    @empty
                        <img src="{{asset('resources/frontend/assets/img/noAds.jpg')}}" width="370" height="340" alt="">
                    @endforelse
{{--                    <a href="https://dtechtrading.com" target="_blank"><img src="{{asset('resources/frontend/assets/img/sign-up-ad-1.jpg')}}" width="370" height="340" alt=""></a>--}}
{{--                    <img src="{{asset('resources/frontend/assets/img/sign-up-ad-2.jpg')}}" width="370" height="340" alt="">--}}
{{--                    <img src="{{asset('resources/frontend/assets/img/sign-up-ad-3.jpg')}}" width="370" height="340" alt="">--}}
                </div>
            </div>
        </div>
    </section>
    <!-- Tab section End -->
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
@endsection
