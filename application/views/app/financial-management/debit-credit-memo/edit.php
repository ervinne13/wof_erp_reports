<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
        </h3>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">
            <form id="<?= $this->uri->segment(3) ?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
                <!--Left Panel-->
                <span class="col-md-5">                    
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="1" name="DCM_DocNo" value="<?= $DCM_DocNo ?>">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Customer Name:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="DCM_CustomerName" tabindex="2" placeholder="Customer Name" > 
                                <option value="" disabled selected></option>                                
                                <?php foreach ($customers["data"] AS $customer): ?>
                                    <?php $selected = $DCM_CustomerName == $customer["C_Name"] ? "selected" : "" ?>
                                    <option value="<?= $customer["C_Name"] ?>" <?= $selected ?>>
                                        <?= $customer["C_Name"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Customer ID:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="3" name="DCM_CustomerID" value="<?= $DCM_CustomerID ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <textarea type="text" class="form-control" id="" tabindex="4" name="DCM_Remarks"><?= $DCM_Remarks ?></textarea>
                        </div>
                    </div>
                </span><!--/Left Panel-->
                <!--Right Panel-->
                <span class="col-md-5">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">                            
                            <input type="date" class="form-control datepicker" id="" tabindex="5" name="DCM_DocDate" value="<?= $DCM_DocDate ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for=""> Ref. Doc. No.:</label>
                        <div class="col-xs-7">                            
                            <input type="text" class="form-control" id="" tabindex="6" name="DCM_RefDocNo" value="<?= $DCM_RefDocNo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for=""> External Doc. No.: </label>
                        <div class="col-xs-7">                            
                            <input type="text" class="form-control" id="" tabindex="7" name="DCM_ExtDocNo" value="<?= $DCM_ExtDocNo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Status:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly="" class="form-control" id="" tabindex="8" name="DCM_Status" value="<?= $DCM_Status ?>">
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
                <a id="action-save" type="button" tabindex="9" href="#" class="btn btn-default form-btn main-clr">
                    Save
                </a>
                <a type="button" tabindex="10" href="<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>" class="btn btn-default form-btn sub-clr">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<script type = "text/javascript">

    //  locally save customer data to lessen ajax calls
    var customerData = <?= json_encode($customers["data"]) ?>;
    var moduleIndexURL = "<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>";

    $(function () {

        $(document).ready(function () {

            initializeUI();
            initializeEvents();
        });
        function initializeUI() {
            //  Modify customer name per change in customer id
            $('select[name=DCM_CustomerName]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in customerData) {
                        if (customerData[i]["C_Name"] == value) {
                            $('input[name=DCM_CustomerID]').val(customerData[i]["C_Id"]);
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

            var form = $('#' + _class + "-form");
            var data = form.serializeArray();
            var formData = new FormData();

            formData.append('type', 'update');
            $.each(data, function (key, input) {
                formData.append(input.name, input.value);
            });

            console.log(formData);

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