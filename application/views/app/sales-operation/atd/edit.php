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
					  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" value="PO-100001" id="" tabindex="1" name="u_userid" placeholder="Document No.">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="04/28/15" id="" tabindex="2" name="u_username" placeholder="Document Date">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Employee ID:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="100001" id="" tabindex="2" name="u_username" placeholder="Employee ID">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="200.00" id="" tabindex="2" name="u_username" placeholder="Amount">
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Reference Doc:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="SI10001" id="" tabindex="2" name="u_username" placeholder="Reference Doc">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Reason:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Reason" id="" tabindex="1" name="u_userid" placeholder="Reason">
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="form-group">
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
