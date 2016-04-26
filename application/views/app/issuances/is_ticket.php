<style>
.my-table-form{width:55px !important;color:#000 !important; display: inline-block;}
.my-table-form:hover{color:#000 !important;}
</style>

	<div class="row">
		<table class="table table-bordered" border="1">
			<thead>
				<tr>
					<th rowspan="2" class="hide" ></th>
					<th rowspan="2" >Ticket Price</th>
					<th rowspan="2" >Ticket Color</th>
					<th colspan="2">Issuance</th>
					<th rowspan="2" >Qty Issued</th>
					<th rowspan="2" >Issued By</th>

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
				<?php foreach($tickets as $k => $ticket): 
				// pre($ticket);exit;
				?>
					<tr class="text-center">
						<td class="hide">
							<input type="hidden" name="ISD_LineNo[]" value="<?=!empty($serialized[$ticket['AD_Code']])?$serialized[$ticket['AD_Code']]['ISD_LineNo']:''?>">
							<input type="hidden" name="ISD_ItemNo[]" value="<?=!empty($serialized[$ticket['AD_Code']])?$serialized[$ticket['AD_Code']]['ISD_ItemNo']:''?>">
							<input type="hidden" name="ISD_Type[]" value="3">
							<input type="hidden" name="ISD_IS_DocNo2[]" value="<?=$docno?>">
							<input type="hidden" name="ac_code[]" value="<?=$ticket['AD_Code'];?>">
							<input type="hidden" name="price[]" value="<?=$ticket['TTP_Price'];?>">
							<input type="hidden" name="qty[]" value="<?=$ticket['IUC_Quantity'];?>">
						</td>
						<td><?=$ticket['TTP_Price'];?></td>
						<td><?=$ticket['IM_Sales_Desc'];?></td>
						<td><input type="text" name="beginning[]" id="mybeginning<?=$k?>" value="<?=!empty($serialized[$ticket['AD_Code']])?$serialized[$ticket['AD_Code']]['ISD_Beginning']:''?>" <?=!empty($serialized[$ticket['AD_Code']])?'readonly':''?> class="my-table-form form-control my_on_change" data-row="<?=$k?>" /> </td>
						<td><input type="text" name="Ending[]" id="myend<?=$k?>" value="<?=!empty($serialized[$ticket['AD_Code']])?$serialized[$ticket['AD_Code']]['ISD_Ending']:''?>" <?=!empty($serialized[$ticket['AD_Code']]['ISD_Ending'])?'readonly':''?> class="my-table-form form-control my_on_change" data-row="<?=$k?>" /></td>
						<td><label id="myqty<?=$k?>"><?=!empty($serialized[$ticket['AD_Code']])?$serialized[$ticket['AD_Code']]['ISD_QtyIssued']:''?></label></td>
						<td><?=!empty($serialized[$ticket['AD_Code']])?$serialized[$ticket['AD_Code']]['ISD_IssuedBy']:''?></td>

						<?php if ($module == 'returns'): ?>
						
							<td>
								<input type="text" id="mybeginning_r<?=$k?>" class="return-edit form-control my-table-form my_on_change_r" data-row="<?=$k?>" name="ISD_RTBeginning[]" value="<?=!empty($serialized[$ticket['AD_Code']])?number_format($serialized[$ticket['AD_Code']]['ISD_RTBeginning'], 0, '.', ''):'';?>">
							</td>
							<td>
								<input type="text" id="myend_r<?=$k?>" class="return-edit form-control my-table-form my_on_change_r" data-row="<?=$k?>" name="ISD_RTEnding[]" value="<?=!empty($serialized[$ticket['AD_Code']])?number_format($serialized[$ticket['AD_Code']]['ISD_RTEnding'], 0, '.', ''):'';?>">
							</td>
							<td>
								<label id="myqty_r<?=$k?>"><?=!empty($serialized[$ticket['AD_Code']])?$serialized[$ticket['AD_Code']]['ISD_QtySold']:'--'?></label>
							</td>
							<td>
								<?=!empty($serialized[$ticket['AD_Code']])?$serialized[$ticket['AD_Code']]['ISD_PesoSales']:'--'?>
							</td>
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
	