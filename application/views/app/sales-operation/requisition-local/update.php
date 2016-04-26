<?php 
	$location 	= $this->session->userdata('location');
    $dlocation 	= $this->session->userdata('dlocation')['SP_StoreID'];
    $dcompany 	= $this->session->userdata('dlocation')['SP_FK_CompanyID'];
?>
<div class="panel">
  <div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
          	<!-- 	<?php if ($functions): ?>
                <span class="dropdown pull-right">
                    <a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        Functions
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu functions" role="menu" aria-labelledby="dropdownMenu1">
                        <li>
                            <?= $functions ?>
                        </li>
                    </ul>
                </span>
            <?php endif ?> -->
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="<?=$data['RQL_DocNo']?>" readonly tabindex="1" name="RQL_DocNo" placeholder="Document No.">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <?php 
				        if(count($location) > 1){ 
				        ?>
				        <select class="form-control single-default" placeholder="Location" id="" name="RQL_Location" tabindex="14">
						  	<option value="" disabled selected>Location</option>
						  	<?php foreach ($location as $key => $value) { ?>
						  		<option value="<?=$value['SP_StoreID']?>" <?= $dlocation==$value['SP_StoreID']?'selected':''?> ><?=$value['SP_StoreName']?></option>
						  	<?php } ?>
						</select>
					  	<?php }else{ ?>
					  		<input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="1" name="RQL_Location" placeholder="Location">
				        <?php } ?>
				      </div>
				    </div>
				    <div class="form-group hidden">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="com_id" readonly value="<?=count($location) == 1 ? $location[0]['COM_Name']: $dcompany ?>" tabindex="15" name="RQL_Company" placeholder="Company">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Request To:</label>
				      <div class="col-xs-7">
				        <select class="form-control single-default" placeholder="Location" id="" name="RQL_RequestTo" tabindex="14">
						  	<option value="" disabled selected>Request To:</option>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" tabindex="4" value="<?=$data['RQL_Remarks']?>" name="RQL_Remarks" value=""  placeholder="Remarks">
				       </div> 
				    </div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="2" name="RQL_DocDate" value="<?=date("m/d/Y",time())?>" placeholder="Document Date">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Requestor:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" value="<?=$data['RQL_Requestor']?$data['RQL_Requestor']:$this->session->userdata('U_User_id')?>" tabindex="2" name="RQL_Requestor" placeholder="Requestor">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  readonly id="" value="<?=$data['RQL_Status']?$data['RQL_Status']:'Open'?>" tabindex="2"  value="Open" name="RQL_Status" placeholder="Status">
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div id="sample">
			</div>
			<hr>
			<div class="btn-cont">
				<a type="button" data-id="<?= $data['id']; ?>" tabindex="19" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="20" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
	 			  Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	var loc 		= <?= json_encode(array_column($this->session->userdata('location'),'SP_StoreID'))?>;

	var locJSON		= <?= json_encode($locat['data']); ?>;
	
	var locStrucJSON		= <?= json_encode($locStructure['data']); ?>;

	var itemType 	= <?= json_encode(array_column($itemtype['data'],'IT_Id'))?>;
	
	var items 		= <?= json_encode($item['data'])?>;
	
	var itemCode 	= <?= json_encode(array_column($item['data'],'IM_Item_id'))?>;

	var itemDescription = <?= json_encode(array_column($item['data'],'IM_Sales_Desc'))?>;
	
	var uom 			= <?= json_encode($uom)?>;

	var loc,$loc,reqTo,$reqTo;

	var grid  = $('#sample').gridEntry({
		add:true,
		tableData: <?=json_encode($details['data'])?>,
		gridConfig:{
			minSpareRows:1,
		    colHeaders:[  
		                "Item Type",
		                "Item No.",
		                "Description",
		                "Location",
		                "Qty",
		                "UOM",
		                "Unit Cost",
		                "Total Cost",
		                "Comment",
		                "Status",
		                "Ref. Doc. No.",
		                "Ref. From",
		                "Ref. To",		 
		                ],
		    columns: [
		    		{
		                data: "RQLD_ItemType",
                        type: 'dropdown',
                        allowInvalid: false,
                        strict: true,
                        trimDropdown: true,
                        source:itemType,
                        renderer: autoCompleteRenderer
		            }, {
		                data: "RQLD_ItemNo",
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
		                data: "RQLD_ItemDescription",
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
		                data: "RQLD_Location",
		                type: 'dropdown',
                        trimDropdown: true,
                        source:loc,
                        renderer: autoCompleteRenderer
		            }, {
		                data: "RQLD_Qty",
		                type: 'numeric',
	        			format: '0,0',
	        			allowInvalid:false,
	        			strict: true,
	        			// renderer:emptyRenderer
		            }, {
		                data: "RQLD_UOM",
		                type: 'dropdown',
                        trimDropdown: true,           
                        source:function(change,process){
                        	instance = $('#sample').handsontable('getInstance');
                        	uomData = [""];
							for(var i in uom){
								if(instance.getDataAtCell(this.row, 1) == uom[i].IUC_FK_Item_id){
									uomData.push(uom[i].AD_Code);
								}
							}
							process(uomData);
                        },
                        renderer: autoCompleteRenderer
		            }, {
		                data: "RQLD_UnitCost", 
		                type: 'numeric',
	                    format: '0,0.00',
		                readOnly:true,
		                renderer:totalTextRenderer1
		            }, {
		                data: "RQLD_Amount",
		                readOnly:true,
		                type: 'numeric',
	                    format: '0,0.00',
		                renderer:renderTotalDisabled
		            }, {
		                data: "RQLD_Comment",
		            },{
		            	data: "RQLD_Status",
		                readOnly:true
		            }, {
		                data: "RQLD_RefDocNo",
		                readOnly:true
		            }, {
		                data: "RQLD_RefFrom",
		                readOnly:true
		            }, {
		                data: "RQLD_RefTo",
		                readOnly:true
		            },		           
		            ],
		        afterChange:function(change,source){
		        	if(change !==null || source !='loadData'){
		        		if(change[0][1] == 'RQLD_ItemNo' && source != 'cascade'){
		        			for(var i in items){
								if(this.getDataAtRowProp(change[0][0],'RQLD_ItemNo') == items[i].IM_Item_id){
									this.setDataAtRowProp(change[0][0],'RQLD_ItemDescription',items[i].IM_Sales_Desc,'cascade');
									this.setDataAtRowProp(change[0][0],'RQLD_UnitCost',items[i].IM_UnitCost||0);
									this.setDataAtRowProp(change[0][0],'RQLD_UOM',items[i].AD_Code);
								}
							}
		        		};
		        		if(change[0][1] == 'RQLD_ItemDescription' && source != 'cascade'){
		        			for(var i in items){
								if(this.getDataAtRowProp(change[0][0],'RQLD_ItemDescription') == items[i].IM_Sales_Desc){
									this.setDataAtRowProp(change[0][0],'RQLD_ItemNo',items[i].IM_Item_id,'cascade');
									this.setDataAtRowProp(change[0][0],'RQLD_UnitCost',items[i].IM_UnitCost||0);
									this.setDataAtRowProp(change[0][0],'RQLD_UOM',items[i].AD_Code);
								}
							}
		        		};

		        		if(change[0][1] == 'RQLD_Qty'){
		        			qty 	 = this.getDataAtRowProp(change[0][0],'RQLD_Qty')||0;
		        			unitCost = this.getDataAtRowProp(change[0][0],'RQLD_UnitCost')||0;
		        			this.setDataAtRowProp(change[0][0],'RQLD_Amount',parseFloat(qty).toFixed(2) * parseFloat(unitCost).toFixed(2));
		        		};

		        		if(change[0][1] == 'RQLD_ItemType'){
		        			ctr = 0;
	        				for(var i in items){
								if(change[0][3] == items[i].IM_FK_ItemType_id){
									ctr++;
								}
							}
							if(ctr == 0){
								this.setDataAtRowProp(change[0][0],'RQLD_ItemNo',null);
								this.setDataAtRowProp(change[0][0],'RQLD_ItemDescription',null);
								this.setDataAtRowProp(change[0][0],'RQLD_UnitCost',items[i].IM_UnitCost||0);
								this.setDataAtRowProp(change[0][0],'RQLD_UOM',null);
							}
							this.setDataAtRowProp(change[0][0],'RQLD_Location',loc.getValue());
		        		};

		        	}
		        },
		    }

		});
	
	$reqTo = $('select[name=RQL_RequestTo]').selectize({
	                    sortField: 'text',
	                    valueField: 'LOC_Id',
					    labelField: 'LOC_Name',
					    searchField: ['LOC_Name'],
	                    create: false,
                    	onChange: function(value) {
                    		var child = [];
                    		for(var x in locStrucJSON){
		            			if(locStrucJSON[x]['LOC_Parent_id'] == value){
		            				child.push(locStrucJSON[x]);
								}
		            		}

		            		selectSub(child);
		            		
                    	}
	                });
 	
 	reqTo 	= $reqTo[0].selectize;

	function selectSub(child){
 		if(child.length > 0){
 			confirm(createSelection(child),function(confirmed){
    				if(confirmed){
    					if($('input[name=subLocation]:checked').val()){
    						subLoc = [];
    						reqTo.clearOptions();
    						reqTo.load(function(callback) {
    							for(var x in locStrucJSON){
			            			if(locStrucJSON[x]['LOC_Id'] == $('input[name=subLocation]').val()){
			            				subLoc.push(locStrucJSON[x]);
									}
			            		}
			            		callback(subLoc);
    						});
    						reqTo.setValue($('input[name=subLocation]').val());
    					}
    				}else{
    					reqTo.clear();
    				}
    			});
 		}
 	}
 	function createSelection(data){
 		html = "<ul class='list-group' id='loc-selection'>";
 		for(var i in data){
 			html += "<li class='list-group-item'><input type='radio' name='subLocation' value='"+data[i]['LOC_Id']+"'>&nbsp;"+data[i]['LOC_Name']+"</li>"
 		}
 		return html += "</ul>";
 	}

	if($('select[name=RQL_Location]').length > 0){
		$loc = $('select[name=RQL_Location]').selectize({
	                    sortField: 'text',
	                    create: false,
					    onItemRemove:function(value){
					    	$('#com_id').val('');
					    	reqTo.clearOptions();
						},
	                   	onChange: function(value) {
	                   		reqTo.clearOptions();
	                   		if (!value.length) return;
	                   		var sub = [];
	                   		var curLoc;
	                   		for(var i in locJSON){
			            		if(value == locJSON[i]['SP_StoreID']){
			            			curLoc = locJSON[i]['LOC_Id'];
			            			$('#com_id').val(locJSON[i]['SP_FK_CompanyID']);
			            			break;
			            		}
			            	}

			            	for(var x in locStrucJSON){
		            			if(locStrucJSON[x]['LOC_Parent_id'] == curLoc){
		            				sub.push(locJSON[x]);
								}
		            		}

		            		reqTo.load(function(callback) {
		            			callback(sub);
					        });
				    	}
	                });
		loc 	= $loc[0].selectize;
		loc.setValue('<?=$data["RQL_Location"]?>','silent');
	}

	var subLocInit = [];
 	reqTo.load(function(callback) {
							for(var x in locStrucJSON){
		            			if(locStrucJSON[x]['LOC_Id'] == '<?=$data["RQL_RequestTo"]?>'){
		            				subLocInit.push(locStrucJSON[x]);
								}
		            		}
		            		callback(subLocInit);
						});
	
	reqTo.setValue('<?=$data["RQL_RequestTo"]?>');

  $("#update").on("click",function(){
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
		        url: base_url+'app/'+ _module + '/' + _class +'/process',
		        type: 'POST',
		        data: file,
		        dataType:'json',
		        processData: false,
	       		contentType: false,
		        success: function(data) {
		            if(data.result == 0){
	      				error_message(data.errors);
	        			grid.validateCells(function(){});
			        }else{
			            alert('Saved!');
		              	window.location = base_url+'app/'+_module+'/'+_class;
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

  // check_if_changed($('#' + _class + '-form'),$('#update'));

</script>			

					