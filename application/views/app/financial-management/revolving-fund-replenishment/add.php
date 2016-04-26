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
				      <label class="control-label col-xs-5" for="">Source of Fund:</label>
				      <div class="col-xs-7">
				        <select class="form-control single-default" placeholder="Source of Fund" id="" name="RFR_SourceOfFund" tabindex="1">
						  	<option value="" disabled selected>Source of Fund</option>
						  	<?php foreach (static_lookup('source_of_fund') as $key => $value) { ?>
						  		<option value="<?=$key?>" ><?=$value?></option>
						  	<?php } ?>
						</select>
				      </div>
				    </div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="2" name="RFR_DocNo" placeholder="Document No.">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Period Covered:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="3" name="RFR_PeriodFrom" placeholder="From">
				      </div>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="4" name="RFR_PeriodTo" placeholder="To">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Fund Custodian:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly  tabindex="5" name="RFR_FundCustodian" value="<?=  $this->session->userdata('U_User_id') ?>"  placeholder="Fund Custodian">
				       </div> 
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="6" name="RFR_DocDate" value="<?=date("m/d/Y",time())?>" placeholder="Document Date">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="7" name="RFR_Status" value="Open" placeholder="Status">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <?php 
				        $location 	= $this->session->userdata('location');
				        $dlocation 	= $this->session->userdata('dlocation')['SP_StoreID'];
				        $dcompany 	= $this->session->userdata('dlocation')['SP_FK_CompanyID'];
				        if(count($location) > 1){ 
				        ?>
				        <select class="form-control single-default" placeholder="Location" id="" name="RFR_Location" tabindex="8">
						  	<option value="" disabled selected>Location</option>
						  	<?php foreach ($location as $key => $value) { ?>
						  		<option value="<?=$value['SP_StoreID']?>" <?= $dlocation==$value['SP_StoreID']?'selected':''?> ><?=$value['SP_StoreName']?></option>
						  	<?php } ?>
						</select>
					  	<?php }else{ ?>
					  		<input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="9" name="RFR_Location" placeholder="Location">
				        <?php } ?>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default" placeholder="Company" id="com_id"  maxlength="30" name="RFR_Company" tabindex="2">
							  	  <option value="" disabled selected>Company</option>
							  	    <?php 
							  	    if(!empty($Com['data'])){
							  			foreach ($Com['data'] as $key => $value) {
							  	    ?>
							  		<option value="<?=$value['COM_Id']?>" <?=$dcompany==$value['COM_Id']?'selected':''?> ><?=$value['COM_Name']?></option>
							  	    <?php }} ?>
							    </select>
					     </div>
				    </div>
				    <!-- <div class="form-group">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="com_id" value="<?=count($location) == 1 ? $location[0]['COM_Name']: $dcompany ?>" tabindex="10" name="RFR_Company" placeholder="Company">
				      </div>
				    </div> -->
				</span>
			</form>
			<hr>
			<div id="sample">

			</div>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="11" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="12" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="13" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	var loc = <?= json_encode(array_column($this->session->userdata('location'),'SP_StoreID'))?>;

	var loc,$loc,com,$com;

	var grid  = $('#sample').gridEntry({
		add:false,
		gridConfig:{
			minSpareRows:1,
		    colHeaders:[  
		                "Date",
		                "Ref. Doc. No.",
		                "Requestor",
		                "Transaction Description",
		                "Actual Amount Used"
		                ],
		    columns: [
		    		{
		                data: "RFRD_Date",
		                readOnly:false
		            }, {
		                data: "RFRD_RefDocNo",
		                readOnly:false
		            }, {
		                data: "RFRD_Requestor",
		                readOnly:false
		            }, {
		                data: "RFRD_Description",
		                readOnly:false,
		                renderer:totalTextRendererDisabled
		            }, {
		                data: "RFRD_ActualAmount",
		                readOnly:false,
		                renderer:renderTotal
		            }
		            ],
		        afterChange:function(change,source){
		        	if(change !==null || source !='loadData'){
		        		if($.inArray(change[0][1],['RFVD_withVAT','RFVD_Amount'])!= -1){
		        			amount 	= this.getDataAtRowProp(change[0][0],'RFVD_Amount') || 0;
		        			withVat = this.getDataAtRowProp(change[0][0],'RFVD_withVAT');
		        			vat 	= parseFloat(amount)-(parseFloat(amount) / 1.12);
							this.setDataAtRowProp(change[0][0],'RFVD_VAT',withVat==true?vat:0);
							this.setDataAtRowProp(change[0][0],'RFVD_NetOfVat',withVat==true?parseFloat(amount) / 1.12:0);
		        		};
		        	}
		        	
		        },
		    }

		});

	// $('input[name=RFR_DateReleased],input[name=RFR_LiquidationReceived]').datepicker({
	// 	dateFormat:'mm/dd/yy'
	// }).mask("99/99/9999");
  	
  	// $('.dc-mal').autoNumeric('init',{aSep: ',',              
			// 						 aDec: '.'}); 
  	
	$select = $('select[name=RFR_SourceOfFund]').selectize({
	              	sortField: 'text',
	              	onItemRemove:function(value){
	              		grid.loadData();
					},
                   	onChange: function(value) {
                   		if (!value.length) return;
                   		 $.ajax({
				            url: base_url + 'app/financial-management/revolving-fund-replenishment/get_details',
				            type: 'GET',
				            dataType: 'json',
				            data: {
				                q: value
				            },
				            error: function(){
				            	grid.loadData();
				            },
				            success: function(res) {
				            	grid.loadData(res.data);
				            	var dates = [];
				            	
				            	for(i in res.dates){
				            		dates.push(new Date(res.dates[i]));
				            	}

				            	if(dates.length>0){
					            	$('input[name=RFR_PeriodFrom]').val( $.datepicker.formatDate('mm/dd/yy',new Date(Math.max.apply(null,dates))));
					            	$('input[name=RFR_PeriodTo]').val( $.datepicker.formatDate('mm/dd/yy',new Date(Math.max.apply(null,dates))));
				            	}else{
				            		$('input[name=RFR_PeriodFrom]').val('');
				            		$('input[name=RFR_PeriodTo]').val('');
				            	}
				            }
				        });
			    	}
	            });
	
	$com = $('select[name=RFR_Company]').selectize({
	                    sortField: 'text',
	                    create: false,
					});
		com 	= $com[0].selectize;

	if($('select[name=RFR_Location]').length > 0){
		$loc = $('select[name=RFR_Location]').selectize({
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
					            	com.clear();
					            	$('#save-new,#save-close').attr('disabled',true);
								},
					            error: function(){
					            	com.clear();
					            	$('#save-new,#save-close').attr('disabled',false);
					            },
					            success: function(res) {
					            	com.setValue(res.COM_Name);
					            	$('#save-new,#save-close').attr('disabled',false);
					            }
					        });
				    	}
	                });
		loc 	= $loc[0].selectize;
	}
 
 $nseries = $('input[name=RFR_DocNo]').numseries({
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

					