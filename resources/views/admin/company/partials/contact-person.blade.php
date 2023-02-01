@if(isset($contactPersons) && !$contactPersons->isEmpty())
    <div class="clonedInput contact_persons" id="removeId1" data-fieldname="contact_persons">
        <div id="clonedInput" class="appendContactPerson">
            @foreach($contactPersons as $person)
                <div id="parentId">
                    <input type="hidden" name="contact_persons_ref_id[]" value="{{$person->ref_id}}">
                    <div class="row">
                        <div class="col-sm-11">
                            <div class="form-group">
                                <input type="text" name="person_name[]" class="form-control"
                                       value="{{ old('person_name', $person->person_name ?? '') }}"/>
                                <label for="Name">Contact Person Name</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            @if(!$loop->first)
                                <button class="btn btn-danger removeThis" data-url="{{route('remove.companyFields')}}" data-item-name="contact_persons" data-ref-id="{{$person->ref_id}}"><i
                                        class="fa fa-trash"></i></button>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="person_designation[]" class="form-control"
                                       value="{{ old('person_designation', $person->person_designation ?? '') }}"/>
                                <label for="Name">Contact Person Designation </label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="email" name="person_email[]" id="Email1" class="form-control"
                                       value="{{ old('person_email', $person->person_email ?? '') }}"/>
                                <label for="Name">Contact Person Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select name="person_contact_type[]" class="form-control"
                                        data-placeholder="Contact Type">
                                    <option
                                        value="work" {{ $person->contact_type ==  'work' ? 'selected' :''}}>
                                        Work
                                    </option>
                                    <option
                                        value="mobile" {{ $person->contact_type ==  'mobile' ? 'selected':''}}>
                                        Mobile
                                    </option>
                                    <option
                                        value="personal" {{ $person->contact_type ==  'personal' ? 'selected':''}}>
                                        Personal
                                    </option>
                                </select>
                                <label for="Name">Contact Type</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="person_number[]" class="form-control" id="number2"
                                       data-rule-number="true"
                                       value="{{ old('person_number',  $person->person_number ?? '') }}"/>
                                <label for="Name">Contact Person Number</label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="clonedInput contact_persons" id="removeId1" data-fieldname="contact_persons">
        <div id="clonedInput" class="appendContactPerson">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="text" name="person_name[]" class="form-control"
                               value=""/>
                        <span id="textarea1-error"
                              class="text-danger">{{ $errors->first('person_name') }}</span>
                        <label for="Name">Contact Person Name</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" name="person_designation[]" class="form-control"
                               value=""/>
                        <span id="textarea1-error"
                              class="text-danger">{{ $errors->first('person_designation') }}</span>
                        <label for="Name">Contact Person Designation </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="email" name="person_email[]" id="Email1" class="form-control"
                               value=""/>
                        <span id="textarea1-error"
                              class="text-danger">{{ $errors->first('person_email') }}</span>
                        <label for="Name">Contact Person Email</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <select name="person_contact_type[]" class="form-control"
                                data-placeholder="Company Size">
                            <option value="work">Work</option>
                            <option value="mobile">Mobile</option>
                            <option value="personal">Personal</option>
                        </select>
                        <label for="Name">Contact Type</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" name="person_number[]" class="form-control" id="number2"
                               data-rule-number="true"
                               value=""/>
                        <label for="Name">Contact Person Number</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<div class="dynamicAddBtn">
    <button type="button" class="btn btn-success createClone" data-clone=".contact_persons"
            data-appendto=".appendContactPerson"><i class="fa fa-plus"></i> Add Contact Persons
    </button>
</div>
