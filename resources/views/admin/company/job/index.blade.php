@extends('layouts.admin.layouts')
@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('resources/admin/css/lightbox.min.css') }}"/>
@endsection

@section('title', 'Company')

@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="card">
                    <div class="card-head">
                        <header class="text-capitalize">Job List For (<a href="{{route('company.show',$company->id)}}">{{$company->company_name}}</a>)</header>
{{--                        <div class="tools">--}}
{{--                            <a class="btn btn-primary ink-reaction" href="{{ route('company.create') }}">--}}
{{--                                <i class="md md-add"></i>--}}
{{--                                Add--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <table id="tableData" class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Vacancy</th>
                                <th>Level</th>
                                <th>Type</th>
                                <th>Expiry</th>
                                <th>Location</th>
                                <th>Applicants</th>
                                <th>Status</th>
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
    <script src="{{ asset('resources/admin/js/lightbox.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#tableData').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('company.job.data',[$company->id,$type])}}',
                columnDefs: [{
                    targets: -1,
                    className: 'text-right'
                }],
                "columns": [
                    { "data": "id",  'visible': false },
                    { "data": "DT_RowIndex",  orderable: true, searchable: false },
                    { "data": "title"},
                    { "data": "job_category"},
                    { "data": "vacancy_number"},
                    { "data": "job_level"},
                    { "data": "job_type"},
                    { "data": "job_expiry"},
                    { "data": "location"},
                    { "data": "applicants"},
                    { "data": "status", orderable: false, searchable: false  },
                    { "data": "actions", orderable: false, searchable: false },
                ],
                order: [ [0, 'desc'] ]
            });
        } );
        </script>
@endsection
