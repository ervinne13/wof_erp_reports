<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
					<div class="form-group">
				      	<label class="control-label col-xs-5" for="">Posting Group:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" id="" name="AS_PKFK_PostingGroup_id" tabindex="1">
							  	<option value="" selected>Posting Group</option>
							  	<?php 
							  		if(!empty($posting)){
							  			foreach ($posting['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['PG_Id']?>" <?= trim($value['PG_Id'])==trim($data['AS_PKFK_PostingGroup_id'])?'selected':''?> ><?=$value['PG_Description']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Account:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" id="" name="AS_PKFK_Account_id" tabindex="2">
							  	<option value="" selected>Account</option>
							  	<?php 
							  		if(!empty($account)){
							  			foreach ($account['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['CA_Account_id']?>" <?= trim($value['CA_Account_id'])==trim($data['AS_PKFK_Account_id'])?'selected':''?> ><?=$value['CA_AccountName']?></option>
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
<script type="text/javascript">
	$select = $('.select-cli').each(function(){
                    $(this).selectize({
                      sortField: 'text',
                    });
                  });
</script>