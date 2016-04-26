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
					<li><a href="">Approve (for approvers only)</a></li>
					<li><a href="">Reject (for approvers only)</a></li>
					<li><a href="">Post Return</a></li>
					<li><a href="">Print Return Slip</a></li>
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
				<span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
					  <div class="col-xs-7">
				       <label for="sel1" class="control-label">RT-100001</label>
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">04/21/15</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">External Document No.:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">[External Document No.]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Priority Level:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">High</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">[Remarks]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Status:</label>
				      <div class="col-xs-7">
				        <label for="sel1" class="control-label">Approved</label>
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Return Type:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">Return to Supplier</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Code:</label>
				      <div class="col-xs-7">
				         <label class="control-label" for="">Vendor A</label>
				      </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Reason:</label>
					  <div class="col-xs-7">
				        <label for="sel1" class="control-label">For Repair</label>
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
						<th>Item Type.</th>
						<th>Item No.</th>
						<th>Machine Tag</th>
						<th>Description</th>
						<th>Qty</th>
						<th>UOM</th>
						<th>CY</th>
						<th>Comment</th>
						<th>Cost Center</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/detail-update" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="#">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
						<td>Machine</td>	
						<td>FA100001</td>	
						<td>[Machine tag]</td>	
						<td>Drummania V7</td>	
						<td>1</td>	
						<td>unit</td>	
						<td>USD</td>	
						<td>[comment]</td>	
						<td>SM - Naga</td>	
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
