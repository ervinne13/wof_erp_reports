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
							  			foreach ($type['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['IT_Id'])?>" <?=trim($data['IM_FK_ItemType_id'])==trim($value['IT_Id']) ? 'selected': '' ?> ><?=$value['IT_Description']?></option>
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
							  		if(!empty($category['data'])){
							  			foreach ($category['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['CAT_Id'])?>" <?=trim($data['IM_FK_Category_id'])==trim($value['CAT_Id']) ? 'selected': '' ?> ><?=$value['CAT_Desc']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Sub Category:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default" placeholder="Sub Category" id="" name="IM_FK_SubCategory_id" tabindex="3">
							  	<option value="" disabled selected>Sub Category</option>
							  	<?php 
							  		if(!empty($subcategory['data'])){
							  			foreach ($subcategory['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['SC_Id'])?>" <?=trim($data['IM_FK_SubCategory_id'])==trim($value['SC_Id']) ? 'selected': '' ?> ><?=$value['SC_Description']?></option>
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
									<?=$identifiers?>
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
					        <input type="text" class="form-control" id="" maxlength="30" disabled tabindex="4" value="<?=$data['IM_DocNo']?>" placeholder="Document No.">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">Item Code:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" readonly maxlength="30" value="<?=$data['IM_Item_id']?>" tabindex="5" name="IM_Item_id" placeholder="Item Code">
					      </div>
						</div>
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-5">UPCode:</label>
						  <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="30" value="<?=$data['IM_UPCCode']?>" tabindex="6" name="IM_UPCCode" placeholder="UPC Code">
					      </div>
						</div>
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Item Description:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="200" readonly value="<?=$data['IM_Sales_Desc']?>" tabindex="7" name="IM_Sales_Desc" placeholder="Item Description">
					      </div>
					    </div>
						<!-- <div class="form-group">
					      <label class="control-label col-xs-5" for="">Purchase Description:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="200" value="<?=$data['IM_Purchased_Desc']?>" tabindex="4" name="IM_Purchased_Desc" placeholder="Purchase Description">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Short Description:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" maxlength="25"  value="<?=$data['IM_Short_Desc']?>" tabindex="5" name="IM_Short_Desc" placeholder="Short Description">
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
							  		<option value="<?=trim($value['AD_Id'])?>" <?=trim($data['IM_FK_Attribute_UOM_id'])==trim($value['AD_Id']) ? 'selected': '' ?>  ><?=$value['AD_Desc']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Last PO Cost:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="9" value="<?=$data['IM_UnitCost']?>" name="IM_UnitCost" placeholder="Last Direct Cost">
					      </div>
					    </div> 
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Landed Cost:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control dc-mal" id="" maxlength="20" tabindex="10" value="<?=$data['IM_CostOfGoods']?>" name="IM_CostOfGoods" placeholder="Landed Cost">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">Points:</label>
					      <div class="col-xs-7">
					        <input type="text" class="form-control" id="" tabindex="11" name="IM_Points" value="<?=$data['IM_Points']?>" placeholder="Points">
					      </div>
					    </div>
					</span>
				</div>
				
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
									  		<option value="<?=trim($value['S_Id'])?>" <?=trim($data['IM_FK_Supplier_id'])==trim($value['S_Id']) ? 'selected': '' ?> ><?=$value['S_Name']?></option>
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
								<?php foreach ($sup as $key => $rec) { ?>
								<tr class="o-row">
									<td>
										<a href="javascript:void(0)" class="d-row-n">
											<span class="glyphicon glyphicon-remove"></span>
										</a>
									</td>
									<td>
										<div class="form-group container-fluid">
											<div class="col-sm-12">
												<select class="form-control single-default select-cli" name="old-s[<?=$rec['IS_Id']?>][IS_FK_Suppllier_id]" tabindex="17" placeholder="Supplier" id="" name="IM_FK_Supplier_id">
												  	<option value="" disabled selected>Supplier</option>
												  	<?php 
												  		if(!empty($supplier)){
												  			foreach ($supplier['data'] as $key => $value) {
												  	?>
												  		<option value="<?=trim($value['S_Id'])?>" <?=$value['S_Id'] == $rec['IS_FK_Suppllier_id']? 'selected':'' ?> ><?=$value['S_Name']?></option>
												  	<?php }} ?>
												</select>
											</div>	
										</div>
									</td>
									<td>
										<div class="form-group container-fluid">
											<div class="col-sm-12">
										 		<input type="text" class="form-control s-i-d" name="old-s[<?=$rec['IS_Id']?>][IS_SupplierItemCode]" value="<?=$rec['IS_SupplierItemCode']?>" maxlength="30" id="" tabindex="18" name="" placeholder="Supplier Item Code">
											</div>
									  	</div>
									</td>
									<td>
										<div class="form-group container-fluid">
											<div class="col-sm-12">
										 		<input type="text" class="form-control o-i-d" name="old-s[<?=$rec['IS_Id']?>][IS_OldItemCode]" value="<?=$rec['IS_OldItemCode']?>" maxlength="30" id="" tabindex="19" name="" placeholder="Old Item Code">
											</div>
									  	</div>
									</td>
									<td>
									</td>
									<td>
										<div class="form-group container-fluid">
											<div class="col-sm-12">
										 		<input type="checkbox" class="s-i-a" name="old-s[<?=$rec['IS_Id']?>][IS_Active]" <?=$rec['IS_Active'] == '1'? 'checked':'' ?> id="" tabindex="20" name="">
											</div>
									  	</div>
									</td>
								</tr>
								<?php } ?>
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
					        <select class="form-control single-default select-cli" placeholder="Buyer" id="" name="IM_FK_BuyerClass_id" tabindex="21">
							  	<option value="" disabled selected>Buyer</option>
							  	<?php 
							  		if(!empty($buyer)){
							  			foreach ($buyer['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['B_Id'])?>" <?=$data['IM_FK_BuyerClass_id']==$value['B_Id'] ? 'selected': '' ?> ><?=$value['B_Description']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Concerned Department:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="Concerned Department" id="" name="IM_FK_Department_id" tabindex="22">
							  	<option value="" disabled selected>Concerned Department</option>
							  	<?php 
							  		if(!empty($department['data'])){
							  			foreach ($department['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['DEP_Id'])?>" <?=$data['IM_FK_Department_id']==$value['DEP_Id'] ? 'selected': '' ?> ><?=$value['DEP_Description']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Inventory Posting Group:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="Inventory Posting Group" id="" name="IM_INVPosting_Group" tabindex="23">
							  	<option value="" disabled selected>Inventory Posting Group</option>
							  	<?php 
							  		if(!empty($INV)){
							  			foreach ($INV['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['IPG_Code'])?>" <?=trim($data['IM_INVPosting_Group'])==trim($value['IPG_Code']) ? 'selected': '' ?> ><?=$value['IPG_Code']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
					    <!-- <div class="form-group">
					      <label class="control-label col-xs-5" for="">VAT Posting Group:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="VAT Posting Group" id="" name="IM_VATProductPostingGroup" tabindex="17">
							  	<option value="" disabled selected>VAT Posting Group</option>
							  	<?php 
							  		if(!empty($VAT)){
							  			foreach ($VAT['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['VPPG_Code'])?>" <?=trim($data['IM_VATProductPostingGroup'])==trim($value['VPPG_Code']) ? 'selected': '' ?> ><?=$value['VPPG_Code']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div> -->
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">WHT Posting Group:</label>
					      <div class="col-xs-7">
					        <select class="form-control single-default select-cli" placeholder="WHT Posting Group" id="" name="IM_WHTProductPostingGroup" tabindex="24">
							  	<option value="" disabled selected>WHT Posting Group</option>
							  	<?php 
							  		if(!empty($WHT)){
							  			foreach ($WHT['data'] as $key => $value) {
							  	?>
							  		<option value="<?=trim($value['WPPG_Code'])?>"  <?=trim($data['IM_WHTProductPostingGroup'])==trim($value['WPPG_Code']) ? 'selected': '' ?> ><?=$value['WPPG_Code']?></option>
							  	<?php }} ?>
							</select>
					      </div>
					    </div>
					</span>
					<span class="col-md-6">
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Serialized:</label>
					      <div class="col-xs-7">
					        <input type="checkbox"  tabindex="25" <?=$data['IM_Serialize']=='1'?'checked':''?> name="IM_Serialize">
					      </div>
					    </div>
						<div class="form-group">
					      <label class="control-label col-xs-5" for="">Imported:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="26" <?=$data['IM_Imported']=='1'?'checked':''?> name="IM_Imported">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">PAR Item:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="27" <?=$data['IM_PAR_Item']=='1'?'checked':''?>  name="IM_PAR_Item" >
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-xs-5" for="">For Transfer:</label>
					      <div class="col-xs-7">
					        <input type="checkbox" tabindex="28" <?=$data['IM_ForTO']=='1'?'checked':''?>  name="IM_ForTO" >
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
												<select class="form-control single-default select-uom" placeholder="UOM" id="" name="IM_FK_Attribute_UOM_id" tabindex="29">
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
										 		<input type="text" class="form-control s-qty" id="" tabindex="30" name="" placeholder="Quantity">
											</div>
									  	</div>
									</td>
								</tr>
								<?php foreach ($sub as $key => $rec) { ?>
								<tr class="o-row">
									<td>
										<a href="javascript:void(0)" data-id='<?=$value['PCS_PC_DocNo']?>' class="d-row-n">
											<span class="glyphicon glyphicon-remove"></span>
										</a>
									</td>
									<td>
										<div class="form-group container-fluid">
											<div class="col-sm-9">
												<select class="form-control single-default select-cli" placeholder="UOM" id="" name="old[<?=$rec['IUC_Id']?>][IUC_FK_UOM_id]" tabindex="31">
												  	<option value="" disabled selected>UOM</option>
												  	<?php 
												  		if(!empty($uom)){
												  			foreach ($uom['data'] as $key => $value) {
												  	?>
												  		<option value="<?=trim($value['AD_Id'])?>" <?= $rec['IUC_FK_UOM_id']==$value['AD_Id']?'selected':'' ?> ><?=$value['AD_Desc']?></option>
												  	<?php }} ?>
												</select>
										 	</div>
										</div>
									</td>
									<td>
										<div class="form-group container-fluid">
											<div class="col-sm-6">
										 		<input type="text" class="form-control s-qty" id="" value="<?= trim($rec['IUC_Quantity']) ?>" tabindex="32" name="old[<?=$rec['IUC_Id']?>][IUC_Quantity]" placeholder="Quantity">
											</div>
									  	</div>
									</td>	
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="33" data-id="<?= $data['id']; ?>" id="item-update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="34" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
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
	var updates = <?=$data['IM_Updates']?>;

	$(document).ready(function(){
		for(var i in updates){
			_this = $('[name='+i+']');
			if(updates[i]!=null){
				if(updates[i]!=_this.val()){
					_this.closest('.form-group').addClass('alert-danger');
				}
			}
		}
	});


		$('#item').on('click',function(e){
  		e.preventDefault();
  		window.location =  base_url + 'app/' + _module + '/' + _class + '/item_ledger?id=' + $(this).data('id');
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
	        getdescription();
	        getitemidupdate();
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
	    	getitemidupdate();
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

	itemtype 			= $itemtype[0].selectize;
	category  			= $category[0].selectize;
	subcategory  		= $subcategory[0].selectize;

	$('.dc-mal').maskMoney({thousands:',', decimal:'.', allowZero:false, precision:4});
  
  	$('.dc-mal').maskMoney('mask',this.value);
  	
	$select = $('.select-cli').each(function(index, obj){
                $(this).selectize({
                  sortField: 'text',
                  plugins: {
						'dropdown_header': {
							title: $(obj).attr('placeholder')
						}
					},
				  dropdownParent:'body'
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
				_this.closest('tr').fadeOut(500, function(){ 
					$(this).remove();
					$('#item-update').attr('disabled',false);
				});
			}

		});

	});

	$("#item-update").on("click",function(){
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

		        
		        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
		          if(data.result == 0){
		       		 error_message(data.errors);
		          }else{
		            alert('Saved!');
            		window.location = base_url+'app/administration/'+_class;
		          }
		          $btn.attr('disabled',false).text('Save');
		        },'json').error(function(){
		          alert('Error!');
		          $btn.attr('disabled',false).text('Save');
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
	
	// check_if_changed($('#' + _class + '-form'),$('#item-update'));

}( jQuery ));
</script>