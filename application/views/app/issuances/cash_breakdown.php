<form action="#">
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<th class="col-md-3">Denomination</th>
			<th class="col-md-1">Qty</th>
			<th>Amount</th>
		</thead>

		<tbody>
			
			<?php foreach ($deno as $v): ?>
				<tr class="text-center">	
					<td>
						<?=number_format($v, 2, '.', ',');?>
					</td>
					<td>
						<input type="text" class="form-control my-table-form return-edit">
					</td>
					<td></td>
				</tr>
			<?php endforeach ?>

			<tr>
				<td colspan="2" class="text-right">
					Total Cash Collections:
				</td>
				<td class="text-center"></td>
			</tr>

			<tr>
				<td colspan="2" class="text-right">
					Total Sales:
				</td>
				<td class="text-center"></td>
			</tr>

			<tr>
				<td colspan="2" class="text-right">
					Cash Over/(Short)
				</td>
				<td class="text-center"></td>
			</tr>
			
		</tbody>
	</table>

	<button type="submit" class="btn btn-default form-btn main-clr">Save</button>
	<button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Cancel</button>
</form>