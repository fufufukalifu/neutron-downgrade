<!-- konten --> 
<section id="main" role="main" class="mt10">
  <div class="col-md-12">
    <!-- START Form panel -->
    <form class="panel panel-default form-horizontal form-bordered">
    <div class="panel-heading"><h5 class="panel-title">Validation example</h5></div>
    <div class="panel-body pt0">
      <div class="form-group message-container"></div><!-- will be use as done/fail message container -->
      <div class="form-group">
        <label class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>
        <div class="col-sm-5">
          <input type="text" name="first-name" class="form-control" placeholder="First" data-parsley-required="true">
        </div>
        <div class="col-sm-4">
          <input type="text" name="last-name" class="form-control" placeholder="Last" data-parsley-required="true">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Address <span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <div class="row mb5">
            <div class="col-xs-12">
              <input type="text" name="address-street" class="form-control" placeholder="Street Address"
              data-parsley-required="true"
              data-parsley-errors-container="#address-error-container"
              data-parsley-error-message="Please fill in your street address">
            </div>
          </div>
          <div class="row mb5">
            <div class="col-xs-12">
              <input type="text" name="address-line2" class="form-control" placeholder="Address Line 2"
              data-parsley-required="true"
              data-parsley-errors-container="#address-error-container"
              data-parsley-error-message="Please fill in your address line 2">
            </div>
          </div>
          <div class="row mb5">
            <div class="col-xs-6">
              <input type="text" name="address-city" class="form-control" placeholder="City">
            </div>
            <div class="col-xs-6">
              <input type="text" name="address-state" class="form-control" placeholder="State / Region">
            </div>
          </div>
          <div class="row mb10">
            <div class="col-xs-6">
              <input type="text" name="address-postal" class="form-control" placeholder="Postal / Zip Code">
            </div>
            <div class="col-xs-6">
              <select class="form-control" name="address-country"
              data-parsley-required="true"
              data-parsley-errors-container="#address-error-container"
              data-parsley-error-message="Please select your country">
              <option value="" selected="">Country</option>
              <option value="af">Afghanistan</option>
              <option value="dz">Algeria</option>
              <option value="ar">Argentina</option>
              <option value="au">Australia</option>
              <option value="bd">Bangladesh</option>
              <option value="br">Brazil</option>
              <option value="cm">Cameroon</option>
              <option value="ca">Canada</option>
              <option value="co">Colombia</option>
              <option value="dk">Denmark</option>
              <option value="eg">Egypt</option>
              <option value="et">Ethiopia</option>
              <option value="fr">France</option>
              <option value="de">Germany</option>
              <option value="gh">Ghana</option>
            </select>
          </div>
        </div>
        <!-- address error container -->
        <div class="row">
          <div class="col-xs-12" id="address-error-container"></div>
        </div>
        <!--/ address error container -->
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Email <span class="text-danger">*</span></label>
      <div class="col-sm-9">
        <input type="text" name="email" class="form-control" placeholder="you@mail.com" data-parsley-required="true" data-parsley-trigger="change" data-parsley-type="email">
      </div>
    </div>
  </div>
  <div class="panel-footer">
    <button type="reset" class="btn btn-default">Reset</button>
    <button type="submit" class="btn btn-success ladda-button" data-style="zoom-in"><span class="ladda-label">Submit</span></button>
  </div>
</form>
<!--/ END Form panel -->
</div>
</div>
<!--/ END row -->
</section>
