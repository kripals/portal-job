@extends('layouts.frontend.app')
@section('page-specific-styles')
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/frontend/assets/css/bootstrap-datetimepicker.min.css') }}"/>
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/frontend/assets/css/glyphicon.css') }}"/>
@endsection
@section('content')
    @include('layouts.frontend.page-specific-header')

    <!-- End Navigation -->
    <div class="clearfix"></div>

    <!-- Header Title Start -->

    <div class="clearfix"></div>
    <!-- Header Title End -->

    <!-- General Detail Start -->
    <section class="dashboard-wrap">
        <div class="container-fluid">
            <div class="row">
            @include('layouts.frontend.job.job-sidebar',['type' =>'edit'])

            <!-- Content Wrap -->
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-body">
                        <div class="dashboard-caption">
                            <div class="dashboard-caption-header">
                                <h4><i class="ti-id-badge"></i>{{$formTitle}}</h4>
                            </div>
                            <div class="dashboard-caption-wrap">
                                <form class="post-form" action="{{route('company.job.update', $jobDetail->ref_id)}}" method="POST" data-parsley-validate="">
                                    @csrf
                                    @switch($formType)
                                        @case('basic')
                                        @include('frontend.jobs.partials.basic-job-info',['type' =>'edit'])
                                        @break
                                        @case('specification')
                                        @include('frontend.jobs.partials.specification',['type' =>'edit'])
                                        @break
                                        @case('description')
                                        @include('frontend.jobs.partials.description',['type' =>'edit'])
                                        @break
                                        @case('vacancy')
                                        @include('frontend.jobs.partials.vacancy-setting',['type' =>'edit'])
                                        @break
                                        @default
                                    @endswitch
                                </form>
                            </div>
                            <!-- General Detail End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
    <script src="{{asset('resources/frontend/assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(".datetime").datetimepicker({
            format: "dd MM yyyy hh:ii",
            startDate: new Date(),
            autoclose: true,
            minuteStep: 10
        });

        $('#min_salary_currency').on('change',function(){
            var val = $(this).val();
            var child = $('#max_salary_currency');
            child.val(val);
        });
        $('#min_salary_rate').on('change',function(){
            var val = $(this).val();
            var child = $('#max_salary_rate');
            child.val(val);
        });
        $('#min_salary_type').on('change',function(){
            var val = $(this).val();
            var child = $('#max_salary_type');
            if(val == 'above'){
                child.val('below');
            }else if(val == 'below'){
                child.val('above');
            }else{
                child.val(val);
            }
        });
    </script>
@endsection
