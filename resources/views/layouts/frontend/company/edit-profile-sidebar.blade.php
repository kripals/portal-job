<!-- Sidebar Wrap -->
<div class="col-lg-3 col-md-4">
    <div class="side-dashboard">
        <div class="dashboard-avatar">
            <div class="dashboard-avatar-thumb">
                <img src="{{asset($company->image_path)}}" class="img-avater" alt=""/>
            </div>
            <div class="dashboard-avatar-text">
                <h4>{{$company->company_name}}</h4>
                <span>Edit Profile</span>
            </div>

        </div>
        <div class="dashboard-menu">
            <ul>
                <li class="{{ request()->is('company/dashboard') ? 'active' : '' }}">
                    <a href="{{route('company.dashboard')}}"><i class="ti-ruler-pencil"></i>Dashboard</a>
                </li>
                <li class="{{ request()->is('company/profile/edit-profile') ? 'active' : '' }}">
                    <a href="{{route('company.edit-profile')}}"><i class="ti-ruler-pencil"></i>Basic Information</a>
                </li>
                <li class="{{ request()->is('company/profile/contact-detail') ? 'active' : '' }}">
                    <a href="{{route('company.contact-detail')}}"><i class="ti-ruler-pencil"></i>Contact Detail</a>
                </li>
                <li class="{{ request()->is('company/profile/contact-person') ? 'active' : '' }}">
                    <a href="{{route('company.contact-person')}}"><i class="ti-ruler-pencil"></i>Contact Person</a>
                </li>
                {{--                                <li class="{{ request()->is('company/edit-profile/service') ? 'active' : '' }}">--}}
                {{--                                    <a href="{{route('company.service')}}"><i class="ti-ruler-pencil"></i>Service</a>--}}
                {{--                                </li>--}}
                <li class="{{ request()->is('company/profile/social-media') ? 'active' : '' }}">
                    <a href="{{route('company.social-media')}}"><i class="ti-ruler-pencil"></i>Social Account</a>
                </li>
                <li>
                    <a href="{{route('logout')}}"><i class="ti-power-off"></i>Logout</a>
                </li>
            </ul>

        </div>
    </div>
</div>
