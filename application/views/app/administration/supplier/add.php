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
						  <label for="sel1" class="control-label col-xs-5">Supplier ID:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" disabled maxlength="30" tabindex="1" name="S_DocNo" placeholder="Document No">
					      </div>
						</div>
						<!-- <div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Supplier ID:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="30" tabindex="1" name="S_Id" placeholder="Supplier ID">
					      </div>
						</div> -->
					    <div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Supplier Name:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="100" tabindex="2" name="S_Name" placeholder="Supplier Name">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Address:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="200" tabindex="3" name="S_Address" placeholder="Address">
					      </div>
						</div>						
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Country:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="25" tabindex="6" name="S_Addr_State" placeholder="Country">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Postal Code:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="25" tabindex="7" name="S_Addr_PostalCode" placeholder="Postal Code">
					      </div>
						</div>
					</span>
					<span class="col-md-6">
						<div class="form-group">
					      	<label class="control-label col-xs-5" for="">Supplier Type:</label>
					      	<div class="col-xs-7">
						      	<select class="form-control single-default select-cli" placeholder="Supplier Type" id="" name="S_SupplierType" tabindex="8">
								  	<option value="" disabled selected>Supplier Type</option>
								  	<?php 
								  			foreach (static_lookup('supplier_type') as $key => $value) {
								  	?>
								  		<option value="<?=$key?>"><?=$value?></option>
								  	<?php } ?>
								</select>
							</div>
					    </div>				    
					    <div class="form-group">
					      	<label class="control-label col-xs-5" for="">Terms:</label>
					      	<div class="col-xs-7">
						      	<select class="form-control single-default select-cli" placeholder="Terms" id="" name="S_FK_PayTerms" tabindex="9">
								  	<option value="" disabled selected>Terms</option>
								  	<?php 
								  		if(!empty($terms)){
								  			foreach ($terms['data'] as $key => $value) {
								  	?>
								  		<option value="<?=$value['PT_Id']?>"><?=$value['PT_Desc']?></option>
								  	<?php }} ?>
								</select>
							</div>
					    </div>
					    <div class="form-group">
					      	<label class="control-label col-xs-5" for="">Currency</label>
					      	<div class="col-xs-7">
						      	<select class="form-control single-default select-cli" placeholder="Currency" id="" name="S_FK_Attribute_Currency_id" tabindex="10">
								  	<option value="" disabled selected>Currency</option>
								  	<?php 
								  		if(!empty($currency)){
								  			foreach ($currency['data'] as $key => $value) {
								  	?>
								  		<option value="<?=$value['AD_Id']?>"><?=$value['AD_Desc']?></option>
								  	<?php }} ?>
								</select>
							</div>
					    </div>
					</span>
				</div>
				<div class="container-fluid">
					<legend>Contact Information</legend>
					<span class="col-md-6">
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Contact:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="100" tabindex="11" name="S_Contact" placeholder="Contact">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Telephone #:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="50" tabindex="12" name="S_TelNum" placeholder="Telephone #">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Fax #:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="50" tabindex="13" name="S_FaxNum" placeholder="Fax #">
					      </div>
						</div>
					</span>
					<span class="col-md-6">
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Email 1:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="50" tabindex="14" name="S_EmailAdd1" placeholder="Email 1">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Email 2:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="50" tabindex="15" name="S_EmailAdd2" placeholder="Email 2">
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
					        <input type="text" class="form-control" id="" maxlength="30" tabindex="16" name="S_BankAccountNo" placeholder="Bank Account #">
					      </div>
					    </div>	
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Bank Name:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="100" tabindex="17" name="S_BankName" placeholder="Bank Name">
					      </div>
					    </div>	
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Bank Address</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="100" tabindex="18" name="S_BankAddress" placeholder="Bank Address">
					      </div>
					    </div>	
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Print Check As:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="100" tabindex="19" name="S_PrintCheckAs" placeholder="Print Check As">
					      </div>
					    </div>
				    </span>
				    <span class="col-md-6">
				    	<div class="form-group">
					      <label class="control-label col-xs-5" for="">Credit Limit:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="20" name="S_CreditLimit" placeholder="Credit Limit">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Swift Code:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="50" tabindex="20" name="S_SwiftCode" placeholder="Swift Code">
					      </div>
					    </div>
				    </span>
				</div>
				<div class="container-fluid">
					<legend>Other Information</legend>
					<span class="col-md-6">
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Supplier Posting Group:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="Supplier Posting Group" id="" name="S_SupplierPostingGroup" tabindex="21">
							  	<option value="" disabled selected>Supplier Posting Group</option>
							  	<?php 
							  		if(!empty($Sup)){
							  			foreach ($Sup['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['SPG_Code'])?>"  ><?=$value['SPG_Code']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">WHT Posting Group:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="WHT Posting Group" id="" name="S_WHT_PostingGroup" tabindex="22">
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
					        <select class="form-control single-default select-cli" placeholder="VAT Posting Group" id="" name="S_Vat_PostingGroup" tabindex="23">
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
					        <input type="text" class="form-control" id="" maxlength="12" tabindex="24" name="S_TinNum" placeholder="TIN #">
					      </div>
						</div>
					</span>
				</div>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="25" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="26" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="27" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('input[name=S_TinNum]').mask("?999-999-999-9999");
	 $nseries = $('input[name=S_DocNo]').numseries({
                  target:base_url+'app/administration/supplier/getseries',
                  method:'add',
                  beforeSend:function(){
                    $('#save-new,#save-close').attr('disabled',true);
                  },
                  afterSend:function(e,data){
                  	if(data.rows == 0){
                  		alert('No series available!');
                  		setTimeout(function(){
                  			window.location = base_url + 'app/'+_module+'/supplier';
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
                        target:base_url+'app/administration/supplier/seriesmodal',
                        selecttarget:base_url+'app/administration/supplier/process',
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

        $.post(base_url+'app/administration/supplier/process',data,function(data){
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
        $.post(base_url+'app/administration/supplier/process',data,function(data){
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
    	      {name:"S_Active",value:'1'},
              {name:"uniqid",value:$(this).attr('data-id')});
    $(form).find('input[type=checkbox]').each(function() {
      data.push({ name: this.name, value: this.checked ? 1 : 0 });
    });
    
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        $btn.attr('disabled',true).text('Processing..');
        $.post(base_url+'app/administration/supplier/process',data,function(data){
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
      	        {name:"S_Active",value:'1'},
            	{name:"uniqid",value:$(this).data('id')});
      $(form).find('input[type=checkbox]').each(function() {
        data.push({ name: this.name, value: this.checked ? 1 : 0 });
      });
      
      confirm("Save Entry?", function(confirmed) {
          if(confirmed){ 
          $btn.attr('disabled',true).text('Processing..');
          $.post(base_url+'app/administration/supplier/process',data,function(data){
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
					