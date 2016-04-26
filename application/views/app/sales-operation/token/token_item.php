<tr data-token-id="<?=$v['IUC_FK_UOM_id'];?>">
	<td>
		<?=$v['AD_Code'];?>
		<input type="hidden" name="token[]" value="<?=$v['IUC_FK_UOM_id'];?>">
	</td>
	<td data-name="price">
		<?=number_format($v['TTP_Price'], 2);?>
		<input type="hidden" name="FTO_Price[]" value="<?=$v['TTP_Price'];?>">
	</td>
	<td data-name="quantity">
		<input type="text" class="form-control text-center" onkeyup="token.tokenTotal(this);" name="FTO_Qty[]" value="<?=$v['qty'];?>">
	</td>
	<?php if ($type == 'FGC' || $type == 'GRC'): ?>
		<td data-name="free" >
			<input type="text" class="form-control" onkeyup="token.tokenTotal(this);" name="FTO_FreeToken[]" value="<?=$v['free'];?>">
		</td>
		<td>
			<div data-name="total"></div>
			<input type="hidden" data-name="total" name="FTO_TotalToken[]">
		</td>
	<?php endif ;?>
	<td>
		<div data-name="peso"></div>
		<input type="hidden" data-name="peso" name="FTO_FaceValue[]">
	</td>
</tr>