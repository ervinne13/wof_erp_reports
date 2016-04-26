<table class="table table-striped table-bordered table-condensed presentation text-center">
	<thead>
		<th>
			<a href="<?=site_url('app/sales-operation/batch/details');?>">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			</a>

		</th>
		<th>Doc No.</th>
		<th>Doc Date</th>
		<th>Supplier Name</th>
		<th>Alloaction For</th>
		<th>Region</th>
	</thead>

	<tbody>
		<?php foreach ($items as $i => $v): ?>
			<tr>
				<td>
					<a href="<?=site_url('app/sales-operation/batch/details/' . $v['BA_DocNo']);?>">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>
				</td>
				<td><?=$v['BA_DocNo'];?></td>
				<td><?=date('m/d/Y', strtotime($v['BA_DocDate']));?></td>
				<td><?=$v['BA_SupplierName'];?></td>
				<td><?=$v['BA_AllocationFor'];?></td>
				<td><?=$v['BA_Region'];?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>