@extends('layouts.admin.layouts')

@section('title', $company->company_name)

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
                                <div class="col-sm-5 col-md-4 col-lg-3">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li><small>JOBS</small></li>
                                        <li><a href="{{route('company.job',$company->id)}}">All Jobs <small
                                                    class="pull-right text-bold opacity-75">{{$jobs->count()}}</small></a>
                                        </li>
                                        <li><a href="{{route('company.job',$company->id)}}?type=active">Active Jobs <small
                                                    class="pull-right text-bold opacity-75">{{$activeJobs->count()}}</small></a></li>
{{--                                        <li><a href="{{route('company.candidate',$company->id)}}">Applicants<small--}}
{{--                                                    class="pull-right text-bold opacity-75">{{$candidates->count()}}</small></a></li>--}}
                                        <li class="hidden-xs"><small>Recent Posts</small></li>
                                        @if($recentJobs)
                                            @foreach($recentJobs as $job)
                                                <li class="hidden-xs focus">
                                                    <a href="{{route('job.show',$job->id)}}">
                                                        {{--                                                <img class="img-circle img-responsive pull-left width-1"--}}
                                                        {{--                                                     src="{{asset('resources/admin/img/avatar7.jpg?1404026721')}}"--}}
                                                        {{--                                                     alt=""/>--}}
                                                        <span class="text-medium">{{$job->title}}</span><br/>
                                                        <span class="opacity-50">
																<span class="glyphicon glyphicon-phone text-sm"></span> &nbsp;{{$job->category->name}}
															</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div><!--end .col -->
                                <!-- END CONTACTS NAV -->

                                <!-- BEGIN CONTACTS MAIN CONTENT -->
                                <div class="col-sm-7 col-md-8 col-lg-9">
                                    <div class="margin-bottom-xxl">
                                        <div class="pull-left width-3 clearfix hidden-xs">
                                            <img class="img-circle size-2" src="{{asset($company->image_path)}}"
                                                 alt=""/>
                                        </div>
                                        <h1 class="text-light no-margin">{{$company->company_name}}</h1>
                                        <h5>
                                            {{$company->category->name}}
                                            @if($company->is_verified == 'yes')
                                                <span data-uk-tooltip="" title="verified"
                                                      class="label label-success">Verified</span>
                                            @else
                                                <span data-uk-tooltip="" title="verified"
                                                      class="label label-warning">Not verified</span>
                                            @endif
                                            @if($company->status == 'active')
                                                <span data-uk-tooltip="" title="verified"
                                                      class="label label-success">Active</span>
                                            @else
                                                <span data-uk-tooltip="" title="verified"
                                                      class="label label-danger">Inactive</span>
                                            @endif
                                        </h5>
                                    </div><!--end .margin-bottom-xxl -->
                                    <ul class="nav nav-tabs" data-toggle="tabs">
                                        <li class="active"><a href="#basic-info">Basic Info</a></li>
                                        <li><a href="#contact-details">Contact Details</a></li>
                                        <li><a href="#contact-persons">Contact Persons</a></li>
                                        <li><a href="#social-media">Social Medias</a></li>
                                        <li><a href="#other">Other</a></li>
                                    </ul>
                                    <div class="tab-content">

                                        <!-- BEGIN CONTACTS NOTES -->
                                        <div class="tab-pane active" id="basic-info">
                                            <br/>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="opacity-50">Summary</h3>
                                                    <article class="text-columns-2">
                                                        {!! str_replace('&nbsp;',' ',$company->description) !!}
                                                    </article>
                                                </div>
                                                <br/>
                                                <div class="col-sm-12">
                                                    <table class="table no-margin">
                                                        <tbody>
                                                        <tr>
                                                            <td>Registration Number</td>
                                                            <td>{{ $company->company_reg_no }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Company Size</td>
                                                            <td>{{ $company->company_size }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ownership</td>
                                                            <td>{{ $company->ownership }}</td>
                                                        <tr>
                                                            <td>Website</td>
                                                            <td>{{ $company->website }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div><!--end #notes -->
                                        <!-- END CONTACTS NOTES -->

                                        <!-- BEGIN CONTACTS ACTIVITY -->
                                        <div class="tab-pane" id="contact-details">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table no-margin">
                                                        <tbody>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>{{$company->address}}</td>
                                                        </tr>
                                                        @if($contactDetails)
                                                            @foreach($contactDetails as $detail)
                                                                <tr>
                                                                    <td>{{ucwords($detail->detail_key)}}</td>
                                                                    <td>{{$detail->detail_value}}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div><!--end #activity -->
                                        <!-- END CONTACTS ACTIVITY -->

                                        <!-- BEGIN CONTACTS DETAILS -->
                                        <div class="tab-pane" id="contact-persons">
                                            @if($contactPersons)
                                                <div class="list-results">
                                                    @foreach($contactPersons as $contactPerson)
                                                        <div class="col-xs-12 col-lg-12 hbox-xs">
                                                            <div class="hbox-column v-top">
                                                                <div class="clearfix">
                                                                    <div class="col-lg-12 margin-bottom-lg">
                                                                        <a class="text-lg text-medium"
                                                                           href="#">{{$contactPerson->person_name}}</a>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix opacity-75">
                                                                    <div class="col-md-5">
                                                                        <span
                                                                            class="glyphicon glyphicon-phone text-sm"></span>
                                                                        &nbsp;{{$contactPerson->person_number}}
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                <span
                                                                    class="glyphicon glyphicon-envelope text-sm"></span>
                                                                        &nbsp;{{$contactPerson->person_email}}
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix">
                                                                    <div class="col-lg-12">
                                                                <span class="opacity-75"><span
                                                                        class="glyphicon glyphicon-map-marker text-sm"></span> &nbsp;{{$contactPerson->person_designation}}</span>
                                                                    </div>
                                                                </div>
                                                            </div><!--end .hbox-column -->
                                                        </div><!--end .hbox-xs -->
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div><!--end #details -->
                                        <!-- END CONTACTS DETAILS -->

                                        <div class="tab-pane" id="social-media">
                                            @if($socialMedias)
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table class="table no-margin">
                                                            <thead>
                                                            <tr>
                                                                <th>Media Name</th>
                                                                <th>URL</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($socialMedias as $socialMedia)
                                                                <tr>
                                                                    <td>{{ucfirst($socialMedia->media_key)}}</td>
                                                                    <td>{{$socialMedia->media_value}}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                        </div><!--end #activity -->
                                        <div class="tab-pane" id="other">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table no-margin">
                                                        <tbody>
                                                        <tr>
                                                            <td>Keywords</td>
                                                            <td>{{$company->keywords}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div><!--end #activity -->
                                    </div><!--end .tab-content -->
                                </div><!--end .col -->
                                <!-- END CONTACTS MAIN CONTENT -->

                            </div><!--end .row -->
                        </div><!--end .hbox-column -->

                        <!-- BEGIN CONTACTS COMMON DETAILS -->
                        <div class="hbox-column col-md-3 style-default-light">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>Contact info</h4>
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
                                            <span class="text-medium">
														{{$company->address}}
													</span>
                                        </dd>
                                        {{--                                        <dd class="full-width"><div id="map-canvas" class="border-white border-xl height-5"></div></dd>--}}
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



