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
						<th>Proirity Level</th>
						<th>Reason</th>
						<th>Remarks</th>
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
						<td>IR-100001</td>
						<td>04/21/15</td>
						<td>High</td>
						<td>[Reason Code]</td>
						<td>[remarks]</td>
						<td>Approved</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
