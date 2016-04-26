
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
					<li><a href="">Post</a></li>
					<li><a href="">Print</a></li>
					<li><a href="">Document Tracking</a></li>
              	</ul>
              	<a class="cls-btn" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4))?>" >
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
				         <label for="sel1" class="control-label">[Document No.:]</label>
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				         <label class="control-label" for="">[Document Date:]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Ext Doc No:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">[Ext Doc No:]</label>
				       </div> 
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Priority Level:</label>
				      <div class="col-xs-7">
				        <label for="sel1" class="control-label">[Priority Level:]</label>
				      </div>
				    </div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Remarks:</label>
					  <div class="col-xs-7">
				        <label for="sel1" class="control-label">[Remarks:]</label>
				      </div>
					</div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Status:</label>
					  <div class="col-xs-7">
				        <label for="sel1" class="control-label">[Status:]</label>
				      </div>
					</div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Required:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">[Date Required:]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Cost Center:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">[Cost Center:]</label>
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
						<th>Item Type</th>
						<th>Item No.</th>
						<th>Description</th>
						<th>CY</th>
						<th>Qty</th>
						<th>UOM</th>
						<th>Unit Price</th>
						<th>Budget Amount</th>
						<th>Approved Budget</th>
						<th>Expense</th>
						<th>Remaining Budget</th>
						<th>Month</th>
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
						<td>Fixed Asset</td>
						<td>FA-100001</td>
						<td>Computer</td>
						<td>Php</td>
						<td>1</td>
						<td>Unit</td>
						<td>25,000.00</td>
						<td>25,000.00</td>
						<td>20,000.00 </td>
						<td>20,000.00</td>
						<td></td>
						<td>March</td>
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
						<td>Fixed Asset</td>
						<td>FA-100001</td>
						<td>Computer</td>
						<td>Php</td>
						<td>1</td>
						<td>Unit</td>
						<td>25,000.00</td>
						<td>25,000.00</td>
						<td>20,000.00 </td>
						<td>20,000.00</td>
						<td></td>
						<td>April</td>
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
						<td>Fixed Asset</td>
						<td>FA-100001</td>
						<td>Computer</td>
						<td>Php</td>
						<td>1</td>
						<td>Unit</td>
						<td>25,000.00</td>
						<td>25,000.00</td>
						<td>20,000.00 </td>
						<td>20,000.00</td>
						<td></td>
						<td>May</td>
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
						<td>Personnel</td>
						<td>PE-100001</td>
						<td>PLD Staff</td>
						<td>Php</td>
						<td>1</td>
						<td></td>
						<td>15,000.00</td>
						<td>15,000.00</td>
						<td></td>
						<td></td>
						<td></td>
						<td>March</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
 -->