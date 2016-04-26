<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="prepaid-expense-details-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">				   
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Comment:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="3" name="AMPD_Comment" placeholder="Comment">
                </div>
            </div>
          </span>
          
			</form>
			<hr>
			<div class="btn-cont">
        <a type="button" tabindex="10" id="save-new-det" data-id="<?=$id?>" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
          Save & New
        </a>
        <a type="button" tabindex="11" id="save-close-det" data-id="<?=$id?>" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
          Save & Close
        </a>
        <a type="button" tabindex="12" href="<?= base_url() ?>app/financial-management/<?=$this->uri->segment(3)?>/view/?id=<?=$id?>" class="btn btn-default form-btn sub-clr">
           Cancel
        </a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  
 $("#save-new-det").on("click",function(){
    var $btn = $(this);
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        
        $btn.attr('disabled',true).text('Processing..');
        form = $('#prepaid-expense-details-form');
        data = form.serializeArray();
        data.push({name:"type",value:'add-details'},
              {name:"AMPD_FK_DocNo",value:$btn.data('id')});
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

  $("#save-close-det").on("click",function(){
    var $btn = $(this);
    form = $('#prepaid-expense-details-form');
    data = form.serializeArray();
     data.push({name:"type",value:'add-details'},
               {name:"AMPD_FK_DocNo",value:$btn.data('id')});
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
            window.location = base_url+'app/financial_management/'+_class+'/view/?id='+$btn.data('id');
          }
        },'json').error(function(){
          alert('Error!');
          $btn.attr('disabled',false).text('Save & Close');
        });
      }
    });
  });
  
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