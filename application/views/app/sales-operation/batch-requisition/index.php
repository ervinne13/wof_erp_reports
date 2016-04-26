<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<table class="presentation table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>
							<a href="" data-toggle="modal" data-target=".br-modal" class="edit">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th>Document No.</th>
						<th>Document Date</th>
						<th>Supplier</th>
						<th>Remarks</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="edit">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>BR-10001</td>
						<td>12/02/15</td>
						<td>Supplier</td>
						<td>Remarks</td>
						<td>Pending</td>
					</tr>	
				</tbody>
			</table>
		</div>
    </div>
</div>
<div class="modal fade br-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Batch Requisition</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
      		<form class="form-horizontal row page-form" role="form" class="container-fluid">
      			<legend>Header</legend>
      			<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Document No.">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Document Date:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Document Date">
				      </div>
					</div>
				</span>
				<span class="col-md-6">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Supplier">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Remarks">
				      </div>
				    </div>
				</span>
      			<legend>Items</legend>
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Item Code:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Item Code">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Description:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Description">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Qty">
				      </div>
				    </div>
				</span>
			</form>
	        <table class="table table-striped table-hover table-bordered">
	 			<thead>
					<tr>
						<th></th>
						<th>Item Code</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="" class="edit">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="" class="edit">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
						<td>FA100001</td>
						<td>Drummania V7</td>
					</tr>
				</tbody>
			</table>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default form-btn main-clr">Convert</button>
      </div>
    </div>
  </div>
</div>	
<script type="text/javascript">
$(document).ready(function(){

  	$('.modal').find('.table').bind('dynatable:init', function(e, dynatable) {
	   $('.modal').find('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
	    $(this).wrap('<div class="table-container"></div>')
	    var $demo1 = $(this);
			$demo1.floatThead({
				scrollContainer: function($table){
					return $table.closest('.table-container');
				}
		});

		$("#date-from,#date-to").datepicker({ dateFormat: 'yy-mm-dd'});
	}).dynatable();

	$('.modal').on('shown.bs.modal', function (e) {
		_this = $(this);
		_this.find('.table').floatThead('reflow');
	});

});
</script>