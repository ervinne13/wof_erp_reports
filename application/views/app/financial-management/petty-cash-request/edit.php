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
				        <input type="text" class="form-control" value="CAR-100001" id="" tabindex="1" name="u_userid" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="04/21/15" id="" tabindex="1" name="u_userid" placeholder="Document Date.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Required:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="04/21/15" id="" tabindex="1" name="u_userid" placeholder="Date Required">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="1,250.00" id="" tabindex="1" name="u_userid" placeholder="Amount">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Source of Fund:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Petty Cash" id="" tabindex="2" name="u_username" placeholder="Source of Fund">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Requested By:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Employee A" id="" tabindex="2" name="u_username" placeholder="Requested By">
				      </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Cost Center:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" value="SM-Naga" id="" tabindex="2" name="u_username" placeholder="Cost Center">
				      </div>
					</div>
					 <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Purpose:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="[Purpose]" id="" tabindex="2" name="u_username" placeholder="Purpose">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Priority Level:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="High" id="" tabindex="2" name="u_username" placeholder="Priority Level">
				       </div> 
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Remark:</label>
					   <div class="col-xs-7">
				        <input type="text" class="form-control" value="[Remark]" id="" tabindex="2" name="u_username" placeholder="Remark">
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
