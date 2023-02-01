<!-- Sidebar Wrap -->
<div class="col-lg-3 col-md-4">
    <div class="side-dashboard">

        <div class="dashboard-avatar">

            <div class="dashboard-avatar-thumb">
                <img src="{{asset($company->image_path)}}" class="img-avater" alt="" />
            </div>

            <div class="dashboard-avatar-text">
                <h4>{{$company->company_name}}</h4>
            </div>

        </div>

        <div class="dashboard-menu">
            <ul>
                <li class="{{ request()->is('company/dashboard') ? 'active' : '' }}">
                    <a href="{{route('company.dashboard')}}"><i class="ti-dashboard"></i>Dashboard</a>
                </li>
                <li class="{{ request()->is('company/job/create-job') ? 'active' : '' }}">
                    <a href="{{route('company.job.create')}}"><i class="ti-ruler-pencil"></i>Post New Job</a>
                </li>
                <li class="{{ request()->is('company/job/all-jobs') ? 'active' : '' }}">
                    <a href="{{route('company.job.all-jobs')}}"><i class="ti-briefcase"></i>All Jobs</a>
                </li>
{{--                <li class="{{ request()->is('company/job/applications') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('company.job.applications')}}"><i class="ti-user"></i>Applications</a>--}}
{{--                </li>--}}
{{--                <li class="{{ request()->is('company/package') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('company.package.list')}}"><i class="ti-wallet"></i>Choose Packages</a>--}}
{{--                </li>--}}
{{--                <li class="{{ request()->is('company/history') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('company.purchase.list')}}"><i class="ti-wallet"></i>Purchase history</a>--}}
{{--                </li>--}}
{{--                <li><a href="#"><i class="ti-flag-alt-2"></i>Viewed Resume</a></li>--}}
                <li class="{{ request()->is('company/profile') ? 'active' : '' }}">
                    <a href="{{route('company.profile')}}"><i class="ti-user"></i>View Profile</a>
                </li>
{{--                <li class="{{ request()->is('company/profile/edit-profile') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('company.edit-profile')}}"><i class="ti-id-badge"></i>Edit Profile</a>--}}
{{--                </li>--}}
                <li class="{{ request()->is('company/account-settings') ? 'active' : '' }}">
                    <a href="{{route('company.account-setting')}}"><i class="ti-settings"></i>Account Settings</a>
                </li>
                <li><a href="{{route('logout')}}"><i class="ti-power-off"></i>Logout</a></li>
            </ul>
            <!--                        <h4>For Candidate</h4>-->
            <!--                        <ul>-->
            <!--                            <li><a href="candidate-dashboard.php"><i class="ti-dashboard"></i>Candidate Dashboard</a></li>-->
            <!--                            <li><a href="candidate-resume.php"><i class="ti-wallet"></i>My Resume</a></li>-->
            <!--                            <li><a href="applied-jobs.php"><i class="ti-hand-point-right"></i>Applied Jobs</a></li>-->
            <!--                            <li><a href="saved-jobs.php"><i class="ti-heart"></i>Saved Jobs</a></li>-->
            <!--                            <li><a href="alert-jobs.php"><i class="ti-bell"></i>Alert Jobs</a></li>-->
            <!--                        </ul>-->
        </div>
    </div>
</div>
