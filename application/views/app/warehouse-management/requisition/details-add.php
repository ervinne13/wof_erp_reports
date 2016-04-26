<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Item Type:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Item Type">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Item No:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Item No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Description">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Canvass Price:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Canvass Price">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Requested Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Requested Qty">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remaining Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Remaining Qty">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">UOM:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="UOM">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Reference from:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Reference from">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Reference to:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Reference to">
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
			<div class="btn-cont">
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