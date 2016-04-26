<?php
if ($CA_DateFrom) {
    $date_from   = date_create($CA_DateFrom);
    $CA_DateFrom = date_format($date_from, "m/d/Y");
}

if ($CA_DateTo) {
    $date_to   = date_create($CA_DateTo);
    $CA_DateTo = date_format($date_to, "m/d/Y");
}
?>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
            <a class="cls-btn pull-right" href="<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>" >
                Close
            </a>
            <?php if ($functions): ?>
                <span class="dropdown pull-right">
                    <a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        Functions
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu functions" role="menu" aria-labelledby="dropdownMenu1">
                        <li>
                            <?= $functions ?>
                        </li>
                    </ul>
                </span>
            <?php endif ?>
        </h3>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">            
            <form id="<?= $this->uri->segment(3) ?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5">Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="1" name="CA_DocNo" placeholder="Document No." value="<?= $CA_DocNo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Employee Name:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="2" name="CA_EmployeeName" placeholder="Employee Name" value="<?= $CA_EmployeeName ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Purpose:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="3" name="CA_Purpose" value="<?= $CA_Purpose ?>">                               
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="4" name="CA_Remarks" placeholder="Remarks" value="<?= $CA_Remarks ?>">
                        </div>
                    </div>
                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="5" name="CA_DocDate" placeholder="Document Date." value="<?= $CA_DocDate ?>">
                        </div>                        
                    </div>
                    <!--Date Needed-->
                    <div class="form-group">
                        <label class="control-label col-xs-5">Date Needed:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="6" name="CA_DateFrom" placeholder="From" value="<?= $CA_DateFrom ?>">                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5"></label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="7" name="CA_DateTo" placeholder="To" value="<?= $CA_DateTo ?>">
                        </div>
                    </div>
                    <!--/Date Needed-->
                    <div class="form-group">
                        <label class="control-label col-xs-5">CA Amount:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="8" name="CA_Amount" placeholder="Amount" value="<?= $CA_Amount ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5">CA Request Status:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="9" name="CA_RequestStatus" placeholder="CA Request Status" value="<?= $CA_RequestStatus ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">CA Liquidation Status:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="10" name="CA_LiquidationStatus" placeholder="Liquidation Request Status" value="<?= $CA_LiquidationStatus ?>">
                        </div> 
                    </div>
                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Company:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly name="CA_Company"  tabindex="11" class="form-control" placeholder="Company" value="<?= $CA_Company ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Location:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" readonly value="<?= $CA_Location ?>" name="CA_Location" placeholder="Location">                                
                        </div>
                    </div>
                </span>
            </form>
            <div class="details">Details</div>
            <div id="details-data-container" class="container-fluid">
                <?= generate_table($table) ?>
            </div>
            <div class="details">Liquidation Summary</div>
            <div id="tbl-liquidation-details" class="grid-table">

            </div>
            <hr>
            <div class="btn-cont">
                <a id="action-update-liquidation-details" data-id="<?= $uniqueid ?>" type="button" href="#" class="btn btn-default form-btn main-clr">
                    Update
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

    var locationsAutoComplete = <?= json_encode(array_column($this->session->userdata('location'), 'SP_StoreID')) ?>;

    $(document).ready(function () {

        initializeDetailsTable();
        var liquidationTable = initializeLiquidationDetailsTable();

        /*
         * this.form = configs.form ? configs.form : '#' + _class + "-form";
         this.detailTable = configs.detailTable ? configs.detailTable : null;
         this.moduleURL = configs.moduleURL ? configs.moduleURL : base_url + 'app/' + _module + "/" + _class;
         this.newEntryURL = configs.newEntryURL ? configs.newEntryURL : base_url + 'app/' + _module + "/" + _class + "/add";
         this.processURL = configs.processURL ? configs.processURL : this.moduleURL + '/process';
         */

        var moduleProcessor = new ModuleProcessor({
            isTransactionModule: false,
            detailTable: liquidationTable,
            updateCloseButton: 'action-update-liquidation-details',
            processURL: base_url + 'app/' + _module + "/" + _class + "/save_liquidation"
        });

        moduleProcessor.initialize();

    });

    function initializeLiquidationDetailsTable() {
        return $('#tbl-liquidation-details').gridEntry({
            tableData: <?= json_encode($liquidation_details['data']) ?>,
            gridConfig: {
                minSpareRows: 1,
                colHeaders: [
                    "Date",
                    "Invoice / OR No.",
                    "Payee",
                    "Address",
                    "Tin No",
                    "w/ VAT",
                    "Particular",
                    "Amount",
                    "VAT",
                    "Net of VAT",
                    "Charge To",
                    "Remarks"
                ],
                columns: [
                    {
                        data: "CAL_LiquidationDate",
                        type: 'date',
                        dateFormat: 'MM/DD/YYYY',
                        strict: true,
                        renderer: autoCompleteRenderer
                    },
                    {
                        data: "CAL_InvOR",
                        validator: requiredValidator,
                        renderer: emptyRenderer
                    }, {
                        data: "CAL_Payee",
                        validator: requiredValidator,
                        renderer: emptyRenderer
                    }, {
                        data: "CAL_Address",
                        renderer: emptyRenderer
                    }, {
                        data: "CAL_TinNo",
                        renderer: emptyRenderer
                    }, {
                        data: "CAL_withVAT",
                        type: 'checkbox',
                        renderer: checkRenderer
                    },
                    {
                        data: "CAL_Particular",
                        validator: requiredValidator,
                        renderer: totalTextRenderer
                    }, {
                        data: "CAL_Amount",
                        type: 'numeric',
                        format: '0,0.00',
                        validator: requiredValidator,
                        strict: true,
                        allowInvalid: false,
                        renderer: renderTotal
                    }, {
                        data: "CAL_VAT",
                        type: 'numeric',
                        format: '0,0.00',
                        allowInvalid: false,
                        renderer: renderTotal
                    }, {
                        data: "CAL_NetOfVAT",
                        type: 'numeric',
                        format: '0,0.00',
                        allowInvalid: false,
                        renderer: renderTotal
                    }, {
                        data: "CAL_ChargeTo",
                        type: 'dropdown',
                        allowInvalid: false,
                        strict: true,
                        trimDropdown: true,
                        source: locationsAutoComplete,
                        renderer: autoCompleteRenderer

                    }, {
                        data: "CAL_Remarks",
                        renderer: emptyRenderer
                    }
                ],
                afterChange: function (change, source) {
                    if (change !== null || source != 'loadData') {
                        if ($.inArray(change[0][1], ['CAL_withVAT', 'CAL_Amount']) != -1) {

                            var amount = this.getDataAtRowProp(change[0][0], 'CAL_Amount') || 0;
                            var withVat = this.getDataAtRowProp(change[0][0], 'CAL_withVAT');
                            var vat = parseFloat(amount) - (parseFloat(amount) / 1.12);
                            this.setDataAtRowProp(change[0][0], 'CAL_VAT', withVat == true ? vat : 0);
                            this.setDataAtRowProp(change[0][0], 'CAL_NetOfVAT', withVat == true ? parseFloat(amount) / 1.12 : 0);
                        }
                    }

                }
            }
        });
    }

    function initializeDetailsTable() {
        $('#tbl-cash-advance-details').bind('dynatable:init', function (e, dynatable) {
            $('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");

            $(document).on('click', '.det-delete', function (e) {
                e.preventDefault();

                _this = $(this);
                confirm("Delete Record?", function (confirmed) {
                    if (confirmed) {
                        $.post(base_url + 'app/' + _module + "/" + _class + '/process', {id: _this.data('id'), type: 'delete-details'}, function (data) {
                            if (data == 1) {
                                alert('Deleted!');
                                setTimeout(function () {
                                    dynatable.process();
                                }, 500);
                            } else {
                                alert('Failed!');
                            }
                        }).error(function () {
                            alert('Error!');
                        });
                    }
                });
            });

            $(document).on('click', '.det-update', function (e) {
                e.preventDefault();
                window.location = base_url + 'app/' + _module + "/" + _class + '/view/update/?id=' + $(this).data('id');
            });

            $(document).on('click', '.det-add', function (e) {
                e.preventDefault();
                window.location = base_url + 'app/' + _module + "/" + _class + '/view/add/?id=' + $(this).data('id');
            });

            $('.clear').on('click', function () {
                dynatable.sorts.clear();
                dynatable.queries.remove("search");
                $('[type=search]').val('');
                $(".dynatable-arrow").remove();
                dynatable.process();
            });

            $(this).wrap('<div class="table-container"></div>')
            var $demo1 = $(this);
            $demo1.floatThead({
                scrollContainer: function ($table) {
                    return $table.closest('.table-container');
                }
            });

        }).bind('dynatable:afterUpdate', function (e, dynatable) {
            $('[data-toggle="tooltip"]').tooltip();
        }).bind('dynatable:ajax:success', function (e, dynatable) {
            $(this).floatThead('reflow');
        }).dynatable({
            dataset: {
                ajax: true,
                ajaxUrl: base_url + "app/" + _module + "/" + _class + "/details_data/?id=" + "<?= $this->input->get('id') ?>",
                ajaxOnLoad: true,
                records: []
            },
            features: {
                pushState: false,
            },
            inputs: {
                processingText: '<img  id="loader" src="' + base_url + 'css/assets/data_loader.gif" />'
            }
        }).data('dynatable');
    }
</script>
