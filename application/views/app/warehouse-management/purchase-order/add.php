<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="APV_DocNo" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" disabled tabindex="2" value="<?=date("m/d/Y",time())?>" placeholder="Document Date">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Name:</label>
				      <div class="col-xs-7">
				      	<select class="form-control single-default"  placeholder="Supplier Name" id="" name="APV_SupplierName" tabindex="3">
						  	<option value="" disabled  selected>Supplier Name</option>
						</select>
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier ID:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="s_id" tabindex="4"  name="APV_SupplierID" placeholder="Supplier ID">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Supplier Address:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="s_address" tabindex="5" name="APV_SupplierAddress" placeholder="Supplier Address">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Payment Terms:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="terms_id" tabindex="6" value="" data-id="" name="APV_PaymentTerms" placeholder="Payment Terms">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Required:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="7" name="APV_DateRequired" placeholder="Date Required">
				      </div>
				    </div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Applies to Doc. No.:</label>
				      <div class="col-xs-7">
				      	<select class="form-control single-default select-cli"  placeholder="Applies to Doc. No." id="" name="APV_AppliesToDocNo" tabindex="8">
						  	<option value="" disabled selected>Applies to Doc. No.</option>
						  	<?php 
						  	if(!empty($applies_to['data'])){
						  	foreach($applies_to['data'] as $key => $value){ 
						  	?>
						  	<option value="<?=$value['RPH_AppToRefNo']?>" ><?=$value['RPH_AppToRefNo']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				    <!-- <div class="form-group">
				      <label class="control-label col-xs-5" for="">Payment Discount:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="APV_Remarks" placeholder="Payment Discount">
				      </div>
				    </div>
 -->				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <?php 
				        $location = $this->session->userdata('location');
				        $dlocation 	= $this->session->userdata('dlocation')['SP_StoreID'];
				        $dcompany 	= $this->session->userdata('dlocation')['SP_FK_CompanyID'];
				        if(count($location) > 1){ 
				        ?>
				        <select class="form-control single-default" placeholder="Location" id="" name="APV_Location" tabindex="9">
						  	<option value="" disabled selected>Location</option>
						  	<?php foreach ($location as $key => $value) { ?>
						  		<option value="<?=$value['SP_StoreID']?>" <?= $dlocation==$value['SP_StoreID']?'selected':''?> ><?=$value['SP_StoreName']?></option>
						  	<?php } ?>
						</select>
					  	<?php }else{ ?>
					  		<input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="10" name="RPH_Location" placeholder="Location">
				        <?php } ?>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="com_id" readonly value="<?=count($location) == 1 ? $location[0]['COM_Name']: $dcompany ?>" tabindex="11" name="APV_Company" placeholder="Company">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="12" name="APV_Remarks" placeholder="Remarks">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Received:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="13" name="APV_DateReceived" placeholder="Date Received">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Posting Group:</label>
				      <div class="col-xs-7">
				        <select class="form-control single-default" placeholder="Supplier Posting Group" id="" name="APV_SupplierPostingGroup" tabindex="14">
						  	<option value="" disabled selected>Supplier Posting Group</option>
						  	<?php 
						  		if(!empty($Sup)){
						  			foreach ($Sup['data'] as $key => $value) {
						  	?>
						  		<option value="<?=trim($value['SPG_Code'])?>"  ><?=$value['SPG_Code']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">WHT Posting Group:</label>
				      <div class="col-xs-7">
				        <select class="form-control single-default" placeholder="WHT Posting Group" id="" name="APV_WHTPostingGroup" tabindex="15">
						  	<option value="" disabled selected>WHT Posting Group</option>
						  	<?php 
						  		if(!empty($WHT)){
						  			foreach ($WHT['data'] as $key => $value) {
						  	?>
						  		<option value="<?=trim($value['WBPG_Code'])?>"  ><?=$value['WBPG_Code']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">VAT Posting Group:</label>
				      <div class="col-xs-7">
				        <select class="form-control single-default" placeholder="VAT Posting Group" id="" name="APV_VATPostingGroup" tabindex="16">
						  	<option value="" disabled selected>VAT Posting Group</option>
						  	<?php 
						  		if(!empty($VAT)){
						  			foreach ($VAT['data'] as $key => $value) {
						  	?>
						  		<option value="<?=trim($value['VBPG_Code'])?>" ><?=$value['VBPG_Code']?></option>
						  	<?php }} ?>
						</select>
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="17" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="18" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="19" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	var supplier,$supplier,loc,$loc,vat,$vat,spg,$spg,wht,$wht;

	$('input[name=APV_DateRequired],input[name=APV_DateReceived]').datepicker({
		dateFormat:'mm/dd/yy'
	}).mask("99/99/9999");
  	
  	if($('select[name=APV_Location]').length > 0){
		$loc = $('select[name=APV_Location]').selectize({
	                    sortField: 'text',
	                    create: false,
					    onItemRemove:function(value){
					    	$('#com_id').val('');
						},
	                   	onChange: function(value) {
	                   		if (!value.length) return;
	                   		 $.ajax({
					            url: base_url + 'app/ajaxes/get_spec_company_per_location_array',
					            type: 'GET',
					            dataType: 'json',
					            data: {
					                q: value
					            },
					            beforeSend: function(){
					            	$('#com_id').val('');
					            	$('#save-new,#save-close').attr('disabled',true);
								},
					            error: function(){
					            	$('#com_id').val('');
					            	$('#save-new,#save-close').attr('disabled',false);
					            },
					            success: function(res) {
					            	$('#com_id').val(res.COM_Name);
					            	$('#save-new,#save-close').attr('disabled',false);
					            }
					        });
				    	}
	                });
		loc 	= $loc[0].selectize;
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


	$vat = $('select[name=APV_VATPostingGroup]').selectize({
                  sortField: 'text',
                });

	$wht = $('select[name=APV_WHTPostingGroup]').selectize({
                  sortField: 'text',
                });

	$spg = $('select[name=APV_SupplierPostingGroup]').selectize({
                  sortField: 'text',
                });

	$supplier = $('select[name=APV_SupplierName]').selectize({
                    sortField: 'text',
                    valueField: 'S_Name',
				    labelField: 'S_Name',
				    searchField: ['S_Id','S_Name'],
				    highlight:false,
				    options: [],
				    create: false,
				    render: {
				        option: function(item, escape) {
							return '<div class="sel-dropdown">' +
						                '<span class="id"><label>Supplier ID:</label>' + escape(item.S_Id) + '</span>' +
						                '<span class="name"><label>Supplier Name:</label>' + escape(item.S_Name) + '</span>' +
				            		'</div>';
				        }
				    },
				    onItemRemove:function(value){
				    	$('#s_id,#s_address').val('');
				    	$('#terms_id').attr('data-id','').val('');
				    	// currency.clear();
				    	vat.clear();
						wht.clear();
						spg.clear();
					},
                   	onChange: function(value) {
                   		if (!value.length) return;
                   		 var s_id = $(this)[0].getOption(value).children()[0].childNodes[1].data;
                   		 console.log(s_id);
                   		 $.ajax({
				            url: base_url + 'app/ajaxes/get_supplier_detail_per_query',
				            type: 'GET',
				            dataType: 'json',
				            data: {
				                q: s_id
				            },
				            beforeSend: function(){
				                $('#s_id,#s_address').val('');
				                $('#terms_id').attr('data-id','').val('');
				                $('#save-new,#save-close').attr('disabled',true);
				                vat.clear();
								wht.clear();
								spg.clear();
							},
				            error: function() {
				            	$('#terms_id').attr('data-id','').val('');
				            	$('#save-new,#save-close').attr('disabled',false);
				            },
				            success: function(res) {
				                $('#s_id').val(res.S_Id);
				                $('#s_address').val(res.S_Address);
				                $('#terms_id').attr('data-id',res.PT_Id).val(res.PT_Desc);
				                $('#save-new,#save-close').attr('disabled',false);
				                vat.setValue(res.S_Vat_PostingGroup);
								wht.setValue(res.S_WHT_PostingGroup);
								spg.setValue(res.S_SupplierPostingGroup);
				            }
				        });
			    	}
                });

	supplier 	= $supplier[0].selectize;
	vat 		= $vat[0].selectize;
	wht 		= $wht[0].selectize;
	spg 		= $spg[0].selectize;
	
	$.ajax({
        url: base_url + 'app/ajaxes/get_supplier_init',
        type: 'GET',
        dataType: 'json',
        beforeSend:function(){
        	$('#save-new,#save-close').attr('disabled',true);
        },
        success: function(res) {
            supplier.addOption(res);
            $('#save-new,#save-close').attr('disabled',false);
        },
        error:function() {
        	$('#save-new,#save-close').attr('disabled',false);
        }
    });
 
 $nseries = $('input[name=APV_DocNo]').numseries({
                  target:base_url+'app/purchasing/purchase-order/getseries',
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

 $("#save-new").on("click",function(){
    var $btn = $(this);
    var $lbl = $btn.text();
    var form = $('#'+_class+"-form");

    confirm("Save Entry?", function(confirmed) {
      if(confirmed){ 
        
        $btn.attr('disabled',true).text('Processing..');
        data = form.serializeArray();
        data.push({name:"type",value:'add'});

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
	        url: base_url+'app/purchasing/purchase-order/process',
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

  $("#save-close").on("click",function(){
    var $btn = $(this);
    var $lbl = $btn.text();
    var form = $('#'+_class+"-form");

    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
	        $btn.attr('disabled',true).text('Processing..');
	        data = form.serializeArray();
	        data.push({name:"type",value:'add'});

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
		        url: base_url+'app/purchasing/purchase-order/process',
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

  $(document).on("click","#update-new",function(){
    var $btn = $(this);
    var $lbl = $btn.text();
    var form = $('#'+_class+"-form");
    
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){

         $btn.attr('disabled',true).text('Processing..');
	        data = form.serializeArray();

	        data.push(	{name:"type",value:'update'},
		                {name:"uniqid",value:$btn.data('id')});

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
		        url: base_url+'app/purchasing/purchase-order/process',
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
		        
		        data.push(	{name:"type",value:'update'},
			                {name:"uniqid",value:$btn.data('id')});

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
		        url: base_url+'app/purchasing/purchase-order/process',
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

					