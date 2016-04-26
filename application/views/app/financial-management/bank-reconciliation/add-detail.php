<div class="panel">
  <div class="panel-heading">
    <h5 class="panel-title"><?=$title?></h5>
  </div>
  <div class="panel-body">
    <div id="data-container" class="container-fluid">
      <form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
        <span class="col-md-6">
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Transaction Date:</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="30" tabindex="1" name="BRD_TransDate" placeholder="Transaction Date">
              </div>
          </div>          
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Ref. No.:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="30" tabindex="2" name="BRD_RefNo" placeholder="Ref. No">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Payee:</label>
              <div class="col-xs-7">
              <input type="text" class="form-control" id="" maxlength="20" tabindex="4" name="BRD_Payee" placeholder="Payee">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Check No:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="5" name="BRD_CheckNo" placeholder="Check No">
              </div>
          </div> 
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Particulars:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="5" name="BRD_Particulars" placeholder="Particulars">
              </div>
          </div>         
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Debit:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" tabindex="8" name="BRD_Debit" placeholder="Debit">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Credit:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" tabindex="8" name="BRD_Credit" placeholder="Credit">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Amount:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" tabindex="8" name="BRD_Amount" placeholder="Amount">
              </div>
          </div>                
        </span>
      </form>
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

$('input[name=BRD_TransDate]').datepicker({
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
          