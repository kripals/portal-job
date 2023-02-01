@extends('frontend.candidate.layouts.layout')
@section('page-specific-styles')
    <link href="{{ asset('resources/admin/css/libs/dropify/dropify.min.css') }}" rel="stylesheet">
@endsection

@section('candidate-content')

    <div class="dashboard-caption-header">
        <h4><i class="ti-ruler-pencil"></i>Other Details</h4>
    </div>

    <div class="dashboard-caption-wrap">
        <form class="form form-validate floating-label "
              action="{{route('candidate.store.others',$candidate)}}"
              method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="card-head setting-list">
                <div class="side-label">
                    <div class="label-head">
                        <span>Are you willing to travel outside of your residing location during the job? </span>
                    </div>
                    <div class="label-body">
                        <input type="checkbox" id="switch_demo_1" name="travel_outside"
                               {{ old('travel_outside', isset($candidate->travel_outside) ? $candidate->travel_outside : '')=='yes' ? 'checked':'' }} data-switchery/>
                    </div>
                </div>
                <div class="side-label">
                    <div class="label-head">
                        <span>Are you willing to temporarily relocate outside of your residing location during the job period? </span>
                    </div>
                    <div class="label-body">
                        <input type="checkbox" id="switch_demo_2" name="relocate_location"
                               {{ old('relocate_location', isset($candidate->relocate_location) ? $candidate->relocate_location : '')=='yes' ? 'checked':'' }} data-switchery/>
                    </div>
                </div>
                <div class="side-label">
                    <div class="label-head">
                        <span>Do you have Two wheeler License?</span>
                    </div>
                    <div class="label-body">
                        <input type="checkbox" id="switch_demo_3" name="two_wheeler_license"
                               {{ old('two_wheeler_license', isset($candidate->two_wheeler_license) ? $candidate->two_wheeler_license : '')=='yes' ? 'checked':'' }} data-switchery/>
                    </div>
                </div>
                <div class="side-label">
                    <div class="label-head">
                        <span>Do you have Four wheeler License?</span>
                    </div>
                    <div class="label-body">
                        <input type="checkbox" id="switch_demo_4" name="four_wheeler_license"
                               {{ old('four_wheeler_license', isset($candidate->four_wheeler_license) ? $candidate->four_wheeler_license : '')=='yes' ? 'checked':'' }} data-switchery/>
                    </div>
                </div>
                <div class="side-label">
                    <div class="label-head">
                        <span>Do you have Two wheeler Vehicle?</span>
                    </div>
                    <div class="label-body">
                        <input type="checkbox" id="switch_demo_5" name="two_wheeler_vehicle"
                               {{ old('two_wheeler_vehicle', isset($candidate->two_wheeler_vehicle) ? $candidate->two_wheeler_vehicle : '')=='yes' ? 'checked':'' }} data-switchery/>
                    </div>
                </div>
                <div class="side-label">
                    <div class="label-head">
                        <span>Do you have Four wheeler Vehicle?</span>
                    </div>
                    <div class="label-body">
                        <input type="checkbox" id="switch_demo_6" name="four_wheeler_vehicle"
                               {{ old('four_wheeler_vehicle', isset($candidate->four_wheeler_vehicle) ? $candidate->four_wheeler_vehicle : '')=='yes' ? 'checked':'' }} data-switchery/>
                    </div>
                </div>
            </div>

            <!-- row -->
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

