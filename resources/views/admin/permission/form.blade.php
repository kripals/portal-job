

                    <div class="uk-grid" data-uk-grid-margin>
                        {!! csrf_field() !!}
                        <div class="uk-width-medium-2-3">
                            {{--<span class="uk-text-large">Permission</span><br>--}}

                            <div class="uk-form-row uk-margin-medium-top">
                                <label>Display Name</label>
                                <input type="text" class="md-input" name="display_name" id="idDisplayName" value="{{old('display_name', isset($permission->display_name)?$permission->display_name:'')}}"/>
                                <span class="uk-text-danger">{{ $errors->first('display_name') }}</span>
                            </div>
                            <div class="uk-form-row">
                                <label>Description</label>
                                <textarea cols="30" rows="4" name="description" class="md-input">{{old('description', isset($permission->description)?$permission->description:'')}}</textarea>
                            </div>
                            <div class="uk-form-row">
                                <label>Role</label>
                                <input type="text" name="name" class="md-input" id="idName" value="{{old('name', isset($permission->name)?$permission->name:'')}}" readonly/>
                                <span class="uk-text-danger">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <span class="uk-text-large">Setting</span><br>

                            {{--<h3 class="heading_c uk-margin-large-top">Setting</h3>--}}
                            <div class="uk-form-row">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="ukx-width-medium-1-2">
                                        <label for="switch_demo_1" class="inline-label">Status</label>

                                    </div>
                                    <div class="uk-width-medium-1-2">
                                        <input type="checkbox" id="switch_demo_1" name="status" {{ old('status', isset($permission->status) ? $permission->status : '')=='active' ? 'checked':'' }} data-switchery/>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="uk-width-medium-1-1 uk-margin-medium-top">
                            <button type="submit" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                            <a href="{{route('role.index')}}" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light"
                            >Cancel</a>


                        </div>
                    </div>

                    @section('page-specific-scripts')

                        <script type="text/javascript">
                            $('#idDisplayName').keyup(function () {
                                var displayName = $('#idDisplayName').val();
                                var name = "PERMISSION_"+displayName.toUpperCase();
                                $('#idName').val(name)
                            })
                        </script>
                    @endsection


