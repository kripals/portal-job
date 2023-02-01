<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <input type="text" name="ref_id" class="form-control" id="number2"
                   data-rule-number="true" required
                   value="{{ old('ref_id', isset($candidate->ref_id) ? $candidate->ref_id : $refId) }}"/>
            <span id="textarea1-error" class="text-danger">{{ $errors->first('ref_id') }}</span>
            <label for="KeyWords">Reference ID</label>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-content">
                    <select class="form-control select2-list" name="user_id" required
                            data-placeholder="Assign User">
                        <option value="">Assign User</option>
                        @foreach($users as $user)
                            <option
                                value="{{$user->id}}" {{ isset($candidate->user_id) ? $candidate->user_id == $user->id ? 'selected' : '' :''}} >{{$user->full_name}}</option>
                        @endforeach
                    </select>
                    <span id="textarea1-error"
                          class="text-danger">{{ $errors->first('user_id') }}</span>
                </div>
                <div class="input-group-btn">
                    <a href="{{route('user.create')}}">
                        <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <input type="text" name="nationality" class="form-control" id="number2"
                   value="{{ old('nationality', isset($candidate->nationality) ? $candidate->nationality : '') }}"/>
            <label for="KeyWords">Nationality</label>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <select class="form-control" name="marital_status"
                    data-placeholder="Select Marital Status">
                <option
                    value="unmarried" {{ isset($candidate->marital_status) ? $candidate->marital_status == 'unmarried' ? 'selected' : '' : '' }}>
                    Unmarried
                </option>
                <option
                    value="married" {{ isset($candidate->marital_status) ? $candidate->marital_status == 'married' ? 'selected' : '' : '' }}>
                    Married
                </option>
            </select>
            <label for="KeyWords">Marital Status</label>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <select class="form-control" name="gender"
                    data-placeholder="Select Gender">
                <option
                    value="male" {{ isset($candidate->gender) ? $candidate->gender == 'male' ? 'selected' : '' : '' }}>
                    Male
                </option>
                <option
                    value="female" {{ isset($candidate->gender) ? $candidate->gender == 'female' ? 'selected' : '' : '' }}>
                    Female
                </option>
            </select>
            <label for="KeyWords">Gender</label>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <input type="text" name="religion" class="form-control" id="number2"
                   value="{{ old('religion', isset($candidate->religion) ? $candidate->religion : '') }}"/>
            <label for="KeyWords">Religion</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" name="current_address" class="form-control" id="number2"
                   value="{{ old('current_address', isset($candidate->current_address) ? $candidate->current_address : '') }}"/>
            <label for="KeyWords">Current Address</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" name="permanent_address" class="form-control" id="number2"
                   value="{{ old('permanent_address', isset($candidate->permanent_address) ? $candidate->permanent_address : '') }}"/>
            <label for="KeyWords">Permanent Address</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group control-width-normal">
            <div class="input-group date" id="demo-date">
                <div class="input-group-content">
                    <input type="text" name="birth_date" class="form-control"
                           value="{{ old('birth_date', isset($candidate->birth_date) ? $candidate->birth_date : '') }}">
                    <label>Date of Birth</label>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-content">
                    <select class="form-control select2-list" name="category_id"
                            data-placeholder="Select job categories" required>
                        @foreach($candidateCategories as $category)
                            <option
                                value="{{$category->id}}" {{ isset($candidate->category_id) ? $candidate->category_id == $category->id ? 'selected' : '' : '' }}>{{$category->name}}</option>
                        @endforeach
                    </select>
                    <label>Select Job Categories</label>
                    <span id="textarea1-error"
                          class="text-danger">{{ $errors->first('category_id') }}</span>
                </div>
                <div class="input-group-btn">
                    <a href="{{route('category.create','candidate')}}">
                        <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-content">
                    <select class="form-control select2-list" name="job_level_id"
                            data-placeholder="Select job level" required>
                        @foreach($jobLevels as $level)
                            <option
                                value="{{$level->id}}" {{ isset($candidate->job_level_id) ? $candidate->job_level_id == $level->id ? 'selected' : '' : '' }}>{{$level->title}}</option>
                        @endforeach
                    </select>
                    <label>Select Job Level</label>
                    <span id="textarea1-error"
                          class="text-danger">{{ $errors->first('job_level') }}</span>
                </div>
                <div class="input-group-btn">
                    <a href="{{route('job-level.create')}}">
                        <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-content">
                    <select class="form-control select2-list" name="job_types[]"
                            multiple required>
                        @foreach($jobTypes as $key=>$type)
                            @if(isset($candidate->job_types) && !$candidate->job_types->isEmpty())
                                @foreach($candidate->job_types as $jobTypes)
                                    <option
                                        value="{{$type->id}}"
                                        {{ $jobTypes->id == $type->id ? 'selected' : '' }}
                                    >{{$type->title}}</option>
                                @endforeach
                            @else
                            @endif
                        @endforeach
                    </select>
                    <label>Select Job Types</label>
                    <span id="textarea1-error"
                          class="text-danger">{{ $errors->first('job_types') }}</span>
                </div>
                <div class="input-group-btn">
                    <a href="{{route('job-type.create')}}">
                        <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-content">
                    <select class="form-control select2-list" name="job_country_id" required>
                        @foreach($jobCountries as $key=>$country)
{{--                            @if(isset($candidate->job_country) && !empty($candidate->job_country))--}}
{{--                                @foreach($candidate->job_country as $preCountry)--}}
                                    <option
                                        value="{{$country->id}}"
                                        {{ isset($candidate->job_country_id) ? $candidate->job_country_id == $country->id ? 'selected' : '' : ''}}
                                    >{{$country->title}}</option>
{{--                                @endforeach--}}
{{--                            @else--}}
{{--                                <option--}}
{{--                                    value="{{$country->id}}"--}}
{{--                                >{{$country->title}}</option>--}}
{{--                            @endif--}}
                        @endforeach
                    </select>
                    <label>Select Country</label>
                    <span id="textarea1-error"
                          class="text-danger">{{ $errors->first('job_country_id') }}</span>
                </div>
                <div class="input-group-btn">
                    <a href="{{route('job-country.create')}}">
                        <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <select class="form-control select2-list" name="location_id[]"
                    multiple required>
                @foreach($jobLocations as $key=>$location)
                    @if(isset($candidate->preferred_locations) && !$candidate->preferred_locations->isEmpty())
                        @foreach($candidate->preferred_locations as $preLocation)
                            <option
                                value="{{$location->id}}"
                                {{ $preLocation->id == $location->id ? 'selected' : '' }}
                            >{{$location->title}}</option>
                        @endforeach
                    @else
                        <option
                            value="{{$location->id}}"
                        >{{$location->title}}</option>
                    @endif
                @endforeach
            </select>
            <label>Select Preferred Locations</label>
            <span id="textarea1-error"
                  class="text-danger">{{ $errors->first('location_id') }}</span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" name="specialization" data-role="tagsinput"
                   value="{{ old('specialization', isset($candidate->specialization) ? $candidate->specialization : '') }}"/>
            <span id="textarea1-error" class="text-danger">{{ $errors->first('specialization') }}</span>
            <label for="specialization">Specializations</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-9">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-content">
                    <select class="form-control select2-list" name="skill_id[]"
                            multiple required>
                        @foreach($skills as $key=>$skill)
                            @if(isset($candidate->known_skills) && !$candidate->known_skills->isEmpty())
                                @foreach($candidate->known_skills as $knownSkill)
                                    <option
                                        value="{{$skill->id}}"
                                        {{ $knownSkill->id == $skill->id ? 'selected' : '' }}
                                    >{{$skill->title}}</option>
                                @endforeach
                            @else
                                <option
                                    value="{{$skill->id}}"
                                >{{$skill->title}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label>Skill Sets</label>
                    <span id="textarea1-error"
                          class="text-danger">{{ $errors->first('skill_id') }}</span>
                </div>
                <div class="input-group-btn">
                    <a href="{{route('job-skill.create')}}">
                        <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <input type="number" min="0" name="experience_period" class="form-control" data-rule-number="true"
                   value="{{ old('experience_period', isset($candidate->experience_period) ? $candidate->experience_period : '') }}"/>
            <span id="textarea1-error" class="text-danger">{{ $errors->first('experience_period') }}</span>
            <label for="specialization">Experience(Years)</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="Username5" class="control-label">Expected Salary</label>
            <div class="col-sm-3">
                <select name="exp_salary_currency" class="form-control select2-list"
                        data-placeholder="Currency" required>
                    <option
                        value="nrs" {{ isset($candidate->exp_salary_currency) ? $candidate->exp_salary_currency == 'nrs' ? 'selected' : '' : '' }}>
                        NRs
                    </option>
                    <option
                        value="dollar" {{ isset($candidate->exp_salary_currency) ? $candidate->exp_salary_currency == 'dollar' ? 'selected' : '' : '' }}>
                        $
                    </option>
                    <option
                        value="irs" {{ isset($candidate->exp_salary_currency) ? $candidate->exp_salary_currency == 'irs' ? 'selected' : '' : '' }}>
                        IRs
                    </option>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="exp_salary_type" class="form-control select2-list expSalType"
                        data-placeholder="Type" required>
                    <option
                        value="above" {{ isset($candidate->exp_salary_type) ? $candidate->exp_salary_type == 'above' ? 'selected' : '' : '' }}>
                        Above
                    </option>
                    <option
                        value="equals" {{ isset($candidate->exp_salary_type) ? $candidate->exp_salary_type == 'equals' ? 'selected' : '' : '' }}>
                        Equals
                    </option>
                    <option
                        value="below" {{ isset($candidate->exp_salary_type) ? $candidate->exp_salary_type == 'below' ? 'selected' : '' : '' }}>
                        Below
                    </option>
                </select>
            </div>
            <div class="col-sm-3">
                <input type="number" name="exp_salary_amount" min="0" class="form-control" id="Username5"
                       placeholder="Amount"
                       value="{{old('exp_salary_amount',isset($candidate->exp_salary_amount) ? $candidate->exp_salary_amount  : '' )}}">
                <div class="form-control-line"></div>
            </div>
            <div class="col-sm-3">
                <select name="exp_salary_rate" class="form-control select2-list"
                        data-placeholder="Currency" required>
                    <option
                        value="hourly" {{ isset($candidate->exp_salary_rate) ? $candidate->exp_salary_rate == 'hourly' ? 'selected' : '' : '' }}>
                        Hourly
                    </option>
                    <option
                        value="daily" {{ isset($candidate->exp_salary_rate) ? $candidate->exp_salary_rate == 'daily' ? 'selected' : '' : '' }}>
                        Daily
                    </option>
                    <option
                        value="weekly" {{ isset($candidate->exp_salary_rate) ? $candidate->exp_salary_rate == 'weekly' ? 'selected' : '' : '' }}>
                        Weekly
                    </option>
                    <option
                        value="monthly" {{ isset($candidate->exp_salary_rate) ? $candidate->exp_salary_rate == 'monthly' ? 'selected' : '' : '' }}>
                        Monthly
                    </option>
                    <option
                        value="yearly" {{ isset($candidate->exp_salary_rate) ? $candidate->exp_salary_rate == 'yearly' ? 'selected' : '' : '' }}>
                        yearly
                    </option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="Username5" class="control-label">Current Salary</label>
            <div class="col-sm-3">
                <select name="cur_salary_currency" class="form-control select2-list"
                        data-placeholder="Currency" required>
                    <option
                        value="nrs" {{ isset($candidate->cur_salary_currency) ? $candidate->cur_salary_currency == 'nrs' ? 'selected' : '' : '' }}>
                        NRs
                    </option>
                    <option
                        value="dollar" {{ isset($candidate->cur_salary_currency) ? $candidate->cur_salary_currency == 'dollar' ? 'selected' : '' : '' }}>
                        $
                    </option>
                    <option
                        value="irs" {{ isset($candidate->cur_salary_currency) ? $candidate->cur_salary_currency == 'irs' ? 'selected' : '' : '' }}>
                        IRs
                    </option>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="cur_salary_type" class="form-control select2-list curSalType"
                        data-placeholder="Type" required>
                    <option
                        value="above" {{ isset($candidate->cur_salary_type) ? $candidate->cur_salary_type == 'above' ? 'selected' : '' : '' }}>
                        Above
                    </option>
                    <option
                        value="equals" {{ isset($candidate->cur_salary_type) ? $candidate->cur_salary_type == 'equals' ? 'selected' : '' : '' }}>
                        Equals
                    </option>
                    <option
                        value="below" {{ isset($candidate->cur_salary_type) ? $candidate->cur_salary_type == 'below' ? 'selected' : '' : '' }}>
                        Below
                    </option>
                </select>
            </div>
            <div class="col-sm-3">
                <input type="number" name="cur_salary_amount" min="0" class="form-control" id="Username5"
                       placeholder="Amount"
                       value="{{old('cur_salary_amount',isset($candidate->cur_salary_amount) ? $candidate->cur_salary_amount  : '' )}}">
                <div class="form-control-line"></div>
            </div>
            <div class="col-sm-3">
                <select name="cur_salary_rate" class="form-control select2-list"
                        data-placeholder="Currency" required>
                    <option
                        value="hourly" {{ isset($candidate->cur_salary_rate) ? $candidate->cur_salary_rate == 'hourly' ? 'selected' : '' : '' }}>
                        Hourly
                    </option>
                    <option
                        value="daily" {{ isset($candidate->cur_salary_rate) ? $candidate->cur_salary_rate == 'daily' ? 'selected' : '' : '' }}>
                        Daily
                    </option>
                    <option
                        value="weekly" {{ isset($candidate->cur_salary_rate) ? $candidate->cur_salary_rate == 'weekly' ? 'selected' : '' : '' }}>
                        Weekly
                    </option>
                    <option
                        value="monthly" {{ isset($candidate->cur_salary_rate) ? $candidate->cur_salary_rate == 'monthly' ? 'selected' : '' : '' }}>
                        Monthly
                    </option>
                    <option
                        value="yearly" {{ isset($candidate->cur_salary_rate) ? $candidate->cur_salary_rate == 'yearly' ? 'selected' : '' : '' }}>
                        yearly
                    </option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <strong>Description</strong>
            <textarea name="description" id=""
                      class="ckeditor">{{old('description',isset($candidate->description)?$candidate->description : '')}}</textarea>
            <span id="textarea1-error"
                  class="text-danger">{{ $errors->first('description') }}</span>
        </div>
    </div>
</div>
