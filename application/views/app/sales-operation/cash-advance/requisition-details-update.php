<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-5">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Particulars:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" value="Traspo Allowance" id="" tabindex="1" name="u_userid" placeholder="Particulars">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Qty/No. of Days:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="10" id="" tabindex="1" name="u_userid" placeholder="Qty/No. of Days">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="50.00" id="" tabindex="1" name="u_userid" placeholder="Amount">
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