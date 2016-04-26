<tr>
	<td>
		<a href="#" onclick="token.removeFgc(this); return false;">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</a>
		<input type="hidden" name="details[]" value="<?=$item['series_no'];?>">
	</td>
	<td>
		<?=$item['series_no'];?>
		<input type="hidden" name="series_no[]" value="<?=$item['type'] . $item['series_no'];?>" class="item-no">
	</td>
	<td data-value="<?=$item['FTTIS_FaceValue'];?>" class="fgc-value">
		<?=number_format($item['FTTIS_FaceValue'], 2, '.', ',');?>
		<input type="hidden" name="face_value[]" value="<?=number_format($item['FTTIS_FaceValue'], 2, '.', ',');?>">
	</td>
</tr>