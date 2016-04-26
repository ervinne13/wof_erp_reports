
<?php
$module_url = base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3));
$back_url   = base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/view?id=" . $this->input->get('id'));

//  will be initialized when determining the options of the location
$selected_cpc = null;
?>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
        </h3>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">
            <form id="sales-invoice-detail-form" class="form-horizontal row page-form" role="form" class="container">
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Item Type:</label>
                        <div class="col-xs-7">                            
                            <select class="form-control select-cli" name="SID_ItemTypeID" placeholder="Item Type"> 
                                <option value="" disabled selected></option>
                                <?php foreach ($item_types AS $item_type): ?>                                                                
                                    <option value="<?= $item_type["IT_Id"] ?>" >
                                        <?= $item_type["IT_Id"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Item No.:</label>
                        <div class="col-xs-7">                            
                            <select class="form-control select-cli" name="SID_ItemNo" placeholder="Item No." >
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Item Description:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" name="SID_ItemDescription" placeholder="Item Description">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Location:</label>
                        <div class="col-xs-7">                            
                            <select class="form-control select-cli" name="SID_Location" placeholder="Location" > 
                                <?php if (count($locations) > 1): ?>
                                    <option value="" disabled selected>Location</option>
                                    <?php foreach ($locations AS $location): ?>
                                        <?php $selected_cpc = $SI_Location == $location["SP_StoreID"] ? $location["CPC_Id"] : $selected_cpc ?>
                                        <?php $selected     = $SI_Location == $location["SP_StoreID"] ? "selected" : "" ?>
                                        <option value="<?= $location["SP_StoreID"] ?>" <?= $selected ?>>
                                            <?= $location["SP_StoreName"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <input type="text" class="form-control" id="" readonly value="<?= $locations[0]['SP_StoreID'] ?>" name="CRJ_Location" placeholder="Location">
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="control-label col-xs-5" for="">Sub Location:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" name="SID_SubLocation" placeholder="Sub Location ">
                        </div>
                    </div> -->

                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Qty:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" name="SID_Qty" placeholder="Qty">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">UOM:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="SID_UOM" placeholder="UOM" > 
                                <option value="" disabled selected></option>                             
                            </select> 
                            <!--<input type="text" class="form-control" id="" name="SID_UOM" placeholder="UOM">-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Unit Price:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" name="SID_UnitPrice" placeholder="Unit Price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Amount:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" name="SID_Amount" placeholder="Amount" value="0">
                        </div>
                    </div>
                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">CPC:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="SID_CostCenter" placeholder="CPC"> 
                                <option value="" disabled selected></option>
                                <?php foreach ($cpc_list["data"] AS $cpc): ?>
                                    <?php $selected = $selected_cpc == $cpc["CPC_Id"] ? "selected" : ""; ?>
                                    <option value="<?= $cpc["CPC_Id"] ?>" <?= $selected ?>>
                                        <?= $cpc["CPC_Id"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Comment:</label>
                        <div class="col-xs-7">
                            <textarea type="text" class="form-control" id="" name="SID_Comment" placeholder="Comment"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">VAT Posting Group:</label>
                        <div class="col-xs-7">
                            <select class="form-control single-default" placeholder="VAT" id="" name="SID_VAT" tabindex="17">
                                <option value="" disabled selected>VAT Posting Group</option>
                                <?php
                                if (!empty($VAT)) {
                                    foreach ($VAT['data'] as $key => $value) {
                                        ?>
                                        <option value="<?= trim($value['VPPG_Code']) ?>" ><?= $value['VPPG_Code'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">WHT Posting Group:</label>
                        <div class="col-xs-7">
                            <select class="form-control single-default" placeholder="WHT" id="" name="SID_WHT" tabindex="18">
                                <option value="" disabled selected>WHT Posting Group</option>
                                <?php
                                if (!empty($WHT)) {
                                    foreach ($WHT['data'] as $key => $value) {
                                        ?>
                                        <option value="<?= trim($value['WPPG_Code']) ?>"  ><?= $value['WPPG_Code'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </span>

                <input type="hidden" class="form-control" readonly tabindex="1" name="SID_IPG">
            </form>
            <div id="error-message-container" class="alert alert-danger" role="alert" style="display: none;">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <span id="error-message"></span>
            </div>
            <hr>
            <div class="btn-cont">
                <a id="action-save-and-new" type="button" href="#" class="btn btn-default form-btn main-clr">
                    Save & New
                </a>
                <a id="action-save-and-close" type="button" href="#" class="btn btn-default form-btn main-clr">
                    Save & Close
                </a>
                <a type="button" href="<?= $back_url ?>" class="btn btn-default form-btn sub-clr">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    (function ($) {

        var salesInvoiceId = "<?= $this->input->get('id') ?>";
        var moduleIndexURL = "<?= $back_url ?>";
        var currentlyAvailableItems = [];
        var currentlyAvailableItemUOMs = [];
        var $item_no;
        var uom, $uom;
        var vat, $vat;
        var wht, $wht;

        $(document).ready(function () {

            initializeUI();
            initializeEvents();

        });

        function initializeUI() {
            //  Modify customer name per change in customer id
            $('select[name=SID_ItemTypeID]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    loadItems(value);
                }
            });

            $vat = $('select[name=SID_VAT]').selectize({
                sortField: 'text'
            });

            $wht = $('select[name=SID_WHT]').selectize({
                sortField: 'text'
            });

            $item_no = $('select[name=SID_ItemNo]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in currentlyAvailableItems) {
                        if (currentlyAvailableItems[i]['IM_Item_id'] == value) {
                            $('input[name=SID_ItemDescription]').val(currentlyAvailableItems[i]['IM_Sales_Desc']);
                            $('input[name=SID_IPG]').val(currentlyAvailableItems[i]['IM_INVPosting_Group']);

                            vat.setValue(currentlyAvailableItems[i]['IM_VATProductPostingGroup']);
                            wht.setValue(currentlyAvailableItems[i]['IM_WHTProductPostingGroup']);

                            loadUOM(value);
                        }
                    }
                }
            });

            $('select[name=SID_Location]').selectize({
                sortField: 'text'
            });

            $uom = $('select[name=SID_UOM]').selectize({
                sortField: 'text'
            });

            $cpc = $('select[name=SID_CostCenter]').selectize({
                sortField: 'text'
            });


            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            }).mask("9999-99-99");

            vat = $vat[0].selectize;
            wht = $wht[0].selectize;

            uom = $uom[0].selectize;
        }

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

            $('input[name=SID_Qty]').change(function () {
                computeAmount();
            });

            $('input[name=SID_UnitPrice]').change(function () {
                computeAmount();
            });

        }

        function computeAmount() {

            var quantity = parseFloat($('input[name=SID_Qty]').val());
            var unitPrice = parseFloat($('input[name=SID_UnitPrice]').val());

            if (quantity && unitPrice) {
                $('input[name=SID_Amount]').val(quantity * unitPrice);
            } else {
                $('input[name=SID_Amount]').val(0);
            }

        }

        function loadUOM(itemNo) {

            var url = "<?= $module_url ?>/uom/" + itemNo;

            $.get(url, function (response) {
                currentlyAvailableItemUOMs = JSON.parse(response);

                var UOMList = [];
                for (var i in currentlyAvailableItemUOMs) {
                    UOMList.push({
                        text: currentlyAvailableItemUOMs[i]['AD_Desc'],
                        value: currentlyAvailableItemUOMs[i]['IUC_FK_UOM_id']
                    });
                }

                uom.clear();
                uom.clearOptions();
                uom.load(function (callback) {
                    callback(UOMList);
                });

                console.log(UOMList);

                //  default value
                for (var i in currentlyAvailableItems) {
                    if (currentlyAvailableItems[i]['IM_Item_id'] == itemNo) {
                        uom.setValue(currentlyAvailableItems[i]['IM_FK_Attribute_UOM_id']);
                    }
                }

                uom.enable();

            });
            uom.disable();

        }

        function loadItems(itemType) {

            var url = "<?= $module_url ?>/items/" + itemType;

            $.get(url, function (response) {
                currentlyAvailableItems = JSON.parse(response);
                currentlyAvailableItems = currentlyAvailableItems['data'];

                var itemList = [];
                for (var i in currentlyAvailableItems) {
                    itemList.push({
                        text: currentlyAvailableItems[i]['IM_Item_id'],
                        value: currentlyAvailableItems[i]['IM_Item_id']
                    });
                }

                var item_no = $item_no[0].selectize;

                item_no.clear();
                item_no.clearOptions();
                item_no.load(function (callback) {
                    callback(itemList);
                });

                enableItemTypeRelatedFields(true);
            });

            enableItemTypeRelatedFields(false);
        }

        function enableItemTypeRelatedFields(enable) {
            var item_no = $item_no[0].selectize;
            if (enable) {
                $('input[name=SID_ItemDescription]').removeAttr('disabled');
                item_no.enable();
            } else {
                $('input[name=SID_ItemDescription]').attr('disabled', 'disabled');
                item_no.disable();
            }
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

            var form = $('#sales-invoice-detail-form');
            var data = form.serializeArray();
            var formData = new FormData();

            formData.append('type', 'add-details');
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


    })(jQuery);
</script>