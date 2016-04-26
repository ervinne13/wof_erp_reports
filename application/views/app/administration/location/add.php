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
				        <input type="text" class="form-control" id="" maxlength="30" tabindex="1" name="LOC_Id" placeholder="Location ID">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Location Name:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="100" tabindex="2" name="LOC_Name" placeholder="Location Name">
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
							  		<option value="<?=$value['AD_Id']?>"><?=$value['AD_Desc']?></option>
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
							  		<option value="<?=$value['LM_Level_id']?>"><?=$value['LM_Desc']?></option>
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
							  		<option value="<?=$value['LOC_Id']?>"><?=$value['LOC_Name']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <!-- 
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Company:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Company" id="" name="LOC_FK_Company_id" tabindex="4">
							  	<option value="" disabled selected>Company</option>
							  	<?php 
							  		if(!empty($com)){
							  			foreach ($com['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['COM_Id']?>"><?=$value['COM_Name']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Cost Profit Center:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Cost Profit Center" id="" name="LOC_FK_CPC_id" tabindex="5">
							  	<option value="" disabled selected>Cost Profit Center</option>
							  	<?php 
							  		if(!empty($cpc)){
							  			foreach ($cpc['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['CPC_Id']?>"><?=$value['CPC_Desc']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>    	  
				    <div class="form-group">
					  	<label for="sel1" class="control-label col-xs-5">Fixed Rent:</label>
					  	<div class="col-xs-7">
				        	<input type="text" class="form-control dc-mal" id="" maxlength="20"  tabindex="6" name="LOC_FixedRent" placeholder="Fixed Rent">
				      	</div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Address:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="100" tabindex="7" name="LOC_Addrs" placeholder="Address">
				      </div>
					</div>-->
				</span>
				<!-- <span class="col-md-6">	 
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Telephone #:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="20" tabindex="8" name="LOC_TelNum" placeholder="Telephone #">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Fax #:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="20" tabindex="9" name="LOC_FaxNum" placeholder="Fax #">
				      </div>
					</div>										   		    
					<div class="form-group">
					  	<label for="sel1" class="control-label col-xs-5">TIN #:</label>
					  	<div class="col-xs-7">
				        	<input type="text" class="form-control" id="" maxlength="30" tabindex="10" name="LOC_Tin" placeholder="TIN #">
				      	</div>
					</div>		
					<div class="form-group">
					  	<label for="sel1" class="control-label col-xs-5">Other Description:</label>
					  	<div class="col-xs-7">
				        	<input type="text" class="form-control" id="" maxlength="100" tabindex="11" name="LOC_OtherDesc" placeholder="Other Description">
				      	</div>
					</div>
					<div class="form-group">
					  	<label for="sel1" class="control-label col-xs-5">Sales Sharing:</label>
					  	<div class="col-xs-7">
				        	<input type="text" class="form-control dc-mal" id="" maxlength="20"  tabindex="12" name="LOC_SalesSharing" placeholder="Sales Sharing">
				      	</div>
					</div> 					
					<div class="form-group">
					  	<label for="sel1" class="control-label col-xs-5">Floor Area:</label>
					  	<div class="col-xs-7">
				        	<input type="text" class="form-control dc-mal" id="" maxlength="20"  tabindex="13" name="LOC_FloorArea" placeholder="Floor Area">
				      	</div>
					</div> 	    	    				    
				</span> -->
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="6" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="7" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="8" href="<?= base_url() ?>app/administration/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	$nseries = $('input[name=LOC_Id]').numseries({
                  target:base_url+'app/'+_module+'/'+_class+'/getseries',
                  method:'add',
                  beforeSend:function(){
                    $('#save-new,#save-close').attr('disabled',true);
                  },
                  afterSend:function(e,data){
                    if(data.rows != 0){
                      $('#save-new').attr({'disabled':false,'id':'update-new'});
                      $('#save-close').attr({'disabled':false,'id':'update'});
                      $('#update-new').attr('data-id',data.uniqid);
                      $('#update').attr('data-id',data.uniqid);
                    }else{
                      $('#save-new').attr({'disabled':false});
                      $('#save-close').attr({'disabled':false});
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

	$('.dc-mal').maskMoney({thousands:',', decimal:'.', allowZero:false, precision:4});
  
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
    	      {name:"LOC_Active",value:'1'},
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
      	        {name:"LOC_Active",value:'1'},
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
