@if(isset($references))
    <div class="clonedInput references" id="removeId1" data-fieldname="references">
        <div class="appendReference" id="clonedInput">
            @foreach($references as $reference)
                <div id="parentId">
                    <input type="hidden" name="references_ref_id[]" value="{{$reference->ref_id}}">
                <div class="row">
                    <div class="col-sm-11">
                        <div class="form-group">
                            <input type="text" name="reference_name[]" class="form-control" required
                                   value="{{ old('name', isset($reference->name) ? $reference->name : '') }}"/>
                            <span id="textarea1-error" class="text-danger">{{ $errors->first('name') }}</span>
                            <label for="Name">Name</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        @if(!$loop->first)
                            <button class="btn btn-danger removeThis" data-url="{{route('remove.candidateFields')}}"
                                    data-item-name="references" data-ref-id="{{$reference->ref_id}}"><i
                                    class="fa fa-trash"></i></button>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" name="reference_company_name[]" class="form-control"
                                   value="{{ old('company_name', isset($reference->company_name) ? $reference->company_name : '') }}"/>
                            <span id="textarea1-error"
                                  class="text-danger">{{ $errors->first('company_name') }}</span>
                            <label for="Name">Company Name</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="reference_designation[]" class="form-control" id="number2"
                                   value="{{ old('designation', isset($reference->designation) ? $reference->designation : '') }}"/>
                            <span id="textarea1-error" class="text-danger">{{ $errors->first('designation') }}</span>
                            <label for="KeyWords">Designation</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="reference_email[]" class="form-control"
                                   value="{{ old('email', isset($reference->email) ? $reference->email : '') }}"/>
                            <span id="textarea1-error"
                                  class="text-danger">{{ $errors->first('email') }}</span>
                            <label for="Name">Email</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="reference_phone[]" class="form-control"
                                   value="{{ old('phone', isset($reference->phone) ? $reference->phone : '') }}"/>
                            <span id="textarea1-error"
                                  class="text-danger">{{ $errors->first('phone') }}</span>
                            <label for="Name">Phone</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="reference_phone2[]" class="form-control"
                                   value="{{ old('phone', isset($reference->phone2) ? $reference->phone2 : '') }}"/>
                            <span id="textarea1-error"
                                  class="text-danger">{{ $errors->first('phone2') }}</span>
                            <label for="Name">Alternate Phone</label>
                        </div>
                    </div>
                </div>
                </div>
            @endforeach
        </div>
    </div>
@else
{{--    <div class="clonedInput references" id="removeId1" data-fieldname="references">--}}
{{--        <div class="appendReference" id="clonedInput">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="reference_name[]" class="form-control" required--}}
{{--                               value=""/>--}}
{{--                        <label for="Name">Name</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="reference_company_name[]" class="form-control"--}}
{{--                               value=""/>--}}
{{--                        <label for="Name">Institution Name</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="reference_designation[]" class="form-control" id="number2"--}}
{{--                               value=""/>--}}
{{--                        <label for="KeyWords">Designation</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="reference_email[]" class="form-control"--}}
{{--                               value=""/>--}}
{{--                        <label for="Name">Email</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="reference_phone[]" class="form-control"--}}
{{--                               value=""/>--}}
{{--                        <label for="Name">Phone</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="reference_phone2[]" class="form-control"--}}
{{--                               value=""/>--}}
{{--                        <label for="Name">Alternate Phone</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endif
<div class="dynamicAddBtn">
    <button type="button" class="btn btn-success createClone" data-clone=".references"
            data-appendto=".appendReference"><i class="fa fa-plus"></i> Add References
    </button>
</div>
