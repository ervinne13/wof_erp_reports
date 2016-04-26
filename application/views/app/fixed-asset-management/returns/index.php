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
						<th>Return Type</th>
						<th>Supplier Code</th>
						<th>Remarks</th>
						<th>External Document No.</th>
						<th>Status</th>
						<th>Reason</th>
						<th>Requested By</th>
						<th>Location</th>
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
						<td>RT-100001</td>
						<td>04/21/15</td>
						<td>Return to Supplier</td>
						<td>Vendor A</td>
						<td>[Remarks]</td>
						<td>[External Document No.]</td>
						<td>Approved</td>
						<td>[Reason]</td>
						<td>store1</td>
						<td>SM-Naga</td>
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
						<td>RT-100002</td>
						<td>04/21/15</td>
						<td>Return to Supplier</td>
						<td>Vendor B</td>
						<td>[Remarks]</td>
						<td>[External Document No.]</td>
						<td>Approved</td>
						<td>[Reason]</td>
						<td>store2</td>
						<td>SM-Manila</td>
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
						<td>RT-100003</td>
						<td>04/21/15</td>
						<td>Asset Disposal</td>
						<td>Vendor C</td>
						<td>[Remarks]</td>
						<td>[External Document No.]</td>
						<td>Approved</td>
						<td>[Reason]</td>
						<td>store3</td>
						<td>SM-Clark</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>			