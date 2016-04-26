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
					  	<label for="sel1" class="control-label">RP-100001</label>
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">04/21/15</label>
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Ext Doc No.:</label>
				      <div class="col-xs-7">
				      	 <label class="control-label" for="">[Ext Doc No.]</label>
				      </div> 
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Priority Level:</label>
				      <div class="col-xs-7">
				      	<label for="sel1" class="control-label">High</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				     	<label class="control-label" for="">[Remarks]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				      	<label class="control-label" for="">Posted</label>
				      </div>
				    </div>
				</span>
				<span class="col-md-6">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier No:</label>
				      <div class="col-xs-7">
				      	<label class="control-label" for="">V-100008</label>
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Name:</label>
				      <div class="col-xs-7">
				      	<label class="control-label" for="">Meralco</label>
				      </div> 
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Supplier Address:</label>
				      <div class="col-xs-7">
				      	<label class="control-label" for="">ALABANG, MUNTINLUPA</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Reference No:</label>
				      <div class="col-xs-7">
				      	<label class="control-label" for="">[Supplier Reference No.]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Payment Terms:</label>
				      <div class="col-xs-7">
				      	<label class="control-label" for="">COD</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Due Date:</label>
				      <div class="col-xs-7">
				      	<label class="control-label" for="">04/21/15</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Reason:</label>
				      <div class="col-xs-7">
				      	<label class="control-label" for="">[Reason]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Required:</label>
				      <div class="col-xs-7">
				      	<label class="control-label" for="">04/28/15</label>
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
						<th>Description</th>
						<th>Qty</th>
						<th>CY</th>
						<th>Unit Price</th>
						<th>Amount</th>
						<th>Amount in LCY</th>
						<th>Cost Center</th>
						<th>Comment</th>
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
						<td>Utility Bills</td>
						<td>UB1000001</td>
						<td>Payment for Electric Bill for the month of January</td>
						<td>1</td>
						<td>Php</td>
						<td>50,000.00 </td>
						<td>50,000.00 </td>
						<td>50,000.00 </td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>