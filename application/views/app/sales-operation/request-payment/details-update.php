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
					  <label for="sel1" class="control-label col-xs-5">Item Type:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" value="Utility Bills" id="" tabindex="1" name="u_userid" placeholder="Item Type">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Item No:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="UB1000001" id="" tabindex="1" name="u_userid" placeholder="Item No">
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Payment for Electric Bill for the month of January 2015" id="" tabindex="1" name="u_userid" placeholder="Description">
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="1" id="" tabindex="2" name="u_username" placeholder="Qty">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">CY:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Php" id="" tabindex="2" name="u_username" placeholder="CY">
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Unit Price:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="50,000.00" id="" tabindex="2" name="u_username" placeholder="Unit Price">
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="50,000.00" id="" tabindex="2" name="u_username" placeholder="Amount">
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount in LCY:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="50,000.00" id="" tabindex="2" name="u_username" placeholder="Amount in LCY">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Cost Center:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Head Office" id="" tabindex="2" name="u_username" placeholder="Cost Center">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Comment:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="[Comment]" id="" tabindex="2" name="u_username" placeholder="Comment">
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