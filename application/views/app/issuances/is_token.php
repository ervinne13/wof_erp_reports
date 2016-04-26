
<?php

$loop = 0;
?>
<style>
.my-table-form form-control{width:55px !important;color:#000 !important;}
.my-table-form form-control:hover{color:#000 !important;}
</style>

	<div class="row">

		<table class="table table-bordered">
			<thead>
				<tr>
					<th rowspan="2" class="hide" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></th>
					<th rowspan="2" >Tocken Pack</th>
					<th colspan="6">Issuance</th>
					<th rowspan="2">Total</th>
					<th colspan="6">Issuance By</th>
					
					<?php if ($module == 'returns'): ?>
						<th rowspan="2">Returns</th>
						<th rowspan="2">Sold Packs</th>
						<th rowspan="2">Peso Sales</th>
					<?php endif ?>
					

				</tr>
				<tr>
					<th>1st</th>
					<th>2nd</th>
					<th>3rd</th>
					<th>4th</th>
					<th>5th</th>
					<th>6th	</th>
					<th>1st</th>
					<th>2nd</th>
					<th>3rd</th>
					<th>4th</th>
					<th>5th</th>
					<th>6th	</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($tokens as $k => $token): ?>
				<?php 
					// pre($tokens);exit;
					$token_total = 0; 
					if(array_key_exists($token['AD_Code'],$hexuple)){
						$token_total += $hexuple[$token['AD_Code']]['ISD_1stIssuance']+$hexuple[$token['AD_Code']]['ISD_2ndIssuance']+$hexuple[$token['AD_Code']]['ISD_3rdIssuance']+$hexuple[$token['AD_Code']]['ISD_4thIssuance']+$hexuple[$token['AD_Code']]['ISD_5thIssuance']+$hexuple[$token['AD_Code']]['ISD_6thIssuance'];
					}
				?>


					<tr class="text-center">
						<td class="hide">
							<!--<a href="javascript:;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>-->
							<?php if(!empty($hexuple[$token['AD_Code']])): ?>
							<?php endif; ?>
								<input type="hidden" name="isd_lineno[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_LineNo'])?$hexuple[$token['AD_Code']]['ISD_LineNo']:''?>" />
								<input type="hidden" name="ac_code[<?=$loop?>]" value="<?=$token['AD_Code'];?>">
								<input type="hidden" name="ISD_Type[<?=$loop?>]" value="0" />
						</td>
						<td><?=!empty($token['AD_Code'])?$token['AD_Code']:'No-record'?></td>
						<td><input type="text" name="issuance1[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_1stIssuance'])?$hexuple[$token['AD_Code']]['ISD_1stIssuance']:'';?>" class="my-table-form form-control" <?=!empty($hexuple[$token['AD_Code']]['ISD_1stIssuance'])?'readonly':''?> /></td>
						<td><input type="text" name="issuance2[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_2ndIssuance'])?$hexuple[$token['AD_Code']]['ISD_2ndIssuance']:'';?>" class="my-table-form form-control" <?=!empty($hexuple[$token['AD_Code']]['ISD_2ndIssuance'])||empty($hexuple[$token['AD_Code']]['ISD_1stIssuance'])?'readonly':''?> /> </td>
						<td><input type="text" name="issuance3[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_3rdIssuance'])?$hexuple[$token['AD_Code']]['ISD_3rdIssuance']:'';?>" class="my-table-form form-control" <?=!empty($hexuple[$token['AD_Code']]['ISD_3rdIssuance'])||empty($hexuple[$token['AD_Code']]['ISD_2ndIssuance'])?'readonly':''?> /></td>
						<td><input type="text" name="issuance4[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_4thIssuance'])?$hexuple[$token['AD_Code']]['ISD_4thIssuance']:'';?>" class="my-table-form form-control" <?=!empty($hexuple[$token['AD_Code']]['ISD_4thIssuance'])||empty($hexuple[$token['AD_Code']]['ISD_3rdIssuance'])?'readonly':''?> /> </td>
						<td><input type="text" name="issuance5[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_5thIssuance'])?$hexuple[$token['AD_Code']]['ISD_5thIssuance']:'';?>" class="my-table-form form-control" <?=!empty($hexuple[$token['AD_Code']]['ISD_5thIssuance'])||empty($hexuple[$token['AD_Code']]['ISD_4thIssuance'])?'readonly':''?> /> </td>
						<td><input type="text" name="issuance6[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_6thIssuance'])?$hexuple[$token['AD_Code']]['ISD_6thIssuance']:'';?>" class="my-table-form form-control" <?=!empty($hexuple[$token['AD_Code']]['ISD_6thIssuance'])||empty($hexuple[$token['AD_Code']]['ISD_5thIssuance'])?'readonly':''?> /> </td>
						<td style="background:#eee;color: #3D6A7D;font-weight: bold;" ><?=$token_total?></td>
						<td><input type="text" name="issuanceby1[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_1stIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form form-control" readonly /> </td>
						<td><input type="text" name="issuanceby2[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_2ndIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form form-control" readonly /> </td>
						<td><input type="text" name="issuanceby3[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_3rdIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form form-control" readonly /> </td>
						<td><input type="text" name="issuanceby4[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_4thIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form form-control" readonly /> </td>
						<td><input type="text" name="issuanceby5[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_5thIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form form-control" readonly /> </td>
						<td><input type="text" name="issuanceby6[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_6thIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form form-control" readonly /> </td>
						<?php if ($module == 'returns'): ?>
							<td>
								<input type="text" data-name="returns" class="form-control return-edit text-center" name="return[<?=$loop?>]" value="<?=!empty($hexuple[$token['AD_Code']]['ISD_Return'])?$hexuple[$token['AD_Code']]['ISD_Return']:'';?>" <?=!empty($hexuple[$token['AD_Code']]['ISD_Return'])?'readonly':'';?> >
							</td>
							<td><?=!empty($hexuple[$token['AD_Code']]['sold_packs'])?number_format($hexuple[$token['AD_Code']]['sold_packs'], 0, '.', ','):0;?></td>
							<td><?=!empty($hexuple[$token['AD_Code']]['ISD_PesoSale'])?$hexuple[$token['AD_Code']]['ISD_PesoSale']:'';?></td>
						<?php endif ?>
					</tr>
				<?php $loop++; endforeach; ?>

				<?php if ($module == 'returns'): ?>
					<tr>
						<td colspan="17" class="text-right ret-total">
							<b>Total:</b>
						</td>
						<td>total</td>
					</tr>
				<?php endif ?>

			</tbody>
		</table>
	</div>
	<div class="row">
		<ul class="nav nav-tabs">
			<li role="presentation" class="active"><a href="#">Piso Token</a></li>
		</ul>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th rowspan="2" class="hide" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></th>
					<th rowspan="2" >Tocken Pack</th>
					<th colspan="6">Issuance</th>
					<th rowspan="2">Total</th>
					<th colspan="6">Issuance By</th>

					<?php if ($module == 'returns'): ?>
						<th rowspan="2">Returns</th>
						<th rowspan="2">Sold Packs</th>
						<th rowspan="2">Peso Sales</th>
					<?php endif ?>
				</tr>
				<tr>
					<th>1st</th>
					<th>2nd</th>
					<th>3rd</th>
					<th>4th</th>
					<th>5th</th>
					<th>6th	</th>
					<th>1st</th>
					<th>2nd</th>
					<th>3rd</th>
					<th>4th</th>
					<th>5th</th>
					<th>6th	</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($pisos as $piso): ?>
				<?php $piso_total = 0; ?>
				<?php 
					if(array_key_exists($piso['AD_Code'],$hexuple1)){
						$piso_total += $hexuple1[$piso['AD_Code']]['ISD_1stIssuance']+$hexuple1[$piso['AD_Code']]['ISD_2ndIssuance']+$hexuple1[$piso['AD_Code']]['ISD_3rdIssuance']+$hexuple1[$piso['AD_Code']]['ISD_4thIssuance']+$hexuple1[$piso['AD_Code']]['ISD_5thIssuance']+$hexuple1[$piso['AD_Code']]['ISD_6thIssuance']; 
					}
				?>
					
					<tr class="text-center">
						<td class="hide">
							<?php if(!empty($hexuple1[$piso['AD_Code']]['ISD_1stIssuance'])): ?>
							<?php endif; ?>
							<input type="hidden" name="isd_lineno[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_LineNo'])?$hexuple1[$piso['AD_Code']]['ISD_LineNo']:''?>" />
							<input type="hidden" name="ac_code[<?=$loop?>]" value="<?=$piso['AD_Code'];?>">
							<input type="hidden" name="ISD_Type[<?=$loop?>]" value="1" />
						</td>
						<td><?=!empty($piso['AD_Code'])?$piso['AD_Code']:'No-record'?></td>
						<td><input type="text" name="issuance1[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_1stIssuance'])?$hexuple1[$piso['AD_Code']]['ISD_1stIssuance']:'';?>" class="my-table-form form-control" <?=!empty($hexuple1[$piso['AD_Code']]['ISD_1stIssuance'])?'readonly':''?> /></td>
						<td><input type="text" name="issuance2[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_2ndIssuance'])?$hexuple1[$piso['AD_Code']]['ISD_2ndIssuance']:'';?>" class="my-table-form form-control" <?=!empty($hexuple1[$piso['AD_Code']]['ISD_2ndIssuance'])||empty($hexuple1[$piso['AD_Code']]['ISD_1stIssuance'])?'readonly':''?> /> </td>
						<td><input type="text" name="issuance3[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_3rdIssuance'])?$hexuple1[$piso['AD_Code']]['ISD_3rdIssuance']:'';?>" class="my-table-form form-control" <?=!empty($hexuple1[$piso['AD_Code']]['ISD_3rdIssuance'])||empty($hexuple1[$piso['AD_Code']]['ISD_2ndIssuance'])?'readonly':''?> /></td>
						<td><input type="text" name="issuance4[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_4thIssuance'])?$hexuple1[$piso['AD_Code']]['ISD_4thIssuance']:'';?>" class="my-table-form form-control" <?=!empty($hexuple1[$piso['AD_Code']]['ISD_4thIssuance'])||empty($hexuple1[$piso['AD_Code']]['ISD_3rdIssuance'])?'readonly':''?> /> </td>
						<td><input type="text" name="issuance5[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_5thIssuance'])?$hexuple1[$piso['AD_Code']]['ISD_5thIssuance']:'';?>" class="my-table-form form-control" <?=!empty($hexuple1[$piso['AD_Code']]['ISD_5thIssuance'])||empty($hexuple1[$piso['AD_Code']]['ISD_4thIssuance'])?'readonly':''?> /> </td>
						<td><input type="text" name="issuance6[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_6thIssuance'])?$hexuple1[$piso['AD_Code']]['ISD_6thIssuance']:'';?>" class="my-table-form form-control" <?=!empty($hexuple1[$piso['AD_Code']]['ISD_6thIssuance'])||empty($hexuple1[$piso['AD_Code']]['ISD_5thIssuance'])?'readonly':''?> /> </td>
						<td style="background:#eee;color: #3D6A7D;font-weight: bold;" ><?=$piso_total;?></td>
						<td><input type="text" name="issuanceby1[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_1stIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form form-control" readonly /> </td>
						<td><input type="text" name="issuanceby2[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_2ndIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form form-control" readonly /> </td>
						<td><input type="text" name="issuanceby3[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_3rdIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form form-control" readonly /> </td>
						<td><input type="text" name="issuanceby4[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_4thIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form form-control" readonly /> </td>
						<td><input type="text" name="issuanceby5[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_5thIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form form-control" readonly /> </td>
						<td><input type="text" name="issuanceby6[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_6thIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form form-control" readonly /> </td>
						
						<?php if ($module == 'returns'): ?>
							<td>
								<input type="text" data-name="returns" class="form-control return-edit text-center" name="return[<?=$loop?>]" value="<?=!empty($hexuple1[$piso['AD_Code']]['ISD_Return'])?$hexuple1[$piso['AD_Code']]['ISD_Return']:'';?>" <?=!empty($hexuple1[$piso['AD_Code']]['ISD_Return'])?'readonly':'';?> >
							</td>
							<td>Sold Packs</td>
							<td>Peso Sales</td>
						<?php endif ?>
					</tr>
				<?php $loop++; endforeach; ?>

				<?php if ($module == 'returns'): ?>
					<tr>
						<td colspan="17" class="text-right ret-total">
							<b>Total:</b>
						</td>
						<td>total</td>
					</tr>
				<?php endif ?>
			</tbody>
		</table>
	</div>
	<div class="row">
		<button type="submit" class="btn btn-default form-btn main-clr ">Save</button>
		<a href="<?=base_url().'app/sales-operation/'.$module;?>" class="btn btn-default form-btn sub-clr " data-dismiss="modal">Cancel</a>
	</div>
	