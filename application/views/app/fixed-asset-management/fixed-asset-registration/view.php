<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
          	<span class="dropdown pull-right">
				<a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                	Functions
                	<span class="caret"></span>
              	</a>
              	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
	                <li><a href="">Create Depriciation Schedule</a></li>
	                <li><a href="">Dispose</a></li>
					<li><a href="">Recalculate</a></li>
					<li><a href="">Batch Depreciation Journal Entry Posting</a></li>
					<li><a href="">Print</a></li>
              	</ul>

              	<a class="cls-btn" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
				  Close
				</a>
            </span>
      	</h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<div role="tabpanel">
				<ul class="nav nav-tabs" id="items-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#desc" role="tab" data-toggle="tab">Description</a></li>
				    <li role="presentation"><a href="#depriciation"  role="tab" data-toggle="tab">Depreciation</a></li>
				    <li role="presentation"><a href="#calc-cost"  role="tab" data-toggle="tab">Fixed Asset Calculated Cost</a></li>
				    <li role="presentation"><a href="#movement"  role="tab" data-toggle="tab">Movement History</a></li>
				    <li role="presentation"><a href="#sale-asset"  role="tab" data-toggle="tab">Sale Asset Information</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="desc">
						<form class="form-horizontal row page-form" role="form" class="container-fluid">
							<span class="col-md-5">
								<div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Machine name:</label>
								  <div class="col-xs-7">
							        <label for="sel1" class="control-label">Machine name:</label>
							      </div>
								</div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Machine type:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Machine type:</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Machine Tag:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Machine Tag:</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">TCOS:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">TCOS:</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Estimated life:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Estimated life:</label>
							      </div>
							    </div>
							</span>
							<span class="col-md-5">
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">Investment sharing:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Investment sharing:</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Machine Investor:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Machine Investor:</label>
							      </div>
							    </div>
							    <div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Space Required:</label>
								  <div class="col-xs-7">
							        <label for="sel1" class="control-label">Space Required:</label>
							      </div>
								</div>
								<div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Sales sharing:</label>
								  <div class="col-xs-7">
							        <label for="sel1" class="control-label">Sales sharing:</label>
							      </div>
								</div>
								 <div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Payback:</label>
								  <div class="col-xs-7">
							        <label for="sel1" class="control-label">Payback:</label>
							      </div>
								</div>
								<div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Payout:</label>
								  <div class="col-xs-7">
							         <label for="sel1" class="control-label">Payout:</label>
							      </div>
								</div>
							</span>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane" id="depriciation">
						<form class="form-horizontal row page-form" role="form" class="container-fluid">
							<span class="col-md-6">
								<div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">PO Reference No. :</label>
								  <div class="col-xs-7">
							        <label for="sel1" class="control-label">PO Reference No. :</label>
							      </div>
								</div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Supplier Name:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Supplier Name:</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Acquisition Date:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Acquisition Date:</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Acquisition Cost:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Acquisition Cost:</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Warranty Expiration Date:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Warranty Expiration Date:</label>
							      </div>
							    </div>
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">No. of Depreciation in Years:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">No. of Depreciation in Years:</label>
							      </div>
							    </div>
							</span>
							<span class="col-md-6">
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Depreciation Starting Date:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Depreciation Starting Date:</label>
							      </div>
							    </div>
							    <div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Depreciation Ending Date:</label>
								  <div class="col-xs-7">
							        <label for="sel1" class="control-label">Depreciation Ending Date:</label>
							      </div>
								</div>
								<div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Book Value:</label>
								  <div class="col-xs-7">
							        <label for="sel1" class="control-label">Book Value:</label>
							      </div>
								</div>
							</span>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane" id="calc-cost">
						<form class="form-horizontal row page-form" role="form" class="container-fluid">
							<span class="col-md-7">
								<div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Prior Depreciation:</label>
								  <div class="col-xs-7">
							        <label for="sel1" class="control-label">Prior Depreciation:</label>
							      </div>
								</div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Current Depreciation:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Current Depreciation:</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Accumulated Depreciation:</label>
							      <div class="col-xs-7">
							       <label class="control-label" for="">Accumulated Depreciation:</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Current Amortization:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Current Amortization:</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Depreciation Amortization Expense:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Depreciation Amortization Expense:</label>
							      </div>
							    </div>
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">Salvage Value:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Salvage Value:</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Sale Expense:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Sale Expense:</label>
							      </div>
							    </div>
							</span>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane" id="movement">
						<div class="table-container">
							<table id="others-tbl" class="table table-striped table-hover table-bordered  table-condensed">
								<thead>
									<tr>
										<th>TO Reference No.</th>
										<th>Transfer Date</th>
										<th>Location From</th>
										<th>Location To</th>
									</tr>
								</thead>
								<tbody>				 
								</tbody>
							</table>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="sale-asset">
						<form class="form-horizontal row page-form" role="form" class="container-fluid">
							<span class="col-md-6">
								<div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Asset Sold?:</label>
								  <div class="col-xs-7">
							        <label for="sel1" class="control-label">Asset Sold?:</label>
							      </div>
								</div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Sales Date:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Sales Date:</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Gain / Loss in Sales:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Gain / Loss in Sales:</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Sale Price:</label>
							      <div class="col-xs-7">
							        <label class="control-label" for="">Sale Price:</label>
							      </div>
							    </div>
							</span>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#items-tabs a').click(function (e) {
	  $(this).tab('show');
	});
</script>