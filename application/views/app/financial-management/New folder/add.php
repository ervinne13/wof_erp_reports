<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">			
				    <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Document No:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="1" name="AMLH_DocNo" placeholder="Document No">
                </div>
              </div> 
           <!--  <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Document Date:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" value="<?=date("Y-m-d",time())?>" disabled maxlength="20" tabindex="2" name="AMLH_DocDate" placeholder="Document Date">
                </div>
            </div>  -->
            <!-- <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Ref Doc.No.:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="3" name="AMLH_RefDocNo" placeholder="RefDocNo">
                </div>
            </div>  -->
             <!-- <div class="form-group">
              <label class="control-label col-xs-5" for="">Type:</label>
                <div class="col-xs-7">
                  <select class="form-control single-default select-cli" placeholder="Type" id="" maxlength="30" name="AMLH_AmortType" tabindex="4">
                    <option value="" disabled selected>Type</option>
                      <?php 
                      if(!empty($COA['data'])){
                      foreach ($COA['data'] as $key => $value) {
                      ?>
                    <option value="<?=$value['COA_Account_id']?>" ><?=$value['COA_AccountName']?></option>
                      <?php }} ?>
                  </select>
               </div>
          </div> -->
           <!--  <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Amount:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="5" name="AMLH_AmortAmount" placeholder="Amount">
                </div>
            </div>
           <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Remaining Amount:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="6" name="AMLH_RemAmount" placeholder="Remaining Amount">
                </div>
            </div> -->
          </span>
          <span class="col-md-6">   
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Remarks:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="7" name="AMLH_Remarks" placeholder="Remarks">
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Cost Center:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="8" name="AMLH_CostCenter" placeholder="Cost Center">
                </div>
            </div>
           <!--  <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Period:</label>
                <div class="col-xs-7">
                  <select class="form-control single-default select-cli" placeholder="Period" id="" maxlength="30" name="AMLH_Period" tabindex="9">
                    <option value="" disabled selected>Period</option>
                      <?php 
                      foreach (static_lookup('period') as $key => $value) {
                      ?>
                        <option value="<?=$key?>"><?=$value?></option>
                      <?php } ?>
                  </select>
                </div>
            </div> -->
           <!--  <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">No. of Payment:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="10" name="AMLH_NoOfPayment" placeholder="No. of Payment">
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Starting Date:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="11" name="AMLH_StartingDate" placeholder="Starting Date">
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Status:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="12" name="AMLH_Status" placeholder="Status">
                </div>
            </div> -->
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="13" id="save-new"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="14" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="15" href="<?= base_url() ?>app/financial-management/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

 $('input[name=AMLH_StartingDate],input[name=AMLH_StartingDate]').datepicker();
	
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
					