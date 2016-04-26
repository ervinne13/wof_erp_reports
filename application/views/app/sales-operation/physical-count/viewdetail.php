<div class="panel">
  	<div class="panel-heading">  
      	<h3 class="panel-title">
          	<?=$title?>
			      <?=$function?>
      	</h3>
  	</div>
<div class="panel-body">
	<div id="data-container" class="container-fluid">
		<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
			<span class="col-md-6">     
        <?php foreach ($data1 as $key => $item) { ?>
        <div class="form-group">
          <label for="sel1" class="control-label col-xs-5">Count Sheet No.:</label>
            <div class="col-xs-7">
              <input type="text" class="form-control" readonly value="<?=$item['PCS_CS_CountSheetNo']?>" name="CSD_CS_CountSheetNo">
            </div>
        </div>
          <!-- ITEM TYPE -->
        <div class="form-group">
          <label for="sel1" class="control-label col-xs-5">Item Type:</label>
          <div class="col-xs-7" >
            <select multiple class="form-control single-default select-multiple"  id="" disabled name="CSD_CS_PCS_ItemType" tabindex="1">
                  <?php 
                        if(!empty($itemtypes)){
                            foreach ($itemtypes['data'] as $key => $value) {
                         ?>
                          <option value="<?=trim($value['IT_Id'])?>" <?= in_array($value['IT_Id'],$item["PCS_ItemType"])?'selected':'' ?>><?=$value['IT_Description']?></option>
                         <?php }} ?>
            </select>
          </div> 
        </div>    
        <div class="form-group">
              <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" readonly value="<?=$data['PC_DocNo']?>" name="CSD_CS_PC_DocNo">
              </div>
        </div>
      </span>
      <span class="col-md-5">
      	<div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Sub Location:</label>
            <div class="col-xs-7">
                <select multiple class="form-control single-default select-multiple"  id="" disabled  name="PCS_SubLocation" tabindex="1">
                        <?php 
                          if(!empty($locat)){
                            foreach ($locat['data'] as $key => $value) {
                        ?>
                          <option value="<?=trim($value['LOC_Id'])?>" <?= in_array($value['LOC_Id'],$item['PCS_SubLocation'])?'selected':'' ?> ><?=$value['LOC_Id']?></option>
                        <?php }} ?>
                </select>
            </div> 
        </div>
      	<div class="form-group">
      			<label class="control-label col-xs-5" for="sel1">Count Date:</label>
      			<div class="col-xs-7">
      				<input type="text" class="form-control" readonly value="<?=format($data['PC_CountDate'])?>">
      			</div> 
      	</div> 
            <?php } ?>  				 
      	</span>
      </form>
        <hr>
        <div id="sample">
        </div>
        <hr>
      <div class="btn-cont">
            <a type="button" data-id="<?= $data['id']; ?>" tabindex="16" id="update-det" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
              Save
            </a>
            <a type="button" tabindex="17" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
              Cancel
            </a>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/bootstrap-editable.css">
