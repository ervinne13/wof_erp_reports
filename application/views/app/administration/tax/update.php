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
				        <input type="text" class="form-control" id="" maxlength="30" value="<?= $data['TAX_Id']; ?>" tabindex="1" name="TAX_Id" placeholder="Tax No.">
				      </div>
					</div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Description:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="100" value="<?= $data['TAX_Desc']; ?>" tabindex="2" name="TAX_Desc" placeholder="Description">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Group:</label>
				      <div class="col-xs-7">
				        <input type="checkbox" <?= $data['TAX_Group']==1?'checked':''; ?> name="TAX_Group" tabindex="3">
				      </div>
				    </div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Rate:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control dc-mal" id="" maxlength="20" value="<?= $data['TAX_Rate']; ?>" tabindex="4" name="TAX_Rate" placeholder="Rate">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Taxable:</label>
				      <div class="col-xs-7">
				        <input type="checkbox" <?= $data['TAX_Taxable']==1?'checked':''; ?>  name="TAX_Taxable" tabindex="5">
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="6" data-id="<?= $data['id']; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="7" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	 $nseries = $('input[name=TAX_Id]').numseries({
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

	$('.dc-mal').maskMoney({thousands:',', decimal:'.', allowZero:false, precision:4});
  
  	$('.dc-mal').maskMoney('mask',this.value);

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