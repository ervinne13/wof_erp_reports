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
				      <label class="control-label col-xs-5" for="">Vendor No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="V-100001" id="" tabindex="1" name="u_userid" placeholder="Vendor No">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Vendor Name:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="VENDOR A" id="" tabindex="1" name="u_userid" placeholder="Vendor Name">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Vendor Address:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="SUCAT, PARANAQUE" id="" tabindex="1" name="u_userid" placeholder="Vendor Address">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Transaction Type:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Transaction Type">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Required:</label>
				      <div class="col-xs-7">
					        <input type="text" class="form-control" value="05/28/15" id="" tabindex="2" name="u_username" placeholder="Date Required">
					   </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Payment Terms:</label>
				      <div class="col-xs-7">
					        <input type="text" class="form-control" value="30 Days" id="" tabindex="2" name="u_username" placeholder="Payment Terms">
					   </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">External Do No.:</label>
					  <div class="col-xs-7">
					        <input type="text" class="form-control" value="[External Do No]" id="" tabindex="2" name="u_username" placeholder="External Do No.">
					   </div>
					</div>
				</span>
				<span class="col-md-4">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Vendor Ref No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="[Vendor Reference No.]" id="" tabindex="2" name="u_username" placeholder="Vendor Ref No.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Exp Delivery Date:</label>
				      <div class="col-xs-7">
					        <input type="text" class="form-control" value="05/28/15" id="" tabindex="2" name="u_username" placeholder="Expected Delivery Date.">
					   </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Priority Level:</label>
				      <div class="col-xs-7">
					        <input type="text" class="form-control" value="High" id="" tabindex="2" name="u_username" placeholder="Priority Level">
					   </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="[Remarks]" tabindex="1" name="u_userid" placeholder="Remarks">
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