<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-editable.min.js"></script>
<script type="text/javascript">

   var grid;
   _module = 'sales-operation';

   
  $(document).ready(function() {
    loadTable();
  });

  $('.generate-countsheet').click(function() {    
    var location = $('[name=PCS_SubLocation]').val();
    var countsheetno = $('[name=CSD_CS_CountSheetNo]').val();

    var url= base_url + "app/"+ _module + "/" + _class + "/countsheet?location=" + location + "&countsheetno=" + countsheetno;

    $.get(url, function(countsheet) {
      countsheet = JSON.parse(countsheet);      
      grid.loadData(countsheet);
    });
  });

  $('.clear-countsheet').click(function() {         
      grid.clear();
  });

  _module = 'sales-operation'

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

  function loadTable() {
    var gridData = {
    add:false,
    tableData: <?= json_encode($details['data']) ?>,
    gridConfig:{
      minSpareRows:1,
        colHeaders:[  
                    "Item Type",
                    "Item No.",
                    "Description",
                    "UOM",
                    "Count",
                    // "Total Qty",
                    "Beg",
                    "End",
                    // "On Hand Qty",
                    "Comment"
                    ],
        columns: [
            {
                    data: "CSD_ItemType",
                    readOnly:false
                    // renderer:autoCompleteRenderer
                },
                {
                    data: "CSD_ItemNo",
                    readOnly:false
                    // renderer:autoCompleteRenderer
                 
                }, {
                    data: "CSD_Description",
                    readOnly:false
                    // renderer:autoCompleteRenderer
                }, {
                    data: "CSD_UOM",
                    readOnly:false
                    // renderer:autoCompleteRenderer
                }, {
                    data: "CSD_Count",
                    readOnly:false,
                    // renderer:totalTextRenderer1
                }, 
                // {
                //     data: "CSD_TotalQty",
                //     type: 'numeric',
                //     format: '0,0.00',
                //     // validator: requiredValidator,
                //     allowInvalid:false,
                //     // strict: true,
                //     readOnly:false,
                //     // renderer:renderTotal
                // },
                {
                    data: "CSD_SeriesBeg",
                    type: 'numeric',
                    format: '0,0.00',
                    // validator: requiredValidator,
                    allowInvalid:false,
                    // strict: true,
                    readOnly:false,
                    // renderer:renderTotal                  
                },{
                    data: "CSD_SeriesEnd",
                    type: 'numeric',
                    format: '0,0.00',
                    // validator: requiredValidator,
                    allowInvalid:false,
                    // strict: true,
                    readOnly:false,
                    // renderer:renderTotal                  
                }, //{
                //     data: "CSD_SOH",
                //     readOnly:false,
                // },
                 {
                    data: "CSD_Comment",
                    readOnly:false,
                },
                ],

            afterChange:function(change,source){
              if(change !==null || source !='loadData'){

                if ($.inArray(change[0][1], ['POLD_Qty', 'POLD_UnitPrice']) != -1) {

                                 qty = this.getDataAtRowProp(change[0][0], 'POLD_Qty') || 0;
                                 unitprice = this.getDataAtRowProp(change[0][0], 'POLD_UnitPrice') || 0;                             
                                 amount = qty * unitprice; 
                                 this.setDataAtRowProp(change[0][0], 'POLD_Total', amount);       
                                    }

                if(change[0][1] == 'POLD_ItemNo' && source != 'cascade'){
                  for(var i in items){
                if(this.getDataAtRowProp(change[0][0], 'POLD_ItemNo') == items[i].IM_Item_id){
                  this.setDataAtRowProp(change[0][0],'POLD_ItemDescription',items[i].IM_Sales_Desc,'cascade');
                  this.setDataAtRowProp(change[0][0],'POLD_UOM',items[i].AD_Code);
                }
              }
                };
                if(change[0][1] == 'POLD_ItemDescription' && source != 'cascade'){
                  for(var i in items){
                if(this.getDataAtRowProp(change[0][0],'POLD_ItemDescription') == items[i].IM_Sales_Desc){
                  this.setDataAtRowProp(change[0][0],'POLD_ItemNo',items[i].IM_Item_id,'cascade');
                  this.setDataAtRowProp(change[0][0],'POLD_UOM',items[i].AD_Code);
                }
              }
                };      
                if(change[0][1] == 'POLD_ItemType'){
                  ctr = 0;
                  for(var i in items){
                if(change[0][3] == items[i].IM_FK_ItemType_id){
                  ctr++;
                }
              }
              if(ctr == 0){
                this.setDataAtRowProp(change[0][0],'POLD_ItemNo',null);
                this.setDataAtRowProp(change[0][0],'POLD_ItemDescription',null);
                this.setDataAtRowProp(change[0][0],'POLD_UOM',null);
              }
                 loc = document.getElementById('lc').value;                          
                                 this.setDataAtRowProp(change[0][0], 'POLD_Location', loc);
                };

              }
            },
        }

    };
    grid  = $('#sample').gridEntry(gridData);
  }

     $("#update-det").on("click",function(){
      var $btn = $(this);
      var form = $('#'+_class+"-form");
      var $lbl = $btn.text();

      confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
      
        $btn.attr('disabled',true).text('Processing..');
        
        data = form.serializeArray();
        data.push({name:"type",value:'update-details'},
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

</script>