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
						<th><input type="checkbox"></th>
						<th>Document No.</th>
						<th>Document Date</th>
						<th>Amount</th>
						<th>Date Required</th>
						<th>Requested By</th>
						<th>Cost Center</th>
						<th>Priority Level</th>
						<th>CAR Status</th>
						<th>CAL Status</th>
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
							<a href="<?= base_url().uri_string() ?>/liquidate" class="">
								<span class="glyphicon glyphicon-share-alt"></span>
							</a>
						</td>
						<td><input type="checkbox"></td>
						<td>CAR-100001</td>
						<td>04/21/15</td>
						<td>1,250.00</td>
						<td>04/21/15</td>
						<td>Employee A</td>
						<td>RSD</td>
						<td>High</td>
						<td>Approved</td>
						<td>Liquidated</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/edit" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="<?= base_url().uri_string() ?>/view" class="edit">
								<span class="glyphicon glyphicon-search"></span>
							</a>
							<a href="<?= base_url().uri_string() ?>/liquidate" class="">
								<span class="glyphicon glyphicon-share-alt"></span>
							</a>
						</td>
						<td><input type="checkbox"></td>
						<td>CAR-100002</td>
						<td>04/21/15</td>
						<td>5,000.00</td>
						<td>04/21/15</td>
						<td>Employee B</td>
						<td>SM-Naga</td>
						<td>High</td>
						<td>Approved</td>
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
							<a href="<?= base_url().uri_string() ?>/liquidate" class="">
								<span class="glyphicon glyphicon-share-alt"></span>
							</a>
						</td>
						<td><input type="checkbox"></td>
						<td>CAR-100003</td>
						<td>04/21/15</td>
						<td>1,000.00</td>
						<td>04/21/15</td>
						<td>Employee C</td>
						<td>SM-Manila</td>
						<td>High</td>
						<td>Approved</td>
						<td>For Liquidation</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
