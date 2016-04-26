<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				 <span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="30" disabled value="<?=$data['UC_DocNo']?>" tabindex="1" name="UC_DocNo" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="<?=$data['UC_DocDate']?>" tabindex="2" name="UC_DocDate" placeholder="Document Date">
				      </div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Base Unit:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Base Unit" id="" name="UC_FK_BaseUOM_id" tabindex="3">
							  	<option value="" disabled selected>Base Unit</option>
							  	<?php 
							  		if(!empty($att)){
							  			foreach ($att['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['AD_Code'])?>"<?= trim($data['UC_FK_BaseUOM_id'])==trim($value['AD_Code'])?"selected":"" ?> ><?=$value['AD_Desc']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Base Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control dc-mal" id="" maxlength="20" value="<?=$data['UC_BaseQty']?>" tabindex="4" name="UC_BaseQty" placeholder="Base Currency Rate">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Converted Unit:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Converted UOM" id="" name="UC_FK_ConvUOM_id" tabindex="5">
							  	<option value="" disabled selected>Converted Unit</option>
							  	<?php 
							  		if(!empty($att)){
							  			foreach ($att['data'] as $key => $value) {
							  	?>	
							  		<option value="<?=trim($value['AD_Code'])?>"<?= trim($data['UC_FK_ConvUOM_id'])==trim($value['AD_Code'])?"selected":"" ?> ><?=$value['AD_Desc']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Converted Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control dc-mal" id="" maxlength="20" value="<?=$data['UC_ConversionQty']?>" tabindex="6" name="UC_ConversionQty" placeholder="Converted Currency Rate">
				      </div>
				    </div>
				</span>
			</form>
			<div class="btn-cont">
				<a type="button" tabindex="7" data-id="<?= $data['id']; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="8" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
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
</script>