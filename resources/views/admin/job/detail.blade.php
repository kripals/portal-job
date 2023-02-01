@extends('layouts.admin.layouts')

@section('title', $job->title)

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <!-- BEGIN CONTACT DETAILS -->
                <div class="card-tiles">
                    <div class="hbox-md col-md-12">
                        <div class="hbox-column col-md-9">
                            <div class="row">
                                <!-- BEGIN CONTACTS NAV -->
                                <!-- END CONTACTS NAV -->

                                <!-- BEGIN CONTACTS MAIN CONTENT -->
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="margin-bottom-xxl">
                                        <div class="pull-left width-3 clearfix hidden-xs">
                                            <img class="img-circle size-2" src="{{asset($job->company->image_path)}}" alt="" />
                                        </div>
                                        <h1 class="text-light no-margin">{{$job->title}}</h1>
                                        <h5>
                                            {{$job->company->company_name}}
                                            @if($job->is_verified == 'yes')
                                                <span data-uk-tooltip="" title="verified"
                                                      class="label label-success">Verified</span>
                                            @else
                                                <span data-uk-tooltip="" title="verified"
                                                      class="label label-warning">Not verified</span>
                                            @endif
                                            @if($job->status == 'active')
                                                <span data-uk-tooltip="" title="verified"
                                                      class="label label-success">Active</span>
                                            @else
                                                <span data-uk-tooltip="" title="verified"
                                                      class="label label-danger">Inactive</span>
                                            @endif
                                        </h5>
                                    </div><!--end .margin-bottom-xxl -->
                                    <ul class="nav nav-tabs" data-toggle="tabs">
                                        <li class="active"><a href="#info">INFO</a></li>
                                        <li><a href="#specification">SPECIFICATION</a></li>
                                        <li><a href="#description">DESCRIPTION</a></li>
                                    </ul>
                                    <div class="tab-content">

                                        <!-- BEGIN CONTACTS NOTES -->
                                        <div class="tab-pane active" id="info">
                                            <br/>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table no-margin">
                                                        <tbody>
                                                        <tr>
                                                            <td>Job Category</td>
                                                            <td>{{ $job->category->name  ?? 'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Job Service</td>
                                                            <td>{{ $job->job_service->title  ?? 'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Job Level</td>
                                                            <td>{{ $job->job_level->title ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>No of Vacancies</td>
                                                            <td>{{ $job->vacancy_number ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Job Type</td>
                                                            <td>{{ $job->job_type->title ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Expiry Date</td>
                                                            <td>{{ prettyDate($job->end_date) ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Job Location</td>
                                                            <td>{{ $job->location ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Minimum Offered Salary</td>
                                                            <td>{{ $job->minimum_salary ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Maximum Offered Salary</td>
                                                            <td>{{ $job->maximum_salary ?? 'N/A' }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                </div>
                                            </div>
                                        </div><!--end #notes -->
                                        <!-- END CONTACTS NOTES -->

                                        <!-- BEGIN CONTACTS ACTIVITY -->
                                        <div class="tab-pane" id="specification">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table no-margin">
                                                        <tbody>
                                                        <tr>
                                                            <td>Education Specific</td>
                                                            <td>{{ ucwords($job->education_requirement)  ?? 'N/A'}}</td>
                                                            <td>{{ ucwords($job->education_level)  ?? 'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Experience Specific</td>
                                                            <td>{{ ucwords($job->experience_requirement)  ?? 'N/A'}}</td>
                                                            <td>{{ ucwords($job->experience_text)  ?? 'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Skill Specific</td>
                                                            <td>{{ ucwords($job->skill_requirement)  ?? 'N/A'}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="col-sm-12">
                                                        <h3 class="opacity-50">Specification</h3>
                                                        <article class="text-columns-1">
                                                            {!! $job->specification !!}
                                                        </article>
                                                    </div>
                                                    <br/>
                                                </div>
                                            </div>
                                        </div><!--end #activity -->
                                        <!-- END CONTACTS ACTIVITY -->

                                        <!-- BEGIN CONTACTS DETAILS -->
                                        <div class="tab-pane" id="description">
                                            <h3 class="opacity-50">Description</h3>
                                            <article class="text-columns-1">
                                                {!! $job->description !!}
                                            </article>
                                        </div><!--end #details -->
                                        <!-- END CONTACTS DETAILS -->

                                    </div><!--end .tab-content -->
                                </div><!--end .col -->
                                <!-- END CONTACTS MAIN CONTENT -->

                            </div><!--end .row -->
                        </div><!--end .hbox-column -->

                        <!-- BEGIN CONTACTS COMMON DETAILS -->
                        <div class="hbox-column col-md-3 style-default-light">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>Company Contact info</h4>
                                    <br/>
                                    <dl class="dl-horizontal dl-icon">
                                        <dt><span class="fa fa-fw fa-envelope-square fa-lg opacity-50"></span></dt>
                                        <dd>
                                            <span class="opacity-50">Registered Email</span><br/>
                                            <a class="text-medium" href="">{{$company->user->email}}</a>
                                        </dd>
                                        <dt><span class="fa fa-fw fa-mobile fa-lg opacity-50"></span></dt>
                                        <dd>
                                        <span class="opacity-50">Phone</span><br/>
                                            @if($contactDetails)
                                                @foreach($contactDetails as $contactDetail)
                                                    <span class="text-medium">{{$contactDetail->detail_value}}</span>
                                                    &nbsp;<span
                                                        class="opacity-50">{{ucwords($contactDetail->detail_key)}}</span>
                                                    <br/>
                                                @endforeach
                                            @endif
                                        </dd>
                                        <dt><span class="fa fa-fw fa-location-arrow fa-lg opacity-50"></span></dt>
                                        <dd>
                                            <span class="opacity-50">Address</span><br/>
                                            <span class="text-medium">{{$company->address}}</span>
                                        </dd>
                                    </dl><!--end .dl-horizontal -->
                                </div><!--end .col -->
                            </div><!--end .row -->
                        </div><!--end .hbox-column -->
                        <!-- END CONTACTS COMMON DETAILS -->

                    </div><!--end .hbox-md -->
                </div><!--end .card-tiles -->
                <!-- END CONTACT DETAILS -->

            </div><!--end .card -->
        </div><!--end .section-body -->
    </section>
@endsection



