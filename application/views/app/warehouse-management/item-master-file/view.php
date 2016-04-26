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
	                <li><a href="">Send Approval Request</a></li>
					<li><a href="">Cancel Approval Request</a></li>
					<li><a href="">Reopen</a></li>
					<li><a href="">Approve (for approvers only)</a></li>
					<li><a href="">Reject (for approvers only)</a></li>
					<li><a href="">Print</a></li>
					<li><a href="">Track Document</a></li>
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
				    <li role="presentation" class="active"><a href="#gen-info" role="tab" data-toggle="tab">General Info</a></li>
				    <li role="presentation"><a href="#attribute"  role="tab" data-toggle="tab">Attribute</a></li>
				    <li role="presentation"><a href="#posting"  role="tab" data-toggle="tab">Posting Group</a></li>
				    <li role="presentation"><a href="#pack-items"  role="tab" data-toggle="tab">Pack Items</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="gen-info">
						<form class="form-horizontal row page-form" role="form" class="container-fluid">
							<span class="col-md-6">
								<div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Item No.:</label>
								  <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Item No.]</label>
							      </div>
								</div>
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">Purchase Description:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Purchase Description]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Sales Description:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Sales Description]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Short Description:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Short Description]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Category:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Category]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Minimum Stock Level:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Minimum Stock Level]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Size Set:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Size Set]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Weight:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Weight]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Sales Description:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Sales Description]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Unit Cost:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Unit Cost]</label>
							      </div>
							    </div>
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">Cost of Goods:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Cost of Goods]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Unit Price:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Unit Price]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Manufacturer Part No.:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Manufacturer Part No.]</label>
							      </div>
							    </div>
							</span>
							<span class="col-md-6">
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">Model:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Model]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Acquisition Date:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Acquisition Date]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Expiration Date:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Expiration Date]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Sale Price:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Sale Price]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Sale Item:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">YES</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Promo:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">YES</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Consigned:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">YES</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Royalty:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">YES</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Serialize:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">YES</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Sub License:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">YES</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Package Item:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">YES</label>
							      </div>
							    </div>
							</span>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane" id="attribute">
						<form class="form-horizontal row page-form" role="form" class="container-fluid">
							<span class="col-md-4">
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">Type:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Type]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Brand:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Brand]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">UOM:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[UOM]</label>
							      </div>
							    </div>
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">Size:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Size]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Color:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Color]</label>
							      </div>
							    </div>
							</span>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane" id="posting">
						<form class="form-horizontal row page-form" role="form" class="container-fluid">
							<span class="col-md-7">
								<div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Inventory Posting Group:</label>
								  <div class="col-xs-7">
							        <label for="sel1" class="control-label">[Inventory Posting Group]</label>
							      </div>
								</div>
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">VAT Posting Group:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[VAT Posting Group]</label>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">WHT Posting Group:</label>
							      <div class="col-xs-7">
							        <label for="sel1" class="control-label">[WHT Posting Group]</label>
							      </div>
							    </div>
							</span>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane" id="pack-items">
						<div class="table-container">
							<table id="others-tbl" class="table table-striped table-hover table-bordered  table-condensed">
								<thead>
									<tr>
										<th>Item Type.</th>
										<th>Item No.</th>
										<th>Description</th>
										<th>Qty</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
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