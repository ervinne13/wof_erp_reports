
<div class="panel">
    <div class="panel-heading">
        <h5 class="panel-title"><?= $title ?></h5>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">
            <form id="<?= $this->uri->segment(3) ?>-form" class="form-horizontal row page-form container-fluid" role="form">
                <span class="col-md-5">
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly tabindex="1" value="" name="TOL_DocNo" placeholder="Document No.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Location:</label>                        
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="TOL_TransferFrom" placeholder="Transfer From">
                                <?php if ($transfer_type == 'incoming'): ?>
                                    <?php if (count($all_locations) > 1): ?>
                                        <option value="" disabled selected>Location</option>
                                        <?php foreach ($all_locations AS $location): ?>                                        
                                            <option value="<?= $location["SP_StoreID"] ?>">
                                                <?= $location["SP_StoreName"] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <input type="text" class="form-control" readonly value="<?= $all_locations[0]['SP_StoreID'] ?>" name="TOL_TransferFrom" placeholder="Transfer From">
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if (count($user_locations) > 1): ?>
                                        <option value="" disabled selected>Location</option>
                                        <?php foreach ($user_locations AS $location): ?>                                        
                                            <option value="<?= $location["SP_StoreID"] ?>">
                                                <?= $location["SP_StoreName"] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <input type="text" class="form-control" readonly value="<?= $user_locations[0]['SP_StoreID'] ?>" name="TOL_TransferFrom" placeholder="Location">
                                    <?php endif; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Transfer To:</label>
                        <div class="col-xs-7">                            
                            <select class="form-control select-cli" name="TOL_TransferTo" placeholder="Transfer To">
                                    <option value="" disabled selected>Location</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" tabindex="4" name="TOL_Remarks" placeholder="Remarks">
                        </div>
                    </div>
                </span>                
                <span class="col-md-5">                    
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly tabindex="5" value="<?= $TOL_DocDate ?>" name="TOL_DocDate" placeholder="Document Date.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for=""><?= $transfer_type == "incoming" ? "Date Received" : "Date Transferred" ?>:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" value="<?= $TOL_PostingDate ?>" tabindex="6" name="TOL_PostingDate" placeholder="Date Transferred">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Company:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly tabindex="7" name="TOL_Company" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Status:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly tabindex="8" name="TOL_Status">
                        </div>
                    </div>                   
                </span>
            </form>

            <hr>
            <div id="tbl-details" class="grid-table">

            </div>
            <hr>

            <div class="btn-cont">
                <a id="action-save-new" type="button" href="#" class="btn btn-default form-btn main-clr">
                    Save & New
                </a>
                <a id="action-save-close" type="button" href="#" class="btn btn-default form-btn main-clr">
                    Save & Close
                </a>
                <a type="button" href="<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>/" class="btn btn-default form-btn sub-clr">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>js/module_processor.js"></script>

