<?php 
	$location = $this->session->userdata('location');
?>
<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-6">Doc. No.:</label>
					  <div class="col-xs-6">
					  	<input type="text" class="form-control" name="PO_DocNo" readonly value="<?=$data['PO_DocNo']?>">
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
				     	<input type="text" class="form-control" name="PO_SupplierID" readonly value="<?=$data['PO_SupplierID']?>">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Supplier Address:</label>
				      <div class="col-xs-6">
				     	<input type="text" class="form-control" name="PO_SupplierAddress" readonly value="<?=$data['PO_SupplierAddress']?>">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Supplier Shipment No.:</label>
				      <div class="col-xs-6">
				     	<input type="text" class="form-control" name="PO_ShipmentNo"  value="<?=$data['PO_ShipmentNo']?>">
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
						  		<option value="<?=trim($value['SP_StoreID'])?>"  <?=$data['PO_ShipTo'] == $value['SP_StoreID'] ? 'selected' : '' ?> ><?=$value['SP_StoreName']?></option>
						  	<?php }} ?>
						</select>
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Ship to Address:</label>
				      <div class="col-xs-6">
				     	<input type="text" class="form-control" readonly name="PO_ShipToAddress" value="<?=$data['PO_ShipToAddress']?>">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Remarks:</label>
				      <div class="col-xs-6">
				     	<input type="text" class="form-control" name="PO_Remarks" value="<?=$data['PO_Remarks']?>">
				      </div> 
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Doc. Date:</label>
				      <div class="col-xs-6">
				      	<input type="text" class="form-control" value="<?=$data['PO_DocDate']?format($data['PO_DocDate']):format(date("m/d/Y",time()))?>" readonly name="PO_DocDate" value="">
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
						  		<option value="<?=$value['PT_Id']?>" <?=$value['PT_Id'] == $data['PO_Terms'] ? 'selected' : ''?> ><?=$value['PT_Desc']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Due Date:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" readonly name="PO_DueDate" value="<?=format($data['PO_DueDate'])?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Expected Delivery Date:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" name="PO_ExpectedDeliveryDate" value="<?=format($data['PO_ExpectedDeliveryDate'])?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Validity Date:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" name="PO_ValidityDate" value="<?=format($data['PO_ValidityDate'])?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Status:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" readonly name="PO_Status" value="<?=$data['PO_Status']?$data['PO_Status']:'Open'?>">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
						      	<label class="control-label col-xs-6" for="">Company:</label>

						      	<div class="col-xs-6">
							      	<select class="form-control single-default" id="" name="PO_Company" tabindex="7">
									  	<option value="" disabled selected>Company</option>
									  	<?php 
									  		if(!empty($com)){
									  			foreach ($com['data'] as $key => $value) {
									  	?>	
									  		<option value="<?=$value['COM_Id']?>"  <?=trim($location[0]['COM_Name']) == trim($value['COM_Id']) ? 'selected' : '' ?> ><?=$value['COM_Name']?></option>
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
						  		<option value="<?=trim($value['SPG_Code'])?>" <?=$value['SPG_Code']==$data['PO_SupplierPostingGroup'] ? 'selected' : '' ?> ><?=$value['SPG_Code']?></option>
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
						  		<option value="<?=trim($value['VBPG_Code'])?>" <?=$value['VBPG_Code']==$data['PO_VATPostingGroup'] ? 'selected' : '' ?> ><?=$value['VBPG_Code']?></option>
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
						  		<option value="<?=trim($value['WBPG_Code'])?>" <?=$value['WBPG_Code']==$data['PO_WHTPostingGroup'] ? 'selected' : '' ?> ><?=$value['WBPG_Code']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Buyer:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" readonly value="<?=$data['PO_Buyer']?$data['PO_Buyer']:$this->session->userdata('U_User_id')?>" radonly name="PO_Buyer" >
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
						  		<option value="<?=$value['AD_Id']?>" <?=$value['AD_Id']==$data['PO_Currency'] ? 'selected' : '' ?> ><?=$value['AD_Desc']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="details">Details</div>
			<?=generate_table($table)?>
			<hr>
			<div class="btn-cont">
				<a type="button" data-id="<?= $data['id']; ?>" tabindex="18" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="19" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
	 			  Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="rq-details-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">APV Details</h4>
          </div>
          <div class="modal-body">
            <table id="rq-details-tbl" class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th data-dynatable-column="checkbox" data-dynatable-no-sort='true'><input type="checkbox"></th>
                  <th data-dynatable-column="RQD_RQ_DocNo">Doc. No.</th>
                  <th data-dynatable-column="RQD_ItemType">Item Type</th>
                  <th data-dynatable-column="RQD_ItemNo">Item No.</th>
                  <th data-dynatable-column="RQD_ItemDescription">Item Description</th>
                  <th data-dynatable-column="RQD_Location">Location</th>
                  <th data-dynatable-column="RQD_Qty">Qty</th>
                  <th data-dynatable-column="RQD_UOM">UOM</th>
                  <th data-dynatable-column="RQD_UnitCost">Unit Cost</th>
                  <th data-dynatable-column="RQD_Amount">Amount</th>
                  <th data-dynatable-column="RQD_Comment">Comment</th>
                  <th data-dynatable-column="RQD_RefDocNo">Ref. Doc. No.</th>
                  <th data-dynatable-column="RQD_RefFrom">Ref. From</th>
                  <th data-dynatable-column="RQD_RefTo">Ref. To</th>
                  <th data-dynatable-column="RQD_Status">Status</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default form-btn main-clr" id="convert-details">Convert</button>
      </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/bootstrap-editable.css">
<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-editable.min.js"></script>
<script type="text/javascript">
	
var supplier,$supplier,terms,$terms,currency,$currency;
var supplierjson 	= <?=json_encode($supplier['data'])?>;
var locjson 		= <?=json_encode($loc['data'])?>;
var termsjson 		= <?=json_encode($terms['data'])?>;
var vatjson 		= <?=json_encode($VATDropDown['data'])?>;
var whtjson 		= <?=json_encode($WHTDropDown['data'])?>;
var $sup,sup,$wht,wht,$vat,vat,nseries = null,$company,company,$loc,loc;


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

$company = $('select[name=PO_Company]').selectize({
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
			    	terms.clear();
					currency.clear();
					sup.clear();
					wht.clear();
					vat.clear();
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
	loc 				= $loc[0].selectize;
	company 			= $company[0].selectize;

	supplier.setValue('<?=$data["PO_SupplierName"]?>','silent');

	//company.setValue('<?=$data["PO_Company"]?>','silent');

	$('input[name=PO_DueDate],input[name=PO_ExpectedDeliveryDate],input[name=PO_ValidityDate]').datepicker({
		dateFormat:'mm/dd/yy'
	}).mask("99/99/9999");
  	
  	$.fn.editable.defaults.mode = 'popup';

  	details = $('#tbl-purchase-order-details').bind('dynatable:afterUpdate', function(e, data) {

  					dcmal = $('<input>',{type:'text',class:'dc-mal'});
  					dcmal.autoNumeric('init',{aSep: ',',              
							aDec: '.',
							aForm: false}); 

  					$('.POD_UnitPrice').each(function(){
  						_this = $(this);
  						_this.editable({
						    title: 'Enter Qty',
						}).on('save', function(e, params) {
								tr 	  = $(this).closest('tr');
							    unitPrice = parseFloat(params.newValue) || 0;
							    qty    	  = parseFloat($(tr).find('td:eq(5)').text()) || 0;
							    $(tr).find('td:eq(8)').text((unitPrice * qty ).toFixed(2));
							    $(tr).find('td:eq(11)').text((unitPrice * 0.10 ).toFixed(2));
						});
					});

					$('.POD_Comment').editable({
					    title: 'Enter Comment'
					});

  					$('.POD_VAT').each(function(){
  						_this = $(this);
	  					_this.editable({
						 	value:_this.text()==''? vat.getValue() :_this.text(),     
					        source: vatjson
				   	 	});
				    });

				    $('.POD_WHT').each(function(){
  						_this = $(this);
	  					_this.editable({
						 	value:_this.text(),     
					        source: whtjson
				   	 	});
				    });
  					
	}).dynatable({
	  dataset: {
	    records: <?=json_encode($details);?>
	  }
	}).data('dynatable');

  	
  	rqPending = $('#rq-details-tbl').bind('dynatable:init', function(e, dynatable) {
   					$(this).wrap('<div class="table-container"></div>');
   					$(this).floatThead({
			          scrollContainer: function($table){
			            return $table.closest('.table-container');
			          }
			      	});
	}).dynatable({
	  dataset: {
	    records: <?=json_encode($pendingRQ);?>
	  }
	}).data('dynatable');

	$('#rq-details-modal').on('shown.bs.modal', function (event) {
     
		$('#rq-details-tbl').floatThead('reflow');
			
 	});

 	$('#convert-details').on('click',function(){

     	var data = [];
     	var rqSpec = [];
 		confirm("Convert?", function(confirmed) {
          if(confirmed){ 
			
			$('.doc').each(function(){
				if($(this).prop('checked') == true){
					rqSpec.push($(this).attr('id'));
				}
			});

			data.push({name:"type",value:'get-details'},
	                  {name:"rqSpec",value:JSON.stringify(rqSpec)});

			$.ajax({
		        url: base_url+'app/'+ _module + "/" +_class+'/process',
		        type: 'POST',
		        data: data,
		        dataType:'json',
		        success: function(data) {
		        	old  = details.records.getFromTable();
		        	$.each(data,function(index,value){
		        		old.push(value);
		        	});

		        	details.records.updateFromJson({records: old});
				    details.records.init();
				    details.process();
				    $('.doc').each(function(){
						if($(this).prop('checked') == true){
							$(this).closest('tr').remove();
						}
					});
					$('#rq-details-modal').modal('hide');
				},
				error:function(){
					alert('Error!');
				}
		    }); 
          }
      });
	});

   // details.records.updateFromJson({records: details.records.getFromTable()});
   // details.records.init();
   // details.process();
	$(document).on('click','.po-details-delete',function(e){
		e.preventDefault();
		_this = $(this);
		confirm("Delete?", function(confirmed) {
			data.push({name:"type",value:'delete-details'},
	                  {name:"id",value:_this.attr('data-id')});

			$.ajax({
		        url: base_url+'app/'+ _module + "/" +_class+'/process',
		        type: 'POST',
		        data: data,
		        dataType:'json',
		        success: function(data) {
		        	old  = rqPending.records.getFromTable();

		        	$.each(data,function(index,value){
		        		old.push(value);
		        	});

		        	rqPending.records.updateFromJson({records: old});
				    rqPending.records.init();
				    rqPending.process();
		        	_this.closest('tr').remove();
				},
				error:function(){
					alert('Error!');
				}
		    }); 
		});
	});


  $("#update").on("click",function(){
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

				$('.po-details-delete').each(function(){
					_this = $(this);
					tr = _this.closest('tr');
					rqSpec.push({'id':_this.attr('data-id'),
								 'POD_UnitPrice':tr.find('.POD_UnitPrice').editable('getValue',true),
								 'POD_Comment':tr.find('.POD_Comment').editable('getValue',true),
								 'POD_VAT':tr.find('.POD_VAT').editable('getValue',true),
								 'POD_WHT':tr.find('.POD_WHT').editable('getValue',true)});
				});

			    file.append('rqSpec',JSON.stringify(rqSpec));

			// console.log(file);
			// return false;
			$.ajax({
		        url: base_url+'app/purchasing/purchase-order/process',
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
  
  //check_if_changed($('#' + _class + '-form'),$('#update'));

</script>			

					