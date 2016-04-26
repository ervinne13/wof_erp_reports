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
					<li><a href="">Approve & Post</a></li>
					<li><a href="">Finalize Count</a></li>
					<li><a href="">Create Adjustment</a></li>
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
					  <label for="sel1" class="control-label col-xs-5">Count Sheet No.:</label>
					  <div class="col-xs-7">
				         <label class="control-label">CS-10001</label> 
					  </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Count Date:</label>
				      <div class="col-xs-7">
				         <label class="control-label">12/25/15</label> 
					  </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				         <label class="control-label">[Remarks.]</label> 
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
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				         <label class="control-label">Sm - Megamall</label> 
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
						<th>BIN/Location</th>
						<th>Qty On Hand</th>
						<th>Actual Qty</th>
						<th>UOM</th>
						<th>Cost/Profit Center</th>
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
						<td>Machine</td>
						<td>FA100001</td>
						<td>Drumania V7</td>
						<td>[BIN/Location]</td>
						<td>2</td>
						<td>2</td>
						<td>pc</td>
						<td>[Cost/Profit Center]</td>
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
						<td>Machine</td>
						<td>FA100002</td>
						<td>Battle Gear</td>
						<td>[BIN/Location]</td>
						<td>2</td>
						<td>2</td>
						<td>pc</td>
						<td>[Cost/Profit Center]</td>
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
						<td>Machine</td>
						<td>FA100003</td>
						<td>Indiana Jones</td>
						<td>[BIN/Location]</td>
						<td>1</td>
						<td>1</td>
						<td>pc</td>
						<td>[Cost/Profit Center]</td>
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
						<td>Redemption</td>
						<td>RD100001</td>
						<td>Hello Kitty</td>
						<td>[BIN/Location]</td>
						<td>20</td>
						<td>19</td>
						<td>pc</td>
						<td>[Cost/Profit Center]</td>
					</tr>
				</tbody>
			</table>
		</div>
    </div>
</div>
