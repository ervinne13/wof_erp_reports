<div class="panel">
  <div class="panel-heading">
    <h5 class="panel-title"><?=$title?></h5>
  </div>
  <div class="panel-body">
    <div id="data-container" class="container-fluid">
      <form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
        <span class="col-md-4">

           <div class="form-group">
              <label class="control-label col-xs-5" for="">GL Account:</label>
              <div class="col-xs-7">
                  <select class="form-control single-default" placeholder="GL Account" id="" maxlength="30" name="BA_GLAccount" tabindex="11">
                    <option value="" disabled selected>GL Account</option>
                    <?php 
                     if(!empty($COA['data'])){
                        foreach ($COA['data'] as $key => $value) {
                    ?>
                     <option value="<?=$value['COA_Account_id']?>" ><?=$value['COA_AccountName']?></option>
                    <?php }} ?>
                  </select>
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Bank ID:</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" readonly id="b_id" maxlength="30" tabindex="1" name="BA_BankID" placeholder="Bank ID">
              </div>
          </div>          
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Bank Name:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control"  readonly id="b_name" maxlength="100" tabindex="2" name="BA_BankName" placeholder="Bank Name">
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
                        <option value="<?=$key?>"> <?=$value?></option>
                      <?php } ?>
                  </select>
                </div>
            </div>       
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Bank Account No.:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="20" tabindex="4" name="BA_BankAccountNo" placeholder="Bank Account No.">
              </div>
          </div>         
      </span> 
      <span class="col-md-4">  

           <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Bank Address:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="250" tabindex="5" name="BA_BankAddress" placeholder="Address">
              </div>
          </div>              
           <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Contact Name:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" tabindex="7" name="BA_ContactName" placeholder="Contact Name">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Contact No.:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" tabindex="8" name="BA_ContactNo" placeholder="Contact No.">
              </div>
          </div>      
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Fax No.:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" tabindex="9" name="BA_FaxNo" placeholder="Fax No.">
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
                      <option value="<?=trim($value['AD_Id'])?>" ><?=$value['AD_Desc']?></option>
                    <?php }} ?>
                  </select>
                </div>
          </div>

        </span>
        <span class="col-md-4"> 
           <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Book Balance:</label>
             <div class="col-xs-7">
              <input type="hidden" class="form-control" id="" name="BA_BookBalance"  value= "<?=$bal['total']?>"/>
              <input type="text" class="form-control" id="" name="BA_BookBalance" value= "0.00" tabindex="12" disabled="disabled" />
              </div>
          </div> 

           <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Date Opened:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="20" tabindex="13" name="BA_DateOpened" placeholder="Date Opened">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Date Closed:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id=""  tabindex="14" name="BA_DateClosed" placeholder="Date Closed">
              </div>
          </div>   
          <div class="form-group">
                <label class="control-label col-xs-5" for="">Active:</label>
                <div class="col-xs-7">
                  <input type="checkbox"  tabindex="15" name="BA_Active">
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
              <td><input type="text" class="form-control" id="" maxlength="30" tabindex="16" name="BA_InUseCode" placeholder="Code"></td>
              <td><input type="text" class="form-control" id="" maxlength="20" tabindex="18" name="BA_InUseStartingNo" placeholder="Ending No."></td>
              <td> <input type="text" class="form-control" id="" maxlength="20" tabindex="18" name="BA_InUseEndingNo" placeholder="Ending No."></td>
              <td>  <input type="text" class="form-control" id="" maxlength="20" tabindex="19" name="BA_InUseLastNoUsed" placeholder="Last No. Used"></td>
              <td> <input type="checkbox"  tabindex="15" name="BA_Active"></td>
            </tr>
             <tr>
              <td>Check No (Reserve)</td>
               <td><input type="text" class="form-control" id="" maxlength="30" tabindex="21" name="BA_ReserveCode" placeholder="Code"></td>
               <td><input type="text" class="form-control" id="" maxlength="100" tabindex="22" name="BA_ReserveStartingNo" placeholder="Starting No."></td>
               <td><input type="text" class="form-control" id="" maxlength="20" tabindex="23" name="BA_ReserveEndingNo" placeholder="Ending No."></td>
               <td><input type="text" class="form-control" id="" maxlength="20" tabindex="24" name="BA_ReserveLastNoUsed" placeholder="Last No. Used"></td>
               <td><input type="checkbox"  tabindex="25" name="BA_ReserveActive"></td>
            </tr>
             <tr>
              <td>Debit Memo</td>
                <td><input type="text" class="form-control" id="" maxlength="30" tabindex="26" name="BA_DMCode" placeholder="Code"></td>
                <td><input type="text" class="form-control" id="" readonly maxlength="100" tabindex="27" name="BA_DMStartingNo" placeholder="Starting No."></td>
                <td><input type="text" class="form-control" id="" readonly maxlength="20" tabindex="28" name="BA_DMEndingNo" placeholder="Ending No."></td>
                <td><input type="text" class="form-control" id="" maxlength="20" tabindex="29" name="BA_DMLastNoUsed" placeholder="Last No. Used"></td>
                <td><input type="checkbox"  tabindex="30" name="BA_DMActive"></td>
            </tr>
             <tr>
              <td>Withdrawal</td>
              <td><input type="text" class="form-control" id="" maxlength="30" tabindex="31" name="BA_WCode" placeholder="Code"></td>
              <td><input type="text" class="form-control" id="" readonly maxlength="100" tabindex="32" name="BA_WStartingNo" placeholder="Starting No."></td>
              <td><input type="text" class="form-control" id="" readonly maxlength="20" tabindex="33" name="BA_WEndingNo" placeholder="Ending No."></td>
              <td><input type="text" class="form-control" id="" maxlength="20" tabindex="34" name="BA_WLastNoUsed" placeholder="Last No. Used"></td>
              <td><input type="checkbox"  tabindex="35" name="BA_WActive"></td>
            </tr>
             <tr>
              <td>Telegraphic Transfer</td>
              <td><input type="text" class="form-control" id="" maxlength="30" tabindex="36" name="BA_TTCode" placeholder="Code"></td>
               <td><input type="text" class="form-control" id="" readonly maxlength="100" tabindex="37" name="BA_TTStartingNo" placeholder="Starting No."></td>
               <td><input type="text" class="form-control" id="" readonly maxlength="20" tabindex="38" name="BA_TTEndingNo" placeholder="Ending No."></td>
               <td><input type="text" class="form-control" id="" maxlength="20" tabindex="39" name="BA_TTLastNoUsed" placeholder="Last No. Used"></td>
               <td><input type="checkbox"  tabindex="40" name="BA_TTActive"></td>
            </tr>
          </tbody>
        </table>
      </span>
      </div>
      </form>

     </div>
      <hr>
      <div class="btn-cont">
        <a type="button" tabindex="41" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
          Save & New
        </a>
        <a type="button" tabindex="42" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
          Save & Close
        </a>
        <a type="button" tabindex="43" href="<?= base_url() ?>app/financial-management/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
           Cancel
        </a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
