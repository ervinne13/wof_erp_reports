<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?>
		</h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id="" readonly maxlength="30" tabindex="1" value="<?=$data['BR_DocNo']?>" name="BR_DocNo" placeholder="Document No.">
              </div>
          </div>          
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Doc. Date:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" tabindex="2" disabled value="<?=date("m/d/Y",time())?>" name="BR_DocDate" placeholder="Document Date">
              </div>
          </div>
           <div class="form-group">
              <label class="control-label col-xs-5" for="">Bank Account:</label>
                <div class="col-xs-7">
                <select class="form-control single-default select-cli" placeholder="Bank Account" id="" name="BR_BankAccountNo" tabindex="3">
                    <option value="" disabled selected>Bank Account</option>
                    <?php 
                     if(!empty($bank)){
                        foreach ($bank['data'] as $key => $value) {
                    ?>
                     <option value="<?=$value['BA_BankID']?>" <?=trim($data['BR_BankAccountNo'])==trim($value['BA_BankID'])?'selected':'' ?> ><?=$value['BA_BankID']?></option>
                    <?php }} ?>
              </select>
            </div>
            </div>         
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Statement No.:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="20" tabindex="4" value="<?=$data['BR_StatementNo']?>" name="BR_StatementNo" placeholder="Statement No.">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Statement Date:</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="250" tabindex="5" value="<?=format($data['BR_StatementDate'])?>" name="BR_StatementDate" placeholder="Statement Date">
              </div>
          </div>   
      </span>
      <span class="col-md-6">     
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Statement Balance</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" onkeypress="return isNumberKey(event)" maxlength="250" tabindex="6" value="<?=$data['BR_StatementBalance']?>" name="BR_StatementBalance" placeholder="Statement Balance">
              </div>
          </div>
         <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Period:</label>
                <div class="col-md-7">
                    <input type="text" class="form-control month-year-picker" id="period" tabindex="7" value="<?=$data['BR_Period']?>"  name="BR_Period">                    
                </div>
            </div>
           <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Beginning Balance:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" tabindex="8" readonly value="<?=$data['BR_BegBal']?>" name="BR_BegBal" placeholder="Beginning Balance">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">End Balance:</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" readonly tabindex="9" value="<?=$data['BR_EndBal']?>" name="BR_EndBal" placeholder="End Balance">
              </div>
          </div>       
        </span>
			</form>
      <hr>
      <div id="sample">
      </div>
      <hr>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="10" data-id="<?= $data['id']; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="11" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

var $bank,bank;

