<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
          	<span class="dropdown pull-right">
				<a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                	Functions
                	<span class="caret"></span>
              	</a>
              	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
	                <li><a href="">Send Approval Request</a></li>
					<li><a href="">Cancel Approval Request</a></li>
					<li><a href="">Reopen</a></li>
					<li><a href="">Approve (for approvers only)</a></li>
					<li><a href="">Reject (for approvers only)</a></li>
					<li><a href="">Post</a></li>
					<li><a href="">Print Gate Pass</a></li>
					<li><a href="" data-toggle="modal" data-target=".to-modal">Convert TO</a></li>
					<li><a href="">Assigned</a></li>
					<li><a href="">Track Document</a></li>
              	</ul>
              	<a class="cls-btn" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
				  Close
				</a>
            </span>
      	</h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
					  <div class="col-xs-7">
				        <label for="sel1" class="control-label">TR100001</label>
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">04/21/15</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				         <label class="control-label" for="">[Remarks]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Priority Level:</label>
				      <div class="col-xs-7">
				         <label class="control-label" for="">High</label>
				      </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Status:</label>
					  <div class="col-xs-7">
					       <label for="sel1" class="control-label">Approved</label>
					   </div>
					</div>
				</span>
				<span class="col-md-6">
					
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Plan Ship Date:</label>
					  <div class="col-xs-7">
					         <label for="sel1" class="control-label">04/21/15</label>
					   </div>
					</div>
					<div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Date Required:</label>
				      <div class="col-xs-7">
					         <label for="sel1" class="control-label">04/21/15</label>
					   </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Shipper:</label>
				      <div class="col-xs-7">
					         <label for="sel1" class="control-label">WOF</label>
					   </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Truck #:</label>
				      <div class="col-xs-7">
					       <label class="control-label" for="">ABC 123</label>
					   </div>
				    </div>
				</span>
			</form>
			<div class="details">Details</div>
			<table class="presentation table table-striped table-hover table-bordered  table-condensed">
				<thead>
					<tr>
						<th>Document No.</th>
						<th>Document Date</th>
						<th>Date Required</th>
						<th>Transfer From</th>
						<th>Transfer To</th>
						<th>Shipping Date</th>
						<th>Shipping ETA</th>
						<th>Shipping Method</th>
						<th>Shipping Agent</th>
						<th>Remarks</th>
						<th>Priority Level</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>TO-10002</td>
						<td>12/02/15</td>
						<td>12/25/15</td>
						<td>Warehouse</td>
						<td>SM - Megamall</td>
						<td>12/27/15</td>
						<td>12/27/15</td>
						<td>LAND</td>
						<td>WOF</td>
						<td>[Remarks]</td>
						<td>HIGH</td>
						<td>Pending</td>
					</tr>
					<tr>
						<td>TO-10003</td>
						<td>12/02/15</td>
						<td>12/25/15</td>
						<td>Warehouse</td>
						<td>SM - Megamall</td>
						<td>12/27/15</td>
						<td>12/27/15</td>
						<td>LAND</td>
						<td>WOF</td>
						<td>[Remarks]</td>
						<td>HIGH</td>
						<td>Pending</td>
					</tr>	
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade to-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Convert TO</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <table class="table table-striped table-hover table-bordered  table-condensed">
				<thead>
					<tr>
						<th><input type="checkbox"></th>
						<th>Document No.</th>
						<th>Document Date</th>
						<th>Date Required</th>
						<th>Transfer From</th>
						<th>Transfer To</th>
						<th>Shipping Date</th>
						<th>Shipping ETA</th>
						<th>Shipping Method</th>
						<th>Shipping Agent</th>
						<th>Remarks</th>
						<th>Priority Level</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="checkbox"></td>
						<td>TO-10002</td>
						<td>12/02/15</td>
						<td>12/25/15</td>
						<td>Warehouse</td>
						<td>SM - Megamall</td>
						<td>12/27/15</td>
						<td>12/27/15</td>
						<td>LAND</td>
						<td>WOF</td>
						<td>[Remarks]</td>
						<td>HIGH</td>
						<td>Pending</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td>TO-10003</td>
						<td>12/02/15</td>
						<td>12/25/15</td>
						<td>Warehouse</td>
						<td>SM - Megamall</td>
						<td>12/27/15</td>
						<td>12/27/15</td>
						<td>LAND</td>
						<td>WOF</td>
						<td>[Remarks]</td>
						<td>HIGH</td>
						<td>Pending</td>
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
	   $('.modal').find('.dynatable-search').prepend('Date Filter: <input type="search" id="date-from"/><input type="search"  id="date-to"/> ')
	    .append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
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