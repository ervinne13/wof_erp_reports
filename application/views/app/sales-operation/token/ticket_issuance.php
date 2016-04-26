<div class="form form-horizontal <?=$type == 'Promo' || $type == 'VIP' ? 'hide' : NULL;?>">
	<div class="form-group hide-promo">
		<div class="col-md-3 control-label">Remaining Face Value:</div>
		<div class="col-md-4">
			<input type="text" class="form-control" id="remaining-face-value" value="" readonly>
			<input type="hidden" class="form-control" id="remaining-value" name="FTTI_TotalFaceValue" value="<?=$details['FTTI_TotalFaceValue'];?>" readonly>
		</div>
	</div>
</div>

<h3>Token</h3>
<table class="table table-bordered table-stiped table-condensed text-center" id="token-table">
	<thead>
		<th>UOM</th>
		<th class="col-md-2">Price</th>
		<th class="col-md-2">Qty</th>
		
		<?php if ($type == 'FGC' || $type == 'GRC'): ?>
			<th class="col-md-2">Free Token</th>
			<th class="">Total Token</th>
		<?php endif ?>

		
		<th>Peso Value</th>
	</thead>

	<tbody>
		<?php foreach ($tokens as $v): ?>
			<?php $dt['v'] = $v;?>
			<?=$this->load->view('app/sales-operation/token/token_item', $dt, TRUE);?>
		<?php endforeach ?>

		<tr id="tr-total">
				<?php if ($type == 'FGC' || $type == 'GRC'): ?>
				<td colspan="4" class="text-right" id="td-total">
				<?php else: ?>
				<td colspan="2" class="text-right" id="td-total">
				<?php endif ?>
					<b>Total: </b>
				</td>
			
			<td>
				<div id="total-token"></div>
			</td>
			<td>
				<div id="token-peso"></div>
			</td>
		</tr>
	</tbody>
</table>

<h3>Ticket</h3>
<table class="table table-bordered table-stiped table-condensed text-center" id="ticket-table">
	<thead>
		<th>Ticket Color</th>
		<th>Price</th>
		<th class="col-md-2">Series From</th>
		<th class="col-md-2">Series To</th>
		<th>Qty</th>

		<th>Peso Value</th>
	</thead>

	<tbody>

		<?php foreach ($tickets as $v): ?>
		<tr>
			<tr>
				<td>
					<?=$v['AD_Code'];?>
					<input type="hidden" name="ticket[]" value="<?=$v['IUC_FK_UOM_id'];?>">
				</td>
				<td data-name="price">
					<?=number_format($v['TTP_Price'], 2);?>
					<input type="hidden" name="FTI_Price[]" value="<?=$v['TTP_Price'];?>">
				</td>
				<td data-name="from">
					<input type="text" class="form-control" onkeyup="token.seriesTotal(this);" name="FTI_SeriesFrom[]" value="<?=$v['from'];?>">
				</td>
				<td data-name="to">
					<input type="text" class="form-control" onkeyup="token.seriesTotal(this);" name="FTI_SeriesTo[]" value="<?=$v['to'];?>">
				</td>
				<td >
					<div data-name="total"></div>
					<input type="hidden" data-name="total" name="FTI_Qty[]">
				</td>
				<td >
					<div data-name="peso"></div>
					<input type="hidden" data-name="peso" name="FTI_FaceValue[]">
				</td>
			</tr>
		</tr>
		<?php endforeach ;?>

		<tr>
			<td colspan="4" class="text-right">
				<b>Total: </b>
			</td>
			<td id="ticket-total-all"></td>
			<td id="ticket-peso-all"></td>
		</tr>
		
		
		<?php if ($type == 'Promo' | $type == 'VIP'): ?>

			<tr>
				<td colspan="5" class="text-right">
					<b>Promo Ticket Value:</b>
				</td>
				<td id="ticket-qty-total">
					<?php if (isset($promo_ticket_value)): ?>
						<?=number_format($promo_ticket_value, 2);?>
					<?php endif ?>
				</td>
			</tr>

			<tr>
				<td colspan="5" class="text-right">
					<b>Remaining Ticket Value:</b>
				</td>
				<td id="ticket-peso-total"></td>
			</tr>
		<?php endif ?>

		
	</tbody>
</table>

<button class="btn btn-default form-btn main-clr" type="button" onclick="token.saveItem(true);">Save & New</button>
<button class="btn btn-default form-btn main-clr" type="button" onclick="token.saveItem();">Save & Close</button>
<a href="<?=site_url('app/sales-operation/token/');?>" class="btn btn-default form-btn sub-clr"  >Cancel</a>
