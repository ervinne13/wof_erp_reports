<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" value="RT-100001" id="" tabindex="1" name="u_userid" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="04/21/15" id="" tabindex="1" name="u_userid" placeholder="Document Date.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Return Type:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Return to Supplier" id="" tabindex="1" name="u_userid" placeholder="Return Type">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Code:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Vendor A" id="" tabindex="1" name="u_userid" placeholder="Supplier Code">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="[Remarks]" id="" tabindex="2" name="u_username" placeholder="Remarks">
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Ext. Doc. No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="[Ext Doc No]" id="" tabindex="2" name="u_username" placeholder="Ext. Doc. No.">
				      </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Priority Level:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" value="High" id="" tabindex="2" name="u_username" placeholder="Reason Code">
				      </div>
					</div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Reason:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" value="[Ext Doc No]" id="" tabindex="2" name="u_username" placeholder="Reason Code">
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
