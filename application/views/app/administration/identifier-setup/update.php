<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
				      	<label class="control-label col-xs-5" for="">Category:</label>
				      	<div class="col-xs-7">
				      		<label class="control-label" for=""><?=$data['CAT_Desc']?></label>
						</div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Identifier:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-mul" multiple id="" placeholder="Identifier" name="IDS_FK_Identifier_id[]" tabindex="2">
							  	<option value="" selected>Identifier</option>
							  	<?php 
							  		if(!empty($identifier['data'])){
							  			foreach ($identifier['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['ID_Id']?>" <?= in_array($value['ID_Id'], array_column($data['identifier']['data'],'IDS_FK_Identifier_id') )?"selected":"" ?> ><?=$value['ID_Description']?></option>
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

	$(".select-mul").selectize({
        create: false,
        plugins:['restore_on_backspace','remove_button'],
        sortField: 'text',
        selectOnTab: true
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