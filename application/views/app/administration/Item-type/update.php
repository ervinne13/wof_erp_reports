<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Item Type ID:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="30" value="<?= $data['IT_Id']; ?>" tabindex="1" name="IT_Id" placeholder="Item Type ID">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="100" value="<?= TRIM($data['IT_Description']); ?>" tabindex="2" name="IT_Description" placeholder="Description">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Points Required:</label>
				      <div class="col-xs-7">
				        <input type="checkbox" tabindex="3" <?=$data['IT_PointsRequired']=='1'?'checked':''?> name="IT_PointsRequired" >
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Services:</label>
				      <div class="col-xs-7">
				        <input type="checkbox" tabindex="3" <?=$data['IT_Services']=='1'?'checked':''?> name="IT_Services" >
				      </div>
				    </div>
					<div class="form-group">
				      	<label class="control-label col-xs-5" for="">Modules:</label>
				      	<div class="col-xs-7">
					      	<select multiple class="form-control single-default select-mul" id="" name="ITS_FK_Module_id[]" tabindex="4">
							  	<option value="" disabled selected>Modules</option>
							  	<?php 
							  		if(!empty($module['data'])){
							  			foreach ($module['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['M_Module_id']?>" <?= in_array($value['M_Module_id'], array_column($data['module'],'ITS_FK_Module_id') )?"selected":"" ?> ><?=$value['M_Description']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="4" data-id="<?= $data["id"]; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="5" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	 $nseries = $('input[name=IT_Id]').numseries({
                  target:base_url+'app/'+_module+'/'+_class+'/getseries',
                  method:'update',
                  beforeSend:function(){
                    $('#save-new,#save-close').attr('disabled',true);
                  },
                  afterSend:function(e,data){
                    $('#save-new').attr({'disabled':false,'data-id':data.uniqid,'id':'update-new'});
                    $('#save-close').attr({'disabled':false,'data-id':data.uniqid,'id':'update'});
                  },
                  sendFailed:function(){
                    $('#save-new').attr({'disabled':false});
                    $('#save-close').attr({'disabled':false});
                    alert('Series Generation Failed!');
                  }
              });

	$selectmul = $(".select-mul").selectize({
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