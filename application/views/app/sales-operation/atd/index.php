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
							<a href="<?= base_url().uri_string() ?>/add" class="">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th>Document No.</th>
						<th>Document Date</th>
						<th>Employee ID</th>
						<th>Amount</th>
						<th>Reference Document</th>
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
						</td>
						<td>ATD-100001</td>
						<td>04/21/15</td>
						<td>Employee 1</td>
						<td>200.00</td>
						<td>[Ref Doc no]</td>
						<td>High</td>
						<td>[Reason]</td>
						<td>Approved</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/edit" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
						</td>
						<td>ATD-100003</td>
						<td>04/21/15</td>
						<td>Employee 3</td>
						<td>300.00</td>
						<td>[Ref Doc no]</td>
						<td>High</td>
						<td>[Reason]</td>
						<td>Approved</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/edit" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
						</td>
						<td>ATD-100002</td>
						<td>04/21/15</td>
						<td>Employee 21</td>
						<td>2000.00</td>
						<td>[Ref Doc no]</td>
						<td>High</td>
						<td>[Reason]</td>
						<td>Approved</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
