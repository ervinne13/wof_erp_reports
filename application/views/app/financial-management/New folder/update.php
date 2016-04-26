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
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="1" value="<?=$data['AMLH_DocNo']?>" name="AMLH_DocNo" placeholder="Document No">
                </div>
              </div> 
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Document Date:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" disabled maxlength="20" tabindex="2" value="<?=$data['AMLH_DocDate']?>"  name="AMLH_DocDate" placeholder="Document Date">
                </div>
            </div> 
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Ref Doc.No.:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="3" value="<?=$data['AMLH_RefDocNo']?>" name="AMLH_RefDocNo" placeholder="RefDocNo">
                </div>
            </div> 
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Type:</label>
             <div class="col-xs-7">
                  <select class="form-control single-default select-cli" placeholder="Type" id="" maxlength="30" name="AMLH_AmortType" tabindex="4">
                    <option value="" disabled selected>Type</option>
                      <?php 
                      if(!empty($COA['data'])){
                      foreach ($COA['data'] as $key => $value) {
                      ?>
                    <option value="<?=$value['COA_Account_id']?>" <?= trim($data['AMLH_AmortType'])==trim($value['COA_Account_id'])?'selected':'' ?> ><?=$value['COA_AccountName']?></option>
                      <?php }} ?>
                  </select>
             </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Amount:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="5" value="<?=$data['AMLH_AmortAmount']?>" name="AMLH_AmortAmount" placeholder="Amount">
                </div>
            </div>
           <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Remaining Amount:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="6" value="<?=$data['AMLH_RemAmount']?>" name="AMLH_RemAmount" placeholder="Remaining Amount">
                </div>
            </div>
          </span>
          <span class="col-md-6">   
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Remarks:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="7" value="<?=$data['AMLH_Remarks']?>" name="AMLH_Remarks" placeholder="Remarks">
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Cost Center:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="8" value="<?=$data['AMLH_CostCenter']?>" name="AMLH_CostCenter" placeholder="Cost Center">
                </div>
            </div>
           <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Period:</label>
                <div class="col-xs-7">
                  <select class="form-control single-default select-cli" placeholder="Period" id="" maxlength="30" name="AMLH_Period" tabindex="9">
                    <option value="" disabled selected>Period</option>
                      <?php 
                      foreach (static_lookup('period') as $key => $value) {
                      ?>
                        <option value="<?=$key?>" <?=$data['AMLH_Period']==$key?'selected':''?>> <?=$value?></option>
                      <?php } ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">No. of Payment:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="10" value="<?=$data['AMLH_NoOfPayment']?>" name="AMLH_NoOfPayment" placeholder="No. of Payment">
                </div>
            </div>
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Starting Date:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="11" value="<?=$data['AMLH_StartingDate']?>" name="AMLH_StartingDate" placeholder="Starting Date">
                </div>
            </div>
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Status:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="12" value="<?=$data['AMLH_Status']?>" name="AMLH_Status" placeholder="Status">
                </div>
            </div>
        </span>
      </form>
      <hr>
      <div class="btn-cont">
        <a type="button" tabindex="13" data-id="<?= $data['id']; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
          Save
        </a>
        <a type="button" tabindex="14" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
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