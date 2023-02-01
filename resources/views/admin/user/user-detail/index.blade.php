@extends('layouts.administrator.layouts')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-7-10">

                    <div class="md-card">
                        <div class="user_heading ">
                            <div class="user_heading_menu hidden-print">
                                <div class="uk-display-inline-block" data-uk-dropdown="{pos:'left-top'}">
                                    <i class="md-icon material-icons md-icon-light">&#xE5D4;</i>
                                    <div class="uk-dropdown uk-dropdown-small">
                                        <ul class="uk-nav">
                                            <li><a href="#">Action 1</a></li>
                                            <li><a href="#">Action 2</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="uk-display-inline-block"><i class="md-icon md-icon-light material-icons"
                                                                        id="page_print">&#xE8ad;</i></div>
                            </div>
                            <div class="user_heading_avatar">
                                <div class="thumbnail" style="cursor: pointer;"
                                     data-uk-modal="{target:'#modal_lightbox{{$user->id}}'}">
                                    <img src="{{asset($user->thumbnail_path)}}" alt="user avatar"/>
                                </div>
                                <div class="uk-modal" id="modal_lightbox{{$user->id}}">
                                    <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                                        <button type="button" class="uk-modal-close uk-close uk-close-alt"></button>

                                        <img src="{{asset($user->image_path)}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span
                                            class="uk-text-truncate">{{$user->first_name}} {{$user->last_name}}  @php echo '@'.$user->username @endphp </span><span
                                            class="sub-heading">Last Active <i>{{$user->last_login}}</i> </span></h2>
                                {{--<ul class="user_stats">--}}
                                {{--<li>--}}
                                {{--<h4 class="heading_a">2391 <span class="sub-heading">Posts</span></h4>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<h4 class="heading_a">120 <span class="sub-heading">Photos</span></h4>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<h4 class="heading_a">284 <span class="sub-heading">Following</span></h4>--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                            </div>
                            <div class="md-fab-wrapper">
                                <div class="md-fab md-fab-toolbar md-fab-small md-fab-accent">
                                    <i class="material-icons">&#xE8BE;</i>
                                    <div class="md-fab-toolbar-actions">
                                        <a id="user_edit_save" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}"
                                           title="Edit"
                                           href="{{route('user.user-detail.edit', [$user->id, $userDetail->id])}}">
                                            <i class="material-icons md-color-white">&#xE150;</i>
                                        </a>
                                        {{--<a id="user_edit_save" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Delete" href="{{route('user.user-detail.destroy', [$user->id, $userDetail->id])}}">--}}
                                        {{--<i class="material-icons md-color-white">&#xE872;</i>--}}
                                        {{--</a>--}}
                                        {{--<button type="submit" id="user_edit_print" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Print"><i class="material-icons md-color-white">&#xE555;</i></button>--}}
                                        {{--<button type="submit" id="user_edit_delete" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Delete"><i class="material-icons md-color-white">&#xE872;</i></button>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user_content">
                            <ul id="user_profile_tabs" class="uk-tab"
                                data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}"
                                data-uk-sticky="{ top: 48, media: 960 }">
                                <li class="uk-active"><a href="#">About</a></li>
                                <li><a href="#">Other Details</a></li>
                                <li><a href="#">Social Links</a></li>
                            </ul>
                            <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                <li>

                                    <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom"
                                         data-uk-grid-margin>
                                        <div class="uk-width-large-1">
                                            <h4 class="heading_c uk-margin-small-bottom">Basic Contact Info</h4>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{{$user->email}}</span>
                                                        <span class="uk-text-small uk-text-muted">Email</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-mobile"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{{$user->mobile}}</span>
                                                        <span class="uk-text-small uk-text-muted">Phone</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">

                                                        <i class="md-list-addon-icon uk-icon-map-marker"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{{$userDetail->permanent_tole}}
                                                            , {{$userDetail->permanent_city}}
                                                            , {{$userDetail->permanent_state}}
                                                            , {{$userDetail->permanent_country}} </span>
                                                        <span class="uk-text-small uk-text-muted">Address</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-calendar-plus-o"></i>
                                                    </div>
                                                    <div class="md-list-content">

                                                        <span
                                                                class="md-list-heading">{{defaultDateFormat($user->created_at,'Y-M-d')}}</span>
                                                        <span class="uk-text-small uk-text-muted">Member Since</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>

                                </li>
                                <li>
                                    <div id="user_profile_gallery">
                                        <h3 class="full_width_in_card heading_c">
                                            Personal Details
                                        </h3>
                                        <div class="uk-grid uk-grid-divider" data-uk-grid-margin="">

                                            <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-row-first">
                                                <ul class="md-list">
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Mobile Primary</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$user->mobile}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Contact Home</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->contact_home}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Nationality</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->nationality}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Marital Status</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->marital_status}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">passport No</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->passport_no}}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-row-first">
                                                <ul class="md-list">
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Modile Secondary</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->personal_mobile_2}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Contact Office</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->contact_office}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Birth date</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{defaultDateFormat($userDetail->date_of_birth,'Y-M-d')}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Citizen Ship No</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->citizenship_no}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Issued Place</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->issue_place}}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <h3 class="full_width_in_card heading_c">
                                            Language
                                        </h3>
                                        <div class="uk-grid uk-grid-divider" data-uk-grid-margin="">

                                            <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-row-first">
                                                <ul class="md-list">
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Lanugage</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->language}}</span>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>


                                        </div>
                                        <h3 class="full_width_in_card heading_c">
                                            Family Info
                                        </h3>
                                        <div class="uk-grid uk-grid-divider" data-uk-grid-margin="">

                                            <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-row-first">
                                                <ul class="md-list">
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Father Name</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->father_name}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Grand Father Name</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->grand_father_name}}</span>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-row-first">
                                                <ul class="md-list">
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Mother Name</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->mother_name}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Spouce Name</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->spouse_name}}</span>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>

                                        </div>
                                        <h3 class="full_width_in_card heading_c">
                                            Permanet Address
                                        </h3>
                                        <div class="uk-grid uk-grid-divider" data-uk-grid-margin="">

                                            <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-row-first">
                                                <ul class="md-list">
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">House No</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->permanent_house_no}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Ward No</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->permanent_ward_no}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">District</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->permanent_district}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Country</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->permanent_country}}</span>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-row-first">
                                                <ul class="md-list">
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Tole</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->permanent_tole}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">City</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->permanent_city}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">State</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->permanent_state}}</span>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Mailinig Address</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->permanent_mailing_address}}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <h3 class="full_width_in_card heading_c">
                                            Temporary Address
                                        </h3>
                                        <div class="uk-grid uk-grid-divider" data-uk-grid-margin="">

                                            <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-row-first">
                                                <ul class="md-list">
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">House No</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->temporary_house_no}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Ward No</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->temporary_ward_no}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">District</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->temporary_district}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Country</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->temporary_country}}</span>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-row-first">
                                                <ul class="md-list">
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Tole</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->temporary_tole}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">City</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->temporary_city}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">State</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->temporary_state}}</span>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Mailinig Address</span>
                                                            <span
                                                                    class="uk-text-small uk-text-muted">{{$userDetail->temporary_mailing_address}}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>


                                    </div>

                                </li>
                                <li>
                                    <h3 class="full_width_in_card heading_c">
                                        Social Links
                                    </h3>
                                    <div class="uk-grid uk-grid-divider" data-uk-grid-margin="">

                                        <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-row-first">
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{{$userDetail->facebook}}</span>
                                                        <span class="uk-text-small uk-text-muted">Facebook</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-linkedin"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{{$userDetail->linkdin}}</span>
                                                        <span class="uk-text-small uk-text-muted">LinkedIn</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">

                                                        <i class="md-list-addon-icon uk-icon-instagram"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{{$userDetail->instagram}}</span>
                                                        <span class="uk-text-small uk-text-muted">Instagram</span>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-row-first">
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{{$userDetail->twitter}}</span>
                                                        <span class="uk-text-small uk-text-muted">Twitter</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-google-plus"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span
                                                                class="md-list-heading">{{$userDetail->google_plus}}</span>
                                                        <span class="uk-text-small uk-text-muted">Google Plus</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">

                                                        <i class="md-list-addon-icon uk-icon-youtube"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{{$userDetail->youtube}}</span>
                                                        <span class="uk-text-small uk-text-muted">You tube</span>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="uk-width-large-3-10">
                    <div class="md-card" data-uk-sticky="{ top: 52, media: 960 }">
                        <div class="md-card-content">
                            <h3 class="heading_c uk-margin-medium-bottom"> Settings</h3>
                            <div class="uk-overflow-container">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-large-1-1">
                                        <div class="uk-form-row">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <label for="switch_demo_1" class="inline-label">Status</label>

                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <span
                                                            class="{{getLabel($userDetail->status)}}">{{$userDetail->status_text}}</span>


                                                </div>
                                            </div>

                                        </div>
                                        <div class="uk-form-row">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <label for="switch_demo_1" class="inline-label">Availability</label>

                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <span
                                                            class="{{getLabel($userDetail->availability)}}">{{$userDetail->availability_text}}</span>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr class="md-hr">
                            <h3>Assigned Roles</h3>
                            @if($userRoles->count()>0)
                                @foreach($userRoles as $k=>$userRole)
                                    <span class="uk-badge">{{$userRole->display_name}}</span>
                                @endforeach
                            @endif
                            <div class="uk-width-large-1-1">

                                <hr class="md-hr">
                                <div class="uk-form-row">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <label for="switch_demo_1" class="inline-label">Change Role
                                                ?</label>

                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <input type="checkbox" id="switch_demo_1"
                                                   onchange="getRoleForm(this)" data-switchery/>

                                        </div>
                                    </div>

                                </div>

                                <form method="POST" action="{{route('user-detail.role.assign', [$user->id])}}"
                                      class="uk-margin-medium-top roleForm">
                                    {!! csrf_field() !!}
                                    <select id="select_adv_s2_2" name="role[]" class="uk-width-1-1" multiple
                                            data-md-select2 required>
                                        @foreach($roles as $r=>$role)
                                            <option @if(in_array($role->id,$savedRoles)) selected="selected"
                                                    @endif value="{{$role->id}}">{{$role->display_name}}</option>
                                        @endforeach

                                    </select>
                                    <div class="uk-width-medium-1-1 uk-margin-medium-top ">
                                        <button type="submit"
                                                class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light">
                                            Assign
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-specific-scripts')
    <script src="{{asset('resources/admin/bower_components/select2/dist/js/select2.min.js')}}"></script>
    <script>
        $(window).load(function () {
            $(".roleForm").hide();
        });

        function getRoleForm(element) {
            if ($(element).prop('checked'))
                $(".roleForm").show();
            else
                $(".roleForm").hide();
        }
    </script>
@stop
