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
						<th>Ext. Doc No.</th>
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
						<td>PR-100001</td>
						<td>04/21/15</td>
						<td>[Ext Doc. No]</td>
						<td>150,000.00</td>
						<td>04/28/15</td>
						<td>High</td>
						<td>Approved</td>
						<td>[Reason]</td>
						<td>[Remarks]</td>
						<td>Store 1</td>
						<td>SM - Naga</td>
						<td>RQ-100001</td>
						<td>PO-100001 </td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/edit" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="<?= base_url().uri_string() ?>/view" class="edit">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>PR-100002</td>
						<td>04/21/15</td>
						<td>[Ext Doc. No]</td>
						<td>1,000.00</td>
						<td>04/28/15</td>
						<td>Low</td>
						<td>Open</td>
						<td>[Reason]</td>
						<td>[Remarks]</td>
						<td>Store 2</td>
						<td>SM - Manila</td>
						<td>RQ-100002</td>
						<td></td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/edit" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="<?= base_url().uri_string() ?>/view" class="edit">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>PR-100003</td>
						<td>04/21/15</td>
						<td>[Ext Doc. No]</td>
						<td>5,000.00</td>
						<td>04/28/15</td>
						<td>Low</td>
						<td>Open</td>
						<td>[Reason]</td>
						<td>[Remarks]</td>
						<td>Admin1</td>
						<td>Admin</td>
						<td>RQ-100003</td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
