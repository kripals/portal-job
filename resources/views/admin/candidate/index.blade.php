@extends('layouts.admin.layouts')
@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('resources/admin/css/lightbox.min.css') }}"/>
@endsection

@section('title', 'Candidate')

@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="card">
                    <div class="card-head">
                        <header class="text-capitalize">Candidate</header>
                        <div class="tools">
                            <a class="btn btn-primary ink-reaction" href="{{ route('candidate.create') }}">
                                <i class="md md-add"></i>
                                Add
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tableData" class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>S.No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Ref ID</th>
                                <th>Contact</th>
                                <th>Preference</th>
                                <th>Experience</th>
                                <th>Job Level</th>
                                <th>Jobs Applied</th>
                                <th>Availability</th>
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
                "dom": 'Bfrtip',
                "processing": true,
                "serverSide": true,
                "lengthMenu": [[50, 100, -1], [50, 100, "All"]],
                "pageLength": "50",
                "scrollX": true,
                scroller:    true,
                "order": [ [0, 'desc'] ],
                "ajax": '{{ route('candidate.data')}}',
                columnDefs: [{
                    targets: -1,
                    className: 'text-right'
                }],
                "buttons": [
                    'pageLength', 'colvis',
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible'
                        },
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ],
                "colVis": {
                    exclude: [1, 2]
                },
                "columns": [
                    { "data": "id",  'visible': false },
                    { "data": "DT_RowIndex",  orderable: true, searchable: false },
                    { "data": "candidate_image", orderable: false, searchable: false  },
                    { "data": "candidate_name"},
                    { "data": "ref_id"},
                    { "data": "contact_number"},
                    { "data": "company_category"},
                    { "data": "experience_period"},
                    { "data": "job_level"},
                    { "data": "jobs_applied"},
                    { "data": "availability" },
                    { "data": "status", orderable: false, searchable: false  },
                    { "data": "actions", orderable: false, searchable: false },
                ],
                "createdRow": function (row, data) {
                if (data['status_text'] == 'In Active' && data['is_verified'] == 'no') {
                    $(row).addClass('danger');
                } else if (data['visibility'] == 'visible') {
                    $(row).addClass('success');
                } else {
                    // $(row).addClass('success');
                }
            }

            });
        } );
        </script>
@endsection
