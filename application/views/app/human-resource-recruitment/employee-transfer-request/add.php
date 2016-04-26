<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Document No:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Document No">
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
				      <label class="control-label col-xs-5" for="">Company:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Company">
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Concept:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Concept">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Employee Name:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Employee Name">
				      </div>
				    </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Position:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Position">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Position Level:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Position Level">
              </div>
            </div>
          </span>
          <span class="col-md-4">
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Position From:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Position From">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Position To:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Position To">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Place of Assignment From:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Place of Assignment From">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Place of Assignment To:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Place of Assignment To">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Nature of Transfer:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Nature of Transfer">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Date Start:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Date Start">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Date End:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Date End">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Remarks:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Remarks">
              </div>
            </div>
          </span>
			</form>
			<hr>
			<div class="form-group">
				<a type="button" href="#" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3)) ?>" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3)) ?>/" class="btn btn-default form-btn sub-clr">
				  Back
				</a>
			</div>
		</div>
	</div>
</div>
					
<!-- 
<div class="modal-header">
    <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Add</h4>
  </div>
  <div class="modal-body">
    <div id="data-container" class="container-fluid">
      <form class="form-horizontal row page-form" role="form" class="container-fluid">
        <span class="col-md-4">
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Location:</label>
            <div class="col-xs-7">
              <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Location">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-5" for="">Address:</label>
            <div class="col-xs-7">
              <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Address">
            </div>
          </div>
        </span>
        <span class="col-md-4">
          <div class="form-group">
            <label class="control-label col-xs-5" for="">Company Type:</label>
            <div class="col-xs-7">
              <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Company Type">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-5" for="">Fixed Rent:</label>
            <div class="col-xs-7">
              <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Fixed Rent">
            </div>
          </div>
        </span>
        <span class="col-md-4">
          <div class="form-group">
            <label class="control-label col-xs-5" for="">Sales Sharing %:</label>
            <div class="col-xs-7">
              <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Sales Sharing %">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-5" for="">Floor Area:</label>
            <div class="col-xs-7">
              <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Floor Area">
            </div>
          </div>
        </span>
      </form>
    </div>
  </div>
  <div class="modal-footer">
    <a type="button" href="#" class="btn btn-default form-btn main-clr">
      Save & New
    </a>
    <a type="button" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3)) ?>" class="btn btn-default form-btn main-clr">
      Save & Close
    </a>
    <a type="button" href="" class="btn btn-default form-btn sub-clr side-form-close" data-dismiss="modal">
      Close
    </a>  
  </div> -->