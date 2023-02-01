<div class="dashboard-menu">
    <ul>
        <li class="{{ request()->is('candidate/dashboard') ? 'active' : '' }}"><a
                href="{{route('candidate.dashboard')}}"><i class="ti-dashboard"></i>Dashboard</a>
        </li>
        <li class="{{ request()->is('candidate/edit-profile') ? 'active' : '' }}"><a
                href="{{ route('candidate.edit-profile') }}"><i class="ti-id-badge"></i>Edit
                Profile</a></li>
    </ul>
    <ul>
        <li class="{{ request()->is('candidate/my-profile') ? 'active' : '' }}"><a
                href="{{ route('candidate.profile') }}"><i class="ti-wallet"></i>My Resume</a></li>
        <li class="{{ request()->is('candidate/applied-jobs') ? 'active' : '' }}"><a
                href="{{ route('candidate.applied.jobs') }}"><i class="ti-hand-point-right"></i>Applied Jobs</a></li>
        <li class="{{ request()->is('candidate/privacy-control') ? 'active' : '' }}">
            <a href="{{route('candidate.privacy-control')}}"><i class="ti-shield"></i>Privacy Settings</a>
        </li>
        <li class="{{ request()->is('candidate/account-settings') ? 'active' : '' }}">
            <a href="{{route('candidate.account-setting')}}"><i class="ti-settings"></i>Account Settings</a>
        </li>
        <li><a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="signin">
                <i class="ti-power-off"></i>Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                @method('POST')
                @csrf
            </form>
        </li>
    </ul>
</div>
