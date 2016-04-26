<?=$this->load->view('app/sales-operation/token/tabs', NULL, TRUE);?>

<div class="col-md-4 ">
	<div class="form-pane form form-horizontal">
		<div class="title">Transaction</div>
		
		<fieldset>
			<div class="form-group">
				<div class="col-md-5 control-label">Doc. No:</div>
				<div class="col-md-7">
					<input type="text" class="form-control" name="FTTI_DocNo" value="<?=$details['FTTI_DocNo'];?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-5 control-label">Date Redeemed:</div>
				<div class="col-md-7">
					<input type="text" class="datepicker form-control date-redeemed" name="FTTI_DateRedeemed" value="<?=date('Y-m-d', strtotime($details['FTTI_DateRedeemed']));?>">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-5 control-label">Branch:</div>
				<div class="col-md-7">
					<input type="text" class="form-control" name="FTTI_Branch" value="<?=$details['FTTI_Branch'];?>" readonly>
				</div>
			</div>
			
			<?php if (isset($new)): ?>
				<input type="hidden" name="new" value="1">
			<?php endif ?>

		</fieldset>
		
		<fieldset>
			<div class="form-group">
				<div class="col-md-5 control-label">Token Type:</div>
				<div class="col-md-7">
					<select name="FTTI_TransType" id="types" class="form-control  single-default" onchange="token.changeTypes();">
						<option value="">Select</option>
						<?php foreach ($types as $v): ?>
							<option value="<?=$v;?>" <?= $type == $v ? 'selected' : NULL;?>><?=$v;?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			
			<?php if ($type == 'FGC' || $type == 'VIP'): ?>
				<div class="form-group ">
					<div class="col-md-5 control-label">VIP Card No.:</div>
					<div class="col-md-7">
						<input type="text" class="form-control" name="FTTI_VIPCardNo" value="<?=$details['FTTI_VIPCardNo'];?>">
					</div>
				</div>
			<?php endif ?>
			
			<?php if ($type == 'VIP'): ?>
				<div class="form-group">
					<div class="col-md-5 control-label">VIP Type:</div>
					<div class="col-md-5 no-pad-right">
						<select name="FTTI_VIPType" id="promo-type" class="form-control  single-default">

							<option value="">Select</option>
							<?php foreach ($vip_types as $i => $v): ?>
								<option value="<?=$v['FTTIS_Code'];?>" <?=$promo_type == $v['FTTIS_Code'] ? 'selected' : NULL;?>><?=$v['FTTIS_Code'];?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-md-2 no-pad-left">
						<button type="button" class="btn btn-block btn-default form-btn main-clr" onclick="token.promoType();">Go</button>
					</div>
				</div>
			<?php endif ?>
			
			<?php if ($type == 'FGC' || $type == 'GRC'): ?>
				<div class="form-group">
					<div class="col-md-5 control-label">Barcode:</div>
					<div class="col-md-5 no-pad-right">
						<input type="text" class="form-control" id="barcode">
					</div>

					<div class="col-md-2 no-pad-left">
						<button type="button" class="btn btn-block btn-default form-btn main-clr" onclick="token.searchBarcode();">Go</button>
					</div>
				</div>
			<?php endif ?>
			
			<?php if ($type == 'Promo'): ?>
				<div class="form-group">
					<div class="col-md-5 control-label">Promo Type:</div>
					<div class="col-md-5 no-pad-right">
					
					<select name="FTTI_PromoType" id="promo-type" class="form-control  single-default">
						<option value="">Select</option>
						<?php foreach ($promo_types as $i => $v): ?>
							<option value="<?=$v['FTTIS_Code'];?>" <?=$promo_type == $v['FTTIS_Code'] ? 'selected' : NULL;?>><?=$v['FTTIS_Code'];?></option>
						<?php endforeach ?>
					</select>
					</div>

					<div class="col-md-2 no-pad-left">
						<button type="button" class="btn btn-block btn-default form-btn main-clr" onclick="token.promoType();">Go</button>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-5 control-label">Reference No:</div>
					<div class="col-md-7">
						<input type="text" class="form-control" name="FTTI_RefNo" value="<?=$details['FTTI_RefNo'];?>">
					</div>
				</div>
			<?php endif ?>

			
		</fieldset>
	</div>
	
	<?php if ($type == 'FGC' || $type == 'GRC' ): ?>
		
		<div class="form-pane " id="fgc-details">
			<div class="title">FGC Details</div>

			<table class="table table-bordered table-condensed text-center" id="fgc-table">
				<thead>
					<th></th>
					<th>Series No.</th>
					<th>Face Value</th>
				</thead>
				<tbody>
					
					<?php foreach ($fgc_details as $v): ?>
						<?php $dt['item'] = $v;?>
						<?=$this->load->view('app/sales-operation/token/fgc', $dt, TRUE);?>
					<?php endforeach ?>
					
					<tr id="fgc-totals">
						<td colspan="2" class="text-right">
							<b>Total Face Value:</b>
						</td>
						<td>
							<b id="fgc-total-value"></b>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

	<?php endif ?>
</div>

<div class="col-md-8 right-pane">
	<?=$active_tab;?>
</div>