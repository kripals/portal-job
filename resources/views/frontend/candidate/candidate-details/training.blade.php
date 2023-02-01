@extends('frontend.candidate.layouts.layout')

@section('page-specific-styles')
    <link href="{{ asset('resources/admin/css/theme-default/libs/bootstrap-datepicker/datepicker3.css?1424887858') }}"
          rel="stylesheet">
@endsection

@section('candidate-content')

    <div class="dashboard-caption-header">
        <h4><i class="ti-blackboard"></i>Training</h4>
    </div>

    <div class="dashboard-caption-wrap">
        <form class="form form-validate floating-label" action="{{route('candidate.store.training', $candidate)}}"
              method="POST" enctype="multipart/form-data"  data-parsley-validate="">
            @method('POST')
            @csrf
            @if(!$trainings->isEmpty())
                <div class="clonedInput trainings" id="removeId1" data-fieldname="trainings">
                    <div class="appendTraining" id="clonedInput">
                        @foreach($trainings as $training)
                            <div id="parentId">
                                <input type="hidden" name="trainings_ref_id[]" value="{{$training->ref_id}}">
                                <div class="row">
                                    @if(!$loop->first)
                                        <hr>
                                        <div class="col-md-1" style="float: right">
                                            <div class="form-group">
                                                <button class="btn btn-danger removeThis"
                                                        data-url="{{route('candidate.front.removeFields')}}"
                                                        data-item-name="trainings" data-ref-id="{{$training->ref_id}}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Name of Training*</label>
                                        <input type="text" name="training_name[]" class="form-control"
                                               value="{{ old('name', isset($training->name) ? $training->name : '') }}" placeholder="Enter the training achieved Eg: Computer Course" required/>
                                    </div>
                                </div>
                            </div>
                            <!-- row -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Institution Name*</label>
                                        <input type="text" name="training_agency_name[]" class="form-control" placeholder="Enter name of the institute the training was achieved"
                                               value="{{ old('agency_name', isset($training->agency_name) ? $training->agency_name : '') }}" required/>
                                    </div>
                                </div>
                            </div>
                            <!-- row -->
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="input-daterange form-group date-range" id="demo-date-range">
                                        <label>Start Date (From)*</label>
                                        <input type="text" class="form-control training_period" name="training_start_date[]"
                                               value="{{ old('start_date', isset($training->start_date) ? $training->start_date : '') }}" placeholder="DD Month YYYY" onkeydown="return false" required/>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="input-daterange form-group date-range" id="demo-date-range">
                                        <label>End Date (To)*</label>
                                        <input type="text" class="form-control training_period" name="training_end_date[]"
                                               value="{{ old('end_date', isset($training->end_date) ? $training->end_date : '') }}" placeholder="DD Month YYYY" onkeydown="return false" required/>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
{{--                <div class="clonedInput trainings" id="removeId1" data-fieldname="trainings">--}}
{{--                    <div class="appendTraining" id="clonedInput">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Name of Training*</label>--}}
{{--                                    <input type="text" name="training_name[]" class="form-control"--}}
{{--                                           value="{{ old('name', isset($training->name) ? $training->name : '') }}" required/>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- row -->--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Institution Name*</label>--}}
{{--                                    <input type="text" name="training_agency_name[]" class="form-control"--}}
{{--                                           value="{{ old('agency_name', isset($training->agency_name) ? $training->agency_name : '') }}" required/>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- row -->--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-3 col-md-3 col-sm-12">--}}
{{--                                <div class="input-daterange form-group date-range" id="demo-date-range">--}}
{{--                                    <label>Start Date (From)*</label>--}}
{{--                                    <input type="text" class="form-control training_period" name="training_start_date[]"--}}
{{--                                           value="{{ old('start_date', isset($training->start_date) ? $training->start_date : '') }}" required/>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-3 col-md-3 col-sm-12">--}}
{{--                                <div class="input-daterange form-group date-range" id="demo-date-range">--}}
{{--                                    <label>End Date (To)*</label>--}}
{{--                                    <input type="text" class="form-control training_period" name="training_end_date[]"--}}
{{--                                           value="{{ old('end_date', isset($training->end_date) ? $training->end_date : '') }}" required/>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            @endif

            <div class="dynamicAddBtn">
                <button type="button" class="btn btn-success createCandidateClone" data-clone=".trainings" data-fieldname="trainings"
                        data-appendto=".appendTraining"><i class="fa fa-plus"></i> Add Training
                </button>
            </div>

            <div class="row mrg-top-30">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group text-center">
                        <button type="submit" class="btn-savepreview">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- General Detail End -->
@endsection

@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script>
        $('body').on('focus', ".training_period", function () {
            $(this).datepicker({
                format: "dd MM yyyy",
                autoclose: true
            });
        });
    </script>
@endsection





