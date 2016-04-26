<style>
.my-table-form{color:#000 !important;}
.my-table-form:hover{color:#000 !important;}
</style>


<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></th>
				<th >Particulars</th>
				<th >Price</th>
				<th >Qty Issued</th>
				<th >Issued By</th>

				<?php if ($module == 'returns'): ?>
					<th>Returns</th>
					<th>Sold Qty</th>
					<th>Peso Sales</th>
				<?php endif ?>
			</tr>
		</thead>
		<tbody>
			<?php 
				$total = 0;
				foreach($data_cards as $data_card): 
				$total += (!empty($single[$data_card['AD_Code']]['ISD_QtySold'])?$single[$data_card['AD_Code']]['ISD_QtySold']:0)*(!empty($single[$data_card['AD_Code']]['ISD_QtySold'])?$single[$data_card['AD_Code']]['ISD_QtySold']:0)-(!empty($single[$data_card['AD_Code']]['ISD_Returned'])?$single[$data_card['AD_Code']]['ISD_Returned']:0);
				// pre($data_card);exit;
			?>
				<tr class="text-center">
					<td>
						<input type="hidden" name="ac_code[]" value="<?=$data_card['AD_Code'];?>">
						<input type="hidden" name="price[]" value="<?=$data_card['TTP_Price'];?>">
						
						<input type="hidden" name="ISD_IS_DocNo3[]" value="<?=$docno;?>" />
						<input type="hidden" name="ISD_LineNo[]" value="<?=!empty($single[$data_card['AD_Code']])?$single[$data_card['AD_Code']]['ISD_LineNo']:'';?>" />
						<input type="hidden" name="ISD_Type[]" value="4" />
						
					</td>
					<td><?=$data_card['IM_Sales_Desc'];?></td>
					<td><?=$data_card['TTP_Price'];?></td>
					<td>
						<input type="text" name="qty[]" value="<?=!empty($single[$data_card['AD_Code']]['ISD_QtySold'])?$single[$data_card['AD_Code']]['ISD_QtySold']:'';?>" class="my-table-form form-control" <?=!empty($single[$data_card['AD_Code']]['ISD_QtySold'])?'readonly':''?> />
					</td>
					<td><?=$session['U_User_id'];?></td>

					<?php if ($module == 'returns'): ?>
						<td>
							<input type="text" name="ISD_Returned[]" class="my-table-form form-control return-edit" value="<?=!empty($single[$data_card['AD_Code']]['ISD_Returned'])?$single[$data_card['AD_Code']]['ISD_Returned']:'';?>">
						</td>
						<td>
							<?=(!empty($single[$data_card['AD_Code']]['ISD_QtySold'])?$single[$data_card['AD_Code']]['ISD_QtySold']:0)-(!empty($single[$data_card['AD_Code']]['ISD_Returned'])?$single[$data_card['AD_Code']]['ISD_Returned']:0)?>
						</td>
						<td>
							<?=(!empty($single[$data_card['AD_Code']]['ISD_QtySold'])?$single[$data_card['AD_Code']]['ISD_QtySold']:0)*(!empty($single[$data_card['AD_Code']]['ISD_QtySold'])?$single[$data_card['AD_Code']]['ISD_QtySold']:0)-(!empty($single[$data_card['AD_Code']]['ISD_Returned'])?$single[$data_card['AD_Code']]['ISD_Returned']:0)?>
						</td>
					<?php endif ?>
				</tr>

				
			<?php endforeach; ?>
		</tbody>
			<?php if ($module == 'returns'): ?>
				<tr>
					<td colspan="7" class="text-right">
						<b>Total:</b>
					</td>
					<td><?=$total?></td>
				</tr>
			<?php endif ?>
			
	</table>
</div>
	<div class="row">
		<button type="submit" class="btn btn-default form-btn main-clr">Save</button>
		<a href="<?=base_url().'app/sales-operation/'.$module;?>" class="btn btn-default form-btn sub-clr " data-dismiss="modal">Cancel</a>
	</div>
