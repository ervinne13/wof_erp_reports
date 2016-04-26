
<style>
    .editable-input select {
        height: 30px !important;
    }

    .label-error {
        color: red;
        display:none;
    }

    .glyphicon.red {
        color: red;
    }

    .glyphicon.red:hover {
        color: #ff6666 !important;
        cursor: help;
    }
    .popover-title {
        color: black;
    }

</style>

<!--<link href="bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet">-->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/bootstrap-editable.css">

<?php
$module_index_url = base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3));
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

                <!--Column 1-->
                <span class="col-md-6">                    
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="1" name="GJ_DocNo" placeholder="Document No.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Reference No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" tabindex="1" name="GJ_RefNo" placeholder="Reference  No.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <textarea class="form-control" tabindex="1" name="GJ_Remarks" placeholder="Remarks"></textarea>
                        </div>
                    </div>

                </span><!--/Column 1-->

                <!--Column 2-->
                <span class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control datepicker" id="" tabindex="1" name="GJ_DocDate" value="<?= $current_date ?>">
                        </div>
                    </div>                    
                </span><!--/Column 2-->
            </form>

            <div id="error-message-container" class="alert alert-danger" role="alert" style="display: none;">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <span id="error-message"></span>
            </div>

            <hr>

            <div class="details">Details</div>
            <div id="details-data-container" class="container-fluid">
                <!--Details table goes in here later once document number gets generated-->
                <div style="text-align: center">
                    <span>Waiting for document number to be generated</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                    <label class="control-label col-xs-5">Running Total:</label>
                    <label class="control-label"><?= $GJ_Amount ?></label>
                </div>
            </div>

            <hr>

            <div class="btn-cont">
                <!--<a id="save" type="button" href="#" class="btn btn-default form-btn main-clr">
                                    Save
                                </a>-->
                <a id="save-new" type="button" href="#" class="btn btn-default form-btn main-clr">
                    Save & New
                </a>
                <a id="save-close" type="button" href="#" class="btn btn-default form-btn main-clr">
                    Save & Close
                </a>
                <a type="button" href="<?= $module_index_url ?>/" class="btn btn-default form-btn sub-clr">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view("app/financial-management/general-journal/editable-row-template", array('current_date' => $current_date)); ?>

<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-editable.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/underscore-min.js"></script>

<script type="text/javascript" src="<?= base_url() ?>js/dynatable_generator.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/module_header_processor.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/module_detail_list_view_processor.js"></script>

