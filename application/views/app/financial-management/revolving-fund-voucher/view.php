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
				      <label class="control-label col-xs-6" for="">Source of Fund:</label>
				      <div class="col-xs-6">
				      	<input type="text" class="form-control" id="" readonly value="<?=static_lookup('source_of_fund')[$data['RFV_SourceOfFund']]?>" >
				      </div>
				    </div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-6">Doc. No.:</label>
					  <div class="col-xs-6">
					  	<input type="text" class="form-control" id="" readonly value="<?=$data['RFV_DocNo']?>" >
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Doc. Date:</label>
				      <div class="col-xs-6">
				      	<input type="text" class="form-control" id="" readonly value="<?=format($data['RFV_DocDate'])?>">	
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Requestor:</label>
				      <div class="col-xs-6">
				      	<input type="text" class="form-control" id="" readonly value="<?=$data['RFV_Requestor']?>">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Transaction Description:</label>
				      <div class="col-xs-6">
				      	<input type="text" class="form-control" id="" readonly value="<?=$data['RFV_TransDescription']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Amount Requested:</label>
				      <div class="col-xs-6">
				      	<input type="text" class="form-control" id="" readonly value="<?=numeric($data['RFV_AmountRequested'])?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Request Status:</label>
				      <div class="col-xs-6">
				      	<input type="text" class="form-control" id="" readonly value="<?=$data['RFV_RequestStatus']?>">
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Amount Released:</label>
				      <div class="col-xs-6">
			      		<?php if($is_approver && $data['RFV_RequestStatus'] == 'Pending'){?>
			      			<label class="control-label" for="">
			      				<a href="#" id="RFV_AmountReleased" data-type="text" data-pk="<?=$data['id']?>" data-url="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/process" data-title="Amont Released"><?=numeric($data['RFV_AmountReleased'])?></a>
							</label>
						<?php }else{ ?>
							<input type="text" class="form-control" id="" readonly value="<?=numeric($data['RFV_AmountReleased'])?>">
			     		<?php } ?>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Date Released:</label>
				      <div class="col-xs-6">
				      		<?php if($is_approver && $data['RFV_RequestStatus'] == 'Pending'){?>
				      			<label class="control-label" for="">
				      				<a href="#" id="RFV_DateReleased" data-type="text" data-pk="<?=$data['id']?>" data-url="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/process" data-title="Date Released"><?=format($data['RFV_DateReleased'])?></a>
				      			</label>
				     		<?php }else{ ?>
				     			<input type="text" class="form-control" id="" readonly value="<?=format($data['RFV_DateReleased'])?>">
				     		<?php } ?>
				       </div>
				    </div>
				</span>
				<span class="col-md-4">
					<div class="form-group">
				      <label class="control-label col-xs-6" for=""></label>
				      <div class="col-xs-6">
				      	<label class="control-label" for="">
				      		&nbsp;
		      			</label>
				       </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-6" for="">Liquidation Date:</label>
				      <div class="col-xs-6">
				      	<input type="text" class="form-control" id="" readonly value="<?=format($data['RFV_LiquidationDate'])?>">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Liquidation Status:</label>
				      <div class="col-xs-6">
				      	<input type="text" class="form-control" id="" readonly value="<?=$data['RFV_LiquidationStatus']?>">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Liquidation Received:</label>
				      <div class="col-xs-6">
				      		<?php if($is_approver && $data['RFV_LiquidationStatus'] == 'Pending'){?>
				      			<label class="control-label" for="">
				      				<a href="#" id="RFV_LiquidationReceived" data-type="text" data-pk="<?=$data['id']?>" data-url="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/process" data-title="Date Released"><?=format($data['RFV_LiquidationReceived'])?></a>
				     			</label>
				     		<?php }else{ ?>
				     			<input type="text" class="form-control" id="" readonly value="<?=format($data['RFV_LiquidationReceived'])?>">
				     		<?php } ?>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for=""></label>
				      <div class="col-xs-6">
				      	<label class="control-label" for="">
				      		&nbsp;
		      			</label>
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for=""></label>
				      <div class="col-xs-6">
				      	<label class="control-label" for="">
				      		&nbsp;
		      			</label>
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for=""></label>
				      <div class="col-xs-6">
				      	<label class="control-label" for="">
				      		&nbsp;
		      			</label>
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Actual Amount Used:</label>
				      <div class="col-xs-6">
				      	<input type="text" class="form-control" id="" readonly value="<?=numeric($data['RFV_ActualAmountUsed'])?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Excess:</label>
				      <div class="col-xs-6">
						<input type="text" class="form-control" id="" readonly value="<?=numeric($data['RFV_Excess'])?>">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Location:</label>
				      <div class="col-xs-6">
				      	<input type="text" class="form-control" id="" readonly value="<?=$data['RFV_Location']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Company:</label>
				      <div class="col-xs-6">
						<input type="text" class="form-control" id="" readonly value="<?=$data['RFV_Company']?>">
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



	$('#RFV_AmountReleased').editable({
		params:{type:'customUpdate'},
		tpl:'<input type="text" class="dc-mal">'
	}).on('shown',function(){
		$('.dc-mal').autoNumeric('init',{aSep: ',',              
									 aDec: '.',
									 aForm: false}); 
	});

	$('#RFV_DateReleased').editable({
		params:{type:'customUpdate'},
		tpl:'<input type="text" class="date">'
	}).on('shown',function(){
		$('.date').datepicker({
			dateFormat:'mm/dd/yy'
		}).mask("99/99/9999");
	});

	$('#RFV_LiquidationReceived').editable({
		params:{type:'customUpdate'},
		tpl:'<input type="text" class="date">'
	}).on('shown',function(){
		$('.date').datepicker({
			dateFormat:'mm/dd/yy'
		}).mask("99/99/9999");
	});

var	table = $('#tbl-revolving-fund-details').bind('dynatable:init', function(e, dynatable) {
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

	}).bind('dynatable:afterUpdate', function(e, dynatable) {
		$('[data-toggle="tooltip"]').tooltip();	
	}).bind('dynatable:ajax:success', function(e, dynatable) {
		$(this).floatThead('reflow');
	}).dynatable({
		dataset: {
			ajax: true,
		    ajaxUrl: base_url + "app/"+ _module + "/" + _class + "/details-data/?id="+"<?=$this->input->get('id')?>",
		    ajaxOnLoad: true,
		    records: [],
		    perPageDefault: 15,
    		perPageOptions: [15,50,100],
		},
		features: {
	   		pushState: false,
		},
		inputs: {
		    processingText: '<img  id="loader" src="'+base_url+'css/assets/data_loader.gif" />'
		  }
	}).data('dynatable');

</script>