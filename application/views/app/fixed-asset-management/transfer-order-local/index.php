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
						<th>Date Required</th>
						<th>Transfer From</th>
						<th>Transfer To</th>
						<th>Remarks</th>
						<th>Priority Level</th>
						<th>Status</th>
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
						<td>TO-10001</td>
						<td>12/02/15</td>
						<td>12/25/15</td>
						<td>MCO</td>
						<td>SOO</td>
						<td>[Remarks]</td>
						<td>HIGH</td>
						<td>Pending</td>
					</tr>
				</tbody>
			</table>
		</div>
    </div>
</div>