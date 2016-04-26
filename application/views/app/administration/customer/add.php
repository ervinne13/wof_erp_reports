<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<div class="container-fluid">
					<legend>General Information</legend>
					<span class="col-md-6">
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Customer ID:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" disabled maxlength="30"  tabindex="1" name="C_DocNo" placeholder="Document No.">
					      </div>
						</div>
						<!-- <div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Customer ID:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="30"  tabindex="1" name="C_Id" placeholder="Customer ID">
					      </div>
						</div> -->
					    <div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Customer Name:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id=""  maxlength="30" tabindex="2" name="C_Name" placeholder="Customer Name">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Address:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id=""  maxlength="100"  tabindex="3" name="C_Address1" placeholder="Address">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">City:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id=""  maxlength="100" tabindex="5" name="C_Address3" placeholder="City">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Postal Code:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id=""  maxlength="30"  tabindex="6" name="C_PostalCode" placeholder="Postal Codes">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Country:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id=""  maxlength="50"   tabindex="7" name="C_Country" placeholder="Country">
					      </div>
						</div>
					</span>
					<span class="col-md-6">
						<div class="form-group">
					      	<label class="control-label col-xs-5" for="">Customer Type:</label>
					      	<div class="col-xs-7">
						      	<select class="form-control single-default select-cli" placeholder="Customer Type" id="" name="C_FK_CustomerType" tabindex="8">
								  	<option value="" disabled selected>Customer Type</option>
								  	<?php 
								  		if(!empty($ctype)){
								  			foreach ($ctype['data'] as $key => $value) {
								  	?>
								  		<option value="<?=$value['CT_Id']?>"  ><?=$value['CT_Description']?></option>
								  	<?php }} ?>
								</select>
							</div>
					    </div>
					    <div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Company Name:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id=""  maxlength="50"  tabindex="9" name="C_CompanyName" placeholder="Company Name">
					      </div>
						</div>
						<div class="form-group">
					      	<label class="control-label col-xs-5" for="">Terms:</label>
					      	<div class="col-xs-7">
						      	<select class="form-control single-default select-cli" placeholder="Terms" id="" name="C_FK_PayTerms" tabindex="10">
								  	<option value="" disabled selected>Terms</option>
								  	<?php 
								  		if(!empty($terms)){
								  			foreach ($terms['data'] as $key => $value) {
								  	?>
								  		<option value="<?=$value['PT_Id']?>" ><?=$value['PT_Desc']?></option>
								  	<?php }} ?>
								</select>
							</div>
					    </div>
					    <div class="form-group">
					      	<label class="control-label col-xs-5" for="">Bill to:</label>
					      	<div class="col-xs-7">
						      	<select class="form-control single-default select-cli" placeholder="Bill to" id="" name="C_BillTo" tabindex="11">
								  	<option value="" disabled selected>Bill to</option>
								  	<?php 
								  		if(!empty($customer)){
								  			foreach ($customer['data'] as $key => $value) {
								  	?>
								  		<option value="<?=$value['C_Id']?>" ><?=$value['C_Name']?></option>
								  	<?php }} ?>
								</select>
							</div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Bill Period:</label>
					        <div class="col-xs-7">
						      	<select class="form-control single-default select-cli" placeholder="Bill Period" id="" name="C_BillDate" tabindex="12">
								  	<option disabled selected>Bill Period</option>
								  	<option value="0"  >Monthly</option>
								  	<option value="1"  >Semi Monthly</option>
								</select>
							</div>
					    </div>
					    <!--<div class="form-group">
					      <label class="control-label col-xs-5" for="">Ship to:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id=""  tabindex="18" name="C_ShipTo" placeholder="Ship to">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Discount:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal"  id="" maxlength="34"  tabindex="32" name="C_Discount" placeholder="Discount">
					      </div>
					    </div> -->
					</span>
				</div>
				<div class="container-fluid">
					<legend>Contact Information</legend>
					<span class="col-md-6">
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Contact Name:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id=""  maxlength="100" tabindex="13" name="C_ContactName" placeholder="Contact Name">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Contact Title:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id=""  maxlength="50"  tabindex="14" name="C_ContactTitle" placeholder="Contact Title">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Email:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id=""  maxlength="50"  tabindex="15" name="C_Email" placeholder="Email">
					      </div>
						</div>
					</span>
					<span class="col-md-6">
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Telephone #:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id=""  maxlength="50"  tabindex="16" name="C_TelNum" placeholder="Telephone #">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Fax #:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id=""  maxlength="50"  tabindex="17" name="C_FaxNum" placeholder="Fax #">
					      </div>
						</div>
					</span>
				</div>
				<div class="container-fluid">
					<legend>Bank & Credit Information</legend>
					<span class="col-md-6">
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Bank Account #:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id=""  maxlength="50"  tabindex="18" name="C_AccountNo" placeholder="Account #">
					      </div>
					    </div>				   
					   <div class="form-group">
					    <label class="control-label col-xs-5" for="">Bank Name:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="100"   tabindex="19" name="C_BankName" placeholder="Bank Name">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Bank Address:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="100"  tabindex="20"  name="C_BankAddress" placeholder="Bank Address">
					      </div>
					    </div>
					</span>
					<span class="col-md-6">
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Credit Limit:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" id="" maxlength="20"  tabindex="21" name="C_CreditLimit" placeholder="Credit Limit">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Credit Balance:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" disabled id=""  maxlength="20"   placeholder="Credit Balance">
					      </div>
					    </div>
					    <div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Running Balance:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" id="" disabled maxlength="20"   placeholder="Running Balance">
					      </div>
						</div>
					</span>
				</div>
				<div class="container-fluid">
					<legend>Other Information</legend>
					<span class="col-md-6">
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Customer Posting Group:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="Customer Posting Group" id="" name="C_CustomerPostingGroup" tabindex="22">
							  	<option value="" disabled selected>Customer Posting Group</option>
							  	<?php 
							  		if(!empty($Cust)){
							  			foreach ($Cust['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['CPG_Code'])?>"  ><?=$value['CPG_Code']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">WHT Posting Group:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="WHT Posting Group" id="" name="C_WHTPostingGroup" tabindex="23">
							  	<option value="" disabled selected>WHT Posting Group</option>
							  	<?php 
							  		if(!empty($WHT)){
							  			foreach ($WHT['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['WBPG_Code'])?>"  ><?=$value['WBPG_Code']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">VAT Posting Group:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="VAT Posting Group" id="" name="C_VATPostingGroup" tabindex="24">
							  	<option value="" disabled selected>VAT Posting Group</option>
							  	<?php 
							  		if(!empty($VAT)){
							  			foreach ($VAT['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['VBPG_Code'])?>" ><?=$value['VBPG_Code']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
					</span>
					<span class="col-md-6">
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">TIN #:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="12"  tabindex="25" name="C_TIN_No" placeholder="TIN #">
					      </div>
						</div>
						<!-- <div class="form-group">
					      <label class="control-label col-xs-5" for="">Sales Rep:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="30" tabindex="24" name="C_FK_SalesRep" placeholder="Sales Rep">
					      </div>
					    </div>			
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Late Charge:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" id="" maxlength="20"   tabindex="26" name="C_LateCharge" placeholder="Late Charge">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Penalty Charge:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" id="" maxlength="20"  tabindex="27" name="C_PenaltyCharge" placeholder="Penalty Charge">
					      </div>
					    </div>
					    
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Straight Comm:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" name="C_StraightComm" tabindex="31">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Compute LC:</label>
					      <div class="col-xs-7">
					        <input type="checkbox"  name="C_ComputeLC" tabindex="32">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Compute FC:</label>
					      <div class="col-xs-7">
					        <input type="checkbox"  name="C_ComputeFC" tabindex="33">
					      </div>
					    </div>	 -->
					</span>
				</div>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="26" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="27" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="28" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('input[name=C_TIN_No]').mask("?999-999-999-9999");
	
	 $nseries = $('input[name=C_DocNo]').numseries({
                  target:base_url+'app/administration/customer/getseries',
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

	$('.dc-mal').maskMoney({thousands:',', decimal:'.', allowZero:false, precision:4});
  
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

        $.post(base_url+'app/administration/customer/process',data,function(data){
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
        $.post(base_url+'app/administration/customer/process',data,function(data){
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
    	      {name:"C_Active",value:'1'},
          	  {name:"uniqid",value:$(this).attr('data-id')});
    $(form).find('input[type=checkbox]').each(function() {
      data.push({ name: this.name, value: this.checked ? 1 : 0 });
    });
    
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        $btn.attr('disabled',true).text('Processing..');
        $.post(base_url+'app/administration/customer/process',data,function(data){
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
      	        {name:"C_Active",value:'1'},
                {name:"uniqid",value:$(this).data('id')});
      $(form).find('input[type=checkbox]').each(function() {
        data.push({ name: this.name, value: this.checked ? 1 : 0 });
      });
      
      confirm("Save Entry?", function(confirmed) {
          if(confirmed){ 
          $btn.attr('disabled',true).text('Processing..');
          $.post(base_url+'app/administration/customer/process',data,function(data){
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
					