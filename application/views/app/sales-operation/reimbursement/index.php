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
						<th>Date Required</th>
						<th>External Doc. No.</th>
						<th>Doc Type</th>
						<th>Doc Type</th>
						<th>For Reimbursement</th>
						<th>Cost Center</th>
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
						<td>RE-100001</td>
						<td>04/21/15</td>
						<td>04/21/15</td>
						<td>[External Doc. No.]</td>
						<td>w/o CA</td>
						<td>200.00</td>
						<td>Employee A</td>
						<td>SM-Manila</td>
						<td>For Liquidation</td>
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
						<td>RE-100002</td>
						<td>04/21/15</td>
						<td>04/21/15</td>
						<td>[External Doc. No.]</td>
						<td>w/ CA</td>
						<td>1,000.00</td>
						<td>Employee B</td>
						<td>SM-Manila</td>
						<td>For Liquidation</td>
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
						<td>RE-100003</td>
						<td>04/21/15</td>
						<td>04/21/15</td>
						<td>[External Doc. No.]</td>
						<td>w/ CA</td>
						<td>750.00</td>
						<td>Employee C</td>
						<td>RSD</td>
						<td>For Liquidation</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
