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
						<th>Company</th>
						<th>Department</th>
						<th>Branch</th>
						<th>Deparment Assistant</th>
						<th>Deparment Head</th>
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
						<td>DAR-10001</td>
						<td>15/15/15</td>
						<td>Company</td>
						<td>Department</td>
						<td>Branch</td>
						<td>Deparment Assistant</td>
						<td>Deparment Head</td>
						<td>Pending</td>
					</tr>
				</tbody>
			</table>
		</div>
    </div>
</div>