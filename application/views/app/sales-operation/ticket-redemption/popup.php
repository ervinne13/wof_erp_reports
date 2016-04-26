<div class="modal alert-popup coupon-popup" id="coupon-popup" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Search</h4>
			</div>

			<div class="modal-body">

				<form class="form-inline" onsubmit="redemption.goSearch(); return false;">
					<div class="form-group">
						<label for="item-description">Item Description:</label>
						<input type="text" class="form-control search-pop" id="item-description" >
						<button type="submit" class="btn btn-default form-btn main-clr">Search</button>
					</div>
				</form>
				<div class="table-wrap">
					<table class="table table-striped table-hover table-bordered  table-condensed dynatable">
						
						<thead>
							<th>Barcode</th>
							<th>Item Code</th>
							<th>Description</th>
							<th>Points</th>
						</thead>
						
						<tbody></tbody>

					</table>
				</div>

			</div>


		</div>
	</div>
</div>