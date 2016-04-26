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
				        <input type="text" class="form-control" id="" tabindex="1" name="POL_DocNo" placeholder="Document No.">
				      </div>
					</div>				    
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Name:</label>
				      <div class="col-xs-7">
				      	<select class="form-control single-default"  placeholder="Supplier Name" id="" name="POL_SupplierName" tabindex="2">
						  	<option value="" disabled  selected>Supplier Name</option>
						</select>
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier ID:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="s_id" tabindex="3"  name="POL_SupplierID" placeholder="Supplier ID">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Supplier Address:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="s_address" tabindex="4" name="POL_SupplierAddress" placeholder="Supplier Address">
				      </div>
				    </div>
				    <div class="form-group" hidden>
				      <label class="control-label col-xs-5" for="">Payment Terms:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="terms_id" tabindex="5" value="" data-id="" name="POL_Terms" placeholder="Payment Terms">
				      </div>
				    </div>	
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">TIN:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="tin_no" tabindex="6" value="" data-id="" name="POL_TIN" placeholder="TIN">
				      </div>
				    </div>	
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="7" name="POL_Remarks" placeholder="Remarks">
				      </div>
				    </div>			
				</span>
				<span class="col-md-6">	

					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" disabled tabindex="8" value="<?=date("m/d/Y",time())?>" placeholder="Document Date">
				      </div>
				    </div>	
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <?php 
				        $location = $this->session->userdata('location');
				        $dlocation 	= $this->session->userdata('dlocation')['SP_StoreID'];
				        $dcompany 	= $this->session->userdata('dlocation')['SP_FK_CompanyID'];
				        if(count($location) > 1){ 
				        ?>
				        <select class="form-control single-default" placeholder="Location" id="lc" name="POL_Location" tabindex="9">
						  	<option value="" disabled selected>Location</option>
						  	<?php foreach ($location as $key => $value) { ?>
						  		<option value="<?=$value['SP_StoreID']?>" <?= $dlocation==$value['SP_StoreID']?'selected':''?> ><?=$value['SP_StoreName']?></option>
						  	<?php } ?>
						</select>
					  	<?php }else{ ?>
					  		<input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="9" name="POL_Location" placeholder="Location">
				        <?php } ?>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="com_id" readonly value="<?=count($location) == 1 ? $location[0]['COM_Name']: $dcompany ?>" tabindex="10" name="POL_Company" placeholder="Company">
				      </div>
				    </div>		
				    <div class="form-group" hidden>
				      <label class="control-label col-xs-5" for="">Supplier Posting Group:</label>
				      <div class="col-xs-7">
				        <select class="form-control single-default" placeholder="Supplier Posting Group" id="" name="POL_SupplierPostingGroup" tabindex="11">
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
				    <div class="form-group" hidden>
				      <label class="control-label col-xs-5" for="">WHT Posting Group:</label>
				      <div class="col-xs-7">
				        <select class="form-control single-default" placeholder="WHT Posting Group" id="" name="POL_WHTPostingGroup" tabindex="12">
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
				      <label class="control-label col-xs-5" for="">VAT Posting Group:</label>
				      <div class="col-xs-7">
				        <select class="form-control single-default" placeholder="VAT Posting Group" id="" name="POL_VATPostingGroup" tabindex="13">
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
				      <label class="control-label col-xs-5" for="">Reference No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="14" name="POL_RefNo" placeholder="Reference No.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="status" tabindex="15" value="" data-id="" name="POL_Status" placeholder="Status">
				      </div>
				    </div>		
				</span>				
			</form>
			<hr>
			<div id="sample">

			</div>
			<hr>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="16" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="17" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="18" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	var loc 			= <?= json_encode(array_column($this->session->userdata('location'),'SP_StoreID'))?>;

	var itemType 		= <?= json_encode(array_column($itemtype['data'],'IT_Id'))?>;
	
	var items 			= <?= json_encode($item['data'])?>;
	
	var itemCode 		= <?= json_encode(array_column($item['data'],'IM_Item_id'))?>;

	var itemDescription = <?= json_encode(array_column($item['data'],'IM_Sales_Desc'))?>;
	
	var uom 			= <?= json_encode($uom)?>;

	$('.attachment-head').slimScroll({
          color: '#00f',
          size: '10px',
          height: '70px',
          alwaysVisible: false
      });

	var supplier,$supplier,loc,$loc,vat,$vat,spg,$spg,wht,$wht;

	var grid  = $('#sample').gridEntry({
		add:true,
		gridConfig:{
			minSpareRows:1,
		    colHeaders:[  
		                "Item Type",
		                "Item No.",
		                "Description",
		                "Location",
		                "Qty",
		                "UOM",
		                "Unit Price",
		                "Total Amount",
		                "Comment",	            
		                ],
		    columns: [
		    		{
		                data: "POLD_ItemType",
                        type: 'dropdown',
                        allowInvalid: false,
                        strict: true,
                        trimDropdown: true,
                        source:itemType,
                        renderer: autoCompleteRenderer
		            }, {
		                data: "POLD_ItemNo",
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
		                data: "POLD_ItemDescription",
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
		                data: "POLD_Location",
						type: 'dropdown',
                        trimDropdown: true,
                        source:loc,
                        renderer: autoCompleteRenderer
		            }, {
		                data: "POLD_Qty",
		                type: 'numeric',
	        			format: '0,0',
	        			allowInvalid:false,
	        			strict: true,
	        			// renderer:emptyRenderer
		            },{
		                data: "POLD_UOM",
		                type: 'dropdown',
                        trimDropdown: true,  
                        allowInvalid: true,                      
                        // strict: true,
                        source:function(change,process){
                        	instance = $('#sample').handsontable('getInstance');
                        	uomData = [""];
							for(var i in uom){
								if(instance.getDataAtCell(this.row, 1) == uom[i].IUC_FK_Item_id){
									uomData.push(uom[i].AD_Code);
									console.log(uomData);
								}
							}
							process(uomData);
                        },
                        renderer: autoCompleteRenderer
		            }, {
	                    data: "POLD_UnitPrice",
	                    type: 'numeric',
	                    format: '0,0.00',
	                    validator: requiredValidator,
	                    allowInvalid:false,
	                    strict: true,
	                    readOnly:false,
	                    renderer:totalTextRenderer1
                }, {
		                data: "POLD_Total",
		                type: 'numeric',
	                    format: '0,0.00',
	                    validator: requiredValidator,
	                    allowInvalid:false,
	                    strict: true,
	                    readOnly:false,
		                renderer:renderTotalDisabled
		            }, {
		                data: "POLD_Comment",
		            },
		            ],
		        afterChange:function(change,source){
		        	if(change !==null || source !='loadData'){

		        		if ($.inArray(change[0][1], ['POLD_Qty', 'POLD_UnitPrice']) != -1) {

                                 qty = this.getDataAtRowProp(change[0][0], 'POLD_Qty') || 0;
                                 unitprice = this.getDataAtRowProp(change[0][0], 'POLD_UnitPrice') || 0;                             
                                 amount = qty * unitprice; 
                               	 this.setDataAtRowProp(change[0][0], 'POLD_Total', amount);       
                                    }

		        		if(change[0][1] == 'POLD_ItemNo' && source != 'cascade'){
		        			for(var i in items){
								if(this.getDataAtRowProp(change[0][0], 'POLD_ItemNo') == items[i].IM_Item_id){
									this.setDataAtRowProp(change[0][0],'POLD_ItemDescription',items[i].IM_Sales_Desc,'cascade');
									this.setDataAtRowProp(change[0][0],'POLD_UOM',items[i].AD_Code);
								}
							}
		        		};
		        		if(change[0][1] == 'POLD_ItemDescription' && source != 'cascade'){
		        			for(var i in items){
								if(this.getDataAtRowProp(change[0][0], 'POLD_ItemDescription') == items[i].IM_Sales_Desc){
									this.setDataAtRowProp(change[0][0],'POLD_ItemNo',items[i].IM_Item_id,'cascade');
									this.setDataAtRowProp(change[0][0],'POLD_UOM',items[i].AD_Code);
								}
							}
		        		};		  
		        		if(change[0][1] == 'POLD_ItemType'){
		        			ctr = 0;
	        				for(var i in items){
								if(change[0][3] == items[i].IM_FK_ItemType_id){
									ctr++;
								}
							}
							if(ctr == 0){
								this.setDataAtRowProp(change[0][0],'POLD_ItemNo',null);
								this.setDataAtRowProp(change[0][0],'POLD_ItemDescription',null);
								this.setDataAtRowProp(change[0][0],'POLD_UOM',null);
							}
								 loc = document.getElementById('lc').value;                          
                               	 this.setDataAtRowProp(change[0][0], 'POLD_Location', loc);
		        		};

		        	}
		        },
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

  	if($('select[name=POL_Location]').length > 0){
		$loc = $('select[name=POL_Location]').selectize({
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
					            	$('#save-new,#save-close').attr('disabled',true);
								},
					            error: function(){
					            	$('#com_id').val('');
					            	$('#save-new,#save-close').attr('disabled',false);
					            },
					            success: function(res) {
					            	$('#com_id').val(res.COM_Name);
					            	$('#save-new,#save-close').attr('disabled',false);
					            }
					        });
				    	}
	                });
		loc 	= $loc[0].selectize;
	}
	$select = $('.select-cli').each(function(index, obj){
                $(this).selectize({
                  sortField: 'text',
                  plugins: {
						'dropdown_header': {
							title: $(obj).attr('placeholder')
						}
					}
                });
              });

	$vat = $('select[name=POL_VATPostingGroup]').selectize({
                  sortField: 'text',
                });

	$wht = $('select[name=POL_WHTPostingGroup]').selectize({
                  sortField: 'text',
                });

	$spg = $('select[name=POL_SupplierPostingGroup]').selectize({
                  sortField: 'text',
                });

	$supplier = $('select[name=POL_SupplierName]').selectize({
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
				    	$('#s_id,#s_address,#tin_no').val('');
				    	$('#terms_id').attr('data-id','').val('');
				    	vat.clear();
						wht.clear();
						spg.clear();
					},
                   	onChange: function(value) {
                   		if (!value.length) return;
                   		 var s_id = $(this)[0].getOption(value).children()[0].childNodes[1].data;
                   		 console.log(s_id);
                   		 $.ajax({
				            url: base_url + 'app/ajaxes/get_supplier_detail_per_query',
				            type: 'GET',
				            dataType: 'json',
				            data: {
				                q: s_id
				            },
				            beforeSend: function(){
				                $('#s_id,#s_address','#tin_no').val('');
				                $('#terms_id').attr('data-id','').val('');
				                $('#save-new,#save-close').attr('disabled',true);
				                vat.clear();
								wht.clear();
								spg.clear();
							},
				            error: function() {
				            	$('#terms_id').attr('data-id','').val('');
				            	$('#save-new,#save-close').attr('disabled',false);
				            },
				            success: function(res) {
				                $('#s_id').val(res.S_Id);
				                $('#s_address').val(res.S_Address);
				                $('#terms_id').attr('data-id',res.PT_Id).val(res.PT_Desc);
				                $('#tin_no').val(res.S_TinNum);
				                $('#save-new,#save-close').attr('disabled',false);
				                vat.setValue(res.S_Vat_PostingGroup);
								wht.setValue(res.S_WHT_PostingGroup);
								spg.setValue(res.S_SupplierPostingGroup);
				            }
				        });
			    	}
                });

	supplier 	= $supplier[0].selectize;
	vat 		= $vat[0].selectize;
	wht 		= $wht[0].selectize;
	spg 		= $spg[0].selectize;
	
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

 $nseries = $('input[name=POL_DocNo]').numseries({
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

  $(document).on("click","#update-new",function(){
    var $btn = $(this);
    var $lbl = $btn.text();
    var form = $('#'+_class+"-form");
  
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){

         $btn.attr('disabled',true).text('Processing..');
	        data = form.serializeArray();

	        data.push(	{name:"type",value:'update'},
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
		        
		        data.push(	{name:"type",value:'update'},
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

					