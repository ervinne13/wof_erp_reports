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
	<table class="table table-bordered" border="1">
		<thead>
			<tr>
				<th rowspan="2" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></th>
				<th rowspan="2" >Particulars</th>
				<th rowspan="2">Price</th>
				<th colspan="2">Issuance</th>
				<th rowspan="2">Qty Issued</th>
				<th rowspan="2">Issued By</th>


				<?php if ($module == 'returns'): ?>
					<th colspan="2">Returns</th>
					<th rowspan="2">Sold Quantity</th>
					<th rowspan="2">Peso Sales</th>
				<?php endif ?>

			</tr>
			<tr>
				<th>Beginning</th>
				<th>Ending</th>

				<?php if ($module == 'returns'): ?>
					<th>Beginning</th>
					<th>Ending</th>
				<?php endif ?>
			</tr>

		</thead>
		<tbody>
			<?php 
				$total = 0;
				foreach($wrist_tags as $k => $wrist_tag): 
				$total += !empty($serialized[$wrist_tag['AD_Code']]['ISD_PesoSales'])?$serialized[$wrist_tag['AD_Code']]['ISD_PesoSales']:0;
				// pre($serialized);exit;
			?>
				<tr>
					<td>
						<input type="hidden" name="ISD_LineNo[]" value="<?=!empty($serialized[$wrist_tag['AD_Code']])?$serialized[$wrist_tag['AD_Code']]['ISD_LineNo']:''?>">
						<input type="hidden" name="ISD_ItemNo[]" value="<?=!empty($serialized[$wrist_tag['AD_Code']])?$serialized[$wrist_tag['AD_Code']]['ISD_ItemNo']:''?>">
						<input type="hidden" name="ISD_Type[]" value="<?=$isd_type?>">
						<input type="hidden" name="ISD_IS_DocNo2[]" value="<?=$docno?>">
						<input type="hidden" name="ac_code[]" value="<?=$wrist_tag['AD_Code'];?>">
						<input type="hidden" name="price[]" value="<?=$wrist_tag['TTP_Price'];?>">
						<input type="hidden" name="qty[]" value="<?=!empty($wrist_tag['IUC_Quantity'])?$wrist_tag['IUC_Quantity']:'';?>">
					</td>
					<td><?=$wrist_tag['IM_Sales_Desc'];?></td>
					<td><?=$wrist_tag['TTP_Price'];?></td>
					<td><input type="text" name="beginning[]" id="mybeginning<?=$k?>" value="<?=!empty($serialized[$wrist_tag['AD_Code']])?$serialized[$wrist_tag['AD_Code']]['ISD_Beginning']:''?>" <?=!empty($serialized[$wrist_tag['AD_Code']]['ISD_Beginning'])?'readonly':''?> class="my-table-form my_on_change" data-row="<?=$k?>" /> </td>
					<td><input type="text" name="Ending[]" id="myend<?=$k?>" value="<?=!empty($serialized[$wrist_tag['AD_Code']])?$serialized[$wrist_tag['AD_Code']]['ISD_Ending']:''?>" <?=!empty($serialized[$wrist_tag['AD_Code']]['ISD_Ending'])?'readonly':''?> class="my-table-form my_on_change" data-row="<?=$k?>" /></td>
					<td><label id="myqty<?=$k?>"><?=!empty($serialized[$wrist_tag['AD_Code']])?$serialized[$wrist_tag['AD_Code']]['ISD_QtyIssued']:''?></label></td>
					<td><?=!empty($serialized[$wrist_tag['AD_Code']])?$serialized[$wrist_tag['AD_Code']]['ISD_IssuedBy']:''?></td>
					<?php if ($module == 'returns'): ?>
						<td>
								<input type="text" id="mybeginning_r<?=$k?>" class="return-edit form-control my-table-form my_on_change_r" data-row="<?=$k?>" name="ISD_RTBeginning[]" value="<?=!empty($serialized[$wrist_tag['AD_Code']])?number_format($serialized[$wrist_tag['AD_Code']]['ISD_RTBeginning'], 0, '.', ''):'';?>" <?=(!empty($serialized[$wrist_tag['AD_Code']]['ISD_RTBeginning'])?'readonly':'')?> />
							</td>
							<td>
								<input type="text" id="myend_r<?=$k?>" class="return-edit form-control my-table-form my_on_change_r" data-row="<?=$k?>" name="ISD_RTEnding[]" value="<?=!empty($serialized[$wrist_tag['AD_Code']])?number_format($serialized[$wrist_tag['AD_Code']]['ISD_RTEnding'], 0, '.', ''):'';?>" <?=(!empty($serialized[$wrist_tag['AD_Code']]['ISD_RTEnding'])?'readonly':'')?> />
							</td>
							<td>
								<label id="myqty_r<?=$k?>"><?=!empty($serialized[$wrist_tag['AD_Code']])?$serialized[$wrist_tag['AD_Code']]['ISD_QtySold']:'--'?></label>
							</td>
							<td>
								<?=!empty($serialized[$wrist_tag['AD_Code']]['ISD_PesoSales'])?$serialized[$wrist_tag['AD_Code']]['ISD_PesoSales']:'0'?>
							</td>
					<?php endif ?>
				</tr>
			<?php endforeach; ?>
	
			<?php if ($module == 'returns'): ?>
				<tr>
					<td colspan="10" class="text-right">
						<b>Total:</b>
					</td>
					<td>
						<?=$total?>
					</td>
				</tr>
			<?php endif ?>
			
		</tbody>
	</table>
</div>
	<div class="row">
		<button type="submit" class="btn btn-default form-btn main-clr">Save</button>
		<a href="<?=base_url().'app/sales-operation/'.$module;?>" class="btn btn-default form-btn sub-clr " data-dismiss="modal">Cancel</a>
	</div>
	
<script>
$(document).ready(function(){
	
	$('.my_on_change').on('change', function(){
		var row = $(this).data('row');
		var b = $('#mybeginning'+row).val();
		var e = $('#myend'+row).val();
		
		$('#myqty'+row).html(e-b+1);
		console.log('yasmin');
		
	})
	
	$('.my_on_change_r').on('change', function(){
		var row = $(this).data('row');
		var b = $('#mybeginning_r'+row).val();
		var e = $('#myend_r'+row).val();
		
		$('#myqty_r'+row).html(e-b+1);
		console.log('yasmin');
		
	})
})
</script>