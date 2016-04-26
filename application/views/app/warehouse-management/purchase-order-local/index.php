<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<table class="presentation table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>
							<a href="<?= base_url().uri_string() ?>/add" class="">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th>Document No.</th>
						<th>Document Date</th>
						<th>Vendor</th>
						<th>Ext. Doc. No.</th>
						<th>Transaction Type</th>
						<th>Amount</th>
						<th>Date Required</th>
						<th>Priority Level</th>
						<th>Status</th>
						<th>Reason</th>
						<th>Remarks</th>
						<th>Requested By</th>
						<th>Location</th>
						<th>Reference From</th>
						<th>Reference To</th>
					</tr>
				</thead>
				<tbody>
							  		  	  				  	 	

					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/edit" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="<?= base_url().uri_string() ?>/view" class="edit">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>PO-100001</td>
						<td>04/21/15</td>
						<td>Vendor A</td>
						<td>[Ext Doc no]</td>
						<td>Partial</td>
						<td>200,000.00</td>
						<td>04/28/15</td>
						<td>High</td>
						<td>Approved</td>
						<td>[Reason Code]</td>
						<td>[remarks]</td>
						<td>store1</td>
						<td>SM-Naga</td>
						<td>PR-100001</td>
						<td>PO-100001</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
