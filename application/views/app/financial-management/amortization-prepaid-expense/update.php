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
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="1" value="<?=$data['AMPH_DocNo']?>" name="AMPH_DocNo" placeholder="Document No">
                </div>
              </div> 
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Doc. Date:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" disabled maxlength="20" tabindex="2" value="<?=date("m/d/Y",time())?>" name="AMPH_DocDate" placeholder="Document Date">
                </div>
            </div> 
            <!-- <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Ref Doc.No.:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" readonly maxlength="20" tabindex="3" value="<?=$data['AMPH_RefDocNo']?>" name="AMPH_RefDocNo" placeholder="RefDocNo">
                </div>
            </div>  -->
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Ref Doc.No.:</label>
                <div class="col-xs-7">
                    <select class="form-control single-default" placeholder="Ref Doc.No." id="" maxlength="30" name="AMPH_RefDocNo" tabindex="3">
                      <option value="" disabled selected>Ref Doc.No.</option>
                        <?php 
                        if(!empty($ref['data'])){
                        foreach ($ref['data'] as $key => $value) {
                        ?>
                      <option value="<?=$value['APV_DocNo']?>" <?=$data['AMPH_RefDocNo'] == $value['APV_DocNo'] ? 'selected' : '' ?> ><?=$value['APV_DocNo']?></option>
                        <?php }} ?>
                    </select>
                </div>
            </div> 
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Amount:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control dc-mal" readonly id="" maxlength="20" tabindex="4" value="<?=$data['AMPH_AmortAmount']?>" name="AMPH_AmortAmount" placeholder="Amount">
                </div>
            </div>
           <!--  <div class="form-group">
              <label class="control-label col-xs-5" for="">Type:</label>
             <div class="col-xs-7">
                  <select class="form-control single-default select-cli" placeholder="Type" id="" maxlength="30" name="AMPH_AmortType" tabindex="5">
                    <option value="" disabled selected>Type</option>
                      <?php 
                      if(!empty($COA['data'])){
                      foreach ($COA['data'] as $key => $value) {
                      ?>
                    <option value="<?=$value['COA_Account_id']?>" <?= trim($data['AMPH_AmortType'])==trim($value['COA_Account_id'])?'selected':'' ?> ><?=$value['COA_AccountName']?></option>
                      <?php }} ?>
                  </select>
             </div>
            </div> -->
          </span>
          <span class="col-md-6">   
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Remarks:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="5" value="<?=$data['AMPH_Remarks']?>" name="AMPH_Remarks" placeholder="Remarks">
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Cost Center:</label>
                <div class="col-xs-7">
                <?php 
                $location = array_remove_duplicate_value($this->session->userdata('location'),'CPC_Id');
                if(count($location) > 1){ 
                ?>
                  <select class="form-control single-default" placeholder="Cost Center" id="" name="AMPH_CostCenter" tabindex="6">
                    <option value="" disabled selected>Cost Center</option>
                    <?php foreach ($location as $key => $value) { ?>
                      <option value="<?=$value['CPC_Id']?>"  <?= trim($data['AMPH_CostCenter'])==trim($value['CPC_Id'])?'selected':'' ?>><?=$value['CPC_Desc']?></option>
                    <?php } ?>
                  </select>
                <?php }else{ ?>
                  <input type="text" class="form-control" id="" readonly value="<?=$location[0]['CPC_Id']?>" tabindex="7" name="AMPH_CostCenter" placeholder="Location">
                <?php } ?>
                </div>
            </div>
           <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Period:</label>
                <div class="col-xs-7">
                  <select class="form-control single-default select-cli" placeholder="Period" id="" maxlength="30" name="AMPH_Period" tabindex="8">
                    <option value="" disabled selected>Period</option>
                      <?php 
                      foreach (static_lookup('period') as $key => $value) {
                      ?>
                        <option value="<?=$key?>" <?=$data['AMPH_Period']==$key?'selected':''?>> <?=$value?></option>
                      <?php } ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">No. of Period:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="9" value="<?=$data['AMPH_NoOfPayment']?>" name="AMPH_NoOfPayment" placeholder="No. of Period">
                </div>
            </div>
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Starting Date:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="10" value="<?=format($data['AMPH_StartingDate'])?>" name="AMPH_StartingDate" placeholder="Starting Date">
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
        <a type="button" tabindex="11" data-id="<?= $data['id']; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
          Save
        </a>
        <a type="button" tabindex="12" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
           Cancel
        </a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  
  var refdata = <?=json_encode($ref['data']);?>;
  
  $('input[name=AMPH_StartingDate],input[name=AMPH_StartingDate]').datepicker({dateFormat:'mm/dd/yy'});
  
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

  $('select[name=AMPH_RefDocNo]').selectize({
                  sortField: 'text',
                  onChange:function(value){
                    for (var i in refdata) {
                        if (refdata[i]["APV_DocNo"] == value) {
                          $('input[name=AMPH_AmortAmount]').val(refdata[i]["APV_Amount"]);
                        }
                    }
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

   $nseries = $('input[name=AMPH_DocNo]').numseries({
                  target:base_url+'app/'+_module+'/'+_class+'/getseries',
                  method:'update',
                  beforeSend:function(){
                    $('#save-new,#save-close').attr('disabled',true);
                  },
                  afterSend:function(e,data){
                    $('#update').attr({'disabled':false,'data-id':data.uniqid,'id':'update'});
                  },
                  sendFailed:function(){
                    $('#update').attr({'disabled':false});
                    alert('Series Generation Failed!');
                  }
              });


   var grid  = $('#sample').gridEntry({
    tableData: <?=json_encode($details['data'])?>,
    add: false,
    gridConfig:{
      minSpareRows:1,
        colHeaders:[  

                    "Date",
                    "Amount",
                    "Cost Center",
                    "Comment",           
                    ],
        columns: [
                   {
                    data: "AMPD_Date",
                    type: 'date',
                    dateFormat: 'MM/DD/YYYY',
                    strict: true,
                    readOnly:true
                    // renderer:autoCompleteRenderer
                }, {
                    data: "AMPD_Amount",
                    type: 'numeric',
                    format: '0,0.00',
                    validator: requiredValidator,
                    allowInvalid:false,
                    strict: true,
                    readOnly:true,
                },{
                    data: "AMPD_CPC",
                   readOnly:true
                },{
                    data: "AMPD_Comment",
                    renderer:autoCompleteRenderer
                    // renderer:totalTextRenderer
                },
                ],    
        }

    });
  
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
              grid.validateCells(function(){});
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