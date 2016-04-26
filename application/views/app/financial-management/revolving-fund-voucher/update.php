<?php 
	$location = $this->session->userdata('location');
?>
<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
					<div class="form-group">
				      <label class="control-label col-xs-6" for="">Source of Fund:</label>
				      <div class="col-xs-6">
				        <select class="form-control single-default" placeholder="Source of Fund" id="" name="RFV_SourceOfFund" tabindex="14">
						  	<option value="" disabled selected>Source of Fund</option>
						</select>
				      </div>
				    </div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-6">Doc. No.:</label>
					  <div class="col-xs-6">
				        <input type="text" class="form-control" id="" value="<?=$data['RFV_DocNo']?>" readonly tabindex="1" name="RFV_DocNo" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Doc. Date:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" readonly id="" tabindex="2" name="RFV_DocDate" value="<?=!$data['RFV_RequestStatus']? date("m/d/Y",time()):format($data['RFV_DocDate'])?>" placeholder="Document Date">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Requestor:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" readonly  tabindex="4" value="<?= !$data['RFV_RequestStatus']? $this->session->userdata('U_User_id') :$data['RFV_Requestor']?>" name="RFV_Requestor"   placeholder="Requestor">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Transaction Description:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" id="" tabindex="8" value="<?=$data['RFV_TransDescription']?>" name="RFV_TransDescription" placeholder="Transaction Description">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Amount Requested:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control dc-mal" <?=$data['RFV_RequestStatus']=='Approved'?'readonly':''?> tabindex="9" value="<?=number_format($data['RFV_AmountRequested'])?>" name="RFV_AmountRequested" placeholder="Amount Requested">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Amount Released:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control dc-mal"<?=$is_approver && $data['RFV_RequestStatus'] == 'Pending'?'':'readonly'?>  tabindex="9" value="<?=number_format($data['RFV_AmountReleased'])?>" name="RFV_AmountReleased" placeholder="Amount Released">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Date Released:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" <?=$is_approver && $data['RFV_RequestStatus'] == 'Pending'?'':'readonly'?> tabindex="9" value="<?=format($data['RFV_DateReleased'])?>" name="RFV_DateReleased" placeholder="Date Released">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
					<div class="form-group">
				      <label class="control-label col-xs-6" for=""></label>
				      <div class="col-xs-6">
				      	<label class="control-label" for="">
				      		&nbsp;
		      			</label>
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Liquidation Date:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" id="" <?=$data['RFV_RequestStatus']=='Approved'?'':'readonly'?>  tabindex="11" value="<?=format($data['RFV_LiquidationDate'])?>"  name="RFV_LiquidationDate" placeholder="Liquidation Date">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Liquidation Status:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" id="" disabled tabindex="11" value="<?=$data['RFV_LiquidationStatus']?>" name="RFV_LiquidationStatus" placeholder="Liquidation Status">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Liquidation Received:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control dc-mal"<?=$is_approver && $data['RFV_LiquidationStatus'] == 'Pending'?'':'readonly'?> id=""  tabindex="13" value="<?=format($data['RFV_LiquidationReceived'])?>"  name="RFV_LiquidationReceived" placeholder="Liquidation Received">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for=""></label>
				      <div class="col-xs-6">
				      	<label class="control-label" for="">
				      		&nbsp;
		      			</label>
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for=""></label>
				      <div class="col-xs-6">
				      	<label class="control-label" for="">
				      		&nbsp;
		      			</label>
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6 dc-mal" for="">Actual Amount Used:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control dc-mal" readonly id="" <?=$data['RFV_RequestStatus']=='Approved'?'':'readonly'?> tabindex="13" value="<?=number_format($data['RFV_ActualAmountUsed'])?>" name="RFV_ActualAmountUsed" placeholder="Actual Amount Used">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Excess:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control dc-mal" id="" readonly tabindex="13" value="<?=number_format($data['RFV_Excess'])?>" name="RFV_Excess" placeholder="Excess">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
		      		<div class="form-group">
				      <label class="control-label col-xs-6" for="">Location:</label>
				      <div class="col-xs-6">
				        <?php 
				        if(count($location) > 1){ 
				        ?>
				        <select class="form-control single-default" placeholder="Location" id="" name="RFV_Location" tabindex="14">
						  	<option value="" disabled selected>Location</option>
						  	<?php foreach ($location as $key => $value) { ?>
						  		<option value="<?=$value['SP_StoreID']?>" ><?=$value['SP_StoreName']?></option>
						  	<?php } ?>
						</select>
					  	<?php }else{ ?>
					  		<input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="15" name="RFV_Location" placeholder="Location">
				        <?php }?>
				      </div>
				    </div>

				    <div class="form-group">
				      <label class="control-label col-xs-6" for="">Company:</label>
				      	<div class="col-xs-6">
					      	<select class="form-control single-default select-cli" placeholder="Company" id="com_id" maxlength="30" name="RFV_Company" tabindex="2">
							  	  <option value="" disabled selected>Company</option>
							  	    <?php 
							  	    if(!empty($Com['data'])){
							  			foreach ($Com['data'] as $key => $value) {
							  	    ?>
							  		<option value="<?=$value['COM_Id']?>" <?= trim($data['RFV_Company'])==trim($value['COM_Id'])?'selected':'' ?> ><?=$value['COM_Name']?></option>
							  	    <?php }} ?>
							    </select>
					     </div>
				    </div>
				    <!-- <div class="form-group">
				      <label class="control-label col-xs-6" for="">Company:</label>
				      <div class="col-xs-6">
				        <input type="text" class="form-control" id="com_id" value="<?=(!$data['RFV_RequestStatus']||$data['RFV_RequestStatus']=='Cancel') && count($location) == 1? $location[0]['COM_Id'] : $data['RFV_Company']?>" tabindex="1" name="RFV_Company" placeholder="Company">
				      </div>
				    </div> -->
				</span>
			</form>
			<hr>
			<?php if($data['RFV_RequestStatus']=='Approved'){ ?>
			<div id="sample">
			</div>
			<hr>
			<?php } ?>
			<div class="btn-cont">
				<a type="button" data-id="<?= $data['id']; ?>" tabindex="19" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="20" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
	 			  Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="charged-to-mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Charged To</h4>
          </div>
          <div class="modal-body">
          	<form class="form-horizontal">
          		<span class="col-md-5">
				  <div class="form-group">
				    <label class='control-label col-xs-5' for="">Location</label>
				    <div class="col-xs-7">
					    <select class="form-control single-default w-x-2" placeholder="Location" id="sel-loc" tabindex="14">
						  	<option value="" disabled selected>Source of Fund</option>
						  	<?php 
						  	if($loc['data']){
						  	foreach ($loc['data'] as $key => $value) { ?>
					  		<option value="<?=$value['SP_StoreID']?>" ><?=$value['SP_StoreName']?></option>
						  	<?php }} ?>
						</select>
					</div>
				  </div>
				</span>
			  	<span class="col-md-2">
			  		<div class="col-md-8">
			  			<button type="button" id="loc-add" class="btn btn-default form-btn main-clr">Add</button>
			  		</div>
			  	</span>
			  	<span class="col-md-5">
					<div class="form-group">
					  	<div class="col-xs-6">
					        <input class="pull-right" id="eq-divided" type="checkbox">
					    </div>
					  	<label class='control-label col-xs-6' for="">Equally Divided</label>
					</div>
					<div class="form-group">
					  	<label class='control-label col-xs-6' for="">Net of VAT</label>
					  	<div class="col-xs-6">
					        <label class='control-label col-xs-6' id='net-vat' for=""></label>
					    </div>
					</div>
				</span>
				<div class="row">
					  <div class='container-fluid'>
					  	<table id='chargeTo' class='table'>
					  		<thead>
					  			<tr>
					  				<th>Location</th>
					  				<th>Percentage</th>
					  				<th>Amount</th>
					  				<th>Action</th>
					  			</tr>
					  		</thead>
					  		<tbody>
					  		</tbody>
					  	</table>
					  </div>
				</div>
			</form>
          </div>
          <div class="modal-footer">
	        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
	        <button type="button" id="chargeToSave" class="btn btn-default form-btn main-clr">Save</button>
	      </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	var loc = <?= json_encode(array_column($this->session->userdata('location'),'SP_StoreID'))?>;
	var sourceOfFund = <?= json_encode(static_lookup('source_of_fund')) ?>;
	var actualReleased = "<?=$data['RFV_AmountReleased']?>";
	var $selLoc,selLoc,sourceDdown,$sourceDdown;

	var userLocations = <?= json_encode($location) ?>;

	$selLoc	= $('#sel-loc').selectize({
		  sortField: 'text',
		});

	selLoc = $selLoc[0].selectize;
	
	$(document).on('change','#chargeTo tbody input[type=text]',function(){
		nVat 	= parseFloat($('#net-vat').text());
		tr 		= $(this).closest('tr').index();
		td 		= $(this).closest('td').index();
		amount  = $(this).val();
		console.log((nVat/amount));
		if(td == 1){
			$('#chargeTo tbody tr:eq('+tr+') td:eq('+2+') input').val(parseFloat((nVat * amount) / 100).toFixed(4));
		}else{
			$('#chargeTo tbody tr:eq('+tr+') td:eq('+1+') input').val(((amount/nVat) * 100).toFixed());
		}
	});

	$('#charged-to-mod').on('show.bs.modal', function (event) {
		prop = $(event.relatedTarget).attr('data-grid-prop');
		row  = $(event.relatedTarget).attr('data-grid-row');
		$(this).find('#chargeToSave').attr('data-row',row);
		$(this).find('#chargeToSave').attr('data-prop',prop);
		$('#chargeTo tbody').html("");
		$('#net-vat').text(parseFloat(grid.getDataAtRowProp(row,'RFVD_NetOfVat')).toFixed(4));
		tabdata = grid.getDataAtRowProp(row,prop);
		$('#eq-divided').removeAttr('checked');
		selLoc.clear();
		if(tabdata){
			$.each(tabdata,function(index,value){
    			if(tabdata[index].loc && tabdata[index].perc && tabdata[index].amount){
					tr  = $('<tr>');
					tr.append('<td>'+tabdata[index].loc+'</td><td><input type="text" value="'+tabdata[index].perc+'"></td><td><input type="text" value="'+tabdata[index].amount+'"></td><td><a type="button" href="javascript:void(0)" ><span class="glyphicon glyphicon-remove chargeToRemove"></span></a></td>')
					$('#chargeTo tbody').append(tr);
    			}
			});
		}
  	});

	$('#eq-divided').on('change',function(){
		if($('#eq-divided').prop('checked') == true){
			$('#chargeTo tbody input[type=text]').attr('disabled',true);
			nVat = parseFloat($('#net-vat').text());
			rows = $('#chargeTo tbody tr').length;
			perc = ((nVat/rows) / nVat) * 100;
			$('#chargeTo tbody tr').each(function(){
				$(this).find('td:eq(1) input').val(perc.toFixed(4));
				$(this).find('td:eq(2) input').val((nVat/rows).toFixed(4));
			});

		}else{
			$('#chargeTo tbody input[type=text]').attr('disabled',false);
			$('#chargeTo tbody input').val('');
		}
	});

	$('#loc-add').on('click',function(){
		selL = selLoc.getValue();
		dis  = $('#eq-divided').prop('checked') == false ? '' : 'disabled';
		nVat = parseFloat($('#net-vat').text());
		if(nVat !=='' &&  nVat !== null && nVat > 0){
			if(selL){
			tr  = $('<tr>');
			tr.append('<td>'+selL+'</td><td><input type="text" '+dis+'></td><td><input type="text" '+dis+'></td><td><a type="button" href="javascript:void(0)" ><span class="glyphicon glyphicon-remove chargeToRemove"></span></a></td>')
			$('#chargeTo tbody').append(tr);
				if($('#eq-divided').prop('checked') == true){
					rows = $('#chargeTo tbody tr').length;
					perc = ((nVat/rows) / nVat) * 100;
					$('#chargeTo tbody tr').each(function(){
						$(this).find('td:eq(1) input').val(perc.toFixed(4));
						$(this).find('td:eq(2) input').val((nVat/rows).toFixed(4));
					});
				}
			}else{
				alert('Select Location!');
			}
		}else{
			alert('Invalid Net of VAT!');
		}
	});
	
	$('#chargeToSave').on('click',function(){
		data = [];
		perc = 0;
		$('#chargeTo tbody tr').each(function(){
			tabData = {}; 	
			tabData['loc'] 	= $(this).find('td:eq(0)').text();
			tabData['amount'] 	= $(this).find('td:eq(2) input').val();
			tabData['perc'] 	= $(this).find('td:eq(1) input').val();
			data.push(tabData);
			perc += parseFloat($(this).find('td:eq(1) input').val());
		});
		if(perc != 100){
			alert("Amount doesn't match!");
		}else{
			grid.setDataAtRowProp($(this).attr('data-row'),$(this).attr('data-prop'),data);
			grid.render();
			$('#charged-to-mod').modal('toggle');
		}
	});

	$(document).on('click','.chargeToRemove',function(){
		_this=$(this);
		confirm('Delete?',function(confirmed){
			if(confirmed){
				_this.closest('tr').remove();
				if($('#eq-divided').prop('checked') == true){
					rows = $('#chargeTo tbody tr').length;
					perc = ((nVat/rows) / nVat) * 100;
					nVat = parseFloat($('#net-vat').text());
					$('#chargeTo tbody tr').each(function(){
						$(this).find('td:eq(1) input').val(perc.toFixed(4));
						$(this).find('td:eq(2) input').val((nVat/rows).toFixed(4));
					});
				}
			}
		});
	});

	if($('#sample').length > 0){
		
		var grid  = $('#sample').gridEntry({
		tableData: <?=json_encode($details)?>,
		gridConfig:{
			minSpareRows:1,
			enterMoves: {row: 0, col: 1},
		    colHeaders:[  
		    
		                "Transaction Date",
		                "Invoice / OR No.",
		                "Payee",
		                "Address",
		                "TIN No.",
		                "w/ VAT",
		                "Particulars",
		                "Amount",
		                "Vat",
		                "Net of VAT",
		                "Charged To"],
		    columns: [
		    		{
		                data: "RFVD_TransDate",
		                type: 'date',
		                dateFormat: 'MM/DD/YYYY',
		                allowInvalid:false,
		                strict: true,
		                correctFormat: true,
		                renderer:autoCompleteRenderer
		            },
		            {
		                data: "RFVD_InvOR",
		                validator: requiredValidator,
		                renderer:emptyRenderer
		            }, {
		                data: "RFVD_Payee",
		                validator: requiredValidator,
		                renderer:emptyRenderer
		            }, {
		                data: "RFVD_Address",
		                renderer:emptyRenderer
		            }, {
		                data: "RFVD_TinNo",
		                renderer:emptyRenderer
		            }, {
		                data: "RFVD_withVAT",
		                type: 'checkbox',
		                renderer:checkRenderer
		            }, 
		            {
		                data: "RFVD_Particular",
		                validator: requiredValidator,
		                renderer:totalTextRenderer
		            }, {
		                data: "RFVD_Amount",
		                type: 'numeric',
	        			format: '0,0.00',
	        			validator: requiredValidator,
	        			allowInvalid:false,
	        			strict: true,
	        			renderer:renderTotal
	        		}, {
		                data: "RFVD_VAT",
		                type: 'numeric',
	        			format: '0,0.00',
	        			allowInvalid:false,
	        			renderer:renderTotalDisabled
		            }, {
		                data: "RFVD_NetOfVat",
		                type: 'numeric',
	        			format: '0,0.00',
	        			allowInvalid:false,
	        			renderer:renderTotalDisabled
		            }, {
		                data: "Charge",
		                validator: requiredValidator,
				        renderer:customHtml
					},
		            ],
		        afterChange:function(change,source){
		        	if(change !==null || source !='loadData'){
		        		if($.inArray(change[0][1],['RFVD_withVAT','RFVD_Amount'])!= -1){
		        			amount 	= this.getDataAtRowProp(change[0][0],'RFVD_Amount') || 0;
		        			withVat = this.getDataAtRowProp(change[0][0],'RFVD_withVAT');
		        			vat 	= parseFloat(amount)-(parseFloat(amount) / 1.12);
							this.setDataAtRowProp(change[0][0],'RFVD_VAT',withVat==true?vat:0);
							this.setDataAtRowProp(change[0][0],'RFVD_NetOfVat',withVat==true?parseFloat(amount) / 1.12:parseFloat(amount));
							$('input[name=RFV_ActualAmountUsed]').val(totalAmount(this.getDataAtProp('RFVD_Amount')));
							$('input[name=RFV_Excess]').val(parseFloat(actualReleased) - totalAmount(this.getDataAtProp('RFVD_Amount')));
						};
		        	}
		        }
		        // beforeChange: function (data,source) {
		          // console.log(data);
				  // for (var i = data.length - 1; i >= 0; i--) {
				  //   if (data[i][1] == 'RFVD_Amount') // replace 0 by the number of the field to validate
				  //   {	
		    //       	console.log(source);
				      // data[i][3] = parseInt(data[i][3]); // delete this line if you want to allow float too
				//       if (isNaN(data[i][3])) 
				//       {
				//          data.splice(i, 1);
				//       }
				//     }
				//   }
				// },
				// beforeKeyDown:function(event){
					// console.log(this);
				// 	console.log(this.getActiveEditor());
				// 	if (event.which < 48 || event.which > 57)
				// 	    {
				// 	        event.preventDefault();
				// 	    }
				// }
		    }

		});
	
	}

	function customHtml (instance, td, row, col, prop, value, cellProperties) {
  		 cellProperties.readOnly = true;
	   	 if(row == instance.countRows() - 1){
	   	 		value=null;
				Handsontable.renderers.TextRenderer.apply(this, arguments);
	     }else{
	  	  	  	var img;

		      	img = $('<a/>',{'href':'#','data-grid-prop':prop,'data-grid-row':row,'data-toggle':'modal','data-backdrop':'static','data-keyboard':'false','data-target':'#charged-to-mod'});
		      	img.append('<span class="glyphicon glyphicon-edit >"></span>');

		      	$(img).on('click', function (e){
		        	e.preventDefault(); // prevent selection quirk
		      	});

		      	Handsontable.Dom.empty(td);
		      	$(td).append(img);

		      	if(value && value.length > 0){
		      		check = $('<span/>',{'class':'glyphicon glyphicon-ok'});
		      		$(td).append(check);
		      	}

		  	  	return td;
	  	  }

	  

	    
	  }

	function totalAmount(data) {
	    var total = 0;
	    $.each(data,function (index, value) {
	        total += parseFloat(value) || 0;
	    }, 0);
	    return total;
	}

	var loc,$loc,com,$com;

	$('input[name=RFV_DateReleased],input[name=RFV_LiquidationDate],input[name=RFV_LiquidationReceived]').datepicker({
		dateFormat:'mm/dd/yy'
	}).mask("99/99/9999");
  	
  	$('.dc-mal').autoNumeric('init',{aSep: ',',              
									 aDec: '.',
									 aForm: false}); 

	$select = $('.select-cli').each(function(){
	            $(this).selectize({
	              sortField: 'text',
	            });
	          });

	$com = $('select[name=RFV_Company]').selectize({
	                    sortField: 'text',
	                    create: false,
					});
		com 	= $com[0].selectize;
		
	$sourceDdown = $('select[name=RFV_SourceOfFund]').selectize({
						  valueField: 'id',
	   					  labelField: 'name',
			              sortField: 'text',
			              searchField: ['name'],
			            });

	sourceDdown = $sourceDdown[0].selectize;

	if($('select[name=RFV_Location]').length > 0){
		$loc = $('select[name=RFV_Location]').selectize({
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
					            	com.clear();
					            	$('#save-new,#save-close').attr('disabled',true);
								},
					            error: function(){
					            	com.clear();
					            	$('#save-new,#save-close').attr('disabled',false);
					            },
					            success: function(res) {
					            	com.setValue(res.COM_Name);

					            	var sourcefund = [];
					            	for(var i in userLocations){
					            		if(value == userLocations[i]['SP_StoreID']){
					            			if(userLocations[i]['SP_StoreType']=='1'){
					            				sourcefund.push({'id':'1','name':'Petty Cash Fund'},{'id':'4','name':'Revolving Fund '});
					            			}else{
					            				sourcefund.push({'id':'1','name':'Petty Cash Fund'},{'id':'2','name':'Low Point Fund'},{'id':'3','name':'Repair Fund'});
					            			}
											break;
					            		}
					            	}
					            	sourceDdown.clear();
					            	sourceDdown.load(function(callback){
					            		callback(sourcefund);
					            	});
					            	$('#com_id').val(res.COM_Name);
					            	$('#save-new,#save-close').attr('disabled',false);
					            }
					        });
				    	}
	                });
		loc 	= $loc[0].selectize;
		loc.setValue('<?=$data["RFV_Location"]?>');
	}
	
	sourceDdown.on('load',function(){
		sourceDdown.setValue('<?=$data["RFV_SourceOfFund"]?>','silent');
	});
 
 
  $("#update").on("click",function(){
    var $btn = $(this);
    var form = $('#'+_class+"-form");
    var $lbl = $btn.text();

	var amount =$('input[name=RFV_AmountRequested]').val();
	
    if(sourceDdown.getValue() == 1 && parseFloat(amount.replace(',','')) <= 1500){
    	alert("Can't request PCF below 1500!");
    	return	false;
    }

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
	     //        	err = [];
      //   			errors = Object.keys(data.errors);
      //   			tableData = grid.getSourceData();
      //   			console.log(tableData);
      //   			for(var ind in tableData){
    		// 			for(var property in tableData[ind]){
    		// 				if($.inArray('details['+ind+']['+property+']',errors) !== -1){
    		// 					err.push('details['+ind+']['+property+']');
    		// 					grid.setDataAtRowProp(ind,property,'error');
    		// 				}
						// }
      //   			};
      				error_message(data.errors);
      				if($('#sample').length > 0){
        				grid.validateCells(function(){});
        			}
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

					