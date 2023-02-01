<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <input type="text" name="company_name" class="form-control" required
                   value="{{ old('company_name', isset($company->company_name) ? $company->company_name : '') }}"/>
            <span id="textarea1-error"
                  class="text-danger">{{ $errors->first('company_name') }}</span>
            <label for="Name">Company Name</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" name="ref_id" class="form-control" required
                   value="{{ old('ref_id', isset($company->ref_id) ? $company->ref_id : $refId) }}"/>
            <span id="textarea1-error" class="text-danger">{{ $errors->first('ref_id') }}</span>
            <label for="KeyWords">Reference ID</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" name="company_reg_no" class="form-control" id="number2" required
                   data-rule-number="true"
                   value="{{ old('company_reg_no', isset($company->company_reg_no) ? $company->company_reg_no : '') }}"/>
            <span id="textarea1-error"
                  class="text-danger">{{ $errors->first('company_reg_no') }}</span>
            <label for="Name">Company Registration No</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-content">
            <select class="form-control select2-list" name="category_id"
                    data-placeholder="Select industry" required>
                <option value="">Select Industry Type</option>
                @foreach($categories as $category)
                    <option
                        value="{{$category->id}}" {{ isset($company->category_id) ? $company->category_id == $category->id ? 'selected' : '' : '' }}>{{$category->name}}</option>
                @endforeach
            </select>
            <label>Select Industry Type</label>
            <span id="textarea1-error"
                  class="text-danger">{{ $errors->first('category_id') }}</span>
                </div>
                <div class="input-group-btn">
                    <a href="{{route('category.create','company')}}">
                        <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <select name="company_size" class="form-control select2-list"
                    data-placeholder="Company Size" required>
                <option
                    value="10" {{ isset($company->company_size) ? $company->company_size == '10' ? 'selected' : '' : '' }}>
                    1-10 Employees
                </option>
                <option
                    value="50" {{ isset($company->company_size) ? $company->company_size == '50' ? 'selected' : '' : '' }}>
                    10-50 Employees
                </option>
                <option
                    value="100" {{ isset($company->company_size) ? $company->company_size == '100' ? 'selected' : '' : '' }}>
                    50-100 Employees
                </option>
                <option
                    value="200" {{ isset($company->company_size) ? $company->company_size == '200' ? 'selected' : '' : '' }}>
                    100-200 Employees
                </option>
                <option
                    value="500" {{ isset($company->company_size) ? $company->company_size == '500' ? 'selected' : '' : '' }}>
                    200-500 Employees
                </option>
                <option
                    value="1000" {{ isset($company->company_size) ? $company->company_size == '1000' ? 'selected' : '' : '' }}>
                    500-1000 Employees
                </option>
                <option
                    value="1001" {{ isset($company->company_size) ? $company->company_size == '1001' ? 'selected' : '' : '' }}>
                    1000+ Employees
                </option>
                <option
                    value="confidential" {{ isset($company->company_size) ? $company->company_size == 'confidential' ? 'selected' : '' : '' }}>
                    Confidential
                </option>
            </select>
            <span id="textarea1-error"
                  class="text-danger">{{ $errors->first('company_size') }}</span>
            <label for="Name">Company Size</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <select name="ownership" class="form-control select2-list"
                    data-placeholder="Company Size" required>
                <option
                    value="government" {{ isset($company->ownership) ? $company->ownership == 'government' ? 'selected' : '' : '' }}>
                    Government
                </option>
                <option
                    value="private" {{ isset($company->ownership) ? $company->ownership == 'private' ? 'selected' : '' : '' }}>
                    Private
                </option>
                <option
                    value="public" {{ isset($company->ownership) ? $company->ownership == 'public' ? 'selected' : '' : '' }}>
                    Public
                </option>
                <option
                    value="non-profit" {{ isset($company->ownership) ? $company->ownership == 'non-profit' ? 'selected' : '' : '' }}>
                    Non-profit
                </option>
            </select>
            <span id="textarea1-error"
                  class="text-danger">{{ $errors->first('ownership') }}</span>
            <label for="Name">Ownership</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" name="website" class="form-control"
                   value="{{ old('website', isset($company->website) ? $company->website : '') }}"/>
            <span id="textarea1-error"
                  class="text-danger">{{ $errors->first('website') }}</span>
            <label for="Name">Company Website</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <strong>Description</strong>
            <textarea name="description" id="" class="ckeditor">{{old('description',isset($company->description)?$company->description : '')}}</textarea>
            <span id="textarea1-error"
                  class="text-danger">{{ $errors->first('description') }}</span>
        </div>
    </div>
</div>
