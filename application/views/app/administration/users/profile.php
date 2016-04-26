<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Profile</h4>
</div>
<div class="modal-body">
	<div id="data-container" class="container-fluid">
		<div role="tabpanel">
			<ul class="nav nav-tabs" id="user-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
			    <li role="presentation"><a href="#change-pass"  role="tab" data-toggle="tab">Change Password</a></li>
			</ul>
			<div id="content-container" class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="profile">
					<form id="users-form" class="form-horizontal row page-form" role="form" class="container-fluid">
						<span class="col-md-6">
							<div class="form-group">
							  	<label for="sel1" class="control-label col-xs-5">Username:</label>
							  	<div class="col-xs-7">
						        	<label for="sel1" class="control-label"><?=$data['U_User_id']?></label>
						      	</div>
							</div>
						    <div class="form-group">
						      <label class="control-label col-xs-5" for="">Full Name:</label>
						      		<div class="col-xs-7">
						        	<label class="control-label" for=""><?=$data['U_Username']?></label>
						      	</div>
						    </div>
						    <div class="form-group">
						      	<label class="control-label col-xs-5" for="">Position:</label>
						      	<div class="col-xs-7">
							      	<label class="control-label" for=""><?=$data['P_Position']?></label>
								</div>
						    </div>
						</span>
						<span class="col-md-6">
							<div class="form-group container-fluid">
						      	<div class="panel">
									<div class="panel-heading">
										<h4 class="panel-title">Locations</h4>
									</div>
						      		<div class="panel-body">
						      			<ul class="">
						      				<?php foreach ($location as $key => $value) { ?>
								      			<li><?= $value['SP_StoreName'] ?></li>
						      				<?php }?>
								      	</ul>
						      		</div>
						      	</div>
							</div>
						</span> 
					</form>
					<hr>
					<div class="btn-cont pull-right">
						<button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="change-pass">
					<form id="change-p-form" class="form-horizontal row page-form" role="form" class="container-fluid">
						<span class="col-md-6">
							<div class="form-group">
						      <label class="control-label col-xs-5" for="">Old Password</label>
						      <div class="col-xs-7">
						        <input type="password" class="form-control" id="" tabindex="6" name="old_password" placeholder="Old Password">
						      </div>
						    </div>
							<div class="form-group">
						      <label class="control-label col-xs-5" for="">Password</label>
						      <div class="col-xs-7">
						        <input type="password" class="form-control" id="" tabindex="6" name="U_Password" placeholder="Password">
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="control-label col-xs-5" for="">Repeat Password:</label>
						      <div class="col-xs-7">
						        <input type="password" class="form-control" id="rep_pass" tabindex="7" name="rep_password" placeholder="Repeat Password">
						      </div>
						    </div>
						</span>
					</form>
					<hr>
					<div class="btn-cont pull-right">
					    <a type="button" data-id="" tabindex="8" id="c-password" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
						  Save
						</a>
						<button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
					
<script type="text/javascript">

	$("#c-password").on("click",function(){
		form = $('#change-p-form');
		data = form.serializeArray();
		data.push({name:"type",value:'update-pass'});
		confirm("Change Password?", function(confirmed) {
	        if(confirmed){ 
				$.post(base_url+'app/administration/users/process',data,function(data){
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
						alert("Logging Out...")
						setTimeout(function(){ 
							window.location = base_url+'logout' 
							}, 
						1500);
					}
				},'json');
			}
		});
	});

	$('#profile-mod').on('hide.bs.modal', function () { 
		$('#profile-mod').removeData('bs.modal');
	});


	$('#profile-mod').on('show.bs.modal', function () {
		$('#profile-mod .modal-content .modal-body').html('<img  id="loader" class="center-block img-responsive" src="'+base_url+'css/assets/data_loader.gif" />'); 
	});

	$('#user-tabs a').click(function (e) {
	  $(this).tab('show');
	});

</script>	