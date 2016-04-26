<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
          	<span class="dropdown pull-right">
				<a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                	Functions
                	<span class="caret"></span>
              	</a>
              	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">=
	                <li><a href="">Send Approval Request</a></li>
					<li><a href="">Approve</a></li>
					<li><a href="">Reject</a></li>
				</ul>
            </span>
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
						<th><input type="checkbox"></th>
						<th>Document No.</th>
						<th>Document Date</th>
						<th>Branch</th>
						<th>Classification</th>
						<th>Asset Tag</th>
						<th>Description</th>
						<th>Net Book Value</th>
						<th>Reason</th>
						<th>Remarks</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?=base_url().uri_string() ?>/edit">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
						</td>
						<th><input type="checkbox"></th>
						<td>ATDM-10001</td>
						<td>15/15/15</td>
						<td>[Branch]</td>
						<td>[Classification]</td>
						<td>IT-10001</td>
						<td>[Description]</td>
						<td>100</td>
						<td>[Reason]</td>
						<td>[Remarks]</td>
						<td>Pending</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

