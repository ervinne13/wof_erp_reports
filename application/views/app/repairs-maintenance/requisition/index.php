<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
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
						<th>Status</th>
						<th>Remarks</th>
						<th>Reason</th>
						<th>Requested From</th>
						<th>Request To</th>
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
						<td>RQ-10001</td>
						<td>12/02/15</td>
						<td>Pending</td>
						<td>[Remarks]</td>
						<td>[Reason]</td>
						<td>Store 1</td>
						<td>Store 2</td>
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
						<td>RQ-10002</td>
						<td>12/02/15</td>
						<td>Pending</td>
						<td>[Remarks]</td>
						<td>[Reason]</td>
						<td>Store 2</td>
						<td>SM - Manila</td>
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
						<td>RQ-10003</td>
						<td>12/02/15</td>
						<td>Pending</td>
						<td>[Remarks]</td>
						<td>[Reason]</td>
						<td>Admin</td>
						<td>Warehouse</td>
					</tr>	
				</tbody>
			</table>
		</div>
    </div>
</div>