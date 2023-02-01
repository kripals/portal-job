@extends('layouts.administrator.layouts')
@section('content')

    <div id="page_content">
        <div id="page_content_inner">

            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <i class="md-icon material-icons md-card-fullscreen-activate">&#xE5D0;</i>

                        </div>
                        <h3 class="md-card-toolbar-heading-text">
                            {{--{{$userRoles[0]->user_id}}--}}
                        </h3>
                    </div>
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-nowrap table_check">
                            <thead>
                            <tr>
                                <th class="uk-width-1-10 uk-text-center">S.no</th>
                                <th class="uk-width-1-10 uk-text-center"> Assigned Role</th>
                                <th class="uk-width-1-10 uk-text-center"> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($assignedPermissions->count()>0)
                                @foreach($assignedPermissions as $k=>$assignedPermission)
                                    <tr>
                                        <td class="uk-text-center uk-table-middle small_col">{{++$k}}</td>
                                        <td class="uk-text-center">{{$assignedPermission->name}}</td>
                                        <td class="uk-text-center">
                                            <a href="{{route('role-permission .delete', [Request()->id, $assignedPermission->id])}}"><i class="md-icon material-icons">delete</i>
                                                {{--//delete form here--}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">
                                        Data Not Available
                                    </td>
                                </tr>

                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <i class="md-icon material-icons md-card-fullscreen-activate">&#xE5D0;</i>
                        </div>
                        <h3 class="md-card-toolbar-heading-text">
                            Assign Permission
                        </h3>
                    </div>

                    <div class="uk-overflow-container">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-large-1-1">
                                <form method="POST" action="{{route('role-permission.assign', [$roleId])}}">
                                    {!! csrf_field() !!}
                                    <select id="select_adv_s2_2" name="permissions[]" class="uk-width-1-1" multiple data-md-select2>

                                        @foreach($permissions as $p=>$permission)

                                            <option @if(in_array($permission->id,$savedPermissions)) selected="selected" @endif value="{{$permission->id}}" >{{$permission->display_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="uk-width-medium-1-1 uk-margin-medium-top">
                                        <button type="submit" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                                        <a href="{{route('user.index')}}" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light"
                                        >Cancel</a>
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
