<ul>
    <li class="{{ request()->is('candidate/dashboard') ? 'active' : '' }}">
        <a href="{{route('candidate.dashboard')}}"><i class="ti-dashboard"></i>Dashboard</a>
    </li>
    <li class="{{ request()->is('candidate/edit-profile') ? 'active' : '' }}">
        <a href="{{route('candidate.edit-profile')}}"><i class="ti-briefcase"></i>Job preference</a>
    </li>
    <li class="{{ request()->is('candidate/basic-information') ? 'active' : '' }}">
        <a href="{{route('candidate.basic-information')}}"><i class="ti-id-badge"></i>Basic Information</a>
    </li>
    <li class="{{ request()->is('candidate/education') ? 'active' : '' }}">
        <a href="{{route('candidate.education')}}"><i class="ti-ruler-pencil"></i>Education</a>
    </li>
    <li class="{{ request()->is('candidate/work-experience') ? 'active' : '' }}">
        <a href="{{route('candidate.work-experience')}}"><i class="ti-bookmark-alt"></i>Work Experience</a>
    </li>
    <li class="{{ request()->is('candidate/training') ? 'active' : '' }}">
        <a href="{{route('candidate.training')}}"><i class="ti-blackboard"></i>Training</a>
    </li>
    <li class="{{ request()->is('candidate/language') ? 'active' : '' }}">
        <a href="{{route('candidate.language')}}"><i class="ti-world"></i>Language</a>
    </li>
    <li class="{{ request()->is('candidate/social-account') ? 'active' : '' }}">
        <a href="{{route('candidate.social-account')}}"><i class="ti-sharethis"></i>Social Account</a>
    </li>
    <li class="{{ request()->is('candidate/reference') ? 'active' : '' }}">
        <a href="{{route('candidate.reference')}}"><i class="ti-pencil-alt"></i>Reference</a>
    </li>
    <li class="{{ request()->is('candidate/others') ? 'active' : '' }}">
        <a href="{{route('candidate.others')}}"><i class="ti-menu-alt"></i>Others</a>
    </li>
</ul>
