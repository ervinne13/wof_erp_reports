<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				 <span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="30" disabled value="<?=$data['ER_DocumentNo']?>" tabindex="1" name="ER_DocumentNo" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="<?=$data['ER_DocumentDate']?>" tabindex="2" name="ER_DocumentDate" placeholder="Document Date">
				      </div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Base Curreny:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Base Curreny" id="" name="ER_FK_BaseCurrency_id" tabindex="3">
							  	<option value="" disabled selected>Base Curreny</option>
							  	<?php 
							  		if(!empty($att)){
							  			foreach ($att['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['AD_Id'])?>"<?= trim($data['ER_FK_BaseCurrency_id'])==trim($value['AD_Id'])?"selected":"" ?> ><?=$value['AD_Desc']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Base Currency Rate:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control dc-mal" id="" maxlength="20" value="<?=$data['ER_BaseCurrencyRate']?>" tabindex="4" name="ER_BaseCurrencyRate" placeholder="Base Currency Rate">
				      </div>
				    </div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Converted Curreny:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Converted Curreny" id="" name="ER_FK_ConvCurrency_id" tabindex="5">
							  	<option value="" disabled selected>Converted Curreny</option>
							  	<?php 
							  		if(!empty($att)){
							  			foreach ($att['data'] as $key => $value) {
							  	?>	
							  		<option value="<?=trim($value['AD_Id'])?>"<?= trim($data['ER_FK_ConvCurrency_id'])==trim($value['AD_Id'])?"selected":"" ?> ><?=$value['AD_Desc']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Converted Currency Rate:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control dc-mal" id="" maxlength="20" value="<?=$data['ER_ConvCurrencyRate']?>" tabindex="6" name="ER_ConvCurrencyRate" placeholder="Converted Currency Rate">
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

	$('input[name=ER_DocumentDate]').datepicker();
	
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
              window.location = base_url+'app/administration/'+_class;
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