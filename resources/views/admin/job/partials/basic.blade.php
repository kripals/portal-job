<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <input type="text" name="ref_id" class="form-control" id="number2"
                   data-rule-number="true" required
                   value="{{ old('ref_id', isset($job->ref_id) ? $job->ref_id : $refId) }}"/>
            <span id="textarea1-error" class="text-danger">{{ $errors->first('ref_id') }}</span>
            <label for="KeyWords">Reference ID</label>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-content">
                    <select class="form-control select2-list" name="company_id" required
                            data-placeholder="Assign User">
                        <option value="">Select Company</option>
                        @foreach($companies as $company)
                            <option
                                value="{{$company->id}}" {{ isset($job->company_id) ? $job->company_id == $company->id ? 'selected' : '' :''}} >{{$company->company_name}}</option>
                        @endforeach
                    </select>
                    <span id="textarea1-error"
                          class="text-danger">{{ $errors->first('company_id') }}</span>
                </div>
                <div class="input-group-btn">
                    <a href="{{route('company.create')}}">
                        <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <select class="form-control select2-list" name="category_id"
                    data-placeholder="Select Job Category">
                @foreach($categories as $category)
                    <option
                        value="{{$category->id}}" {{ isset($job->category_id) ? $job->category_id == $category->id ? 'selected' : '' :''}} >{{$category->name}}</option>
                @endforeach
            </select>
            <label for="KeyWords">Job Category</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" name="title" class="form-control" id="number2"
                   value="{{ old('title', isset($job->title) ? $job->title : '') }}" required/>
            <label for="KeyWords">Job Title</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <select class="form-control" name="job_service_id" id="jobService"
                    data-placeholder="Select Job Service">
                <option value="">Select Job Service</option>
                @foreach($jobServices as $service)
                    <option
                        value="{{$service->id}}" {{ isset($job->job_service_id) ? $job->job_service_id == $service->id ? 'selected' : '' :''}} >{{$service->title}}</option>
                @endforeach
            </select>
            <label for="KeyWords">Job Service(premium)</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <select class="form-control" name="job_level_id"
                    data-placeholder="Select Job Service">
                @foreach($jobLevels as $level)
                    <option
                        value="{{$level->id}}" {{ isset($job->job_level_id) ? $job->job_level_id == $level->id ? 'selected' : '' :''}} >{{$level->title}}</option>
                @endforeach
            </select>
            <label for="KeyWords">Job Level</label>
        </div>
    </div>
