<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="department-setup-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Department ID:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="<?=$data['DEP_Id'] ?>" tabindex="1" name="DEP_Id" placeholder="Department ID">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="<?=$data['DEP_Description'] ?>" tabindex="2" name="DEP_Description" placeholder="Description">
				      </div>
				    </div>
				</span>
				<span class="col-md-6">
					<div class="form-group">
				      	<label class="control-label col-xs-5" for="">Positions:</label>
				      	<div class="col-xs-7">
					      	<select multiple class="form-control single-default select-mul" id="" name="DS_FK_Position_id[]" tabindex="5">
							  	<option value="" disabled selected>Positions</option>
							  	<?php 
							  		if(!empty($position['data'])){
							  			foreach ($position['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['P_Position_id']?>" <?= in_array($value['P_Position_id'], array_column($data['position'],'DS_FK_Position_id') )?"selected":"" ?> ><?=$value['P_Position']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				</span> 
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" data-id="<?= $data['id']; ?>" tabindex="4" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
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

    $(".select-mul").selectize({
        create: false,
        plugins:['restore_on_backspace','remove_button'],
        sortField: 'text',
        selectOnTab: true
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

	check_if_changed($('#department-setup-form'),$('#update'));
</script>	