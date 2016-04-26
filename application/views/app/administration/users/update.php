<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<div role="tabpanel">
				<ul class="nav nav-tabs" id="user-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
				    <li role="presentation"><a href="#change-pass"  role="tab" data-toggle="tab">Change Password</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="profile">
						<form id="users-form" class="form-horizontal row page-form" role="form" class="container-fluid">
							<span class="col-md-6">
								<div class="form-group">
								  <label for="sel1" class="control-label col-xs-5">Username:</label>
								  <div class="col-xs-7">
							        <input type="text" value="<?= $data['U_User_id'] ?>" class="form-control" id="" tabindex="1" name="U_User_id" placeholder="User ID">
							      </div>
								</div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Full Name:</label>
							      <div class="col-xs-7">
							        <input type="text" value="<?= $data['U_Username'] ?>" class="form-control" id="" tabindex="2" name="U_Username" placeholder="Full Name">
							      </div>
							    </div>
							    <div class="form-group">
							      	<label class="control-label col-xs-5" for="">Position:</label>
							      	<div class="col-xs-7">
								      	<select class="form-control single-default select-cli" id="" placeholder="Position"  tabindex="3" name="U_FK_Position_id">
										  	<option value="" disabled selected>Position</option>
										  	<?php 
										  		if(!empty($position)){
										  			foreach ($position['data'] as $key => $value) {
										  	?>
										  		<option value="<?=$value['P_Position_id']?>" <?= $data['U_FK_Position_id']==$value['P_Position_id']?"selected":"" ?> ><?=$value['P_Position']?></option>
										  	<?php }} ?>
										</select>
									</div>
							    </div>
							</span>
							<span class="col-md-6">
								<div class="form-group">
							      	<label class="control-label col-xs-5" for="">Location:</label>
							      	<div class="col-xs-7">
								      	<select multiple class="form-control single-default select-mul" data-default="<?= $data['default']['CA_FK_Location_id'] ?>" id="" name="U_FK_Location_id[]" tabindex="4">
										  	<option value="" disabled selected>Location</option>
										  	<?php 
										  		if(!empty($store['data'])){
										  			foreach ($store['data'] as $key => $value) {
										  	?>
										  		<option value="<?=$value['SP_StoreID']?>" <?= in_array($value['SP_StoreID'], array_column($data['location'],'CA_FK_Location_id') )?"selected":"" ?> ><?=$value['SP_StoreName']?></option>
										  	<?php }} ?>
										</select>
									</div>
							    </div>
							</span> 
						</form>
						<hr>
						<div class="btn-cont">
							<a type="button" data-id="<?= $data['id']; ?>" tabindex="5" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
							  Save
							</a>
							<a type="button" tabindex="6" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				 			  Cancel
							</a>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="change-pass">
						<form id="change-pass-form" class="form-horizontal row page-form" role="form" class="container-fluid">
							<span class="col-md-6">
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">Password</label>
							      <div class="col-xs-7">
							        <input type="password" class="form-control" id="" tabindex="7" name="U_Password" placeholder="Password">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-xs-5" for="">Repeat Password:</label>
							      <div class="col-xs-7">
							        <input type="password" class="form-control" id="rep_pass" tabindex="8" name="rep_password" placeholder="Repeat Password">
							      </div>
							    </div>
							</span>
						</form>
						<hr>
						<div class="btn-cont">
							<a type="button" data-id="<?= $data['id']; ?>" tabindex="9" id="change-password" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
							  Save
							</a>
							<a type="button" tabindex="10" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				 			   Cancel
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		
				
<script type="text/javascript">
	
	$select = $('.select-cli').each(function(index,obj){
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

	$("#change-password").on("click",function(){
		form = $('#change-pass-form');
		data = form.serializeArray();
		data.push({name:"type",value:'change-pass'},
				  {name:"uniqid",value:$(this).data('id')});
		confirm("Change Password?", function(confirmed) {
	        if(confirmed){ 
				$.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
					if(data.result == 0){
						$('.form-group').removeClass('has-error').find('div:first .alert').remove();
						$.each(data.errors,function(index,value){
							_this = $('[name="'+index+'"]').closest('.form-group');
				            _this.addClass('has-error').find('div:first').append(
				                '<div class="alert alert-danger" role="alert"> \
				                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> \
				                    <span class="sr-only">Error:</span> \
				                    ' + value + ' \
				                </div>'
				                );
				            });
				            $('.form-group').not('.has-error').find('div:first .alert').remove();
					}else{
						window.location = base_url+'app/administration/'+_class;
					}
				},'json');
			}
		});
	});

	$('#user-tabs a').click(function (e) {
	  $(this).tab('show');
	});

    $(".select-mul").selectize({
        create: false,
        plugins:{
        		 'restore_on_backspace':{},
        		 'remove_button':{},
        		 'append_input':{}
        		},
        sortField: 'text',
        selectOnTab: true,
        onInitialize:function(){
        	this.$control.find('div[data-value="'+$(".select-mul").data('default')+'"]').find('.selectize-appended').attr('checked',true);

        }

	});


	// .each(function (item, obj) {
 //        var selectizeItem = obj.selectize;
 //        var existingOptions = selectizeItem.options;
       
 //        console.log(existingOptions);
 //        selectizeItem.settings.maxItems = Object.keys(existingOptions).length;
 //       	//selectizeItem.clearOptions();

 //       	id = 'all' + (new Date()).getTime();
        
 //        selectizeItem.addOption({
 //            text: "All",
 //            value: id
 //        });

 //        $.each(existingOptions, function (index, obj) {
 //            selectizeItem.addOption({
 //                text: obj.text,
 //                value: obj.value
 //            });
 //        });

 //        selectizeItem.on('item_add', function (item) {
 //            if (item == id) {
 //                selectizeItem.clear(true);
 //                $.each(existingOptions, function (index, obj) {
 //                    selectizeItem.addItem(index, true);
 //                });
 //                selectizeItem.blur();
 //            }
 //        });
	// });


	//check_if_changed($('#users-form'),$('#update'));
</script>	