<?=$this->load->view('app/sales-operation/token/tabs', NULL, TRUE);?>
<form action="<?=site_url('app/sales-operation/token/fgc_setup_add');?>" method="post">
	<table class="table table-condensed table-bordered text-center" id="fgc-table">
		<thead>
			<th>
				<a href="#" onclick="token.addFgcSetup(); return false;">
					<span class="glyphicon glyphicon-plus"></span>
				</a>
			</th>
			<th>Type</th>
			<th>Series From</th>
			<th>Series To</th>
			<th>Face Value</th>
			<th>Expiration</th>
		</thead>

		<tbody>

			<?php foreach ($items as $v): ?>
				<tr>
					<td>
						<a href="#" onclick="token.removeFgcSetup(this); return false;">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						</a>
					</td>
					<td>
						<select name="FTTIS_Type[]" id="" class="form-control">
							<option value="FGC" <?=$v['FTTIS_Type'] == 'FGC' ? 'selected' : NULL;?>>FGC</option>
							<option value="GRC" <?=$v['FTTIS_Type'] == 'GRC' ? 'selected' : NULL;?>>GRC</option>
						</select>
					</td>
					<td>
						<input type="text" class="form-control text-center" value="<?=$v['FTTIS_SeriesFrom'];?>" name="FTTIS_SeriesFrom[]" required>	
					</td>
					<td>
						<input type="text" class="form-control text-center" value="<?=$v['FTTIS_SeriesTo'];?>" name="FTTIS_SeriesTo[]" required>	
					</td>
					<td>
						<input type="text" class="form-control text-center" value="<?=number_format($v['FTTIS_FaceValue'], 2);?>" name="FTTIS_FaceValue[]" required>	
					</td>
					<td>
						<input type="text" class="form-control text-center datepicker" value="<?=date('m/d/Y', strtotime($v['FTTIS_ExpirationDate']));?>" name="FTTIS_ExpirationDate[]" required>	
					</td>
				</tr>
			<?php endforeach ?>
			
		</tbody>
	</table>


	<button class="btn btn-default form-btn main-clr" type="submit">Save</button>
	<a href="<?=site_url('app/sales-operation/token');?>" class="btn btn-default form-btn sub-clr">Cancel</a>
</form>

<!-- TR CLONE -->
<table class="hide" id="table-clone">
	<tbody>
		<tr class="fgc-row">
			<td>
				<a href="#" onclick="token.removeFgcSetup(this); return false;">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</a>
			</td>
			<td>
				<select name="FTTIS_Type[]" id="" class="form-control">
					<option value="FGC">FGC</option>
					<option value="GRC">GRC</option>
				</select>
			</td>
			<td>
				<input type="text" class="form-control text-center" name="FTTIS_SeriesFrom[]">	
			</td>
			<td>
				<input type="text" class="form-control text-center"  name="FTTIS_SeriesTo[]">	
			</td>
			<td>
				<input type="text" class="form-control text-center"  name="FTTIS_FaceValue[]">	
			</td>
			<td>
				<input type="text" class="form-control text-center set-datepicker" value="<?=date('m/d/Y');?>" name="FTTIS_ExpirationDate[]">	
			</td>
		</tr>
	</tbody>
</table>

<!-- END --> 