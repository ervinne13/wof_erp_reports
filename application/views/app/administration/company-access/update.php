<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
					<div class="form-group">
				      	<label class="control-label col-xs-5" for="">User:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" id="" name="CA_FK_User_id" tabindex="1">
							  	<option value="" selected>User</option>
							  	<?php 
							  		if(!empty($user)){
							  			foreach ($user['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['U_User_id']?>" <?= trim($value['U_User_id'])==trim($data['CA_FK_User_id'])?'selected':''?> ><?=$value['U_User_id']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Location:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" id="" name="CA_FK_Location_id" tabindex="2">
							  	<option value="" selected>Location</option>
							  	<?php 
							  		if(!empty($location)){
							  			foreach ($location['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['LOC_Id']?>" <?= trim($value['LOC_Id'])==trim($data['CA_FK_Location_id'])?'selected':''?> ><?=$value['LOC_Desc']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="3" data-id="<?= $data["id"]; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="4" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
			