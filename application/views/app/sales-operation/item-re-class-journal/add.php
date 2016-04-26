<?php 
	$location 	= $this->session->userdata('location');
    $dlocation 	= $this->session->userdata('dlocation')['SP_StoreID'];
    $dcompany 	= $this->session->userdata('dlocation')['SP_FK_CompanyID'];
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
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="1" name="IRJ_DocNo" placeholder="Document No.">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <?php 
				        if(count($location) > 1){ 
				        ?>
				        <select class="form-control single-default" placeholder="Location" id="" name="IRJ_Location" tabindex="14">
						  	<option value="" disabled selected>Location</option>
						  	<?php foreach ($location as $key => $value) { ?>
						  		<option value="<?=$value['SP_StoreID']?>" ><?=$value['SP_StoreName']?></option>
						  	<?php } ?>
						</select>
					  	<?php }else{ ?>
					  		<input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="1" name="IRJ_Location" placeholder="Location">
				        <?php } ?>
				      </div>
				    </div>
				   <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" tabindex="4" name="IRJ_Remarks" value=""  placeholder="Remarks">
				       </div> 
				    </div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="2" name="IRJ_DocDate" value="<?=date("m/d/Y",time())?>" placeholder="Document Date">
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="com_id" readonly value="<?=count($location) == 1 ? $location[0]['COM_Name']: $dcompany ?>" tabindex="15" name="IRJ_Company" placeholder="Company">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Ref. Doc. No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2"  value="" name="IRJ_RefDocNo" placeholder="Ref. Doc. No.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Dismantled/Disposed:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2"  value="" name="IRJ_ActualDate" placeholder="Date Dismantled/Disposed">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  readonly id="" tabindex="2"  value="Open" name="IRJ_Status" placeholder="Status">
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div id="sample">

			</div>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="18" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="19" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="20" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	var loc 		= <?= json_encode(array_column($this->session->userdata('location'),'SP_StoreID'))?>;

	var locJSON		= <?= json_encode($locat['data']); ?>;
	
	var locStrucJSON= <?= json_encode($locStructure['data']); ?>;

	var itemType 	= <?= json_encode(array_column($itemtype['data'],'IT_Id'))?>;
	
	var items 		= <?= json_encode($item['data'])?>;
	
	var itemCode 	= <?= json_encode(array_column($item['data'],'IM_Item_id'))?>;

	var itemDescription = <?= json_encode(array_column($item['data'],'IM_Sales_Desc'))?>;
	
	var uom 			= <?= json_encode($uom)?>;

	var loca,$loca,curLoc=null;


	$('input[name=IRJ_ActualDate]').datepicker({
		dateFormat:'mm/dd/yy'
	}).mask("99/99/9999");

	function get_sub(loc_id,subLocArray){
		for(var i in locStrucJSON){
			if(locStrucJSON[i]['LOC_Parent_id'] == loc_id){
				if(locStrucJSON[i]['LOC_Parent_id']){
					subLocArray.push(locStrucJSON[i]['LOC_Id']);
					get_sub(locStrucJSON[i]['LOC_Id'],subLocArray);
				}
			}
		}
		return subLocArray;
	}

	var grid  = $('#sample').gridEntry({
		add:true,
		gridConfig:{
			// minSpareRows:1,
			colHeaders:[  
		                "Item Type",
		                "Item No.",
		                "Description",
		                "Location",
		                "Qty",
		                "UOM",
		                "Response",
		                "Remarks"
		                ],
		    columns: [
		    		{
		                data: "IRJD_ItemType",
                        type: 'dropdown',
                        // allowInvalid: false,
                        // strict: true,
                        trimDropdown: true,
                        source:itemType,
		            }, {
		                data: "IRJD_ItemNo",
		                type: 'dropdown',
                        trimDropdown: true,
                        // strict: true,
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
		            }, {
		                data: "IRJD_ItemDescription",
		                type: 'dropdown',
                        trimDropdown: true,                        
                        // strict: true,
                        source:function(change,process){
                        	instance = $('#sample').handsontable('getInstance');
                        	itemDescData = [];
							for(var i in items){
								if(instance.getDataAtCell(this.row, 0) == items[i].IM_FK_ItemType_id){
									itemDescData.push(items[i].IM_Sales_Desc);
								}
							}
							process(itemDescData);
                        }
		            }, {
		                data: "IRJD_Location",
		                type: 'dropdown',
                        trimDropdown: true,
                        source:function(change,process){
                        	if(get_sub(curLoc,[]).length > 0){
								process(get_sub(curLoc,[]));
                        	}else{
                        		process([$('select[name=IRJ_Location]').val()]);
                        	}
                        }
                    }, {
		                data: "IRJD_Qty",
		                type: 'numeric',
	        			format: '0,0',
	        			// allowInvalid:false,
	        			// strict: true
		            }, {
		                data: "IRJD_UOM",
		                type: 'dropdown',
                        trimDropdown: true,                        
                        // strict: true,
                        allowInvalid:true,
                        source:function(change,process){
                        	instance = $('#sample').handsontable('getInstance');
                        	uomData = [""];
							for(var i in uom){
								if(instance.getDataAtCell(this.row, 1) == uom[i].IUC_FK_Item_id){
									uomData.push(uom[i].AD_Code);
								}
							}
							process(uomData);
                        }
		           },{
		                data: "IRJD_Response",
 						type:'dropdown',
		                source: ['','Miscounted','Overage','Shortage-Charge to Branch','Shortage - Charge to Employee'],
		            },{
		                data: "IRJD_Remarks",	        			
		            },
		            ],
		        afterChange:function(change,source){
		        	if(change !==null || source !='loadData'){
		        		if(change[0][1] == 'IRJD_ItemNo' && source != 'cascade'){
		        			for(var i in items){
								if(this.getDataAtRowProp(change[0][0],'IRJD_ItemNo') == items[i].IM_Item_id){
									this.setDataAtRowProp(change[0][0],'IRJD_ItemDescription',items[i].IM_Sales_Desc,'cascade');
									this.setDataAtRowProp(change[0][0],'IRJD_UnitCost',items[i].IM_UnitCost||0);
									this.setDataAtRowProp(change[0][0],'IRJD_UOM',items[i].AD_Code);
								}
							}
		        		};
		        		if(change[0][1] == 'IRJD_ItemDescription' && source != 'cascade'){
		        			for(var i in items){
								if(this.getDataAtRowProp(change[0][0],'IRJD_ItemDescription') == items[i].IM_Sales_Desc){
									this.setDataAtRowProp(change[0][0],'IRJD_ItemNo',items[i].IM_Item_id,'cascade');
									this.setDataAtRowProp(change[0][0],'IRJD_UnitCost',items[i].IM_UnitCost||0);
								}
							}
							
		        		};

		        		if(change[0][1] == 'IRJD_Qty'){
		        			qty 	 = this.getDataAtRowProp(change[0][0],'IRJD_Qty')||0;
		        			unitCost = this.getDataAtRowProp(change[0][0],'IRJD_UnitCost')||0;
		        			this.setDataAtRowProp(change[0][0],'IRJD_Amount',parseFloat(qty).toFixed(2) * parseFloat(unitCost).toFixed(2));
		        		};

		        		if(change[0][1] == 'IRJD_ItemType'){
		        			ctr = 0;
	        				for(var i in items){
								if(change[0][3] == items[i].IM_FK_ItemType_id){
									ctr++;
								}
							}
							if(ctr == 0){
								this.setDataAtRowProp(change[0][0],'IRJD_ItemNo',null);
								this.setDataAtRowProp(change[0][0],'IRJD_ItemDescription',null);
								this.setDataAtRowProp(change[0][0],'IRJD_UnitCost',items[i].IM_UnitCost||0);
								this.setDataAtRowProp(change[0][0],'IRJD_UOM',null);
								this.setDataAtRowProp(change[0][0],'IRJD_UOM',null);
							}
							// this.setDataAtRowProp(change[0][0],'IRJD_Location',loc.getValue());
							// loc = document.getElementById('lc').value;                          
       //                      this.setDataAtRowProp(change[0][0], 'IRJD_Location', loc);
		        		};

		        	}
		        },
		    }

		});
	
	if($('select[name=IRJ_Location]').length > 0){
		$loca = $('select[name=IRJ_Location]').selectize({
	                    sortField: 'text',
	                    create: false,
					    onItemRemove:function(value){
					    	$('#com_id').val('');
					    },
	                   	onChange: function(value) {
	                   		if (!value.length) return;
	                   		for(var i in locJSON){
			            		if(value == locJSON[i]['SP_StoreID']){
			            			curLoc = locJSON[i]['LOC_Id'];
			            			$('#com_id').val(locJSON[i]['SP_FK_CompanyID']);
			            			break;
			            		}
			            	}
				    	}
	                });
		loca 	= $loca[0].selectize;
		loca.setValue('<?=$dlocation?>');
	}
 
 

 $nseries = $('input[name=IRJ_DocNo]').numseries({
                  target:base_url+'app/sales-operation/item-re-class-journal/getseries',
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
	
  $select = $('.select-cli').each(function(){
	            $(this).selectize({
	              sortField: 'text',
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
		        url: base_url+'app/sales-operation/item-re-class-journal/process',
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
		        url: base_url+'app/sales-operation/item-re-class-journal/process',
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

					