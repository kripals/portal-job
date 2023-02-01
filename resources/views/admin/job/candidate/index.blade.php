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
                        <header class="text-capitalize">Candidates for Job (<a href="{{route('job.show',$job->id)}}">{{$job->title}}</a>)</header>
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
{{--                                <th>Address</th>--}}
                                <th>Contact</th>
                                <th>Preference</th>
                                <th>Experience</th>
                                <th>Job Level</th>
                                <th>Jobs Applied</th>
                                <th>Visibility</th>
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
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('job.candidate.data',$job->id)}}',
                columnDefs: [{
                    targets: -1,
                    className: 'text-right'
                }],
                "columns": [
                    { "data": "id",  'visible': false },
                    { "data": "DT_RowIndex",  orderable: true, searchable: false },
                    { "data": "candidate_image"},
                    { "data": "candidate_name"},
                    // { "data": "current_address"},
                    { "data": "contact_number"},
                    { "data": "company_category"},
                    { "data": "experience_period"},
                    { "data": "job_level"},
                    { "data": "jobs_applied"},
                    { "data": "visibility" },
                    { "data": "availability" },
                    { "data": "status", orderable: false, searchable: false  },
                    { "data": "actions", orderable: false, searchable: false },

                ],
                order: [ [0, 'desc'] ]
            });
        } );
        </script>
@endsection
