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
                            Permission
                        </h3>
                    </div>
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-nowrap table_check">
                            <thead>
                            <tr>
                                <th class="uk-width-1-10 uk-text-center">S.no</th>
                                <th class="uk-width-1-10 uk-text-center"> Permission</th>
                                <th class="uk-width-2-10 uk-text-center">Display Name</th>
                                <th class="uk-width-2-10 uk-text-center">Status</th>
                                <th class="uk-width-1-10 uk-text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($permissions->count()>0)
                                @foreach($permissions as $k=>$permission)
                            <tr>
                                <td class="uk-text-center uk-table-middle small_col">{{++$k}}</td>
                                <td class="uk-text-center">{{$permission->name}}</td>
                                <td class="uk-text-center">{{$permission->display_name}}</td>
                                <td class="uk-text-center"><span class="uk-badge {{getLabel($permission->status)}}">{{$permission->status_text}}</span></td>
                                <td class="uk-text-center">
                                    @if($permission->is_deleted == 'no')
                                    <a href="{{route('permission.edit', [$permission->id])}}"><i class="md-icon material-icons">&#xE254;</i></a>
                                        <a href="{{route('permission.destroy', [$permission->id])}}">
                                            {!! delete_form(route('permission.destroy', [$permission->id]))!!}
                                        </a>
                                        @else
                                        <span class="uk-badge">trashed</span>
                                    @endif
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
                    <ul class="pagination justify-content-center">
                        {!! $permissions->render() !!}
                    </ul>
                </div>
            </div>
        </div>
        <div class="md-fab-wrapper md-fab-in-card" style="position:fixed;">
            <a class="md-fab md-fab-success md-fab-wave-light" href="{{route('permission.create')}}"><i class="material-icons">add</i></a>
        </div>
    </div>
    <script>
        function sweetAlert(){
            swal({
                title: "Good job!",
                text: "You clicked the button!",
                icon: "success",
            });
        }

    </script>
@stop
