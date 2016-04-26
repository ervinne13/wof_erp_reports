<table class="table table-striped table-hover table-bordered  table-condensed">
	<thead>
		<tr>
			<th>Sequence</th>
			<th>Position</th>
			<th>Amount</th>
			<th>Unlimited</th>
			<th>Required</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($setup as $key => $value) { ?>
		<tr>
			<td><?= $value->AS_Sequence ?></td>
			<td><?= $value->P_Position ?></td>
			<td><?= $value->AS_Amount ?></td>
			<td><?= $value->AS_Unlimited== '1' ?'Yes':'No' ?> </td>
			<td><?= $value->AS_Required== '1' ?'Yes':'No' ?> </td>
		</tr>
		<?php } ?>
	</tbody>
</table>