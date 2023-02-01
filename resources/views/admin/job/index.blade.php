@extends('layouts.admin.layouts')
@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/admin/DataTables/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('resources/admin/css/lightbox.min.css') }}"/>
@endsection

@section('title', 'Job')

@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="card">
                    <div class="card-head">
                        <header class="text-capitalize">Job</header>
                        <div class="tools">
                            <a class="btn btn-primary ink-reaction" href="{{ route('job.create') }}">
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
                                <th>Company Logo</th>
                                <th>Company Name</th>
                                <th>Title</th>
                                <th>Service</th>
                                <th>Vacancies</th>
                                <th>Level</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Applicants</th>
                                <th>Availability</th>
                                <th>Verified</th>
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
        $(document).ready(function () {
            $('#tableData').DataTable({
                "dom": 'Bfrtip',
                "processing": true,
                "serverSide": true,
                "scrollX": true,
                "lengthMenu": [[50, 100, -1], [50, 100, "All"]],
                "pageLength": "50",
                order: [[0, 'desc']],
                "ajax": '{{ route('job.data')}}',
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
                    {"data": "id", 'visible': false},
                    {"data": "DT_RowIndex", orderable: true, searchable: false},
                    {"data": "company_logo", orderable: false, searchable: false},
                    {"data": "company_name"},
                    {"data": "title"},
                    {"data": "job_service"},
                    {"data": "vacancy_number"},
                    {"data": "job_level"},
                    {"data": "job_type"},
                    {"data": "job_category"},
                    {"data": "applicants"},
                    {"data": "availability"},
                    {"data": "is_verified"},
                    {"data": "status", orderable: false, searchable: false},
                    {"data": "actions", orderable: false, searchable: false},
                ],
                "createdRow": function (row, data) {
                if (data['status_text'] == 'In Active' && data['verified_text'] == 'No') {
                    $(row).addClass('danger');
                }else if(data['job_service'] == 'Government/ Newspaper Job'){
                    $(row).addClass('warning');
                }else{

                }
            }
            });
        });
    </script>
@endsection
