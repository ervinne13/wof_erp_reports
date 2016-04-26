
<?php
$module_url = base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3));
$back_url   = base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/view?id=" . md5($DCMD_FK_DocNo));
?>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
        </h3>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">
            <form id="debit-credit-memo-detail-form" class="form-horizontal row page-form" role="form" class="container">
                <span class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">DCM Type:</label>
                        <div class="col-xs-7">                            
                            <select class="form-control select-cli" name="DCMD_DCMType" placeholder="DCM Type" > 
                                <option value="" disabled selected></option>
                                <option value="Shortage" <?= $DCMD_DCMType == "Shortage" ? "selected" : "" ?>>
                                    Shortage
                                </option>
                                <option value="Overage"  <?= $DCMD_DCMType == "Overage" ? "selected" : "" ?>>
                                    Overage
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Description:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" tabindex="1" name="DCMD_Description" value="<?= $DCMD_Description ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Location:</label>
                        <div class="col-xs-7">                            
                            <select class="form-control select-cli" name="DCMD_Location" placeholder="Location" > 
                                <?php if (count($locations) > 1): ?>
                                    <option value="" disabled selected>Location</option>
                                    <?php foreach ($locations AS $location): ?>
                                        <?php $selected = $DCMD_Location == $location["SP_StoreID"] ? "selected" : ""; ?>
                                        <option value="<?= $location["SP_StoreID"] ?>" <?= $selected ?>>
                                            <?= $location["SP_StoreName"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <input type="text" class="form-control" id="" readonly value="<?= $locations[0]['SP_StoreID'] ?>" tabindex="1" name="DCMD_Description" placeholder="Location">
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Amount:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" tabindex="1" name="DCMD_Amount" value="<?= $DCMD_Amount ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">CPC:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="DCMD_CPC"> 
                                <option value="" disabled selected></option>
                                <?php foreach ($cpc_list["data"] AS $cpc): ?>
                                    <?php $selected = $DCMD_CPC == $cpc["CPC_Id"] ? "selected" : ""; ?>
                                    <option value="<?= $cpc["CPC_Id"] ?>" <?= $selected ?> >
                                        <?= $cpc["CPC_Id"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Comment:</label>
                        <div class="col-xs-7">
                            <textarea type="text" class="form-control" id="" tabindex="1" name="DCMD_Comment" placeholder="Comment"><?= $DCMD_Comment ?></textarea>
                        </div>
                    </div>                                       
                </span>
                <span class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Applies-to Doc Type:</label>
                        <div class="col-xs-7">                            
                            <select class="form-control select-cli" name="DCMD_AppliesToDocType" placeholder="Applies-to Doc Type" > 
                                <option value="" disabled selected></option>
                                <option value="Invoice" <?= $DCMD_AppliesToDocType == "Invoice" ? "selected" : "" ?>>
                                    Invoice
                                </option>
                                <option value="General Journal" <?= $DCMD_AppliesToDocType == "General Journal" ? "selected" : "" ?>>
                                    General Journal
                                </option>
                                <option value="Debit / Credit Memo" <?= $DCMD_AppliesToDocType == "Debit / Credit Memo" ? "selected" : "" ?>>
                                    Credit Memo
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Applies-to Doc No.:</label>
                        <div class="col-xs-7">                            
                            <select class="form-control select-cli" name="DCMD_AppliesToDocNo" placeholder="Applies-to Doc No." > 
                                <option value="" disabled selected></option>                                
                                <?php foreach ($applies_to_docs["data"] AS $document): ?>
                                    <?php $selected = $DCMD_AppliesToDocNo == $document["CL_DocNo"] ? "selected" : ""; ?>
                                    <option value="<?= $document["CL_DocNo"] ?>" <?= $selected ?> >
                                        <?= $document["CL_DocNo"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </span>
            </form>
            <div id="error-message-container" class="alert alert-danger" role="alert" style="display: none;">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <span id="error-message"></span>
            </div>
            <hr>
            <div class="btn-cont">
                <a id="action-save" type = "button"  tabindex="9"  href = "#" class = "btn btn-default form-btn main-clr action-button">
                    Save
                </a>
                <a type="button" href = "<?= $back_url ?>"  tabindex="10"  class = "btn btn-default form-btn sub-clr action-button">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(function () {

        var salesInvoiceId = "<?= $this->input->get('id') ?>";
        var moduleIndexURL = "<?= $back_url ?>";
        var availableLocations = <?= json_encode($locations) ?>;
        var $cpc;
        var $appliesToDocNo;

        $(document).ready(function () {

            initializeUI();
            initializeEvents();

        });

        function initializeUI() {

            $('select[name=DCMD_DCMType]').selectize({
                sortField: 'text'
            });

            $('select[name=DCMD_AppliesToDocType]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    loadAppliesToDocNoOptions(value);
                }
            });

            $appliesToDocNo = $('select[name=DCMD_AppliesToDocNo]').selectize({
                sortField: 'text'
            });

            $cpc = $('select[name=DCMD_CPC]').selectize({
                sortField: 'text'
            });

            $('select[name=DCMD_Location]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in availableLocations) {
                        if (availableLocations[i]["SP_StoreID"] == value) {
                            loadLocationCPC(availableLocations[i]["CA_FK_Location_id"]);
                        }
                    }
                }
            });

            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            }).mask("9999-99-99");

        }

        function initializeEvents() {
            $('#action-save').click(function () {
                confirm("Save Entry?", function (confirmed) {
                    if (confirmed) {
                        enableActionButtons(false);
                        save(function () {
                            location.href = moduleIndexURL;
                        });
                    }
                });
            });

            var loadRemainingAmountFieldTimeout;
            var oldAppliedAmount;

            $('input[name=CRJD_AppliedAmount]').keyup(function () {

                if (oldAppliedAmount != $('input[name=CRJD_AppliedAmount]').val()) {
                    clearTimeout(loadRemainingAmountFieldTimeout);
                    loadRemainingAmountFieldTimeout = setTimeout(function () {
                        console.log('executed');
                        loadRemainingAmountField(function () {
                            enableActionButtons(true);
                            oldAppliedAmount = $('input[name=CRJD_AppliedAmount]').val();
                        });
                    }, 1000);
                    enableActionButtons(false);
                }
            });
        }

        function loadLocationCPC(locationId) {
            var url = "<?= $module_url ?>/location_cpc/" + locationId;

            $.get(url, function (response) {
                var cpcRow = JSON.parse(response);

                if (cpcRow && cpcRow.LOC_FK_CPC_id) {
                    var cpc = $cpc[0].selectize;
                    cpc.setValue(cpcRow.LOC_FK_CPC_id);
                }

            });

        }

        function loadAppliesToDocNoOptions(documentType) {

            var url = "<?= $module_url ?>/available_documents/" + documentType;

            $.get(url, function (response) {
                var appliesToDocNo = $appliesToDocNo[0].selectize;
                appliesToDocNo.enable();

                var availableDocuments = JSON.parse(response);

                if (availableDocuments && availableDocuments.result == 1) {

                    var itemList = [];
                    for (var i in availableDocuments.data) {
                        itemList.push({
                            text: availableDocuments.data[i]['CL_DocNo'],
                            value: availableDocuments.data[i]['CL_DocNo']
                        });
                    }
                    
                    appliesToDocNo.clear();
                    appliesToDocNo.clearOptions();
                    appliesToDocNo.load(function (callback) {
                        callback(itemList);
                    });

                    if (itemList.length == 1) {
                        appliesToDocNo.setValue(availableDocuments.data[0]['CL_DocNo']);
                    }

                } else {
                    console.error(response);
                }

            });

            var appliesToDocNo = $appliesToDocNo[0].selectize;
            appliesToDocNo.disable();

        }

        function enableActionButtons(enable) {
            if (enable) {
                $('.action-button').removeAttr('disabled');
            } else {
                $('.action-button').attr('disabled', 'disabled');
            }
        }

        function showError(show, message) {
            if (show) {
                $('#error-message-container').css("display", "block");
                $('#error-message').html(message);
            } else {
                $('#error-message-container').css("display", "none");
                $('#error-message').html("");
            }
        }

        function save(onSaveCallback) {

            var form = $('#debit-credit-memo-detail-form');
            var data = form.serializeArray();
            var formData = new FormData();

            formData.append('type', 'update-details');
            formData.append('id', salesInvoiceId);
            $.each(data, function (key, input) {
                formData.append(input.name, input.value);
            });

            $.ajax({
                url: base_url + 'app/' + _module + "/" + _class + '/process',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    if (data.result == 0) {
                        error_message(data.errors);
                    } else {
                        if (onSaveCallback) {
                            onSaveCallback(data);
                        }
                    }
                    enableActionButtons(true);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);

                    if (jqXHR.responseText) {
                        showError(true, jqXHR.responseText);
                    } else {
                        alert('Error! ');
                    }

                    enableActionButtons(true);
                }
            });

            showError(false);

        }

    })();

</script>