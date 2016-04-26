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
				        <input type="text" class="form-control" id="" tabindex="1" disabled name="CV_DocNo" value="<?=$data['CV_DocNo']?>" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled id="" tabindex="2" value="<?=date("m/d/Y",time())?>" placeholder="Document Date">
				      </div>
				    </div>				   
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier ID:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="s_id" tabindex="3"  value="<?=$data['CV_SupplierID']?>" name="CV_SupplierID" placeholder="Supplier ID">
				       </div> 
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Name:</label>
				      <div class="col-xs-7">
				      	<select class="form-control single-default"  placeholder="Supplier Name" id="" value="<?=$data['CV_SupplierName']?>" name="CV_SupplierName" tabindex="4">
						  	<option value="" disabled selected>Supplier Name</option>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Supplier Address:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="s_address" tabindex="5" value="<?=$data['CV_SupplierAddress']?>" name="CV_SupplierAddress" placeholder="Supplier Address">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Payment Terms:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="terms_id" tabindex="6" readonly value="<?=$data['CV_PaymentTerms']?>" data-id="" name="CV_PaymentTerms" placeholder="Payment Terms">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Needed:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="7" name="CV_DateRequired" value="<?=date_format(date_create($data['CV_DateRequired']), 'm/d/Y')?>" placeholder="Date Needed">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Due Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="due_date" tabindex="8" name="CV_DueDate" value="<?=date_format(date_create($data['CV_DueDate']), 'm/d/Y')?>" placeholder="Due Date">
				      </div>
				    </div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Ext Doc No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="9" name="CV_ExtDocNo" value="<?=$data['CV_ExtDocNo']?>" placeholder="Ext Doc No.">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Bank:</label>
				      <div class="col-xs-7">
				      	<select class="form-control single-default"  placeholder="Bank" id="" name="CV_Bank" tabindex="10">
						  	<option value="" disabled selected>Bank</option>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Currency:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly  tabindex="11" value="<?=$data['CV_Currency']?>" name="CV_Currency" placeholder="Currency">
				      </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Series Type:</label>
				      <div class="col-xs-7">
				      	<select class="form-control single-default select-cli"  placeholder="Series Type" id=""  tabindex="12">
						  	<option value="" disabled selected>Series Type</option>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Check No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="13" name="CV_CheckNo" value="<?=$data['CV_CheckNo']?>" placeholder="Check No.">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Check Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="14" name="CV_CheckDate" value="<?=date_format(date_create($data['CV_CheckDate']), 'm-d-Y')?>" placeholder="Check Date">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="250" tabindex="15" name="CV_Remarks" value="<?=$data['CV_Remarks']?>" placeholder="Remarks">
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" data-id="<?= $data['id']; ?>" tabindex="16" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="17" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
	 			  Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	var supplierjson = <?=json_encode($supplier['data'])?>;
	var bankjson 	 = <?=json_encode($bank['data'])?>;
	var supplier,$supplier,bank,$bank;

	$('input[name=CV_DateRequired],input[name=CV_DueDate],input[name=CV_CheckDate]').datepicker({
		dateFormat:'mm/dd/yy'
	}).mask("99/99/9999");
  	
	$select = $('.select-cli').each(function(){
	            $(this).selectize({
	              sortField: 'text',
	            });
	          });


	$bank = $('select[name=CV_Bank]').selectize({
                    sortField: 'text',
                    valueField: 'BA_BankID',
				    labelField: 'BA_BankName',
				    searchField: ['BA_BankID','BA_BankName'],
				    highlight:false,
				    options: bankjson,
				    create: false,
				    render: {
				        option: function(item, escape) {
							return '<div class="sel-dropdown">' +
						                '<span class="id"><label>Bank ID:</label>' + escape(item.BA_BankID) + '</span>' +
						                '<span class="name"><label>Bank Name:</label>' + escape(item.BA_BankName) + '</span>' +
				            		'</div>';
				        }
				    },
				    onItemRemove:function(value){
				    	 $('input[name=CV_Currency]').val('');
					},
                   	onChange: function(value) {
                   		 for (var i in bankjson) {
		                        if (bankjson[i]["BA_BankID"] == value) {
		                            $('input[name=CV_Currency]').val(bankjson[i]["AD_Code"]);
		                        }
		                    }
			    	}
                });

 	bank 	= $bank[0].selectize.setValue('<?=$data['CV_Bank']?>','silent');

	$supplier = $('select[name=CV_SupplierName]').selectize({
                    sortField: 'text',
                    valueField: 'S_Name',
				    labelField: 'S_Name',
				    searchField: ['S_Id','S_Name'],
				    highlight:false,
				    options: supplierjson,
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
				    	$('#s_id,#s_address,#terms_id').val('');
					},
                   	onChange: function(value) {
                   		if (!value.length) return;
                   		var s_id = $(this)[0].getOption(value).children()[0].childNodes[1].data;
                   		for (var i in supplierjson) {
		                        if (supplierjson[i]["S_Id"] == s_id) {
		                            $('input[name=CV_SupplierID]').val(s_id);
		                            $('input[name=CV_SupplierAddress]').val(supplierjson[i]["S_Address"]);
		                            $('input[name=CV_PaymentTerms]').val(supplierjson[i]["S_FK_PayTerms"]);
		                        }
		                    }
			    	}			    	
                });

  supplier 	= $supplier[0].selectize.setValue('<?=$data['CV_SupplierName']?>','silent');
	
  
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

      	$(form).find('input[type=checkbox]').each(function() {
        	data.push({ name: this.name, value: this.checked ? 1 : 0 });
      	});

        file = new FormData();

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
  check_if_changed($('#' + _class + '-form'),$('#update'));


</script>			

					