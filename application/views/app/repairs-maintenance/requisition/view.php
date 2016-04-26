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
					<li><a href="">Print</a></li>
					<li><a href="">Track Document</a></li>
					<li><a href="" data-toggle="modal" data-target=".reo-modal">View Re-Order</a></li>
					<li><a href="">Generate Canvass Sheet</a></li>
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
				         <label class="control-label">RQ-10001</label> 
					  </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				         <label class="control-label">12/02/15</label> 
					  </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				         <label class="control-label">[Remarks.]</label> 
					  </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Status:</label>
				      <div class="col-xs-7">
						   <label class="control-label">Pending</label>
					  </div>
				    </div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Reason:</label>
					  <div class="col-xs-7">
						  <label class="control-label">[Reason]</label>
					  </div>
					</div>
					 <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Request From:</label>
					  <div class="col-xs-7">
						  <label class="control-label">[Request From]</label>
					  </div>
					</div>
					 <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Request To:</label>
					  <div class="col-xs-7">
						  <label class="control-label">[Request To]</label>
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
						<th>Machine ID</th>
						<th>Machine Description</th>
						<th>Canvass Price</th>
						<th>Requested Qty</th>
						<th>Remaining Qty</th>
						<th>UOM</th>
						<th>Reference from</th>
						<th>Reference to</th>
						<th>Cost Center</th>
						<th>Comment</th>
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
						<td>Drumania V7</td>
						<td></td>
						<td></td>
						<td>1,000.00</td>
						<td>2</td>
						<td>2</td>
						<td>Unit</td>
						<td>-</td>
						<td>PR-0001</td>
						<td></td>
						<td>[Comment]</td>
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
						<td></td>
						<td>1,000.00</td>
						<td>1</td>
						<td>1</td>
						<td>Unit</td>
						<td>-</td>
						<td>PR-0001</td>
						<td></td>
						<td>[Comment]</td>
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
						<td></td>
						<td>1,000.00</td>
						<td>1</td>
						<td>1</td>
						<td>Unit</td>
						<td>-</td>
						<td>TO100001</td>
						<td></td>
						<td>[Comment]</td>
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
						<td>Redemption</td>
						<td>RD100001</td>
						<td>Hello Kitty</td>
						<td></td>
						<td></td>
						<td>1,000.00</td>
						<td>1</td>
						<td>1</td>
						<td>PC</td>
						<td>OS-100001</td>
						<td>TO-100001</td>
						<td></td>
						<td>[Comment]</td>
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
						<td>Fixed Asset</td>
						<td>NR100001</td>
						<td>Token</td>
						<td></td>
						<td></td>
						<td></td>
						<td>10000</td>
						<td>10000</td>
						<td>PC</td>
						<td>-</td>
						<td>TO-100001</td>
						<td></td>
						<td>[Comment]</td>
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
						<td>Fixed Asset</td>
						<td>SV100001</td>
						<td>Machine Repair</td>
						<td>AS-10001</td>
						<td>ASSET</td>
						<td>10,000.00</td>
						<td>2</td>
						<td>1</td>
						<td>Unit</td>
						<td>-</td>
						<td>JO-100001</td>
						<td></td>
						<td>[Machine Tag]</td>
					</tr>
				</tbody>
			</table>
		</div>
    </div>
</div>
<div class="modal fade reo-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Re-Order</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <table class="reo-tbl table table-striped table-hover table-bordered  table-condensed">
				<thead>
					<tr>
						<th><input type='checkbox'></th>
						<th>Item No.</th>
						<th>Description</th>
						<th>Re-Order Qty</th>
						<th>Additional Qty</th>
						<th>Qty on Order</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type='checkbox'></td>
						<td>FA100001</td>
						<td>Hllo Kitty</td>
						<td>1000</td>
						<td>
							<a href="" data-toggle="modal" data-target=".r-o-modal" class="">
								<span class="glyphicon glyphicon-plus-sign"></span>
							</a>
						</td>
						<td>200</td>
					</tr>	  
				</tbody>
			</table>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default form-btn main-clr">Save</button>
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