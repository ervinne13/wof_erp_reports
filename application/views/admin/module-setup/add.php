<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(2)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Module:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="m_description" placeholder="Module">
				      </div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Parent Module:</label>
				      	<div class="col-xs-7">
					      	<select class="form-control single-default select-cli" id="" name="m_level" tabindex="5">
							  	<option value="" disabled selected>Size Category</option>
							  	<?php 
							  		if(!empty($mod)){
							  			foreach ($mod['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['m_moduleid']?>"><?=$value['m_description']?></option>
							  	<?php }} ?>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Target Function:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="m_trigger" placeholder="Target Function">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Icon:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="m_icon" placeholder="Icon">
				      </div>
				    </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Level:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="1" name="m_grouping" placeholder="Level">
              </div>
            </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" id="a-save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" id="a-save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" href="<?= base_url() ?>admin/<?=$this->uri->segment(2)?>" class="btn btn-default form-btn sub-clr">
				  Back
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
  $("#a-save-new").on("click",function(){
    var $btn = $(this);
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        
        $btn.attr('disabled',true).text('Processing..');
        form = $('#'+_module+"-form");
        data = form.serializeArray();
        data.push({name:"type",value:'add'});
        $(form).find('input[type=checkbox]').each(function() {
           data.push({ name: this.name, value: this.checked ? 1 : 0 });
         });

        $('.form-group').removeClass('has-error');
        $.post(base_url+'admin/module-setup/process',data,function(data){
          if(data.result == 0){
            $.each(data.errors,function(index,value){
              _this = $('[name='+index+']').closest('.form-group');
              _this.tooltip({
                placement:'top',
                title:value,
                trigger:'focus'
              }).addClass('has-error');
            });
            $('.form-group').not('.has-error').tooltip('destroy');
          }else{
            $('.form-group').removeClass('has-error').tooltip('destroy');
            form[0].reset();
            $select.each(function(){
              $(this)[0].selectize.clear();
            });
          }
          $btn.attr('disabled',false).text('Save & New');
        },'json').error(function(){
          alert('Error!');
          $btn.attr('disabled',false).text('Save & New');
        });
      }
    });
  });

  $("#a-save-close").on("click",function(){
    var $btn = $(this);
    form = $('#'+_module+"-form");
    data = form.serializeArray();
    data.push({name:"type",value:'add'});
    $(form).find('input[type=checkbox]').each(function() {
       data.push({ name: this.name, value: this.checked ? 1 : 0 });
     });

    $('.form-group').removeClass('has-error');
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        $btn.attr('disabled',true).text('Processing..');
        $.post(base_url+'admin/module-setup/process',data,function(data){
          if(data.result == 0){
            $.each(data.errors,function(index,value){
              _this = $('[name='+index+']').closest('.form-group');
              _this.tooltip({
                placement:'top',
                title:value,
                trigger:'focus'
              }).addClass('has-error');
            });
            $('.form-group').not('.has-error').tooltip('destroy');
          }else{
            window.location = base_url+'admin/module-setup/';
          }
          $btn.attr('disabled',false).text('Save & Close');
        },'json').error(function(){
          alert('Error!');
          $btn.attr('disabled',false).text('Save & Close');
        });
      }
    });
  });
</script>
					