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
				        <input type="text" class="form-control" id="" maxlength="30" tabindex="1" name="UC_DocNo" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="UC_DocDate" placeholder="Document Date">
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
							  		<option value="<?=$value['AD_Code']?>"><?=$value['AD_Desc']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Base Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="4" name="UC_BaseQty" placeholder="Base Qty">
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
							  		<option value="<?=$value['AD_Code']?>"><?=$value['AD_Desc']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Converted Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="6" name="UC_ConversionQty" placeholder="Converted Qty">
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
				<a type="button" tabindex="9" href="<?= base_url() ?>app/administration/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
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

</script>
					