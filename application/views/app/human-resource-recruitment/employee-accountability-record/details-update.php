<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Par No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="1" name="u_userid" placeholder="Par No.">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Item Type:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="1" name="u_userid" placeholder="Item Type">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Item No:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="1" name="u_userid" placeholder="Item No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="1" name="u_userid" placeholder="Description">
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">UOM:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="2" name="u_username" placeholder="UOM">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="2" name="u_username" placeholder="Qty">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Cost:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="2" name="u_username" placeholder="Cost ">
				      </div>
				    </div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Issued:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="2" name="u_username" placeholder="Date Issued">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Issued By:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="2" name="u_username" placeholder="Issued By ">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="2" name="u_username" placeholder="Remarks ">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Date Received:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="2" name="u_username" placeholder="Date Received ">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Received By:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="2" name="u_username" placeholder="Received By ">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Checked By:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="2" name="u_username" placeholder="Checked By ">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" tabindex="2" name="u_username" placeholder="Remarks ">
				      </div>
				    </div>

				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" href="#" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))."/view"?>" class="btn btn-default form-btn sub-clr">
				  Back
				</a>
			</div>
		</div>
    </div>
</div>