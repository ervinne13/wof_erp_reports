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
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="30" value="<?= $data['AD_Code']?>" tabindex="1" name="AD_Code" placeholder="Code">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="30" value="<?= $data['AD_Desc']?>" tabindex="2" name="AD_Desc" placeholder="Description">
				      </div>
				    </div>
				</span>
			</form>
			<div class="btn-cont">
				<a type="button" data-id="<?= $data['id']; ?>" id="update-att" tabindex="3" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Update
				</a>
				<a type="button" tabindex="4" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?=$this->uri->segment(5)?>?id=<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>	
	</div>	
</div>	
<script type="text/javascript">
	
	$('input[name=AD_Code]').noseries({
		target:base_url+'app/'+_module+'/'+_class,
		method:'update',
		extra:'<?=$this->uri->segment(5)?>'
		});

	$select = $('.select-cli').each(function(){
                    $(this).selectize({
                      sortField: 'text',
                    });
                  });

	check_if_changed($('#attributes-form'),$('#update-att'));

	$("#update-att").on("click",function(){
	    var $btn = $(this);
	    form = $('#'+_class+"-form");
	    data = form.serializeArray();
	    data.push({name:"type",value:'update'},
	    		  {name:"AD_FK_Code",value:'<?=$this->uri->segment(5)?>'},
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
	          $btn.attr('disabled',false).text('Save & New');
	        },'json');
	      }
	    });
	});
</script>