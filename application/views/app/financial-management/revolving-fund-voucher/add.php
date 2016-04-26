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
				      <label class="control-label col-xs-6" for="">Source of Fund:</label>
				      <div class="col-xs-6">
				        <select class="form-control single-default select-cli" placeholder="Source of Fund" id="" name="RFV_SourceOfFund" tabindex="1">
						  	<option value="" disabled selected>Source of Fund</option>
						  	<?php foreach (static_lookup('source_of_fund') as $key => $value) { ?>
						  		<option value="<?=$key?>" ><?=$value?></option>
						  	<?php } ?>
						</select>
				      </div>
				    </div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-6">Doc. No.:</label>
					  <div class="col-xs-6">
				        <input type="text" class="form-control" id="" readonly tabindex="2" name="RFV_DocNo" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Doc. Date:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" readonly id="" tabindex="3" name="RFV_DocDate" value="<?=date("m/d/Y",time())?>" placeholder="Document Date">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Requestor:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" readonly  tabindex="4" name="RFV_Requestor" value="<?=  $this->session->userdata('U_User_id') ?>"  placeholder="Requestor">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Transaction Description:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" id="" tabindex="5" name="RFV_TransDescription" placeholder="Transaction Description">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Amount Requested:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control dc-mal" tabindex="6" name="RFV_AmountRequested" placeholder="Amount Requested">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Amount Released:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control dc-mal" readonly tabindex="7" name="RFV_AmountReleased" placeholder="Amount Released">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Date Released:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" readonly tabindex="8" name="RFV_DateReleased" placeholder="Date Released">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
					<div class="form-group">
				      <label class="control-label col-xs-6" for=""></label>
				      <div class="col-xs-6">
				      	<label class="control-label" for="">
				      		&nbsp;
		      			</label>
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Liquidation Date:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" id="" readonly tabindex="9" name="RFV_LiquidationDate" placeholder="Liquidation Date">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Liquidation Status:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" id="" readonly tabindex="10" name="RFV_LiquidationStatus" placeholder="Liquidation Status">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Liquidation Received:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" id=""  readonly tabindex="11" name="RFV_LiquidationReceived" placeholder="Liquidation Received">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for=""></label>
				      <div class="col-xs-6">
				      	<label class="control-label" for="">
				      		&nbsp;
		      			</label>
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for=""></label>
				      <div class="col-xs-6">
				      	<label class="control-label" for="">
				      		&nbsp;
		      			</label>
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Actual Amount Used:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control dc-mal" id="" readonly tabindex="12" name="RFV_ActualAmountUsed" placeholder="Actual Amount Used">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Excess:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control dc-mal" id="" readonly tabindex="13" name="RFV_Excess" placeholder="Excess">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Location:</label>
				      <div class="col-xs-6">
				        <?php 
				        $location 	= $this->session->userdata('location');
				        $dlocation 	= $this->session->userdata('dlocation')['SP_StoreID'];
				        $dcompany 	= $this->session->userdata('dlocation')['SP_FK_CompanyID'];
				        if(count($location) > 1){ 
				        ?>
				        <select class="form-control single-default" placeholder="Location" id="" name="RFV_Location" tabindex="14">
						  	<option value="" disabled selected>Location</option>
						  	<?php foreach ($location as $key => $value) { ?>
						  		<option value="<?=$value['SP_StoreID']?>" <?= $dlocation==$value['SP_StoreID']?'selected':''?> ><?=$value['SP_StoreName']?></option>
						  	<?php } ?>
						</select>
					  	<?php }else{ ?>
					  		<input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="15" name="RFV_Location" placeholder="Location">
				        <?php } ?>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Company:</label>
				      	<div class="col-xs-6">
					      	<select class="form-control single-default" placeholder="Company" id="com_id"  maxlength="30" name="RFV_Company" tabindex="2">
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
				      <label class="control-label col-xs-6" for="">Company:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" id="com_id" value="<?=count($location) == 1 ? $location[0]['COM_Name']: $dcompany ?>" tabindex="16" name="RFV_Company" placeholder="Company">
				      </div>
				    </div> -->
				</span>
			</form>
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
	
	var loc = <?= json_encode(array_column($this->session->userdata('location'),'SP_StoreID'))?>;

	var loc,$loc,com,$com;

	var sourceOfFund = <?= json_encode(static_lookup('source_of_fund')) ?>;
	
	var userLocations = <?= json_encode($location) ?>;


	$('input[name=RFV_DateReleased],input[name=RFV_LiquidationReceived]').datepicker({
		dateFormat:'mm/dd/yy'
	}).mask("99/99/9999");
  	
  	$('.dc-mal').autoNumeric('init',{aSep: ',',              
									 aDec: '.'}); 
  	
	// $select = $('.select-cli').each(function(){
	//             $(this).selectize({
	//               sortField: 'text',
	//             });
	//           });


	$com = $('select[name=RFV_Company]').selectize({
	                    sortField: 'text',
	                    create: false,
					});
		com 	= $com[0].selectize;
	
	if($('select[name=RFV_Location]').length > 0){
		$loc = $('select[name=RFV_Location]').selectize({
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
					            	var sourcefund = [];
					            	for(var i in userLocations){
					            		if(value == userLocations[i]['SP_StoreID']){
					            			if(userLocations[i]['SP_StoreType']=='1'){
					            				sourcefund.push({'id':'1','name':'Petty Cash Fund'},{'id':'4','name':'Revolving Fund '});
					            			}else{
					            				sourcefund.push({'id':'1','name':'Petty Cash Fund'},{'id':'2','name':'Low Point Fund'},{'id':'3','name':'Repair Fund'});
					            			}
											break;
					            		}
					            	}
					            	sourceDdown.clear();
					            	sourceDdown.load(function(callback){
					            		callback(sourcefund);
					            	});
					            	$('#com_id').val(res.COM_Name);
					            	$('#save-new,#save-close').attr('disabled',false);
					            }
					        });
				    	}
	                });
		loc 	= $loc[0].selectize;
		loc.setValue('<?=$this->session->userdata("U_User_id")?>');
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
 
 $nseries = $('input[name=RFV_DocNo]').numseries({
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
  	
  	var amount =$('input[name=RFV_AmountRequested]').val();
    if(sourceDdown.getValue() == 1 && parseInt(amount.replace(',','')) <= 1500){
    	alert("Can't request PCF below 1500!");
    	return	false;
    }

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
      
      var amount =$('input[name=RFV_AmountRequested]').val();
      if(sourceDdown.getValue() == 1 && parseInt(amount.replace(',','')) <= 1500){
    	alert("Can't request PCF below 1500!");
    	return	false;
      }

      confirm("Save Entry?", function(confirmed) {
          if(confirmed){ 
          
	         	$btn.attr('disabled',true).text('Processing..');
		        data = form.serializeArray();
		        
		        data.push(	{name:"type",value:'update'},
			                {name:"uniqid",value:$btn.data('id')} );

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

					