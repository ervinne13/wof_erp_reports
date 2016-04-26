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
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
          <div class="form-group">
              <label class="control-label col-xs-5" for="">GL Account:</label>
                <div class="col-xs-7">
                <select class="form-control single-default select-cli" placeholder="GL Account" id="" name="BA_GLAccount" tabindex="11">
                    <option value="" disabled selected> GL Account</option>
                    <?php 
                     if(!empty($COA)){
                        foreach ($COA['data'] as $key => $value) {
                    ?>
                     <option value="<?=$value['COA_Account_id']?>" <?= trim($data['BA_GLAccount'])==trim($value['COA_Account_id'])?'selected':'' ?> ><?=$value['COA_AccountName']?></option>
                    <?php }} ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Bank ID:</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="30" tabindex="1" value="<?=$data['BA_BankID']?>" name="BA_BankID" placeholder="Bank ID">
              </div>
          </div>          
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Bank Name:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" tabindex="2" value="<?=$data['BA_BankName']?>" name="BA_BankName" placeholder="Bank Name">
              </div>
          </div>
          <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Bank Account Type:</label>
                <div class="col-xs-7">
                  <select class="form-control single-default select-cli" placeholder="Bank Account Type" id="" maxlength="30" name="BA_BankAccountType" tabindex="3">
                    <option value="" disabled selected>Bank Account Type</option>
                      <?php 
                      foreach (static_lookup('account_type') as $key => $value) {
                      ?>
                        <option value="<?=$key?>" <?=$data['BA_BankAccountType']==$key?'selected':''?>> <?=$value?></option>
                      <?php } ?>
                  </select>
                </div>
            </div>        
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Bank Account No.:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="20" tabindex="4" value="<?=$data['BA_BankAccountNo']?>" name="BA_BankAccountNo" placeholder="Bank Account No.">
              </div>
          </div>
        </span> 
        <span class="col-md-4">    
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Bank Address:</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="250" tabindex="5" value="<?=$data['BA_BankAddress']?>" name="BA_BankAddress" placeholder="Address">
              </div>
          </div>    
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Contact Name:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" tabindex="7" value="<?=$data['BA_ContactName']?>" name="BA_ContactName" placeholder="Contact Name">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Contact No.:</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" tabindex="8" value="<?=$data['BA_ContactNo']?>" name="BA_ContactNo" placeholder="Contact No.">
              </div>
          </div>         
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Fax No.:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" tabindex="9" value="<?=$data['BA_FaxNo']?>" name="BA_FaxNo" placeholder="Fax No.">
              </div>
          </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Currency:</label>
              <div class="col-xs-7">
                <select class="form-control single-default select-cli" placeholder="Currency" id="" name="BA_Currency" tabindex="10">
                <option value="" disabled selected>Currency</option>
                <?php 
                  if(!empty($cur)){
                    foreach ($cur['data'] as $key => $value) {
                ?>
                  <option value="<?=$value['AD_Id']?>" <?=$data['BA_Currency']==$value['AD_Id']?'selected':''?>><?=$value['AD_Desc']?></option>
                <?php }} ?>
            </select>
             </div>
            </div>
            
        </span> 
        <span class="col-md-4">           
           <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Book Balance:</label>
             <div class="col-xs-7">
                <input type="hidden" class="form-control" id="" name="BA_BookBalance"  value="<?=$data['BA_BookBalance']?>"/>
                <input type="text" class="form-control" id="" name="BA_BookBalance" value= "0.00" tabindex="12" disabled="disabled" />
              </div>
          </div> 
           <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Date Opened:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="20" tabindex="13" value="<?=format($data['BA_DateOpened'])?>" name="BA_DateOpened" placeholder="Date Opened">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Date Closed:</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id=""  tabindex="14" value="<?=format($data['BA_DateClosed'])?>" name="BA_DateClosed" placeholder="Date Closed">
              </div>
          </div>   
          <div class="form-group">
                <label class="control-label col-xs-5" for="">Active:</label>
                <div class="col-xs-7">
                  <input type="checkbox"  tabindex="15" readonly <?=$data['BA_Active']=='1'?'checked':''?> name="BA_Active">
                </div>
          </div>     
        </span>
      <div class="container-fluid">
        <legend>Bank Account Series</legend>
      <span class="col-md-12">
        <table class="table table-striped table-hover table-bordered  table-condensed" id="bank-table">        
          <thead>
            <tr>
              <th>Reference Type</th>
              <th>No. Series Code</th>
              <th>Starting No.</th>
              <th>Ending No.</th>
              <th>Last No Used</th>
              <th>Active</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Check No (In Use)</td>
             <td><input type="text" class="form-control" id="" maxlength="30" tabindex="16"  value="<?=$data['BA_InUseCode']?>"  name="BA_InUseCode" placeholder="Code"></td>
             <td><input type="text" class="form-control" id="" maxlength="100" tabindex="17" value="<?=$data['BA_InUseStartingNo']?>" name="BA_InUseStartingNo" placeholder="Starting No."></td>
             <td><input type="text" class="form-control" id="" maxlength="20" tabindex="18" value="<?=$data['BA_InUseEndingNo']?>" name="BA_InUseEndingNo" placeholder="Ending No."></td>
             <td><input type="text" class="form-control" id="" maxlength="20" disabled tabindex="19" value="<?=$data['BA_InUseLastNoUsed']?>" name="BA_InUseLastNoUsed" placeholder="Last No. Used"></td>
             <td><input type="checkbox"  tabindex="20"  <?=$data['BA_InUseActive']=='1'?'checked':''?> name="BA_InUseActive"></td>
            </tr>
             <tr>
              <td>Check No (Reserve)</td>
                <td><input type="text" class="form-control" id="" maxlength="30" tabindex="21" value="<?=$data['BA_ReserveCode']?>" name="BA_ReserveCode" placeholder="Code"></td>
                <td><input type="text" class="form-control" id="" maxlength="100" tabindex="22" value="<?=$data['BA_ReserveStartingNo']?>" name="BA_ReserveStartingNo" placeholder="Starting No."></td>
                <td><input type="text" class="form-control" id="" maxlength="20" tabindex="23" value="<?=$data['BA_ReserveEndingNo']?>" name="BA_ReserveEndingNo" placeholder="Ending No."></td>
                <td><input type="text" class="form-control" id="" maxlength="20" disabled tabindex="24" value="<?=$data['BA_ReserveLastNoUsed']?>" name="BA_ReserveLastNoUsed" placeholder="Last No. Used"></td>
                <td><input type="checkbox"  tabindex="25"  <?=$data['BA_ReserveActive']=='1'?'checked':''?> name="BA_ReserveActive"></td>
            </tr>
             <tr>
              <td>Debit Memo</td>
                 <td><input type="text" class="form-control" id="" maxlength="30" tabindex="26" value="<?=$data['BA_DMCode']?>" name="BA_DMCode" placeholder="Code"></td>
                 <td><input type="text" class="form-control" id="" maxlength="100" tabindex="27" readonly value="<?=$data['BA_DMStartingNo']?>" name="BA_DMStartingNo" placeholder="Starting No."></td>
                 <td><input type="text" class="form-control" id="" maxlength="20" tabindex="28" readonly value="<?=$data['BA_DMEndingNo']?>" name="BA_DMEndingNo" placeholder="Ending No."></td>
                 <td><input type="text" class="form-control" id="" maxlength="20" disabled tabindex="29" value="<?=$data['BA_DMLastNoUsed']?>" name="BA_DMLastNoUsed" placeholder="Last No. Used"></td>
                 <td><input type="checkbox"  tabindex="30"  <?=$data['BA_DMActive']=='1'?'checked':''?> name="BA_DMActive"></td>
            </tr>
             <tr>
              <td>Withdrawal</td>
              <td><input type="text" class="form-control" id="" maxlength="30" tabindex="31" value="<?=$data['BA_WCode']?>" name="BA_WCode" placeholder="Code"></td>
              <td><input type="text" class="form-control" id="" maxlength="100" tabindex="32" readonly value="<?=$data['BA_WStartingNo']?>" name="BA_WStartingNo" placeholder="Starting No."></td>
              <td><input type="text" class="form-control" id="" maxlength="20" tabindex="33" readonly value="<?=$data['BA_WEndingNo']?>" name="BA_WEndingNo" placeholder="Ending No."></td>
              <td><input type="text" class="form-control" id="" maxlength="20" disabled tabindex="34" value="<?=$data['BA_WLastNoUsed']?>" name="BA_WLastNoUsed" placeholder="Last No. Used"></td>
              <td><input type="checkbox"  tabindex="35"  <?=$data['BA_WActive']=='1'?'checked':''?> name="BA_WActive"></td>
            </tr>
             <tr>
              <td>Telegraphic Transfer</td>
               <td><input type="text" class="form-control" id="" maxlength="30" tabindex="36" value="<?=$data['BA_TTCode']?>" name="BA_TTCode" placeholder="Code"></td>
               <td><input type="text" class="form-control" id="" maxlength="100" readonly tabindex="37" value="<?=$data['BA_TTStartingNo']?>" name="BA_TTStartingNo" placeholder="Starting No."></td>
               <td><input type="text" class="form-control" id="" maxlength="20" readonly tabindex="38" value="<?=$data['BA_TTEndingNo']?>" name="BA_TTEndingNo" placeholder="Ending No."></td>
               <td><input type="text" class="form-control" id="" maxlength="20" disabled tabindex="39" value="<?=$data['BA_TTLastNoUsed']?>" name="BA_TTLastNoUsed" placeholder="Last No. Used"></td>
               <td><input type="checkbox"  tabindex="40" <?=$data['BA_TTActive']=='1'?'checked':''?> name="BA_TTActive"></td>
            </tr>
          </tbody>
        </table>
      </span>
      </div>

      </form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="41" data-id="<?= $data['id']; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="42" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

$('input[name=BA_DateClosed],input[name=BA_DateOpened]').datepicker({dateFormat:'mm/dd/yy'}).mask("99/99/9999");
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
$('#bank').on('click',function(e){
  		e.preventDefault();
  		window.location =  base_url + 'app/' + _module + '/' + _class + '/bank_ledger?id=' + $(this).data('id');
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

	check_if_changed($('#' + _class + '-form'),$('#update'));
</script>