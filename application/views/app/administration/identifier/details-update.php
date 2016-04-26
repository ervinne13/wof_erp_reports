<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="identifier-details-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Description:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="<?=$data['IDD_Description']?>" tabindex="2" name="IDD_Description" placeholder="Description">
				      </div>
					</div>
					<div class="form-group">
			            <label for="sel1" class="control-label col-xs-5">Sub Category:</label>
			            <div class="col-xs-7">
			              <select class="form-control single-default select-cli" placeholder="Sub Category" id="" name="IDD_FK_SubCategory_id" tabindex="3">
			                <option value="" disabled selected>Sub Category</option>
			                <?php 
			                  if(!empty($subcategory['data'])){
			                    foreach ($subcategory['data'] as $key => $value) {
			                ?>
			                  <option value="<?=$value['SC_Id']?>" <?=$value['SC_Id']==$data['IDD_FK_SubCategory_id']?'selected':''?> ><?=$value['SC_Description']?></option>
			                <?php }} ?>
			              </select>
			            </div>
			          </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="10" data-id="<?= $data['mid']; ?>" data-loc="<?=$data['id']?>" id="update-det" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="11" href="<?= base_url() ?>app/administration/<?=$this->uri->segment(3)?>/dback/?id=<?=$data['id']?>&mid=<?=$data['mid']?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	$(document).on("click","#update-det",function(){
	    var $btn = $(this);
	    var $lbl = $btn.text();
	    form = $('#identifier-details-form');
	    data = form.serializeArray();
	    data.push({name:"type",value:'update-details'},
	          	{name:"uniqid",value:$(this).data('id')},
	          	{name:"uniqfid",value:$(this).data('loc')});
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
	            window.location = base_url+'app/administration/'+_class+'/view/?id='+$btn.data('loc');
	          }
	        },'json').error(function(){
	          alert('Error!');
	          $btn.attr('disabled',false).text($lbl);
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

	check_if_changed($('#identifier-details-form'),$('#update-det'));

</script>