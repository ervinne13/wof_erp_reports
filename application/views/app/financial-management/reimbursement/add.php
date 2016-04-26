
<?php
$doc_date   = date_create($RE_DocDate);
$RE_DocDate = date_format($doc_date, "m/d/Y");

$company = $default_location["SP_FK_CompanyID"];
?>

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
                            <input type="text" readonly name="RE_DocNo" class="form-control" placeholder="Document No."  tabindex="1">
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
                            <input type="text" name="RE_Remarks" class="form-control"  tabindex="3" placeholder="Remarks">
                        </div> 
                    </div>                    
                </span>
                <span class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                            <input type="text" name="RE_DocDate" class="form-control datepicker"  tabindex="4" placeholder="Document Date" value="<?= $RE_DocDate ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Company:</label>
                        <div class="col-xs-7">
                            <input type="text" name="RE_Company" class="form-control"  tabindex="5" placeholder="Company" value="<?= $company ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Location:</label>
                        <div class="col-xs-7">                            
                            <select class="form-control select-cli" name="RE_Location" placeholder="Location"  tabindex="6">
                                <?php if (count($locations) > 1): ?>
                                    <option value="" disabled selected>Location</option>
                                    <?php foreach ($locations AS $location): ?>
                                        <?php $selected = $location["SP_StoreID"] == $default_location["CA_FK_Location_id"] ? "selected" : "" ?>
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
                            <input type="text" readonly name="RE_Reimbursement"  tabindex="7" class="form-control" placeholder="Reimbursement">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Status:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly name="RE_Status"  tabindex="8" class="form-control" placeholder="Status">
                        </div>
                    </div>
                </span>                
            </form>

            <hr>
            <div id="tbl-details" class="grid-table">

            </div>
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
            moduleProcessor.loadNumberSeries('input[name=RE_DocNo]');

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
                    colWidths: [50, 90],
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
