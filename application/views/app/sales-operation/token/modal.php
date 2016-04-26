<table class="table table-striped table-hover table-bordered">
	
	<thead>
		<th></th>
		<th>Doc No.</th>
		<th>Date Redeemed</th>
		<th>Branch</th>
		<th>Transaction Type</th>
		<th>Status</th>
	</thead>

	<tbody>
		<?php foreach ($tokens as $v): ?>
			<tr>
				<td>
					<input type="checkbox">
				</td>
				<td>
					<?=$v['FTTI_DocNo'];?>
				</td>
				<td><?=date('m/d/Y', strtotime($v['FTTI_DateRedeemed']));?></td>
				<td><?=$v['FTTI_Branch'];?></td>
				<td><?=$v['FTTI_TransType'];?></td>
				<td></td>
			</tr>
		<?php endforeach ?>
		
	</tbody>
</table>