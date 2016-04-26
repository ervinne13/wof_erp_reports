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
                        <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly name="RE_DocNo" class="form-control"  tabindex="1" placeholder="Document No." value="<?= $RE_DocNo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Employee Name:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly name="RE_EmployeeName" class="form-control"  tabindex="2" placeholder="Employee Name" value="<?= $RE_EmployeeName ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <input type="text" name="RE_Remarks" class="form-control"  tabindex="3" placeholder="Remarks" value="<?= $RE_Remarks ?>">
                        </div> 
                    </div>
                    <div class="form-group">
                        <div class="col-xs-5">
                            <input type="checkbox" readonly disabled name="RE_WithCA" class="pull-right" <?= $RE_WithCA == 1 ? "checked" : "" ?>>
                        </div> 
                        <div class="col-xs-7">
                            <label class="control-label" for="">with Cash Advance</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Ref Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly name="RE_RefDocNo" class="form-control"  tabindex="4" placeholder="Ref Doc. No." value="<?= $RE_RefDocNo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">CA Amount</label>
                        <div class="col-xs-7">
                            <input type="text" readonly name="RE_CAAmount" class="form-control"  tabindex="5" placeholder="CA Amount" value="<?= $RE_CAAmount ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Liquidated Amount</label>
                        <div class="col-xs-7">
                            <input type="text" readonly name="RE_LiquidatedAmount" class="form-control"  tabindex="6" placeholder="Liquidated Amount" value="<?= $RE_LiquidatedAmount ?>">
                        </div>
                    </div>
                </span>
                <span class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                            <input type="text" name="RE_DocDate" class="form-control datepicker"  tabindex="7" placeholder="Document Date" value="<?=format($RE_DocDate)?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Company:</label>
                        <div class="col-xs-7">
                            <input type="text" name="RE_Company" class="form-control"  tabindex="8" placeholder="Company" value="<?= $RE_Company ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Location:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="RE_Location" placeholder="Location"  tabindex="9">
                                <?php if (count($locations) > 1): ?>
                                    <option value="" disabled selected>Location</option>
                                    <?php foreach ($locations AS $location): ?>
                                        <?php $selected = $location["SP_StoreID"] == $RE_Location ? "selected" : "" ?>
                                        <option value="<?= $location["SP_StoreID"] ?>" <?= $selected ?>>
                                            <?= $location["SP_StoreName"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <input type="text" class="form-control" id="" readonly value="<?= $locations[0]['SP_StoreID'] ?>" name="RE_Location" placeholder="Location">
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Reimbursement:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly name="RE_Reimbursement" class="form-control"  tabindex="10" placeholder="Reimbursement" value="<?= $RE_Reimbursement ?>">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Status:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly name="RE_Status" class="form-control"  tabindex="11" placeholder="Status" value="<?= $RE_Status ?>">
                        </div>
                    </div>
                </span>                
            </form>

            <hr>
            <div id="tbl-details" class="grid-table">

            </div>
            <hr>

            <div class="btn-cont">                
                <a id="action-update-close" tabindex="12" type="button" href="#" class="btn btn-default form-btn main-clr">
                    Save
                </a>
                <a type="button" tabindex="13" href="<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>/" class="btn btn-default form-btn sub-clr">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>js/module_processor.js"></script>

<script type="text/javascript">

    (function () {

        var locationsData = <?= json_encode($locations) ?>;
        var locationsAutoComplete = <?= json_encode(array_column($this->session->userdata('location'), 'SP_StoreID')) ?>;

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

            $('select[name=RE_Location]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in locationsData) {
                        if (locationsData[i]["SP_StoreID"] == value) {
                            var companyName = locationsData[i]["COM_Name"];
                            $('input[name=RE_Company]').val(companyName);
                        }
                    }
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
                        "Invoice / OR No.",
                        "Payee",
                        "Address",
                        "TIN No.",
                        "w/ VAT",
                        "Particulars",
                        "Amount",
                        "VAT",
                        "Net of VAT",
                        "Charged To"
                    ],
                    columns: [
                        {
                            data: "RED_TransDate",
                            type: 'date',
                            dateFormat: 'MM/DD/YYYY',
                            strict: true,
                            renderer: autoCompleteRenderer
                        },
                        {
                            data: "RED_InvOR",
                            validator: requiredValidator,
                            renderer: emptyRenderer
                        }, {
                            data: "RED_Payee",
                            validator: requiredValidator,
                            renderer: emptyRenderer
                        }, {
                            data: "RED_Address",
                            renderer: emptyRenderer
                        }, {
                            data: "RED_TinNo",
                            renderer: emptyRenderer
                        }, {
                            data: "RED_withVAT",
                            type: 'checkbox',
                            renderer: checkRenderer
                        },
                        {
                            data: "RED_Particulars",
                            validator: requiredValidator,
                            renderer: totalTextRenderer
                        }, {
                            data: "RED_Amount",
                            type: 'numeric',
                            format: '0,0.00',
                            validator: requiredValidator,
                            strict: true,
                            allowInvalid: false,
                            renderer: renderTotal
                        }, {
                            data: "RED_VAT",
                            type: 'numeric',
                            format: '0,0.00',
                            allowInvalid: false,
                            renderer: renderTotal
                        }, {
                            data: "RED_NetOfVat",
                            type: 'numeric',
                            format: '0,0.00',
                            allowInvalid: false,
                            renderer: renderTotal
                        }, {
                            data: "RED_ChargeTo",
                            type: 'dropdown',
                            allowInvalid: false,
                            strict: true,
                            trimDropdown: true,
                            source: locationsAutoComplete,
                            renderer: autoCompleteRenderer

                        },
                    ],
                    afterChange: function (change, source) {
                        if (change !== null || source != 'loadData') {
                            if ($.inArray(change[0][1], ['RED_withVAT', 'RED_Amount']) != -1) {
                                var amount = this.getDataAtRowProp(change[0][0], 'RED_Amount') || 0;
                                var withVat = this.getDataAtRowProp(change[0][0], 'RED_withVAT');
                                var vat = parseFloat(amount) - (parseFloat(amount) / 1.12);
                                this.setDataAtRowProp(change[0][0], 'RED_VAT', withVat == true ? vat : 0);
                                this.setDataAtRowProp(change[0][0], 'RED_NetOfVat', withVat == true ? parseFloat(amount) / 1.12 : 0);
                            }
                        }

                    }
                }
            });
        }

    })();

</script>
