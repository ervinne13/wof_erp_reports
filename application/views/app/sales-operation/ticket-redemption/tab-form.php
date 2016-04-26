
<div class="form-pane form">
	<div class="title">Transaction</div>
	<div class="form-group">
		<div class="col-md-4 control-label">Doc.No.:</div>
		<div class="col-md-8">
			<input type="text" class="form-control" id="doc-no" value="<?=$item['doc_no'];?>" readonly>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4 control-label">Doc.Date.:</div>
		<div class="col-md-8">
			<input type="text" class="form-control" id="doc-date" value="<?=$item['date'];?>" readonly>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4 control-label">Branch:</div>
		<div class="col-md-8">
			<input type="text" class="form-control" id="doc-branch" value="<?=$item['branch'];?>" readonly>
		</div>
	</div>
</div>

<form class="form-pane form" onSubmit="redemption.ticketCount(); return false;" id="ticket-count-form">
	<div class="title">Tickets</div>
	<div class="form-group">
		<div class="col-md-4 control-label">Qty:</div>
		<div class="col-md-8">
			<input type="text" class="form-control" id="ticket-count" autocomplete="off">
		</div>
	</div>

	<div class="form-group btn-act">
		<div class="col-md-8 col-md-offset-4">
			<button class="btn btn-default form-btn main-clr">Add</button>
		</div>
	</div>
</form>

<form class="form-pane form" id="add-ticket-form" onSubmit="redemption.goSearch(); return false;">
	<div class="title">Items</div>
	<div class="form-group">
		<div class="col-md-4 control-label">Description:</div>
		<div class="col-md-8 item-desc">
			<input type="txt" class="form-control" id="item-desc" >
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4 control-label">Item Code:</div>
		<div class="col-md-8">
			<input type="text" class="form-control" id="item-code" readonly>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4 control-label">Qty:</div>
		<div class="col-md-8">
			<input type="text" class="form-control" id="item-qty" disabled>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4 control-label">Barcode:</div>
		<div class="col-md-8">
			<input type="text" class="form-control" readonly>
		</div>
	</div>

	<div class="form-group hide">
		<div class="col-md-4 control-label">Points:</div>
		<div class="col-md-8">
			<input type="text" class="form-control" id="item-points" readonly>
		</div>
	</div>
	
	<div class="form-group hide">
		<div class="col-md-4 control-label">Hash:</div>
		<div class="col-md-8">
			<input type="text" class="form-control" id="item-hash" readonly>
		</div>
	</div>

	<div class="form-group btn-act">
		<div class="col-md-8 col-md-offset-4">
			<button class="btn btn-default form-btn main-clr disabled" id="add-ticket" disabled type="button" onclick="redemption.addTicket();">Add</button>
			<button class="btn btn-default form-btn sub-clr" type="submit" onClick="redemption.searchItem();" id="search-item">Search</button>
			<button class="btn btn-default form-btn main-clr" type="reset" onclick="redemption.clearTicket();">Clear</button>
		</div>
	</div>

</form>