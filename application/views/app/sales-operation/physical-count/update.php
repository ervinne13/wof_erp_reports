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
				        <input type="text" class="form-control" id="" tabindex="1" name="PC_DocNo" value="<?=$data['PC_DocNo']?>" placeholder="Document No.">
				      </div>
					</div>	
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="15" name="PC_Description" value="<?=$data['PC_Description']?>" placeholder="Description">
				      </div>
				    </div>			    							     					
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <?php 
				        $location 	= $this->session->userdata('location');
			         	$dlocation 	= $this->session->userdata('dlocation')['SP_StoreID'];
				        $dcompany 	= $this->session->userdata('dlocation')['SP_FK_CompanyID'];
				        if(count($location) > 1){ 
				        ?>
				        <select class="form-control single-default" placeholder="Location" id="lc" name="PC_Location" tabindex="9">
						  	<option value="" disabled selected>Location</option>
						  	<?php foreach ($location as $key => $value) { ?>
						  		<option value="<?=$value['SP_StoreID']?>" <?=($data['PC_Location'] == $value['SP_StoreID'])||($dlocation == $value['SP_StoreID'])?'selected':''?> ><?=$value['SP_StoreName']?></option>
						  	<?php } ?>
						</select>
					  	<?php }else{ ?>
					  		<input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="10" name="PC_Location" placeholder="Location">
				        <?php } ?>
				      </div>
				    </div>
				    </span>
				    <span class="col-md-6">
				     <div class="form-group">
				      	<label class="control-label col-xs-5" for="">Doc. Date:</label>
				      	<div class="col-xs-7">
				        	<input type="text" class="form-control" id="" disabled tabindex="8" value="<?=date("m/d/Y",time())?>" placeholder="Document Date">
				      	</div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Required:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="7" value="<?=date_format(date_create($data['PC_CountDate']), 'm-d-Y')?>" name="PC_CountDate" placeholder="Date Required">
				      </div>
				    </div>    
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="status" tabindex="15" data-id="" name="PC_Status" value="<?=$data['PC_Status']?>" placeholder="Status">
				      </div>
				    </div>		
				</span>	
			<div class="container-fluid">
			<legend>Physical Count </legend>
			<div class="table-container">
				<table id="others-tbl" class="table table-striped table-hover table-bordered  table-condensed">
					<thead>
						<tr>
							<th class="col-md-1">
								<a href="javascript:void(0)" class="pre-row">
									<span class="glyphicon glyphicon-plus"></span>
								</a>
							</th>
							<th class="col-md-2">Count Sheet No</th>
							<th class="col-md-4">Item Type</th>
							<th class="col-md-4">Sub Location</th>
						</tr>
					</thead>
					<tbody>
						<tr class="h-row">
							<td>
								<a href="javascript:void(0)" class="d-row-n">
									<span class="glyphicon glyphicon-remove"></span>
								</a>
								<a href="javascript:void(0)"  class="d-search">
									<span class="glyphicon glyphicon-search"></span>
								</a>
							</td>
							<td class= "col-m-1">
							</td>
							<td>
								<div class="form-group container-fluid">
									<div class="col-sm-7">		
										<select class="form-control single-default select-mul pcs-item-type" placeholder="ItemType" multiple id="" name="PCS_ItemType" tabindex="29">
												 <option value="" disabled selected></option>
												 <?php 
												  if(!empty($itemtype)){
												  	foreach ($itemtype['data'] as $key => $value) {
												 ?>
												  <option value="<?=trim($value['IT_Id'])?>" ><?=$value['IT_Description']?></option>
												 <?php }} ?>
										</select>
									</div>	
								</div>
							</td>
							<td>
								<div class="form-group container-fluid">
                      				<div class="col-sm-7">
                        				<select class="form-control single-default select-multi" placeholder="SubLocation" multiple id="" name="PCS_SubLocation" tabindex="25">
                            				<option value="" disabled selected>SubLocation</option>
                            				<?php 
                              				if(!empty($locat)){
                                				foreach ($locat['data'] as $key => $value) {
                            				?>
                              				<option value="<?=trim($value['LOC_Id'])?>" ><?=$value['LOC_Id']?></option>
                            				<?php }} ?>
                        				</select>
                      				</div>  
                    			</div>
							</td>								
						</tr>
						<?php foreach ($details as $key => $res) { ?>						
						<tr class="o-row">
							<td>
								<a href="javascript:void(0)" class="d-row-n">
									<span class="glyphicon glyphicon-remove"></span>
								</a>
								<a href="javascript:void(0)" data-doc-no = "<?=$res['PCS_PC_DocNo'] ?>" id = "<?= md5($res['PCS_CS_CountSheetNo'])?>" class="d-search">
									<span class="glyphicon glyphicon-search"></span>
								</a>
							</td>
							<td class= "countsheet-no">
								<?= $res['PCS_CS_CountSheetNo']?>
							</td>
							<td>
								<div class="form-group container-fluid">
									<div class="col-xs-7">
				        				<select class="form-control single-default select-multiple" placeholder="Item Type" multiple id="" name="" tabindex="1">
						  					<option value="" disabled selected>Item Type</option>
						  					<?php 
						  						if(!empty($itemtypes)){
						  							foreach ($itemtypes['data'] as $key => $value) {
						  					?>
						  						<option value="<?=trim($value['IT_Id'])?>" <?= in_array($value['IT_Id'], $res['PCS_ItemType'])?'selected':'' ?>><?=$value['IT_Description']?></option>					
						  					<?php }}?>
										</select>
				      				</div> 
								</div>						  				
							</td>
							<td>
								<div class="form-group container-fluid">
									<div class="col-xs-7">
				        				<select class="form-control single-default select-multiple1" placeholder="SubLocation" multiple id="" name="" tabindex="1">
						  					<option value="" disabled selected>SubLocation</option>
						  					<?php 
						  						if(!empty($locat)){
						  							foreach ($locat['data'] as $key => $value) {
						  					?>
						  						<option value="<?=trim($value['LOC_Id'])?>" <?= in_array($value['LOC_Id'],$res['PCS_SubLocation'])?'selected':'' ?>><?=$value['LOC_Id']?></option>
						  					<?php }} ?>
										</select>
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
	
	var loc 			= <?= json_encode(array_column($this->session->userdata('location'),'SP_StoreID'))?>;

	var locJSON			= <?= json_encode($locat['data']); ?>;
	
	var locStrucJSON	= <?= json_encode($locStructure['data']); ?>;

	var loca,$loca,curLoc=null;

	var detailsFields = [];

	var details = "";

	_module = 'sales-operation';
	_class = 'physical-count';

	function get_sub(loc_id,subLocArray){
		for(var i in locStrucJSON){
			if(locStrucJSON[i]['LOC_Parent_id'] == loc_id){
				if(locStrucJSON[i]['LOC_Parent_id']){
					subLocArray.push(locStrucJSON[i]['LOC_Id']);
					get_sub(locStrucJSON[i]['LOC_Id'],subLocArray);
				}
			}
		}
		return subLocArray;
	}
	
$('.select-multiple').each(function(index, obj){
                $(this).selectize({
                  sortField: 'text',
                  plugins:{
            'dropdown_header': {
              title: $(obj).attr('placeholder')
            }             
          }
                });
              });

// var itemtype = $(".select-multiple").val();
// var subloc   = $(".select-multiple1").val();

// $(".select-multiple").selectize({
//         create: false,
//         plugins:['restore_on_backspace','remove_button'],
//         sortField: 'text',
//         selectOnTab: true
// 	});
 	
$('.select-multiple1').each(function(index, obj){
                $(this).selectize({
                  sortField: 'text',
                  plugins: {
            'dropdown_header': {
              title: $(obj).attr('placeholder')
            }
          }
                });
              });

$('.pre-row').on('click',function(){
    _this   = $(this);
    row   = _this.closest('table').find('tbody tr.h-row').clone();
    _this.closest('table').find('tbody').append(row.show(300).removeClass('h-row'));
    id = (new Date()).getTime();

    var countSheetNo = $('tbody tr').length-1;
    row.find('td:eq(1)').text(countSheetNo);
    var itemTypeSel = stize(row.find('.select-mul').attr('name','['+id+'][PCS_ItemType]'));
    var subLocSel = stize(row.find('.select-multi').attr('name','['+id+'][PCS_SubLocation]'));
    
    var itemtype = $('body').find(".select-multiple").val(); 
    var subloc = $('body').find(".select-multiple1").val();

    console.log(itemtype);

	/*get the data upon adding row*/
    detailsFields.push({
      countSheetNo:countSheetNo,
      itemTypeSel:itemTypeSel,
      subLocSel: subLocSel
    	});
  	});


	$('body').on('click', '.d-search', function() {
	
		var id = $(this).attr("id");
		var docNo = $(this).data("doc-no");

		location.href = base_url + "app/sales-operation/physical-count/viewdetail?id=" + id + "&docNo=" + docNo;
			// console.log(location.href);
	});

function stize(elem){
    $el = elem.selectize({
                      sortField: 'text',
                      plugins: {
            'dropdown_header': {
            }
            },
      
    });

    return $el;
  }
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

	$('input[name=PC_CountDate]').datepicker({
		dateFormat:'mm/dd/yy'
	}).mask("99/99/9999");

  if($('select[name=PC_Location]').length > 0){
		$loca = $('select[name=PC_Location]').selectize({
	                    sortField: 'text',
	                    create: false,
					    onItemRemove:function(value){
					    	$('#com_id').val('');
					    },
	                   	onChange: function(value) {
	                   		if (!value.length) return;
	                   		for(var i in locJSON){
			            		if(value == locJSON[i]['SP_StoreID']){
			            			curLoc = locJSON[i]['LOC_Id'];
			            			break;
			            		}
			            	}
				    	}
	                });
		loca 	= $loca[0].selectize;
		loca.setValue('<?=$dlocation?>');
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

   $(document).on("click","#update",function(){
      var $btn = $(this);
      var $lbl = $btn.text();
      var form = $('#'+_class+"-form");
     
      confirm("Save Entry?", function(confirmed) {
          if(confirmed){ 
          
            $btn.attr('disabled',true).text('Processing..');
            data = form.serializeArray();            
            data.push({name:"type",value:'update'},
                      {name:"uniqid",value:$btn.data('id')}
                      );

          var formData = new FormData();         
          // console.log(form);

          var details = [];

          //	add already exising documents
          $('.o-row').each(function() {
          	var countSheetNo = $(this).find('.countsheet-no').html();
          	var itemtype = $(this).find(".select-multiple").val(); 
		    var subloc = $(this).find(".select-multiple1").val();

		    details.push({
		      PCS_CS_CountSheetNo:countSheetNo,
		      PCS_ItemType:itemtype,
		      PCS_SubLocation: subloc
		    	});
          });
          
          for (var i = 0; i < detailsFields.length; i ++) {
           	  detailsRow = detailsFields[i];
              details.push({ //push the object onto the array
              PCS_CS_CountSheetNo: detailsRow.countSheetNo,
              PCS_ItemType: detailsRow.itemTypeSel[0].selectize.getValue(),
              PCS_SubLocation: detailsRow.subLocSel[0].selectize.getValue()
            });
          }

        $(form).find('input[type=checkbox]').each(function() {
           data.push({ name: this.name, value: this.checked ? 1 : 0 });
        });

        $.each(data, function (key, input) {
            formData.append(input.name, input.value);
        });

        formData.append('details', JSON.stringify(details));

        $.ajax({
	        url: base_url+'app/'+ _module + "/" +_class+'/process',
	        type: 'POST',
	        data: formData,
	        dataType:'json',
	        processData: false,
       		contentType: false,
	        success: function(data) {
	            if(data.result == 0){
      				error_message(data.errors);
        			grid.validateCells(function(){});
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

					