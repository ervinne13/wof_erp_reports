<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
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
							<span class="col-md-6">
								<div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Asset ID:</label>
								  <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Asset ID">
							      </div>
								</div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Item Code:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Item Code">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Item Description:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Item Description">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Item Type:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Item Type">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Company:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Company">
							      </div>
							    </div>
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">Store / Location:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Store / Location">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">FA Posting Group:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="FA Posting Group">
							      </div>
							    </div>
							</span>
						<form>
					</div>
					<div role="tabpanel" class="tab-pane" id="depriciation">
						<form class="form-horizontal row page-form" role="form" class="container-fluid">
							<span class="col-md-6">
								<div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">PO Reference No. :</label>
								  <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="PO Reference No. ">
							      </div>
								</div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Supplier Name:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Supplier Name">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Acquisition Date:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Acquisition Date">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Acquisition Cost:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Acquisition Cost">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Warranty Expiration Date:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Warranty Expiration Date">
							      </div>
							    </div>
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">No. of Depreciation in Years:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="No. of Depreciation in Years">
							      </div>
							    </div>
							</span>
							<span class="col-md-6">
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Depreciation Starting Date:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Depreciation Starting Date">
							      </div>
							    </div>
							    <div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Depreciation Ending Date:</label>
								  <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Depreciation Ending Date">
							      </div>
								</div>
								<div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Book Value:</label>
								  <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Book Value">
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
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Prior Depreciation">
							      </div>
								</div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Current Depreciation:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Current Depreciation">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Accumulated Depreciation:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Accumulated Depreciation">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Current Amortization:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Current Amortization">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Depreciation Amortization Expense:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Depreciation Amortization Expense">
							      </div>
							    </div>
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">Salvage Value:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Salvage Value">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Sale Expense:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Sale Expense">
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
							        <input type="checkbox">
							      </div>
								</div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Sales Date:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Sales Date">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Gain / Loss in Sales:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Gain / Loss in Sales">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Sale Price:</label>
							      <div class="col-xs-7">
							        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Sale Price">
							      </div>
							    </div>
							</span>
						</form>
					</div>
				</div>
			</div>
			<hr>
			<div class="form-group">
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

<div class="modal fade notes-modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Notes</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-12">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Notes:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Notes">
				      </div>
					</div>
				</span>
			</form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default form-btn main-clr">Save</button>
      </div>
    </div>
  </div>
</div>	
<script type="text/javascript">
	$('#items-tabs a').click(function (e) {
	  $(this).tab('show');
	});
</script>