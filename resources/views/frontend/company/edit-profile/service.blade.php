@extends('frontend.company.profile')

@section('company-content')
    <div class="dashboard-caption-header">
        <h4><i class="ti-ruler-pencil"></i>Service</h4>
    </div>

    <div class="dashboard-caption-wrap">
        <form class="post-form">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Address*</label>
                        <input type="text" class="form-control" required>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Contact Type</label>
                        <select id="jb-level" class="form-control">
                            <option>---------------------</option>
                            <option>Work</option>
                            <option>Mobile</option>
                            <option>Personal</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
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
