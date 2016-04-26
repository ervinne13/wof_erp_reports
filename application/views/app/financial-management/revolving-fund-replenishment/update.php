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
						  		<option value="<?=$key?>" <?= $key==$data['RFR_SourceOfFund']?'selected':''?> ><?=$value?></option>
						  	<?php } ?>
						</select>
				      </div>
				    </div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="2" value="<?=$data['RFR_DocNo']?>" name="RFR_DocNo" placeholder="Document No.">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Period Covered:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="3" value="<?=format($data['RFR_PeriodFrom'])?>" name="RFR_PeriodFrom" placeholder="From">
				      </div>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="4" value="<?=format($data['RFR_PeriodTo'])?>" name="RFR_PeriodTo" placeholder="To">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Fund Custodian:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly  tabindex="5" value="<?=$data['RFR_FundCustodian']?>" name="RFR_FundCustodian" value="<?=  $this->session->userdata('U_User_id') ?>"  placeholder="Fund Custodian">
				       </div> 
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="6" value="<?=format($data['RFR_DocDate'])?>" name="RFR_DocDate" placeholder="Document Date">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="7" value="<?=$data['RFR_Status']?>" name="RFR_Status" value="" placeholder="Status">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
		      		<div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <?php 
				        $location = $this->session->userdata('location');
				        if(count($location) > 1){ 
				        ?>
				        <select class="form-control single-default" placeholder="Location" id="" name="RFR_Location" tabindex="8">
						  	<option value="" disabled selected>Location</option>
						  	<?php foreach ($location as $key => $value) { ?>
						  		<option value="<?=$value['SP_StoreID']?>" <?=$data['RFR_Location'] == $value['SP_StoreID']?'selected':''?> ><?=$value['SP_StoreName']?></option>
						  	<?php } ?>
						</select>
					  	<?php }else{ ?>
					  		<input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="9" name="RFR_Location" placeholder="Location">
				        <?php }?>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Company" id="com_id" maxlength="30" name="RFR_Company" tabindex="2">
							  	  <option value="" disabled selected>Company</option>
							  	    <?php 
							  	    if(!empty($Com['data'])){
							  			foreach ($Com['data'] as $key => $value) {
							  	    ?>
							  		<option value="<?=$value['COM_Id']?>" <?= trim($data['RFR_Company'])==trim($value['COM_Id'])?'selected':'' ?> ><?=$value['COM_Name']?></option>
							  	    <?php }} ?>
							    </select>
					     </div>
				    </div>
				   <!--  <div class="form-group">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="com_id" value="<?=(!$data['RFR_Status']||$data['RFR_Status']=='Cancel') && count($location) == 1? $location[0]['COM_Id'] : $data['RFR_Company']?>" tabindex="10" name="RFR_Company" placeholder="Company">
				      </div>
				    </div> -->
				</span>
			</form>
			<hr>
			<div id="sample">

			</div>
			<hr>
			<div class="btn-cont">
				<a type="button" data-id="<?= $data['id']; ?>" tabindex="11" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="12" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
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
		tableData: <?=json_encode($details['data'])?>,
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
		                readOnly: false
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
		        		if($.inArray(change[0][1],['RFRD_withVAT','RFRD_Amount'])!= -1){
		        			amount 	= this.getDataAtRowProp(change[0][0],'RFRD_Amount') || 0;
		        			withVat = this.getDataAtRowProp(change[0][0],'RFRD_withVAT');
		        			vat 	= parseFloat(amount)-(parseFloat(amount) / 1.12);
							this.setDataAtRowProp(change[0][0],'RFRD_VAT',withVat==true?vat:0);
							this.setDataAtRowProp(change[0][0],'RFRD_NetOfVat',withVat==true?parseFloat(amount) / 1.12:0);
		        		};
		        	}
		        	
		        },
		    }

		});

  	
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
 

  // $select = $('.select-cli').each(function(index, obj){
  //               $(this).selectize({
  //                 sortField: 'text',
  //                 plugins: {
		// 				'dropdown_header': {
		// 					title: $(obj).attr('placeholder')
		// 				}
		// 			}
  //               });
  //             });


  $("#update").on("click",function(){
    var $btn = $(this);
    var form = $('#'+_class+"-form");
    var $lbl = $btn.text();


    confirm("Save Entry?", function(confirmed) {
      if(confirmed){ 
      
        $btn.attr('disabled',true).text('Processing..');
      	
      	data = form.serializeArray();
      	data.push({name:"type",value:'update'},
                {name:"uniqid",value:$btn.data('id')});
      	if($('#sample').length > 0){
      		data.push({name:"details",value:JSON.stringify(grid.getSourceData())});
      	}
      	
      	$(form).find('input[type=checkbox]').each(function() {
        	data.push({ name: this.name, value: this.checked ? 1 : 0 });
      	});

        file = new FormData();

        $('.attachment').each(function(){
        	if($(this)[0].files.length > 0){
    			file.append('file[]', $(this)[0].files[0]);
        	}
		});

		$.each(data,function(key,input){
	        file.append(input.name,input.value);
	    });

		$('.uploaded-att').each(function(){
			file.append('uploaded[]',$.trim($(this).text()));
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

					