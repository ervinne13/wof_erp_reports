
<div class="panel">
  <div class="panel-heading">
    <h5 class="panel-title"><?=$title?></h5>
  </div>
  <div class="panel-body">
    <div id="data-container" class="container-fluid">
      <form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
        <span class="col-md-6">
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="30" tabindex="1" name="BR_DocNo" placeholder="Document No">
              </div>
          </div>          
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Doc. Date:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="30" tabindex="2"  value="<?=date("m/d/Y",time())?>" disabled name="BR_DocDate" placeholder="Document Date">
              </div>
          </div>
           <div class="form-group">
              <label class="control-label col-xs-5" for="">Bank Account:</label>
              <div class="col-xs-7">
                  <select class="form-control single-default select-cli" placeholder="Bank Account" id="" maxlength="30" name="BR_BankAccountNo" tabindex="3">
                    <option value="" disabled selected>Bank Account</option>
                    <?php 
                     if(!empty($bank['data'])){
                        foreach ($bank['data'] as $key => $value) {
                    ?>
                     <option value="<?=$value['BA_BankID']?>" ><?=$value['BA_BankID']?></option>
                    <?php }} ?>
                  </select>
              </div>
          </div> 
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Statement No.:</label>
              <div class="col-xs-7">
              <input type="text" class="form-control" id="" maxlength="20" tabindex="4" name="BR_StatementNo" placeholder="Statement No.">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Statement Date:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="5" name="BR_StatementDate" placeholder="Statement Date">
              </div>
          </div>  
      </span>
      <span class="col-md-6">      
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Statement Balance</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id=""  maxlength="20" tabindex="6" name="BR_StatementBalance" placeholder="Statement Balance">
              </div>
          </div>
           <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Period:</label>
                <div class="col-md-7">
                    <input type="text" class="form-control month-year-picker" id="period" tabindex="7" name="BR_Period" placeholder="Period">                    
                </div>
            </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Beginning Balance:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" readonly  maxlength="100" tabindex="8" value ="0.00" name="BR_BegBal" placeholder="Beginning Balance">
              </div>
          </div>
           <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Ending Balance:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" readonly  maxlength="100" tabindex="9" value ="0.00" name="BR_EndBal" placeholder="Ending Balance">
              </div>
          </div>               
        
        </span>
          <legend>Details</legend>
      </form>
      <hr>
      <div id="sample">
      </div>
      <hr>
      <hr>
      <div class="btn-cont">
        <a type="button" tabindex="10" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
          Save & New
        </a>
        <a type="button" tabindex="11" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
          Save & Close
        </a>
        <a type="button" tabindex="12" href="<?= base_url() ?>app/financial-management/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
           Cancel
        </a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  
  var $bank,bank;
 // $select = $('.select-cli').each(function(index, obj){
 //                $(this).selectize({
 //                  sortField: 'text',
 //                  plugins: {
 //            'dropdown_header': {
 //             title: $(obj).attr('placeholder')
 //            }
 //         }
 //                });
 //              });
  var grid  = $('#sample').gridEntry({
    add:false,
    gridConfig:{
      minSpareRows:1,
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
                    renderer:totalTextRenderer1
                }, {
                    data: "BRD_Debit",
                    type: 'numeric',
                    format: '0,0.00',
                    validator: requiredValidator,
                    allowInvalid:false,
                    strict: true,
                    readOnly:true,
                    renderer:renderTotal
                },{
                    data: "BRD_Credit",
                    type: 'numeric',
                    format: '0,0.00',
                    validator: requiredValidator,
                    allowInvalid:false,
                    strict: true,
                    readOnly:true,
                    renderer:renderTotal                  
                },
                ],
                 // afterChange: function (change, source) {
                 //        if (change !== null || source != 'loadData') {
                 //            if ($.inArray(change[0][1], ['BRD_Credit']) != -1) {

                 //                var credit = this.getDataAtRowProp(change[0][0], 'BRD_Credit') || 0;       
                                
                 //                // this.setDataAtRowProp(change[0][0], 'BRD_Debit', 0);
                 //                // this.setDataAtRowProp(change[0][0], 'BRD_Credit', credit);
                 //            }
                            
                 //            if ($.inArray(change[0][1], ['BRD_Debit']) != -1) {

                 //                var debit = this.getDataAtRowProp(change[0][0], 'BRD_Debit') || 0;

                 //            }
                 //      }

                 //  }
        }

    });

  $('.dc-mal').autoNumeric('init',{aSep: ',',              
                  aDec: '.'}); 

  $('input[name=BR_StatementDate]').datepicker({
   dateFormat:'mm/dd/yy'
  }).mask("99/99/9999");

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

 $nseries = $('input[name=BR_DocNo]').numseries({
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

  $(document).on("click","#update-new",function(){
    var $btn = $(this);
    var $lbl = $btn.text();
    var form = $('#'+_class+"-form");
  
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){

         $btn.attr('disabled',true).text('Processing..');
          data = form.serializeArray();

          data.push({name:"type",value:'update'},
                    {name:"uniqid",value:$btn.data('id')},
                    {name:"details",value:JSON.stringify(grid.getSourceData())});

          file = new FormData();

          $('.attachment').each(function(){
          if($(this)[0].files.length > 0){
            file.append('file[]', $(this)[0].files[0]);
            }
      });

          $(form).find('input[type=checkbox]').each(function() {
             data.push({ name: this.name, value: this.checked ? 1 : 0 });
          });

      $.each(data,function(key,input){
            file.append(input.name,input.value);
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
              }else{
                location.reload();
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

  $(document).on("click","#update",function(){
      var $btn = $(this);
      var $lbl = $btn.text();
      var form = $('#'+_class+"-form");
      
      confirm("Save Entry?", function(confirmed) {
          if(confirmed){ 
          
            $btn.attr('disabled',true).text('Processing..');
            data = form.serializeArray();
            
            data.push({name:"type",value:'update'},
                      {name:"uniqid",value:$btn.data('id')},
                      {name:"details",value:JSON.stringify(grid.getSourceData())} );

            file = new FormData();

            $('.attachment').each(function(){
            if($(this)[0].files.length > 0){
              file.append('file[]', $(this)[0].files[0]);
              }
        });

            $(form).find('input[type=checkbox]').each(function() {
               data.push({ name: this.name, value: this.checked ? 1 : 0 });
            });

        $.each(data,function(key,input){
              file.append(input.name,input.value);
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
              }else{
                alert('Saved!');
                    window.location = base_url+'app/' +_module+ '/'+_class;
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

</script>     

          