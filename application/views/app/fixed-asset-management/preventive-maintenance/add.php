
<style>
    table thead tr th {
        text-align: center;
    }
    table thead tr.data {
        display:none;
    }

    .ui-datepicker-calendar {
        display: none;
    }

    input {
        height: 20px !important;
    }

</style>

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
                <input type="text" class="form-control" id="" maxlength="30" tabindex="1" name="PM_DocNo" placeholder="Document No">
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
                <select class="form-control single-default" placeholder="Location" id="" name="PM_Location" tabindex="2">
                  <option value="" disabled selected>Location</option>
                  <?php foreach ($location as $key => $value) { ?>
                    <option value="<?=$value['SP_StoreID']?>" <?= $dlocation==$value['SP_StoreID']?'selected':''?> ><?=$value['SP_StoreName']?></option>
                  <?php } ?>
                </select>
                <?php }else{ ?>
                <input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="3" name="PM_Location" placeholder="Location">
                <?php } ?>
              </div>
          </div>         
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Period:</label>
              <div class="col-xs-7">
              <input type="text" class="form-control month-year-picker" id="period" maxlength="20" tabindex="4" name="PM_Period" placeholder="Period">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Other Concerns:</label>
              <div class="col-xs-7">
                <textarea type="text" class="form-control" id="" tabindex="5" name="PM_OtherConcern" placeholder="Other Concerns"></textarea>
              </div>
          </div>  
      </span>
      <span class="col-md-6">      
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Doc. Date</label>
              <div class="col-xs-7">              
                <input type="text" class="form-control" id="" maxlength="30" tabindex="6"  value="<?=date("m/d/Y",time())?>" disabled name="PM_DocDate" placeholder="Document Date">
              </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Company:</label>
              <div class="col-xs-7">
               <input type="text" class="form-control" id="com_id" readonly value="<?=count($location) == 1 ? $location[0]['COM_Name']: $dcompany ?>" tabindex="7" name="PM_Company" placeholder="Company">
              </div>
          </div>     
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Quality Rate:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id=""   maxlength="100" tabindex="8" name="PM_QualityRate" placeholder="%">
              </div>
          </div>  
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Completion Rate:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id=""   maxlength="100" tabindex="9" name="PM_CompletionRate" placeholder="%">
              </div>
          </div>  
           <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Status:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" readonly  maxlength="100" tabindex="10" name="PM_Status" placeholder="Status">
              </div>
          </div>
          <div class="form-group" hidden>
              <label for="sel1" class="control-label col-xs-5">User</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="userid" value ="<?=$PMD_BTUserID?>" readonly  maxlength="100" tabindex="11" placeholder="Status">
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
                <a id="action-save-new" type="button"  tabindex="12" href="#" class="btn btn-default form-btn main-clr">
                    Save & New
                </a>
                <a id="action-save-close" type="button"  tabindex="13" href="#" class="btn btn-default form-btn main-clr">
                    Save & Close
                </a>
                <a type="button"  tabindex="14" href="<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>/" class="btn btn-default form-btn sub-clr">
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
      // var machine       = <?= json_encode($machine['data'])?>;
        $(document).ready(function () {

            initializeUI();
            var detailTable = initializeDetailTable();

            var moduleProcessor = new ModuleProcessor({
                isTransactionModule: true,
                detailTable: detailTable
            });

            moduleProcessor.initialize();
            moduleProcessor.loadNumberSeries('input[name=PMs_DocNo]');

        });

        function initializeUI() {

            $('select[name=PM_Location]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in locationsData) {
                        if (locationsData[i]["SP_StoreID"] == value) {
                            var companyName = locationsData[i]["COM_Name"];
                            $('input[name=PM_Company]').val(companyName);
                        }
                    }
                }
            });
        }
        $('.month-year-picker').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'MM yy',
                    
                    onClose: function (dateText, inst) {
                        currentlySelectedMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        currentlySelectedYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).datepicker('setDate', new Date(currentlySelectedYear, currentlySelectedMonth, 1));
                       
                    }
                });

        function initializeDetailTable() {
            return $('#tbl-details').gridEntry({
                    gridConfig: {
                        minSpareRows: 1,
                        // mergeCells: [
                        //               {row: 1, col: 1, rowspan: 3, colspan: 3},            
                        //             ],
                        colHeaders: [
                            "Asset ID",
                            "Item No.",
                            "Machine Name",
                            "PM Schedule",
                            "Previous Findings",
                            "Actual PM Date",
                            "Remarks",
                            "User ID",
                            "Rating",
                            "Remarks",
                            "User ID",
                        ],
                        colWidths: [50, 90],
                        columns: [
                            {
                            data: "PMD_AssetID",
                            type: 'dropdown',
                            trimDropdown: true,
                            allowInvalid: true,  
                            // strict: true,
                            source: function (change, process) {
                                var instance = $('#sample').handsontable('getInstance');
                                var itemDescData =[];
                                for (var i in items) {
                                     
                                        itemDescData.push(items[i].MC_MachineTag);
                                    
                                }
                                    process(itemDescData);
                                },
                                renderer: autoCompleteRenderer
                            },
                            {
                            data: "PMD_ItemNo",
                            type: 'dropdown',
                                    trimDropdown: true,  
                                    allowInvalid: true,                      
                                    // strict: true,
                                    source:function(change,process){
                                      instance = $('#sample').handsontable('getInstance');
                                      itemDescData = [];
                                  for(var i in items){
                                    // if(instance.getDataAtCell(this.row, 1) == machine[i].MC_IM_Item_id){
                                      itemDescData.push(items[i].MC_IM_Item_id);
                                      console.log(itemDescData);
                                    // }
                                  }
                                  process(itemDescData);
                                  },
                                renderer: autoCompleteRenderer
                            }, {
                            data: "PMD_MachineName",
                            type: 'dropdown',
                                trimDropdown: true,  
                                allowInvalid: true,                      
                                // strict: true,
                                source:function(change,process){
                                  instance = $('#tbl-details').handsontable('getInstance');
                                  itemDescData = [""];
                              for(var i in items){
                                  itemDescData.push(items[i].IM_Sales_Desc);
                                  console.log(itemDescData);
                              }
                              process(itemDescData);
                              },
                              renderer: autoCompleteRenderer
                            }, {
                                data: "PMD_PMSched",
                                readOnly: true,                   
                            }, {
                                data: "PMD_PreviousFindings",
                                renderer: emptyRenderer
                            },{
                                data: "PMD_BTActualPMDate",
                                type: 'date',
                                dateFormat: 'MM/DD/YYYY',
                                strict: true,
                                renderer: autoCompleteRenderer
                            },  {
                                data: "PMD_BTRemarks",
                                renderer: emptyRenderer
                            }, {
                                data: "PMD_BTUserID",
                                renderer: emptyRenderer                
                            }, {
                                data: "PMD_ATRating",
                                type:'dropdown',
                                source: ['','Poor','Good'],
                            },{
                                data: "PMD_ATRemarks",
                                renderer: emptyRenderer
                            },  {
                                data: "PMD_ATUserID",
                                renderer: emptyRenderer
                            },                            
                    ],
                    afterChange: function (change,source) {
                      if (change !== null || source != 'loadData') {
                        if(change[0][1] == 'PMD_AssetID' && source != 'cascade'){
                          userid = document.getElementById('userid').value;                          
                                          this.setDataAtRowProp(change[0][0], 'PMD_BTUserID', userid);
                                          this.setDataAtRowProp(change[0][0], 'PMD_ATUserID', userid);
                          };

                    }}
                }
            });
        }

    })();

</script>

          