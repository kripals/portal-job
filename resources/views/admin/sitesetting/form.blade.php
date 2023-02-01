<div class="section-body contain-lg">
  <div class="row">

    <!-- BEGIN ADD CONTACTS FORM -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-head style-primary">
          <header>{!! $header !!}</header>
        </div>
        <!-- BEGIN DEFAULT FORM ITEMS -->
        <div class="card-body style-primary form-inverse">
          <div class="row">
            <div class="col-xs-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group floating-label">
                    {{ Form::text('name',old('name'),['class'=>'form-control','required']) }}
                    <label for="CompanyName">Company Name</label>
                  </div>
                </div><!--end .col -->
                <div class="col-md-6">
                  <div class="form-group floating-label">
                      {{ Form::text('address',old('address'),['class'=>'form-control','required']) }}
                    <label for="Address">Address</label>
                  </div>
                </div><!--end .col -->
              </div><!--end .row -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group floating-label">
                    {{ Form::text('phone',old('phone'),['class'=>'form-control','requireed']) }}
                    <label for="Telephone">Telephone</label>
                  </div>
                </div><!--end .col -->
                <div class="col-md-6">
                  <div class="form-group floating-label">
                    {{ Form::text('email',old('email'),['class'=>'form-control','required']) }}
                    <label for="Email">Email</label>
                  </div>
                </div><!--end .col -->
              </div><!--end .row -->
            </div><!--end .col -->
          </div><!--end .row -->
        </div><!--end .card-body -->
        <!-- END DEFAULT FORM ITEMS -->

        <!-- BEGIN FORM TABS -->
        <div class="card-head style-primary">
          <ul class="nav nav-tabs tabs-text-contrast tabs-accent" data-toggle="tabs">
            <li  class="active"><a href="#general">GENERAL INFO</a></li>
            <li><a href="#contact">CONTACT INFO</a></li>
            <li><a href="#experience">SOCIAL MEDIA INFO</a></li>

          </ul>
        </div><!--end .card-head -->
        <!-- END FORM TABS -->

        <!-- BEGIN FORM TAB PANES -->
        <div class="card-body tab-content">
          <div class="tab-pane" id="contact">
            <div class="row">
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                {{ Form::text('phone1',old('phone1'),['class'=>'form-control']) }}
                      <label for="Phone">Phone(Alternate)</label>
                    </div>
                  </div><!--end .col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ Form::text('phone2',old('phone2'),['class'=>'form-control']) }}
                      <label for="Phone">Phone (Alternate 2)</label>
                    </div>
                  </div><!--end .col -->
                </div><!--end .row -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ Form::text('email1',old('email1'),['class'=>'form-control']) }}
                      <label for="Email">Email (Alternate)</label>
                    </div>
                  </div><!--end .col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ Form::text('email2',old('email2'),['class'=>'form-control']) }}
                      <label for="Email">Email (Alternate 2)</label>
                    </div>
                  </div><!--end .col -->
                  <div class="col-md-12">
                    <div class="form-group">
                      {{ Form::text('map_src',old('map_src'),['class'=>'form-control']) }}
                      <label for="Map">Map Src</label>
                    </div>
                  </div><!--end .col -->
                </div><!--end .row -->
              </div><!--end .col -->
              <div class="col-md-4">
                <div class="form-group">
                  <div id="map-canvas" class="border-gray height-7"></div>
                </div>
              </div><!--end .col -->
            </div><!--end .row -->
          </div><!--end .tab-pane -->
          <div class="tab-pane" id="experience">
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  {{ Form::text('facebook_url',old('facebook_url'),['class'=>'form-control']) }}
                  <label for="Facebook">Facebook Link</label>
                </div><!--end .form-group -->

                <div class="form-group">
                  {{ Form::text('twitter_url',old('twitter_url'),['class'=>'form-control']) }}
                  <label for="Twitter">Twitter Link</label>
                </div><!--end .form-group -->
                <div class="form-group">
                  {{ Form::text('youtube_url',old('youtube_url'),['class'=>'form-control']) }}
                  <label for="Youtube">Youtube Link</label>
                </div><!--end .form-group -->
                <div class="form-group">
                  {{ Form::text('linkedin_url',old('linkedin_url'),['class'=>'form-control']) }}
                  <label for="Linkedin">Linkedin Link</label>
                </div><!--end .form-group -->
                <div class="form-group">
                  {{ Form::text('snaptube_url',old('snaptube_url'),['class'=>'form-control']) }}
                  <label for="Instagram">Instagram Link</label>
                </div><!--end .form-group -->

              </div><!--end .col -->
              <div class="col-md-4">
                <div class="form-group">
                  <div id="map-canvas" class="border-gray height-7"></div>
                </div>
              </div><!--end .col -->
            </div><!--end .row -->
          </div><!--end .tab-pane -->

          <div class="tab-pane active" id="general">
            <div class="row">
              <div class="col-sm-6">
                <strong>Logo</strong>
                @if(isset($siteSetting) && $siteSetting->image)
                <input type="file" name="image" class="dropify"
                data-default-file="{{ asset($siteSetting->image_path) }}"/>
                @else
                <input type="file" name="image" class="dropify"/>
                @endif
              </div>
              <div class="col-sm-6">
                <strong>Alternate Logo</strong>
                @if(isset($siteSetting) && $siteSetting->sub_image)
                <input type="file" name="sub_image" class="dropify"
                data-default-file="{{ asset('uploads/siteSetting/'.$siteSetting->sub_image) }}"/>
                @else
                <input type="file" name="sub_image" class="dropify"/>
                @endif
              </div>
            </div>
          </div><!--end .tab-pane -->
        </div><!--end .card-body.tab-content -->
        <!-- END FORM TAB PANES -->
        <!-- BEGIN FORM FOOTER -->
        <div class="card-actionbar">
          <div class="card-actionbar-row">
          <button type="submit" class="btn btn-block ink-reaction btn-primary-dark" value="save">Update</button>
          </div><!--end .card-actionbar-row -->
        </div><!--end .card-actionbar -->
        <!-- END FORM FOOTER -->
      </div><!--end .card -->
    </div><!--end .col -->
    <!-- END ADD CONTACTS FORM -->
  </div><!--end .row -->
</div><!--end .section-body -->
