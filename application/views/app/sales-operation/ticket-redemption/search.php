<?php foreach ($items as $v): ?>
	<tr onclick="redemption.chooseItem(this);" data-id="<?=$v['IM_Item_id'];?>" data-desc="<?=$v['IM_Sales_Desc'];?>" data-points="<?=$v['IM_Points'];?>">
		<td></td>
		<td><?=$v['IM_Item_id'];?></td>
		<td><?=$v['IM_Sales_Desc'];?></td>
		<td><?=$v['IM_Points'];?></td>
	</tr>
<?php endforeach ?>