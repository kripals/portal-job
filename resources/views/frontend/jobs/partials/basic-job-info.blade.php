<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="form-group">
            <label>Job Title*</label>
            <input type="text" class="form-control" name="title"
                   value="{{old('title',isset($jobDetail) ? $jobDetail->title : '')}}"
                   placeholder="Enter Job Title Eg: Receptionist, Sales Person, Web Developer" required/>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label>Job Category*</label>
            <select id="jb-category" class="form-control" name="category_id" required>
                <option value="">Choose Job Category</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}"
                            @if(isset($jobDetail) ? $jobDetail->category_id == $category->id : null) selected="selected" @endif>{{$category->name}}</option>
                @endforeach
            </select>

            @error('category_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Job Level*</label>
            <select class="form-control jb-minimal" name="job_level_id" required>
                @foreach($jobLevels as $level)
                    <option value="{{$level->id}}"
                            @if(isset($jobDetail) ? $jobDetail->job_level_id == $level->id :null) selected="selected" @endif>{{$level->title}}</option>
                @endforeach
            </select>

            @error('job_level_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Job Location*</label>
            <input type="text" class="form-control" value="{{isset($jobDetail) ? $jobDetail->location : null}}"
                   name="location" placeholder="Enter the Job location/ Office Location" required>

            @error('location')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="form-group">
            <label>No. of Vacancy*</label>
            <input class="form-control" type="number" value="{{isset($jobDetail) ? $jobDetail->vacancy_number : '1' }}"
                   min="1" name="vacancy_number" required>

            @error('vacancy_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="form-group">
            <label>Avaliable for*</label>
            <select class="form-control jb-minimal" name="job_type_id" required>
                @foreach($jobTypes as $type)
                    <option value="{{$type->id}}"
                            @if(isset($jobDetail) ? $jobDetail->job_type_id == $type->id :null) selected="selected" @endif>{{$type->title}}</option>
                @endforeach
            </select>

            @error('job_type_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="form-group">
            <label>Deadline*</label>
            <input type="text" name="end_date" class="form-control datetime"
                   value="{{ isset($jobDetail) ? $jobDetail->expiry_date : '' }}" onkeydown="return false"
                   placeholder="DD Month YYYY HH:MM" required>
            @error('end_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<!-- row -->
{{--<div class="row">--}}
{{--    <div class="col-lg-12 col-md-12 col-sm-12">--}}
{{--        <div class="form-group">--}}
{{--            <label>Job Location*</label>--}}
{{--            <input type="text" class="form-control" value="{{isset($jobDetail) ? $jobDetail->location : null}}"--}}
{{--                   name="location" required>--}}

{{--            @error('location')--}}
{{--            <span class="invalid-feedback" role="alert">--}}
{{--                <strong>{{ $message }}</strong>--}}
{{--            </span>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <label>Minimum Offered Salary</label>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="form-group">
            <select class="form-control" name="min_salary_currency" id="min_salary_currency">
                <option
                    value="nrs" {{ isset($jobDetail->min_salary_currency) ? $jobDetail->min_salary_currency == 'nrs' ? 'selected' : '' : '' }}>
                    NRs
                </option>
                <option
                    value="dollar" {{ isset($jobDetail->min_salary_currency) ? $jobDetail->min_salary_currency == 'dollar' ? 'selected' : '' : '' }}>
                    $
                </option>
                <option
                    value="eur" {{ isset($jobDetail->min_salary_currency) ? $jobDetail->min_salary_currency == 'eur' ? 'selected' : '' : '' }}>
                    EUR
                </option>
            </select>
            @error('min_salary_currency')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="form-group">
            <select class="form-control" name="min_salary_type" id="min_salary_type">
                <option
                    value="above" {{ isset($jobDetail->min_salary_type) ? $jobDetail->min_salary_type == 'above' ? 'selected' : '' : '' }}>
                    Above
                </option>
                <option
                    value="equals" {{ isset($jobDetail->min_salary_type) ? $jobDetail->min_salary_type == 'equals' ? 'selected' : '' : '' }}>
                    Equals
                </option>
                <option
                    value="below" {{ isset($jobDetail->min_salary_type) ? $jobDetail->min_salary_type == 'below' ? 'selected' : '' : '' }}>
                    Below
                </option>
            </select>
            @error('min_salary_type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="form-group">
            <input class="form-control" type="number"
                   value="{{isset($jobDetail) ? $jobDetail->min_salary_amount : null}}" name="min_salary_amount"
                   placeholder="Minimum Amount">
            @error('min_salary_amount')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="form-group">
            <select class="form-control" name="min_salary_rate" id="min_salary_rate">
                <option
                    value="hourly" {{ isset($jobDetail->min_salary_rate) ? $jobDetail->min_salary_rate == 'hourly' ? 'selected' : '' : '' }}>
                    Hourly
                </option>
                <option
                    value="daily" {{ isset($jobDetail->min_salary_rate) ? $jobDetail->min_salary_rate == 'daily' ? 'selected' : '' : '' }}>
                    Daily
                </option>
                <option
                    value="weekly" {{ isset($jobDetail->min_salary_rate) ? $jobDetail->min_salary_rate == 'weekly' ? 'selected' : '' : '' }}>
                    Weekly
                </option>
                <option
                    value="monthly"
                    selected {{ isset($jobDetail->min_salary_rate) ? $jobDetail->min_salary_rate == 'monthly' ? 'selected' : '' : '' }}>
                    Monthly
                </option>
                <option
                    value="yearly" {{ isset($jobDetail->min_salary_rate) ? $jobDetail->min_salary_rate == 'yearly' ? 'selected' : '' : '' }}>
                    Yearly
                </option>
            </select>
            @error('min_salary_rate')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <label>Maximum Offered Salary*</label>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="form-group">
            <select class="form-control" name="max_salary_currency" id="max_salary_currency">
                <option
                    value="nrs" {{ isset($jobDetail->max_salary_currency) ? $jobDetail->max_salary_currency == 'nrs' ? 'selected' : '' : '' }}>
                    NRs
                </option>
                <option
                    value="dollar" {{ isset($jobDetail->max_salary_currency) ? $jobDetail->max_salary_currency == 'dollar' ? 'selected' : '' : '' }}>
                    $
                </option>
                <option
                    value="eur" {{ isset($jobDetail->max_salary_currency) ? $jobDetail->max_salary_currency == 'eur' ? 'selected' : '' : '' }}>
                    EUR
                </option>
            </select>
            @error('max_salary_currency')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="form-group">
            <select class="form-control" name="max_salary_type" id="max_salary_type">
                <option
                    value="above" {{ isset($jobDetail->max_salary_type) ? $jobDetail->max_salary_type == 'above' ? 'selected' : '' : '' }}>
                    Above
                </option>
                <option
                    value="equals" {{ isset($jobDetail->max_salary_type) ? $jobDetail->max_salary_type == 'equals' ? 'selected' : '' : '' }}>
                    Equals
                </option>
                <option
                    value="below" {{ isset($jobDetail->max_salary_type) ? $jobDetail->max_salary_type == 'below' ? 'selected' : '' : '' }}>
                    Below
                </option>
            </select>
            @error('max_salary_type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="form-group">
            <input class="form-control" type="number"
                   value="{{isset($jobDetail) ? $jobDetail->max_salary_amount : null}}" placeholder="Maximum Amount"
                   name="max_salary_amount">
            @error('max_salary_amount')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="form-group">
            <select class="form-control" name="max_salary_rate" id="max_salary_rate">
                <option
                    value="hourly" {{ isset($jobDetail->max_salary_rate) ? $jobDetail->max_salary_rate == 'hourly' ? 'selected' : '' : '' }}>
                    Hourly
                </option>
                <option
                    value="daily" {{ isset($jobDetail->max_salary_rate) ? $jobDetail->max_salary_rate == 'daily' ? 'selected' : '' : '' }}>
                    Daily
                </option>
                <option
                    value="weekly" {{ isset($jobDetail->max_salary_rate) ? $jobDetail->max_salary_rate == 'weekly' ? 'selected' : '' : '' }}>
                    Weekly
                </option>
                <option
                    value="monthly"
                    selected {{ isset($jobDetail->max_salary_rate) ? $jobDetail->max_salary_rate == 'monthly' ? 'selected' : '' : '' }}>
                    Monthly
                </option>
                <option
                    value="yearly" {{ isset($jobDetail->max_salary_rate) ? $jobDetail->max_salary_rate == 'yearly' ? 'selected' : '' : '' }}>
                    Yearly
                </option>
            </select>
            @error('max_salary_rate')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<!-- row -->
<div class="row mrg-top-30">
    <div class="col-md-12 col-sm-12">
        <div class="form-group text-center">
            <button type="submit" name="submit" value="job_basic" class="btn-savepreview">Continue to Job
                Specification
            </button>
        </div>
    </div>
</div>
