<?php foreach ($items as $item): ?>
	<tr class="text-center">
		<td>
			<input type="checkbox" class="void-check" value="<?=$item['RD_DocNo'];?>" name="void_doc_no" onclick="redemption.voidCheck();">
		</td>
		<td><?=$item['RD_DocNo'];?></td>
		<td><?=$item['RD_Location'];?></td>
		<td><?=$item['RD_TicketQty'];?></td>
		<td><?=date('m/d/Y', strtotime($item['DateCreated']));?></td>
		<td><?=$item['RD_Status'];?></td>
	</tr>
<?php endforeach ?>
