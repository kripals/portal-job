@extends('layouts.admin.layouts')
@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('resources/admin/css/theme-default/libs/select2/select2.css?1424887856') }}"/>
@endsection

@section('title', 'Manage Roles')

@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <form class="form" method="POST" action="{{route('user-role.assign', [$user->id])}}">
                            <div class="card-body">
                                <div class="form-group">
                                    @csrf
                                    <select class="form-control select2-list" name="role[]"
                                            data-placeholder="Select an item"
                                            multiple>
                                        @foreach($roles as $r=>$role)
                                            <option @if(in_array($role->id,$savedRoles)) selected="selected"
                                                    @endif value="{{$role->id}}">{{$role->display_name}}</option>
                                        @endforeach
                                    </select>
                                    <label>Assign Roles</label>
                                </div>
                            </div>
                            <div class="card-actionbar page-bar">
                                <div class="card-actionbar-row">
                                    <input type="submit" name="pageSubmit" class="btn btn-info ink-reaction"
                                    value="Save">
                                    <a class="btn btn-default btn-ink" href="{{route('user.index')}}">
                                        <i class="md md-arrow-back"></i>
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <table id="tableData" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th class="text-center">Assigned Role</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($userRoles->count()>0)
                                    @foreach($userRoles as $k=>$userRole)
                                        <tr>
                                            <td>{{++$k}}</td>
                                            <td class="text-center">{{$userRole->name}}</td>
                                            <td class="text-right">
                                                <a href="{{route('user-role.delete', [Request()->id, $userRole->id])}}"><i
                                                        class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Data Not Available
                                        </td>
                                    </tr>

                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('page-specific-scripts')
    <script src="{{asset('resources/admin/js/core/demo/DemoFormComponents.js')}}"></script>
    <script src="{{ asset('resources/admin/js/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/multi-select/jquery.multi-select.js') }}"></script>
@endsection
