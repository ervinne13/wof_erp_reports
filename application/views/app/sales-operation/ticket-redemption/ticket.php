<tr class="table-item" data-hash="<?=$ticket['hash'];?>" 
					  data-desc="<?=$ticket['IM_Sales_Desc'];?>" 
					  data-quantity="<?=$ticket['quantity'];?>" 
					  data-points="<?=$ticket['IM_Points'];?>" 
					  data-code="<?=$ticket['IM_Item_id'];?>" 
					  data-total-points="<?=$ticket['total'];?>">
	<td>
		<a href="#" class="icon-act" onclick="redemption.edit(this);">
			<span class="glyphicon glyphicon-edit"></span>
		</a>

		<a href="#" class="icon-act" onclick="redemption.trash(this);">
			<span class="glyphicon glyphicon-remove"></span>
		</a>
	</td>
	<td></td>
	<td><?=$ticket['IM_Item_id'];?></td>
	<td><?=$ticket['IM_Sales_Desc'];?></td>
	<td><?=$ticket['quantity'];?></td>
	<td><?=$ticket['IM_Points'];?></td>
	<td data-total="<?=$ticket['total'];?>"><?=$ticket['total'];?></td>
</tr>