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
						<th>Document Date</th>
						<th>Document No.</th>
						<th>External Doc No.</th>
						<th>Supplier Name</th>
						<th>Payment Terms</th>
						<th>Due Date</th>
						<th>Amount</th>
						<th>Priority Level</th>
						<th>Reason</th>
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
						<td>04/21/15</td>
						<td>RP-100001</td>
						<td>[External Doc No.]</td>
						<td>Meralco</td>
						<td>COD</td>
						<td>04/21/15</td>
						<td>50,000.00</td>
						<td>High</td>
						<td></td>
						<td>Posted</td>
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
						<td>04/21/15</td>
						<td>RP-100002</td>
						<td>[External Doc No.]</td>
						<td>Supplier 2</td>
						<td>30 Days</td>
						<td>04/21/15</td>
						<td>5,000.00</td>
						<td>High</td>
						<td></td>
						<td>Posted</td>
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
						<td>04/21/15</td>
						<td>RP-100003</td>
						<td>[External Doc No.]</td>
						<td>Supplier 3</td>
						<td>30 Days</td>
						<td>04/21/15</td>
						<td>5,000.00</td>
						<td>Low</td>
						<td></td>
						<td>Posted</td>
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
						<td>04/21/15</td>
						<td>RP-100004</td>
						<td>[External Doc No.]</td>
						<td>Employee 2</td>
						<td>SD</td>
						<td>04/21/15</td>
						<td>5,000.00</td>
						<td>Medium</td>
						<td></td>
						<td>Posted</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>