<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container">
				<span class="col-md-6">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Machine id:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Machine id">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Description">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Assigned technician:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Assigned technician">
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Actual Maintenance start:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Actual Maintenance start">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Actual Maintenance End:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Actual Maintenance End">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Comment:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Comment">
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="form-group">
				<a type="button" href="#" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))."/view"?>" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))."/view"?>" class="btn btn-default form-btn sub-clr">
				  Back
				</a>
			</div>
		</div>
	</div>
</div>