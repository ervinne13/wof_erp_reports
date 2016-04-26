<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<div class="container-fluid">
					<legend>Identifier</legend>
					<span class="col-md-6">
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Type:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default" placeholder="Type" id="" name="IM_FK_ItemType_id" tabindex="1">
							  	<option value="" disabled selected>Type</option>
							  	<?php 
							  		if(!empty($type['data'])){
							  			foreach($type['data'] as $key => $value) {
							  	?>
							  		<option value="<?=$value['IT_Id']?>" ><?=$value['IT_Description']?></option>
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
				</div>
				<div class="container-fluid">
				<legend>General Information</legend>
					<span class="col-md-6">
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="30" disabled tabindex="4" name="IM_DocNo" placeholder="Document No.">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Item Code:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="30" readonly tabindex="5" name="IM_Item_id" placeholder="Item Code">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">UP Code:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="30" tabindex="6" name="IM_UPCCode" placeholder="UP Code">
					      </div>
						</div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Item Description:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="200" readonly tabindex="7" name="IM_Sales_Desc" placeholder="Item Description">
					      </div>
					    </div>
						<!-- <div class="form-group">
					      <label class="control-label col-xs-5" for="">Purchase Description:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="200" tabindex="4" name="IM_Purchased_Desc" placeholder="Purchase Description">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Short Description:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="25" tabindex="5" name="IM_Short_Desc" placeholder="Short Description">
					      </div>
					    </div> -->
					</span>
					<span class="col-md-6">
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">UOM:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="UOM" id="" name="IM_FK_Attribute_UOM_id" tabindex="8">
							  	<option value="" disabled selected>UOM</option>
							  	<?php 
							  		if(!empty($uom)){
							  			foreach ($uom['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['AD_Id'])?>" ><?=$value['AD_Desc']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Last PO Cost:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="9" name="IM_UnitCost" placeholder="Last PO Cost">
					      </div>
					    </div>
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Landed Cost:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="10" name="IM_CostOfGoods" placeholder="Landed Cost">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Points:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" tabindex="11" name="IM_Points" placeholder="Points">
					      </div>
					    </div>
					</span>
				</div>				
					<!-- <span class="col-md-6">    
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Landed Cost:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="14" name="IM_CostOfGoods" placeholder="Landed Cost">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Minimum Stock Level:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="8" name="IM_MinStkLvl" placeholder="Minimum Stock Level">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Weight:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="12" name="IM_Weight" placeholder="Weight">
					      </div>
					    </div>
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Concerned Department:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="Concerned Department" id="" name="IM_FK_Department_id" tabindex="9">
							  	<option value="" disabled selected>Concerned Department</option>
							  	<?php 
							  		if(!empty($department['data'])){
							  			foreach ($department['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['DEP_Id'])?>" ><?=$value['DEP_Description']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
					</span>
					<span class="col-md-6">
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Buyer:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="Buyer" id="" name="IM_FK_BuyerClass_id" tabindex="9">
							  	<option value="" disabled selected>Buyer</option>
							  	<?php 
							  		if(!empty($buyer)){
							  			foreach ($buyer['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['B_Id'])?>" ><?=$value['B_Description']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Manufacturer Part No.:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="50" tabindex="16" name="IM_ManufacturerPartNo" placeholder="Manufacturer Part No">
					      </div>
					    </div>
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Model:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="20" tabindex="17" name="IM_Model" placeholder="Model">
					      </div>
					    </div>				    		    
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Sale Price:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="18" name="IM_SalePrice" placeholder="Sale Price">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Sale Item:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="19"  name="IM_SaleType">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Promo:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="20"  name="IM_Promo">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Consigned:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="21" name="IM_Consign">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Royalty:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="22"  name="IM_Royalty">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Serialize:</label>
					      <div class="col-xs-7">
					        <input type="checkbox"  tabindex="23" name="IM_Serialize">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Package Item:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="24"  name="IM_PackageItem">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Imported:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="25"  name="IM_Imported">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">PAR Item:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="26"  name="IM_PAR_Item" >
					      </div>
					    </div>
					</span>
				</div> -->
				<div class="container-fluid">
					<legend>Supplier - Item Information</legend>
					<div class="container-fluid">
						<div class="row">
							<span class="col-md-6">
								<div class="form-group">
							      <label class="control-label col-xs-5" for="">Defalut Supplier:</label>
							      <div class="col-xs-7">
							       	<select class="form-control single-default select-cli" placeholder="Supplier" id="" name="IM_FK_Supplier_id" tabindex="12">
									  	<option value="" disabled selected>Supplier</option>
									  	<?php 
									  		if(!empty($supplier)){
									  			foreach ($supplier['data'] as $key => $value) {
									  	?>
									  		<option value="<?=trim($value['S_Id'])?>" ><?=$value['S_Name']?></option>
									  	<?php }} ?>
									</select>
							      </div>
							    </div>
							</span>
						</div>
					</div>
					<div class="table-container">
						<table id="others-tbl" class="table table-striped table-hover table-bordered  table-condensed">
							<thead>
								<tr>
									<th class="col-md-1">
										<a href="javascript:void(0)" class="pre-row-s">
											<span class="glyphicon glyphicon-plus"></span>
										</a>
									</th>
									<th class="col-md-3">Supplier</th>
									<th class="col-md-3">Supplier Item Code</th>
									<th class="col-md-3">Old Item Code</th>
									<th class="col-md-1">Last PO Cost</th>
									<th class="col-md-1">Status</th>
								</tr>
							</thead>
							<tbody>
								<tr class="h-row">
									<td>
										<a href="javascript:void(0)" class="d-row-n">
											<span class="glyphicon glyphicon-remove"></span>
										</a>
									</td>
									<td>
										<div class="form-group container-fluid">
											<div class="col-sm-12">
												<select class="form-control single-default select-supplier" placeholder="Supplier" id="" name="IM_FK_Supplier_id" tabindex="13">
												  	<option value="" disabled selected>Supplier</option>
												  	<?php 
												  		if(!empty($supplier)){
												  			foreach ($supplier['data'] as $key => $value) {
												  	?>
												  		<option value="<?=trim($value['S_Id'])?>" ><?=$value['S_Name']?></option>
												  	<?php }} ?>
												</select>
											</div>	
										</div>
									</td>
									<td>
										<div class="form-group container-fluid">
											<div class="col-sm-12">
										 		<input type="text" class="form-control s-i-d" maxlength="30" id="" tabindex="14" name="" placeholder="Supplier Item Code">
											</div>
									  	</div>
									</td>
									<td>
										<div class="form-group container-fluid">
											<div class="col-sm-12">
										 		<input type="text" class="form-control o-i-d" maxlength="30" id="" tabindex="15" name="" placeholder="Old Item Code">
											</div>
									  	</div>
									</td>
									<td>
									</td>
									<td>
										<div class="form-group container-fluid">
											<div class="col-sm-12">
										 		<input type="checkbox" class="s-i-a" id="" tabindex="16" name="">
											</div>
									  	</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="container-fluid">
					<legend>Item Classification & Grouping</legend>
					<span class="col-md-6">
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Buyer:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="Buyer" id="" name="IM_FK_BuyerClass_id" tabindex="17">
							  	<option value="" disabled selected>Buyer</option>
							  	<?php 
							  		if(!empty($buyer)){
							  			foreach ($buyer['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['B_Id'])?>" ><?=$value['B_Description']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Concerned Department:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="Concerned Department" id="" name="IM_FK_Department_id" tabindex="18">
							  	<option value="" disabled selected>Concerned Department</option>
							  	<?php 
							  		if(!empty($department['data'])){
							  			foreach ($department['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['DEP_Id'])?>" ><?=$value['DEP_Description']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Inventory Posting Group:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="Inventory Posting Group" id="" name="IM_INVPosting_Group" tabindex="19">
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
					   <!--  <div class="form-group">
					      <label class="control-label col-xs-5" for="">VAT Posting Group:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="VAT Posting Group" id="" name="IM_VATProductPostingGroup" tabindex="17">
							  	<option value="" disabled selected>VAT Posting Group</option>
							  	<?php 
							  		if(!empty($VAT)){
							  			foreach ($VAT['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['VPPG_Code'])?>" ><?=$value['VPPG_Code']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div> -->
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">WHT Posting Group:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="WHT Posting Group" id="" name="IM_WHTProductPostingGroup" tabindex="20">
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
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Serialized:</label>
					      <div class="col-xs-7">
					        <input type="checkbox"  tabindex="21" name="IM_Serialize">
					      </div>
					    </div>
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Imported:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="22"  name="IM_Imported">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">PAR Item:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="23"  name="IM_PAR_Item" >
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">For Transfer:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="24" name="IM_ForTO" >
					      </div>
					    </div>
					</span>
				</div>
				<div class="container-fluid">
					<legend>UOM Conversion</legend>
					<div class="table-container">
						<table id="others-tbl" class="table table-striped table-hover table-bordered  table-condensed">
							<thead>
								<tr>
									<th class="col-md-1">
										<a href="javascript:void(0)" class="pre-row">
											<span class="glyphicon glyphicon-plus"></span>
										</a>
									</th>
									<th class="col-md-7">UOM</th>
									<th class="col-md-4">Qty</th>
								</tr>
							</thead>
							<tbody>
								<tr class="h-row">
									<td>
										<a href="javascript:void(0)" class="d-row-n">
											<span class="glyphicon glyphicon-remove"></span>
										</a>
									</td>
									<td>
										<div class="form-group container-fluid">
											<div class="col-sm-9">
												<select class="form-control single-default select-uom" placeholder="UOM" id="" name="IM_FK_Attribute_UOM_id" tabindex="25">
												  	<option value="" disabled selected>UOM</option>
												  	<?php 
												  		if(!empty($uom)){
												  			foreach ($uom['data'] as $key => $value) {
												  	?>
												  		<option value="<?=trim($value['AD_Id'])?>" ><?=$value['AD_Desc']?></option>
												  	<?php }} ?>
												</select>
											</div>	
										</div>
									</td>
									<td>
										<div class="form-group container-fluid">
											<div class="col-sm-6">
										 		<input type="text" class="form-control s-qty" id="" tabindex="26" name="" placeholder="Quantity">
											</div>
									  	</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="27" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="28" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="29" href="<?= base_url() ?>app/administration/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

(function ( $ ) {

	var xhr;
	var itemtype, $itemtype;
	var category, $category;
	var subcategory, $subcategory;

	 $nseries = $('input[name=IM_DocNo]').numseries({
                  target:base_url+'app/administration/item-master/getseries',
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

	itemtype 	= $itemtype[0].selectize;
	category  	= $category[0].selectize;
	subcategory = $subcategory[0].selectize;

	category.disable();
	subcategory.disable();

	$('.dc-mal').maskMoney({thousands:',', decimal:'.', allowZero:false, precision:4});
  
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
	
	$('.f-date').datepicker();

	$('.pre-row').on('click',function(){
		_this 	= $(this);
		row 	= _this.closest('table').find('tbody tr.h-row').clone();
		_this.closest('table').find('tbody').prepend(row.show(300).removeClass('h-row'));
		id = (new Date()).getTime();
		stize(row.find('.select-uom').attr('name','uom['+id+'][IUC_FK_UOM_id]'));
		row.find('.s-qty').attr('name','uom['+id+'][IUC_Quantity]');
	});

	$('.pre-row-s').on('click',function(){
		_this 	= $(this);
		row 	= _this.closest('table').find('tbody tr.h-row').clone();
		_this.closest('table').find('tbody').prepend(row.show(300).removeClass('h-row'));
		id = (new Date()).getTime();
		stize(row.find('.select-supplier').attr('name','supplier['+id+'][IS_FK_Suppllier_id]'));
		row.find('.s-i-d').attr('name','supplier['+id+'][IS_SupplierItemCode]');
		row.find('.o-i-d').attr('name','supplier['+id+'][IS_OldItemCode]');
		row.find('.s-i-a').attr('name','supplier['+id+'][IS_Active]');
	});

	$(document).on('click','.d-row-n',function(){
		_this = $(this);
		confirm("Delete Row?", function(confirmed) {
	        if(confirmed){ 
				_this.closest('tr').fadeOut(500, function(){ $(this).remove();});
			}
		});
	});
	
	$(document).on("click","#update",function(){
	    var $btn = $(this);
	    
	    confirm("Save Entry?", function(confirmed) {
	        if(confirmed){ 
		        $btn.attr('disabled',true).text('Processing..');
		        form = $('#'+_class+"-form");
		        data = form.serializeArray();
		        data.push({name:"type",value:'update'},
          	  			  {name:"uniqid",value:$btn.data('id')});
		        
		        $(form).find('input[type=checkbox]').each(function() {
		           data.push({name:this.name,value:this.checked ? 1 : 0});
		        });

		        
		        $.post(base_url+'app/administration/item-master/process',data,function(data){
		          if(data.result == 0){
		       		 error_message(data.errors);
		          }else{
		            alert('Saved!');
            		window.location = base_url+'app/administration/'+_class;
		          }
		          $btn.attr('disabled',false).text('Save & Close');
		        },'json').error(function(){
		          alert('Error!');
		          $btn.attr('disabled',false).text('Save & Close');
		        });
	      	}
    	});
  	});	
	
	$(document).on("click","#update-new",function(){
	    var $btn = $(this);
	    
	    confirm("Save Entry?", function(confirmed) {
	        if(confirmed){ 
		        $btn.attr('disabled',true).text('Processing..');
		        form = $('#'+_class+"-form");
		        data = form.serializeArray();
		        data.push({name:"type",value:'update'},
          	  			  {name:"uniqid",value:$btn.data('id')});
		        
		        $(form).find('input[type=checkbox]').each(function() {
		           data.push({name:this.name,value:this.checked ? 1 : 0});
		        });

		        
		        $.post(base_url+'app/administration/item-master/process',data,function(data){
		          if(data.result == 0){
		        	error_message(data.errors);
		          }else{
		            $('.form-group').removeClass('has-error').tooltip('destroy');
		            form[0].reset();
		            $select.each(function(){
		              $(this)[0].selectize.clear();
		            });
		            $itemtype[0].selectize.clear();
					$category[0].selectize.clear();
					$subcategory[0].selectize.clear();
		            $('table').find('tbody tr:not(.h-row)').remove();
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

	$(document).on("click","#save-new",function(){
	    var $btn = $(this);
	    
	    confirm("Save Entry?", function(confirmed) {
	        if(confirmed){ 
		        $btn.attr('disabled',true).text('Processing..');
		        form = $('#'+_class+"-form");
		        data = form.serializeArray();
		        data.push({name:'type',value:'add'});
		        
		        $(form).find('input[type=checkbox]').each(function() {
		           data.push({name:this.name,value:this.checked ? 1 : 0});
		        });
     
		        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
		          if(data.result == 0){
		        	error_message(data.errors);
		          }else{
		            $('.form-group').removeClass('has-error').tooltip('destroy');
		            form[0].reset();
		            $select.each(function(){
		              $(this)[0].selectize.clear();
		            });
		            $itemtype[0].selectize.clear();
					$category[0].selectize.clear();
					$subcategory[0].selectize.clear();
		            $('table').find('tbody tr:not(.h-row)').remove();
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
	
	$(document).on("click","#save-close",function(){
	    var $btn = $(this);
	    
	    confirm("Save Entry?", function(confirmed) {
	        if(confirmed){ 
		        $btn.attr('disabled',true).text('Processing..');
		        form = $('#'+_class+"-form");
		        data = form.serializeArray();
		        data.push({name:'type',value:'add'});
		        
		        $(form).find('input[type=checkbox]').each(function() {
		           data.push({name:this.name,value:this.checked ? 1 : 0});
		        });

		       	$('.form-group').removeClass('has-error').find('div:first .alert').remove();
		        
		        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
		          if(data.result == 0){
		            error_message(data.errors);
		          }else{
		            alert('Saved!');
            		window.location = base_url+'app/administration/'+_class;
		          }
		          $btn.attr('disabled',false).text('Save & Close');
		        },'json').error(function(){
		          alert('Error!');
		          $btn.attr('disabled',false).text('Save & Close');
		        });
	      	}
    	});
  	});	
	
	function stize(elem){
		 	elem.selectize({
                  sortField: 'text',
                  plugins: {
						'dropdown_header': {
							title: elem.attr('placeholder')
						}
					},
				  dropdownParent:'body'
                });
	}

}( jQuery ));
</script>