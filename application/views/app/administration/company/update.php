<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?>
			<?php if($functions){ ?>	
          	<span class="dropdown pull-right">
				<a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			    	Functions
			    	<span class="caret"></span>
			  	</a>
			  	<ul class="dropdown-menu functions" role="menu" aria-labelledby="dropdownMenu1">
			  		<li>
			  			<?=$functions?>
			  		</li>
			  	</ul>
			</span>
			<?php } ?>
		</h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="company-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<div class="container-fluid">
					<legend>General Info</legend>
					<span class="col-md-6">
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
						  <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" disabled maxlength="30" value="<?=$data['COM_DocNo']?>" tabindex="1"  placeholder="Document No.">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Company Id:</label>
						  <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" value="<?=$data['COM_Id']?>" tabindex="2" name="COM_Id" placeholder="Company ID">
					      </div>
						</div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Company Name:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="100"value="<?=$data['COM_Name']?>" tabindex="3" name="COM_Name" placeholder="Company Name">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Address:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="200" value="<?=$data['COM_Address']?>" tabindex="4" name="COM_Address" placeholder="Address">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Phone #:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" value="<?=$data['COM_PhoneNo']?>" tabindex="5" name="COM_PhoneNo" placeholder="Phone #">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Fax #:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30"  value="<?=$data['COM_FaxNum']?>" tabindex="6" name="COM_FaxNum" placeholder="Fax #">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Email:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="50" value="<?=$data['COM_Email']?>" tabindex="7" name="COM_Email" placeholder="Email">
					      </div>
					    </div>
					</span>
					<span class="col-md-6">
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Business Type:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="50" value="<?=$data['COM_BusinessType']?>" tabindex="8" name="COM_BusinessType" placeholder="Business Type">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Website:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="50" value="<?=$data['COM_Website']?>" tabindex="9" name="COM_Website" placeholder="Website">
					      </div>
					    </div>
					     <div class="form-group">
					      <label class="control-label col-xs-5" for="">SSS #:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" value="<?=$data['COM_SSSNo']?>" tabindex="10" name="COM_SSSNo" placeholder="SSS #">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Philhealth #:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" value="<?=$data['COM_PhilhealthNo']?>" tabindex="11" name="COM_PhilhealthNo" placeholder="Philhealth #">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Pag-ibig #:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" value="<?=$data['COM_PagibigNo']?>"  tabindex="12" name="COM_PagibigNo" placeholder="Pag-ibig #">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">TIN #:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="12" value="<?=$data['COM_Tin']?>" tabindex="13" name="COM_Tin" placeholder="TIN #">
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
					        <input type="text"  class="form-control" id="" value="<?=format($data['COM_FY_Start'])?>" tabindex="14" name="COM_FY_Start" placeholder="Fiscal Year Start">
					      </div>
					    </div>
					    <!--  <div class="form-group">
					      <label class="control-label col-xs-5" for="">Prepared By:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" value="<?=$data['COM_PAY_PreparedBy']?>" tabindex="15" name="COM_PAY_PreparedBy" placeholder="Prepared By">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Approved By:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" maxlength="30" value="<?=$data['COM_PAY_ApprovedBy']?>" tabindex="16" name="COM_PAY_ApprovedBy" placeholder="Approved By">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Bank Account:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" value="<?=$data['COM_PAY_BankAccount']?>" tabindex="17" name="COM_PAY_BankAccount" placeholder="Bank Account">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Work Days:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" value="<?=$data['COM_PAY_WorkDays']?>" tabindex="18" name="COM_PAY_WorkDays" placeholder="Work Days">
					      </div>
					    </div> -->
					</span>
					<span class="col-md-6">
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Fiscal Year End:</label>
					      <div class="col-xs-7">
					        <input type="text"  class="form-control" id="" value="<?=format($data['COM_FY_End'])?>" tabindex="15" name="COM_FY_End" placeholder="Fiscal Year End">
					      </div>
					    </div>
					    <!-- <div class="form-group">
					      <label class="control-label col-xs-5" for="">Init End Year:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="19" <?=$data['COM_InitEndYear']==1?'checked':''?> name="COM_InitEndYear">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Tax Deduct:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="20" <?=$data['COM_Pay_TaxDeduct']==1?'checked':''?> name="COM_Pay_TaxDeduct">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">SSS Deduct:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="21" <?=$data['COM_PAY_SSSDeduct']==1?'checked':''?> name="COM_PAY_SSSDeduct">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Pagibig Deduct:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="22" <?=$data['COM_PAY_PagibigDeduct']==1?'checked':''?> name="COM_PAY_PagibigDeduct">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Phil Health Deduct:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="23"  <?=$data['COM_PAY_PhilhealthDeduct']==1?'checked':''?> name="COM_PAY_PhilhealthDeduct">
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
							  		<option value="<?=trim($value['AD_Id'])?>" <?=trim($data['COM_Currency'])==trim($value['AD_Id']) ? 'selected': '' ?>  ><?=$value['AD_Desc']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
					</span>
				</div>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="17" data-id="<?= md5($data['COM_DocNo']); ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button"  tabindex="18" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= md5($data['COM_DocNo']); ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	var updates = <?=$data['COM_Updates']?>;

	$(document).ready(function(){
		for(var i in updates){
			$('[name='+i+']').closest('.form-group').addClass('alert-danger');
		}
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

	$('input[name=COM_FY_Start],input[name=COM_FY_End]').datepicker({
		dateFormat:'mm/dd/yy'
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
              window.location = base_url+'app/administration/'+_class;
            }
          },'json').error(function(){
            alert('Error!');
            $btn.attr('disabled',false).text($lbl);
          });
        }
      });
  	});

	$('input[name=c_fy_start],input[name=c_fy_end]').datepicker();
	check_if_changed($('#' + _class + '-form'),$('#update'));
</script>	