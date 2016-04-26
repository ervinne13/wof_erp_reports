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
							<a href="<?=base_url().uri_string() ?>/add">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th>Document No.</th>
						<th>Document Date</th>
						<th>Transaction Date</th>
						<th>Qty Retrieved</th>
						<th>CRM Released</th>
						<th>Variance %</th>
						<th>Remarks</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?=base_url().uri_string() ?>/edit">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
						</td>
						<td>RT-10001</td>
						<td>10/10/15</td>
						<td>10/10/15</td>
						<td>100</td>
						<td>90</td>
						<td>1000.00</td>
						<td>[Remarks]</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

