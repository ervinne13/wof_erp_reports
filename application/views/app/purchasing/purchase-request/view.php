<?php 
	$location 	= $this->session->userdata('location');
    $dlocation 	= $this->session->userdata('dlocation')['SP_StoreID'];
    $dcompany 	= $this->session->userdata('dlocation')['SP_FK_CompanyID'];
?>
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
			  	<ul class="dropdown-menu rq-functions" role="menu" aria-labelledby="dropdownMenu1">
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
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="1" value="<?=$data['RQ_DocNo']?>" name="RQ_DocNo" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Purpose:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="1" value="<?=$data['RQ_Purpose']?>" name="RQ_DocNo" placeholder="Purpose">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly tabindex="4" value="<?=$data['RQ_Remarks']?>" name="RQ_Remarks" value=""  placeholder="Remarks">
				       </div> 
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="2" value="<?=format($data['RQ_DocDate'])?>" name="RQ_DocDate" value="<?=date("m/d/Y",time())?>" placeholder="Document Date">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Needed:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="2" value="<?=format($data['RQ_DateNeeded'])?>" name="RQ_DateNeeded" placeholder="Date Needed">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="1" value="<?=$data['RQ_Company']?>" name="RQ_DocNo" placeholder="Document No.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="1" value="<?=$data['RQ_Location']?>" name="RQ_DocNo" placeholder="Document No.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Attachment
				      <?php if($data['RQ_Attachment']){ ?>
				      	<span class="glyphicon glyphicon-download-alt" data-toggle="tooltip" data-placement="right" title="Download as ZIP" data-id="<?=$id?>" id="d-zip"></span> 
				      <?php } ?>
				      	:
				      </label>
				      	<div class="col-xs-7 attachment-head">
					      	<?php
				      			if($data['RQ_Attachment']){
				      				$attachment = json_decode($data['RQ_Attachment']);
				      				foreach ($attachment as $key => $value) {
				      		?>
	      					<div class="row container-fluid">
	      						<a href="<?=base_url().'uploads/'.$value?>" download class="uploaded-att control-label">
	      							<label class="control-label" for=""><?=$value?></label>
	      						</a>
	      					</div>
				      		<?php }} ?>
				    	</div>
				    </div>
				</span>
			</form>
			<div class="details">Details</div>
			<?=generate_table($table)?>
		</div>
	</div>
</div>
<script type="text/javascript">

$('.attachment-head').slimScroll({
          color: '#00f',
          size: '10px',
          height: '70px',
          alwaysVisible: false
      });


var	table = $('#tbl-requisition-details').bind('dynatable:init', function(e, dynatable) {

		select = $('<select/>',{id:'status-filter'});
		select.append('<option value="" >-select-</option><option value="open">Open</option><option value="skipped">Skipped</option><option value="approved">Approved</option><option value="pending">Pending</option><option value="cancelled">Cancelled</option><option value="reopen">Re Opened</option>')
		$('#dynatable-search-'+'tbl-requisition-details').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    	$('#dynatable-per-page-tbl-requisition-details').after(select);

    	$('#status-filter').on('change', function() {
		  var value = $(this).val();
		  if (value === "") {
		    dynatable.queries.remove("statusFilter");
		  } else {
		    dynatable.queries.add("statusFilter",value);
		  }
		  dynatable.process();
		});

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
		console.log(e);
		console.log(dynatable);
	}).dynatable({
		dataset: {
			ajax: true,
		    ajaxUrl: base_url + "app/"+ _module + "/" + _class + "/details-data/?id="+"<?=$this->input->get('id')?>",
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