<script type="text/javascript">

    /* global ModuleDetailListViewProcessor, _module, base_url, _class */

    (function () {

        var locations = <?= json_encode($locations) ?>;
        var currencies = <?= json_encode($currencies["data"]) ?>;

        var currentlyAvailableAccounts = [];

        var moduleHeaderProcessor;
        var moduleDetailListViewProcessor;

        var detailTableSelector = '#tbl-general-journal-detail';

        $(document).ready(function () {

            moduleHeaderProcessor = new ModuleHeaderProcessor({
                detailEditMode: 'inline',
                isTransactionModule: true
            });
            moduleHeaderProcessor.initialize();
            moduleHeaderProcessor.loadNumberSeries('input[name=GJ_DocNo]', onNumberSeriesLoaded);

            moduleDetailListViewProcessor = new ModuleDetailListViewProcessor({
                redirectTo: "edit",
                mode: ModuleDetailListViewProcessor.MODE_INLINE_EDIT,
                doOnRowAdded: onRowAdded
            });

            //turn to inline mode
            $.fn.editable.defaults.mode = 'popup';

            initalizeUI();
            initializeEvents();

        });

        function onNumberSeriesLoaded(id) {

            var url = base_url + "app/" + _module + "/" + _class + "/generate_table?id=" + id;
            $.get(url, function (table) {
                $('#details-data-container').html(table);
                moduleDetailListViewProcessor.initializeTable(detailTableSelector, id);
            });

            $('#details-data-container').html('<img id="loader" src="' + base_url + 'css/assets/data_loader.gif" />');

        }

        function initalizeUI() {

            $("body").tooltip({selector: '[data-toggle=tooltip]'});

        }

        function initializeEvents() {

            $('body').on('click', '.det-inline-remove', function (e) {
                e.preventDefault();

                var dataType = $(this).data('type');
                var referenceId = $(this).data('reference-id');

                if (dataType == 'existing-data') {
                    if (moduleHeaderProcessor.deletedDetailsReferenceIdList.indexOf(referenceId) <= -1) {
                        moduleHeaderProcessor.deletedDetailsReferenceIdList.push(referenceId);
                    }
                    $(this).tooltip('hide');
                    $('tr[data-reference-id=' + referenceId + ']').remove();
                } else if (dataType == 'new-data') {
                    $(this).tooltip('hide');
                    $('tr[data-reference-id=' + referenceId + ']').remove();
                } else {
                    alert('Unknown data type: ' + dataType);
                }

            });

            $('body').on('click', '.det-add', function (e) {
                e.preventDefault();

                addBlankRow();
            });
        }

        function addBlankRow() {
            var rowCount = $(moduleDetailListViewProcessor.tableSelector + ' tbody tr').length;

            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }

            var rowValues = {
                reference_id: rowCount,
                data_type: 'new-data',
                GJD_PostingDate: yyyy + '/' + mm + '/' + dd,
                GJD_AccountType: '',
                GJD_AccountNo: '',
                GJD_AccountName: '',
                GJD_Debit: '',
                GJD_Credit: '',
                GJD_Amount: '',
                GJD_AmountLCY: '',
                GJD_CY: '',
                GJD_CPC: '',
                GJD_Comment: '',
                access: {
                    edit: true,
                    delete: true
                }
            };
            var rowHTML = moduleDetailListViewProcessor.newRowTemplate(rowValues);

            if (rowCount > 0) {
                $(moduleDetailListViewProcessor.tableSelector + ' tbody tr:last').after(rowHTML);
            } else {
                $(moduleDetailListViewProcessor.tableSelector + ' tbody').html(rowHTML);
            }

            if (moduleDetailListViewProcessor.doOnRowAdded) {
                moduleDetailListViewProcessor.doOnRowAdded(rowCount, rowValues);
            }
        }

        function onRowAdded(referenceId, rowValues) {

            //  reference id selector
            var ris = '[data-reference-id=' + referenceId + ']';

            $('.editable-disabled' + ris).editable('toggleDisabled');

            if (rowValues.access.edit) {
                $('.editable' + ris).editable();
            } else {
                $('.editable' + ris).editable('toggleDisabled');
            }

            $('.editable-select[name=GJD_AccountType]' + ris).editable({
                value: rowValues.GJD_AccountType,
                source: [
                    {value: 'Bank Account', text: 'Bank Account'},
                    {value: 'Customer', text: 'Customer'},
                    {value: 'G/L Account', text: 'G/L Account'},
                    {value: 'Supplier', text: 'Supplier'}
                ]
            });

            var currencyOptions = [];
            for (var i in currencies) {
                currencyOptions.push({
                    value: currencies[i].AD_Code,
                    text: currencies[i].AD_Desc
                });
            }

            $('.editable-select[name=GJD_CY]' + ris).editable({
                value: rowValues.GJD_CY,
                source: currencyOptions
            });

            var locationOptions = [];
            for (var i in locations) {
                locationOptions.push({
                    value: locations[i].SP_StoreID,
                    text: locations[i].SP_StoreName
                });
            }

            console.log(rowValues.GJD_CPC);

            $('.editable-select[name=GJD_CPC]' + ris).editable({
                value: rowValues.GJD_CPC,
                source: locationOptions
            });

            $('.editable[name=GJD_Debit]' + ris).on('save', function (e, params) {
                setTimeout(function () {
                    computeAndDisplayAmount(referenceId);
                }, 0);
            });

            $('.editable[name=GJD_Credit]' + ris).on('save', function (e, params) {
                setTimeout(function () {
                    computeAndDisplayAmount(referenceId);
                }, 0);
            });

            $('.editable-select[name=GJD_AccountType]' + ris).on('save', function (e, params) {
                onAccountTypeChanged(referenceId, params.newValue);
            });

            $('.editable-select[name=GJD_CY]' + ris).on('save', function (e, params) {
                setTimeout(function () {
                    computeAmountInLocalCurrency(referenceId);
                }, 0);
            });

            $('.editable-select[name=GJD_CPC]' + ris).on('save', function (e, params) {
                setTimeout(function () {
                    computeAmountInLocalCurrency(referenceId);
                }, 0);
            });

            $('.editable' + ris).on('save', function (e, params) {
                setTimeout(function () {
                    if (moduleHeaderProcessor.changedDetailsReferenceIdList.indexOf(referenceId) <= -1) {
                        moduleHeaderProcessor.changedDetailsReferenceIdList.push(referenceId);
                    }

                    console.log(moduleHeaderProcessor.changedDetailsReferenceIdList);
                }, 0);
            });

            $('.editable-select' + ris).on('save', function (e, params) {
                setTimeout(function () {
                    if (moduleHeaderProcessor.changedDetailsReferenceIdList.indexOf(referenceId) <= -1) {
                        moduleHeaderProcessor.changedDetailsReferenceIdList.push(referenceId);
                    }

                    console.log(moduleHeaderProcessor.changedDetailsReferenceIdList);
                }, 0);
            });

            //automatically show next editable
            $('.editable,.editable-select').on('save.newuser', function () {
                var _this = this;
                setTimeout(function () {
                    var nextColumn = $(_this).closest('td').next();
                    if (!nextColumn.length) {
                        //  Start new row
                        addBlankRow();
                    } else {
                        //  Find and open next field
                        while (!nextColumn.find('.editable,.editable-select').length) {
                            nextColumn = nextColumn.next();
                            console.log('finding');
                        }

                        nextColumn.find('.editable,.editable-select').editable('show');
                    }
                }, 200);
            });

            displayAccountFieldsLoading(referenceId, false);
            displayAmountLCYComputing(referenceId, false);
            displayRowLoading(referenceId, false);

        }

        function onAccountTypeChanged(referenceId, accountType, selectedAccountName) {
            //  reference id selector
            var ris = '[data-reference-id=' + referenceId + ']';

            loadAccounts(accountType, function (accounts) {
                accounts = JSON.parse(accounts);
                currentlyAvailableAccounts = accounts;
                var parsedAccounts = [];

                for (var i in accounts) {
                    parsedAccounts.push({
                        value: accounts[i].AccountName,
                        text: accounts[i].AccountName
                    });
                }

                console.log(parsedAccounts);

                var editableParams;
                if (selectedAccountName) {
                    editableParams = {
                        value: selectedAccountName,
                        source: parsedAccounts
                    };
                    for (var i in currentlyAvailableAccounts) {
                        if (currentlyAvailableAccounts[i]['AccountName'] == selectedAccountName) {
                            $('.editable[name=GJD_AccountNo]' + ris).editable('setValue', currentlyAvailableAccounts[i]['AccountNo']);
                        }
                    }
                } else {
                    editableParams = {
                        source: parsedAccounts
                    };
                }

                $('.editable-select[name=GJD_AccountName]' + ris).editable('destroy');
                $('.editable-select[name=GJD_AccountName]' + ris).editable(editableParams);

                $('.editable-select[name=GJD_AccountName]' + ris).on('save', function (e, params) {
                    for (var i in currentlyAvailableAccounts) {
                        if (currentlyAvailableAccounts[i]['AccountName'] == params.newValue) {
//                            $('span[name=GJD_AccountNo]' + ris).html(currentlyAvailableAccounts[i]['AccountNo']);
                            $('.editable[name=GJD_AccountNo]' + ris).editable('setValue', currentlyAvailableAccounts[i]['AccountNo']);
                        }
                    }
                });

                displayAccountFieldsLoading(referenceId, false);

            });

            $('.editable-select[name=GJD_AccountName]' + ris).html('');
            $('.editable[name=GJD_AccountNo]' + ris).html('');
//            $('.editable[name=GJD_AccountNo]' + ris).editable('setValue', null);
//            $('span[name=GJD_AccountNo]' + ris).html('');

            displayAccountFieldsLoading(referenceId, true);
        }

        function loadAccounts(accountType, onAccountsLoaded) {

            if (accountType == "G/L Account") {
                accountType = "GL Account";
            }

            var url = base_url + "app/" + _module + "/" + _class + "/get_account_numbers/" + accountType;

            $.get(url, function (response) {
                enableAccountFields(true);
                onAccountsLoaded(response);
            }).fail(function (error) {
                if (error && error.statusText) {
                    console.log(error);
                    alert(error.statusText);
                } else {
                    alert("Failed to fetch accounts under " + accountType);
                }
            });

            enableAccountFields(false);

        }

        function enableAccountFields(referenceId, enable) {

            //  reference id selector
            var ris = '[data-reference-id=' + referenceId + ']';

            if (enable) {
                $('.editable-select[name=GJD_AccountName]' + ris).css('display', 'inline');
                $('span[name=GJD_AccountNo]' + ris).css('display', 'inline');
            } else {
                $('.editable-select[name=GJD_AccountName]' + ris).css('display', 'none');
                $('span[name=GJD_AccountNo]' + ris).css('display', 'none');
            }

        }

        function displayRowLoading(referenceId, display) {
            //  reference id selector
            var ris = '[data-reference-id=' + referenceId + ']';

            if (display) {
                $('.loader[data-for=row]' + ris).css('display', 'inline');
            } else {
                $('.loader[data-for=row]' + ris).css('display', 'none');
            }
        }

        function displayAccountFieldsLoading(referenceId, display) {
            //  reference id selector
            var ris = '[data-reference-id=' + referenceId + ']';

            if (display) {
                $('.loader[data-for=GJD_AccountName]' + ris).css('display', 'inline');
                $('.loader[data-for=GJD_AccountNo]' + ris).css('display', 'inline');
            } else {
                $('.loader[data-for=GJD_AccountName]' + ris).css('display', 'none');
                $('.loader[data-for=GJD_AccountNo]' + ris).css('display', 'none');
            }

        }

        function displayAmountLCYComputing(referenceId, display) {
            //  reference id selector
            var ris = '[data-reference-id=' + referenceId + ']';

            if (display) {
                $('.loader[data-for=GJD_AmountLCY]' + ris).css('display', 'inline');
            } else {
                $('.loader[data-for=GJD_AmountLCY]' + ris).css('display', 'none');
            }

        }

        function computeAmount(referenceId) {

            //  reference id selector
            var ris = '[data-reference-id=' + referenceId + ']';

            var rawDebit = $('.editable[name=GJD_Debit]' + ris).editable('getValue');
            var rawCredit = $('.editable[name=GJD_Credit]' + ris).editable('getValue');

            var debit = parseFloat(rawDebit[referenceId + "_GJD_Debit"]);
            var credit = parseFloat(rawCredit[referenceId + "_GJD_Credit"]);

            console.log(rawDebit);
            console.log(rawCredit);

            if (!debit || isNaN(debit)) {
                debit = 0;
            }

            if (!credit || isNaN(credit)) {
                credit = 0;
            }

            return debit - credit;
        }

        function computeAndDisplayAmount(referenceId) {

            //  reference id selector
            var ris = '[data-reference-id=' + referenceId + ']';

            var total = computeAmount(referenceId);

            if (total < 0) {
                $('.editable[name=GJD_Credit]' + ris).editable('setValue', total * -1);
                $('.editable[name=GJD_Debit]' + ris).editable('setValue', 0);
//                $('span[name=GJD_Amount]' + ris).html('(' + (total * -1) + ')');
//                $('.editable[name=GJD_Amount]' + ris).editable('setValue', '(' + (total * -1) + ')');
            } else {
                $('.editable[name=GJD_Credit]' + ris).editable('setValue', 0);
                $('.editable[name=GJD_Debit]' + ris).editable('setValue', total);
            }

            $('.editable[name=GJD_Amount]' + ris).editable('setValue', total);

            computeAmountInLocalCurrency(referenceId);
        }

        function computeAmountInLocalCurrency(referenceId) {

            //  reference id selector
            var ris = '[data-reference-id=' + referenceId + ']';

            var rawCurrency = $('.editable[name=GJD_CY]' + ris).editable('getValue');
            var rawLocation = $('.editable[name=GJD_CPC]' + ris).editable('getValue');

            var currency = rawCurrency[referenceId + "_GJD_CY"];
            var location = rawLocation[referenceId + "_GJD_CPC"];
            var amount = computeAmount(referenceId);

            var currencyId = null;
            var companyId = null;

            for (var i in currencies) {
                if (currencies[i]['AD_Code'] == currency) {
                    currencyId = currencies[i]['AD_Id'];
                    break;
                }
            }

            for (var i in locations) {
                if (locations[i]['SP_StoreID'] == location) {
                    companyId = locations[i]['COM_Id'];
                    break;
                }
            }

            console.log(currencies);
            console.log(locations);
            console.log(companyId);
            console.log(currencyId);

            if (companyId && currencyId) {
                var url = base_url + "app/" + _module + "/" + _class + "/get_amount_lcy";
                var params = {
                    company_id: companyId,
                    convert_to_currency_id: currencyId,
                    amount: amount
                };

                console.log(params);

                $.post(url, params, function (response) {
                    console.log(response);
                    displayAmountLCYComputing(referenceId, false);
                    response = JSON.parse(response);

                    if (response.status == 0) {
                        alert(response.message);
                    } else {
//                        $('span[name=GJD_AmountLCY]' + ris).html(response.amount);
                        $('.editable[name=GJD_AmountLCY]' + ris).editable('setValue', response.amount);
                    }
                });

                displayAmountLCYComputing(referenceId, true);

            } else {
                console.log("Company id and currency id needed to compute amount in lcy");
            }
        }

    })();

</script>