var accountJSON = <?= json_encode($COA['data']) ?>;
var bankaccount,$bankaccount;

$('input[name=BA_DateClosed],input[name=BA_DateOpened]').datepicker({
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

  $bankaccount = $('select[name=BA_GLAccount]').selectize({
                    sortField: 'text',
                    onItemRemove:function(value){
                        $('#b_id,#b_name').val('');
                        terms.disable();
                        terms.clear();
                        currency.disable();
                        currency.clear();
                    },
                    onChange: function(value) {
                      if (!value.length) return;
                       //var b_id = $(this)[0].getOption(value).children()[0].childNodes[1].data;
                        for(var i in accountJSON){
                          if(accountJSON[i]['COA_Account_id'] == value){
                            $('input[name=BA_BankID]').val(accountJSON[i]['COA_Account_id']);
                            $('input[name=BA_BankName]').val(accountJSON[i]['COA_AccountName']);
                            break;
                          }
                        }
                      //   $.ajax({
                      //       url: base_url + 'app/ajaxes/get_spec_data_per_account',
                      //       type: 'GET',
                      //       dataType: 'json',
                      //       data: {
                      //       q: value
                      //   },
                      //   beforeSend: function(){
                      //       $('#b_id,#b_name').val('');           
                      //       currency.disable();
                      //       currency.clear();
                      //       terms.disable();
                      //       terms.clear();
                      //       $('input[name=BA_BankID]').val('');
                      //       $('input[name=BA_BankName]').val('');
                      //       $('#save-new,#save-close').attr('disabled',true);
                      //   },
                      //   error: function() {
                      //     currency.disable();
                      //     currency.clear();
                      //     terms.disable();
                      //     terms.clear();
                      //     $('input[name=BA_BankID]').val('');
                      //     $('input[name=BA_BankName]').val('');
                      //     $('#save-new,#save-close').attr('disabled',false);
                      //   },
                      //   success: function(res) {
                      //       $('#b_id').val(res.BA_BankID);
                      //       $('#b_name').val(res.BA_BankName);
                            
                      //       $('#save-new,#save-close').attr('disabled',false);                     
                      //   }
                      // });
                    }
                  });

  bankaccount = $bankaccount[0].selectize;
  
  $("#save-new").on("click",function(){
    var $btn = $(this);
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        
        $btn.attr('disabled',true).text('Processing..');
        form = $('#'+_class+"-form");
        data = form.serializeArray();
        data.push({name:"type",value:'add'},
                  {name:"BA_BookBalance",value:'<?=$this->input->post("total")?>'});
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
          