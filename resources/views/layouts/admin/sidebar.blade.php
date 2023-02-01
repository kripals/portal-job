<!-- BEGIN MENUBAR-->
<div id="menubar" class="menubar-inverse">
    <div class="menubar-fixed-panel">
        <div>
            <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="expanded">
            <a href="{{route('admin.dashboard')}}">
                <span class="text-lg text-bold text-primary ">LEGENDS&nbsp;ZONE</span>
            </a>
        </div>
    </div>
    <div class="menubar-scroll-panel">
        <!-- BEGIN MAIN MENU -->
        <ul id="main-menu" class="gui-controls">
            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{route('admin.dashboard')}}">
                    <div class="gui-icon"><i class="md md-home"></i></div>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="gui-folder{{ request()->is('admin/company') || request()->is('admin/company/*')   ? ' active expanded' : '' }}">
                <a>
                    <div class="gui-icon"><i class="fa fa-building-o"></i></div>
                    <span class="title">Company Management</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li class="{{ request()->is('admin/company') ? 'active' : '' }}"><a href="{{route('company.index')}}"><span class="title">List Company</span></a></li>
                    <li class="{{ request()->is('admin/company/create') ? 'active' : '' }}"><a href="{{route('company.create')}}"><span class="title">Create Company</span></a></li>
                    <li class="{{ request()->is('admin/company/category') ? 'active' : '' }}"><a href="{{route('category.index','company')}}"><span class="title">Company Categories</span></a></li>
                </ul><!--end /submenu -->
            </li>
            <li class="gui-folder{{ request()->is('admin/candidate') || request()->is('admin/candidate/*')   ? ' active expanded' : '' }}">
                <a>
                    <div class="gui-icon"><i class="fa fa-transgender"></i></div>
                    <span class="title">Candidate Management</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li class="{{ request()->is('admin/candidate') ? 'active' : '' }}"><a href="{{route('candidate.index')}}"><span class="title">List Candidate</span></a></li>
                    <li class="{{ request()->is('admin/candidate/create') ? 'active' : '' }}"><a href="{{route('candidate.create')}}"><span class="title">Create Candidate</span></a></li>
                    <li class="{{ request()->is('admin/candidate/category') ? 'active' : '' }}"><a href="{{route('category.index','candidate')}}"><span class="title">Candidate/Job Categories</span></a></li>
                </ul><!--end /submenu -->
            </li>
            <li class="gui-folder{{ request()->is('admin/job') || request()->is('admin/job/*')   ? ' active expanded' : '' }}">
                <a>
                    <div class="gui-icon"><i class="fa fa-briefcase "></i></div>
                    <span class="title">Job Management</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li class="{{ request()->is('admin/job') ? 'active' : '' }}"><a href="{{route('job.index')}}"><span class="title">List Job</span></a></li>
                    <li class="{{ request()->is('admin/job/applicants/list') ? 'active' : '' }}"><a href="{{route('job.applicant.list')}}"><span class="title">List Job Applicants</span></a></li>
                    <li class="{{ request()->is('admin/job/create') ? 'active' : '' }}"><a href="{{route('job.create')}}"><span class="title">Create Job</span></a></li>
                </ul><!--end /submenu -->
            </li>
            <!-- END DASHBOARD -->
            <!-- BEGIN FORMS -->
            <li class="gui-folder{{ request()->is('admin/setting/*')   ? ' active expanded' : '' }}">
                <a>
                    <div class="gui-icon"><span class="glyphicon glyphicon-list-alt"></span></div>
                    <span class="title">Settings</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a href="{{route('job-country.index')}}" class="{{request()->is('admin/setting/job-country') ? 'active' : '' }}"><span class="title">Manage Job Locations</span></a></li>
                    <li><a href="{{route('job-level.index')}}" class="{{request()->is('admin/setting/job-level') ? 'active' : '' }}"><span class="title">Manage Job Levels</span></a></li>
                    <li><a href="{{route('job-skill.index')}}" class="{{request()->is('admin/setting/job-skill') ? 'active' : '' }}"><span class="title">Manage Job Skills</span></a></li>
                    <li><a href="{{route('job-type.index')}}" class="{{request()->is('admin/setting/job-type') ? 'active' : '' }}"><span class="title">Manage Job Types</span></a></li>
                    <li><a href="{{route('job-service.index')}}" class="{{request()->is('admin/setting/job-service') ? 'active' : '' }}"><span class="title">Manage Job Service</span></a></li>
                    <li><a href="{{route('education-board.index')}}" class="{{request()->is('admin/setting/education-board') ? 'active' : '' }}"><span class="title">Manage Education Board</span></a></li>
                    <li><a href="{{route('package.index','job')}}" class="{{request()->is('admin/setting/job/package') ? 'active' : '' }}"><span class="title">Manage Job Packages</span></a></li>
                    <li><a href="{{route('package.index','resume')}}" class="{{request()->is('admin/setting/resume/package') ? 'active' : '' }}"><span class="title">Manage Resume Packages</span></a></li>
                    <li><a href="{{route('advertisement.index')}}" class="{{request()->is('admin/setting/advertisement') ? 'active' : '' }}"><span class="title">Manage Advertisement</span></a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-li -->
            <!-- END FORMS -->
            <!-- BEGIN FORMS -->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="md md-web"></i></div>
                    <span class="title">Site Management</span>
                </a>
                <!--start submenu -->
                <ul>
{{--                    <li><a href="{{route('category.index')}}" class="{{request()->is('admin/category') ? 'active' : '' }}"><span class="title">Category</span></a></li>--}}
                    <li><a href="{{route('testimonial.index')}}" class="{{request()->is('admin/testimonial') ? 'active' : '' }}"><span class="title">Testimonial</span></a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-li -->
            <!-- END FORMS -->
            <li class="{{ request()->is('admin/subscriber') ? 'active' : '' }}">
                <a href="{{route('subscriber.index')}}">
                    <div class="gui-icon"><i class="md md-payment"></i></div>
                    <span class="title">Newsletter Subscriber</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/user') ? 'active' : '' }}">
                <a href="{{route('user.index')}}">
                    <div class="gui-icon"><i class="md md-people-outline"></i></div>
                    <span class="title">User</span>
                </a>
            </li>
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-shield"></i></div>
                    <span class="title">Auth</span>
                </a>
                <!--start submenu -->
                <ul style="display: none;">
                    <li class="{{ request()->is('admin/role') ? 'active' : '' }}"><a href="{{route('role.index')}}"><span class="title">Role</span></a></li>
{{--                    <li><a href="{{route('permission.index')}}"><span class="title">Permission</span></a></li>--}}
                </ul><!--end /submenu -->
            </li>
        </ul><!--end .main-menu -->
    </div><!--end .menubar-scroll-panel-->
</div><!--end #menubar-->
<!-- END MENUBAR -->
