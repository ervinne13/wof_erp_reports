<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?>
			<?php if($functions){ ?>	
          	<span class="dropdown pull-right">
				<a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			    	Functions
			    	<span class="caret"></span>
			  	</a>
			  	<ul class="dropdown-menu functions" role="menu" aria-labelledby="dropdownMenu1">
			  		<li>
			  			<?=$functions?>
			  		</li>
			  	</ul>
			</span>
			<?php } ?>
		</h5>
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
						        	<input type="text" class="form-control" id="" disabled maxlength="30" tabindex="1" value="<?=$data['SP_DocNo']?>" placeholder="Document No.">
						    	</div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Store Type:</label>
							  <div class="col-xs-7">
							      <select class="form-control single-default" id="" placeholder="Store Type" name="SP_StoreType" tabindex="2">
									  	<option value="" disabled selected>Store Type</option>
									  	<?php foreach(static_lookup('storetype') as $key => $value){ ?>
									  	<option value="<?= $key ?>" <?=$data['SP_StoreType']==$key?'selected':''?> ><?= $value ?></option>
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
									  	<option value="<?=$value['SP_StoreID']?>" <?=$data['SP_MainStore']==$value['SP_StoreID']?'selected':''?> ><?=$value['SP_StoreName']?></option>
									  	<?php }} ?>
								   </select>
							  </div>
						  </div>
						  <div class="form-group">
						      	<label class="control-label col-xs-5" for="">Cost Profit Center:</label>
						      	<div class="col-xs-7">
							      	<select class="form-control single-default" disabled id="" name="SP_FK_CPC_id" tabindex="4">
								  		<option value="" disabled selected>Cost Profit Center</option>
								  		<?php 
								  			if(!empty($cpc)){
								  				foreach ($cpc['data'] as $key => $value) {
								  		?>
								  		<option value="<?=$value['CPC_Id']?>" <?= trim($data['SP_FK_CPC_id'])==trim($value['CPC_Id'])?'selected':'' ?> ><?=$value['CPC_Desc']?></option>
								  		<?php }} ?>
									</select>
							    </div>
						   	</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Store ID:</label>
							  	<div class="col-xs-7">
						        	<input type="text" class="form-control" id="" maxlength="30" value="<?=$data['SP_StoreID']?>" tabindex="5" name="SP_StoreID" placeholder="Store ID">
						    	</div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Store Name:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="100" value="<?=$data['SP_StoreName']?>" tabindex="6" name="SP_StoreName" placeholder="Store Name">
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
									  	<option value="<?=$value['COM_Id']?>" <?= trim($data['SP_FK_CompanyID'])==trim($value['COM_Id'])?'selected':'' ?> ><?=$value['COM_Name']?></option>
									  	<?php }} ?>
										</select>
									</div>
						  </div>						   
						</span>
						<span class="col-md-6 isHidden">
						  <div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Address:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="100" value="<?=$data['SP_Address']?>" tabindex="8" name="SP_Address" placeholder="Address">
						    </div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Date Opened:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" value="<?=format($data['SP_DateOpened'])?>"  tabindex="9" name="SP_DateOpened" placeholder="Date Opened">
						    </div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Date Closed:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id=""  value="<?=format($data['SP_DateClosed'])?>" tabindex="10" name="SP_DateClosed" placeholder="Date Closed">
						    </div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Contract Duration:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="30" value="<?=$data['SP_ContractDuration']?>"  tabindex="11" name="SP_ContractDuration" placeholder="Contract Duration">
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
						        <input type="text" class="form-control" id="" maxlength="30" value="<?=$data['SP_TelNo']?>" tabindex="12" name="SP_TelNo" placeholder="Telephone #">
						    </div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Fax #:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="30" value="<?=$data['SP_FaxNo']?>" tabindex="13" name="SP_FaxNo" placeholder="Fax #">
						    </div>
							</div>
						</span>
						<span class="col-md-6 isHidden">						    
						  <div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">TIN #:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="30" value="<?=$data['SP_TinNo']?>" tabindex="14" name="SP_TinNo" placeholder="TIN #">
						    </div>
							</div>
						  <div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Floor Area:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control dc-mal" id="" maxlength="20" value="<?=$data['SP_FloorArea']?>" tabindex="15" name="SP_FloorArea" placeholder="Floor Area">
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
						        <input type="text" class="form-control" id="" maxlength="30" value="<?=$data['SP_StoreConcept']?>"  tabindex="16" name="SP_StoreConcept" placeholder="Store Concept">
						    </div>
							</div>
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Class:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="30" value="<?=$data['SP_StoreClass']?>" tabindex="17" name="SP_StoreClass" placeholder="StoreClass">
						    </div>
							</div>
							<div class="form-group">
						    <label for="sel1" class="control-label col-xs-5">Sharing Scheme:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control dc-mal" id="" maxlength="16" value="<?=$data['SP_FixedRent']?>" tabindex="18" name="SP_FixedRent" placeholder="Sharing Scheme">
						    </div>
							</div>							
						</span>		
						<span class="col-md-6 isHidden">
							<!-- <div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Sharing Scheme:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" maxlength="30" value="<?=$data['SP_SharingScheme']?>"  tabindex="14" name="SP_SharingScheme" placeholder="Sharing Scheme">
						      </div>
							</div> -->		
														
							<div class="form-group">
						      	<label class="control-label col-xs-5" for="">Region:</label>
						      	<div class="col-xs-7">
							      	<select class="form-control single-default select-cli" placeholder="Region" id="" name="SP_Region" tabindex="19">
									  		<option value="" disabled selected>Region</option>
									  		<?php 
									  			if(!empty($reg['data'])){
									  				foreach ($reg['data'] as $key => $value) {
									  		?>
									  		<option value="<?=$value['AD_Id']?>" <?= $data['SP_Region']==$value['AD_Id']?'selected':'' ?>><?=$value['AD_Desc']?></option>
									  		<?php }} ?>
											</select>
										</div>
						  </div>
						    <div class="form-group">
						      	<label class="control-label col-xs-5" for="">Area:</label>
						      	<div class="col-xs-7">
							      	<select class="form-control single-default select-cli" placeholder="Area" id="" name="SP_Area" tabindex="20">
									  		<option value="" disabled selected>Area</option>
									  		<?php 
									  			if(!empty($area['data'])){
									  				foreach ($area['data'] as $key => $value) {
									  		?>
									  		<option value="<?=$value['AD_Id']?>" <?= $data['SP_Area']==$value['AD_Id']?'selected':'' ?>><?=$value['AD_Desc']?></option>
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
									  		<option value="<?=$value['AD_Id']?>" <?= $data['SP_FK_LocationType_id']==$value['AD_Id']?'selected':'' ?>><?=$value['AD_Desc']?></option>
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
				<a type="button" tabindex="22" data-id="<?= $data["id"]; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="23" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				  Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	 // $nseries = $('input[name=SP_StoreID]').numseries({
  //                 target:base_url+'app/'+_module+'/'+_class+'/getseries',
  //                 method:'update',
  //                 beforeSend:function(){
  //                   $('#save-new,#save-close').attr('disabled',true);
  //                 },
  //                 afterSend:function(e,data){
  //                   $('#save-new').attr({'disabled':false,'data-id':data.uniqid,'id':'update-new'});
  //                   $('#save-close').attr({'disabled':false,'data-id':data.uniqid,'id':'update'});
  //                 },
  //                 sendFailed:function(){
  //                   $('#save-new').attr({'disabled':false});
  //                   $('#save-close').attr({'disabled':false});
  //                   alert('Series Generation Failed!');
  //                 }
  //             });
	$('input[name=SP_TinNo]').mask("?999-999-999-9999");
	$('input[name=SP_DateOpened],input[name=SP_DateClosed]').datepicker({
		dateFormat:'mm/dd/yy'
	});

	// $('.dc-mal').maskMoney({thousands:',', decimal:'.', allowZero:false, precision:4});
  
 //  	$('.dc-mal').maskMoney('mask',this.value);
  	var cpc,$cpc,
		storetype,$storetype,
		mainstore,$mainstore;

	var stype = '<?=$data['SP_StoreType']?>';

	var updates = <?=$data['SP_Updates']?>;

	$(document).ready(function(){
		for(var i in updates){
			_this = $('[name='+i+']');
			if(updates[i]!=null){
				if(updates[i]!=_this.val()){
					_this.closest('.form-group').addClass('alert-danger');
				}
			}
		}
	});

	if(stype==1){
		$('.isHidden').hide();
	}

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
				    	},
				    
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

	if($('select[name=SP_StoreType]').val() != 3 && $('select[name=SP_StoreType]').val() != 4){
		mainstore.clear();
		mainstore.disable();
	}

	$select = $('.select-cli').each(function(){
                    $(this).selectize({
                      sortField: 'text',
                    });
                  });

	$(document).on("click","#update",function(){
      var $btn = $(this);
      var $lbl = $btn.text();
      form = $('#'+_class+"-form");
      data = form.serializeArray();
      data.push({name:"type",value:'update'},
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

	check_if_changed($('#' + _class + '-form'),$('#update'));

</script>