<div class="modal alert-popup" id="redemption-list">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Remdemption</h4>
			</div>

			<div class="modal-body">
				<form class="form-inline" onsubmit="redemption.searchDocNo(); return false;">
					<div class="form-group">
						<label for="item-description">Doc No:</label>
						<input type="text" class="form-control" id="search-doc-no">
						<button type="submit" class="btn btn-default form-btn main-clr">Search</button>
						<button type="button" class="btn btn-default form-btn sub-clr disabled" disabled id="void-btn" onclick="redemption.voidTickets();">Void</button>
					</div>
				</form>
				
				<div class="table-wrap">
					
					
					<table class="table table-striped table-hover table-bordered  table-condensed dynatable">
						<thead class="text-center">
							<th></th>
	 						<th>Doc No</th>
	 						<th>Location</th>
	 						<th>Quantity</th>
	 						<th>Date Created</th>
	 						<th>Status</th>
						</thead>

						<tbody></tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</div>