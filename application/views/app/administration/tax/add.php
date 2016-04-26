<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Tax No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="30" tabindex="1" name="TAX_Id" placeholder="Tax No.">
				      </div>
					</div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Description:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="100" tabindex="2" name="TAX_Desc" placeholder="Description">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Group:</label>
				      <div class="col-xs-7">
				        <input type="checkbox"  name="TAX_Group" tabindex="3">
				      </div>
				    </div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Rate:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control dc-mal" value="0" id="" maxlength="20" tabindex="4" name="TAX_Rate" placeholder="Rate">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Taxable:</label>
				      <div class="col-xs-7">
				        <input type="checkbox" tabindex="5"  name="TAX_Taxable">
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" id="save-new" tabindex="6" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" id="save-close" tabindex="7"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="8" href="<?= base_url() ?>app/administration/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
  $nseries = $('input[name=TAX_Id]').numseries({
                  target:base_url+'app/'+_module+'/'+_class+'/getseries',
                  method:'add',
                  beforeSend:function(){
                    $('#save-new,#save-close').attr('disabled',true);
                  },
                  afterSend:function(e,data){
                     if(data.rows != 0){
                      $('#save-new').attr({'disabled':false,'id':'update-new'});
                      $('#save-close').attr({'disabled':false,'id':'update'});
                      $('#update-new').attr('data-id',data.uniqid);
                      $('#update').attr('data-id',data.uniqid);
                    }else{
                      $('#save-new').attr({'disabled':false});
                      $('#save-close').attr({'disabled':false});
                    }
                  },
                  sendFailed:function(){
                    $('#save-new').attr({'disabled':false});
                    $('#save-close').attr({'disabled':false});
                    alert('Series Generation Failed!');
                  },
                  modal:{
                        target:base_url+'app/'+_module+'/'+_class+'/seriesmodal',
                        selecttarget:base_url+'app/'+_module+'/'+_class+'/process',
                        afterSend:function(e,data){
                          $('#save-new').attr({'disabled':false,'id':'update-new'});
                          $('#save-close').attr({'disabled':false,'id':'update'});
                          $('#update-new').attr('data-id',data.uniqid);
                          $('#update').attr('data-id',data.uniqid);
                          },
                        }
              });

	$('.dc-mal').maskMoney({thousands:',', decimal:'.', allowZero:false, precision:4});

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
            window.location = base_url+'app/administration/'+_class;
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
    	      {name:"TAX_Active",value:'1'},
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
      	        {name:"TAX_Active",value:'1'},
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
</script>
					