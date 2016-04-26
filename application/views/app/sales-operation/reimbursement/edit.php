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
				          <input type="text" class="form-control" value="RE-100001" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="04/21/15" placeholder="Document Date">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">External Doc. No.:</label>
				      <div class="col-xs-7">
				         <input type="text" class="form-control" value="[External Doc. No.]"  placeholder="External Doc. No.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Required:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="04/21/15" placeholder="Date Required">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5"  for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="[Remarks]" placeholder="Remarks">
				       </div> 
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Doc Type:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="w/ CA" placeholder="Doc Type">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">CAR Doc. No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="CAR-100003" placeholder="Doc Type">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">CAR Doc. Amount:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="1,000.00" placeholder="Doc Type">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Liquidated Amount:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="1,200.00" placeholder="Liquidated Amount">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">For Reimbursement:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="200.00" placeholder="For Reimbursement">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Employee Name:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Employee A" placeholder="Employee Name">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Company:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="[Company]" placeholder="Company">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Cost Center:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="For Liquidation" placeholder="Cost Center">
				      </div>
				    </div>
				</span>
			</form>
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
