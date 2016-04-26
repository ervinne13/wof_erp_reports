<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
          	<?php 
          		$module = isset($_SERVER['HTTP_REFERER'])? explode('/',$_SERVER['HTTP_REFERER']):'';
          		$module = end($module);
          	?>
          	<a class="cls-btn pull-right" href="<?= isset($_SERVER['HTTP_REFERER']) && $module == 'document-approval' ?$_SERVER['HTTP_REFERER']: base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
			  Close
			</a>
			<?php if($functions){ ?>	
          	<span class="dropdown pull-right">
				<a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			    	Functions
			    	<span class="caret"></span>
			  	</a>
			  	<ul class="dropdown-menu functions" role="menu" aria-labelledby="dropdownMenu1">
			  		<li>
			  			<?=$functions?>
			  		</li>
			  	</ul>
			</span>
			<?php } ?>
      	</h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
					  <div class="col-xs-7">
					  	<input type="text" class="form-control" disabled value="<?=$data['PO_DocNo']?>">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Name:</label>
				      <div class="col-xs-7">
				     	<input type="text" class="form-control" disabled value="<?=$data['PO_SupplierName']?>">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier ID:</label>
				      <div class="col-xs-7">
				     	<input type="text" class="form-control" disabled value="<?=$data['PO_SupplierID']?>">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Address:</label>
				      <div class="col-xs-7">
				     	<input type="text" class="form-control" disabled value="<?=$data['PO_SupplierAddress']?>">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Shipment No.:</label>
				      <div class="col-xs-7">
				     	<input type="text" class="form-control" disabled value="<?=$data['PO_ShipmentNo']?>">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Ship To:</label>
				      <div class="col-xs-7">
				     	<input type="text" class="form-control" disabled value="<?=$data['PO_ShipTo']?>">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Ship to Address:</label>
				      <div class="col-xs-7">
				     	<input type="text" class="form-control" disabled value="<?=$data['PO_ShipToAddress']?>">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				     	<input type="text" class="form-control" disabled value="<?=$data['PO_Remarks']?>">
				      </div> 
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" disabled value="<?=format($data['PO_DocDate'])?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Payment Terms:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled value="<?=$data['PO_Terms']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Due Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled value="<?=format($data['PO_DueDate'])?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Expected Delivery Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled value="<?=format($data['PO_ExpectedDeliveryDate'])?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Validity Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled value="<?=format($data['PO_ValidityDate'])?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled value="<?=$data['PO_Status']?>">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled value="<?=$data['PO_Company']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Posting Group:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled value="<?=$data['PO_SupplierPostingGroup']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">VAT Posting Group:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled value="<?=$data['PO_VATPostingGroup']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">WHT Posting Group:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled value="<?=$data['PO_WHTPostingGroup']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Buyer:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled value="<?=$data['PO_Buyer']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Currency:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled value="<?=$data['AD_Code']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Invoice No.:</label>
				      <div class="col-xs-7">
				      		<?php if($is_sender && $data['PO_Status'] == 'Approved'){?>
				      			<label class="control-label" for="">
				      				<a href="#" id="PO_SupplierInvoice" data-type="text" data-pk="<?=$data['id']?>" data-url="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/process" data-title="Supplier Invoice No."><?=$data['PO_SupplierInvoice']?></a>
				     			</label>
				     		<?php }else{ ?>
				        		<input type="text" class="form-control" disabled value="<?=$data['PO_SupplierInvoice']?>">
				     		<?php } ?>
				      </div>
				    </div>

				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date PO Sent:</label>
				      <div class="col-xs-7">
				      	<?php if($is_sender && $data['PO_Status'] == 'Approved'){?>
				      			<label class="control-label" for="">
				      				<a href="#" id="PO_DateSent" data-type="text" data-pk="<?=$data['id']?>" data-url="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/process" data-title="Date PO Sent"><?=format($data['PO_DateSent'])?></a>
				     			</label>
			     		<?php }else{ ?>
			        		<input type="text" class="form-control" disabled value="<?=format($data['PO_DateSent'])?>">
			     		<?php } ?>
				      </div>
				    </div>
				</span>
			</form>
			<div class="details">Details</div>
			<?=generate_table($table)?>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/bootstrap-editable.css">
<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-editable.min.js"></script>
<script type="text/javascript">

$('#PO_DateSent').editable({
	params:{type:'customUpdate'},
	tpl:'<input type="text" class="date">'
}).on('shown',function(){
	$('.date').datepicker({
		dateFormat:'mm/dd/yy'
	}).mask("99/99/9999");
});

$('#PO_SupplierInvoice').editable({
	params:{type:'customUpdate'},
});

_module = 'purchasing';

var	table = $('#tbl-purchase-order-details').bind('dynatable:init', function(e, dynatable) {
    	$('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
	

		$('.clear').on('click',function(){
			dynatable.sorts.clear();
			dynatable.queries.remove("search");
			$('[type=search]').val('');
			$(".dynatable-arrow").remove();
			dynatable.process();
		});

	   $(this).wrap('<div class="table-container"></div>')
	    var $demo1 = $(this);
			$demo1.floatThead({
				scrollContainer: function($table){
					return $table.closest('.table-container');
				}
		});

	// var url = window.location.href;

	// console.log(url);

	}).bind('dynatable:afterUpdate', function(e, dynatable) {
		$('[data-toggle="tooltip"]').tooltip();	
	}).bind('dynatable:ajax:success', function(e, dynatable) {
		$(this).floatThead('reflow');
	}).dynatable({
		dataset: {
			ajax: true,
		    ajaxUrl: base_url + "app/purchasing/purchase-order/details-data/?id="+"<?=$this->input->get('id')?>",
		    ajaxOnLoad: true,
		    records: []
		},
		features: {
	   		pushState: false,
		},
		inputs: {
		    processingText: '<img  id="loader" src="'+base_url+'css/assets/data_loader.gif" />'
		  }
	}).data('dynatable');

</script>