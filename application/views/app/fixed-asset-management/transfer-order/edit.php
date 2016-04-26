<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-5">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="RQ-10001" tabindex="1" name="u_userid" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="12/02/15" tabindex="1" name="u_userid" placeholder="Document Date.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Required:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="12/25/15" tabindex="1" name="u_userid" placeholder="Date Required">
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Transfer From:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="[Transfer From]" tabindex="1" name="u_userid" placeholder="Transfer From">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Transfer To:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="[Transfer To]" tabindex="1" name="u_userid" placeholder="Transfer To">
				      </div>
				    </div>
				</span>
				<span class="col-md-5">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="[Remarks]" tabindex="1" name="u_userid" placeholder="Remarks">
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Ext Doc No:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="[Ext. Doc No.]" tabindex="2" name="u_username" placeholder="Ext Doc No">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Priority Level:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id=""  value="High" tabindex="2" name="u_username" placeholder="Priority Level">
				      </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Reason:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="[Reason]" tabindex="2" name="u_username" placeholder="Reason Code">
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

		