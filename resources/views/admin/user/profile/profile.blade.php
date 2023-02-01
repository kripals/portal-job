@extends('layouts.administrator.layouts')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <form action="" class="uk-form-stacked" id="user_edit_form">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-7-10">
                        <div class="md-card">
                            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="assets/img/avatars/user.png" alt="user avatar"/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div class="user_avatar_controls">
                                        <span class="btn-file">
                                            <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                                            <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                                            <input type="file" name="user_edit_avatar_control" id="user_edit_avatar_control">
                                        </span>
                                        <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="material-icons">&#xE5CD;</i></a>
                                    </div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate" id="user_edit_uname">Carolanne Swaniawski</span><span class="sub-heading" id="user_edit_position">Land acquisition specialist</span></h2>
                                </div>
                                <div class="md-fab-wrapper">
                                    <div class="md-fab md-fab-toolbar md-fab-small md-fab-accent">
                                        <i class="material-icons">&#xE8BE;</i>
                                        <div class="md-fab-toolbar-actions">
                                            <button type="submit" id="user_edit_save" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Save"><i class="material-icons md-color-white">&#xE161;</i></button>
                                            <button type="submit" id="user_edit_print" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Print"><i class="material-icons md-color-white">&#xE555;</i></button>
                                            <button type="submit" id="user_edit_delete" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Delete"><i class="material-icons md-color-white">&#xE872;</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="user_content">
                                <ul id="user_edit_tabs" class="uk-tab" data-uk-tab="{connect:'#user_edit_tabs_content'}">
                                    <li class="uk-active"><a href="#">Basic</a></li>
                                    <li><a href="#">Groups</a></li>
                                    <li><a href="#">Todo</a></li>
                                </ul>
                                <ul id="user_edit_tabs_content" class="uk-switcher uk-margin">
                                    <li>
                                        <div class="uk-margin-top">
                                            <h3 class="full_width_in_card heading_c">
                                                General info
                                            </h3>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <label for="user_edit_uname_control">User name</label>
                                                    <input class="md-input" type="text" id="user_edit_uname_control" name="user_edit_uname_control" />
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <label for="user_edit_position_control">User position</label>
                                                    <input class="md-input" type="text" id="user_edit_position_control" name="user_edit_position_control" />
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-1-1">
                                                    <label for="user_edit_personal_info_control">About</label>
                                                    <textarea class="md-input" name="user_edit_personal_info_control" id="user_edit_personal_info_control" cols="30" rows="4">Similique rerum dolore quaerat maxime voluptatum sed reiciendis officia qui id sed repellendus fugiat harum et quis eligendi eius sunt sit sapiente qui quis et autem impedit omnis cumque consectetur quam porro ea in aspernatur mollitia sint corrupti cumque aliquid velit inventore aperiam voluptatum voluptatem esse eligendi aut voluptatem nihil voluptas animi est est rerum dolore quia.</textarea>
                                                </div>
                                            </div>
                                            <h3 class="full_width_in_card heading_c">
                                                Languages
                                            </h3>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-1-1">
                                                    <select id="user_edit_languages" name="user_edit_languages" multiple>
                                                        <option value="gb" selected>English</option>
                                                        <option value="pl" selected>Polish</option>
                                                        <option value="fr" selected>French</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <h3 class="full_width_in_card heading_c">
                                                Contact info
                                            </h3>
                                            <div class="uk-grid">
                                                <div class="uk-width-1-1">
                                                    <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>
                                                        <div>
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                                                </span>
                                                                <label>Email</label>
                                                                <input type="text" class="md-input" name="user_edit_email" value="mariam20@yahoo.com" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                                                </span>
                                                                <label>Phone Number</label>
                                                                <input type="text" class="md-input" name="user_edit_phone" value="898-989-3231x185" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                                                                </span>
                                                                <label>Facebook</label>
                                                                <input type="text" class="md-input" name="user_edit_facebook" value="facebook.com/envato" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                                </span>
                                                                <label>Twitter</label>
                                                                <input type="text" class="md-input" name="user_edit_twitter" value="twitter.com/envato" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-linkedin"></i>
                                                                </span>
                                                                <label>Linkdin</label>
                                                                <input type="text" class="md-input" name="user_edit_linkdin" value="linkedin.com/company/envato" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-google-plus"></i>
                                                                </span>
                                                                <label>Google+</label>
                                                                <input type="text" class="md-input" name="user_edit_google_plus" value="plus.google.com/+envato/about" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="uk-text-muted uk-text-small">Move the draggable group by clicking and holding handler and drag it to other list.</p>
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-2">
                                                <h4 class="heading_c uk-margin-small-bottom">My groups</h4>
                                                <ul class="md-list md-list-addon uk-sortable groups_connected" id="user_groups">
                                                    <li data-group-id="1">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">Cloud Computing</a></span>
                                                            <span class="uk-text-small uk-text-muted">19 Members</span>
                                                        </div>
                                                    </li>
                                                    <li data-group-id="2">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">Account Manager Group</a></span>
                                                            <span class="uk-text-small uk-text-muted">82 Members</span>
                                                        </div>
                                                    </li>
                                                    <li data-group-id="3">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">Digital Marketing</a></span>
                                                            <span class="uk-text-small uk-text-muted">298 Members</span>
                                                        </div>
                                                    </li>
                                                    <li data-group-id="4">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">HR Professionals Association - Human Resources</a></span>
                                                            <span class="uk-text-small uk-text-muted">192 Members</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <h4 class="heading_c uk-margin-small-bottom">All Groups</h4>
                                                <ul class="md-list md-list-addon uk-sortable groups_connected" id="all_groups">
                                                    <li data-group-id="5">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">Biotech & Pharma Professionals Network</a></span>
                                                            <span class="uk-text-small uk-text-muted">229 Members</span>
                                                        </div>
                                                    </li>
                                                    <li data-group-id="6">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">The IT Sales Global Community</a></span>
                                                            <span class="uk-text-small uk-text-muted">121 Members</span>
                                                        </div>
                                                    </li>
                                                    <li data-group-id="7">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">Healthcare Executives Network</a></span>
                                                            <span class="uk-text-small uk-text-muted">79 Members</span>
                                                        </div>
                                                    </li>
                                                    <li data-group-id="8">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">Luxury & Lifestyle Professionals</a></span>
                                                            <span class="uk-text-small uk-text-muted">275 Members</span>
                                                        </div>
                                                    </li>
                                                    <li data-group-id="9">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">Information Security Community</a></span>
                                                            <span class="uk-text-small uk-text-muted">84 Members</span>
                                                        </div>
                                                    </li>
                                                    <li data-group-id="10">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">eMarketing Association Network</a></span>
                                                            <span class="uk-text-small uk-text-muted">128 Members</span>
                                                        </div>
                                                    </li>
                                                    <li data-group-id="11">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">Finance Club</a></span>
                                                            <span class="uk-text-small uk-text-muted">149 Members</span>
                                                        </div>
                                                    </li>
                                                    <li data-group-id="12">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">Banking Careers</a></span>
                                                            <span class="uk-text-small uk-text-muted">262 Members</span>
                                                        </div>
                                                    </li>
                                                    <li data-group-id="13">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">Java Developers</a></span>
                                                            <span class="uk-text-small uk-text-muted">111 Members</span>
                                                        </div>
                                                    </li>
                                                    <li data-group-id="14">
                                                        <div class="md-list-addon-element sortable-handler">
                                                            <i class="md-list-addon-icon material-icons">&#xE5D2;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><a href="#">Information Technology: Software, Hardware, Computer, Developer, Cloud & Engineering</a></span>
                                                            <span class="uk-text-small uk-text-muted">186 Members</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <input name="user_groups_control" id="user_groups_control" type="hidden"/>
                                    </li>
                                    <li>
                                        <ul class="md-list md-list-addon" id="user_todo">
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_0" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Vero nulla dolores labore ipsa assumenda.</span>
                                                    <span class="uk-text-small uk-text-muted">Enim voluptate aliquid animi consequatur alias.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_1" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Beatae ipsam voluptatem provident cum.</span>
                                                    <span class="uk-text-small uk-text-muted">Nostrum et iste saepe vel est.</span>
                                                </div>
                                            </li>
                                            <li class="md-list-item-disabled">
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_2" type="checkbox" data-md-icheck checked/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Nostrum non dignissimos quia beatae.</span>
                                                    <span class="uk-text-small uk-text-muted">Omnis ducimus accusamus fugiat alias tempora aut aut consequatur quae.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_3" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading uk-text-danger">Tenetur iure accusantium ducimus.</span>
                                                    <span class="uk-text-small uk-text-danger">Velit repellendus dolorum neque voluptatem dolor dicta voluptates ipsum quis.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_4" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Sint eum voluptatem esse.</span>
                                                    <span class="uk-text-small uk-text-muted">Officia sit commodi sunt consequatur exercitationem nihil nam.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_5" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Sapiente temporibus expedita.</span>
                                                    <span class="uk-text-small uk-text-muted">Aut eligendi qui et necessitatibus praesentium.</span>
                                                </div>
                                            </li>
                                            <li class="md-list-item-disabled">
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_6" type="checkbox" data-md-icheck checked/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading uk-text-danger">Et et ut blanditiis quo culpa.</span>
                                                    <span class="uk-text-small uk-text-danger">Eaque quia repellendus enim neque rerum praesentium ea.</span>
                                                </div>
                                            </li>
                                            <li class="md-list-item-disabled">
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_7" type="checkbox" data-md-icheck checked/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Exercitationem eligendi saepe nemo mollitia fugit.</span>
                                                    <span class="uk-text-small uk-text-muted">Ut fugiat blanditiis facere voluptatem.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_8" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Maiores sit ut rem.</span>
                                                    <span class="uk-text-small uk-text-muted">Nihil ut tempora quae eius voluptas voluptates et sequi.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_9" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Nesciunt maxime eum.</span>
                                                    <span class="uk-text-small uk-text-muted">Repellendus sit accusamus id eos est et sed sit sed ipsa.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_10" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Vel vitae aliquam in.</span>
                                                    <span class="uk-text-small uk-text-muted">Sit modi possimus harum autem doloribus et quia.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_11" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Voluptate veritatis voluptas aut ab provident.</span>
                                                    <span class="uk-text-small uk-text-muted">Sunt aspernatur nulla dolores placeat aliquid ipsum sed cupiditate eveniet dolores.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_12" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading uk-text-danger">Qui esse debitis.</span>
                                                    <span class="uk-text-small uk-text-danger">Sunt molestias ab placeat quis aliquid quis.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_13" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Id magni eum.</span>
                                                    <span class="uk-text-small uk-text-muted">Ut incidunt ut blanditiis magnam non sunt libero natus.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_14" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Quaerat deleniti illum sequi fugit maiores.</span>
                                                    <span class="uk-text-small uk-text-muted">Maiores facilis error accusantium voluptatibus nostrum vel praesentium optio quisquam repellendus.</span>
                                                </div>
                                            </li>
                                            <li class="md-list-item-disabled">
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_15" type="checkbox" data-md-icheck checked/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Odit alias totam.</span>
                                                    <span class="uk-text-small uk-text-muted">Qui beatae enim debitis sed consequatur.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_16" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Dolores placeat alias reprehenderit.</span>
                                                    <span class="uk-text-small uk-text-muted">Eum et illo tempore et quia quas omnis.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_17" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Officia iste dolorem delectus.</span>
                                                    <span class="uk-text-small uk-text-muted">Nostrum illum quisquam cupiditate dicta quas delectus quisquam.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_18" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Repellendus debitis aut nihil.</span>
                                                    <span class="uk-text-small uk-text-muted">Ab rerum autem quia odit non non.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <input name="todo_item_19" type="checkbox" data-md-icheck/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading uk-text-danger">Amet modi ab dolor.</span>
                                                    <span class="uk-text-small uk-text-danger">Accusamus placeat saepe iste molestiae beatae quia impedit ut beatae ipsam.</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-large-3-10">
                        <div class="md-card">
                            <div class="md-card-content">
                                <h3 class="heading_c uk-margin-medium-bottom">Other settings</h3>
                                <div class="uk-form-row">
                                    <input type="checkbox" checked data-switchery id="user_edit_active" />
                                    <label for="user_edit_active" class="inline-label">User Active</label>
                                </div>
                                <hr class="md-hr">
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="user_edit_role">User Role</label>
                                    <select data-md-selectize>
                                        <option value="">Select...</option>
                                        <option value="admin">Admin</option>
                                        <option value="super_admin">Super Admin</option>
                                        <option value="editor" selected>Editor</option>
                                        <option value="author">Author</option>
                                        <option value="none">None</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
    @section('page-specific-scripts')
        <!-- page specific plugins -->
        <!-- file input -->
        <script src="{{asset('resources/admin/assets/js/custom/uikit_fileinput.min.js')}}"></script>
        <!--  user edit functions -->
        <script src="{{asset('resources/admin/assets/js/pages/page_user_edit.min.js')}}"></script>
    @endsection
@stop