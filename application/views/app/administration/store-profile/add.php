<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<div class="row btm-15">
					<div class="container-fluid">
						<span class="col-md-6">
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
							  	<div class="col-xs-7">
						        	<input type="text" class="form-control" id="" disabled maxlength="30" tabindex="1" name="SP_DocNo" placeholder="Document No.">
						    	</div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Store Type:</label>
							  <div class="col-xs-7">
							      	<select class="form-control single-default" id="" placeholder="Store Type" name="SP_StoreType" tabindex="2">
									  	<option value="" disabled selected>Store Type</option>
									  	<?php foreach(static_lookup('storetype') as $key => $value){ ?>
									  		<option value="<?= $key ?>" ><?= $value ?></option>
									  	<?php } ?>
									</select>
							   </div>
							</div>
							<div class="form-group">
						      	<label class="control-label col-xs-5" for="">Main Store:</label>
						      	<div class="col-xs-7">
							      	<select class="form-control single-default" id="" placeholder="Main Store" name="SP_MainStore" tabindex="3">
									  	<option value="" disabled selected>Main Store</option>
									  	<?php 
									  		if(!empty($store['data'])){
									  			foreach ($store['data'] as $key => $value) {
									  	?>
									  		<option value="<?=$value['SP_StoreID']?>" ><?=$value['SP_StoreName']?></option>
									  	<?php }} ?>
									</select>
								</div>
						    </div>
						    <div class="form-group">
						      	<label class="control-label col-xs-5" for="">Cost Profit Center:</label>
						      	<div class="col-xs-7">
							      	<select class="form-control single-default" disabled id="" placeholder="Cost Profit Center" name="SP_FK_CPC_id" tabindex="4">
									  	<option value="" disabled selected>Cost Profit Center</option>
									  	<?php 
									  		if(!empty($cpc)){
									  			foreach ($cpc['data'] as $key => $value) {
									  	?>
									  		<option value="<?=$value['CPC_Id']?>" ><?=$value['CPC_Desc']?></option>
									  	<?php }} ?>
									</select>
								</div>
						    </div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Store ID:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="30" tabindex="5" name="SP_StoreID" placeholder="Store ID">
						      </div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Store Name:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="100" tabindex="6" name="SP_StoreName" placeholder="Store Name">
						      </div>
							</div>
							<div class="form-group">
						      	<label class="control-label col-xs-5" for="">Company:</label>
						      	<div class="col-xs-7">
							      	<select class="form-control single-default select-cli" id="" name="SP_FK_CompanyID" tabindex="7">
									  	<option value="" disabled selected>Company</option>
									  	<?php 
									  		if(!empty($com)){
									  			foreach ($com['data'] as $key => $value) {
									  	?>
									  		<option value="<?=$value['COM_Id']?>" ><?=$value['COM_Name']?></option>
									  	<?php }} ?>
									</select>
								</div>
						    </div>
						</span>
						<span class="col-md-6 isHidden">
						    <div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Address:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="100" tabindex="8" name="SP_Address" placeholder="Address">
						      </div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Date Opened:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id=""  tabindex="9" name="SP_DateOpened" placeholder="Date Opened">
						      </div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Date Closed:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id=""  tabindex="10" name="SP_DateClosed" placeholder="Date Closed">
						      </div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Contract Duration:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="30" tabindex="11" name="SP_ContractDuration" placeholder="Contract Duration">
						      </div>
							</div>
						</span>						
					</div>
				</div>
				<div class="row btm-15">
					<div class="container-fluid">
						<span class="col-md-6 isHidden">
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Telephone #:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="30" tabindex="12" name="SP_TelNo" placeholder="Telephone #">
						      </div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Fax #:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="30" tabindex="13" name="SP_FaxNo" placeholder="Fax #">
						      </div>
							</div>
						</span>
						<span class="col-md-6 isHidden">
						    
						    <div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">TIN #:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="30" tabindex="14" name="SP_TinNo" placeholder="TIN #">
						      </div>
							</div>
						    <div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Floor Area:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="15" name="SP_FloorArea" placeholder="Floor Area">
						      </div>
							</div>
						</span>
					</div>
				</div>
				<div class="row">
					<div class="container-fluid">
						<span class="col-md-6 isHidden">
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Store Concept:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="30"  tabindex="16" name="SP_StoreConcept" placeholder="Store Concept">
						      </div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Class:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="30" tabindex="17" name="SP_StoreClass" placeholder="StoreClass">
						      </div>
							</div>
							<div class="form-group">
						    <label for="sel1" class="control-label col-xs-5">Sharing Scheme:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control dc-mal" id="" maxlength="16" tabindex="18" name="SP_FixedRent" placeholder="Sharing Scheme">
						      </div>
							</div>
						</span>		
						<span class="col-md-6 isHidden">
							<!-- <div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Sharing Scheme:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="30"  tabindex="14" name="SP_SharingScheme" placeholder="Sharing Scheme">
						      </div>
							</div>	 -->					
							
							<div class="form-group">
						      	<label class="control-label col-xs-5" for="">Region:</label>
						      	<div class="col-xs-7">
							      	<select class="form-control single-default select-cli" id="" placeholder="Region" name="SP_Region" tabindex="19">
									  	<option value="" disabled selected>Region</option>
									  	<?php 
									  		if(!empty($reg)){
									  			foreach ($reg['data'] as $key => $value) {
									  	?>
									  		<option value="<?=$value['AD_Id']?>" ><?=$value['AD_Desc']?></option>
									  	<?php }} ?>
									</select>
								</div>
						    </div>

						    <div class="form-group">
						      	<label class="control-label col-xs-5" for="">Area:</label>
						      	<div class="col-xs-7">
							      	<select class="form-control single-default select-cli" id="" placeholder="Area" name="SP_Area" tabindex="20">
									  	<option value="" disabled selected>Area</option>
									  	<?php 
									  		if(!empty($area)){
									  			foreach ($area['data'] as $key => $value) {
									  	?>
									  		<option value="<?=$value['AD_Id']?>" ><?=$value['AD_Desc']?></option>
									  	<?php }} ?>
									</select>
								</div>
						    </div>
						    <div class="form-group">
						      	<label class="control-label col-xs-5" for="">Location Type:</label>
						      	<div class="col-xs-7">
							      	<select class="form-control single-default select-cli" placeholder="Location Type" id="" name="SP_FK_LocationType_id" tabindex="21">
									  	<option value="" disabled selected>Location Type</option>
									  	<?php 
									  		if(!empty($loc)){
									  			foreach ($loc['data'] as $key => $value) {
									  	?>
									  		<option value="<?=$value['AD_Id']?>" ><?=$value['AD_Desc']?></option>
									  	<?php }} ?>
									</select>
								</div>
						    </div>
						</span>
					</div>
				</div>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="22" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="23" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="24" href="<?= base_url() ?>app/administration/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('input[name=SP_TinNo]').mask("?999-999-999-9999");
	var cpc,$cpc,
		storetype,$storetype,
		mainstore,$mainstore;

	// $nseries = $('input[name=SP_StoreID]').numseries({
 //                  target:base_url+'app/'+_module+'/'+_class+'/getseries',
 //                  method:'add',
 //                  beforeSend:function(){
 //                    $('#save-new,#save-close').attr('disabled',true);
 //                  },
 //                  afterSend:function(e,data){
 //                    $('#save-new').attr({'disabled':false,'id':'update-new'});
 //                    $('#save-close').attr({'disabled':false,'id':'update'});
 //                    $('#update-new').attr('data-id',data.uniqid);
 //                    $('#update').attr('data-id',data.uniqid);
 //                  },
 //                  sendFailed:function(){
 //                    $('#save-new').attr({'disabled':false});
 //                    $('#save-close').attr({'disabled':false});
 //                    alert('Series Generation Failed!');
 //                  },
 //                  modal:{
 //                        target:base_url+'app/'+_module+'/'+_class+'/seriesmodal',
 //                        selecttarget:base_url+'app/'+_module+'/'+_class+'/process',
 //                        afterSend:function(e,data){
 //                          $('#save-new').attr({'disabled':false,'id':'update-new'});
 //                          $('#save-close').attr({'disabled':false,'id':'update'});
 //                          $('#update-new').attr('data-id',data.uniqid);
 //                          $('#update').attr('data-id',data.uniqid);
 //                          },
 //                        }
 //              });
	
	 $nseries = $('input[name=SP_DocNo]').numseries({
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

	$('input[name=SP_DateOpened],input[name=SP_DateClosed]').datepicker({
		dateFormat:'mm/dd/yy'
	}).mask("99/99/9999");

	// $('.dc-mal').maskMoney({thousands:',', decimal:'.', allowZero:false, precision:4});
  
	$select = $('.select-cli').each(function(){
                    $(this).selectize({
                      sortField: 'text',
                    });
                  });

	$storetype = $('select[name=SP_StoreType]').selectize({
                      sortField: 'text',
                       onChange: function(value) {
                       	mainstore.clear();
                       	cpc.clear()
				        if (!value.length) return;
				        	if($('select[name=SP_MainStore]').val().length && value == 3){
				        		$.get(base_url+'app/administration/store-profile/getdata/',{type:'cpc',data:mainstore.getValue()},function(data){
				        			if(data.length){
				        				cpc.setValue(data);
				        			}
				        		});
				        	}

				        	if(value == 1 || value ==2){
				        		mainstore.disable();
				        	}else{
				        		mainstore.enable();
				        	}

			        		if(value==1){
			        			$('.isHidden').hide();
			        		}else{
			        			$('.isHidden').show();
			        		}
				    	}
                    });

	$mainstore = $('select[name=SP_MainStore]').selectize({
                      sortField: 'text',
                      onChange: function(value) {
                      	cpc.clear()
				        if (!value.length) return;
				        	if($('select[name=SP_StoreType]').val().length && storetype.getValue() == 3){
				        		$.get(base_url+'app/administration/store-profile/getdata/',{type:'cpc',data:mainstore.getValue()},function(data){
				        			if(data.length){
				        				cpc.setValue(data);
				        			}
				        		});
				        	}
				    	}
                    });

	$cpc  = $('select[name=SP_FK_CPC_id]').selectize({
                      sortField: 'text'
                    });
	cpc 		= $cpc[0].selectize;
	storetype 	= $storetype[0].selectize;
	mainstore 	= $mainstore[0].selectize;

 $("#save-new").on("click",function(){
    var $btn = $(this);
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        
        $btn.attr('disabled',true).text('Processing..');
        form = $('#'+_class+"-form");
        data = form.serializeArray();
        data.push({name:"type",value:'add'});
        $(form).find('input[type=checkbox]').each(function() {
           data.push({ name: this.name, value: this.checked ? 1 : 0 });
         });

        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
          if(data.result == 0){
            error_message(data.errors);
          }else{
            $('.form-group').removeClass('has-error').find('div:first .alert').remove();
            form[0].reset();
            $select.each(function(){
              $(this)[0].selectize.clear();
            });
            alert('Saved!');
          }
          $btn.attr('disabled',false).text('Save & New');
        },'json').error(function(){
          alert('Error!');
          $btn.attr('disabled',false).text('Save & New');
        });
      }
    });
  });

  $("#save-close").on("click",function(){
    var $btn = $(this);
    form = $('#'+_class+"-form");
    data = form.serializeArray();
    data.push({name:"type",value:'add'});
    $(form).find('input[type=checkbox]').each(function() {
      data.push({ name: this.name, value: this.checked ? 1 : 0 });
    });

    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        $btn.attr('disabled',true).text('Processing..');
        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
          if(data.result == 0){
            error_message(data.errors);
          $btn.attr('disabled',false).text('Save & Close');
          }else{
            alert('Saved!');
            window.location = base_url+'app/administration/'+_class;
          }
        },'json').error(function(){
          alert('Error!');
          $btn.attr('disabled',false).text('Save & Close');
        });
      }
    });
  });

  $(document).on("click","#update-new",function(){
    var $btn = $(this);
    var $lbl = $btn.text();
    form = $('#'+_class+"-form");
    data = form.serializeArray();
    data.push({name:"type",value:'update'},
    	      {name:"SP_Active",value:'1'},
              {name:"uniqid",value:$(this).attr('data-id')});
    $(form).find('input[type=checkbox]').each(function() {
      data.push({ name: this.name, value: this.checked ? 1 : 0 });
    });
    
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        $btn.attr('disabled',true).text('Processing..');
        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
          if(data.result == 0){
            error_message(data.errors);
            $btn.attr('disabled',false).text('Save');
          }else{
            $('.form-group').removeClass('has-error').find('div:first .alert').remove();
            form[0].reset();
            $select.each(function(){
              $(this)[0].selectize.clear();
            });
            alert('Saved!');
            $nseries.trigger('proccess');
          }
          $btn.attr('disabled',false).text($lbl);
        },'json').error(function(){
          alert('Error!');
          $btn.attr('disabled',false).text($lbl);
        });
      }
    });
  });

  $(document).on("click","#update",function(){
      var $btn = $(this);
      var $lbl = $btn.text();
      form = $('#'+_class+"-form");
      data = form.serializeArray();
      data.push({name:"type",value:'update'},
      	        {name:"SP_Active",value:'1'},
                {name:"uniqid",value:$(this).data('id')});
      $(form).find('input[type=checkbox]').each(function() {
        data.push({ name: this.name, value: this.checked ? 1 : 0 });
      });
      
      confirm("Save Entry?", function(confirmed) {
          if(confirmed){ 
          $btn.attr('disabled',true).text('Processing..');
          $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
            if(data.result == 0){
              error_message(data.errors);
              $btn.attr('disabled',false).text($lbl);
            }else{
              alert('Saved!');
              window.location = base_url+'app/administration/'+_class;
            }
          },'json').error(function(){
            alert('Error!');
            $btn.attr('disabled',false).text($lbl);
          });
        }
      });
  });
</script>			
