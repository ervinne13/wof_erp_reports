<?=$this->load->view('app/sales-operation/token/tabs', NULL, TRUE);?>

<form action="<?=site_url('app/sales-operation/token/promo_setup_add');?>" method="post" id="promo-form">
	<table class="table table-condensed table-bordered text-center" id="promo-table">
		<thead>
			<th>
				<a href="#" onclick="token.addPromoSetup(); return false;">
					<span class="glyphicon glyphicon-plus"></span>
				</a>
			</th>
			<th>Type</th>
			<th>Code</th>
			<th>Description</th>
			<th class="col-md-1">Token</th>
			<th>Ticket Value</th>
			<th>Expiration</th>
		</thead>

		<tbody>

			<?php foreach ($items as $v): ?>
				<tr>
					<td>
						<a href="#" onclick="token.removeFgcSetup(this); return false;">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						</a>
						<input type="hidden" name="status[]" value="edit">
						<input type="hidden" name="FTTIS_UOM[]" value="<?=$v['FTTIS_UOM'];?>">

					</td>
					<td>
						<select name="FTTIS_Type[]" id="" class="form-control text-center">
							<option value="Promo" <?=$v['FTTIS_Type'] == 'Promo' ? 'selected' : NULL;?>>Promo</option>
							<option value="VIP" <?=$v['FTTIS_Type'] == 'VIP' ? 'selected' : NULL;?>>VIP</option>
						</select>
					</td>
					<td>
						<input type="text" class="form-control text-center promo-code" name="FTTIS_Code[]" value="<?=$v['FTTIS_Code'];?>" required>
					</td>
					<td>
						<input type="text" class="form-control text-center" name="FTTIS_Description[]" value="<?=$v['FTTIS_Description'];?>" required>
					</td>
					<td>
						<input type="text" class="form-control text-center" name="FTTIS_Token[]" value="<?=$v['FTTIS_Token'];?>">
					</td>
					<td>
						<input type="text" class="form-control text-center" name="FTTIS_TicketValue[]" value="<?=number_format($v['FTTIS_TicketValue'], 2);?>" required>
					</td>
					<td>
						<input type="text" class="form-control text-center datepicker" name="FTTIS_ExpirationDate[]" value="<?=date('m/d/Y', strtotime($v['FTTIS_ExpirationDate']));?>" required>
					</td>
				</tr>
			<?php endforeach ?>
			
		</tbody>
	</table>


	<button class="btn btn-default form-btn main-clr" type="submit">Save</button>
	<a href="<?=site_url('app/sales-operation/token');?>" class="btn btn-default form-btn sub-clr">Cancel</a>
</form>


<table id="table-clone" class="hide">
	<tbody>
		<tr class="promo-row">
			<td>
				<a href="#" onclick="token.removeFgcSetup(this); return false;">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</a>
				<input type="hidden" name="status[]" value="add">
				<input type="hidden" name="FTTIS_UOM[]" value="<?=$uom_id;?>">
			</td>
			<td>
				<select name="FTTIS_Type[]" id="" class="form-control text-center">
					<option value="Promo">Promo</option>
					<option value="VIP">VIP</option>
				</select>
			</td>
			<td>
				<input type="text" class="form-control text-center promo-code" name="FTTIS_Code[]" required>
			</td>
			<td>
				<input type="text" class="form-control text-center" name="FTTIS_Description[]" required>
			</td>
			<td>
				<input type="text" class="form-control text-center" name="FTTIS_Token[]">
			</td>
			<td>
				<input type="text" class="form-control text-center" name="FTTIS_TicketValue[]" required>
			</td>
			<td>
				<input type="text" class="form-control text-center set-datepicker" name="FTTIS_ExpirationDate[]" required>
			</td>
		</tr>
	</tbody>
</table>
