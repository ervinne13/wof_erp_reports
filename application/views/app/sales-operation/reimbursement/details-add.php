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
					  <label for="sel1" class="control-label col-xs-5">Date:</label>
					  <div class="col-xs-7">
				        <input type="date" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Date">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Receipt No:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Receipt No">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Payee:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Payee">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Adress:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Adress">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">TIN:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="TIN">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Particulars:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Particulars">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Amount">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">VAT:</label>
					  <div class="col-xs-7">
				        <input type="checkbox">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Charge to:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Charge to">
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