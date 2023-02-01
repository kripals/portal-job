<!-- Sidebar Wrap -->
<div class="col-lg-3 col-md-4">
    <div class="side-dashboard">
        <div class="dashboard-avatar">
            <div class="dashboard-avatar-thumb">
                <img src="{{asset($company->image_path)}}" class="img-avater" alt=""/>
            </div>
            <div class="dashboard-avatar-text">
                <h4>{{$company->company_name}}</h4>
                <span>Create Job</span>
            </div>

        </div>
        <div class="dashboard-menu">
            <ul>
                <li class="{{ request()->is('company/dashboard') ? 'active' : '' }}">
                    <a href="{{route('company.dashboard')}}"><i class="ti-dashboard"></i>Dashboard</a>
                </li>
                @if($type == 'create')
                    <li class="{{ request()->is('company/job/create-job') ? 'active' : '' }}">
                        <a href="{{route('company.job.create')}}"><i class="ti-ruler-pencil"></i>Basic Job
                            Information</a>
                    </li>
                    <li class="{{ request()->is('company/job/specification') ? 'active' : '' }}">
                        <a href="#"><i class="ti-ruler-pencil"></i>Job Specification</a>
                    </li>
                    <li class="{{ request()->is('company/job/description') ? 'active' : '' }}">
                        <a href="#"><i class="ti-ruler-pencil"></i>Job Description</a>
                    </li>
                    <li class="{{ request()->is('company/job/vacancy-setting') ? 'active' : '' }}">
                        <a href="#"><i class="ti-ruler-pencil"></i>Vacancy Settings</a>
                    </li>
                    <li>
                        <a href="{{route('logout')}}"><i class="ti-power-off"></i>Logout</a>
                    </li>
                @elseif($type == 'edit')
                    <li class="{{ request()->is('company/job/edit-job/*') ? 'active' : '' }}">
                        <a href="{{route('company.job.edit',$jobDetail->ref_id)}}"><i class="ti-ruler-pencil"></i>Basic Job
                            Information</a>
                    </li>
                    <li class="{{ request()->is('company/job/specification/*') ? 'active' : '' }}">
                        <a href="#"><i class="ti-ruler-pencil"></i>Job Specification</a>
                    </li>
                    <li class="{{ request()->is('company/job/description/*') ? 'active' : '' }}">
                        <a href="#"><i class="ti-ruler-pencil"></i>Job Description</a>
                    </li>
                    <li class="{{ request()->is('company/job/vacancy-setting/*') ? 'active' : '' }}">
                        <a href="#"><i class="ti-ruler-pencil"></i>Vacancy Settings</a>
                    </li>
                    <li>
                        <a href="{{route('logout')}}"><i class="ti-power-off"></i>Logout</a>
                    </li>
                @else
                @endif
            </ul>
        </div>
    </div>
</div>
