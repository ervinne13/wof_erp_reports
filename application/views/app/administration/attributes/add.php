<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="attributes-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Code:</label>
              <div class="col-xs-7 input-group">
                <input type="text" class="form-control" id="" maxlength="30" tabindex="1" name="AD_Code" placeholder="Code">
              </div>
            </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="30" tabindex="2" name="AD_Desc" placeholder="Description">
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" id="save-new-att" tabindex="3" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" id="save-close-att" tabindex="4" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="5" href="<?= base_url() ?>app/administration/attributes/<?=$this->uri->segment(5)?>" class="btn btn-default form-btn sub-clr">
				  Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
  
  $settings =$('input[name=AD_Code]').noseries({
    target:base_url+'app/'+_module+'/'+_class,
    btn1:'save-new-att',
    repbtn1:'update-new-att',
    btn2:'save-close-att',
    repbtn2:'update-att',
    extra:'<?=$this->uri->segment(5)?>'
    });

  $select = $('.select-cli').each(function(){
                    $(this).selectize({
                      sortField: 'text',
                    });
                  });

  $(document).on("click","#update-new-att",function(){
      var $btn = $(this);
      var $lbl = $btn.text();
      form = $('#'+_class+"-form");
      data = form.serializeArray();
      data.push({name:"type",value:'update'},
                {name:"AD_FK_Code",value:'<?=$this->uri->segment(5)?>'},
                {name:"AD_Active",value:'1'},
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
            }else{
              alert('Saved!');
              $('.form-group').removeClass('has-error').find('div:first .alert').remove();
              form[0].reset();
              $('.primary input').noseries($settings.setting);
            }
            $btn.attr('disabled',false).text($lbl);
          },'json');
        }
      });
  });

  $(document).on("click","#update-att",function(){
      var $btn = $(this);
      var $lbl = $btn.text();
      form = $('#'+_class+"-form");
      data = form.serializeArray();
      data.push({name:"type",value:'update'},
                {name:"AD_FK_Code",value:'<?=$this->uri->segment(5)?>'},
                {name:"AD_Active",value:'1'},
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
            }else{
              alert('Saved!');
              window.location = base_url+'app/administration/'+_class+'/<?=$this->uri->segment(5)?>';
            }
            $btn.attr('disabled',false).text($lbl);
          },'json');
        }
      });
  });

  $("#save-new-att").on("click",function(){
    var $btn = $(this);
    var $lbl = $btn.text();
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        
        $btn.attr('disabled',true).text('Processing..');
        form = $('#'+_class+"-form");
        data = form.serializeArray();
        data.push({name:"type",value:'add'},
        		      {name:"AD_FK_Code",value:'<?=$this->uri->segment(5)?>'});
        $(form).find('input[type=checkbox]').each(function() {
           data.push({ name: this.name, value: this.checked ? 1 : 0 });
         });

        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
          if(data.result == 0){
              error_message(data.errors);
          }else{
            alert('Saved!');
             $('.form-group').removeClass('has-error').find('div:first .alert').remove();
            form[0].reset();
          }
          $btn.attr('disabled',false).text($lbl);
        },'json');
      }
    });
  });

  $("#save-close-att").on("click",function(){
    var $btn = $(this);
    var $lbl = $btn.text();
    form = $('#'+_class+"-form");
    data = form.serializeArray();
    data.push({name:"type",value:'add'},
    		  {name:"AD_FK_Code",value:'<?=$this->uri->segment(5)?>'});
    $(form).find('input[type=checkbox]').each(function() {
       data.push({ name: this.name, value: this.checked ? 1 : 0 });
     });

    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        $btn.attr('disabled',true).text('Processing..');
        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
          if(data.result == 0){
            error_message(data.errors);
          }else{
            alert('Saved!');
            window.location = base_url+'app/administration/'+_class+'/<?=$this->uri->segment(5)?>';
          }
          $btn.attr('disabled',false).text($lbl);
        },'json');
      }
    });
  });
</script>

