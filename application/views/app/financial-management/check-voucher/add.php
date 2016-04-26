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
				        <input type="text" class="form-control" id="" tabindex="1" name="CV_DocNo" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" disabled id="" tabindex="2" value="<?=date("m/d/Y",time())?>" placeholder="Document Date">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Name:</label>
				      <div class="col-xs-7">
				      	<select class="form-control single-default"  placeholder="Supplier Name" id="" name="CV_SupplierName" tabindex="3">
						  	<option value="" disabled selected>Supplier Name</option>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier ID:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="s_id" tabindex="4"  name="CV_SupplierID" placeholder="Supplier ID">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Supplier Address:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="s_address" tabindex="5" name="CV_SupplierAddress" placeholder="Supplier Address">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Payment Terms:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="terms_id" tabindex="6" readonly value="" data-id="" name="CV_PaymentTerms" placeholder="Payment Terms">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Needed:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="7" name="CV_DateRequired" placeholder="Date Needed">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Due Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="due_date" tabindex="8" name="CV_DueDate" placeholder="Due Date">
				      </div>
				    </div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Ext Doc No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="9" name="CV_ExtDocNo" placeholder="Ext Doc No.">
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
				         <input type="text" class="form-control" readonly tabindex="11" name="CV_Currency" placeholder="Currency">
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
				        <input type="text" class="form-control" id="" tabindex="13" name="CV_CheckNo" placeholder="Check No.">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Check Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="14" name="CV_CheckDate" placeholder="Check Date">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="250" tabindex="15" name="CV_Remarks" placeholder="Remarks">
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="16" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="17" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="18" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
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

 	bank 	= $bank[0].selectize;

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

 supplier 	= $supplier[0].selectize;
	
 $nseries = $('input[name=CV_DocNo]').numseries({
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
        
        $(form).find('input[type=checkbox]').each(function() {
           data.push({ name: this.name, value: this.checked ? 1 : 0 });
        });

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

	        $(form).find('input[type=checkbox]').each(function() {
	           data.push({ name: this.name, value: this.checked ? 1 : 0 });
	        });

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

	        $(form).find('input[type=checkbox]').each(function() {
	           data.push({ name: this.name, value: this.checked ? 1 : 0 });
	        });

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

		        $(form).find('input[type=checkbox]').each(function() {
		           data.push({ name: this.name, value: this.checked ? 1 : 0 });
		        });

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

					