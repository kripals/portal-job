@extends('layouts.admin.layouts')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/TableTools.min.css') }}"/>
@endsection

@section('title', 'User')

@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="card">
                    <div class="card-head">
                        <header class="text-capitalize">Users</header>
                        <div class="tools">
                            <a class="btn btn-primary ink-reaction" href="{{ route('user.create') }}">
                                <i class="md md-add"></i>
                                Add
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tableData" class="table table-hover">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Image</th>
                                <th>Email Address</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Roles</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('page-specific-scripts')
    <script src="{{ asset('resources/admin/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#tableData').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('user.data')}}',
                columnDefs: [{
                    targets: -1,
                    className: 'text-right'
                }],
                "columns": [
                    {"data": "DT_RowIndex", orderable: false, searchable: false},
                    {"data": "image", orderable: false, searchable: false},
                    {"data": "email"},
                    {"data": "first_name"},
                    {"data": "last_name"},
                    {"data": "roles", orderable: false, searchable: false},
                    {"data": "actions", orderable: false, searchable: false},
                ],
                order: [[0, 'desc']]
            });
        });
    </script>
@endsection


