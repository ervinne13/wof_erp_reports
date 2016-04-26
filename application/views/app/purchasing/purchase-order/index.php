<?php 
	$location = $this->session->userdata('location');
?>
<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title">
		<?=$title?>
		<?=$function?>
		</h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<?=generate_table($table)?>
		</div>
		<legend>Pending Request</legend>
		<div id="data-container" class="container-fluid">
			<?=generate_table($tableRQ)?>
		</div>
	</div>
</div>
<div class="modal fade" id="po-header-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Convert</h4>
          </div>
          <div class="modal-body">
          	<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-6">Doc. No.:</label>
					  <div class="col-xs-6">
					  	<input type="text" class="form-control" name="PO_DocNo" readonly value="">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Supplier Name:</label>
				      <div class="col-xs-6">
				      	<select class="form-control single-default w-x-2"  placeholder="Supplier Name" id="" name="PO_SupplierName" tabindex="3">
						  	<option value="" disabled selected>Supplier Name</option>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Supplier ID:</label>
				      <div class="col-xs-6">
				     	<input type="text" class="form-control" name="PO_SupplierID" readonly value="">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Supplier Address:</label>
				      <div class="col-xs-6">
				     	<input type="text" class="form-control" name="PO_SupplierAddress" readonly value="">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Supplier Shipment No.:</label>
				      <div class="col-xs-6">
				     	<input type="text" class="form-control" name="PO_ShipmentNo"  value="">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Ship To:</label>
				      <div class="col-xs-6">
				      	<select class="form-control single-default" placeholder="Ship To" id="" name="PO_ShipTo">
						  	<option value="" disabled selected>Ship To</option>
						  	<?php 
						  		if(!empty($loc)){
						  			foreach ($loc['data'] as $key => $value) {
						  	?>
						  		<option value="<?=trim($value['SP_StoreID'])?>"  ><?=$value['SP_StoreName']?></option>
						  	<?php }} ?>
						</select>
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Ship to Address:</label>
				      <div class="col-xs-6">
				     	<input type="text" class="form-control" readonly name="PO_ShipToAddress" value="">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Remarks:</label>
				      <div class="col-xs-6">
				     	<input type="text" class="form-control" name="PO_Remarks" value="">
				      </div> 
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Doc. Date:</label>
				      <div class="col-xs-6">
				      	<input type="text" class="form-control" value="<?=date("m/d/Y",time())?>" readonly name="PO_DocDate" value="">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Payment Terms:</label>
				      <div class="col-xs-6">
				      	<select class="form-control single-default" placeholder="Terms" id="" name="PO_Terms" tabindex="6">
						  	<option value="" disabled selected>Terms</option>
						  	<?php 
						  		if(!empty($terms['data'])){
						  			foreach ($terms['data'] as $key => $value) {
						  	?>
						  		<option value="<?=$value['PT_Id']?>" ><?=$value['PT_Desc']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Due Date:</label>
				      <div class="col-xs-6">
				        <input type="text" readonly class="form-control" name="PO_DueDate" value="">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Expected Delivery Date:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" name="PO_ExpectedDeliveryDate" value="">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Validity Date:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" name="PO_ValidityDate" value="">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Status:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" readonly name="PO_Status" value="Open">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
						      	<label class="control-label col-xs-6" for="">Company:</label>
						      	<div class="col-xs-6">
							      	<select class="form-control single-default select-cli" id="" name="PO_Company" tabindex="7">
									  	<option value="" disabled selected>Company</option>
									  	<?php 
									  		if(!empty($com)){
									  			foreach ($com['data'] as $key => $value) {
									  	?>
									  		<option value="<?=$value['COM_Id']?>" <?=$location[0]['COM_Name'] == $value['COM_Id'] ? 'selected' : '' ?> ><?=$value['COM_Name']?></option>
									  	<?php }} ?>
									</select>
								</div>
						    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Supplier Posting Group:</label>
				      <div class="col-xs-6">
				        <select class="form-control single-default" placeholder="Supplier Posting Group" id="" name="PO_SupplierPostingGroup" tabindex="21">
						  	<option value="" disabled selected>Supplier Posting Group</option>
						  	<?php 
						  		if(!empty($SUP)){
						  			foreach ($SUP['data'] as $key => $value) {
						  	?>
						  		<option value="<?=trim($value['SPG_Code'])?>"  ><?=$value['SPG_Code']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">VAT Posting Group:</label>
				      <div class="col-xs-6">
				        <select class="form-control single-default" placeholder="VAT Posting Group" id="" name="PO_VATPostingGroup" tabindex="23">
						  	<option value="" disabled selected>VAT Posting Group</option>
						  	<?php 
						  		if(!empty($VAT)){
						  			foreach ($VAT['data'] as $key => $value) {
						  	?>
						  		<option value="<?=trim($value['VBPG_Code'])?>" ><?=$value['VBPG_Code']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">WHT Posting Group:</label>
				      <div class="col-xs-6">
				        <select class="form-control single-default" placeholder="WHT Posting Group" id="" name="PO_WHTPostingGroup" tabindex="22">
						  	<option value="" disabled selected>WHT Posting Group</option>
						  	<?php 
						  		if(!empty($WHT)){
						  			foreach ($WHT['data'] as $key => $value) {
						  	?>
						  		<option value="<?=trim($value['WBPG_Code'])?>"  ><?=$value['WBPG_Code']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Buyer:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" readonly value="<?=$this->session->userdata('U_User_id')?>" radonly name="PO_Buyer" value="">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Currency:</label>
				      <div class="col-xs-6">
				        <select class="form-control single-default" placeholder="Currency" id="" name="PO_Currency" tabindex="6">
						  	<option value="" disabled selected>Currency</option>
						  	<?php 
						  		if(!empty($currency)){
						  			foreach ($currency['data'] as $key => $value) {
						  	?>
						  		<option value="<?=$value['AD_Id']?>" ><?=$value['AD_Desc']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				</span>
			</form>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default form-btn main-clr" id="convert-rq" >Convert</button>
      </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var supplier,$supplier,terms,$terms,currency,$currency;
var supplierjson = <?=json_encode($supplier['data'])?>;
var locjson = <?=json_encode($loc['data'])?>;
var termsjson = <?=json_encode($terms['data'])?>;
var $sup,sup,$wht,wht,$vat,vat,nseries = null,$loc,loc;;

var url = window.location.href;
var split = url.split("/");

var moduleHeader = split[5];

// console.log(moduleHeader);

$terms = $('select[name=PO_Terms]').selectize({
		              sortField: 'text',
		              onItemRemove:function(value){
		              	 $('input[name=PO_DueDate]').val('');
		              },
		              onChange: function(value) {
		               		if (!value.length) return;
		               		for (var i in termsjson) {
			                        if (termsjson[i]["PT_Id"] == value) {
			                        	dueDate = new Date($('input[name=PO_DocDate]').val());
			                        	dueDate.setDate(dueDate.getDate() + parseInt(termsjson[i]['PT_Days']));
			                        	dueDate = ((dueDate.getMonth()+1) + '/' + dueDate.getDate() + '/' + dueDate.getFullYear());
			                            $('input[name=PO_DueDate]').val(dueDate);
			                        }
			                }
				    	}		
		            });

$loc = $('select[name=PO_ShipTo]').selectize({
		              sortField: 'text',
		              onItemRemove:function(value){
		              	$('input[name=PO_ShipToAddress]').val('');
		              },
		              onChange: function(value) {
		               		if (!value.length) return;
		               	
		               		for (var i in locjson) {
			                        if (locjson[i]["SP_StoreID"] == value) {
			                           $('input[name=PO_ShipToAddress]').val(locjson[i]['SP_Address']);
			                        }
			                    }
				    	}			
		            });

$terms = $('select[name=PO_Terms]').selectize({
		              sortField: 'text',
		            });

$sup = $('select[name=PO_SupplierPostingGroup]').selectize({
	              sortField: 'text',
	            });
$wht = $('select[name=PO_WHTPostingGroup]').selectize({
	              sortField: 'text',
	            });
$vat = $('select[name=PO_VATPostingGroup]').selectize({
	              sortField: 'text',
	            });

$currency = $('select[name=PO_Currency]').selectize({
	              sortField: 'text',
	            });

$('.select-cli').selectize({
	              sortField: 'text',
	            });

$supplier = $('select[name=PO_SupplierName]').selectize({
                sortField: 'text',
                valueField: 'S_Name',
			    labelField: 'S_Name',
			    searchField: ['S_Id','S_Name'],
			    highlight:false,
			    options: supplierjson,
			    create: false,
			    render: {
			        option: function(item, escape) {
						return '<div class="sel-dropdown">' +
					                '<span class="id"><label>Supplier ID:</label>' + escape(item.S_Id) + '</span>' +
					                '<span class="name"><label>Supplier Name:</label>' + escape(item.S_Name) + '</span>' +
			            		'</div>';
			        }
			    },
			    onItemRemove:function(value){
			    	$('input[name=PO_SupplierID],input[name=PO_SupplierAddress]').val('');
				},
               	onChange: function(value) {
               		if (!value.length) return;

               		var s_id = $(this)[0].getOption(value).children()[0].childNodes[1].data;
               	
               		for (var i in supplierjson) {
	                        if (supplierjson[i]["S_Id"] == s_id) {
	                            $('input[name=PO_SupplierID]').val(s_id);
	                            $('input[name=PO_SupplierAddress]').val(supplierjson[i]["S_Address"]);
	                            $('input[name=CV_PaymentTerms]').val(supplierjson[i]["S_FK_PayTerms"]);
	                            terms.setValue(supplierjson[i]["S_FK_PayTerms"]);
								currency.setValue(supplierjson[i]['S_FK_Attribute_Currency_id']);
								sup.setValue(supplierjson[i]['S_SupplierPostingGroup']);
								wht.setValue(supplierjson[i]['S_WHT_PostingGroup']);
								vat.setValue(supplierjson[i]['S_Vat_PostingGroup']);
	                        }
	                    }
		    	}			    	
            });

	supplier 			= $supplier[0].selectize;
	currency 			= $currency[0].selectize;
	terms 				= $terms[0].selectize;
	sup 				= $sup[0].selectize;
	wht 				= $wht[0].selectize;
	vat 				= $vat[0].selectize;

$('.rq-convert').click(function(){
	if($('.doc:checked').length > 0){
		$('#po-header-modal').modal();
	}else{
		alert('Select Items to Convert!');
	}
});

$('input[name=PO_DueDate],input[name=PO_ExpectedDeliveryDate],input[name=PO_ValidityDate]').datepicker({
		dateFormat:'mm/dd/yy'
	}).mask("99/99/9999");

$('#po-header-modal').on('shown.bs.modal', function (e) {
	if(!nseries){
   nseries = $('input[name=PO_DocNo]').numseries({
                  target:base_url+'app/'+_module+'/'+_class+'/getseries',
                  method:'add',
                  beforeSend:function(){
                    //$('#save-new,#save-close').attr('disabled',true);
                  },
                  afterSend:function(e,data){
                  	if(data.rows == 0){
                  		alert('No series available!');
              			$('#po-header-modal').modal('hide');
                  	}else{
	                    $("#convert-rq").attr({'disabled':false,'id':'update-new'});
	                    // $('#save-close').attr({'disabled':false,'id':'update'});
	                    $('#update-new').attr('data-id',data.uniqid);
	                    // $('#update').attr('data-id',data.uniqid);
					}
                  },
                  sendFailed:function(){
                    // $('#save-new').attr({'disabled':false});
                    // $('#save-close').attr({'disabled':false});
                    alert('Series Generation Failed!');
                    $('#po-header-modal').modal('hide');
                  },
                  modal:{
                        target:base_url+'app/'+_module+'/'+_class+'/seriesmodal',
                        selecttarget:base_url+'app/'+_module+'/'+_class+'/process',
                        afterSend:function(e,data){
                          $("#convert-rq").attr({'disabled':false,'id':'update-new'});
                          // $('#save-close').attr({'disabled':false,'id':'update'});
                          $('#update-new').attr('data-id',data.uniqid);
                          // $('#update').attr('data-id',data.uniqid);
                          },
                        }
              });
	}else{
		nseries.trigger('proccess');
		supplier.clear();
		currency.clear();
		terms.clear();
		sup.clear();
		wht.clear();
		vat.clear();
	}
});

$('#po-header-modal').on('hide.bs.modal', function (e) {
	$('#'+_class+"-form")[0].reset();
});

$(document).on("click",'#update-new',function(){
     var $btn = $(this);
      var $lbl = $btn.text();
      var form = $('#'+_class+"-form");
      
      confirm("Save Entry?", function(confirmed) {
          if(confirmed){ 
          
	         	$btn.attr('disabled',true).text('Processing..');
		        data = form.serializeArray();
		        
		        data.push(	{name:"type",value:'update'},
			                {name:"uniqid",value:$btn.data('id')});

		        file = new FormData();

		        $('.attachment').each(function(){
		    		if($(this)[0].files.length > 0){
		    			file.append('file[]', $(this)[0].files[0]);
		        	}
				});

		        $(form).find('input[type=checkbox]').each(function() {
		           data.push({ name: this.name, value: this.checked ? 1 : 0 });
		        });

				$.each(data,function(key,input){
			        file.append(input.name,input.value);
			    });

				rqSpec = [];
				$('.doc').each(function(){
					if($(this).prop('checked') == true){
						rqSpec.push({'id':$(this).attr('id')});
					}
				});

			    file.append('rqSpec',JSON.stringify(rqSpec));

			// console.log(file);
			// return false;
			$.ajax({
		        url: base_url+'app/'+ _module + "/" +_class+'/process',
		        type: 'POST',
		        data: file,
		        dataType:'json',
		        processData: false,
	       		contentType: false,
		        success: function(data) {
		            if(data.result == 0){
			            error_message(data.errors);
			        }else{
			        	alert('Saved!');
              			window.location = base_url+'app/' +_module+ '/'+_class;
			        }
			        $btn.attr('disabled',false).text($lbl);
				},
				error:function(){
					alert('Error!');
	          		$btn.attr('disabled',false).text($lbl);
				}
		    }); 
          }
      });
  });


var	apv = $('#tbl-purchasing').bind('dynatable:init', function(e, dynatable) {

    	$('#dynatable-search-tbl-purchasing').prepend('Date Filter: <input type="search" data-dynatable-query="date-from" name="date-from" id="date-from"/><input type="search" data-dynatable-query="date-to" name="date-to" id="date-to"/> ')
    	.append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    	
    	$('.activate').on('click',function(){
			id = [];
			$('table .doc:checkbox:checked').each(function(){
				id.push($(this).attr('id'));
			});
			data = [];
			data.push({name:'id',value:JSON.stringify(id)},{name:'type',value:'activate'});
			confirm("Activate Account?", function(confirmed) {
		   		if(confirmed){
					$.post(base_url + "app/"+ _module + "/" + _class + "/process",data,function(){
						dynatable.process();
					});
				}
			});
		});

    	$("#date-from,#date-to").datepicker({ dateFormat: 'mm-dd-yy'}).mask("99-99-9999");

    	$('#date-from').on('change', function() {
		  var value = $(this).val();
		  if (value === "") {
		    dynatable.queries.remove("date-from");
		  } else {
		    dynatable.queries.add("date-from",value);
		  }
		  dynatable.process();
		});

		$('#date-to').on('change', function() {
		  var value = $(this).val();
		  if (value === "") {
		    dynatable.queries.remove("date-to");
		  } else {
		    dynatable.queries.add("date-to",value);
		  }
		  dynatable.process();
		});

		$('.deactivate').on('click',function(){
			id = [];
			$('table .doc:checkbox:checked').each(function(){
				id.push($(this).attr('id'));
			});
			data = [];
			data.push({name:'id',value:JSON.stringify(id)},{name:'type',value:'deactivate'});
			confirm("Deactivate Account?", function(confirmed) {
	   			if(confirmed){
					$.post(base_url + "app/"+ _module + "/" + _class + "/process",data,function(){
						dynatable.process();
					});
				}
			});
		});
	  	
		$('#dynatable-search-tbl-purchasing .clear').on('click',function(){
			dynatable.sorts.clear();
			dynatable.queries.remove("search");
			dynatable.queries.remove("date-from");
			dynatable.queries.remove("date-to");
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
		    ajaxUrl: base_url + "app/" + moduleHeader + "/purchase-order/data",
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

var	rq = $('#tbl-requisition-pending').bind('dynatable:init', function(e, dynatable) {
    	 $('#dynatable-search-tbl-requisition-pending').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    		
		$('#dynatable-search-tbl-requisition-pending .clear').on('click',function(){
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
		    ajaxUrl: base_url + "app/purchasing/purchase-order/pendingRQ",
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