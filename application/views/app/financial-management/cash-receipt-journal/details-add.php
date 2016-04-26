
<?php
$back_url = base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/view?id=" . $this->input->get('id'));
?>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
        </h3>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">
            <form id="cash-receipt-journal-detail-form" class="form-horizontal row page-form" role="form" class="container-fluid">

                <input type="hidden" class="form-control" readonly id="" tabindex="1" name="CRJD_PFK_DocNo" placeholder="Applies-to Doc No." value="<?= $CRJD_PFK_DocNo ?>">

                <!--Left Panel-->
                <span class="col-md-5">                    
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Applies-to Doc Type:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="1" name="CRJD_AppliesToDocType" placeholder="Applies-to Doc Type." value="<?= $CRJD_AppliesToDocType ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Applies-to Doc No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="2" name="CRJD_AppliesToDocNo" placeholder="Applies-to Doc No." value="<?= $CRJD_AppliesToDocNo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Applies-to Doc Date:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="3" name="CRJD_AppliesToDocDate" placeholder="Applies-to Doc Date" value="<?= $CRJD_AppliesToDocDate ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5"> Applies-to Amount (Balance):</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="4" name="CRJD_AppliesToAmount" placeholder=" Applies-to Amount (Balance)" value="<?= $CRJD_AppliesToAmount ?>">
                        </div>
                    </div>
                </span><!--/Left Panel-->
                <!--Right Panel-->
                <span class="col-md-5">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Applied Amount:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" tabindex="5" name="CRJD_AppliedAmount" placeholder=" Applied Amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Rem. Amount:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly tabindex="6" name="CRJD_RemAmount" placeholder=" Rem. Amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Comment:</label>
                        <div class="col-xs-7">
                            <textarea type="text" class="form-control" id="" tabindex="7" name="CRJD_Comment" placeholder="Comment"></textarea>
                        </div>
                    </div>
                </span><!--/Right Panel-->
            </form>

            <div id="error-message-container" class="alert alert-danger" role="alert" style="display: none;">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <span id="error-message"></span>
            </div>

            <hr>
            <div class="btn-cont">
                <a id="save-new" type="button"  tabindex="8"  href="#" class="btn btn-default form-btn main-clr action-button">
                    Save & New
                </a>
                <a id="action-save-and-close"  tabindex="9"  type = "button" href = "#" class = "btn btn-default form-btn main-clr action-button">
                    Save & Close
                </a>
                <a type="button"  tabindex="10"  href = "<?= $back_url ?>" class = "btn btn-default form-btn sub-clr ">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(function () {

        var moduleIndexURL = "<?= $back_url ?>";

        $(document).ready(function () {

            initializeEvents();

        });

        function initializeEvents() {
            $('#action-save-and-new').click(function () {
                confirm("Save Entry?", function (confirmed) {
                    if (confirmed) {
                        enableActionButtons(false);
                        save(function () {
                            location.reload();
                        });
                    }
                });
            });

            $('#action-save-and-close').click(function () {
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

        function loadRemainingAmountField(onDoneCallback) {

            var url = "<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/remaining_amount") ?>";
            var params = {
                header_doc_no: '<?= $CRJD_PFK_DocNo ?>',
                detail_entry_no: null,
                applied_amount: $('input[name=CRJD_AppliedAmount]').val(),
                applies_to_doc_no: $('input[name=CRJD_AppliesToDocNo]').val()
            };

            $.post(url, params).done(function (response) {
                console.log(response);
                var response = JSON.parse(response);
                $('input[name=CRJD_RemAmount]').val(response.result);
            }).fail(function (response) {
                enableActionButtons(true);
                console.error(response);
            }).always(function () {
                if (onDoneCallback) {
                    onDoneCallback();
                }
            });

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

            var form = $('#cash-receipt-journal-detail-form');
            var data = form.serializeArray();
            var formData = new FormData();

            formData.append('type', 'add-details');
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