if($('#sample').length > 0){
    
    var grid  = $('#sample').gridEntry({
    tableData: <?=json_encode($details['data'])?>,
    add: false,
    gridConfig:{
      minSpareRows:1,
        contextMenu: false,
        colHeaders:[  
        
                   "Transaction Date",
                    "Ref. Doc No",
                    "Payee/Supplier",
                    "Check No.",
                    "Particulars",
                    "Debit",
                    "Credit",
                    ],
        columns: [
            {
                    data: "BRD_TransDate",
                    type: 'date',
                    dateFormat: 'MM/DD/YYYY',
                    strict: true,
                    readOnly:true
                    // renderer:autoCompleteRenderer
                },
                {
                    data: "BRD_RefNo",
                    readOnly:true
                    // renderer:autoCompleteRenderer
                }, {
                    data: "BRD_Payee",
                    readOnly:true
                    // renderer:autoCompleteRenderer
                }, {
                    data: "BRD_CheckNo",
                    readOnly:true
                    // renderer:autoCompleteRenderer
                }, {
                    data: "BRD_Particulars",
                    readOnly:true,
                    renderer:totalTextRendererDisabled
                }, {
                    data: "BRD_Debit",
                    type: 'numeric',
                    format: '0,0.00',
                    validator: requiredValidator,
                    allowInvalid:false,
                    strict: true,
                    readOnly:true,
                    renderer:renderTotalDisabled
                }, 
                {
                    data: "BRD_Credit",
                    type: 'numeric',
                    format: '0,0.00',
                    validator: requiredValidator,
                    allowInvalid:false,
                    strict: true,
                    readOnly:true,
                    renderer:renderTotalDisabled
                }, 
                ],
        }

    });

}   
   $('.month-year-picker').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'MM yy',
                    
                    onClose: function (dateText, inst) {
                        currentlySelectedMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        currentlySelectedYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).datepicker('setDate', new Date(currentlySelectedYear, currentlySelectedMonth, 1));
                       
                    }
                });

  $('input[name=BR_StatementDate]').datepicker({
    dateFormat:'mm/dd/yy'
  }).mask("99/99/9999");
    
    $('.dc-mal').autoNumeric('init',{aSep: ',',              
                   aDec: '.',
                   aForm: false}); 

 $('.month-year-picker').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function (dateText, inst) {
            currentlySelectedMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            currentlySelectedYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(currentlySelectedYear, currentlySelectedMonth, 1));                   
        },
        onSelect:function(value){
          if(value && bank.getValue()){
            var date    = value;
            var bankVal = bank.getValue();
               $.ajax({
                    url: base_url + 'app/financial-management/bank-reconciliation/get_details',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        q: bank.getValue(),
                        period : date 
                    },
                    success: function(res) {
                      console.log(res);
                      // var dates = [];
                      
                      // for(i in res.dates){
                      //   dates.push(new Date(res.dates[i]));
                      // }

                    }
                });
          }
        }
    });
  $bank = $('select[name=BR_BankAccountNo]').selectize({
                  sortField: 'text',
                  // onItemRemove:function(value){
                  //   grid.loadData();
                  // },
                    onChange: function(value) {
                      if (!value.length) return;
                      console.log('asd');
                       $.ajax({
                            url: base_url + 'app/financial-management/bank-reconciliation/get_details',
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                q: value,
                                period : $('.month-year-picker').val() 
                            },
                            error: function(){
                              // grid.loadData();
                            },
                            success: function(res) {
                              grid.loadData(res.grid.data);
                              var dates = [];
                              
                              for(i in res.dates){
                                dates.push(new Date(res.dates[i]));
                              }

                            }
                        });
                    }
              });
  
  bank = $bank[0].selectize;

  $("#update").on("click",function(){
    var $btn = $(this);
    var form = $('#'+_class+"-form");
    var $lbl = $btn.text();

    confirm("Save Entry?", function(confirmed) {
      if(confirmed){ 
      
        $btn.attr('disabled',true).text('Processing..');
        
        data = form.serializeArray();
        data.push({name:"type",value:'update'},
                {name:"uniqid",value:$btn.data('id')});
        if($('#sample').length > 0){
          data.push({name:"details",value:JSON.stringify(grid.getSourceData())});
        }

        $(form).find('input[type=checkbox]').each(function() {
          data.push({ name: this.name, value: this.checked ? 1 : 0 });
        });

        file = new FormData();

        $('.attachment').each(function(){
          if($(this)[0].files.length > 0){
          file.append('file[]', $(this)[0].files[0]);
          }
    });

    $.each(data,function(key,input){
          file.append(input.name,input.value);
      });

    $('.uploaded-att').each(function(){
      file.append('uploaded[]',$.trim($(this).text()));
    });

        $.ajax({
          url: base_url+'app/'+ _module + "/" +_class+'/process',
          type: 'POST',
          data: file,
          dataType:'json',
          processData: false,
          contentType: false,
          success: function(data) {
              if(data.result == 0){
      
              error_message(data.errors);
              if($('#sample').length > 0){
                grid.validateCells(function(){});
              }
            }else{
                alert('Saved!');
                  window.location = base_url+'app/'+_module+'/'+_class;
            }
           $btn.attr('disabled',false).text($lbl);
      },
      error:function(){
        alert('Error!');
              $btn.attr('disabled',false).text($lbl);
      }
      });
    }
    });
  });
 // check_if_changed($('#' + _class + '-form'),$('#update'));
</script>     