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
					  	<label class="control-label"><?=$data['APV_DocNo']?></label>
				       </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				      	<label class="control-label"><?=date_format(date_create($data['APV_DocDate']), 'm/d/Y')?></label>
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier ID:</label>
				      <div class="col-xs-7">
				      	<label class="control-label"><?=$data['APV_SupplierID']?></label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Name:</label>
				      <div class="col-xs-7">
				      	<label class="control-label"><?=$data['APV_SupplierName']?></label>
				      </div> 
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Supplier Address:</label>
				      <div class="col-xs-7">
				      	<label class="control-label"><?=$data['APV_SupplierAddress']?></label>
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Payment Terms:</label>
				      <div class="col-xs-7">
				      	<label class="control-label"><?=$data['APV_PaymentTerms']?></label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Required:</label>
				      <div class="col-xs-7">
				      	<label class="control-label"><?=date_format(date_create($data['APV_DateRequired']), 'm/d/Y')?></label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount:</label>
				      <div class="col-xs-7">
				      	<label class="control-label"><?=numeric($data['APV_Amount'])?></label>
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount LCY:</label>
				      <div class="col-xs-7">
				      	<label class="control-label"><?=numeric($data['APV_AmountLCY'])?></label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Discount:</label>
				      <div class="col-xs-7">
				      	<label class="control-label"><?=numeric($data['APV_PaymentDiscount'])?></label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				      	<label class="control-label"><?=$data['APV_Remarks']?></label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				      	<label class="control-label" id="status"><?=$data['APV_Status']?></label>
				      </div>
				    </div>
				</span>
			</form>
			<div class="details">Details</div>
			<?=generate_table($table)?>
		</div>
	</div>
</div>
<div class="modal fade" id="apv-item-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">APV Details</h4>
          </div>
          <div class="modal-body">
            <table id="apv-item-tbl" class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th data-dynatable-column="checkbox" data-dynatable-no-sort='true'><input type="checkbox"></th>
                 <!--  <th data-dynatable-column="module">Module</th>
                  <th data-dynatable-column="doc_num">Document No.</th>
                  <th data-dynatable-column="doc_date">Document Date.</th> -->
                  <th data-dynatable-column="item_type">Item Type</th>
                  <th data-dynatable-column="item_no">Item No</th>
                  <th data-dynatable-column="description">Description</th>
                  <th data-dynatable-column="qty">Quantity</th>
                  <th data-dynatable-column="uom">UOM</th>
                  <th data-dynatable-column="unit_price">Unit Price</th>
                  <th data-dynatable-column="amount">Amount</th>
                  <th data-dynatable-column="currency">Currency</th>
                  <th data-dynatable-column="comment">Comment</th>
                  <th data-dynatable-column="location">Location</th>
                  <th data-dynatable-column="cpc">Cost Center</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default form-btn main-clr" data-id="<?=$id?>" id="convert-items">Convert</button>
      </div>
        </div>
    </div>
</div>
<script type="text/javascript">

 var $apv_item,table;

 $apv_item =  $('#apv-item-tbl').bind('dynatable:init', function(e, dynatable) {
   					$(this).wrap('<div class="table-container"></div>');
   					$(this).floatThead({
			          scrollContainer: function($table){
			            return $table.closest('.table-container');
			          }
			      	});
				}).dynatable({
				      	inputs: {
				          	processingText: '<img  id="loader" src="'+base_url+'css/assets/data_loader.gif" />'
				      	}
				}).data('dynatable');

  $('#apv-item-modal').on('hide.bs.modal', function () { 
    	$apv_item.settings.dataset.originalRecords = '';
    	$apv_item.process();
  });

  $('#convert-items').on('click',function(){
  	$btn = $(this);
  	var data = [];
  	$('#apv-item-modal table tbody tr').each(function(){
  		_this = $(this).find('td:eq(0) input[type=checkbox]');
  		if(_this.prop('checked') == true){
  			data.push({line:_this.data('line'),doc:_this.data('doc'),table:_this.data('table')});
  		}
  	});

  	$.ajax({
	        url:  base_url + "app/"+_module+"/"+_class+"/process/",
	        type: 'post',
	        data: {type:'convert',id:$btn.data('id'),data:JSON.stringify(data)},
	        dataType:'json',
	        success: function(data) {
	        	if(data==1){
	        		alert('Saved');
	        		$('#apv-item-modal').modal('toggle');
	        		table.process();
	        	}else{
	        		alert('Failed');
	        	}
			},
			error:function(){
				alert('Error!');
			}
	    });

  });

  $('#apv-item-modal').on('shown.bs.modal', function (event) {
      $.ajax({
	        url:  base_url + "app/"+_module+"/"+_class+"/items/",
	        type: 'get',
	        data: {id:$(event.relatedTarget).data('id')},
	        dataType:'json',
	        success: function(data) {
	           $apv_item.records.updateFromJson({records: data});
			   $apv_item.records.init();
			   $apv_item.process();
			   $('#apv-item-tbl').floatThead('reflow');
			},
			error:function(){
				alert('Error!');
			}
	    });
 	});

table = $('#tbl-account-payable-voucher-details').bind('dynatable:init', function(e, dynatable) {
    	$('#dynatable-search-tbl-account-payable-voucher-details').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");

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

</script>