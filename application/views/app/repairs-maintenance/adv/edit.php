<!-- <div class="modal-header">
    <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Edit</h4>
  </div>
  <div class="modal-body">
    <div id="data-container" class="container-fluid">
      <form class="form-horizontal row page-form" role="form" class="container-fluid">
			<span class="col-md-4">
				<div class="form-group">
				  <label for="sel1" class="control-label col-xs-5">Location:</label>
				  <div class="col-xs-7">
			        <input type="text" class="form-control" value="SM - Megamall" id="" tabindex="1" name="u_userid" placeholder="Location">
			      </div>
				</div>
				<div class="form-group">
			      <label class="control-label col-xs-5" for="">Address:</label>
			      <div class="col-xs-7">
			        <input type="text" class="form-control" value="Pasig City" id="" tabindex="2" name="u_username" placeholder="Address">
			      </div>
			    </div>
			</span>
			<span class="col-md-4">
			    <div class="form-group">
			      <label class="control-label col-xs-5" for="">Company Type:</label>
			      <div class="col-xs-7">
			        <input type="text" class="form-control" value="Fixed" id="" tabindex="2" name="u_username" placeholder="Company Type">
			      </div>
			    </div>
			    <div class="form-group">
			      <label class="control-label col-xs-5" for="">Fixed Rent:</label>
			      <div class="col-xs-7">
			        <input type="text" class="form-control" value="50,000.00" id="" tabindex="2" name="u_username" placeholder="Fixed Rent">
			      </div>
			    </div>
			</span>
			<span class="col-md-4">
				<div class="form-group">
			      <label class="control-label col-xs-5" for="">Sales Sharing %:</label>
			      <div class="col-xs-7">
			        <input type="text" class="form-control" value="" id="" tabindex="2" name="u_username" placeholder="Sales Sharing %">
			      </div>
			    </div>
			    <div class="form-group">
			      <label class="control-label col-xs-5" for="">Floor Area:</label>
			      <div class="col-xs-7">
			        <input type="text" class="form-control" value="300 sqm" id="" tabindex="1" name="u_userid" placeholder="Floor Area">
			      </div>
			    </div>
			</span>
		</form>
    </div>
  </div>
  <div class="modal-footer"> 
    <a type="button" href="#" class="btn btn-default form-btn main-clr">
	  Save
	</a>
	<a type="button" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3)) ?>" data-dismiss="modal" class="btn btn-default form-btn sub-clr">
	  Back
	</a>
  </div> -->
  <div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
        <span class="col-md-6">
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Document No.:</label>
            <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Document No.">
              </div>
          </div>
          <div class="form-group">
              <label class="control-label col-xs-5" for="">Document Date:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Document Date">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Branch / Department:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Branch / Department">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Location:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Locationt">
              </div>
            </div>
          <div class="form-group">
              <label class="control-label col-xs-5" for="">Item Code:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Item Code">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Description:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Description">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Qty:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Qty">
              </div>
            </div>
        </span>
		<span class="col-md-6">
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Unit:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Unit">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Net Book Value:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Net Book Value">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Estimated Market Value:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Estimated Market Value">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Disposal Identification:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Disposal Identification">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Remarks:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Remarks">
              </div>
            </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" href="#" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3)) ?>" class="btn btn-default form-btn sub-clr">
				  Back
				</a>
			</div>
		</div>
	</div>
</div>