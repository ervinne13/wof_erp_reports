<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?>
		</h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id="" readonly maxlength="30" tabindex="1" value="<?=$data['ADM_DocNo']?>" name="ADM_DocNo" placeholder="Document No">
              </div>
          </div>          
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Reference No.:</label>
              <div class="col-xs-7">
                   <input type="text" class="form-control" id="" onkeypress="return isNumberKey(event)" maxlength="250" tabindex="2" value="<?=$data['ADM_RefNo']?>" name="ADM_RefNo" placeholder="Reference No">
              </div>
          </div>        
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Remarks::</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="20" tabindex="3" value="<?=$data['ADM_Remarks']?>" name="ADM_Remarks" placeholder="Remarks">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Date Dismantled::</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="250" tabindex="4" value="<?=format($data['ADM_DateDismantled'])?>" name="ADM_DateDismantled" placeholder="Date Dismantled">
              </div>
          </div>   
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Book Value::</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="250" tabindex="5" value="<?=numeric($data['ADM_BookValue'])?>" name="ADM_BookValue" placeholder="Book Value">
              </div>
          </div>   
      </span>
      <span class="col-md-6">     
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Doc. Date</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" tabindex="6" disabled value="<?=date("m/d/Y",time())?>" name="ADM_DocDate" placeholder="Document Date">
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-5" for="">Location:</label>
            <div class="col-xs-7">
              <?php 
              $location   = $this->session->userdata('location');
              $dlocation  = $this->session->userdata('dlocation')['SP_StoreID'];
              $dcompany   = $this->session->userdata('dlocation')['SP_FK_CompanyID'];
              if(count($location) > 1){ 
              ?>
              <select class="form-control single-default" placeholder="Location" id="" name="ADM_Location" tabindex="7">
              <option value="" disabled selected>Location</option>
              <?php foreach ($location as $key => $value) { ?>
                <option value="<?=$value['SP_StoreID']?>" <?=($data['ADM_Location'] == $value['SP_StoreID'])||($dlocation == $value['SP_StoreID'])?'selected':''?> ><?=$value['SP_StoreName']?></option>
              <?php } ?>
            </select>
              <?php }else{ ?>
                <input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="8" name="ADM_Location" placeholder="Location">
                <?php } ?>
              </div>
            </div>
           <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Company::</label>
              <div class="col-xs-7">
               <input type="text" class="form-control" id="com_id" readonly value="<?=count($location) == 1 ? $location[0]['COM_Name']: $dcompany ?>" tabindex="9" name="ADM_Company" placeholder="Company">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Status::</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="100" readonly tabindex="10" value="<?=$data['ADM_Status']?>" name="ADM_Status" placeholder="Status">
              </div>
          </div>       
        </span>
			</form>
      <hr>
      <div id="sample">
      </div>
      <hr>
			<hr>
			<div class="btn-cont">                
           <a id="action-update-close" tabindex="11" type="button" href="#" class="btn btn-default form-btn main-clr">
              Save
          </a>
          <a type="button" tabindex="12" href="<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>/" class="btn btn-default form-btn sub-clr">
              Back
          </a>
      </div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url() ?>js/module_processor.js"></script>
<script type="text/javascript">

    (function () {
        var items = <?= json_encode($items['data']) ?>;
        var machine       = <?= json_encode($machine['data'])?>;

        $(document).ready(function () {

            initializeUI();
            var detailTable = initializeDetailTable();

            var moduleProcessor = new ModuleProcessor({
                isTransactionModule: true,
                detailTable: detailTable
            });
            moduleProcessor.initialize();
        });

        function initializeUI() {

            $('select[name=ADM_Location]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in locationsData) {
                        if (locationsData[i]["SP_StoreID"] == value) {
                            var companyName = locationsData[i]["COM_Name"];
                            $('input[name=ADM_Company]').val(companyName);
                        }
                    }
                }
            });
        }

        function initializeDetailTable() {
            return $('#sample').gridEntry({
                tableData: <?= json_encode($details['data']) ?>,
                gridConfig: {
                    minSpareRows: 1,
                    colHeaders: [
                              "Machine Name",
                              "Classification",
                              "Asset ID",
                              "Item No.",
                              "Book Value",
                              "Estimated Market Value",
                              "Justification"
                    ],
                    columns: [
                         {
                            data: "ADMD_ItemDescription",
                            type: 'dropdown',
                            trimDropdown: true,
                            allowInvalid: true,  
                            // strict: true,
                            source: function (change, process) {
                                var instance = $('#sample').handsontable('getInstance');
                                var itemDescData = [];
                                for (var i in items) {
                                    // if (instance.getDataAtCell(this.row, 1) == items[i].IM_FK_ItemType_id) {
                                        itemDescData.push(items[i].IM_Sales_Desc);
                                    // }
                                }
                                process(itemDescData);
                            },
                            renderer: autoCompleteRenderer
                        },
                        {
                        data: "ADMD_MachineClass",
                        type: 'dropdown',
                                trimDropdown: true,  
                                allowInvalid: true,                      
                                // strict: true,
                                source:function(change,process){
                                  instance = $('#sample').handsontable('getInstance');
                                  machineData = [];
                              for(var i in machine){
                                // if(instance.getDataAtCell(this.row, 1) == machine[i].MC_IM_Item_id){
                                  machineData.push(machine[i].MC_MachineClass);
                                  console.log(machineData);
                                // }
                              }
                              process(machineData);
                              },
                        renderer: autoCompleteRenderer
                        }, {
                            data: "ADMD_AssetID",
                            type: 'dropdown',
                                trimDropdown: true,  
                                allowInvalid: true,                      
                                // strict: true,
                                source:function(change,process){
                                  instance = $('#sample').handsontable('getInstance');
                                  machineData = [];
                              for(var i in machine){
                                // if(instance.getDataAtCell(this.row, 1) == machine[i].MC_IM_Item_id){
                                  machineData.push(machine[i].MC_MachineTag);
                                  console.log(machineData);
                                // }
                              }
                              process(machineData);
                              },
                              renderer: autoCompleteRenderer
                        }, {
                            data: "ADMD_ItemNo",
                            renderer: emptyRenderer
                        }, {
                            data: "ADMD_BookValue",
                            renderer: emptyRenderer
                        }, {
                            data: "ADMD_EstimatedMarketValue",
                            renderer: emptyRenderer
                          },{
                            data: "ADMD_Justification",
                            renderer: emptyRenderer
                        },                        
                    ],
                    afterChange: function (change, source) {
                        if (change !== null || source != 'loadData') {
                            if(change[0][1] == 'ADMD_ItemDescription' && source != 'cascade'){
                              for(var i in items){
                            if(this.getDataAtRowProp(change[0][0], 'ADMD_ItemDescription') == items[i].IM_Sales_Desc){
                              this.setDataAtRowProp(change[0][0],'ADMD_ItemNo',items[i].MC_IM_Item_id,'cascade');
                              
                            }
                          }
                            };    
                        }

                    }
                }
            });
        }
   
    })();

</script>