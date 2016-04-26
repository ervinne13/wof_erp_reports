<div id="data-container" class="container-fluid">
  <form id="amortization-form" class="form-horizontal row page-form" role="form" class="container-fluid">
    <span class="col-md-6">     
        <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Document No:</label>
            <div class="col-xs-7">
                <input type="text" class="form-control" id=""  maxlength="20" tabindex="1" name="AMPH_DocNo" placeholder="Document No">
            </div>
          </div> 
        <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Document Date:</label>
            <div class="col-xs-7">
                <input type="text" class="form-control" id="" disabled value="<?=date("Y-m-d",time())?>" disabled maxlength="20" tabindex="2" name="AMPH_DocDate" placeholder="Document Date">
            </div>
        </div> 

        <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Ref Doc.No.:</label>
            <div class="col-xs-7">
                <input type="text" class="form-control" readonly id="" value="<?=$data['CV_DocNo']?>" maxlength="20" tabindex="3" name="AMPH_RefDocNo" placeholder="RefDocNo">
            </div>
        </div> 
        <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Amount:</label>
            <div class="col-xs-7">
                <input type="text" class="form-control dc-mal" value="<?=$data['CV_CheckAmount']?>" readonly id="" maxlength="20" tabindex="4" name="AMPH_AmortAmount" placeholder="Amount">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-5" for="">Type:</label>
            <div class="col-xs-7">
              <select class="form-control single-default select-cli" placeholder="Type" id="" maxlength="30" name="AMPH_AmortType" tabindex="5">
                <option value="" disabled selected>Type</option>
                  <?php 
                  if(!empty($COA['data'])){
                  foreach ($COA['data'] as $key => $value) {
                  ?>
                <option value="<?=$value['COA_Account_id']?>" ><?=$value['COA_AccountName']?></option>
                  <?php }} ?>
              </select>
            </div>
        </div>
      </span>
      <span class="col-md-6">   
        <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Remarks:</label>
            <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="20" tabindex="6" name="AMPH_Remarks" placeholder="Remarks">
            </div>
        </div>
        <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Cost Center:</label>
            <div class="col-xs-7">
            <?php 
            $location = array_remove_duplicate_value($this->session->userdata('location'),'CPC_Id');
            if(count($location) > 1){ 
            ?>
              <select class="form-control single-default" placeholder="Location" id="" name="AMPH_CostCenter" tabindex="7">
                <option value="" disabled selected>Cost Center</option>
                <?php foreach ($location as $key => $value) { ?>
                  <option value="<?=$value['CPC_Id']?>"><?=$value['CPC_Desc']?></option>
                <?php } ?>
              </select>
            <?php }else{ ?>
              <input type="text" class="form-control" id="" readonly value="<?=$location[0]['CPC_Id']?>" tabindex="8" name="AMPH_CostCenter" placeholder="Location">
            <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Period:</label>
            <div class="col-xs-7">
              <select class="form-control single-default select-cli" placeholder="Period" id="" maxlength="30" name="AMPH_Period" tabindex="9">
                <option value="" disabled selected>Period</option>
                  <?php 
                  foreach (static_lookup('period') as $key => $value) {
                  ?>
                    <option value="<?=$key?>"> <?=$value?></option>
                  <?php } ?>
              </select>
            </div>
        </div>
        <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">No. of Payment:</label>
            <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="20" tabindex="10" name="AMPH_NoOfPayment" placeholder="No. of Payment">
            </div>
        </div>
        <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Starting Date:</label>
            <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="20" tabindex="11" name="AMPH_StartingDate" placeholder="Starting Date">
            </div>
        </div>
    </span>
  </form>
</div>
<script type="text/javascript">

 $('input[name=AMPH_StartingDate],input[name=AMPH_StartingDate]').datepicker({dateFormat:'yy-mm-dd'});

  if($('select[name=AMPH_CostCenter]').length > 0){
      $('select[name=AMPH_CostCenter]').selectize({
                  sortField: 'text',
                  plugins: {
                      'dropdown_header': {
                        title: 'Cost Profit Center'
                      }
                    }
                });
  }
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

  $nseries = $('input[name=AMPH_DocNo]').numseries({
                  target:base_url+'app/financial-management/amortization-prepaid-expense/getseries',
                  method:'add',
                  beforeSend:function(){
                    $('#create-ammort').attr('disabled',true);
                  },
                  afterSend:function(e,data){
                    $('#create-ammort').attr({'disabled':false});
                    $('#create-ammort').attr('data-id',data.uniqid);
                  },
                  sendFailed:function(){
                    $('#create-ammort').attr({'disabled':false});
                    alert('Series Generation Failed!');
                  },
              }); 

  $(document).on("click","#create-ammort",function(){
    var $btn = $(this);
    var $lbl = $btn.text();
    form = $('#amortization-form');
    data = form.serializeArray();
    data.push({name:"type",value:'update'},
              {name:"uniqid",value:$(this).attr('data-id')},
              {name:"AMPH_Status",value:'Open'},
              {name:"AMPH_RequestedBy",value:'<?=$this->session->userdata("U_User_id") ?>'});
 
  
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        $btn.attr('disabled',true).text('Processing..');
        $.post(base_url+'app/financial-management/amortization-prepaid-expense/process',data,function(data){
          if(data.result == 0){
            error_message(data.errors);
           $btn.attr('disabled',false).text('Save');
          }else{
            location.reload();
          }
          $btn.attr('disabled',false).text($lbl);
        },'json').error(function(){
          alert('Error!');
          $btn.attr('disabled',false).text($lbl);
        });
      }
    });
  });

</script>
					