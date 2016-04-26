<div class="allocate clearfix">
	<div class="col-md-6 form form-horizontal">
		<div class="form-group">
		    <div class="col-md-3 control-label">Item No:</div>
		    <div class="col-md-7">
		    	<input type="text" class="form-control" value="<?=$item['BAD_ItemNo'];?>" disabled>
		    </div>
		</div>

		<div class="form-group">
		    <div class="col-md-3 control-label">Item Description:</div>
		    <div class="col-md-7">
		    	<input type="text" class="form-control" value="<?=$item['BAD_Description'];?>" disabled>
		    </div>
		</div>

		<div class="form-group">
		    <div class="col-md-3 control-label">Unit Price:</div>
		    <div class="col-md-7">
		    	<input type="text" class="form-control" value="<?=number_format($item['BAD_UnitPrice'], 2);?>" disabled>
		    </div>
		</div>
		
		<div class="form-group hide">
		    <div class="col-md-3 control-label">Status:</div>
		    <div class="col-md-7">
		    	<input type="text" class="form-control" value="<?=$main['BA_Status'];?>" disabled>
		    </div>
		</div>

	</div>

	<div class="col-md-6">
		<?php if (!empty($item['BAD_Image'])): ?>
			<img src="<?=$item['BAD_Image'];?>" class="sub-detail-img">
		<?php endif ?>
	</div>
</div>

<form action="<?=site_url('app/sales-operation/batch/save_sub_details/' . $docno . '/' . $item_no);?>" method="post">
	<table class="table table-striped table-bordered table-condensed text-center">
		<thead>
			<th>Branch</th>
			<th class="col-md-2">Suggested Qty</th>
			<th class="col-md-2">Approved Qty</th>
			<th>Suggested Total Price</th>
			<th>Approved Total Price</th>
		</thead>
		
		<tbody>
			<?php foreach ($details as $i => $v): ?>
				<tr>
					<td>
						<?=$v['BASD_Location'];?>
						<input type="hidden" name="BASD_LineNo[]" value="<?=$v['BASD_LineNo'];?>">
					</td>
					<td>
						<input type="text" name="BASD_SuggestedQty[]" class="form-control text-center" value="<?= number_format($v['BASD_SuggestedQty'], 0);?>" <?=$main['BA_Status'] != 'Open' ? 'readonly' : NULL;?>>
					</td>
					<td>
						<input type="text" name="BASD_ApprovedQty[]" class="form-control text-center" value="<?= number_format($v['BASD_ApprovedQty'], 0);?>" <?=$main['BA_Status'] == 'Open' ? 'readonly' : NULL;?>>
					</td>
					<td><?= number_format($v['BASD_SuggestedTotalPrice'], 2);?></td>
					<td><?= number_format($v['BASD_ApprovedTotalPrice'], 2);?></td>
				</tr>
			<?php endforeach ?>
			
		</tbody>

	</table>

	<button class="btn btn-default form-btn main-clr" type="submit">Save</button>
	<a href="<?=site_url('app/sales-operation/batch/details/' . $docno);?>" class="btn btn-default form-btn sub-clr">Cancel</a>

</form>
