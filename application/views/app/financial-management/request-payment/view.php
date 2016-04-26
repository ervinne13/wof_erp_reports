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
					  	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_DocNo']?>">
				       </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=format($data['RPH_DocDate'])?>">
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier ID:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_SupplierID']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Name:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_SupplierName']?>">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Supplier Address:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_Address']?>">
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Payment Terms:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_PaymentTerms']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Needed:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=format($data['RPH_DateRequired'])?>">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Due Date:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=format($data['RPH_DueDate'])?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=numeric($data['RPH_Amount'])?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount LCY:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=numeric($data['RPH_AmountLCY'])?>">
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Currency:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['AD_Code']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Purpose:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_Reason']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Ext Doc No.:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_ExtDocNo']?>">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Applies to Doc:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_AppToDoc']==1000?'Job Order':'Amortization Loans'?>">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Applies to Ref. No.:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_AppToRefNo']?>">
				      </div>
				    </div> 
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Applies to Amount:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_AppToAmount']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_Remarks']?>">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_Location']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_Company']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=$data['RPH_Status']?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Attachment
				      <?php if($data['RPH_Attachment']){ ?>
				      	<span class="glyphicon glyphicon-download-alt" data-toggle="tooltip" data-placement="right" title="Download as ZIP" data-id="<?=$id?>" id="d-zip"></span> 
				      <?php } ?>
				      	:
				      </label>
				      	<div class="col-xs-7 attachment-head">
					      	<?php
				      			if($data['RPH_Attachment']){
				      				$attachment = json_decode($data['RPH_Attachment']);
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

$('#d-zip').on('click',function(){
	id = $(this).data('id');
	window.location = base_url+'app/'+ _module + "/" +_class+'/download_zip/'+id;
});

var	table = $('#tbl-request-payment-details').bind('dynatable:init', function(e, dynatable) {
    	$('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
		
		$(document).on('click','.det-delete',function(e){
			e.preventDefault();
		 	_this = $(this);
		      confirm("Delete Record?", function(confirmed) {
		        if(confirmed){ 
		          $.post(base_url+'app/'+ _module + "/" +_class+'/process',{id:_this.data('id'),type:'delete-details'},function(data){
		            if(data == 1){
		            	alert('Deleted!');
		            	setTimeout(function(){
						  dynatable.process();
						}, 500);
		            }else{
		            	alert('Failed!');
		            }
		          }).error(function(){
		            alert('Error!');
		          });
		        }
		    });
		});

	  	$(document).on('click','.det-update',function(e){
	  		e.preventDefault();
		    window.location = base_url+'app/'+ _module + "/" +_class+ '/view/update/?id=' + $(this).data('id');
		});
	  	
	  	$(document).on('click','.det-add',function(e){
	  		e.preventDefault();
		    window.location = base_url+'app/'+ _module + "/" +_class+ '/view/add/?id=' + $(this).data('id');
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


	// update_functions();
 //  	function update_functions(){

	// 	if(typeof(EventSource) !== "undefined") {
	// 	    var source = new EventSource(base_url + "app/"+ _module + "/" + _class + "/data_update?" + $.param(table.params));

	// 	    source.onmessage = function(event) {
	//     		if($.param(JSON.parse(event.data)) !== $.param($result)){
	// 	    		table.process();
	// 	    	}
 //    			source.close();
 //    			setTimeout(function(){
	// 				update_functions();
 //    			},5000);
	// 	    };
	// 	} else {
	// 	   console.log("not supported");
	// 	}

 //    }
</script>