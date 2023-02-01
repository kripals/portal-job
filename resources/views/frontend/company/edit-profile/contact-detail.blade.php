@extends('layouts.frontend.app')

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
                @include('layouts.frontend.company.edit-profile-sidebar')
                <!-- Content Wrap -->
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-body">
                        <div class="dashboard-caption">
                            <div class="dashboard-caption-header">
                                <h4><i class="ti-ruler-pencil"></i>Contact Detail</h4>
                            </div>
                            <div class="dashboard-caption-wrap">
                                <form class="post-form" action="{{route('company.store.contact-detail', $company)}}" method="POST" data-parsley-validate="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Address*</label>
                                                <input type="text" class="form-control" name="address"
                                                       value="{{ old('address', isset($company->address) ? $company->address :'') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- row -->
                                    @if(!$contactDetails->isEmpty())
                                        <div class="clonedInput contact_details" id="removeId1" data-fieldname="contact_details">
                                            <div class="appendContactDetail" id="clonedInput">
                                                @foreach($contactDetails as $details)
                                                    <div class="row" id="parentId">
                                                        <input type="hidden" name="contact_details_ref_id[]" value="{{$details->ref_id}}">
                                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="detail_contact_type">Contact Type</label>
                                                                <select class="form-control jb-minimal" name="detail_contact_type[]"
                                                                        data-placeholder="Contact Type">
                                                                    <option
                                                                        value="work" {{  $details->detail_key ==  'work' ? 'selected' :''  }}>
                                                                        Work
                                                                    </option>
                                                                    <option
                                                                        value="mobile" {{  $details->detail_key ==  'mobile' ? 'selected':''  }}>
                                                                        Mobile
                                                                    </option>
                                                                    <option
                                                                        value="personal" {{  $details->detail_key ==  'personal' ? 'selected':''  }}>
                                                                        Personal
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="detail_contact_number">Contact Number</label>
                                                                <input type="text" class="form-control" name="detail_contact_number[]"
                                                                       value="{{ old('detail_contact_number', $details->detail_value  ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            @if(!$loop->first)
                                                                <div class="form-group text-center">
                                                                    <button class="btn btn-danger removeThis"
                                                                            data-url="{{route('company.front.removeFields')}}"
                                                                            data-item-name="contact_details" data-ref-id="{{$details->ref_id}}">
                                                                        <i class="fa fa-trash"></i></button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
{{--                                        <div class="clonedInput contact_details" id="removeId1" data-fieldname="contact_details">--}}
{{--                                            <div class="appendContactDetail" id="clonedInput">--}}
{{--                                                <div class="row">--}}
{{--                                                <div class="col-lg-5 col-md-5 col-sm-12">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="detail_contact_type">Contact Type</label>--}}
{{--                                                        <select name="detail_contact_type[]" class="form-control jb-minimal"--}}
{{--                                                                data-placeholder="Contact Type">--}}
{{--                                                            <option value="work">Work</option>--}}
{{--                                                            <option value="mobile">Mobile</option>--}}
{{--                                                            <option value="personal">Personal</option>--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-lg-5 col-md-5 col-sm-12">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="detail_contact_number">Contact number</label>--}}
{{--                                                        <input type="text" name="detail_contact_number[]" class="form-control"--}}
{{--                                                               value=""/>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    @endif
                                    <div class="dynamicAddBtn">
                                        <button type="button" class="btn btn-success createClone" data-clone=".contact_details" data-fieldname="contact_details"
                                                data-appendto=".appendContactDetail"><i class="fa fa-plus"></i> Add Contact Details
                                        </button>
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
                        </div>
                    </div>
                </div>
                <!-- General Detail End -->
            </div>
        </div>
    </section>
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
@endsection
