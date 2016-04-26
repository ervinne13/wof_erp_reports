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
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
					  <div class="col-xs-7">
				         <label class="control-label">RQ-10001</label> 
					  </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				         <label class="control-label">12/02/15</label> 
					  </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Status:</label>
				      <div class="col-xs-7">
						   <label class="control-label">Pending</label>
					  </div>
				    </div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Company:</label>
					  <div class="col-xs-7">
						  <label class="control-label">[Company]</label>
					  </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Department:</label>
					  <div class="col-xs-7">
						  <label class="control-label">[Department]</label>
					  </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Branch:</label>
					  <div class="col-xs-7">
						  <label class="control-label">[Branch]</label>
					  </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Deparment Assistant:</label>
					  <div class="col-xs-7">
						  <label class="control-label">[Deparment Assistant]</label>
					  </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Deparment Head:</label>
					  <div class="col-xs-7">
						  <label class="control-label">[Deparment Head]</label>
					  </div>
					</div>
				</span>
			</form>
			<div class="details">Details</div>
			<table class="presentation table table-striped table-hover table-bordered  table-condensed">
				<thead>
					<tr>
						<th>
							<a href="<?= base_url().uri_string() ?>/detail-add" class="">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th>Par No.</th>
						<th>Item Type.</th>
						<th>Item No.</th>
						<th>Description</th>
						<th>UOM</th>
						<th>Qty</th>
						<th>Cost</th>
						<th>Date Issued</th>
						<th>Issuud By</th>
						<th>Remarks</th>
						<th>Date Received</th>
						<th>Received By</th>
						<th>Checked By</th>
						<th>Remarks</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/detail-update" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="#" class="">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
						<td>Par No.</td>
						<td>Item Type.</td>
						<td>Item No.</td>
						<td>Description</td>
						<td>UOM</td>
						<td>Qty</td>
						<td>Cost</td>
						<td>Date Issued</td>
						<td>Issuud By</td>
						<td>Remarks</td>
						<td>Date Issued</td>
						<td>Received By</td>
						<td>Checked By</td>
						<td>Remarks</td>
					</tr>
				</tbody>
			</table>
		</div>
    </div>
</div>
