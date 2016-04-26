
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
                            <input type="text" class="form-control" readonly tabindex="1" value="<?= $TO_DocNo ?>" name="TO_DocNo" placeholder="Document No.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Transfer From:</label>                        
                        <div class="col-xs-7">                        
                            <?php if ($transfer_type == 'incoming'): ?>
                                <input type="text" class="form-control" readonly value="<?=$TO_TransferFrom?>" name="TO_TransferFrom" placeholder="Transfer From">
                             <?php else: ?>  
                                <select class="form-control select-cli" name="TO_TransferFrom" placeholder="Transfer From">
                                    <?php if (count($user_locations) > 1): ?>
                                        <option value="" disabled selected>Location</option>
                                        <?php foreach ($user_locations AS $location): ?>
                                            <?php $selected = $location["SP_StoreID"] == $TO_TransferFrom ? "selected" : "" ?>
                                            <option value="<?= $location["SP_StoreID"] ?>" <?= $selected ?>>
                                                <?= $location["SP_StoreName"] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <input type="text" class="form-control" readonly value="<?= $user_locations[0]['SP_StoreID'] ?>" name="TO_TransferFrom" placeholder="Transfer From">
                                    <?php endif; ?>
                                </select>
                             <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Transfer To:</label>
                        <div class="col-xs-7">
                            <?php if ($transfer_type == 'incoming'): ?>
                                <input type="text" class="form-control" readonly value="<?=$TO_TransferTo?>" name="TO_TransferTo" placeholder="Transfer To">                                    
                            <?php else: ?>
                                <select class="form-control select-cli" name="TO_TransferTo" placeholder="Transfer To">                                                                
                                    <?php if (count($all_locations) > 1): ?>
                                        <option value="" disabled selected>Location</option>
                                        <?php foreach ($all_locations AS $location): ?>
                                            <?php $selected = $location["SP_StoreID"] == $TO_TransferTo ? "selected" : "" ?>
                                            <option value="<?= $location["SP_StoreID"] ?>" <?= $selected ?>>
                                                <?= $location["SP_StoreName"] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <input type="text" class="form-control" readonly value="<?= $all_locations[0]['SP_StoreID'] ?>" name="TO_TransferTo" placeholder="Transfer To">
                                    <?php endif; ?>                                
                                </select>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php $readOnly = $transfer_type == 'incoming' ? "readonly" : ""?>                        
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" <?= $readOnly?> tabindex="4" value="<?= $TO_Remarks ?>" name="TO_Remarks" placeholder="Remarks">
                        </div>
                    </div>
                </span>                
                <span class="col-md-5">                    
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly tabindex="5" value="<?= $TO_DocDate ?>" name="TO_DocDate" placeholder="Document Date.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for=""><?= $transfer_type == "incoming" ? "Date Received" : "Date Transferred" ?>:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" value="<?= $TO_PostingDate ?>" tabindex="6" name="TO_PostingDate" placeholder="Date Transferred">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Company:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly tabindex="7" name="TO_Company" value="<?= $TO_Company ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Status:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly tabindex="8" name="TO_Status" value="<?= $TO_Status ?>">
                        </div>
                    </div>                   
                </span>
            </form>

            <hr>
            <div id="tbl-details" class="grid-table">

            </div>
            <hr>

            <div class="btn-cont">                
                <a id="action-update-close" type="button" href="#" class="btn btn-default form-btn main-clr">
                    Save
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

        var itemTypesAutoComplete = <?= json_encode(array_column($item_types['data'], 'IT_Id')) ?>;

        var items = <?= json_encode($items['data']) ?>;

        var isIncoming = transferType == "incoming";

        $(document).ready(function () {

            initializeUI();
            var detailTable = initializeDetailTable();

            var moduleProcessor = new ModuleProcessor({
                isTransactionModule: true,
                detailTable: detailTable
            });

            moduleProcessor.initialize();

            // $('#add-tbl-details').css('display', 'none');
        });


        function initializeUI() {

            $('input[name=TO_PostingDate]').datepicker({
                dateFormat: 'mm/dd/yy'
            });

            $('select[name=TO_TransferFrom]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in allLocationsData) {
                        if (allLocationsData[i]["SP_StoreID"] == value) {
                            var companyName = allLocationsData[i]["COM_Name"];
                            console.log(companyName);
                        }
                    }
                }
            });

            $('select[name=TO_TransferTo]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in userLocationsData) {
                        if (userLocationsData[i]["SP_StoreID"] == value) {
                            var companyName = userLocationsData[i]["COM_Name"];
                            $('input[name=TO_Company]').val(companyName);
                        }
                    }
                }
            });

        }

        function getDetailTableHeaders() {
            if (transferType == "incoming") {
                return [
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
                    "Qty Transferred"                    
                ]
            } else {
                //  TODO: redirect back here
            }

        }

        function qtyToReceiveOrTransfer() {

            if (transferType == "incoming") {
                return {
                    data: "TOD_QtyToReceive",
                    type: 'numeric',
                    format: '0,0',
                    allowInvalid: false,
                    readOnly: !isIncoming
                };
            } else if (transferType == "outgoing") {
                return {
                    data: "TOD_QtyToShip",
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
                    data: "TOD_QtyReceived",
                    type: 'numeric',
                    format: '0,0',
                    allowInvalid: false,
                    readOnly: true
                };
            } else if (transferType == "outgoing") {
                return {
                    data: "TOD_QtyShipped",
                    type: 'numeric',
                    format: '0,0',
                    allowInvalid: false,
                    readOnly: true
                };
            }
        }

        function getColumns() {
            if (transferType == "incoming") {
                return [
                        {
                            data: "TOD_ItemType",
                            readOnly: true
                        },
                        {
                            data: "TOD_ItemNo",
                            readOnly: true
                        },
                        {
                            data: "TOD_ItemDescription",
                            readOnly: true
                        },
                        {
                            data: "TOD_Qty",
                            readOnly: true,
                            type: 'numeric',
                            format: '0,0',
                            readOnly: true                            
                        },
                        {
                            data: "TOD_UOM",
                            readOnly: true
                        },
                        {
                            data: "TOD_UnitPrice",
                            readOnly: true,
                            type: 'numeric',
                            format: '0,0.00',
                            readOnly: true                            
                        }, {
                            data: "TOD_Total",
                            readOnly: true,
                            type: 'numeric',
                            format: '0,0.00',
                            readOnly: true,
                            renderer: renderTotalDisabled
                        }, {
                            data: "TOD_Comment",
                            readonly: isIncoming,
                            renderer: emptyRenderer
                        }, {
                            data: "TOD_RefFrom",                            
                            readOnly: true
                        },
                        qtyToReceiveOrTransfer(),
                        qtyReceivedOrTransferred()
                    ];
            } else if (transferType == "outgoing") {
                return  [
                        {
                            data: "TOD_ItemType",
                            type: 'dropdown',
                            allowInvalid: false,
                            readonly: isIncoming,
                            strict: true,
                            trimDropdown: true,
                            source: itemTypesAutoComplete,
                            renderer: autoCompleteRenderer
                        },
                        {
                            data: "TOD_ItemNo",
                            type: 'dropdown',
                            trimDropdown: true,
                            readonly: isIncoming,
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
                            data: "TOD_ItemDescription",
                            type: 'dropdown',
                            trimDropdown: true,
                            strict: true,
                            readonly: isIncoming,
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
                            data: "TOD_Qty",
                            type: 'numeric',
                            format: '0,0',
                            allowInvalid: false,
                            readonly: isIncoming,
                            strict: true,
                            // renderer: emptyRenderer
                        },
                        {
                            data: "TOD_UOM",
            
                            renderer: emptyRenderer
                        },
                        {
                            data: "TOD_UnitPrice",
                            type: 'numeric',
                            format: '0,0.00',
                            allowInvalid: false,
                            readOnly: true
                        }, {
                            data: "TOD_Total",
                            readOnly: true,
                            type: 'numeric',
                            format: '0,0.00',
                            allowInvalid: false,
                            renderer: renderTotalDisabled
                        }, {
                            data: "TOD_Comment",
                            readonly: isIncoming,
                            renderer: emptyRenderer
                        }, {
                            data: "TOD_RefFrom",                            
                            readOnly: true
                        },
                        // qtyToReceiveOrTransfer(),
                        qtyReceivedOrTransferred()
                    ];
            }
        }

        function initializeDetailTable() {
            return $('#tbl-details').gridEntry({
                tableData: <?= json_encode($details['data']) ?>,
                add:transferType == "outgoing"?true:false,
                gridConfig: {
                    minSpareRows: 1,
                    colHeaders: getDetailTableHeaders(),
                    colWidths: [50, 90],
                    columns: getColumns(),
                    afterChange: function (change, source) {
                        if (change !== null || source != 'loadData') {
                            if (change[0][1] == 'TOD_ItemNo' && source != 'cascade') {
                                for (var i in items) {
                                    if (this.getDataAtRowProp(change[0][0], 'TOD_ItemNo') == items[i].IM_Item_id) {
                                        this.setDataAtRowProp(change[0][0], 'TOD_ItemDescription', items[i].IM_Sales_Desc, 'cascade');
                                        this.setDataAtRowProp(change[0][0], 'TOD_UnitPrice', items[i].IM_UnitCost || 0);
                                        this.setDataAtRowProp(change[0][0], 'TOD_UOM', items[i].AD_Code);
                                    }
                                }
                            }

                            if (change[0][1] == 'TOD_ItemDescription' && source != 'cascade') {
                                for (var i in items) {
                                    if (this.getDataAtRowProp(change[0][0], 'TOD_ItemDescription') == items[i].IM_Sales_Desc) {
                                        this.setDataAtRowProp(change[0][0], 'TOD_ItemNo', items[i].IM_Item_id, 'cascade');
                                        this.setDataAtRowProp(change[0][0], 'TOD_UnitPrice', items[i].IM_UnitCost || 0);
                                        this.setDataAtRowProp(change[0][0], 'TOD_UOM', items[i].AD_Code);
                                    }
                                }
                            }


                            if (change[0][1] == 'TOD_Qty') {

                                var qtyField = qtyToReceiveOrTransfer();

                                var qty = this.getDataAtRowProp(change[0][0], 'TOD_Qty') || 0;
                                var unitCost = this.getDataAtRowProp(change[0][0], 'TOD_UnitPrice') || 0;
                                this.setDataAtRowProp(change[0][0], 'TOD_Total', parseFloat(qty).toFixed(2) * parseFloat(unitCost).toFixed(2));
                                this.setDataAtRowProp(change[0][0], qtyField.data, qty);
                            }


                            if (change[0][1] == 'TOD_ItemType') {
                                var ctr = 0;
                                for (var i in items) {
                                    if (change[0][3] == items[i].IM_FK_ItemType_id) {
                                        ctr++;
                                    }
                                }
                                if (ctr == 0) {
                                    this.setDataAtRowProp(change[0][0], 'TOD_ItemNo', null);
                                    this.setDataAtRowProp(change[0][0], 'TOD_ItemDescription', null);
                                    this.setDataAtRowProp(change[0][0], 'TOD_UnitPrice', items[i].IM_UnitCost || 0);
                                    this.setDataAtRowProp(change[0][0], 'TOD_UOM', null);
                                }
                            }


                        }

                    }
                }
            });
        }

    })();

</script>