<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <input type="text" name="keywords" data-role="tagsinput"
                   value="{{ old('keywords', isset($company->keywords) ? $company->keywords : '') }}"/>
            <label for="keywords">Keywords</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-content">
                    <select class="form-control select2-list" name="user_id" required
                            data-placeholder="Assign User">
                        <option value="">Assign User</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" {{ isset($company->user_id) ? $company->user_id == $user->id ? 'selected' : '' :''}} >{{$user->full_name}}</option>
                        @endforeach
                    </select>
                    {{--            <label>Assign User</label>--}}
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
