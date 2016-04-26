
<?php
$document_header_id = $this->input->get('id');
$redirectTo         = $this->input->get('redirectTo') ? $this->input->get('redirectTo') : "view";

$module_url = base_url("app/{$this->uri->segment(2)}/{$this->uri->segment(3)}");
$back_url   = base_url("app/{$this->uri->segment(2)}/{$this->uri->segment(3)}/{$redirectTo}?id={$document_header_id}");
?>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
        </h3>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">
            <form id="<?= $this->uri->segment(3) ?>-form" class="form-horizontal row page-form" role="form" class="container">
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Posting Date:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control datepicker" tabindex="1" name="GJD_PostingDate" placeholder="Posting Date" value="<?= $current_date ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5">Account Type:</label>
                        <div class="col-xs-7">
                            <select class="form-control single-default" placeholder="Account Type" id="" name="GJD_AccountType" tabindex="2">
                                <option value="" disabled selected></option>                                 
                                <option value="Bank Account">Bank Account</option>
                                <option value="Customer">Customer</option>                                
                                <option value="G/L Account">G/L Account</option>
                                <option value="Supplier">Supplier</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5">Account Name:</label>
                        <div class="col-xs-7">
                            <select class="form-control single-default" placeholder="Account Name." id="" name="GJD_AccountName" tabindex="3">
                                <option value="" disabled selected></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="control-label col-xs-5">Account No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly tabindex="4" name="GJD_AccountNo" placeholder="Account No.">
                        </div>
                    </div>
                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Debit:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" tabindex="5" name="GJD_Debit" placeholder="Debit">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Credit:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" tabindex="6" name="GJD_Credit" placeholder="Credit">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Amount:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" tabindex="7" name="GJD_Amount" placeholder="Amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">CY:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="GJD_CY" placeholder="CY" tabindex="8" > 
                                <option value="" disabled selected></option>
                                <?php foreach ($currencies["data"] AS $currency): ?>
                                    <option value="<?= $currency["AD_Code"] ?>" >
                                        <?= $currency["AD_Desc"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Amount LCY:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly tabindex="9" name="GJD_AmountLCY" placeholder="Amount LCY">
                        </div>
                    </div>
                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">CPC:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="GJD_CPC" placeholder="CPC" tabindex="10" > 
                                <option value="" disabled selected></option>                              
                                <?php if (count($locations) > 1): ?>
                                    <option value="" disabled selected>Location</option>
                                    <?php foreach ($locations AS $location): ?>                                                                
                                        <option value="<?= $location["SP_StoreID"] ?>">
                                            <?= $location["SP_StoreName"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <input type="text" class="form-control" id="" readonly value="<?= $locations[0]['SP_StoreID'] ?>" tabindex="11" name="GJD_CPC" placeholder="Location">
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Comment:</label>
                        <div class="col-xs-7">
                            <textarea class="form-control" name="GJD_Comment" placeholder="Comment" tabindex="11" ></textarea>                            
                        </div>
                    </div>
                </span>

                <input type="hidden" class="form-control" readonly tabindex="1" name="GJD_BalAccountType" >
                <input type="hidden" class="form-control" readonly tabindex="1" name="GJD_BalAccountNo" >
                <input type="hidden" class="form-control" readonly tabindex="1" name="GJD_BalAccountName" >

            </form>
            <div id="error-message-container" class="alert alert-danger" role="alert" style="display: none;">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <span id="error-message"></span>
            </div>
            <hr>
            <div class="btn-cont">
                <a id="save-new" type="button" href="#" class="btn btn-default form-btn main-clr">
                    Save & New
                </a>
                <a id="save-close" type="button" href="#" class="btn btn-default form-btn main-clr">
                    Save & Close
                </a>
                <a type="button" href="<?= $back_url ?>" class="btn btn-default form-btn sub-clr">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>js/module_detail_processor.js"></script>

<script type="text/javascript">

    $(function () {

        var locations = <?= json_encode($locations) ?>;
        var currencies = <?= json_encode($currencies["data"]) ?>;
        var currentlyAvailableAccounts = [];
        var $accountType;
        var $accountName;

        $(document).ready(function () {
            initializeUI();
            initializeEvents();

            var moduleDetailProcessor = new ModuleDetailProcessor('<?= $document_header_id ?>', {
                redirectTo: "edit"
            });
            moduleDetailProcessor.initialize();

        });

        function initializeUI() {
            $accountType = $('select[name=GJD_AccountType]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    loadAccounts(value);
                }
            });

            $accountName = $('select[name=GJD_AccountName]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in currentlyAvailableAccounts) {
                        if (currentlyAvailableAccounts[i]['AccountName'] == value) {
                            $('input[name=GJD_AccountNo]').val(currentlyAvailableAccounts[i]['AccountNo']);
                        }
                    }
                }
            });

            $('select[name=GJD_CPC]').selectize({
                sortField: 'text',
                onChange: function () {
                    computeAmountInLocalCurrency();
                }
            });

            $('select[name=GJD_CY]').selectize({
                sortField: 'text',
                onChange: function () {
                    computeAmountInLocalCurrency();
                }
            });

        }

        function initializeEvents() {
            $('input[name=GJD_Amount]').on('change', function () {
                computeAmountInLocalCurrency();
            });

            $('input[name=GJD_Debit]').on('change', function (e) {
                computeAmount();
                e.preventDefault(); //  avoid change loops
            });

            $('input[name=GJD_Credit]').on('change', function (e) {
                computeAmount();
                e.preventDefault(); //  avoid change loops
            });

            $('input[name=GJD_Amount]').on('change', function (e) {
                var amount = $(this).val();

                if (isNaN(amount)) {
                    $('input[name=GJD_Credit]').val('');
                    $('input[name=GJD_Debit]').val('');
                    return;
                }

                if (amount < 0) {
                    $('input[name=GJD_Credit]').val(amount * -1);
                    $('input[name=GJD_Debit]').val('');
                } else {
                    $('input[name=GJD_Credit]').val('');
                    $('input[name=GJD_Debit]').val(amount);
                }

                computeAmountInLocalCurrency();

                e.preventDefault(); //  avoid change loops
            });

        }

        function computeAmount() {
            var debit = $('input[name=GJD_Debit]').val();
            var credit = $('input[name=GJD_Credit]').val();

            if (!debit) {
                debit = 0;
            }

            if (!credit) {
                credit = 0;
            }

            var total = debit - credit;

            $('input[name=GJD_Amount]').val(total);

            if (total < 0) {
                $('input[name=GJD_Credit]').val(total * -1);
                $('input[name=GJD_Debit]').val('');
            } else {
                $('input[name=GJD_Credit]').val('');
                $('input[name=GJD_Debit]').val(total);
            }

            computeAmountInLocalCurrency();
        }

        function loadAccounts(accountType) {

            if (accountType == "G/L Account") {
                accountType = "GL Account";
            }

            var url = "<?= $module_url ?>/get_account_numbers/" + accountType;

            $.get(url, function (response) {
                enableAccountFields(true);
                setAvailableAccounts(response);
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

        function setAvailableAccounts(data) {
            currentlyAvailableAccounts = JSON.parse(data);

            var itemList = [];
            for (var i in currentlyAvailableAccounts) {
                itemList.push({
                    text: currentlyAvailableAccounts[i]['AccountName'],
                    value: currentlyAvailableAccounts[i]['AccountName']
                });
            }

            console.log(data);
            console.log(itemList);

            var accountName = $accountName[0].selectize;

            accountName.clear();
            accountName.clearOptions();
            accountName.load(function (callback) {
                callback(itemList);
            });

            //  reset the selected account no
            $('input[name=GJD_AccountNo]').val('');

        }

        function enableAccountFields(enable) {
            var accountType = $accountType[0].selectize;
            var accountNo = $accountName[0].selectize;

            if (enable) {
                accountType.enable();
                accountNo.enable();
            } else {
                accountType.disable();
                accountNo.disable();
            }

        }

        function computeAmountInLocalCurrency() {
            var currency = $('select[name=GJD_CY]').val();
            var location = $('select[name=GJD_CPC]').val();
            var amount = $('input[name=GJD_Amount]').val();

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
                var url = "<?= $module_url ?>/get_amount_lcy";
                var params = {
                    company_id: companyId,
                    convert_to_currency_id: currencyId,
                    amount: amount
                };

                console.log(params);

                $.post(url, params, function (response) {
                    console.log(response);
                    response = JSON.parse(response);

                    if (response.status == 0) {
                        alert(response.message);
                    } else {
                        $('input[name=GJD_AmountLCY]').val(response.amount);
                    }
                });

            } else {
                console.log("Company id and currency id needed to compute amount in lcy");
            }
        }

    })();

</script>