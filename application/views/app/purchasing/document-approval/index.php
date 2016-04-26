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
						</th>
						<th>Document Type</th>
						<th>Document No.</th>
						<th>Document Date</th>
						<th>Amount</th>
						<th>Date Required</th>
						<th>Requested By</th>
						<th>Sender</th>
						<th>Dept/Store</th>
						<th>Priority Level</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?= base_url() ?>app/financial-management/cash-advance/view" class="edit">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>Cash Advance Request</td>
						<td>CAR-10001</td>
						<td>03/16/2015</td>
						<td>1,000.00</td>
						<td>03/20/2015</td>
						<td>[Employee]</td>
						<td>[Approver]</td>
						<td>SM-Megamall</td>
						<td>High</td>
						<td>Pending</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url() ?>app/financial-management/cash-advance/liquidate" class="edit">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>Cash Advance Liquidation</td>
						<td>CAL-10001</td>
						<td>03/16/2015</td>
						<td>1,000.00</td>
						<td>03/20/2015</td>
						<td>[Employee]</td>
						<td>[Approver]</td>
						<td>SM-North</td>
						<td>High</td>
						<td>Pending</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url() ?>app/financial-management/requisition/view" class="edit">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>Requisition</td>
						<td>RQ-10001</td>
						<td>03/16/2015</td>
						<td>1,000.00</td>
						<td>03/20/2015</td>
						<td>[Employee]</td>
						<td>[Approver]</td>
						<td>SM-MOA</td>
						<td>High</td>
						<td>Pending</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>