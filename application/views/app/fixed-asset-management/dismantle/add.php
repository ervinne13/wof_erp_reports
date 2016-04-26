
<div class="panel">
  <div class="panel-heading">
    <h5 class="panel-title"><?=$title?></h5>
  </div>
  <div class="panel-body">
    <div id="data-container" class="container-fluid">
      <form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
        <span class="col-md-6">
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
             <div class="col-xs-7">
                <input type="text" class="form-control" id="" maxlength="30" tabindex="1" name="ADM_DocNo" placeholder="Document No">
              </div>
          </div>          
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Reference No.:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id=""  maxlength="20" tabindex="2" name="ADM_RefNo" placeholder="Reference No">
              </div>
          </div>          
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Remarks:</label>
              <div class="col-xs-7">
              <input type="text" class="form-control" id="" maxlength="20" tabindex="3" name="ADM_Remarks" placeholder="Remarks">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Date Dismantled:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="4" name="ADM_DateDismantled" placeholder="Date Dismantled">
              </div>
          </div>  
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Book Value:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" readonly  maxlength="100" tabindex="5" value ="<?=numeric($bookvalue_total['total'])?>" name="ADM_BookValue" placeholder="Book Value">
              </div>
          </div> 
      </span>
      <span class="col-md-6">      
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Doc. Date</label>
              <div class="col-xs-7">              
                <input type="text" class="form-control" id="" maxlength="30" tabindex="6"  value="<?=date("m/d/Y",time())?>" disabled name="ADM_DocDate" placeholder="Document Date">
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
                    <option value="<?=$value['SP_StoreID']?>" <?= $dlocation==$value['SP_StoreID']?'selected':''?> ><?=$value['SP_StoreName']?></option>
                  <?php } ?>
                </select>
                <?php }else{ ?>
                <input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="8" name="ADM_Location" placeholder="Location">
                <?php } ?>
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Company:</label>
              <div class="col-xs-7">
               <input type="text" class="form-control" id="com_id" readonly value="<?=count($location) == 1 ? $location[0]['COM_Name']: $dcompany ?>" tabindex="9" name="ADM_Company" placeholder="Company">
              </div>
          </div>     
           <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Status:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" readonly  maxlength="100" tabindex="10" name="ADM_Status" placeholder="Status">
              </div>
          </div>               
        
        </span>
          <legend>Details</legend>
      </form>
      <hr>
      <div id="tbl-details" class="grid-table">
      </div>
      <hr>
      <hr>
       <div class="btn-cont">
                <a id="action-save-new" type="button"  tabindex="11" href="#" class="btn btn-default form-btn main-clr">
                    Save & New
                </a>
                <a id="action-save-close" type="button"  tabindex="12" href="#" class="btn btn-default form-btn main-clr">
                    Save & Close
                </a>
                <a type="button"  tabindex="11" href="<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>/" class="btn btn-default form-btn sub-clr">
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
            moduleProcessor.loadNumberSeries('input[name=ADM_DocNo]');

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
            return $('#tbl-details').gridEntry({
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
                        colWidths: [50, 90],
                        columns: [
                            {
                            data: "ADMD_ItemDescription",
                            type: 'dropdown',
                            trimDropdown: true,
                            allowInvalid: true,  
                            // strict: true,
                            source: function (change, process) {
                                var instance = $('#sample').handsontable('getInstance');
                                var itemDescData =[];
                                for (var i in items) {
                                     
                                        itemDescData.push(items[i].IM_Sales_Desc);
                                    
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
                                      machineData = [""];
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
                                  instance = $('#tbl-details').handsontable('getInstance');
                                  machineData = [""];
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
                                readOnly: true,                   
                            }, {
                                data: "ADMD_BookValue",
                                renderer: emptyRenderer
                            },{
                                data: "ADMD_EstimatedMarketValue",
                                renderer: emptyRenderer
                            },  {
                                data: "ADMD_Justification",
                                renderer: emptyRenderer
                            },                        
                    ],
                    afterChange: function (change, source) {
                        if (change !== null || source != 'loadData') {
                            if(change[0][1] == 'ADMD_ItemDescription' && source != 'cascade'){
                              for(var i in items){
                            if(this.getDataAtRowProp(change[0][0],'ADMD_ItemDescription') == items[i].IM_Sales_Desc){
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

          