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
					<li><a href="">Create Item Reclass</a></li>
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
						<th>Branch / Department</th>
						<th>Location</th>
						<th>Item Code</th>
						<th>Description</th>
						<th>Qty</th>
						<th>Unit</th>
						<th>Net Book Value</th>
						<th>Estimated Market Value (For machines Only)</th>
						<th>Disposal Identification</th>
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
						<td>ADV-10001</td>
						<td>15/15/15</td>
						<td>[Branch]</td>
						<td>[Location]</td>
						<td>IT-10001</td>
						<td>[Descriptio]</td>
						<td>1</td>
						<td>pc</td>
						<td>100</td>
						<td>10</td>
						<td>Throw Away</td>
						<td>[Remarks]</td>
						<td>Pending</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

