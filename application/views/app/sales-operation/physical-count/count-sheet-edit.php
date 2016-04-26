<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-5">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Count Sheet No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" value="CS10001" id="" tabindex="1" name="u_userid" placeholder="Count Sheet No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Count Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="12/02/15" id="" tabindex="1" name="u_userid" placeholder="Count Date">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="SM - Megamall" id="" tabindex="1" name="u_userid" placeholder="Location">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="[Remerks]" id="" tabindex="1" name="u_userid" placeholder="Remarks">
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

		