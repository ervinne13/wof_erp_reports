<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Username:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="U_User_id" placeholder="Username">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Password:</label>
				      <div class="col-xs-7">
				        <input type="password" class="form-control" id="" tabindex="2" name="U_Password" placeholder="Password">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Repeat Password:</label>
				      <div class="col-xs-7">
				        <input type="password" class="form-control" id="rep_pass" tabindex="3" name="rep_password" placeholder="Repeat Password">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Full Name:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="4" name="U_Username" placeholder="Full Name">
				      </div>
				    </div>
				</span>
				<span class="col-md-6">
					<div class="form-group">
				      	<label class="control-label col-xs-5" for="">Position:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder='Position' id="" name="U_FK_Position_id" tabindex="5">
							  	<option value="" selected>Position</option>
							  	<?php 
							  		if(!empty($position)){
							  			foreach ($position['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['P_Position_id']?>"><?=$value['P_Position']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				     <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Location:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-mul" multiple id="" placeholder='Location' name="U_FK_Location_id[]" tabindex="6">
							  	<option value="" disabled selected>Location</option>
							  	<?php 
							  		if(!empty($store['data'])){
							  			foreach ($store['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['SP_StoreID']?>" ><?=$value['SP_StoreName']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				</span>
			</form>
			<div class="btn-cont">
				<a type="button" tabindex="7" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="8" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="9" href="<?= base_url() ?>app/administration/users" class="btn btn-default form-btn sub-clr">
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

    $selectmul = $(".select-mul").selectize({
        create: false,
        plugins:{
        		 'restore_on_backspace':{},
        		 'remove_button':{},
        		 'append_input':{'title':'Default location'}
        		},
        sortField: 'text',
        selectOnTab: true
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

        $(form).find('.selectize-appended').each(function(){
        	_this = $(this);
        	if(_this.prop('checked')==true){
        		data.push({ name: this.name, value:_this.parent().data('value') });
        	}
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
            $selectmul.each(function(){
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
    $(form).find('.selectize-appended').each(function(){
        	_this = $(this);
        	if(_this.prop('checked')==true){
        		data.push({ name: this.name, value:_this.parent().data('value') });
        	}
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

