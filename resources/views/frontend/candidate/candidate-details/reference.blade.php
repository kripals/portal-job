@extends('frontend.candidate.layouts.layout')

@section('candidate-content')

    <div class="dashboard-caption-header">
        <h4><i class="ti-pencil-alt"></i>Reference</h4>
    </div>

    <div class="dashboard-caption-wrap">
        <form class="form form-validate floating-label" action="{{route('candidate.store.reference', $candidate)}}"
              method="POST" enctype="multipart/form-data" data-parsley-validate="">
            @csrf
            @if(!$references->isEmpty())
                <div class="clonedInput references" id="removeId1" data-fieldname="references">
                    <div class="appendReference" id="clonedInput">
                        @foreach($references as $reference)
                            <div id="parentId">
                                <input type="hidden" name="references_ref_id[]" value="{{$reference->ref_id}}">
                                <div class="row">
                                    @if(!$loop->first)
                                        <hr>
                                        <div class="col-md-1" style="float: right">
                                            <button class="btn btn-danger removeThis"
                                                    data-url="{{route('remove.candidateFields')}}"
                                                    data-item-name="references" data-ref-id="{{$reference->ref_id}}"><i
                                                        class="fa fa-trash"></i></button>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Reference's Name*</label>
                                            <input type="text" name="reference_name[]" class="form-control" required
                                                   value="{{ old('name', isset($reference->name) ? $reference->name : '') }}" placeholder="Full name of the reference"/>
                                            <span id="textarea1-error"
                                                  class="text-danger">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Organization Name*</label>
                                            <input type="text" name="reference_company_name[]" class="form-control"
                                                   value="{{ old('company_name', isset($reference->company_name) ? $reference->company_name : '') }}" placeholder="Name of Organization" required/>
                                            <span id="textarea1-error"
                                                  class="text-danger">{{ $errors->first('company_name') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- row -->
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Designation*</label>
                                            <input type="text" name="reference_designation[]" class="form-control"
                                                   id="number2" placeholder="Designation of reference"
                                                   value="{{ old('designation', isset($reference->designation) ? $reference->designation : '') }}" required/>
                                            <span id="textarea1-error"
                                                  class="text-danger">{{ $errors->first('designation') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Email*</label>
                                            <input type="text" name="reference_email[]" class="form-control" placeholder="Email of reference"
                                                   value="{{ old('email', isset($reference->email) ? $reference->email : '') }}" required/>
                                            <span id="textarea1-error"
                                                  class="text-danger">{{ $errors->first('email') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- row -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Contact Number*</label>
                                            <input type="text" name="reference_phone[]" class="form-control" placeholder="Contact number of reference Eg:98xxxxxxxx"
                                                   value="{{ old('phone', isset($reference->phone) ? $reference->phone : '') }}" required/>
                                            <span id="textarea1-error"
                                                  class="text-danger">{{ $errors->first('phone') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Alternate Number</label>
                                            <input type="text" name="reference_phone2[]" class="form-control" placeholder="Contact number of reference Eg:98xxxxxxxx"
                                                   value="{{ old('phone', isset($reference->phone2) ? $reference->phone2 : '') }}"/>
                                            <span id="textarea1-error"
                                                  class="text-danger">{{ $errors->first('phone2') }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
{{--                <div class="clonedInput references" id="removeId1" data-fieldname="references">--}}
{{--                    <div class="appendReference" id="clonedInput">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Reference's Name*</label>--}}
{{--                                    <input type="text" name="reference_name[]" class="form-control"--}}
{{--                                           value="{{ old('name', isset($reference->name) ? $reference->name : '') }}" required/>--}}
{{--                                    <span id="textarea1-error"--}}
{{--                                          class="text-danger">{{ $errors->first('name') }}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- row -->--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Organization Name*</label>--}}
{{--                                    <input type="text" name="reference_company_name[]" class="form-control"--}}
{{--                                           value="{{ old('company_name', isset($reference->company_name) ? $reference->company_name : '') }}" required/>--}}
{{--                                    <span id="textarea1-error"--}}
{{--                                          class="text-danger">{{ $errors->first('company_name') }}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- row -->--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Designation*</label>--}}
{{--                                    <input type="text" name="reference_designation[]" class="form-control" id="number2"--}}
{{--                                           value="{{ old('designation', isset($reference->designation) ? $reference->designation : '') }}" required/>--}}
{{--                                    <span id="textarea1-error"--}}
{{--                                          class="text-danger">{{ $errors->first('designation') }}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Email*</label>--}}
{{--                                    <input type="text" name="reference_email[]" class="form-control"--}}
{{--                                           value="{{ old('email', isset($reference->email) ? $reference->email : '') }}" required/>--}}
{{--                                    <span id="textarea1-error"--}}
{{--                                          class="text-danger">{{ $errors->first('email') }}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- row -->--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-3 col-md-3 col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Contact Number*</label>--}}
{{--                                    <input type="text" name="reference_phone[]" class="form-control"--}}
{{--                                           value="{{ old('phone', isset($reference->phone) ? $reference->phone : '') }}" required/>--}}
{{--                                    <span id="textarea1-error"--}}
{{--                                          class="text-danger">{{ $errors->first('phone') }}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-3 col-md-3 col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Alternate Number</label>--}}
{{--                                    <input type="text" name="reference_phone2[]" class="form-control"--}}
{{--                                           value="{{ old('phone', isset($reference->phone2) ? $reference->phone2 : '') }}"/>--}}
{{--                                    <span id="textarea1-error"--}}
{{--                                          class="text-danger">{{ $errors->first('phone2') }}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-6 col-md-6 col-sm-12">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            @endif
            <div class="dynamicAddBtn">
                <button type="button" class="btn btn-success createCandidateClone" data-clone=".references" data-fieldname="references"
                        data-appendto=".appendReference"><i class="fa fa-plus"></i> Add Another Reference
                </button>
            </div>
            <!-- row -->
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

@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
@endsection
