@if(isset($trainings))
    <div class="clonedInput trainings" id="removeId1" data-fieldname="trainings">
        <div class="appendTraining" id="clonedInput">
            @foreach($trainings as $training)
                <div id="parentId">
                    <input type="hidden" name="trainings_ref_id[]" value="{{$training->ref_id}}">
                <div class="row">
                    <div class="col-sm-11">
                        <div class="form-group">
                            <input type="text" name="training_name[]" class="form-control"
                                   value="{{ old('name', isset($training->name) ? $training->name : '') }}"/>
                            <span id="textarea1-error" class="text-danger">{{ $errors->first('name') }}</span>
                            <label for="Title">Training</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        @if(!$loop->first)
                            <button class="btn btn-danger removeThis" data-url="{{route('remove.candidateFields')}}"
                                    data-item-name="trainings" data-ref-id="{{$training->ref_id}}"><i
                                    class="fa fa-trash"></i></button>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" name="training_agency_name[]" class="form-control"
                                   value="{{ old('agency_name', isset($training->agency_name) ? $training->agency_name : '') }}"/>
                            <span id="textarea1-error" class="text-danger">{{ $errors->first('agency_name') }}</span>
                            <label for="Title">Agency Name</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="input-daterange input-group date-range" id="demo-date-range">
                                <div class="input-group-content">
                                    <input type="text" class="form-control" name="training_start_date[]"
                                           value="{{ old('start_date', isset($training->start_date) ? $training->start_date : '') }}"/>
                                    <label>Start Date</label>
                                </div>
                                <span class="input-group-addon">to</span>
                                <div class="input-group-content">
                                    <input type="text" class="form-control" name="training_end_date[]"
                                           value="{{ old('end_date', isset($training->end_date) ? $training->end_date : '') }}"/>
                                    <label for="Name">End Date</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            @endforeach
        </div>
    </div>
@else
{{--    <div class="clonedInput trainings" id="removeId1" data-fieldname="trainings">--}}
{{--        <div class="appendTraining" id="clonedInput">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="training_name[]" class="form-control"--}}
{{--                               value=""/>--}}
{{--                        <label for="Title">Training</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="training_agency_name[]" class="form-control"--}}
{{--                               value=""/>--}}
{{--                        <label for="Title">Agency Name</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="input-daterange input-group date-range" id="demo-date-range">--}}
{{--                            <div class="input-group-content">--}}
{{--                                <input type="text" class="form-control" name="training_start_date[]"--}}
{{--                                       value=""/>--}}
{{--                                <label>Start Date</label>--}}
{{--                            </div>--}}
{{--                            <span class="input-group-addon">to</span>--}}
{{--                            <div class="input-group-content">--}}
{{--                                <input type="text" class="form-control" name="training_end_date[]"--}}
{{--                                       value=""/>--}}
{{--                                <label for="Name">End Date</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endif
<div class="dynamicAddBtn">
    <button type="button" class="btn btn-success createClone" data-clone=".trainings"
            data-appendto=".appendTraining"><i class="fa fa-plus"></i> Add Trainings
    </button>
</div>
