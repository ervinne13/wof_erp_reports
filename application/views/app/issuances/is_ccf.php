<style>
.my-table-form{width:55px !important;color:#000 !important;}
.my-table-form:hover{color:#000 !important;}
input[readonly]
{
    background-color:#eee !important;
}
</style>
<!--
<form action="<?=base_url()?>app/sales-operation/<?=$module;?>/submit_token/<?=$issuance['IS_DocNo']?>" method="POST">
-->
<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="2" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></th>
				<th rowspan="2" >Amount</th>
				<th colspan="6">Issuance</th>
				<th rowspan="2">Total</th>
				<th colspan="6">Issuance By</th>


				<?php if ($module === 'returns'): ?>
					<th colspan="3">Returns</th>
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
				
				<?php if ($module == 'returns'): ?>
					<th>Bills</th>
					<th>Coins</th>
					<th>Total</th>
				<?php endif ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach($coins as $coin): ?>
					
				<?php
				$coin_total = 0;
				if(!empty($hexuple)){
					$coin_total = $hexuple[$coin['AD_Code']]['ISD_1stIssuance']+$hexuple[$coin['AD_Code']]['ISD_2ndIssuance']+$hexuple[$coin['AD_Code']]['ISD_3rdIssuance']+$hexuple[$coin['AD_Code']]['ISD_4thIssuance']+$hexuple[$coin['AD_Code']]['ISD_5thIssuance']+$hexuple[$coin['AD_Code']]['ISD_6thIssuance'];
				}
				?>
					<tr>
						<td>
							<input type="hidden" name="isd_lineno[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_LineNo'])?$hexuple[$coin['AD_Code']]['ISD_LineNo']:''?>" />
							<input type="hidden" name="ac_code[]" value="<?=$coin['AD_Code'];?>">
							<input type="hidden" name="ISD_Type[]" value="2" />
						</td>
						<td><?=!empty($coin['AD_Code'])?$coin['AD_Code']:'No-record'?></td>
						<td><input type="text" name="issuance1[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_1stIssuance'])?$hexuple[$coin['AD_Code']]['ISD_1stIssuance']:'';?>" class="my-table-form" <?=!empty($hexuple[$coin['AD_Code']]['ISD_1stIssuance'])?'readonly':''?> /></td>
						<td><input type="text" name="issuance2[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_2ndIssuance'])?$hexuple[$coin['AD_Code']]['ISD_2ndIssuance']:'';?>" class="my-table-form" <?=!empty($hexuple[$coin['AD_Code']]['ISD_2ndIssuance'])||empty($hexuple[$coin['AD_Code']]['ISD_1stIssuance'])?'readonly':''?> /> </td>
						<td><input type="text" name="issuance3[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_3rdIssuance'])?$hexuple[$coin['AD_Code']]['ISD_3rdIssuance']:'';?>" class="my-table-form" <?=!empty($hexuple[$coin['AD_Code']]['ISD_3rdIssuance'])||empty($hexuple[$coin['AD_Code']]['ISD_2ndIssuance'])?'readonly':''?> /></td>
						<td><input type="text" name="issuance4[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_4thIssuance'])?$hexuple[$coin['AD_Code']]['ISD_4thIssuance']:'';?>" class="my-table-form" <?=!empty($hexuple[$coin['AD_Code']]['ISD_4thIssuance'])||empty($hexuple[$coin['AD_Code']]['ISD_3rdIssuance'])?'readonly':''?> /> </td>
						<td><input type="text" name="issuance5[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_5thIssuance'])?$hexuple[$coin['AD_Code']]['ISD_5thIssuance']:'';?>" class="my-table-form" <?=!empty($hexuple[$coin['AD_Code']]['ISD_5thIssuance'])||empty($hexuple[$coin['AD_Code']]['ISD_4thIssuance'])?'readonly':''?> /> </td>
						<td><input type="text" name="issuance6[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_6thIssuance'])?$hexuple[$coin['AD_Code']]['ISD_6thIssuance']:'';?>" class="my-table-form" <?=!empty($hexuple[$coin['AD_Code']]['ISD_6thIssuance'])||empty($hexuple[$coin['AD_Code']]['ISD_5thIssuance'])?'readonly':''?> /> </td>
						<td style="background:#eee;color: #3D6A7D;font-weight: bold;" ><?=$coin_total?></td>
						<td><input type="text" name="issuanceby1[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_1stIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form" readonly /> </td>
						<td><input type="text" name="issuanceby2[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_2ndIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form" readonly /> </td>
						<td><input type="text" name="issuanceby3[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_3rdIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form" readonly /> </td>
						<td><input type="text" name="issuanceby4[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_4thIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form" readonly /> </td>
						<td><input type="text" name="issuanceby5[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_5thIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form" readonly /> </td>
						<td><input type="text" name="issuanceby6[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_6thIssuedBy'])?$session['U_User_id']:''?>" class="my-table-form" readonly /> </td>
						
						<?php if ($this->data['module'] == 'returns'): ?>
							<td>
								<input type="text" data-name="returns" class="form-control return-edit text-center" name="return[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_Return'])?$hexuple[$coin['AD_Code']]['ISD_Return']:'';?>" <?=!empty($hexuple[$coin['AD_Code']]['ISD_Return'])?'readonly':'';?> >
							</td>
							<td>
								<input type="text" data-name="returns" class="form-control return-edit text-center" name="ISD_QtySold[]" value="<?=!empty($hexuple[$coin['AD_Code']]['ISD_QtySold'])?$hexuple[$coin['AD_Code']]['ISD_QtySold']:'';?>" <?=!empty($hexuple[$coin['AD_Code']]['ISD_QtySold'])?'readonly':'';?> >
							</td>
							<td><?=(!empty($hexuple[$coin['AD_Code']]['ISD_QtySold'])?$hexuple[$coin['AD_Code']]['ISD_QtySold']:0)+(!empty($hexuple[$coin['AD_Code']]['ISD_Return'])?$hexuple[$coin['AD_Code']]['ISD_Return']:0)?></td>
							<td>Total</td>
						<?php endif ?>

					</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

	<div class="row">
		<button type="submit" class="btn btn-default form-btn main-clr">Save</button>
		<a href="<?=base_url().'app/sales-operation/'.$module;?>" class="btn btn-default form-btn sub-clr " data-dismiss="modal">Cancel</a>
	</div>
	
<!--
</form>
-->