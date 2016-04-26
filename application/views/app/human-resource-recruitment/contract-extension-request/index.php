<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
          	<span class="dropdown pull-right">
				<a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                	Functions
                	<span class="caret"></span>
              	</a>
              	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
	                <li><a href="">Send Approval Request</a></li>
					<li><a href="">Cancel Approval Request</a></li>
					<li><a href="">Reopen</a></li>
					<li><a href="">Approve (for approvers only)</a></li>
					<li><a href="">Reject (for approvers only)</a></li>
					<li><a href="">Post</a></li>
					<li><a href="">Print</a></li>
					<li><a href="">Track Document</a></li>
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
						<th>Company</th>
						<th>Concept</th>
						<th>Employee Name</th>
						<th>Position</th>
						<th>Position Level</th>
						<th>Employee Status</th>
						<th>End of Contract Date</th>
						<th>Extended until</th>
						<th>Remarks</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<!-- <tr>
						<td>
							<a href="<?=base_url().uri_string() ?>/edit">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
						</td>
						<td>SM - Megamall</td>
						<td>Pasig City</td>
						<td>Fixed</td>
						<td>50,000.00</td>
						<td></td>
						<td>SM</td>
						<td>300 sqm</td>
					</tr> -->
				</tbody>
			</table>
		</div>
	</div>
</div>

