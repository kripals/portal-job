@extends('layouts.admin.layouts')
@section('title','Dashboard')
@section('content')
    <section>
        <div class="section-body">
            <div class="row">

                <!-- BEGIN ALERT - REVENUE -->
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body no-padding">
                            <div class="alert alert-callout alert-info no-margin">
                                <h1 class="pull-right text-success"><i class="md md-book"></i></h1>
                                <strong class="text-xl">{{$jobs->count()}}</strong><br/>
                                <span class="opacity-50">Jobs</span>
                                <div class="stick-bottom-left-right">
                                    <div class="height-2 sparkline-revenue" data-line-color="#bdc1c1"></div>
                                </div>
                            </div>
                        </div><!--end .card-body -->
                    </div><!--end .card -->
                </div><!--end .col -->
                <!-- END ALERT - REVENUE -->

                <!-- BEGIN ALERT - VISITS -->
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body no-padding">
                            <div class="alert alert-callout alert-warning no-margin">
                                <h1 class="pull-right text-success"><i class="md md-people"></i></h1>
                                <strong class="text-xl">{{$employers->count()}}</strong><br/>
                                <span class="opacity-50">Employers</span>
                                <div class="stick-bottom-right">
                                    <div class="height-1 sparkline-visits" data-bar-color="#e5e6e6"></div>
                                </div>
                            </div>
                        </div><!--end .card-body -->
                    </div><!--end .card -->
                </div><!--end .col -->
                <!-- END ALERT - VISITS -->

                <!-- BEGIN ALERT - BOUNCE RATES -->
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body no-padding">
                            <div class="alert alert-callout alert-danger no-margin">
                                <h1 class="pull-right text-success"><i class="md md-filter-none"></i></h1>
                                <strong class="text-xl">{{$candidates->count()}}</strong><br/>
                                <span class="opacity-50">Job Seekers</span>
                                <div class="stick-bottom-left-right">
                                    <div class="progress progress-hairline no-margin">
                                        <div class="progress-bar progress-bar-danger" style="width:43%"></div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end .card-body -->
                    </div><!--end .card -->
                </div><!--end .col -->
                <!-- END ALERT - BOUNCE RATES -->

                <!-- BEGIN ALERT - TIME ON SITE -->
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body no-padding">
                            <div class="alert alert-callout alert-success no-margin">
                                <h1 class="pull-right text-success"><i class="md md-assignment"></i></h1>
                                <strong class="text-xl">{{$applications->count()}}</strong><br/>
                                <span class="opacity-50">Applications</span>
                            </div>
                        </div><!--end .card-body -->
                    </div><!--end .card -->
                </div><!--end .col -->
                <!-- END ALERT - TIME ON SITE -->
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
@endsection
