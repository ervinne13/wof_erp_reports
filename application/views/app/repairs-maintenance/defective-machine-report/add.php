
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/jquery.datetimepicker.css"/>

<script type="text/javascript" src="<?= base_url() ?>js/jquery.datetimepicker.full.min.js"></script>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
        </h3>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">
            <form id="<?= $this->uri->segment(3) ?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
                <div class="row">
                    <span class="col-md-6">
                        <div class="form-group">
                            <label for="sel1" class="control-label col-xs-5">Document No.:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly class="form-control" tabindex="1" name="DMR_DocNo" placeholder="Document No.">
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Reference No.:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly class="form-control" id="" tabindex="2" name="DMR_RefNo" placeholder="JO-xxxxxx">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Remarks:</label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control" tabindex="3" name="DMR_Remarks" placeholder="Remarks">
                            </div>
                        </div>                   
                    </span>
                    <span class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Document Date:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly class="form-control" tabindex="4" name="DMR_DocDate" placeholder="Document Date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Location:</label>
                            <div class="col-xs-7">                            
                                <select class="form-control select-cli" tabindex="5" name="DMR_Location" placeholder="Location">
                                    <?php if (count($locations) > 1): ?>
                                        <option value="" disabled selected>Location</option>
                                        <?php foreach ($locations AS $location): ?>
                                            <?php $selected = $location["SP_StoreID"] == $default_location["CA_FK_Location_id"] ? "selected" : "" ?>
                                            <option value="<?= $location["SP_StoreID"] ?>" <?= $selected ?>>
                                                <?= $location["SP_StoreName"] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <input type="text" class="form-control" tabindex="5" readonly value="<?= $locations[0]['SP_StoreID'] ?>" name="DMR_Location" placeholder="Location">
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Company:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly name="DMR_Company" tabindex="6" class="form-control" placeholder="Company" value="<?= $company ?>">
                            </div>
                        </div>
                    </span>
                </div>

                <br>

                <div class="row">
                    <span class="col-md-6">
                        <div class="form-group">
                            <label for="sel1" class="control-label col-xs-5">Item Description:</label>
                            <div class="col-xs-7">
                                <select class="form-control select-cli" tabindex="7" name="DMR_ItemDescription"></select>
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Asset ID:</label>
                            <div class="col-xs-7">
                                <select class="form-control select-cli" tabindex="7" name="DMR_AssetID"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Item No:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly class="form-control" tabindex="9" name="DMR_ItemNo">
                            </div>
                        </div>                   
                    </span>
                    <span class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Nature of Defect:</label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control" tabindex="10" name="DMR_NatureOfDefect">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Job Needed:</label>
                            <div class="col-xs-7">
                                <select class="form-control select-cli" tabindex="11" name="DMR_JobNeeded">
                                    <option value="" disabled selected>Reason</option>
                                    <?php foreach ($reasons AS $reason): ?>                                            
                                        <option value="<?= $reason["RM_FK_Reason_id"] ?>">
                                            <?= $reason["R_Description"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Technician:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly name="" tabindex="12" class="form-control" value="<?= $U_Username ?>">
                            </div>
                        </div>
                    </span>
                </div>

                <br>

                <div class="row">
                    <span class="col-md-6">
                        <div class="form-group">
                            <label for="sel1" class="control-label col-xs-5">Date Down:</label>
                            <div class="col-xs-7">                                
                                <input type="text" class="form-control datetimepicker" tabindex="13" name="DMR_DateDown" placeholder="Date Down">
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Date Operational:</label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control datetimepicker" tabindex="14" name="DMR_DateOperational" placeholder="Date Operational">
                            </div>
                        </div>
                    </span>
                    <span class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Downtime Days:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly class="form-control" tabindex="15" name="DMR_DowntimeDays">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Status:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly class="form-control" tabindex="16" name="DMR_Status" value="Open">
                            </div>
                        </div>                        
                    </span>
                </div>

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

        var detailTable;

        var moduleUrl = base_url + 'app/' + _module + "/" + _class;
        var currentUser = "<?= $U_Username ?>";

        var locationsData = <?= json_encode($locations) ?>;
        var currentlyAvailableMachines = <?= json_encode($default_location_machines) ?>;

        var descriptions = [];
        var machineDescriptionOptions = [];
        var machineAssetIdMatrixByItemNo = [];

        $(document).ready(function () {

            initializeUI();

            processMachineOptions(currentlyAvailableMachines);
            refreshItemDescriptionOptions();

            detailTable = initializeDetailTable();

            var moduleProcessor = new ModuleProcessor({
                isTransactionModule: true,
                detailTable: detailTable,
                processDetailsData: processDetailsData
            });

            moduleProcessor.initialize();
            moduleProcessor.loadNumberSeries('input[name=DMR_DocNo]');

        });

        function initializeUI() {

            $('select[name=DMR_Location]').selectize({
                sortField: 'text',
                onChange: function (value) {

                    loadItemsByLocation(value);

                    for (var i in locationsData) {
                        if (locationsData[i]["SP_StoreID"] == value) {
                            var companyName = locationsData[i]["COM_Name"];
                            $('input[name=DMR_Company]').val(companyName);
                        }
                    }
                }
            });

            $('select[name=DMR_ItemDescription]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    refreshItemDescriptionDependentFields(value);
                }
            });

            $('select[name=DMR_AssetID]').selectize();
            $('select[name=DMR_JobNeeded]').selectize();

            $('.datetimepicker').datetimepicker({
                format: 'm/d/Y h:i A',
                onClose: function (currentTime) {
                    refreshDowntimeDays();
                }
            });

        }

        function initializeDetailTable() {
            return $('#tbl-details').gridEntry({
                tableData: <?= json_encode($details['data']) ?>,
                gridConfig: {
                    minSpareRows: 1,
                    colHeaders: [
                        "Date",
                        "Action Taken",
                        "Technician"
                    ],
                    colWidths: [30, 120],
                    columns: [
                        {
                            data: "DMRD_Date",
                            type: 'date',
                            dateFormat: 'MM/DD/YYYY',
                            correctFormat: true
                        },
                        {
                            data: "DMRD_ActionTaken",
                            renderer: emptyRenderer
                        }, {
                            data: "DMRD_UserID",
                            renderer: userIdRenderer
                        }
                    ]
                }
            });
        }

        function userIdRenderer(instance, td, row, col, prop, value, cellProperties) {

            cellProperties.readOnly = false;

            if (row == instance.countRows() - 1) {
                td.innerText = '';
                value = null;
                return;
            } else {
                td.innerText = currentUser;
                value = currentUser;
            }

            Handsontable.renderers.TextRenderer.apply(this, arguments);
        }

        function processDetailsData(details) {

            var processableDetails = [];

            for (var i in details) {
                if (details[i]["DMRD_Date"]) {
                    details[i]["DMRD_UserID"] = currentUser;
                    processableDetails.push(details[i]);
                }
            }

            return JSON.stringify(processableDetails);
        }

        function loadItemsByLocation(location) {

            var url = moduleUrl + "/machines?location=" + location;

            $.get(url, function (response) {
                enableLocationDependentFields(true);
                currentlyAvailableMachines = JSON.parse(response);

                processMachineOptions(currentlyAvailableMachines);

                refreshItemDescriptionOptions();

            });

            enableLocationDependentFields(false);

        }

        function enableLocationDependentFields(enable) {

            var machineDescriptionsSelect = $('select[name=DMR_ItemDescription]')[0].selectize;

            if (enable) {
                machineDescriptionsSelect.enable();
            } else {
                machineDescriptionsSelect.disable();
            }
        }

        function refreshItemDescriptionOptions() {
            var machineDescriptionsSelect = $('select[name=DMR_ItemDescription]')[0].selectize;

            machineDescriptionsSelect.clear();
            machineDescriptionsSelect.clearOptions();
            machineDescriptionsSelect.load(function (process) {
                process(machineDescriptionOptions);
            });
        }

        function refreshDowntimeDays() {
            var dateDown = $('input[name=DMR_DateDown]').datetimepicker('getValue');
            var dateOperational = $('input[name=DMR_DateOperational]').datetimepicker('getValue');

            if (dateDown && dateOperational) {
                var timeDiff = Math.abs(dateDown.getTime() - dateOperational.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                $('input[name=DMR_DowntimeDays]').val(diffDays);
            }

        }

        function refreshItemAssetIdOptions(assetIdList) {

            var options = [];

            for (var i in assetIdList) {
                options.push({
                    text: assetIdList[i],
                    value: assetIdList[i]
                });
            }

            var machineAssetIdsSelect = $('select[name=DMR_AssetID]')[0].selectize;

            machineAssetIdsSelect.clear();
            machineAssetIdsSelect.clearOptions();
            machineAssetIdsSelect.load(function (process) {
                process(options);
            });

        }

        function refreshItemDescriptionDependentFields(description) {

            var selectedMachine;

            //  find selected machine
            for (var i in currentlyAvailableMachines) {
                if (currentlyAvailableMachines[i]["IM_Sales_Desc"] == description) {
                    selectedMachine = currentlyAvailableMachines[i];
                    break;
                }
            }

            var itemNo = selectedMachine["MC_IM_Item_id"];
            var assetIdList = machineAssetIdMatrixByItemNo[itemNo];

            $('[name=DMR_ItemNo]').val(itemNo);
            refreshItemAssetIdOptions(assetIdList);
        }

        function processMachineOptions(machines) {

            //  reset
            machineAssetIdMatrixByItemNo = [];
            machineDescriptionOptions = [];
            descriptions = [];

            for (var i in machines) {
                var description = machines[i]["IM_Sales_Desc"];
                var itemNo = machines[i]["MC_IM_Item_id"];
                var assetId = machines[i]["MC_MachineTag"];

                if (descriptions.indexOf(description) == -1) {
                    descriptions.push(machines[i]["IM_Sales_Desc"]);

                    //  create new entry in the matrix
                    machineAssetIdMatrixByItemNo[itemNo] = [assetId];

                    machineDescriptionOptions.push({
                        text: description,
                        value: description
                    });

                } else {
                    machineAssetIdMatrixByItemNo[itemNo].push(assetId);
                }
            }

        }

    })();

</script>