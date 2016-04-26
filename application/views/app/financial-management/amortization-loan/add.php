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
                    <input type="text" class="form-control" id=""  maxlength="20" tabindex="1" name="AMLH_DocNo" placeholder="Document No">
                </div>
              </div> 
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Doc. Date:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" value="<?=date("m/d/Y",time())?>" disabled maxlength="20" tabindex="2" name="AMLH_DocDate" placeholder="Document Date">
                </div>
            </div> 
            <div class="form-group">
                <label class="control-label col-xs-5" for="">Bank Account:</label>
                <div class="col-xs-7">
                  <select class="form-control single-default select-cli" placeholder="Bank Account" id="" maxlength="30" name="AMLH_BankAccount" tabindex="3">
                    <option value="" disabled selected>Bank Account</option>
                      <?php 
                      if(!empty($BA['data'])){
                      foreach ($BA['data'] as $key => $value) {
                      ?>
                    <option value="<?=$value['BA_BankID']?>" ><?=$value['BA_BankName']?></option>
                      <?php }} ?>
                  </select>
                </div>
            </div>
              <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Loan Amount:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id=""  maxlength="20" tabindex="4" name="AMLH_LoanAmount" placeholder="Loan Amount">
                </div>
              </div> 
              <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">External DocNo:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id=""  maxlength="20" tabindex="5" name="AMLH_ExtDocNo" placeholder="External DocNo">
                </div>
              </div> 
               <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Remarks.:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="6" name="AMLH_Remarks" placeholder="Remarks">
                </div>
            </div> 
        </span>
        <span class="col-md-6">             
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">No. of Months:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="7" name="AMLH_NoOfMonths" placeholder="No. of Months">
                </div>
            </div>
          </span>
          <span class="col-md-6">   
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Annual Interest Rate:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="8" name="AMLH_AnnualInterestRate" placeholder="Annual Interest Rate">
                </div>
            </div> 
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Prevailing Interest Rate:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="9" name="AMLH_PrevailingInterestRate" placeholder="Prevailing Interest Rate">
                </div>
            </div> 
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Date Received:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="20" tabindex="10" name="AMLH_DateReceived" placeholder="Date Received">
                </div>
            </div>                
            <div class="form-group">
                <label class="control-label col-xs-5" for="">Company:</label>
                <div class="col-xs-7">
                  <select class="form-control single-default select-cli" placeholder="Company" id="" maxlength="30" name="AMLH_Company" tabindex="11">
                    <option value="" disabled selected>Company</option>
                      <?php 
                      if(!empty($Com['data'])){
                      foreach ($Com['data'] as $key => $value) {
                      ?>
                    <option value="<?=$value['COM_Id']?>" <?=$this->session->userdata('dlocation')['SP_FK_CompanyID'] == $value['COM_Id'] ? 'selected' : '' ?> ><?=$value['COM_Name']?></option>
                      <?php }} ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-5" for="">Cost Center:</label>
                <div class="col-xs-7">
                  <select class="form-control single-default select-cli" placeholder="Cost Center" id="" maxlength="30" name="AMLH_CostCenter" tabindex="12">
                    <option value="" disabled selected>Cost Center</option>
                      <?php 
                      if(!empty($Cost['data'])){
                      foreach ($Cost['data'] as $key => $value) {
                      ?>
                    <option value="<?=$value['CPC_Id']?>" <?=$this->session->userdata('dlocation')['SP_FK_CPC_id'] == $value['CPC_Id'] ? 'selected' : '' ?> ><?=$value['CPC_Desc']?></option>
                      <?php }} ?>
                  </select>
                </div>
            </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="13" id="save-new"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="14" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="15" href="<?= base_url() ?>app/financial-management/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

 $('input[name=AMLH_StartingDate],input[name=AMLH_StartingDate],input[name=AMLH_DateReceived]').datepicker({dateFormat:'mm/dd/yy'});

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

  $nseries = $('input[name=AMLH_DocNo]').numseries({
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
    form = $('#'+_class+"-form");
    data = form.serializeArray();
    data.push({name:"type",value:'update'},
              {name:"uniqid",value:$(this).attr('data-id')},
              {name:"AMLH_Status",value:'Open'});
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

  $(document).on("click","#update",function(){
      var $btn = $(this);
      var $lbl = $btn.text();
      form = $('#'+_class+"-form");
      data = form.serializeArray();
      data.push({name:"type",value:'update'},
            	{name:"uniqid",value:$(this).data('id')},
              {name:"AMLH_Status",value:'Open'});

      
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
					