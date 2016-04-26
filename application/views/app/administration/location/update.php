<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Location ID:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="30" value="<?=$data['LOC_Id']?>" tabindex="1" name="LOC_Id" placeholder="Location ID">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Location Name:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="100" value="<?=$data['LOC_Name']?>" tabindex="2" name="LOC_Name" placeholder="Location Name">
				      </div>
					</div>
					<div class="form-group">
				      	<label class="control-label col-xs-5" for="">Location Type:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Location Type" id="" name="LOC_FK_Type_id" tabindex="3">
							  	<option value="" disabled selected>Location Type</option>
							  	<?php 
							  		if(!empty($type['data'])){
							  			foreach ($type['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['AD_Id']?>" <?= $data['LOC_FK_Type_id']==$value['AD_Id']?'selected':'' ?>><?=$value['AD_Desc']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Level:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Level" id="" name="LOC_FK_Level_id" tabindex="4">
							  	<option value="" disabled selected>Level</option>
							  	<?php 
							  		if(!empty($lvl)){
							  			foreach ($lvl['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['LM_Level_id']?>" <?= $data['LOC_FK_Level_id']==$value['LM_Level_id']?'selected':'' ?> ><?=$value['LM_Desc']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Parent:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Parent" id="" name="LOC_Parent_id" tabindex="5">
							  	<option value="" disabled selected>Parent</option>
							  	<?php 
							  		if(!empty($parent['data'])){
							  			foreach ($parent['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['LOC_Id']?>" <?= $data['LOC_Parent_id']==$value['LOC_Id']?'selected':'' ?> ><?=$value['LOC_Name']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <!-- <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Company:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Level" id="" name="LOC_FK_Company_id" tabindex="4">
							  	<option value="" disabled selected>Company</option>
							  	<?php 
							  		if(!empty($com)){
							  			foreach ($com['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['COM_Id']?>" <?= trim($data['LOC_FK_Company_id'])==trim($value['COM_Id'])?'selected':'' ?> ><?=$value['COM_Name']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Cost Profit Center:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Level" id="" name="LOC_FK_CPC_id" tabindex="5">
							  	<option value="" disabled selected>Cost Profit Center</option>
							  	<?php 
							  		if(!empty($cpc)){
							  			foreach ($cpc['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['CPC_Id']?>" <?= trim($data['LOC_FK_CPC_id'])==trim($value['CPC_Id'])?'selected':'' ?> ><?=$value['CPC_Desc']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>				       		    
				    <div class="form-group">
				   		<label for="sel1" class="control-label col-xs-5">Fixed Rent:</label>
					  	<div class="col-xs-7">
				        	<input type="text" class="form-control dc-mal" id="" maxlength="20" value="<?=$data['LOC_FixedRent']?>" tabindex="6" name="LOC_FixedRent" placeholder="Fixed Rent">
				      	</div>
					</div>		    
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Address:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="100" value="<?=$data['LOC_Addrs']?>" tabindex="7" name="LOC_Addrs" placeholder="Address">
				      </div>
					</div> -->
				</span>				
				<!-- <span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Telephone #:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="20" value="<?=$data['LOC_TelNum']?>" tabindex="8" name="LOC_TelNum" placeholder="Telephone #">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Fax #:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="20" value="<?=$data['LOC_FaxNum']?>" tabindex="9" name="LOC_FaxNum" placeholder="Fax #">
				      </div>
					</div>					
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">TIN #:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="30" value="<?=$data['LOC_Tin']?>" tabindex="10" name="LOC_Tin" placeholder="TIN #">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Other Description:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="100" value="<?=$data['LOC_OtherDesc']?>" tabindex="11" name="LOC_OtherDesc" placeholder="Other Description">
				      </div>
					</div>
					<div class="form-group">
					  	<label for="sel1" class="control-label col-xs-5">Sales Sharing:</label>
					  	<div class="col-xs-7">
				        	<input type="text" class="form-control dc-mal" id="" maxlength="20" value="<?=$data['LOC_SalesSharing']?>" tabindex="12" name="LOC_SalesSharing" placeholder="Sales Sharing">
				      	</div>
					</div>
					<div class="form-group">
					  	<label for="sel1" class="control-label col-xs-5">Floor Area:</label>
					  	<div class="col-xs-7">
				        	<input type="text" class="form-control dc-mal" id="" maxlength="20" value="<?=$data['LOC_FloorArea']?>" value="0" tabindex="13" name="LOC_FloorArea" placeholder="Floor Area">
				      	</div>
					</div> 
				</span> -->
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="6" data-id="<?= $data['id']; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="7" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	 $nseries = $('input[name=LOC_Id]').numseries({
                  target:base_url+'app/'+_module+'/'+_class+'/getseries',
                  method:'update',
                  beforeSend:function(){
                    $('#save-new,#save-close').attr('disabled',true);
                  },
                  afterSend:function(e,data){
                    $('#save-new').attr({'disabled':false,'data-id':data.uniqid,'id':'update-new'});
                    $('#save-close').attr({'disabled':false,'data-id':data.uniqid,'id':'update'});
                  },
                  sendFailed:function(){
                    $('#save-new').attr({'disabled':false});
                    $('#save-close').attr({'disabled':false});
                    alert('Series Generation Failed!');
                  }
              });
	 
	$('.dc-mal').maskMoney({thousands:',', decimal:'.', allowZero:false, precision:4});
  
  	$('.dc-mal').maskMoney('mask',this.value);
  	
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

	check_if_changed($('#' + _class + '-form'),$('#update'));

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

</script>