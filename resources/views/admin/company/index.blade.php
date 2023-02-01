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
                        <header class="text-capitalize">Company</header>
                        <div class="tools">
                            <a class="btn btn-primary ink-reaction" href="{{ route('company.create') }}">
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
                                <th>User</th>
                                <th>Logo</th>
                                <th>Company Name</th>
                                <th>Reference Code</th>
                                <th>Email</th>
                                <th>Industry Type</th>
                                <th>Contact Person</th>
                                <th>Contact Number</th>
                                <th>Jobs</th>
{{--                                <th>Visibility</th>--}}
{{--                                <th>Availability</th>--}}
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
        $(document).ready( function () {
            $('#tableData').DataTable({            
                "dom": 'Bfrtip',
                "processing": true,
                "serverSide": true,
                "lengthMenu": [[50, 100, -1], [50, 100, "All"]],
                "scrollX": true,
                "pageLength": "50",
                "order": [ [0, 'desc'] ],
                "ajax": '{{ route('company.data')}}',
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
                    { "data": "associated_user"},
                    { "data": "company_logo", orderable: false, searchable: false  },
                    { "data": "company_name"},
                    { "data": "ref_id"},
                    { "data": "company_email"},
                    { "data": "company_category"},
                    { "data": "contact_person"},
                    { "data": "contact_number"},
                    { "data": "jobs"},
                    // { "data": "visibility" },
                    // { "data": "availability" },
                    { "data": "is_verified" },
                    { "data": "status", orderable: false, searchable: false  },
                    { "data": "actions", orderable: false, searchable: false },
                ],
                "createdRow": function (row, data) {
                    console.log(data);
                if (data['status_text'] == 'In Active' && data['verified_text'] == 'No') {
                    $(row).addClass('danger');
                } else if (data['visibility_text'] == 'Visible') {
                    $(row).addClass('success');
                } else {
                    // $(row).addClass('success');
                }
            }
            });
        } );
        </script>
@endsection
