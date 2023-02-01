@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
    <!-- General Detail Start -->
    <section class="dashboard-wrap">
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar Wrap -->
            @include('layouts.frontend.company.main-side')
            <!-- Content Wrap -->
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-body">
                        <div class="dashboard-caption">

                            <div class="dashboard-caption-header">
                                <h4><i class="ti-briefcase"></i>All Jobs</h4>
                            </div>
                            <div class="dashboard-caption-wrap">

                                <!-- row -->
                            {{--                                <div class="row">--}}

                            {{--                                    <div class="col-lg-4 col-md-6 col-sm-12">--}}
                            {{--                                        <div class="form-group">--}}
                            {{--                                            <input type="text" class="form-control" placeholder="Search Name">--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}

                            {{--                                    <div class="col-lg-4 col-md-6 col-sm-12">--}}
                            {{--                                        <div class="form-group">--}}
                            {{--                                            <select id="jb-filter" class="form-control">--}}
                            {{--                                                <option>Choose Job Status</option>--}}
                            {{--                                                <option>All Jobs</option>--}}
                            {{--                                                <option>Approved Jobs</option>--}}
                            {{--                                                <option>Expire Jobs</option>--}}
                            {{--                                                <option>Pending Payment</option>--}}
                            {{--                                                <option>Rejected Jobs</option>--}}
                            {{--                                                <option>Draft Jobs</option>--}}
                            {{--                                            </select>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}

                            {{--                                    <div class="col-lg-4 col-md-6 col-sm-12">--}}
                            {{--                                        <div class="form-group">--}}
                            {{--                                            <select id="jb-filter-date" class="form-control">--}}
                            {{--                                                <option>Default Shorting</option>--}}
                            {{--                                                <option>Title</option>--}}
                            {{--                                                <option>Date</option>--}}
                            {{--                                                <option>Modifications</option>--}}
                            {{--                                            </select>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}

                            {{--                                </div>--}}
                            <!-- row -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Posted Jobs</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Expiry Date</th>
                                            <th scope="col">Applicants</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($jobs as $job)
                                            <tr>
                                                <th scope="row">
                                                    <a href="{{route('job.detail',$job->ref_id)}}">
                                                        {{$job->title}}
                                                    </a>@if($job->is_verified == 'yes') <i class="fa fa-check-square-o"></i> @endif
                                                </th>
                                                <td>
                                                    <a href="{{route('category.job',$job->category->slug)}}">{{$job->category->name}}</a>
                                                </td>
                                                <td>{{$job->expiry_date}}</td>
                                                <td>
                                                    <a href="{{route('company.job.applications',$job->ref_id)}}">{{ $job->applicants()->count()}}</a>
                                                </td>
{{--                                                <td>--}}
{{--                                                    <div class="job-buttons">--}}
{{--                                                        <a href="#" class="btn btn-gary manage-btn"--}}
{{--                                                           data-toggle="tooltip" data-placement="top" title=""--}}
{{--                                                           data-original-title="Download Resume"><i--}}
{{--                                                                class="ti-download"></i></a>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
                                                <td>
                                                    <div class="job-buttons">
                                                        <a href="{{route('company.job.edit',$job->ref_id)}}"
                                                           class="btn btn-gary manage-btn" data-toggle="tooltip"
                                                           data-placement="top" title="" data-original-title="Edit Job"><i
                                                                class="ti-pencil-alt"></i></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="job-buttons">
                                                        <a href="{{route('company.job.destroy',$job->ref_id)}}"
                                                           class="btn btn-cancel manage-btn" data-toggle="tooltip"
                                                           data-placement="top" title="" data-original-title="Remove"><i
                                                                class="ti-close"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>
                                                    <p class="text-center">No Jobs have been posted yet. <a
                                                            href="{{route('company.job.create')}}">Post job</a></p>
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    {!! $jobs->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- General Detail End -->
@endsection
