@extends('layouts.admin.layouts')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/TableTools.min.css') }}"/>
@endsection

@section('title', 'Newsletter Subscription')

@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="card">
                    <div class="card-head">
                        <header class="text-capitalize">Newsletter Subscription</header>
{{--                        <div class="tools">--}}
{{--                            <a class="btn btn-primary ink-reaction" href="{{ route('job-level.create') }}">--}}
{{--                                <i class="md md-add"></i>--}}
{{--                                Add--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <table id="tableData" class="table renew-column hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>S.No.</th>
                                <th>Title</th>
                                <th>Status</th>
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
        $(document).ready( function () {
            $('#tableData').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('subscribe.data') }}',
                "columns": [
                    { "data": "id",  'visible': false },
                    { "data": "DT_RowIndex",  orderable: false, searchable: false },
                    { "data": "email" },
                    { "data": "status" }
                ],
                order: [ [0, 'desc'] ]
            });
        } );
    </script>
@endsection


