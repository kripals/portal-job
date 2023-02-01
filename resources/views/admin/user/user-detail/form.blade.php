{!! csrf_field() !!}
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="uk-grid" data-uk-grid-margin>
    <div class="uk-width-large-7-10">
        <div class="md-card">
            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail">
                        <img src="{{asset($user->thumbnail_path)}}" alt="user avatar"/>
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div class="user_avatar_controls">
                                        <span class="btn-file">
                                            <a data-uk-modal="{target:'.uploadModal'}"  onclick="getModal('{{$user->id}}','{{$user->image_path}}')">
                                                <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                                            <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                                            </a>
                                        </span>
                        {{--<a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="material-icons">&#xE5CD;</i></a>--}}
                    </div>
                </div>
                <div class="user_heading_content">
                    <h2 class="heading_b"><span class="uk-text-truncate" id="user_edit_uname">{{ $user->first_name }} {{ $user->last_name }} ({{ $user->username }})</span><span class="sub-heading" id="user_edit_position">Last Active   {{ $user->last_login }}</span></h2>
                </div>
                {{--<div class="md-fab-wrapper">--}}
                    {{--<div class="md-fab md-fab-toolbar md-fab-small md-fab-accent">--}}
                        {{--<i class="material-icons">&#xE8BE;</i>--}}
                        {{--<div class="md-fab-toolbar-actions">--}}
                            {{--<button type="submit" id="user_edit_save" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Save"><i class="material-icons md-color-white">&#xE161;</i></button>--}}
                            {{--<button type="submit" id="user_edit_print" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Print"><i class="material-icons md-color-white">&#xE555;</i></button>--}}
                            {{--<button type="submit" id="user_edit_delete" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Delete"><i class="material-icons md-color-white">&#xE872;</i></button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
            <div class="user_content">
                <ul id="user_edit_tabs" class="uk-tab" data-uk-tab="{connect:'#user_edit_tabs_content'}">
                    <li class="uk-active"><a href="#">Basic</a></li>
                    {{--<li><a href="#">Groups</a></li>--}}
                    {{--<li><a href="#">Todo</a></li>--}}
                </ul>
                <ul id="user_edit_tabs_content" class="uk-switcher uk-margin">
                    <li>
                        <div class="uk-margin-top">
                            <h3 class="full_width_in_card heading_c">
                                Personal Details
                            </h3>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <label for="user_edit_uname_control">Mobile 1</label>
                                    <input class="md-input" type="text" id="" name="personal_mobile_1" value="{{old('personal_mobile_1', isset($userDetail->personal_mobile_1)?$userDetail->personal_mobile_1:'')}}" required/>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_position_control">Mobile 2 <small>if any</small></label>
                                    <input class="md-input" type="text" id="" name="personal_mobile_2"  value="{{old('personal_mobile_2', isset($userDetail->personal_mobile_2)?$userDetail->personal_mobile_2:'')}}"/>
                                </div>
                            </div>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <label for="user_edit_uname_control">Nationality</label>
                                    <input class="md-input" type="text" id="" name="nationality"  required value="{{old('nationality', isset($userDetail->nationality)?$userDetail->nationality:'')}}"/>
                                 </div>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <label for="user_edit_position_control">Citizenship No.</label>
                                    <input class="md-input" type="text" id="" name="citizenship_no"   required value="{{old('citizenship_no', isset($userDetail->citizenship_no)?$userDetail->citizenship_no:'')}}"/>
                                </div>
                            </div>

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <label for="user_edit_uname_control">Passport No.</label>
                                    <input class="md-input" type="text" id="" name="passport_no"  required value="{{old('passport_no', isset($userDetail->passport_no)?$userDetail->passport_no:'')}}"/>
                                 </div>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <label for="user_edit_position_control">Issue Place</label>
                                    <input class="md-input" type="text" id="" name="issue_place"  required value="{{old('issue_place', isset($userDetail->issue_place)?$userDetail->issue_place:'')}}"/>
                                 </div>
                            </div>

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <div class="uk-input-group ">
                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                        <label for="uk_dp_1">DOB</label>
                                        <input class="md-input" type="text" name="date_of_birth" id="uk_dp_1" data-uk-datepicker="{format:'DD-MM-YYYY'}" required value="{{old('date_of_birth', isset($userDetail->date_of_birth)?$userDetail->date_of_birth:'')}}"/>
                                    </div>
                                </div>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    {{--<label for="user_edit_position_control">User position</label>--}}
                                    {{--<input class="md-input" type="text" id="user_edit_position_contr ol" name="user_edit_position_control"  required/>--}}
                                    <span class="uk-text-medium ">Marital Status</span><br>

                                    <span class="icheck-inline">
                                        <input type="radio" name="marital_status" value="married" {{ old('marital_status', isset($userDetail->marital_status) ? $userDetail->marital_status : '')=='married' ? 'checked':'' }} id="radio_demo_inline_1"
                                               data-md-icheck required />
                                        <label for="radio_demo_inline_1" class="inline-label">Married</label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="radio" name="marital_status" value="single" {{ old('marital_status', isset($userDetail->marital_status) ? $userDetail->marital_status : '')=='single' ? 'checked':'' }} id="radio_demo_inline_2"
                                               data-md-icheck required />
                                        <label for="radio_demo_inline_2" class="inline-label">Single</label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="radio" name="marital_status" value="others" {{ old('marital_status', isset($userDetail->marital_status) ? $userDetail->marital_status : '')=='others' ? 'checked':'' }} id="radio_demo_inline_3"
                                               data-md-icheck required/>
                                        <label for="radio_demo_inline_3" class="inline-label">Others</label>
                                    </span>
                                </div>
                            </div>

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <label for="user_edit_uname_control">Contact Home</label>
                                    <input class="md-input" type="text" id="" name="contact_home"  required value="{{old('contact_home', isset($userDetail->contact_home)?$userDetail->contact_home:'')}}"/>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_position_control">Contact Office</label>
                                    <input class="md-input" type="text" id="" name="contact_office" value="{{old('contact_office', isset($userDetail->contact_office)?$userDetail->contact_office:'')}}"/>
                                </div>
                            </div>
                            <div class="uk-grid" data-uk-grid-margin>

                            </div>


                            <h3 class="full_width_in_card heading_c">
                                Family info
                            </h3>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_uname_control">Father Name</label>
                                    <input class="md-input" type="text" id="" name="father_name" value="{{old('father_name', isset($userDetail->father_name)?$userDetail->father_name:'')}}"/>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_position_control">Mother Name </label>
                                    <input class="md-input" type="text" id="" name="mother_name" value="{{old('mother_name', isset($userDetail->mother_name)?$userDetail->mother_name:'')}}"/>
                                </div>
                            </div>

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_uname_control">Grand Father Name</label>
                                    <input class="md-input" type="text" id="" name="grand_father_name" value="{{old('grand_father_name', isset($userDetail->grand_father_name)?$userDetail->grand_father_name:'')}}"/>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_position_control">Spouse Name</label>
                                    <input class="md-input" type="text" id="" name="spouse_name" value="{{old('spouse_name', isset($userDetail->spouse_name)?$userDetail->spouse_name:'')}}"/>
                                </div>
                            </div>
                            <h3 class="full_width_in_card heading_c">
                                Permanent Address
                            </h3>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <label for="user_edit_uname_control">House No.</label>
                                    <input class="md-input" type="text" id="" name="permanent_house_no" required value="{{old('permanent_house_no', isset($userDetail->permanent_house_no)?$userDetail->permanent_house_no:'')}}"/>
                                </div>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <label for="user_edit_position_control">Tole</label>
                                    <input class="md-input" type="text" id="" name="permanent_tole" required value="{{old('permanent_tole', isset($userDetail->permanent_tole)?$userDetail->permanent_tole:'')}}"/>
                                </div>
                            </div>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <label for="user_edit_uname_control">Ward No.</label>
                                    <input class="md-input" type="text" id="" name="permanent_ward_no" required value="{{old('permanent_ward_no', isset($userDetail->permanent_ward_no)?$userDetail->permanent_ward_no:'')}}"/>
                                </div>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <label for="user_edit_position_control">City</label>
                                    <input class="md-input" type="text" id="" name="permanent_city" required value="{{old('permanent_city', isset($userDetail->permanent_city)?$userDetail->permanent_city:'')}}"/>
                                </div>
                            </div>

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <label for="user_edit_uname_control">District</label>
                                    <input class="md-input" type="text" id="" name="permanent_district" required value="{{old('permanent_district', isset($userDetail->permanent_district)?$userDetail->permanent_district:'')}}"/>
                                </div>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <label for="user_edit_position_control">State</label>
                                    <input class="md-input" type="text" id="" name="permanent_state" required value="{{old('permanent_state', isset($userDetail->permanent_state)?$userDetail->permanent_state:'')}}"/>
                                </div>
                            </div>

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2 parsley-row">
                                    <label for="user_edit_uname_control">Country</label>
                                    <input class="md-input" type="text" id="" name="permanent_country" required value="{{old('permanent_country', isset($userDetail->permanent_country)?$userDetail->permanent_country:'')}}"/>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_position_control">Mailing Address</label>
                                    <input class="md-input" type="text" id="" name="permanent_mailing_address" value="{{old('permanent_mailing_address', isset($userDetail->permanent_mailing_address)?$userDetail->permanent_mailing_address:'')}}"/>

                                </div>
                            </div>

                            <h3 class="full_width_in_card heading_c">
                                Temporary Address
                            </h3>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_uname_control">House No.</label>
                                    <input class="md-input" type="text" id="" name="temporary_house_no" value="{{old('temporary_house_no', isset($userDetail->temporary_house_no)?$userDetail->temporary_house_no:'')}}"/>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_position_control">Tole</label>
                                    <input class="md-input" type="text" id="" name="temporary_tole" value="{{old('temporary_tole', isset($userDetail->temporary_tole)?$userDetail->temporary_tole:'')}}"/>
                                </div>
                            </div>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_uname_control">Ward No.</label>
                                    <input class="md-input" type="text" id="" name="temporary_ward_no" value="{{old('temporary_ward_no', isset($userDetail->temporary_ward_no)?$userDetail->temporary_ward_no:'')}}"/>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_position_control">City</label>
                                    <input class="md-input" type="text" id="" name="temporary_city" value="{{old('temporary_city', isset($userDetail->temporary_city)?$userDetail->temporary_city:'')}}"/>
                                </div>
                            </div>

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_uname_control">District</label>
                                    <input class="md-input" type="text" id="" name="temporary_district" value="{{old('temporary_district', isset($userDetail->temporary_district)?$userDetail->temporary_district:'')}}"/>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_position_control">State</label>
                                    <input class="md-input" type="text" id="" name="temporary_state" value="{{old('temporary_state', isset($userDetail->temporary_state)?$userDetail->temporary_state:'')}}"/>
                                </div>
                            </div>

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_uname_control">Country</label>
                                    <input class="md-input" type="text" id="" name="temporary_country" value="{{old('temporary_country', isset($userDetail->temporary_country)?$userDetail->temporary_country:'')}}"/>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <label for="user_edit_position_control">Mailing Address</label>
                                    <input class="md-input" type="text" id="" name="temporary_mailing_address" value="{{old('temporary_mailing_address', isset($userDetail->temporary_mailing_address)?$userDetail->temporary_mailing_address:'')}}"/>

                                </div>
                            </div>

                            <h3 class="full_width_in_card heading_c">
                                Social Link
                            </h3>
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>
                                        <div>
                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                                                                </span>
                                                <label>Facebook</label>
                                                <input type="text" class="md-input" name="facebook" value="{{old('facebook', isset($userDetail->facebook)?$userDetail->facebook:'')}}"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                                </span>
                                                <label>Twitter</label>
                                                <input type="text" class="md-input" name="twitter" value="{{old('twitter', isset($userDetail->twitter)?$userDetail->twitter:'')}}"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-linkedin"></i>
                                                                </span>
                                                <label>Linkdin</label>
                                                <input type="text" class="md-input" name="linkdin" value="{{old('linkdin', isset($userDetail->linkdin)?$userDetail->linkdin:'')}}"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-google-plus"></i>
                                                                </span>
                                                <label>Google+</label>
                                                <input type="text" class="md-input" name="google_plus" value="{{old('google_plus', isset($userDetail->google_plus)?$userDetail->google_plus:'')}}"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-instagram"></i>
                                                                </span>
                                                <label>Instagram</label>
                                                <input type="text" class="md-input" name="instagram" value="{{old('instagram', isset($userDetail->instagram)?$userDetail->instagram:'')}}"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-youtube"></i>
                                                                </span>
                                                <label>Youtube</label>
                                                <input type="text" class="md-input" name="youtube" value="{{old('youtube', isset($userDetail->youtube)?$userDetail->youtube:'')}}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input class="md-input" type="hidden" id="" name="user_id" value="{{$user->id}}" />
                        </div>

                    </li>

                </ul>

            </div>
        </div>
    </div>
    <div class="uk-width-large-3-10">
        <div class="md-card" data-uk-sticky="{ top: 52, media: 960 }">
            <div class="md-card-content">
                <h3 class="heading_c uk-margin-medium-bottom">Other settings</h3>
                <div class="uk-form-row">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <label for="switch_demo_1" class="inline-label">Status</label>

                        </div>
                        <div class="uk-width-medium-1-2">
                            <input type="checkbox" id="switch_demo_1" name="status" {{ old('status', isset($userDetail->status) ? $userDetail->status : '')=='active' ? 'checked':'' }} data-switchery />

                        </div>
                    </div>

                </div>
                <div class="uk-form-row">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <label for="switch_demo_1" class="inline-label">Availability</label>

                        </div>
                        <div class="uk-width-medium-1-2">
                            <input type="checkbox" id="switch_demo_1" name="availability" {{ old('availability', isset($userDetail->availability) ? $userDetail->availability : '')=='available' ? 'checked':'' }} data-switchery />

                        </div>
                    </div>

                </div>


                <hr class="md-hr">

                    <div class="uk-grid uk-text-center" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1 ">
                            <button type="submit" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                            <a href="{{route('user.index')}}" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light"
                            >Cancel</a>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
@section('page-specific-scripts')
    <script src="{{asset('resources/admin/assets/js/custom/uikit_fileinput.min.js')}}"></script>

    <script src="{{asset('resources/admin/assets/js/pages/page_user_edit.min.js')}}"></script>

    <script src="{{asset('resources/admin/assets/js/pages/page_mailbox.min.js')}}"></script>
    <script>
        function getModal(userId,image_path) {
            $(".uploadModal").remove();
            data = {attributeId:userId,'upload_route':'{{route('user.upload-image')}}','image_path':image_path,'type':'user_image_ratio'};
            ajaxCall('POST','{{route('administrator.upload-modal')}}','html',data,'#page_content',function (response,selector) {
                $(selector).append(response);
                var modal = UIkit.modal(".uploadModal");
                $('.uploadModal').addClass('uk-open').show();
            },function (error) {
                //console.log(error)
            });
        }
    </script>
@endsection
@section('validation-scripts')
        <script>
            altair_forms.parsley_validation_config();
        </script>
        <script src="{{asset('resources/admin/bower_components/parsleyjs/dist/parsley.min.js')}}"></script>

        <!--  forms validation functions -->
        <script src="{{asset('resources/admin/assets/js/pages/forms_validation.min.js')}}"></script>

@endsection
