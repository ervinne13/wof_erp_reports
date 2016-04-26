<meta http-equiv="Cache-Control" content="no-store" />
<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="company-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<div class="container-fluid">
					<legend>General Info</legend>
					<span class="col-md-6">
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Doc No.:</label>
						  <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" disabled maxlength="30" tabindex="1" name="COM_DocNo" placeholder="Document No.">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Company Id:</label>
						  <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" tabindex="2" name="COM_Id" placeholder="Company ID">
					      </div>
						</div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Company Name:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="100" tabindex="3" name="COM_Name" placeholder="Company Name">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Address:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="200" tabindex="4" name="COM_Address" placeholder="Address">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Phone #:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" tabindex="5" name="COM_PhoneNo" placeholder="Phone #">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Fax #:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" tabindex="6" name="COM_FaxNum" placeholder="Fax #">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Email:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="50" tabindex="7" name="COM_Email" placeholder="Email">
					      </div>
					    </div>
					</span>
					<span class="col-md-6">
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Business Type:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="50" tabindex="8" name="COM_BusinessType" placeholder="Business Type">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Website:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="50" tabindex="9" name="COM_Website" placeholder="Website">
					      </div>
					    </div>
					     <div class="form-group">
					      <label class="control-label col-xs-5" for="">SSS #:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" tabindex="10" name="COM_SSSNo" placeholder="SSS #">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Philhealth #:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" tabindex="11" name="COM_PhilhealthNo" placeholder="Philhealth #">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Pag-ibig #:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" tabindex="12" name="COM_PagibigNo" placeholder="Pag-ibig #">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">TIN #:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="12" tabindex="13" name="COM_Tin" placeholder="TIN #">
					      </div>
					    </div>
					</span>
				</div>
				<div class="container-fluid">
					<legend>Setup</legend>
					<span class="col-md-6">
					     <div class="form-group">
					      <label class="control-label col-xs-5" for="">Fiscal Year Start:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" tabindex="14" name="COM_FY_Start" placeholder="Fiscal Year Start">
					      </div>
					    </div>
					    <!-- <div class="form-group">
					      <label class="control-label col-xs-5" for="">Prepared By:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" tabindex="15" name="COM_PAY_PreparedBy" placeholder="Prepared By">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Approved By:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" tabindex="16" name="COM_PAY_ApprovedBy" placeholder="Approved By">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Bank Account:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" tabindex="17" name="COM_PAY_BankAccount" placeholder="Bank Account">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Work Days:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" tabindex="18" name="COM_PAY_WorkDays" placeholder="Work Days">
					      </div>
					    </div> -->
					</span>
					<span class="col-md-6">
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Fiscal Year End:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" tabindex="15" name="COM_FY_End" placeholder="Fiscal Year End">
					      </div>
					    </div>
					    <!-- <div class="form-group">
					      <label class="control-label col-xs-5" for="">Init End Year:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="19" name="COM_InitEndYear">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Tax Deduct:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="20" name="COM_Pay_TaxDeduct">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">SSS Deduct:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="21" name="COM_PAY_SSSDeduct">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Pagibig Deduct:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="22" name="COM_PAY_PagibigDeduct">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Phil Health Deduct:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="23" name="COM_PAY_PhilhealthDeduct">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Username:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" tabindex="16" name="COM_COM_CompanyUserId" placeholder="Username">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Password:</label>
					      <div class="col-xs-7">
					        <input type="password"  class="form-control" id="" tabindex="17" name="COM_COM_CompanyPassword" placeholder="Password">
					      </div>
					    </div> -->
					     <div class="form-group">
					      <label class="control-label col-xs-5" for="">Currency:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="Currency" id="" name="COM_Currency" tabindex="16">
							  	<option value="" disabled selected>Currency</option>
							  	<?php 
							  		if(!empty($cur)){
							  			foreach ($cur['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['AD_Id'])?>" ><?=$value['AD_Desc']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
					</span>
				</div>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" id="save-new"  tabindex="17" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" id="save-close" tabindex="18"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="19" href="<?= base_url() ?>app/administration/company" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('input[name=COM_FY_Start],input[name=COM_FY_End]').datepicker({
		dateFormat:'mm/dd/yy'
	}).mask("99/99/9999");
  
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

  $nseries = $('input[name=COM_DocNo]').numseries({
                  target:base_url+'app/'+_module+'/'+_class+'/getseries',
                  method:'add',
                  beforeSend:function(){
                    $('#save-new,#save-close').attr('disabled',true);
                  },
                  afterSend:function(e,data){
                  	if(data.rows == 0){
                  		alert('No series available!');
                  		setTimeout(function(){
                  			window.location = base_url + 'app/' + _module + '/' + _class;
                  		},1000);
                  	}else{
	                    $('#save-new').attr({'disabled':false,'id':'update-new'});
	                    $('#save-close').attr({'disabled':false,'id':'update'});
	                    $('#update-new').attr('data-id',data.uniqid);
	                    $('#update').attr('data-id',data.uniqid);
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
    	      {name:"COM_Active",value:'1'},
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
            $nseries.trigger('proccess')
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
      	        {name:"COM_Active",value:'1'},
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