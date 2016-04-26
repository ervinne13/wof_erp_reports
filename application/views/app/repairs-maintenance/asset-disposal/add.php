<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
        </h3>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">
            <form id="<?= $this->uri->segment(3) ?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
                <span class="col-md-6">
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Document No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" tabindex="1" name="ADV_DocNo" placeholder="Document No.">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Disposal Type:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="ADV_DisposalType" tabindex="2" placeholder="Disposal Type">
                                <option value="For Dismantling">For Dismantling</option>
                                <option value="For Donation">For Donation</option>
                                <option value="For Sale">For Sale</option>
                                <option value="Throw Away">Throw Away</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Disposal Date:</label>
                        <div class="col-xs-7">
                            <input type="text" value="<?= $current_date_display ?>" readonly tabindex="3" class="form-control" name="ADV_DisposalDate" placeholder="Disposal Date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" tabindex="4" name="ADV_Remarks" placeholder="Remarks">
                        </div>
                    </div>
                </span>
                <span class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Document Date:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" tabindex="5" name="ADV_DocDate" placeholder="Document Date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="control-label col-xs-5">Location:</label>
                        <div class="col-xs-7">                            
                            <select class="form-control select-cli" tabindex="5" name="ADV_Location" placeholder="Location">
                                <?php if (count($locations) > 1): ?>
                                    <option value="" disabled selected>Location</option>
                                    <?php foreach ($locations AS $location): ?>
                                        <?php $selected = $location["SP_StoreID"] == $default_location["CA_FK_Location_id"] ? "selected" : "" ?>
                                        <option value="<?= $location["SP_StoreID"] ?>" <?= $selected ?>>
                                            <?= $location["SP_StoreName"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <input type="text" class="form-control" tabindex="5" readonly value="<?= $locations[0]['SP_StoreID'] ?>" name="ADV_Location" placeholder="Location">
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="control-label col-xs-5">Company:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly name="ADV_Company" tabindex="6" class="form-control" placeholder="Company" value="<?= $company ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Customer:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" tabindex="7" name="ADV_CustomerID" placeholder="Customer ID">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Selling Price:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control"tabindex="8" name="ADV_SellingPrice" placeholder="Selling Price">
                        </div>
                    </div>

                </span>
            </form>

            <hr>
            <div id="tbl-details" class="grid-table"></div>
            <hr>

            <div class="btn-cont">
                <a id="action-save-new" type="button"  tabindex="9" href="#" class="btn btn-default form-btn main-clr">
                    Save & New
                </a>
                <a id="action-save-close" type="button"  tabindex="10" href="#" class="btn btn-default form-btn main-clr">
                    Save & Close
                </a>
                <a type="button"  tabindex="11" href="<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>/" class="btn btn-default form-btn sub-clr">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    (function () {

        var locationsData = <?= json_encode($locations) ?>;
        var itemTypesAutoComplete = <?= json_encode($item_types) ?>;
        var items = <?= json_encode($items) ?>;

        var currentlyFilteredItems = [];
        var currentlySelectedItem;

        var uom = <?= json_encode($uom) ?>;
        var detailTable;

        $(document).ready(function () {

            initializeUI();
            detailTable = initializeDetailTable();

            var moduleProcessor = new ModuleProcessor({
                isTransactionModule: true,
                detailTable: detailTable
            });

            moduleProcessor.initialize();
            moduleProcessor.loadNumberSeries('input[name=ADV_DocNo]');

        });

        function initializeUI() {
            $('select[name=ADV_Location]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in locationsData) {
                        if (locationsData[i]["SP_StoreID"] == value) {
                            var companyName = locationsData[i]["COM_Name"];
                            $('input[name=ADVCompany]').val(companyName);
                        }
                    }
                }
            });

            $('select[name=ADV_DisposalType]').selectize();
        }

        function initializeDetailTable() {
            return $('#tbl-details').gridEntry({
                tableData: processDetailsDataForDisplay(<?= json_encode($details['data']) ?>),
                gridConfig: {
                    minSpareRows: 1,
                    colHeaders: [
                        "Item Type",
                        "Description",
                        "Asset ID",
                        "Item No.",
                        "UOM",
                        "Qty",
                        "Unit Cost / Book Value",
                        "Total Cost",
                        "Justification",
                        "Status"
                    ],
                    colWidths: [50, 90],
                    columns: [
                        {
                            data: "ADVD_ItemType",
                            type: 'dropdown',
                            allowInvalid: false,
                            strict: true,
                            trimDropdown: true,
                            source: itemTypesAutoComplete,
                            renderer: autoCompleteRenderer
                        },
                        {
                            data: "ADVD_ItemDescription",
                            type: 'dropdown',
                            allowInvalid: false,
                            strict: true,
                            trimDropdown: true,
                            renderer: autoCompleteRenderer,
                            source: function (query, process) {
                                var itemType = detailTable.getDataAtCell(this.row, 0);
                                currentlyFilteredItems = items.filter(function (item) {
                                    return item["IM_FK_ItemType_id"] == itemType;
                                });

                                var options = [];
                                for (var i in currentlyFilteredItems) {
                                    options.push(currentlyFilteredItems[i]["IM_Sales_Desc"]);
                                }

                                process(getUnique(options));
                            }
                        }, {
                            data: "ADVD_AssetID",
                            type: 'dropdown',
                            allowInvalid: false,
                            strict: true,
                            trimDropdown: true,
                            renderer: autoCompleteRenderer,
                            source: function (query, process) {
                                if (currentlySelectedItem) {
                                    var filteredItems = items.filter(function (item) {
                                        return item["IM_Item_id"] == currentlySelectedItem["IM_Item_id"];
                                    });

                                    var options = [];
                                    for (var i in filteredItems) {
                                        options.push(filteredItems[i]["MC_MachineTag"]);
                                    }

                                    process(getUnique(options));
                                } else {
                                    process([]);
                                }

                            }
                        }, {
                            data: "ADVD_ItemNo",
                            renderer: emptyRenderer
                        }, {
                            data: "ADVD_UOM",
                            type: 'dropdown',
                            allowInvalid: false,
                            strict: true,
                            trimDropdown: true,
                            source: function (query, process) {
                                if (uom) {
                                    var options = [];
                                    for (var i in uom) {
                                        options.push(uom[i]["AD_Desc"]);
                                    }

                                    process(getUnique(options));
                                } else {
                                    process([]);
                                }

                            },
                            renderer: autoCompleteRenderer
                        }, {
                            data: "ADVD_Qty",
                            renderer: emptyRenderer
                        },
                        {
                            data: "ADVD_BookValue",
                            validator: requiredValidator
                        },
                        {
                            data: "ADVD_TotalCost",
                            readOnly: true,
                            renderer: renderTotalDisabled
                        }, {
                            data: "ADVD_Justification",
                            renderer: emptyRenderer
                        }, {
                            data: "ADVD_Status",
                            readOnly: true
                        }
                    ],
                    afterChange: function (changes, source) {
                        if (changes !== null || source != 'loadData') {

                            if ($.inArray(changes[0][1], ['ADVD_Qty', 'ADVD_BookValue']) != -1) {
                                var qty = this.getDataAtRowProp(changes[0][0], 'ADVD_Qty') || 0;
                                var bookValueRaw = this.getDataAtRowProp(changes[0][0], 'ADVD_BookValue') || "0";
                                var bookValue = parseFloat(bookValueRaw.replace(/,/g, '')); //  remove commas

                                this.setDataAtRowProp(changes[0][0], 'ADVD_TotalCost', qty * bookValue);
                            }

                            if ($.inArray(changes[0][1], ['ADVD_ItemDescription']) != -1) {
                                var row = changes[0][0];
                                var description = changes[0][3];

                                for (var i in currentlyFilteredItems) {
                                    if (currentlyFilteredItems[i]["IM_Sales_Desc"] == description) {
                                        currentlySelectedItem = items[i];
                                        this.setDataAtCell(row, 3, currentlySelectedItem["MC_MachineTag"]);
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
            });
        }

        function processDetailsDataForDisplay(details) {
            var processableDetails = [];

            for (var i in details) {

                if (!details[i]["ADVD_ItemType"]) {
                    continue;
                }

                for (var j in uom) {
                    if (details[i]["ADVD_UOM"] == uom[j]["IUC_FK_UOM_id"]) {
                        details[i]["ADVD_UOM"] = uom[j]["AD_Desc"];
                        processableDetails.push(details[i]);
                        break;
                    }
                }
            }

            return processableDetails;
        }

        function getUnique(list) {
            var u = {}, a = [];
            for (var i = 0, l = list.length; i < l; ++i) {
                if (u.hasOwnProperty(list[i])) {
                    continue;
                }
                a.push(list[i]);
                u[list[i]] = 1;
            }
            return a;
        }

    })();

</script>
