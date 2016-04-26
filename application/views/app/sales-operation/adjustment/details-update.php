<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
          	<div class="dropdown pull-right">
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container">
				<span class="col-md-4">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Item Type:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Machine" id="" tabindex="1" name="u_userid" placeholder="Item Type">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Item No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="RD100003" id="" tabindex="1" name="u_userid" placeholder="Item No.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Hello Kitty" id="" tabindex="1" name="u_userid" placeholder="Description">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Unit Cost:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="10.00" id="" tabindex="2" name="u_username" placeholder="Unit Cost">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">UOM:</label>
				      <div class="col-xs-7">          
				        <input type="text" class="form-control" value="pc" id="" name="u_password" placeholder="UOM" tabindex="3" >
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">On Hand Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="100" id="" tabindex="2" name="u_username" placeholder="On Hand Qty">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Adjusted Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="99" id="" tabindex="2" name="u_username" placeholder="Adjusted Qty">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Cost/Profit Center:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="SM - Naga" id="" tabindex="1" name="u_userid" placeholder="Cost/Profit Center">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">BIN/Location:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="[BIN/Location]" id="" tabindex="1" name="u_userid" placeholder="BIN/Location">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Comment:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="[comment]" id="" tabindex="1" name="u_userid" placeholder="Comment">
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="form-group">
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