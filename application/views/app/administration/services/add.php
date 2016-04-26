<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">

          <div class="form-group">
              <label class="control-label col-xs-5" for="">Item Type:</label>
              <div class="col-xs-7">
                <select class="form-control single-default" placeholder="Item Type" id="" name="IM_FK_ItemType_id" tabindex="1">
                  <option value="" disabled selected>Item Type</option>
                  <?php 
                    if(!empty($data)){
                      foreach ($data['data'] as $key => $value) {
                  ?>
                    <option value="<?=trim($value['IT_Id'])?>" ><?=$value['IT_Description']?></option>
                  <?php }} ?>
                </select>
              </div>
            </div>
          <div class="form-group">
              <label class="control-label col-xs-5" for="">Category:</label>
              <div class="col-xs-7">
                <select class="form-control single-default" placeholder="Category" id="" name="IM_FK_Category_id" tabindex="2">
                <option value="" disabled selected>Category</option>
                <?php 
                  if(!empty($category)){
                    foreach ($category['data'] as $key => $value) {
                ?>
                  <option value="<?=trim($value['CAT_Id'])?>" ><?=$value['CAT_Desc']?></option>
                <?php }} ?>
                </select>
              </div>
            </div>
           <div class="form-group">
                <label class="control-label col-xs-5" for="">Sub Category:</label>
                <div class="col-xs-7">
                  <select class="form-control single-default" placeholder="Sub Category" id="" name="IM_FK_SubCategory_id" tabindex="3">
                    <option value="" disabled selected>Sub Category</option>
                  </select>
                </div>
            </div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Code:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="4" name="IM_Item_id" placeholder="Code">
				      </div>
					</div>
				  <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Description:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="5" name="IM_Sales_Desc" placeholder="Description">
				      </div>
					</div>          
          <div class="form-group">
              <label class="control-label col-xs-5" for="">Concerned Department:</label>
              <div class="col-xs-7">
                  <select class="form-control single-default select-cli" placeholder="Concerned Department" id="" name="IM_FK_Department_id" tabindex="6">
               <option value="" disabled selected>Concerned Department</option>
               <?php 
                if(!empty($dep)){
                  foreach ($dep['data'] as $key => $value) {
               ?>
                <option value="<?=trim($value['DEP_Id'])?>"><?=$value['DEP_Description']?></option>
                <?php }} ?>
              </select>
              </div>
          </div> 
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Inventory Posting Group:</label>
              <div class="col-xs-7">
                <select class="form-control single-default select-cli" placeholder="Inventory Posting Group" id="" name="IM_INVPosting_Group" tabindex="7">
                <option value="" disabled selected>Inventory Posting Group</option>
                <?php 
                  if(!empty($INV)){
                    foreach ($INV['data'] as $key => $value) {
                ?>
                  <option value="<?=trim($value['IPG_Code'])?>" ><?=$value['IPG_Code']?></option>
                <?php }} ?>
                </select>
              </div>
            </div>          
            <div class="form-group">
              <label class="control-label col-xs-5" for="">VAT Posting Group:</label>
              <div class="col-xs-7">
                <select class="form-control single-default select-cli" placeholder="VAT Posting Group" id="" name="IM_VATProductPostingGroup" tabindex="8">
                <option value="" disabled selected>VAT Posting Group</option>
                <?php 
                  if(!empty($VAT)){
                    foreach ($VAT['data'] as $key => $value) {
                ?>
                  <option value="<?=trim($value['VPPG_Code'])?>" ><?=$value['VPPG_Code']?></option>
                <?php }} ?>
            </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-5" for="">WHT Posting Group:</label>
              <div class="col-xs-7">
                <select class="form-control single-default select-cli" placeholder="WHT Posting Group" id="" name="IM_WHTProductPostingGroup" tabindex="9">
                <option value="" disabled selected>WHT Posting Group</option>
                <?php 
                  if(!empty($WHT)){
                    foreach ($WHT['data'] as $key => $value) {
                ?>
                  <option value="<?=trim($value['WPPG_Code'])?>"  ><?=$value['WPPG_Code']?></option>
                <?php }} ?>
            </select>
              </div>
            </div>
        </span>   
        <span class="col-md-6">
            <div class="table-container">
              <table id="identifier-tbl" class="table table-striped table-hover table-bordered  table-condensed">
                <thead>
                  <tr>
                    <th>Identifier</th>
                    <th>Details</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
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
				<a type="button" tabindex="12" href="<?= base_url() ?>app/administration/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var xhr;
  var itemtype, $itemtype;
  var category, $category;
  var subcategory, $subcategory;


  $itemtype = $('select[name=IM_FK_ItemType_id]').selectize({
    sortField: 'text',
      plugins: {
      'dropdown_header': {
        title: 'Item Type'
      }
    },
      onChange: function(value) {
          if (!value.length) return;
          category.disable();
          category.clearOptions();
          subcategory.disable();
          subcategory.clearOptions();
          getdescription();
          $('#identifier-tbl tbody').html('')
          category.load(function(callback) {
              xhr && xhr.abort();
              xhr = $.ajax({
                  url: base_url+'app/administration/category/json/'+ value ,
                  success: function(results) {
                      category.enable();
                      callback(JSON.parse(results));
                  },
                  error: function() {
                      callback();
                  }
              });
          });
      }
  });

  $category = $('select[name=IM_FK_Category_id]').selectize({
    sortField: 'text',
      plugins: {
      'dropdown_header': {
        title: 'Category'
      }
    },
      valueField: 'CAT_Id',
      labelField: 'CAT_Desc',
      searchField: ['CAT_Desc'],
      onChange: function(value) {
          if (!value.length) return;
          subcategory.disable();
          subcategory.clearOptions();
          getitemidadd();
          getdescription();
          $('#identifier-tbl tbody').html('')
          subcategory.load(function(callback) {
              xhr && xhr.abort();
              xhr = $.ajax({
                  url: base_url+'app/administration/sub-category/json/'+ value ,
                  success: function(results) {
                    res = JSON.parse(results);
                      subcategory.enable();
                      // $('#identifier-tbl tbody').html(res['identifier']);
                      callback(res);
                  },
                  error: function() {
                      callback();
                  }
              });
          });
      }
  });

  $subcategory = $('select[name=IM_FK_SubCategory_id]').selectize({
    sortField: 'text',
      plugins: {
      'dropdown_header': {
        title: 'Sub Category'
      }
    },
      valueField: 'SC_Id',
      labelField: 'SC_Description',
      searchField: ['SC_Description'],
      onChange: function(value){
        getdescription();
        getitemidadd();
        $('#identifier-tbl tbody').html('')
        cat = category.getValue();
      xhr && xhr.abort();
              xhr = $.ajax({
                  url: base_url+'app/administration/identifier/json/?cat=' + cat + '&sub='+ value,
                  success: function(result) {
                      $('#identifier-tbl tbody').html(JSON.parse(result));
                  },
                  error: function() {
                      return false;
                  }
              });
      }
  });

  itemtype      = $itemtype[0].selectize;
  category        = $category[0].selectize;
  subcategory     = $subcategory[0].selectize;

  category.disable();
  subcategory.disable();

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
            window.location = base_url+'app/administration/'+_class;
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
    		  {name:"Sv_Active",value:'1'},
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
      			{name:"Sv_Active",value:'1'},
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
              window.location = base_url+'app/administration/'+_class;
            }
          },'json').error(function(){
            alert('Error!');
            $btn.attr('disabled',false).text($lbl);
          });
        }
      });
  });

</script>
					