<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">					
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">WHT Bus. Posting Group:</label>
				      <div class="col-xs-7">
					      <select class="form-control single-default select-cli" placeholder="WHT Bus. Posting Group" id="" maxlength="30" name="WPS_WBPG_FK_Code" tabindex="1">
							  	<option value="" disabled selected>WHT Bus. Posting Group</option>
							  	<?php 
							  		if(!empty($WBPG)){
							  			foreach ($WBPG['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['WBPG_Code']?>" <?= trim($data['WPS_WBPG_FK_Code'])==trim($value['WBPG_Code'])?'selected':'' ?> ><?=$value['WBPG_Code']?></option>
							  	<?php }} ?>
						  </select>
					  </div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">WHT Prod. Posting Group:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="WHT Prod. Posting Group" id="" maxlength="30" name="WPS_WPPG_FK_Code" tabindex="2">
							  	  <option value="" disabled selected>WHT Prod. Posting Group</option>
							  	  <?php 
							  		 if(!empty($WPPG)){
							  			  foreach ($WPPG['data'] as $key => $value) {
							  	  ?>
							  		<option value="<?=$value['WPPG_Code']?>" <?= trim($data['WPS_WPPG_FK_Code'])==trim($value['WPPG_Code'])?'selected':'' ?> ><?=$value['WPPG_Code']?></option>
							  	  <?php }} ?>
						    </select>
						</div>
				    </div>
				    <div class="form-group">
               			 <label for="sel1" class="control-label col-xs-5">WHT%:</label>
                		<div class="col-xs-7">
                    		<input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="3" value="<?=$data['WPS_WHT']?>" name="WPS_WHT" placeholder="WHT%">
                		</div>
              		</div> 
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Payable Account:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Payable Account" id="" maxlength="30" name="WPS_COA_FK_PayableAccountNo" tabindex="3">
							  	  <option value="" disabled selected>Payable Account</option>
							  	  <?php 
							  		 if(!empty($COA)){
							  			  foreach ($COA['data'] as $key => $value) {
							  	  ?>
							  		<option value="<?=$value['COA_Account_id']?>" <?= trim($data['WPS_COA_FK_PayableAccountNo'])==trim($value['COA_Account_id'])?'selected':'' ?> ><?=$value['COA_AccountName']?></option>
							  	  <?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
	               		<label for="sel1" class="control-label col-xs-5">Withholding Tax Code (WTC):</label>
	                	<div class="col-xs-7">
                   			 <input type="text" class="form-control" id="" maxlength="20" tabindex="4" value="<?=$data['WPS_TaxCode']?>" name="WPS_TaxCode" placeholder="Withholding Tax Code (WHT)">
                		</div>
            		</div>   
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="5" data-id="<?= $data['id']; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="6" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
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
              window.location = base_url+'app/'+_module+'/'+_class;
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