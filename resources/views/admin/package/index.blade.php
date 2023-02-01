@extends('layouts.admin.layouts')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/TableTools.min.css') }}"/>
@endsection

@section('title', 'Package')

@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="card">
                    <div class="card-head">
                        <header class="text-capitalize">{{$type}} Package</header>
                        <div class="tools">
                            <a class="btn btn-primary ink-reaction" href="{{ route('package.create',$type) }}">
                                <i class="md md-add"></i>
                                Add
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($type == 'job')
                            <table id="tableData" class="table renew-column hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>Display Type</th>
                                    <th>Days</th>
                                    <th>Rate</th>
                                    <th>Expiry</th>
                                    <th>Status</th>
                                    <th>Visibility</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        @endif
                        @if($type == 'resume')
                            <table id="tableData2" class="table renew-column hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>CV</th>
                                    <th>Rate</th>
                                    <th>Expiry</th>
                                    <th>Status</th>
                                    <th>Visibility</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        @endif
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
                "ajax": '{{ route('package.data',$type) }}',
                columnDefs: [{
                    targets: -1,
                    className: 'text-right'
                }],
                "columns": [
                    {"data": "id", 'visible': false},
                    {"data": "DT_RowIndex", orderable: false, searchable: false},
                    {"data": "title"},
                    {"data": "display_type"},
                    {"data": "quantity"},
                    {"data": "rate"},
                    {"data": "expiry"},
                    {"data": "status"},
                    {"data": "visibility"},
                    {"data": "actions", orderable: false, searchable: false},
                ],
                order: [[0, 'desc']]
            });
            $('#tableData2').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('package.data',$type) }}',
                columnDefs: [{
                    targets: -1,
                    className: 'text-right'
                }],
                "columns": [
                    {"data": "id", 'visible': false},
                    {"data": "DT_RowIndex", orderable: false, searchable: false},
                    {"data": "title"},
                    {"data": "quantity"},
                    {"data": "rate"},
                    {"data": "expiry"},
                    {"data": "status"},
                    {"data": "visibility"},
                    {"data": "actions", orderable: false, searchable: false},
                ],
                order: [[0, 'desc']]
            });
        });
    </script>
@endsection


