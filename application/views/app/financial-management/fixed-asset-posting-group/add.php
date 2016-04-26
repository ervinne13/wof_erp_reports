<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Fixed Asset Posting Group:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="30" tabindex="1" name="FAPG_Code" placeholder="Fixed Asset Posting Group">
				    </div>
          </div>					
				  <div class="form-group">
				      <label class="control-label col-xs-5" for="">Acquisition Cost Account:</label>
				      <div class="col-xs-7">
					      	<select class="form-control single-default select-cli" placeholder="Acquisition Cost Account" id="" maxlength="30" name="FAPG_COA_FK_ACANo" tabindex="2">
							  	  <option value="" disabled selected>Acquisition Cost Account</option>
							  	  <?php 
							  		 if(!empty($COA['data'])){
							  			  foreach ($COA['data'] as $key => $value) {
							  	  ?>
							  		 <option value="<?=$value['COA_Account_id']?>" ><?=$value['COA_AccountName']?></option>
							  	  <?php }} ?>
							    </select>
						  </div>
				  </div>
          <div class="form-group">
              <label class="control-label col-xs-5" for="">Accum. Depreciation Account:</label>
              <div class="col-xs-7">
                <select class="form-control single-default select-cli" placeholder="Accum. Depreciation Account" id="" maxlength="30" name="FAPG_COA_FK_ADANo" tabindex="3">
                  <option value="" disabled selected>Accum. Depreciation Account</option>
                    <?php 
                     if(!empty($COA['data'])){
                        foreach ($COA['data'] as $key => $value) {
                    ?>
                  <option value="<?=$value['COA_Account_id']?>" ><?=$value['COA_AccountName']?></option>
                  <?php }} ?>
                </select>
              </div>
          </div>
          <div class="form-group">
              <label class="control-label col-xs-5" for=""> Depreciation Expense Account Field (Head Office):</label>
              <div class="col-xs-7">
                <select class="form-control single-default select-cli" placeholder="Depreciation Expense Account" id="" maxlength="30" name="FAPG_COA_FK_DEANo" tabindex="4">
                  <option value="" disabled selected> Depreciation Expense Account Field (Head Office)</option>
                  <?php 
                    if(!empty($COA['data'])){
                      foreach ($COA['data'] as $key => $value) {
                  ?>
                    <option value="<?=$value['COA_Account_id']?>" ><?=$value['COA_AccountName']?></option>
                  <?php }} ?>
                </select>
              </div>
          </div>
           <div class="form-group">
              <label class="control-label col-xs-5" for=""> Depreciation Expense Account Field (Stores):</label>
              <div class="col-xs-7">
                <select class="form-control single-default select-cli" placeholder="Depreciation Expense Account" id="" maxlength="30" name="FAPG_COA_FK_DEANoS" tabindex="4">
                  <option value="" disabled selected> Depreciation Expense Account Field (Stores)</option>
                  <?php 
                    if(!empty($COA['data'])){
                      foreach ($COA['data'] as $key => $value) {
                  ?>
                    <option value="<?=$value['COA_Account_id']?>" ><?=$value['COA_AccountName']?></option>
                  <?php }} ?>
                </select>
              </div>
          </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="5" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="6" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="7" href="<?= base_url() ?>app/financial-management/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
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

	$("#save-new").on("click",function(){
    var $btn = $(this);
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        
        $btn.attr('disabled',true).text('Processing..');
        form = $('#'+_class+"-form");
        data = form.serializeArray();
        data.push({name:"type",value:'add'});
        $(form).find('input[type=checkbox]').each(function() {
           data.push({ name: this.name, value: this.checked ? 1 : 0 });
         });

        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
          if(data.result == 0){
            error_message(data.errors);
          }else{
            $('.form-group').removeClass('has-error').find('div:first .alert').remove();
            form[0].reset();
            $select.each(function(){
              $(this)[0].selectize.clear();
            });
            alert('Saved!');
          }
          $btn.attr('disabled',false).text('Save & New');
        },'json').error(function(){
          alert('Error!');
          $btn.attr('disabled',false).text('Save & New');
        });
      }
    });
  });

  $("#save-close").on("click",function(){
    var $btn = $(this);
    form = $('#'+_class+"-form");
    data = form.serializeArray();
    data.push({name:"type",value:'add'});
    $(form).find('input[type=checkbox]').each(function() {
      data.push({ name: this.name, value: this.checked ? 1 : 0 });
    });

    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        $btn.attr('disabled',true).text('Processing..');
        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
          if(data.result == 0){
            error_message(data.errors);
          $btn.attr('disabled',false).text('Save & Close');
          }else{
            alert('Saved!');
            window.location = base_url+'app/'+_module+'/'+_class;
          }
        },'json').error(function(){
          alert('Error!');
          $btn.attr('disabled',false).text('Save & Close');
        });
      }
    });
  });

  $(document).on("click","#update-new",function(){
    var $btn = $(this);
    var $lbl = $btn.text();
    form = $('#'+_class+"-form");
    data = form.serializeArray();
    data.push({name:"type",value:'update'},
    		  {name:"FAPG_Active",value:'1'},
              {name:"uniqid",value:$(this).attr('data-id')});
    $(form).find('input[type=checkbox]').each(function() {
      data.push({ name: this.name, value: this.checked ? 1 : 0 });
    });
    
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        $btn.attr('disabled',true).text('Processing..');
        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
          if(data.result == 0){
            error_message(data.errors);
           $btn.attr('disabled',false).text('Save');
          }else{
            $('.form-group').removeClass('has-error').find('div:first .alert').remove();
            form[0].reset();
            $select.each(function(){
              $(this)[0].selectize.clear();
            });
            alert('Saved!');
            $nseries.trigger('proccess');
          }
          $btn.attr('disabled',false).text($lbl);
        },'json').error(function(){
          alert('Error!');
          $btn.attr('disabled',false).text($lbl);
        });
      }
    });
  });

  $(document).on("click","#update",function(){
      var $btn = $(this);
      var $lbl = $btn.text();
      form = $('#'+_class+"-form");
      data = form.serializeArray();
      data.push({name:"type",value:'update'},
      			{name:"FAPG_Active",value:'1'},
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
              window.location = base_url+'app/'+_module+'/'+_class;
            }
          },'json').error(function(){
            alert('Error!');
            $btn.attr('disabled',false).text($lbl);
          });
        }
      });
  });
</script>
					