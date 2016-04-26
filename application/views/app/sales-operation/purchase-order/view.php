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
					<li><a href="">Post to Receive</a></li>
					<li><a href="">Print</a></li>
					<li><a href="" data-toggle="modal" data-target=".po-modal">Convert RQ</a></li>
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
				        <label for="sel1" class="control-label">PO-100001</label>
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">04/21/15</label>
				      </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">External Do No.:</label>
					  <div class="col-xs-7">
					         <label for="sel1" class="control-label">[External Do No.]</label>
					   </div>
					</div>
					<div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Priority Level:</label>
				      <div class="col-xs-7">
					         <label for="sel1" class="control-label">High</label>
					   </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				         <label class="control-label" for="">[Remarks]</label>
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
				      <label class="control-label col-xs-5" for="">Transaction Type</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">Partial</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Vendor No.</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">V-100001</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Vendor Name:</label>
				      <div class="col-xs-7">
				         <label class="control-label" for="">VENDOR A</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Vendor Address:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">SUCAT, PARANAQUE</label>
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Vendor Ref No.:</label>
				      <div class="col-xs-7">
				         <label class="control-label" for="">[Vendor Ref No.]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Payment Terms:</label>
				      <div class="col-xs-7">
					         <label for="sel1" class="control-label">30 Days</label>
					   </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Exp Delivery Date:</label>
				      <div class="col-xs-7">
					       <label class="control-label" for="">05/06/15</label>
					   </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Required:</label>
				      <div class="col-xs-7">
					        <label class="control-label" for="">04/28/15</label>
					   </div>
				    </div>
				</span>
			</form>
			<div class="details">Details</div>
			<table class="presentation table table-striped table-hover table-bordered  table-condensed">
				<thead>
					<tr>
						<th>
							<a href="<?= base_url().uri_string() ?>/detail-add" class="">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th>Item Type.</th>
						<th>Item No.</th>
						<th>Description</th>
						<th>Asset Tag</th>
						<th>Location</th>
						<th>QTY</th>
						<th>CY</th>
						<th>UOM</th>
						<th>Unit Price</th>
						<th>Catalogue Price</th>
						<th>Discount</th>
						<th>Amount</th>
						<th>Amount in LCY</th>
						<th>Estimated Landed Cost</th>
						<th>Qty to Receive</th>
						<th>Qty Received</th>
						<th>Comment</th>
						<th>Store</th>
						<th>Refference From</th>
						<th>Refference To</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/detail-update" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="#" class="">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
						<td>Machine</td>
						<td>FA100001</td>
						<td>Drummania V7</td>
						<td></td>
						<td>HO-Whse</td>
						<td>2</td>
						<td>PC</td>
						<td>USD</td>
						<td>1,000.00</td>
						<td>1,000.00</td>
						<td></td>
						<td>2,000.00</td>
						<td>100,000.00</td>
						<td>110,000.00</td>
						<td>2</td>
						<td>2</td>
						<td>[comment]</td>
						<td>SM - Naga</td>
						<td>PR-100001</td>
						<td>RR-100001</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/detail-update" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="#" class="">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
						<td>Machine</td>
						<td>FA100002</td>
						<td>Battle Gear</td>
						<td></td>
						<td>HO-Whse</td>
						<td>1</td>
						<td>Unit</td>
						<td>USD</td>
						<td>1,000.00</td>
						<td>1,000.00</td>
						<td></td>
						<td>1,000.00</td>
						<td>50,000.00</td>
						<td>55,000.00</td>
						<td>1</td>
						<td>1</td>
						<td>[comment]</td>
						<td>SM - Naga</td>
						<td>PR-100001</td>
						<td>RR-100001 </td>
					</tr>			 
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/detail-update" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="#" class="">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
						<td>Machine</td>
						<td>FA100003</td>
						<td>Indiana Jones</td>
						<td></td>
						<td>HO-Whse</td>
						<td>1</td>
						<td>Unit</td>
						<td>USD</td>
						<td>1,000.00</td>
						<td>1,000.00</td>
						<td></td>
						<td>1,000.00</td>
						<td>50,000.00</td>
						<td>55,000.00</td>
						<td>1</td>
						<td>1</td>
						<td>[comment]</td>
						<td>SM - Naga</td>
						<td>PR-100001</td>
						<td>RR-100001</td>
					</tr>		  
				</tbody>
				<tfoot>
					<tr>
						<td>TOTAL:</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>4,000.00</td>
						<td></td>
						<td></td>
						<td>200,000.00</td>
						<td>220,000.00</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<div class="modal fade po-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Convert RQ</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <table class="table table-striped table-hover table-bordered">
	 
					<thead>
						<tr>
							<th>
								<input type="checkbox">
							</th>
							<th>Item Type</th>
							<th>Item No.</th>
							<th>Description</th>
							<th>Qty</th>
							<th>UOM</th>
							<th>Cost Center</th>
							<th>Document No.</th>
							<th>Document Date</th>
							<th>Date Required</th>
							<th>Priority Level</th>
							<th>Status</th>
							<th>Reference From</th>
							<th>Reference To</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<input type="checkbox">
							</td>
							<td>Machine</td>
							<td>FA100001</td>
							<td>Drummania V7</td>
							<td>2</td>
							<td>unit</td>
							<td>SM-Naga</td>
							<td>RQ-100001</td>
							<td>04/21/15</td>
							<td>04/28/15</td>
							<td>High</td>
							<td>Approved</td>
							<td>PR-100001</td>
							<td>PO-100001</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox">
							</td>
							<td>Machine</td>
							<td>FA100002</td>
							<td>Battle Gear</td>
							<td>1</td>
							<td>unit</td>
							<td>SM-Naga</td>
							<td>RQ-100001</td>
							<td>04/21/15</td>
							<td>04/21/15</td>
							<td>High</td>
							<td>Approved</td>
							<td>PR-100001</td>
							<td>PO-100001</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox">
							</td>
							<td>Redemption</td>
							<td>RD100001</td>
							<td>Hello Kitty</td>
							<td>1</td>
							<td>PC</td>
							<td>SM-Naga</td>
							<td>RQ-100001</td>
							<td>04/21/15</td>
							<td>04/28/15</td>
							<td>High</td>
							<td>Approved</td>
							<td>PR-100001</td>
							<td>PO-100001</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox">
							</td>
							<td>Redemption</td>
							<td>RD100002</td>
							<td>Winnie the Pooh</td>
							<td>10</td>
							<td>Pc</td>
							<td>SM-Manila</td>
							<td>RQ-100002</td>
							<td>04/21/15</td>
							<td>04/28/15</td>
							<td>High</td>
							<td>Open</td>
							<td>PR-100002</td>
							<td></td>
						</tr>
						<tr>
							<td>
								<input type="checkbox">
							</td>
							<td>Office Supplies</td>
							<td>OS100001</td>
							<td>Short Bond Paper</td>
							<td>20</td>
							<td>Ream</td>
							<td>Admin</td>
							<td>RQ-100003</td>
							<td>04/21/15</td>
							<td>04/28/15</td>
							<td>High</td>
							<td>Open</td>
							<td>PR-100002</td>
							<td></td>
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