<style>
.my-table-form{width:55px !important;color:#000 !important;}
.my-table-form:hover{color:#000 !important;}
input[readonly]
{
    background-color:#eee !important;
}
</style>

<!--
<form action="<?=base_url()?>app/sales-operation/issuance/submit_ticket/<?=$issuance['IS_DocNo']?>" method="POST">
-->
<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></th>
				<th >Particulars</th>
				<th >Price</th>
				<th >Issuance</th>
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
				foreach($socks as $sock): 
				$total += (!empty($single[$sock['AD_Code']]['ISD_QtySold'])?$single[$sock['AD_Code']]['ISD_QtySold']:0)*(!empty($single[$sock['AD_Code']]['ISD_QtySold'])?$single[$sock['AD_Code']]['ISD_QtySold']:0)-(!empty($single[$sock['AD_Code']]['ISD_Returned'])?$single[$sock['AD_Code']]['ISD_Returned']:0);
			// pre($sock);
			// pre($single);exit;
			?>
				<tr>
					<td>
					<!--
						<input type="hidden" name="ISD_LineNo[]" value="<?=!empty($serialized[$sock['AD_Code']])?$serialized[$sock['AD_Code']]['ISD_LineNo']:''?>">
						<input type="hidden" name="ISD_ItemNo[]" value="<?=!empty($serialized[$sock['AD_Code']])?$serialized[$sock['AD_Code']]['ISD_ItemNo']:''?>">
						<input type="hidden" name="ISD_Type[]" value="<?=$isd_type?>">
						<input type="hidden" name="ISD_IS_DocNo3[]" value="<?=$docno?>">
						<input type="hidden" name="ac_code[]" value="<?=$sock['AD_Code'];?>">
						<input type="hidden" name="price[]" value="<?=$sock['TTP_Price'];?>">
						<input type="hidden" name="qty[]" value="<?=!empty($sock['IUC_Quantity'])?$sock['IUC_Quantity']:'';?>">
					-->
						<input type="hidden" name="ac_code[]" value="<?=$sock['AD_Code'];?>">
						<input type="hidden" name="price[]" value="<?=$sock['TTP_Price'];?>">
						
						<input type="hidden" name="ISD_IS_DocNo3[]" value="<?=$docno;?>" />
						<input type="hidden" name="ISD_LineNo[]" value="<?=!empty($single[$sock['AD_Code']])?$single[$sock['AD_Code']]['ISD_LineNo']:'';?>" />
						<input type="hidden" name="ISD_Type[]" value="<?=$isd_type?>" />
						
					</td>
					<td><?=$sock['IM_Sales_Desc'];?></td>
					<td><?=$sock['TTP_Price'];?></td>
					<td>
						<input type="text" name="ISD_Issuance[]" value="<?=!empty($single[$sock['AD_Code']]['ISD_Issuance'])?$single[$sock['AD_Code']]['ISD_Issuance']:'';?>" class="my-table-form form-control" <?=!empty($single[$sock['AD_Code']]['ISD_Issuance'])?'readonly':''?> />
					</td>
					<!--
					<td><input type="text" name="beginning[]" value="<?=!empty($serialized[$sock['AD_Code']])?$serialized[$sock['AD_Code']]['ISD_Beginning']:''?>" <?=!empty($serialized[$sock['AD_Code']]['ISD_Beginning'])?'readonly':''?> class="my-table-form" /> </td>
					<td><input type="text" name="Ending[]" value="<?=!empty($serialized[$sock['AD_Code']])?$serialized[$sock['AD_Code']]['ISD_Ending']:''?>" <?=!empty($serialized[$sock['AD_Code']]['ISD_Ending'])||empty($serialized[$sock['AD_Code']]['ISD_Beginning'])?'readonly':''?> class="my-table-form" /></td>
					<td><?=!empty($sock['IUC_Quantity'])?$sock['IUC_Quantity']:''?></td>
					-->
					<td><?=$session['U_User_id']?></td>

					<?php if ($module == 'returns'): ?>
						<td>
							<input type="text" name="ISD_Returned[]" class="my-table-form form-control return-edit" value="<?=!empty($single[$sock['AD_Code']]['ISD_Returned'])?$single[$sock['AD_Code']]['ISD_Returned']:'';?>">
						</td>
						<td>
							<?=(!empty($single[$sock['AD_Code']]['ISD_QtySold'])?$single[$sock['AD_Code']]['ISD_QtySold']:0)-(!empty($single[$sock['AD_Code']]['ISD_Returned'])?$single[$sock['AD_Code']]['ISD_Returned']:0)?>
						</td>
						<td>
							<?=(!empty($single[$sock['AD_Code']]['ISD_QtySold'])?$single[$sock['AD_Code']]['ISD_QtySold']:0)*(!empty($single[$sock['AD_Code']]['ISD_QtySold'])?$single[$sock['AD_Code']]['ISD_QtySold']:0)-(!empty($single[$sock['AD_Code']]['ISD_Returned'])?$single[$sock['AD_Code']]['ISD_Returned']:0)?>
						</td>
					<?php endif ?>
				</tr>
			<?php endforeach; ?>
			
			<?php if ($module == 'returns'): ?>
				<tr>
					<td colspan="7" class="text-right">
						<b>Total:</b>
					</td>
					<td><?=$total;?></td>
				</tr>
			<?php endif ?>
			
		</tbody>
	</table>
</div>
</div>
	<div class="row">
		<button type="submit" class="btn btn-default form-btn main-clr">Save</button>
		<a href="<?=base_url().'app/sales-operation/'.$module;?>" class="btn btn-default form-btn sub-clr " data-dismiss="modal">Cancel</a>
	</div>
	<!--
</form>
-->