</div>
<div class="row" id="newspaper">
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" name="company_name" class="form-control" id="number2"
                   value="{{ old('company_name', isset($job->company_name) ? $job->company_name : '') }}" required/>
            <label for="KeyWords">Company Name</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" name="source" class="form-control" id="number2"
                   value="{{ old('source', isset($job->source) ? $job->source : '') }}"/>
            <label for="KeyWords">Source</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <input type="number" min="0" name="vacancy_number" class="form-control" data-rule-number="true"
                   value="{{ old('vacancy_number', isset($job->vacancy_number) ? $job->vacancy_number : '') }}"/>
            <label for="KeyWords">No of Vacancies</label>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <select class="form-control" name="job_type_id"
                    data-placeholder="Select Job Type">
                @foreach($jobTypes as $type)
                    <option
                        value="{{$type->id}}" {{ isset($job->job_type_id) ? $job->job_type_id == $type->id ? 'selected' : '' :''}} >{{$type->title}}</option>
                @endforeach
            </select>
            <label for="KeyWords">Job Type</label>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group control-width-normal">
            <div class="input-group" id="demo-date">
                <div class="input-group-content">
                    <input type="text" name="end_date" class="form-control datetime"
                           value="{{ old('end_date', isset($job->end_date) ? $job->end_date : '') }}" required>
                    <label>Expiry Date</label>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <select class="form-control" name="job_country_id"
                    data-placeholder="Select Job Country">
                @foreach($jobCountries as $country)
                    <option
                        value="{{$country->id}}" {{ isset($job->job_country_id) ? $job->job_country_id == $country->id ? 'selected' : '' :''}} >{{$country->title}}</option>
                @endforeach
            </select>
            <label for="KeyWords">Job Country</label>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
            <input type="text" name="location" class="form-control" id="number2"
                   value="{{ old('location', isset($job->location) ? $job->location : '') }}"/>
            <label for="KeyWords">Job Location</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="Username5" class="control-label">Minimum Offered Salary</label>
            <div class="col-sm-3">
                <select name="min_salary_currency" class="form-control select2-list"
                        data-placeholder="Currency">
                    <option
                        value="nrs" {{ isset($job->min_salary_currency) ? $job->min_salary_currency == 'nrs' ? 'selected' : '' : '' }}>
                        NRs
                    </option>
                    <option
                        value="dollar" {{ isset($job->min_salary_currency) ? $job->min_salary_currency == 'dollar' ? 'selected' : '' : '' }}>
                        $
                    </option>
                    <option
                        value="irs" {{ isset($job->min_salary_currency) ? $job->min_salary_currency == 'irs' ? 'selected' : '' : '' }}>
                        IRs
                    </option>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="min_salary_type" class="form-control select2-list"
                        data-placeholder="Type">
                    <option
                        value="above" {{ isset($job->min_salary_type) ? $job->min_salary_type == 'above' ? 'selected' : '' : '' }}>
                        Above
                    </option>
                    <option
                        value="equals" {{ isset($job->min_salary_type) ? $job->min_salary_type == 'equals' ? 'selected' : '' : '' }}>
                        Equals
                    </option>
                    <option
                        value="below" {{ isset($job->min_salary_type) ? $job->min_salary_type == 'below' ? 'selected' : '' : '' }}>
                        Below
                    </option>
                </select>
            </div>
            <div class="col-sm-3">
                <input type="number" name="min_salary_amount" min="0" class="form-control" id="Username5"
                       placeholder="Amount"
                       value="{{old('min_salary_amount',isset($job->min_salary_amount) ? $job->min_salary_amount  : '' )}}">
                <div class="form-control-line"></div>
            </div>
            <div class="col-sm-3">
                <select name="min_salary_rate" class="form-control select2-list"
                        data-placeholder="Currency">
                    <option
                        value="hourly" {{ isset($job->min_salary_rate) ? $job->min_salary_rate == 'hourly' ? 'selected' : '' : '' }}>
                        Hourly
                    </option>
                    <option
                        value="daily" {{ isset($job->min_salary_rate) ? $job->min_salary_rate == 'daily' ? 'selected' : '' : '' }}>
                        Daily
                    </option>
                    <option
                        value="weekly" {{ isset($job->min_salary_rate) ? $job->min_salary_rate == 'weekly' ? 'selected' : '' : '' }}>
                        Weekly
                    </option>
                    <option
                        value="monthly" {{ isset($job->min_salary_rate) ? $job->min_salary_rate == 'monthly' ? 'selected' : '' : '' }}>
                        Monthly
                    </option>
                    <option
                        value="yearly" {{ isset($job->min_salary_rate) ? $job->min_salary_rate == 'yearly' ? 'selected' : '' : '' }}>
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
            <label for="Username5" class="control-label">Maximum Offered Salary</label>
            <div class="col-sm-3">
                <select name="max_salary_currency" class="form-control select2-list"
                        data-placeholder="Currency" required>
                    <option
                        value="nrs" {{ isset($job->max_salary_currency) ? $job->max_salary_currency == 'nrs' ? 'selected' : '' : '' }}>
                        NRs
                    </option>
                    <option
                        value="dollar" {{ isset($job->max_salary_currency) ? $job->max_salary_currency == 'dollar' ? 'selected' : '' : '' }}>
                        $
                    </option>
                    <option
                        value="irs" {{ isset($job->max_salary_currency) ? $job->max_salary_currency == 'irs' ? 'selected' : '' : '' }}>
                        IRs
                    </option>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="max_salary_type" class="form-control select2-list"
                        data-placeholder="Type">
                    <option
                        value="above" {{ isset($job->max_salary_type) ? $job->max_salary_type == 'above' ? 'selected' : '' : '' }}>
                        Above
                    </option>
                    <option
                        value="equals" {{ isset($job->max_salary_type) ? $job->max_salary_type == 'equals' ? 'selected' : '' : '' }}>
                        Equals
                    </option>
                    <option
                        value="below" {{ isset($job->max_salary_type) ? $job->max_salary_type == 'below' ? 'selected' : '' : '' }}>
                        Below
                    </option>
                </select>
            </div>
            <div class="col-sm-3">
                <input type="number" name="max_salary_amount" min="0" class="form-control" id="Username5"
                       placeholder="Amount"
                       value="{{old('max_salary_amount',isset($job->max_salary_amount) ? $job->max_salary_amount  : '' )}}">
                <div class="form-control-line"></div>
            </div>
            <div class="col-sm-3">
                <select name="max_salary_rate" class="form-control select2-list"
                        data-placeholder="Currency">
                    <option
                        value="hourly" {{ isset($job->max_salary_rate) ? $job->max_salary_rate == 'hourly' ? 'selected' : '' : '' }}>
                        Hourly
                    </option>
                    <option
                        value="daily" {{ isset($job->max_salary_rate) ? $job->max_salary_rate == 'daily' ? 'selected' : '' : '' }}>
                        Daily
                    </option>
                    <option
                        value="weekly" {{ isset($job->max_salary_rate) ? $job->max_salary_rate == 'weekly' ? 'selected' : '' : '' }}>
                        Weekly
                    </option>
                    <option
                        value="monthly" {{ isset($job->max_salary_rate) ? $job->max_salary_rate == 'monthly' ? 'selected' : '' : '' }}>
                        Monthly
                    </option>
                    <option
                        value="yearly" {{ isset($job->max_salary_rate) ? $job->max_salary_rate == 'yearly' ? 'selected' : '' : '' }}>
                        yearly
                    </option>
                </select>
            </div>
        </div>
    </div>
</div>

