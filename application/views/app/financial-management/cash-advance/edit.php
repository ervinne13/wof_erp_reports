<?php
$doc_date   = date_create($CA_DocDate);
$CA_DocDate = date_format($doc_date, "m/d/Y");

if ($CA_DateFrom) {
    $date_from   = date_create($CA_DateFrom);
    $CA_DateFrom = date_format($date_from, "m/d/Y");
}

if ($CA_DateTo) {
    $date_to   = date_create($CA_DateTo);
    $CA_DateTo = date_format($date_to, "m/d/Y");
}
?>

<!--<style>
    .handsontable thead th {
        padding: 2px 2px;
    }
</style>-->

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
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
                            <select class="form-control select-cli" tabindex="3" name="CA_Purpose" placeholder="Purpose">                                
                                <option value="" disabled selected></option>
                                <?php foreach ($purposes AS $purpose): ?>
                                    <?php $selected = $purpose["R_Id"] == $CA_Purpose ? "selected" : "" ?>
                                    <option value="<?= $purpose["R_Id"] ?>" <?= $selected ?>>
                                        <?= $purpose["R_Description"] ?>
                                    </option>                                    
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" tabindex="4" name="CA_Remarks" placeholder="Remarks" value="<?= $CA_Remarks ?>">
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
                            <input type="text" class="form-control datepicker" tabindex="6" name="CA_DateFrom" placeholder="From" value="<?= $CA_DateFrom ?>">                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5"></label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control datepicker" tabindex="7" name="CA_DateTo" placeholder="To" value="<?= $CA_DateTo ?>">
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
                        <label class="control-label col-xs-5" for="">Company:</label>
                        <div class="col-xs-7">
                            <select class="form-control single-default" placeholder="Company" id="" name="CA_Company" tabindex="14">
                                <option value="" disabled selected></option>
                                <?php
                                if (!empty($Com)) {
                                    foreach ($Com['data'] as $key => $value) {
                                        ?>
                                        <option value="<?=$value['COM_Id']?>" <?= trim($CA_Company)==trim($value['COM_Id'])?'selected':'' ?> ><?=$value['COM_Name']?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>           
                   <!--  <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Company:</label>
                        <div class="col-xs-7">
                            <input type="text" name="CA_Company" tabindex="11" class="form-control" placeholder="Company" value="<?= $CA_Company ?>">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Location:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="CA_Location" tabindex="12" placeholder="Location">
                                <?php if (count($locations) > 1): ?>
                                    <option value="" disabled selected>Location</option>
                                    <?php foreach ($locations AS $location): ?>
                                        <?php $selected = $location["SP_StoreID"] == $CA_Location ? "selected" : "" ?>
                                        <option value="<?= $location["SP_StoreID"] ?>" <?= $selected ?>>
                                            <?= $location["SP_StoreName"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <input type="text" class="form-control" id="" readonly value="<?= $locations[0]['SP_StoreID'] ?>" name="CA_Location" placeholder="Location">
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </span>
            </form>
            <hr>
            <div id="tbl-details" class="grid-table">

            </div>
            <hr>
            <div class="btn-cont">
                <a id="action-update-close" type="button" href="#" class="btn btn-default form-btn main-clr">
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

    (function () {

        var previousRowTotal = 0;
        var locationsData = <?= json_encode($locations) ?>;
        var tableData = <?= json_encode($details['data']) ?>;

        var com,$com;

        $(document).ready(function () {

            initializeUI();
            var detailTable = initializeDetailTable();

            var moduleProcessor = new ModuleProcessor({
                isTransactionModule: true,
                detailTable: detailTable
            });

            moduleProcessor.save = function (additionalFormData, onFinishCallback) {


                var form = $(this.form);
                var data = form.serializeArray();
                var formData = new FormData();

                var amount = parseFloat($('input[name=CA_Amount]').val()) || 0;
                if(amount <= 1500){
                        alert('Cannot process amount below 1500!');
                        moduleProcessor.enableActionButtons(true);
                        return false
                }
                    
                for (var key in additionalFormData) {
                    formData.append(key, additionalFormData[key]);
                }

                $('.attachment').each(function () {
                    if ($(this)[0].files.length > 0) {
                        formData.append('file[]', $(this)[0].files[0]);
                    }
                });

                $(form).find('input[type=checkbox]').each(function () {
                    data.push({name: this.name, value: this.checked ? 1 : 0});
                });

                if (this.detailTable) {
                    data.push({
                        name: "details",
                        value: JSON.stringify(this.detailTable.getSourceData())
                    });
                }

                $.each(data, function (key, input) {
                    formData.append(input.name, input.value);
                });

                console.log("ModuleProcessor", formData);

                //  context reference
                var _this = this;

                $.ajax({
                    url: _this.processURL,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log(data);
                        if (data.result == 0) {
                            if (data.errors) {
                                error_message(data.errors);
                            }

                            if (_this.detailTable && data.batch_save_errors) {
                                _this.showBatchSaveErrors(data.batch_save_errors);
                            }
                        } else {
                            if (onFinishCallback) {
                                onFinishCallback(data);
                            }
                        }
                        _this.enableActionButtons(true);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);

                        if (jqXHR.responseText) {
                            _this.showError(true, jqXHR.responseText);
                        } else {
                            alert('Error!');
                        }

                        _this.enableActionButtons(true);
                    }
                });

                this.enableActionButtons(false);
                this.showError(false);

        };


            moduleProcessor.initialize();

        });

        function initializeUI() {

            $('select[name=CA_Location]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in locationsData) {
                        if (locationsData[i]["SP_StoreID"] == value) {
                            var companyName = locationsData[i]["COM_Name"];
                            com.setValue(companyName);
                        }
                    }
                }
            });

            $('select[name=CA_Purpose]').selectize({
                sortField: 'text',
            });


            $com = $('select[name=CA_Company]').selectize({
                        sortField: 'text',
                        create: false,
                    });

             com = $com[0].selectize;

        }

        function initializeDetailTable() {
            return $('#tbl-details').gridEntry({
                tableData: tableData,
                gridConfig: {
                    minSpareRows: 1,
                    colHeaders: [
                        "Particulars",
                        "Qty / No. of Days",
                        "Amount per Qty / per Day",
                        "Total"
                    ],
                    columns: [
                        {
                            data: "CAD_Particular",
                            renderer: emptyRenderer
                        },
                        {
                            data: "CAD_Qty",
                            type: 'numeric',
                            format: '0,0',
                            validator: requiredValidator,
                            strict: true,
                            allowInvalid: false,
                            // renderer: emptyRenderer
                        },
                        {
                            data: "CAD_Amount",
                            type: 'numeric',
                            format: '0,0.00',
                            validator: requiredValidator,
                            strict: true,
                            allowInvalid: false,
                            // renderer: emptyRenderer
                        }, {
                            data: "CAD_Total",
                            type: 'numeric',
                            format: '0,0.00',
                            validator: requiredValidator,
                            strict: true,
                            className: "htRight",
                            readonly: true,
                            allowInvalid: false,
                            renderer: renderTotal
                        }
                    ],
                    beforeChange: function (change, source) {
                        if (change !== null || source != 'loadData') {
                            if ($.inArray(change[0][1], ['CAD_Qty', 'CAD_Amount']) != -1) {
                                var qty = this.getDataAtRowProp(change[0][0], 'CAD_Qty') || 0;
                                var amount = this.getDataAtRowProp(change[0][0], 'CAD_Amount') || 0;
                                previousRowTotal = qty * amount;
                            }
                        }
                    },
                    afterChange: function (change, source) {
                        if (change !== null || source != 'loadData') {
                            if ($.inArray(change[0][1], ['CAD_Qty', 'CAD_Amount']) != -1) {

                                var qty = this.getDataAtRowProp(change[0][0], 'CAD_Qty') || 0;
                                var amount = this.getDataAtRowProp(change[0][0], 'CAD_Amount') || 0;
                                var total = qty * amount;

                                var caAmount = $('input[name=CA_Amount]').val();
                                if (!caAmount) {
                                    caAmount = 0;
                                }

//                                var previousTotal = this.getDataAtRowProp(change[0][0], 'CAD_Qty');
//
                                if (caAmount > 0) {
                                    caAmount -= previousRowTotal;
                                }

                                this.setDataAtRowProp(change[0][0], 'CAD_Total', total);
                                $('input[name=CA_Amount]').val(parseInt(caAmount) + total);

                            }
                        }

                    }
                }
            });
        }

    })();

</script>