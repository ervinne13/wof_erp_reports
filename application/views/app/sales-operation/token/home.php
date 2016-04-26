<table class="presentation table table-striped table-hover table-bordered">
	
	<thead>
		<th>
			<a href="<?=site_url('app/sales-operation/token/details');?>">
				<span class="glyphicon glyphicon-plus"></span>
			</a>
		</th>
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
					<a href="<?=site_url('app/sales-operation/token/details/' . $v['FTTI_DocNo']);?>">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>

					<a href="<?=site_url('app/sales-operation/token/delete/' . $v['FTTI_DocNo']);?>">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</a>
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