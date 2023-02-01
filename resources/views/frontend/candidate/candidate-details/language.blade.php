@extends('frontend.candidate.layouts.layout')

@section('candidate-content')

    <div class="dashboard-caption-header">
        <h4><i class="ti-world"></i>Language</h4>
    </div>

    <div class="dashboard-caption-wrap">
        <form class="form form-validate floating-label" action="{{route('candidate.store.language', $candidate)}}"
              method="POST" enctype="multipart/form-data" data-parsley-validate="">
            @csrf
            @if((!$languages->isEmpty()))
                <div class="clonedInput languages" id="removeId1" data-fieldname="languages">
                    <div class="appendLanguage" id="clonedInput">
                        @foreach($languages as $language)
                            <div id="parentId">
                                <input type="hidden" name="languages_ref_id[]" value="{{$language->ref_id}}">
                                <div class="row">
                                    @if(!$loop->first)
                                        <hr>
                                        <div class="col-md-1" style="float: right">
                                            <button class="btn btn-danger removeThis"
                                                    data-url="{{route('candidate.front.removeFields')}}"
                                                    data-item-name="languages" data-ref-id="{{$language->ref_id}}"><i
                                                        class="fa fa-trash"></i></button>
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Known Language*</label>
                                            <input type="text" name="language_name[]" class="form-control" placeholder="Enter the language you know Eg: Chinese"
                                                   value="{{ old('name', isset($language->name) ? $language->name : '') }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Title">Reading</label>
                                            <select class="form-control" name="language_reading[]" required>
                                                <option
                                                    value="poor" {{ isset($language->reading) ? $language->reading == 'poor' ? 'selected' : '' : '' }}>
                                                    Poor
                                                </option>
                                                <option
                                                    value="good" {{ isset($language->reading) ? $language->reading == 'good' ? 'selected' : '' : '' }}>
                                                    Good
                                                </option>
                                                <option
                                                    value="better" {{ isset($language->reading) ? $language->reading == 'better' ? 'selected' : '' : '' }}>
                                                    Better
                                                </option>
                                                <option
                                                    value="best" {{ isset($language->reading) ? $language->reading == 'best' ? 'selected' : '' : '' }}>
                                                    Best
                                                </option>
                                                <option
                                                    value="excellent" {{ isset($language->reading) ? $language->reading == 'excellent' ? 'selected' : '' : '' }}>
                                                    Excellent
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Title">Writing</label>
                                            <select class="form-control" name="language_writing[]" required>
                                                <option
                                                    value="poor" {{ isset($language->writing) ? $language->writing == 'poor' ? 'selected' : '' : '' }}>
                                                    Poor
                                                </option>
                                                <option
                                                    value="good" {{ isset($language->writing) ? $language->writing == 'good' ? 'selected' : '' : '' }}>
                                                    Good
                                                </option>
                                                <option
                                                    value="better" {{ isset($language->writing) ? $language->writing == 'better' ? 'selected' : '' : '' }}>
                                                    Better
                                                </option>
                                                <option
                                                    value="best" {{ isset($language->writing) ? $language->writing == 'best' ? 'selected' : '' : '' }}>
                                                    Best
                                                </option>
                                                <option
                                                    value="excellent" {{ isset($language->writing) ? $language->writing == 'excellent' ? 'selected' : '' : '' }}>
                                                    Excellent
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Title">Speaking</label>
                                            <select class="form-control" name="language_speaking[]" required>
                                                <option
                                                    value="poor" {{ isset($language->speaking) ? $language->speaking == 'poor' ? 'selected' : '' : '' }}>
                                                    Poor
                                                </option>
                                                <option
                                                    value="good" {{ isset($language->speaking) ? $language->speaking == 'good' ? 'selected' : '' : '' }}>
                                                    Good
                                                </option>
                                                <option
                                                    value="better" {{ isset($language->speaking) ? $language->speaking == 'better' ? 'selected' : '' : '' }}>
                                                    Better
                                                </option>
                                                <option
                                                    value="best" {{ isset($language->speaking) ? $language->speaking == 'best' ? 'selected' : '' : '' }}>
                                                    Best
                                                </option>
                                                <option
                                                    value="excellent" {{ isset($language->speaking) ? $language->speaking == 'excellent' ? 'selected' : '' : '' }}>
                                                    Excellent
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Title">Listening</label>
                                            <select class="form-control" name="language_listening[]" required>
                                                <option
                                                    value="poor" {{ isset($language->listening) ? $language->listening == 'poor' ? 'selected' : '' : '' }}>
                                                    Poor
                                                </option>
                                                <option
                                                    value="good" {{ isset($language->listening) ? $language->listening == 'good' ? 'selected' : '' : '' }}>
                                                    Good
                                                </option>
                                                <option
                                                    value="better" {{ isset($language->listening) ? $language->listening == 'better' ? 'selected' : '' : '' }}>
                                                    Better
                                                </option>
                                                <option
                                                    value="best" {{ isset($language->listening) ? $language->listening == 'best' ? 'selected' : '' : '' }}>
                                                    Best
                                                </option>
                                                <option
                                                    value="excellent" {{ isset($language->listening) ? $language->listening == 'excellent' ? 'selected' : '' : '' }}>
                                                    Excellent
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
{{--                <div class="clonedInput languages" id="removeId1" data-fieldname="languages">--}}
{{--                    <div class="appendLanguage" id="clonedInput">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Known Language*</label>--}}
{{--                                    <input type="text" name="language_name[]" class="form-control"--}}
{{--                                           value="{{ old('name', isset($language->name) ? $language->name : '') }}" required/>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="Title">Reading</label>--}}
{{--                                    <select class="form-control" name="language_reading[]" required>--}}
{{--                                        <option--}}
{{--                                            value="good" {{ isset($language->reading) ? $language->reading == 'good' ? 'selected' : '' : '' }}>--}}
{{--                                            Good--}}
{{--                                        </option>--}}
{{--                                        <option--}}
{{--                                            value="better" {{ isset($language->reading) ? $language->reading == 'better' ? 'selected' : '' : '' }}>--}}
{{--                                            Better--}}
{{--                                        </option>--}}
{{--                                        <option--}}
{{--                                            value="best" {{ isset($language->reading) ? $language->reading == 'best' ? 'selected' : '' : '' }}>--}}
{{--                                            Best--}}
{{--                                        </option>--}}
{{--                                        <option--}}
{{--                                            value="excellent" {{ isset($language->reading) ? $language->reading == 'excellent' ? 'selected' : '' : '' }}>--}}
{{--                                            Excellent--}}
{{--                                        </option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="Title">Writing</label>--}}
{{--                                    <select class="form-control" name="language_writing[]" required>--}}
{{--                                        <option--}}
{{--                                            value="good" {{ isset($language->writing) ? $language->writing == 'good' ? 'selected' : '' : '' }}>--}}
{{--                                            Good--}}
{{--                                        </option>--}}
{{--                                        <option--}}
{{--                                            value="better" {{ isset($language->writing) ? $language->writing == 'better' ? 'selected' : '' : '' }}>--}}
{{--                                            Better--}}
{{--                                        </option>--}}
{{--                                        <option--}}
{{--                                            value="best" {{ isset($language->writing) ? $language->writing == 'best' ? 'selected' : '' : '' }}>--}}
{{--                                            Best--}}
{{--                                        </option>--}}
{{--                                        <option--}}
{{--                                            value="excellent" {{ isset($language->writing) ? $language->writing == 'excellent' ? 'selected' : '' : '' }}>--}}
{{--                                            Excellent--}}
{{--                                        </option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="Title">Speaking</label>--}}
{{--                                    <select class="form-control" name="language_speaking[]" required>--}}
{{--                                        <option--}}
{{--                                            value="good" {{ isset($language->speaking) ? $language->speaking == 'good' ? 'selected' : '' : '' }}>--}}
{{--                                            Good--}}
{{--                                        </option>--}}
{{--                                        <option--}}
{{--                                            value="better" {{ isset($language->speaking) ? $language->speaking == 'better' ? 'selected' : '' : '' }}>--}}
{{--                                            Better--}}
{{--                                        </option>--}}
{{--                                        <option--}}
{{--                                            value="best" {{ isset($language->speaking) ? $language->speaking == 'best' ? 'selected' : '' : '' }}>--}}
{{--                                            Best--}}
{{--                                        </option>--}}
{{--                                        <option--}}
{{--                                            value="excellent" {{ isset($language->speaking) ? $language->speaking == 'excellent' ? 'selected' : '' : '' }}>--}}
{{--                                            Excellent--}}
{{--                                        </option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="Title">Listening</label>--}}
{{--                                    <select class="form-control" name="language_listening[]" required>--}}
{{--                                        <option--}}
{{--                                            value="good" {{ isset($language->listening) ? $language->listening == 'good' ? 'selected' : '' : '' }}>--}}
{{--                                            Good--}}
{{--                                        </option>--}}
{{--                                        <option--}}
{{--                                            value="better" {{ isset($language->listening) ? $language->listening == 'better' ? 'selected' : '' : '' }}>--}}
{{--                                            Better--}}
{{--                                        </option>--}}
{{--                                        <option--}}
{{--                                            value="best" {{ isset($language->listening) ? $language->listening == 'best' ? 'selected' : '' : '' }}>--}}
{{--                                            Best--}}
{{--                                        </option>--}}
{{--                                        <option--}}
{{--                                            value="excellent" {{ isset($language->listening) ? $language->listening == 'excellent' ? 'selected' : '' : '' }}>--}}
{{--                                            Excellent--}}
{{--                                        </option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            @endif
            <div class="dynamicAddBtn">
                <button type="button" class="btn btn-success createCandidateClone" data-clone=".languages" data-fieldname="languages"
                        data-appendto=".appendLanguage"><i class="fa fa-plus"></i> Add Another Language
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
    <!-- General Detail End -->
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
@endsection
