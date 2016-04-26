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
        <span class="col-md-6">
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Account Type:</label>
            <div class="col-xs-7">
              <select class="form-control single-default" id="" placeholder="Account Type" name="COA_AccountType" tabindex="1">
                <option value="" disabled selected>Account Type</option>
                <?php foreach(static_lookup('account_type') as $key => $value){ ?>
                  <option value="<?= $key ?>" <?=$data['COA_AccountType']==$key?'selected':''?> ><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Account Level:</label>
            <div class="col-xs-7">
              <select class="form-control single-default" id="" placeholder="Account Level" name="COA_AccountLevel" tabindex="2">
                <option value="" disabled selected>Account Level</option>
                <?php foreach(static_lookup('account_level') as $key => $value){ ?>
                  <option value="<?= $key ?>" <?=$data['COA_AccountLevel']==$key?'selected':''?>><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Mother Account:</label>
            <div class="col-xs-7">
                <select class="form-control single-default" placeholder="Mother Account" id="" name="COA_Parent" tabindex="3">
                  <option value="" disabled selected>Mother Account</option>
                  <?php 
                    if(!empty($parent['data'])){
                      foreach ($parent['data'] as $key => $value) {
                  ?>
                  <option value="<?=$value['COA_Account_id']?>" <?=trim($data['COA_Parent'])==trim($value['COA_Account_id'])?'selected':''?> ><?=$value['COA_AccountName']?></option>
                  <?php }} ?>
                </select>
              </div>
          </div>
          <!-- <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Account ID:</label>
            <div class="col-xs-7">
                <input type="text" class="form-control" id="" disabled value="<?=$data['COA_Account_id']?>" maxlength="30" tabindex="1" placeholder="Account ID">
            </div>
          </div>    -->       
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Account Name:</label>
            <div class="col-xs-7">
              <input type="text" class="form-control" id="" value="<?=$data['COA_AccountName']?>" maxlength="100" tabindex="4" name="COA_AccountName" placeholder="Account Name">
            </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Account Nature:</label>
            <div class="col-xs-7">
              <select class="form-control single-default select-cli" id="" placeholder="Account Nature" name="COA_AccountNature" tabindex="5">
                <option value="" disabled selected>Account Nature</option>
                <?php foreach(static_lookup('account_nature') as $key => $value){ ?>
                  <option value="<?= $key ?>" <?=$data['COA_AccountNature']==$key?'selected':''?>><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Bal. Sheet / IS:</label>
            <div class="col-xs-7">
              <select class="form-control single-default select-cli" id="" placeholder="Bal. Sheet / IS" name="COA_BSIS" tabindex="6">
                <option value="" disabled selected>Bal. Sheet / IS</option>
                <?php foreach(static_lookup('bs_is') as $key => $value){ ?>
                  <option value="<?= $key ?>" <?=$data['COA_BSIS']==$key?'selected':''?> ><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Amortization Type:</label>
            <div class="col-xs-7">
              <select class="form-control single-default select-cli" id="" placeholder="Amortization Type" name="COA_AmortizationType" tabindex="7">
              <option value="" disabled selected>Amortization Type</option>
               <?php foreach(static_lookup('amortization_type') as $key => $value){ ?>
                  <option value="<?= $key ?>" <?=$key==$data['COA_AmortizationType']?'selected':''?> ><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </span>
      </form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="8" data-id="<?= $data['id']; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="9" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
  var xhr;
  var accounttype, $accounttype;
  var accountlvl, $accountlvl;
  var parent, $parent;
  
	$('#general').on('click',function(e){
  		e.preventDefault();
  		window.location =  base_url + 'app/' + _module + '/' + _class + '/general_ledger?id=' + $(this).data('id');
  	});


  $accounttype = $('select[name=COA_AccountType]').selectize({
    sortField: 'text',
      plugins: {
      'dropdown_header': {
        title: 'Account Type'
      }
    },
      onChange: function(value) {
          if (!value.length){
            accountlvl.clear();
            accountlvl.disable();
            parent.clear();
            parent.disable();
          }else{
            accountlvl.clear();
            accountlvl.enable();
            parent.clear();
            parent.enable();
          }
      }
  });

  $accountlvl = $('select[name=COA_AccountLevel]').selectize({
    sortField: 'text',
      plugins: {
      'dropdown_header': {
        title: 'Account Level'
      }
    },
      onChange: function(value) {
          if (!value.length) return;

          parent.disable();
          parent.clearOptions();
          if(value == 2){
            parent.load(function(callback) {
                xhr && xhr.abort();
                xhr = $.ajax({
                    url: base_url+'app/financial-management/chart-of-accounts/json/'+accounttype.getValue() ,
                    success: function(results) {
                      res = JSON.parse(results);
                      if(res){
                        parent.enable();
                        callback(res.data);
                      }
                    },
                    error: function() {
                        callback();
                    }
                });
            });
          }
      }
  });

  $parent = $('select[name=COA_Parent]').selectize({
    sortField: 'text',
      plugins: {
      'dropdown_header': {
        title: 'Mother Account'
      }
    },
      valueField: 'COA_Account_id',
      labelField: 'COA_AccountName',
      searchField: ['COA_AccountName']
  });

  accounttype   = $accounttype[0].selectize;
  accountlvl    = $accountlvl[0].selectize;
  parent        = $parent[0].selectize;

  if(accountlvl.getValue() == 1){
    parent.disable();
  }
  // accountlvl.disable();
  // parent.disable();

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