<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="request-payment-details-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Item Type:</label>
					  <div class="col-xs-7">
				        <select class="form-control single-default" placeholder="Item Type" id="" name="RPD_ItemType" tabindex="1">
						  	<option value="" disabled selected>Item Type</option>
						  	<?php 
						  		if(!empty($itemtype)){
						  			foreach ($itemtype as $key => $value) {
						  	?>
						  		<option value="<?=$value['IT_Id']?>"><?=$value['IT_Description']?></option>
						  	<?php }} ?>
						</select>
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				      	<select class="form-control single-default" placeholder="Description" id="" name="RPD_ItemDescription" tabindex="2">
						  	<option value="" disabled selected>Description</option>
						</select>
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Item Code:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="item_code" readonly name="RPD_ItemNo" tabindex="3" name="" placeholder="Item Code">
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="4" name="RPD_Qty" placeholder="Qty">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Unit Price:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="5" name="RPD_UnitPrice" name="" placeholder="Unit Price">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="amount" readonly name="RPD_Amount" tabindex="6" name="" placeholder="Amount">
				      </div>
				    </div>
				    <div class="form-group hidden">
				      <label class="control-label col-xs-5" for="">Exchange Rate:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly name="RPD_ExchangeRate" tabindex="7" name="" placeholder="Exchange Rate">
				      </div>
				    </div>
					<div class="form-group hidden">
				      <label class="control-label col-xs-5" for="">Amount in LCY:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="amount_lcy" readonly name="RPD_AmountLCY" tabindex="8" name="" placeholder="Amount in LCY">
				      </div>
				    </div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Cost Center Profit:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="9" name="RPD_CPC" value="<?=$cpc?>" name="" placeholder="Cost Center Profit">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Comment:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="10" name="RPD_Comment" placeholder="Comment">
				      </div>
				    </div>
				    <div class="form-group hidden">
				      <label class="control-label col-xs-5" for="">VAT:</label>
				      <div class="col-xs-7">
				      	<select class="form-control single-default" placeholder="VAT" id="" name="RPD_VAT" tabindex="11">
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
				    <div class="form-group hidden">
				      <label class="control-label col-xs-5" for="">WHT:</label>
				      <div class="col-xs-7">
						<select class="form-control single-default" placeholder="WHT" id="" name="RPD_WHT" tabindex="12">
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
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="13" id="save-new-det" data-id="<?=$id?>" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="14" id="save-close-det" data-id="<?=$id?>" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="15" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/view/?id=<?=$id?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
 
 var itemcode,$itemcode,itemtype,vat,$vat,wht,$wht,xhr;

 $('input[name=RPD_Qty],input[name=RPD_UnitPrice]').on('change',function(){
 	var qty 		= $('input[name=RPD_Qty]').val();
 	var unitprice 	= $('input[name=RPD_UnitPrice]').val();
 	if(qty.length > 0 && unitprice.length > 0){
 		$('#amount').val(qty * unitprice);
 		$.ajax({
        	method:'GET',
        	dataType:'json',
        	data:{id:$('#save-new-det').data('id'),
        		  amount:$('#amount').val()
                 },
            url: base_url+'app/ajaxes/amount_in_lcy_rp',
            beforeSend:function(){
            	$('#save-new-det').attr('disabled',true);
            	$('#save-close-det').attr('disabled',true);
            },
            success: function(results) {
            	$('#amount_lcy').val(results.amount);
            	$('input[name=RPD_ExchangeRate]').val(results.ER_ConvCurrencyRate);
            	$('#save-new-det').attr('disabled',false);
            	$('#save-close-det').attr('disabled',false);
            },
            error: function() {
            	$('#save-new-det').attr('disabled',false);
            	$('#save-close-det').attr('disabled',false);
            }
        });
 	}
 });

 itemtype= $('select[name=RPD_ItemType]').selectize({
      sortField: 'text',
      plugins: {
        'dropdown_header': {
          title: 'Item Type'
        }
      },
      onChange: function(value) {
        	itemcode.clear();
        	itemcode.clearOptions();
	        if (!value.length) return;
	        itemcode.load(function(callback) {
	        	itemcode.disable();
	            xhr && xhr.abort();
	            xhr = $.ajax({
	            	method:'GET',
	            	dataType:'json',
	            	data:{q:value},
	                url: base_url+'app/ajaxes/get_item_per_item_type',
	                beforeSend:function(){
		            	$('#save-new-det').attr('disabled',true);
		            	$('#save-close-det').attr('disabled',true);
		            },
	                success: function(results) {
	                    itemcode.enable();
	                    callback(results);
	                    $('#save-new-det').attr('disabled',false);
		            	$('#save-close-det').attr('disabled',false);
	                },
	                error: function() {
	                    callback();
	                    $('#save-new-det').attr('disabled',false);
		            	$('#save-close-det').attr('disabled',false);
	                }
	            });
	        });
	    }
 });
 
 $vat = $('select[name=RPD_VAT]').selectize({
		sortField: 'text',
     	plugins: {
			'dropdown_header': {
				title: 'VAT'
			}
		}
	});
 vat = $vat[0].selectize;

 $wht = $('select[name=RPD_WHT]').selectize({
		sortField: 'text',
     	plugins: {
			'dropdown_header': {
				title: 'WHT'
			}
		}
	});
 wht = $wht[0].selectize;

 $itemcode = $('select[name=RPD_ItemDescription]').selectize({
		sortField: 'text',
     	plugins: {
			'dropdown_header': {
				title: 'Item Description'
			}
		},
	    valueField: 'IM_Sales_Desc',
	    labelField: 'IM_Sales_Desc',
	    searchField: ['IM_Item_id','IM_Sales_Desc'],
	    render: {
			        option: function(item, escape) {
						return '<div class="sel-dropdown">' +
					                '<span class="id"><label>Item Code:</label>' + escape(item.IM_Item_id) + '</span>' +
					                '<span class="name"><label>Item Name:</label>' + escape(item.IM_Sales_Desc) + '</span>' +
			            		'</div>';
			        }
			    },
		onChange: function(value){
			$('#item_code').val('');
			vat.clear();
			wht.clear();
			if (!value.length) return;

			var i_id = $(this)[0].getOption(value).children()[0].childNodes[1].data;
	        	$('#item_code').val('');
	        	xhr && xhr.abort();
	            xhr = $.ajax({
	            	method:'GET',
	            	dataType:'json',
	            	data:{q:i_id},
	                url: base_url+'app/ajaxes/get_item_per_code',
	                beforeSend:function(){
		            	$('#save-new-det').attr('disabled',true);
		            	$('#save-close-det').attr('disabled',true);
		            },
	                success: function(result) {
	                	$('#item_code').val(result[0].IM_Item_id);
	                	vat.setValue(result[0].IM_VATProductPostingGroup);
	                	wht.setValue(result[0].IM_WHTProductPostingGroup);
	                	$('#save-new-det').attr('disabled',false);
		            	$('#save-close-det').attr('disabled',false);
	                },
	                error: function() {
	                    $('#save-new-det').attr('disabled',false);
		            	$('#save-close-det').attr('disabled',false);
	                }
	            });
		}
	});

 itemcode = $itemcode[0].selectize;
 
 itemcode.disable();

 $("#save-new-det").on("click",function(){
    var $btn = $(this);
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        
        $btn.attr('disabled',true).text('Processing..');
        form = $('#request-payment-details-form');
        data = form.serializeArray();

        data.push({name:"type",value:'add-details'},
        		  {name:"RPD_PFK_DocNo",value:$btn.data('id')});
        
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
            itemtype[0].selectize.clear();
            itemcode.clear();
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

  $("#save-close-det").on("click",function(){
    var $btn = $(this);
    form = $('#request-payment-details-form');
    data = form.serializeArray();
     data.push({name:"type",value:'add-details'},
    		   {name:"RPD_PFK_DocNo",value:$btn.data('id')});
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
            window.location = base_url+'app/'+_module+'/'+_class+'/view/?id='+$btn.data('id');
          }
        },'json').error(function(){
          alert('Error!');
          $btn.attr('disabled',false).text('Save & Close');
        });
      }
    });
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
</script>		