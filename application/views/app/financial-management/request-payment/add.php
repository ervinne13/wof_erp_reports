<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="RPH_DocNo" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled id="" tabindex="2" value="<?=date("m/d/Y",time())?>" placeholder="Document Date">
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Name:</label>
				      <div class="col-xs-7">
				      	<select class="form-control single-default"  placeholder="Supplier Name" id="" name="RPH_SupplierName" tabindex="3">
						  	<option value="" disabled selected>Supplier Name</option>
						</select>
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier ID:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="s_id" tabindex="4"  name="RPH_SupplierID" placeholder="Supplier ID">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Supplier Address:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="s_address" tabindex="5" name="RPH_Address" placeholder="Supplier Address">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Currency:</label>
				      <div class="col-xs-7">
				        <select class="form-control single-default" placeholder="Currency" id="" name="RPH_Currency" tabindex="6">
						  	<option value="" disabled selected>Currency</option>
						  	<?php 
						  		if(!empty($currency)){
						  			foreach ($currency['data'] as $key => $value) {
						  	?>
						  		<option value="<?=$value['AD_Id']?>"><?=$value['AD_Desc']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Payment Terms:</label>
				      <div class="col-xs-7">
				      	<select class="form-control single-default" placeholder="Terms" id="" name="RPH_PaymentTerms" tabindex="7">
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
				      <label class="control-label col-xs-5" for="">Date Needed:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="8" name="RPH_DateRequired" placeholder="Date Needed">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Due Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="due_date" tabindex="9" name="RPH_DueDate" placeholder="Due Date">
				      </div>
				    </div>
				</span>
				<span class="col-md-6">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Purpose:</label>
				      <div class="col-xs-7">
				        <select class="form-control single-default select-cli" placeholder="Purpose" id="" name="RPH_Reason" tabindex="10">
						  	<option value="" disabled selected>Purpose</option>
						  	<?php 
						  		if(isset($reason['data'])){
						  		foreach ($reason['data'] as $key => $value) { 
						  	?>
						  		<option value="<?=$value['R_Id']?>"><?=$value['R_Description']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Ext Doc No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="11" name="RPH_ExtDocNo" placeholder="Ext Doc No.">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Applies to Doc.:</label>
				      <div class="col-xs-7">
				        <select class="form-control single-default" placeholder="Applies to Doc." id="" name="RPH_AppToDoc" tabindex="12">
						  	<option value="" disabled selected>Applies to Doc.</option>
						  	<?php 
						  		foreach (static_lookup('applies_to_rq') as $key => $value) { 
						  	?>
						  		<option value="<?=$key?>"><?=$value?></option>
						  	<?php } ?>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Applies to Doc. No.:</label>
				      <div class="col-xs-7">
				      	<select class="form-control single-default" placeholder="Applies to Doc No." id="" name="RPH_AppToRefNo" tabindex="13">
						  	<option value="" disabled selected>Applies to Doc No.</option>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Applies to Amount:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="14" name="RPH_AppToAmount" placeholder="Applies to Amount">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <?php 
				        $location 	= $this->session->userdata('location');
				        $dlocation 	= $this->session->userdata('dlocation')['SP_StoreID'];
				        $dcompany 	= $this->session->userdata('dlocation')['SP_FK_CompanyID'];
				        if(count($location) > 1){ 
				        ?>
				        <select class="form-control single-default" placeholder="Location" id="" name="RPH_Location" tabindex="15">
						  	<option value="" disabled selected>Location</option>
						  	<?php foreach ($location as $key => $value) { ?>
						  		<option value="<?=$value['SP_StoreID']?>" <?= $dlocation==$value['SP_StoreID']?'selected':''?> ><?=$value['SP_StoreName']?></option>
						  	<?php } ?>
						</select>
					  	<?php }else{ ?>
					  		<input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="16" name="RPH_Location" placeholder="Location">
				        <?php } ?>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="com_id" readonly value="<?=count($location) == 1 ? $location[0]['COM_Name']: $dcompany ?>" tabindex="17" name="RPH_Company" placeholder="Company">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="18" name="RPH_Remarks" placeholder="Remarks">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Received:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="19" name="RPH_DateReceived" placeholder="Date Received">
				      </div>
				    </div>			
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Attachment:</label>
				      	<div class="col-xs-7 attachment-head row">
					      	<span class="attach">
					      		<div class="col-xs-10">
									<input type="file" class="attachment">
					      		</div>
					      		<span class="col-xs-1 control-label glyphicon glyphicon-plus" id="file-add"></span>
					      	</span>
				    	</div>
				    </div>
				</span>
				<legend>Details</legend>
			</form>
			 <hr>
     			 <div id="sample">
      			 </div>
     		 <hr>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="20" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="21" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="22" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	var itemType 	= <?= json_encode(array_column($itemtype['data'],'IT_Id'))?>;
	
	var items 		= <?= json_encode($item['data'])?>;
	
	var itemCode 	= <?= json_encode(array_column($item['data'],'IM_Item_id'))?>;

	var itemDescription = <?= json_encode(array_column($item['data'],'IM_Sales_Desc'))?>;

	
	$('.attachment-head').slimScroll({
          color: '#00f',
          size: '10px',
          height: '70px',
          alwaysVisible: false
      });
	
	var supplier,$supplier,loc,$loc,terms,$terms,currency,$currency,appliesToDoc,$appliesToDoc,appliesToDocNum,$appliesToDocNum,appliesToData;
	var grid  = $('#sample').gridEntry({
    add:true,
    gridConfig:{
      minSpareRows:1,
        colHeaders:[  
                    "Item Type",
                    "Item Code",
                    "Item Description",
                    "Quantity",
                    "Unit Price",
                    "Amount",
                    "Comment",
                    ],
        columns: [
                {
                    data: "RPD_ItemType",                   
                    type: 'dropdown',
                    allowInvalid: false,
                    strict: true,
                    trimDropdown: true,
                    source:itemType,
                    renderer: autoCompleteRenderer         
                 
                }, {
                    data: "RPD_ItemNo",
                   	type: 'dropdown',
                    trimDropdown: true,
                    strict: true,
                    source:function(change,process){
                       	instance = $('#sample').handsontable('getInstance');
                        itemCodeData = [];
							for(var i in items){
								if(instance.getDataAtCell(this.row, 0) == items[i].IM_FK_ItemType_id){
									itemCodeData.push(items[i].IM_Item_id);
								}
							}
							process(itemCodeData);
                        },
                        renderer: autoCompleteRenderer
		            }, {
                    data: "RPD_ItemDescription",                
                    type: 'dropdown',
                    trimDropdown: true,                        
                    strict: true,
                    source:function(change,process){
                        instance = $('#sample').handsontable('getInstance');
                        itemDescData = [];
							for(var i in items){
								if(instance.getDataAtCell(this.row, 0) == items[i].IM_FK_ItemType_id){
									itemDescData.push(items[i].IM_Sales_Desc);
								}
							}
							process(itemDescData);
                        },
                        renderer: autoCompleteRenderer
                }, {
                    data: "RPD_Qty",
                  	type: 'numeric',
                    format: '0,0',
                    validator: requiredValidator,
                    allowInvalid:false,
                    strict: true,
                    readOnly:false,
                }, {
                    data: "RPD_UnitPrice",
                    type: 'numeric',
                    format: '0,0.00',
                    validator: requiredValidator,
                    allowInvalid:false,
                    strict: true,
                    readOnly:false,
                    // renderer:totalTextRenderer
                },{
                    data: "RPD_Amount",
                    type: 'numeric',
                    format: '0,0.00',
                    validator: requiredValidator,
                    allowInvalid:false,
                    strict: true,
                    readOnly:true,
                    renderer:renderTotal                  
                },{
                    data: "RPD_Comment",
                    renderer:emptyRenderer
                    // renderer:totalTextRenderer
                },
                ],    
                afterChange: function (change, source) {
                        if (change !== null || source != 'loadData') {
                            if ($.inArray(change[0][1], ['RPD_Qty', 'RPD_UnitPrice']) != -1) {

                                 qty = this.getDataAtRowProp(change[0][0], 'RPD_Qty') || 0;
                                 unitprice = this.getDataAtRowProp(change[0][0], 'RPD_UnitPrice') || 0;
                                 amount = qty * unitprice; 
                               	 this.setDataAtRowProp(change[0][0], 'RPD_Amount', amount);
        
                                    }

                            if(change[0][1] == 'RPD_ItemNo' && source != 'cascade'){
		        			for(var i in items){
								if(this.getDataAtRowProp(change[0][0],'RPD_ItemNo') == items[i].IM_Item_id){
									this.setDataAtRowProp(change[0][0],'RPD_ItemDescription',items[i].IM_Sales_Desc,'cascade');
								}
							}
		        		};
		        		if(change[0][1] == 'RPD_ItemDescription' && source != 'cascade'){
		        			for(var i in items){
								if(this.getDataAtRowProp(change[0][0],'RPD_ItemDescription') == items[i].IM_Sales_Desc){
									this.setDataAtRowProp(change[0][0],'RPD_ItemNo',items[i].IM_Item_id,'cascade');
								}
							}
		        		};

		        		if(change[0][1] == 'RPD_ItemType'){
		        			ctr = 0;
	        				for(var i in items){
								if(change[0][3] == items[i].IM_FK_ItemType_id){
									ctr++;
								}
							}
							if(ctr == 0){
								this.setDataAtRowProp(change[0][0],'RPD_ItemNo',null);
								this.setDataAtRowProp(change[0][0],'RPD_ItemDescription',null);						
							}						
		        		};}
                    }
        }
    });

	$('#file-add').on('click',function(){
		var file = $('.attach:first').clone();
		file.find('.attachment').val('')
		file.find('#file-add').removeClass('glyphicon-plus').addClass('glyphicon-remove').attr('id','file-del');
		$('.attachment-head').append(file);
	});

	$(document).on('click','#file-del',function(){
		$(this).closest('.attach').fadeOut('slow',function(){
			$(this).remove();
		});
	});

	$('input[name=RPH_DateRequired],input[name=RPH_DueDate],input[name=RPH_DateReceived]').datepicker({
		dateFormat:'mm/dd/yy'
	}).mask("99/99/9999");
  	
	$select = $('.select-cli').each(function(){
	            $(this).selectize({
	              sortField: 'text',
	            });
	          });

	$terms = $('select[name=RPH_PaymentTerms]').selectize({
		              sortField: 'text',
		            });

	$appliesToDoc = $('select[name=RPH_AppToDoc]').selectize({
		              sortField: 'text',
		              onItemRemove:function(value){
		              	appliesToDocNum.disable();
		              	$('input[name=RPH_AppToAmount]').val('');
		              },
		              onChange:function(value){
		              	if (!value.length) return;
		              	appliesToDocNum.disable();
		              	appliesToDocNum.load(function(callback) {
				            $.ajax({
				                url: base_url+'app/ajaxes/get_applies_to_rq/'+ value ,
				                success: function(results) {
				                	appliesToData = JSON.parse(results);
				                    appliesToDocNum.enable();
				                    callback(appliesToData);
				                },
				                error: function() {
				                    callback();
				                }
				            });
				        });
		              }
		            });

	$appliesToDocNum = $('select[name=RPH_AppToRefNo]').selectize({
					  valueField: 'docno',
				      labelField: 'docno',
		              sortField: 'text',
		              onChange:function(value){
		              	 for (var i in appliesToData) {
	                        if (appliesToData[i]["docno"] == value) {
	                        	$('input[name=RPH_AppToAmount]').val(appliesToData[i]["amount"]);
	                        }
	                    }
		              }
		            });

	$currency = $('select[name=RPH_Currency]').selectize({
	              sortField: 'text',
	            });

	$supplier = $('select[name=RPH_SupplierName]').selectize({
                    sortField: 'text',
                    valueField: 'S_Name',
				    labelField: 'S_Name',
				    searchField: ['S_Id','S_Name'],
				    highlight:false,
				    options: [],
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
				    	$('#s_id,#s_address').val('');
				    	terms.disable();
		                terms.clear();
				    	currency.disable();
				    	currency.clear();
					},
                   	onChange: function(value) {
                   		if (!value.length) return;
                   		 var s_id = $(this)[0].getOption(value).children()[0].childNodes[1].data;
                   		 
                   		 $.ajax({
				            url: base_url + 'app/ajaxes/get_supplier_detail_per_query',
				            type: 'GET',
				            dataType: 'json',
				            data: {
				                q: s_id
				            },
				            beforeSend: function(){
				                $('#s_id,#s_address').val('');
				                $('#terms_id').attr('data-id','').val('');
				                currency.disable();
				                currency.clear();
				                terms.disable();
				                terms.clear();
				                $('#save-new,#save-close').attr('disabled',true);
							},
				            error: function() {
				            	$('#terms_id').attr('data-id','').val('');
				            	currency.disable();
				            	currency.clear();
				            	terms.disable();
				                terms.clear();
				            	$('#save-new,#save-close').attr('disabled',false);
				            },
				            success: function(res) {
				                $('#s_id').val(res.S_Id);
				                $('#s_address').val(res.S_Address);
				                terms.enable();
				                terms.setValue(res.PT_Id);
				                $('#save-new,#save-close').attr('disabled',false);
				                currency.enable();
				                currency.setValue(res.S_FK_Attribute_Currency_id);
				            }
				        });
			    	}
                });

	supplier 			= $supplier[0].selectize;
	currency 			= $currency[0].selectize;
	appliesToDoc 		= $appliesToDoc[0].selectize;
	appliesToDocNum 	= $appliesToDocNum[0].selectize;
	terms 				= $terms[0].selectize;
	appliesToDocNum.disable();
	
	if($('select[name=RPH_Location]').length > 0){
		$loc = $('select[name=RPH_Location]').selectize({
	                    sortField: 'text',
	                    create: false,
					    onItemRemove:function(value){
					    	$('#com_id').val('');
						},
	                   	onChange: function(value) {
	                   		if (!value.length) return;
	                   		 $.ajax({
					            url: base_url + 'app/ajaxes/get_spec_company_per_location_array',
					            type: 'GET',
					            dataType: 'json',
					            data: {
					                q: value
					            },
					            beforeSend: function(){
					            	$('#com_id').val('');
					            	$('#cpc_id').val('');
					            	$('#save-new,#save-close').attr('disabled',true);
								},
					            error: function(){
					            	$('#com_id').val('');
					            	$('#cpc_id').val('');
					            	$('#save-new,#save-close').attr('disabled',false);
					            },
					            success: function(res) {
					            	$('#com_id').val(res.COM_Name);
					            	$('#cpc_id').val(res.CPC_Desc);
					            	$('#save-new,#save-close').attr('disabled',false);
					            }
					        });
				    	}
	                });
		loc 	= $loc[0].selectize;
	}
	$.ajax({
        url: base_url + 'app/ajaxes/get_supplier_init',
        type: 'GET',
        dataType: 'json',
        beforeSend:function(){
        	$('#save-new,#save-close').attr('disabled',true);
        },
        success: function(res) {
            supplier.addOption(res);
            $('#save-new,#save-close').attr('disabled',false);
        },
        error:function() {
        	$('#save-new,#save-close').attr('disabled',false);
        }
    });
 
 $nseries = $('input[name=RPH_DocNo]').numseries({
                  target:base_url+'app/'+_module+'/'+_class+'/getseries',
                  method:'add',
                  beforeSend:function(){
                    $('#save-new,#save-close').attr('disabled',true);
                  },
                  afterSend:function(e,data){
                  	if(data.rows == 0){
                  		alert('No series available!');
                  		setTimeout(function(){
                  			window.location = base_url + 'app/' + _module + '/' + _class;
                  		},1000);
                  	}else{
	                    $('#save-new').attr({'disabled':false,'id':'update-new'});
	                    $('#save-close').attr({'disabled':false,'id':'update'});
	                    $('#update-new').attr('data-id',data.uniqid);
	                    $('#update').attr('data-id',data.uniqid);
					}
                  },
                  sendFailed:function(){
                    $('#save-new').attr({'disabled':false});
                    $('#save-close').attr({'disabled':false});
                    alert('Series Generation Failed!');
                  },
                  modal:{
                        target:base_url+'app/'+_module+'/'+_class+'/seriesmodal',
                        selecttarget:base_url+'app/'+_module+'/'+_class+'/process',
                        afterSend:function(e,data){
                          $('#save-new').attr({'disabled':false,'id':'update-new'});
                          $('#save-close').attr({'disabled':false,'id':'update'});
                          $('#update-new').attr('data-id',data.uniqid);
                          $('#update').attr('data-id',data.uniqid);
                          },
                        }
              });

 $("#save-new").on("click",function(){
    var $btn = $(this);
    var $lbl = $btn.text();
    var form = $('#'+_class+"-form");

    confirm("Save Entry?", function(confirmed) {
      if(confirmed){ 
        
        $btn.attr('disabled',true).text('Processing..');
        data = form.serializeArray();
        data.push({name:"type",value:'add'});

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
		            location.reload();
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

  $("#save-close").on("click",function(){
    var $btn = $(this);
    var $lbl = $btn.text();
    var form = $('#'+_class+"-form");

    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
	        $btn.attr('disabled',true).text('Processing..');
	        data = form.serializeArray();
	        data.push({name:"type",value:'add'});

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

 $(document).on("click","#update-new",function(){
    var $btn = $(this);
    var $lbl = $btn.text();
    var form = $('#'+_class+"-form");
  
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){

         $btn.attr('disabled',true).text('Processing..');
          data = form.serializeArray();

          data.push({name:"type",value:'update'},
                    {name:"uniqid",value:$btn.data('id')},
                    {name:"details",value:JSON.stringify(grid.getSourceData())});

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
                location.reload();
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

  $(document).on("click","#update",function(){
      var $btn = $(this);
      var $lbl = $btn.text();
      var form = $('#'+_class+"-form");
      
      confirm("Save Entry?", function(confirmed) {
          if(confirmed){ 
          
            $btn.attr('disabled',true).text('Processing..');
            data = form.serializeArray();
            
            data.push({name:"type",value:'update'},
                      {name:"uniqid",value:$btn.data('id')},
                      {name:"details",value:JSON.stringify(grid.getSourceData())} );

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
</script>			

					