<script type="text/javascript">

    (function () {

        var transferType = "<?= $transfer_type ?>";

        var userLocationsData = <?= json_encode($user_locations) ?>;
        var allLocationsData = <?= json_encode($all_locations) ?>;

        var locStrucJSON        = <?= json_encode($locStructure['data']); ?>;
        var locAllJSON        = <?= json_encode($locAll['data']); ?>;

        var itemTypesAutoComplete = <?= json_encode(array_column($item_types['data'], 'IT_Id')) ?>;

        var items = <?= json_encode($items['data']) ?>;

        var transTo,$transTo;
        $(document).ready(function () {

            _module = 'sales-operation';
            _class = 'transfer-order';

            initializeUI();
            var detailTable = initializeDetailTable();

            var moduleProcessor = new ModuleProcessor({
                isTransactionModule: true,
                detailTable: detailTable
            });

            moduleProcessor.initialize();
            moduleProcessor.loadNumberSeries('input[name=TOL_DocNo]');

        });

        function selectSub(child){
            if(child.length > 0){
                confirm(createSelection(child),function(confirmed){
                        if(confirmed){
                            if($('input[name=subLocation]:checked').val()){
                                subLoc = [];
                                transTo.clearOptions();
                                transTo.load(function(callback) {
                                    for(var x in locStrucJSON){
                                        if(locStrucJSON[x]['LOC_Id'] == $('input[name=subLocation]').val()){
                                            subLoc.push(locAllJSON[x]);
                                        }
                                    }
                                    callback(subLoc);
                                });
                                transTo.setValue($('input[name=subLocation]').val());
                            }
                        }else{
                            transTo.clear();
                        }
                    });
            }
        }

        function createSelection(data){
            html = "<ul class='list-group' id='loc-selection'>";
            for(var i in data){
                html += "<li class='list-group-item'><input type='radio' name='subLocation' value='"+data[i]['LOC_Id']+"'>&nbsp;"+data[i]['LOC_Name']+"</li>"
            }
            return html += "</ul>";
        }

        function initializeUI() {

            $('input[name=TOL_PostingDate]').datepicker({
                dateFormat: 'mm/dd/yy',
                 onSelect: function(dateText) {
                    var docDate     = new Date($('input[name=TOL_DocDate]').val()).getTime();
                    var transDate   = new Date(dateText).getTime();
                    if(transDate < docDate){
                        alert('Should be greater than Document Date!');
                        $(this).val('');
                    }
                  }
            });

            $('select[name=TOL_TransferFrom]').selectize({
                sortField: 'text',
                onItemRemove:function(value){
                            $('input[name=TOL_Company]').val('');
                            transTo.clearOptions();
                        },
                onChange: function (value) {
                    transTo.clearOptions();
                    var curLoc;
                    for (var i in locAllJSON) {
                        if (locAllJSON[i]["SP_StoreID"] == value) {
                            curLoc = locAllJSON[i]['LOC_Id'];
                            var companyName = locAllJSON[i]["SP_FK_CompanyID"];
                            $('input[name=TOL_Company]').val(companyName);
                            break;
                        }
                    }

                    var sub = [];

                    for(var x in locStrucJSON){
                        if(locStrucJSON[x]['LOC_Parent_id'] == curLoc){
                            sub.push(locStrucJSON[x]);
                        }
                    }

                    transTo.load(function(callback) {
                        callback(sub);
                    });
                }
            });

            $transTo = $('select[name=TOL_TransferTo]').selectize({
                sortField: 'text',
                valueField: 'LOC_Id',
                labelField: 'LOC_Name',
                searchField: ['LOC_Name'],
                onChange: function (value) {

                    var child = [];
                    for(var x in locStrucJSON){
                        if(locStrucJSON[x]['LOC_Parent_id'] == value){
                            child.push(locStrucJSON[x]);
                        }
                    }

                    selectSub(child);
                }
            });

            transTo = $transTo[0].selectize;

        }

        function getDetailTableHeaders() {

            if (transferType == "incoming") {
                return  [
                    "Item Type",
                    "Item No.",
                    "Description",
                    "Qty",
                    "UOM",
                    "Unit Price",
                    "Total Amount",
                    "Comment",
                    "Ref. From",
                    "Qty to Receive",
                    "Qty Received"                   
                ];
            } else if (transferType == "outgoing") {
                return [
                    "Item Type",
                    "Item No.",
                    "Description",
                    "Qty to Transfer",
                    "UOM",
                    "Unit Price",
                    "Total Amount",
                    "Comment",
                    "Ref. From",
                ]
            } else {
                //  TODO: redirect back here
            }

        }

        function qtyToReceiveOrTransfer() {

            if (transferType == "incoming") {
                return {
                    data: "TOLD_QtyToReceive",
                    type: 'numeric',
                    format: '0,0',
                    allowInvalid: false,
                    readOnly: true
                };
            } else if (transferType == "outgoing") {
                return {
                    data: "TOLD_QtyToShip",
                    type: 'numeric',
                    format: '0,0',
                    allowInvalid: false,
                    readOnly: true
                };
            }

        }

        function qtyReceivedOrTransferred() {
            if (transferType == "incoming") {
                return {
                    data: "TOLD_QtyReceived",
                    type: 'numeric',
                    format: '0,0',
                    allowInvalid: false,
                    readOnly: true
                };
            } else if (transferType == "outgoing") {
                return {
                    data: "TOLD_QtyShipped",
                    type: 'numeric',
                    format: '0,0',
                    allowInvalid: false,
                    readOnly: true
                };
            }
        }

        function initializeDetailTable() {
            return $('#tbl-details').gridEntry({
                tableData: <?= json_encode($details['data']) ?>,
                gridConfig: {
                    minSpareRows: 1,
                    colHeaders: getDetailTableHeaders(),
                    colWidths: [50, 90],
                    columns: [
                        {
                            data: "TOLD_ItemType",
                            type: 'dropdown',
                            allowInvalid: false,
                            strict: true,
                            trimDropdown: true,
                            source: itemTypesAutoComplete,
                            renderer: autoCompleteRenderer
                        },
                        {
                            data: "TOLD_ItemNo",
                            type: 'dropdown',
                            trimDropdown: true,
                            strict: true,
                            source: function (change, process) {
                                var instance = $('#tbl-details').handsontable('getInstance');
                                var itemCodeData = [];
                                for (var i in items) {
                                    if (instance.getDataAtCell(this.row, 0) == items[i].IM_FK_ItemType_id) {
                                        itemCodeData.push(items[i].IM_Item_id);
                                    }
                                }
                                process(itemCodeData);
                            },
                            renderer: autoCompleteRenderer
                        },
                        {
                            data: "TOLD_ItemDescription",
                            type: 'dropdown',
                            trimDropdown: true,
                            strict: true,
                            source: function (change, process) {
                                var instance = $('#tbl-details').handsontable('getInstance');
                                var itemDescData = [];
                                for (var i in items) {
                                    if (instance.getDataAtCell(this.row, 0) == items[i].IM_FK_ItemType_id) {
                                        itemDescData.push(items[i].IM_Sales_Desc);
                                    }
                                }
                                process(itemDescData);
                            },
                            renderer: autoCompleteRenderer
                        },
                        {
                            data: "TOLD_Qty",
                            type: 'numeric',
                            format: '0,0',
                            allowInvalid: false,
                            strict: true,
                            // renderer: emptyRenderer
                        },
                        {
                            data: "TOLD_UOM",
                            renderer: emptyRenderer
                        },
                        {
                            data: "TOLD_UnitPrice",
                            type: 'numeric',
                            format: '0,0.00',
                            allowInvalid: false,
                            readOnly: true
                        }, {
                            data: "TOLD_Total",
                            readOnly: true,
                            type: 'numeric',
                            format: '0,0.00',
                            allowInvalid: false,
                            renderer: renderTotalDisabled
                        }, {
                            data: "TOLD_Comment",
                            renderer: emptyRenderer
                        }, {
                            data: "TOLD_RefFrom",
                            readOnly: true
                        },
                        // qtyToReceiveOrTransfer(),
                        // qtyReceivedOrTransferred()
                    ],
                    afterChange: function (change, source) {
                        if (change !== null || source != 'loadData') {
                            if (change[0][1] == 'TOLD_ItemNo' && source != 'cascade') {
                                for (var i in items) {
                                    if (this.getDataAtRowProp(change[0][0], 'TOLD_ItemNo') == items[i].IM_Item_id) {
                                        this.setDataAtRowProp(change[0][0], 'TOLD_ItemDescription', items[i].IM_Sales_Desc, 'cascade');
                                        this.setDataAtRowProp(change[0][0], 'TOLD_UnitPrice', items[i].IM_UnitCost || 0);
                                        this.setDataAtRowProp(change[0][0], 'TOLD_UOM', items[i].AD_Code);
                                    }
                                }
                            }

                            if (change[0][1] == 'TOLD_ItemDescription' && source != 'cascade') {
                                for (var i in items) {
                                    if (this.getDataAtRowProp(change[0][0], 'TOLD_ItemDescription') == items[i].IM_Sales_Desc) {
                                        this.setDataAtRowProp(change[0][0], 'TOLD_ItemNo', items[i].IM_Item_id, 'cascade');
                                        this.setDataAtRowProp(change[0][0], 'TOLD_UnitPrice', items[i].IM_UnitCost || 0);
                                        this.setDataAtRowProp(change[0][0], 'TOLD_UOM', items[i].AD_Code);
                                    }
                                }
                            }


                            if (change[0][1] == 'TOLD_Qty') {

                                var qtyField = qtyToReceiveOrTransfer();

                                var qty = this.getDataAtRowProp(change[0][0], 'TOLD_Qty') || 0;
                                var unitCost = this.getDataAtRowProp(change[0][0], 'TOLD_UnitPrice') || 0;
                                this.setDataAtRowProp(change[0][0], 'TOLD_Total', parseFloat(qty).toFixed(2) * parseFloat(unitCost).toFixed(2));
                                this.setDataAtRowProp(change[0][0], qtyField.data, qty);
                            }


                            if (change[0][1] == 'TOLD_ItemType') {
                                var ctr = 0;
                                for (var i in items) {
                                    if (change[0][3] == items[i].IM_FK_ItemType_id) {
                                        ctr++;
                                    }
                                }
                                if (ctr == 0) {
                                    this.setDataAtRowProp(change[0][0], 'TOLD_ItemNo', null);
                                    this.setDataAtRowProp(change[0][0], 'TOLD_ItemDescription', null);
                                    this.setDataAtRowProp(change[0][0], 'TOLD_UnitPrice', items[i].IM_UnitCost || 0);
                                    this.setDataAtRowProp(change[0][0], 'TOLD_UOM', null);
                                }
                            }


                        }

                    }
                }
            });
        }

    })();

</script>