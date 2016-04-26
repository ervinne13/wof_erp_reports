<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?>
			<div class="btn-cont row pull-right">
				<a type="button" class="btn cls-btn" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
				  Close
				</a>
				<span class="pull-left dropdown" id="functions">
				  <a href="javascript:void(0)" class="btn" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Functions
				    <span class="caret"></span>
				  </a>
				  <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dLabel">
				     	 <li><a href="">Send Approval Request</a></li>
						<li><a href="">Cancel Approval Request</a></li>
						<li><a href="">Reopen</a></li>
						<li><a href="">Approve (for approvers only)</a></li>
						<li><a href="">Reject (for approvers only)</a></li>
						<li><a href="">Post</a></li>
						<li><a href="">Print</a></li>
						<li><a href="">Document Tracking</a></li>
				  </ul>
				</span>
			</div>
		</h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-5">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
					  <div class="col-xs-7">
				        <label for="sel1" class="control-label">[Document No.]</label>
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">[Document Date]</label>
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">Pending</label>
				      </div>
				    </div>
				</span>
				<span class="col-md-5">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Customer Code:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">[Customer Code]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Customer Name:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">[Customer Name]</label>
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">[Amount]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Bank Code:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">[Bank Code]</label>
				       </div> 
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Bank Name:</label>
				      <div class="col-xs-7">
				        <label for="sel1" class="control-label">[Bank Name]</label>
				      </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Comment:</label>
					  <div class="col-xs-7">
						   <label for="sel1" class="control-label">[Comment]</label>
					  </div>
					</div>
				</span>
			</form>
			<div class="details">Details</div>
			<table class="table table-striped table-hover table-bordered  table-condensed">
				<thead>
					<tr>
						<th>
							<a href="<?= base_url().uri_string() ?>/detail-add" class="">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th>Doc Type.</th>
						<th>Doc No.</th>
						<th>Doc Date</th>
						<th>Bank</th>
						<th>Check No.</th>
						<th>Check Date</th>
						<th>Doc Amount</th>
						<th>Remaining Amount</th>
						<th>Applied Amount</th>
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
						<td>Invoice</td>
						<td>SI-0001</td>
						<td>03/10/15</td>
						<td>Bank 001</td>
						<td>chck001</td>
						<td>03/10/15</td>
						<td>5,000.00</td>
						<td>1,000.00</td>
						<td>5,000.00</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/detail-update" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="#" class="">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
						<td>Invoice</td>
						<td>SI-0001</td>
						<td>03/10/15</td>
						<td>Bank 001</td>
						<td>chck001</td>
						<td>03/10/15</td>
						<td>5,000.00</td>
						<td>1,000.00</td>
						<td>5,000.00</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/detail-update" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="#" class="">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
						<td>Invoice</td>
						<td>SI-0001</td>
						<td>03/10/15</td>
						<td>Bank 001</td>
						<td>chck001</td>
						<td>03/10/15</td>
						<td>5,000.00</td>
						<td>1,000.00</td>
						<td>5,000.00</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
