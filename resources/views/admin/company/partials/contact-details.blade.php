<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <input type="text" name="address" class="form-control"
                   value="{{ old('address', isset($company->address) ? $company->address :'') }}"/>
            <label for="Name">Address</label>
        </div>
    </div>
</div>
@if(isset($contactDetails) && !$contactDetails->isEmpty())
    <div class="clonedInput contact_details" id="removeId1" data-fieldname="contact_details">
        <div class="row appendContactDetail" id="clonedInput">
            @foreach($contactDetails as $details)
                <div id="parentId">
                    <input type="hidden" name="contact_details_ref_id[]" value="{{$details->ref_id}}">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <select name="detail_contact_type[]" class="form-control"
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
                            <label for="Name">Contact Type</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="detail_contact_number[]" class="form-control"
                                   value="{{ old('contact_number', $details->detail_value  ?? '') }}"/>
                            <label for="KeyWords">Contact number</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        @if(!$loop->first)
                        <button class="btn btn-danger removeThis" data-url="{{route('remove.companyFields')}}" data-item-name="contact_details" data-ref-id="{{$details->ref_id}}"><i
                                class="fa fa-trash"></i></button>
                            @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="clonedInput contact_details" id="removeId1" data-fieldname="contact_details">
        <div class="row appendContactDetail" id="clonedInput">
            <div class="col-sm-6">
                <div class="form-group">
                    <select name="detail_contact_type[]" class="form-control"
                            data-placeholder="Contact Type">
                        <option value="work">Work</option>
                        <option value="mobile">Mobile</option>
                        <option value="personal">Personal</option>
                    </select>
                    <label for="Name">Contact Type</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="detail_contact_number[]" class="form-control"
                           value=""/>
                    <label for="KeyWords">Contact number</label>
                </div>
            </div>
        </div>
    </div>
@endif
<div class="dynamicAddBtn">
    <button type="button" class="btn btn-success createClone" data-clone=".contact_details" data-appendto=".appendContactDetail"><i class="fa fa-plus"></i> Add Contact Details
    </button>
</div>

