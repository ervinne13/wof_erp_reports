<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Code:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="30" tabindex="1" name="NS_Id" placeholder="Code">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="200" tabindex="2" name="NS_Description" placeholder="Description">
				      </div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Module:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Module" id="" name="NS_FK_Module_id" tabindex="3">
							  	<option value="" disabled selected>Module</option>
							  	<?php 
							  		if(!empty($module)){
							  			foreach ($module['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['M_Module_id']?>"><?=$value['M_Description']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Location:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Module" id="" name="NS_Location" tabindex="3">
							  <option value="" disabled selected>Location</option>
							  	<?php 
							  		if(!empty($location)){
							  			foreach ($location['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['SP_StoreID']?>" ><?=$value['SP_StoreName']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Starting No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="0" id="" maxlength="30" tabindex="5" name="NS_StartNo" placeholder="Starting No.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Ending No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="0" id="" maxlength="30" tabindex="6" name="NS_EndingNo" placeholder="Ending No.">
				      </div>
				    </div>
		
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="7" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="8" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="9" href="<?= base_url() ?>app/administration/no-series" class="btn btn-default form-btn sub-clr">
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

</script>
					