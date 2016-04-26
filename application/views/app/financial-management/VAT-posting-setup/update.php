<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">					
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">VAT Bus. Posting Group:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="VAT Bus. Posting Group" id="" maxlength="30" name="VPS_VBPG_FK_Code" tabindex="1">
							  	  <option value="" disabled selected>VAT Bus. Posting Group</option>
							  	  <?php 
							  		 if(!empty($VBPG)){
							  			  foreach ($VBPG['data'] as $key => $value) {
							  	  ?>
							  		<option value="<?=$value['VBPG_Code']?>" <?= trim($data['VPS_VBPG_FK_Code'])==trim($value['VBPG_Code'])?'selected':'' ?> ><?=$value['VBPG_Code']?></option>
							  	  <?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">VAT Prod. Posting Group:</label>
				      <div class="col-xs-7">
					      <select class="form-control single-default select-cli" placeholder="VAT Prod. Posting Group" id="" maxlength="30" name="VPS_VPPG_FK_Code" tabindex="2">
							  	<option value="" disabled selected>VAT Prod. Posting Group</option>
							  	<?php 
							  		if(!empty($VPPG)){
							  			foreach ($VPPG['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['VPPG_Code']?>" <?= trim($data['VPS_VPPG_FK_Code'])==trim($value['VPPG_Code'])?'selected':'' ?> ><?=$value['VPPG_Code']?></option>
							  	<?php }} ?>
						  </select>
					  </div>
				    </div>
				     <div class="form-group">
               			 <label for="sel1" class="control-label col-xs-5">Vat Percentage:</label>
                		<div class="col-xs-7">
                    		<input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="3" value="<?=$data['VPS_Vat']?>" name="VPS_Vat" placeholder="Vat Percentage">
                		</div>
              		</div> 
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Sales Account:</label>
				      	<div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="Sales Account" id="" maxlength="30" name="VPS_COA_FK_SalesAccountNo" tabindex="4">
							  	  <option value="" disabled selected>Account Name</option>
							  	  <?php 
							  		 if(!empty($COA)){
							  			  foreach ($COA['data'] as $key => $value) {
							  	  ?>
							  		 <option value="<?=$value['COA_Account_id']?>" <?= trim($data['VPS_COA_FK_SalesAccountNo'])==trim($value['COA_Account_id'])?'selected':'' ?> ><?=$value['COA_AccountName']?></option>
							  	  <?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Purchase Account:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Purchase Account" id="" maxlength="30" name="VPS_COA_FK_PurchaseAccountNo" tabindex="5">
							  	  <option value="" disabled selected>Account Name</option>
							  	  <?php 
							  		 if(!empty($COA)){
							  			  foreach ($COA['data'] as $key => $value) {
							  	  ?>
							  		<option value="<?=$value['COA_Account_id']?>" <?= trim($data['VPS_COA_FK_PurchaseAccountNo'])==trim($value['COA_Account_id'])?'selected':'' ?> ><?=$value['COA_AccountName']?></option>
							  	  <?php }} ?>
							</select>
						</div>
				    </div>
				</span>
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