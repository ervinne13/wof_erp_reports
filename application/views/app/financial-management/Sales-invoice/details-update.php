
<?php
$module_url = base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3));
$back_url   = base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/view?id=" . md5($SID_PFK_DocNo));
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
                            <select class="form-control select-cli" name="SID_ItemTypeID" placeholder="Item Type" > 
                                <option value="" disabled selected></option>
                                <?php foreach ($item_types AS $item_type): ?>
                                    <?php $selected = $SID_ItemTypeID == $item_type["IT_Id"] ? "selected" : ""; ?>
                                    <option value="<?= $item_type["IT_Id"] ?>" <?= $selected ?>>
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
                                <option value="" disabled selected></option>
                                <?php foreach ($items["data"] AS $item): ?>
                                    <?php $selected = $SID_ItemNo == $item["IM_Item_id"] ? "selected" : ""; ?>
                                    <option value="<?= $item["IM_Item_id"] ?>" <?= $selected ?>>
                                        <?= $item["IM_Item_id"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Item Description:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" value="<?= $SID_ItemDescription ?>" tabindex="1" name="SID_ItemDescription" placeholder="Item Description">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Location:</label>
                        <div class="col-xs-7">                            
                            <select class="form-control select-cli" name="SID_Location" placeholder="Location" > 
                                <?php if (count($locations) > 1): ?>
                                    <option value="" disabled selected>Location</option>                                    
                                    <?php foreach ($locations AS $location): ?>
                                        <?php $selected = $SID_Location == $location["SP_StoreID"] ? "selected" : ""; ?>
                                        <option value="<?= $location["SP_StoreID"] ?>" <?= $selected ?>>
                                            <?= $location["SP_StoreName"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <input type="text" class="form-control" id="" readonly value="<?= $locations[0]['SP_StoreID'] ?>" tabindex="1" name="CRJ_Location" placeholder="Location">
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="control-label col-xs-5" for="">Sub Location:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" value="<?= $SID_SubLocation ?>" tabindex="1" name="SID_SubLocation" placeholder="Sub Location ">
                        </div>
                    </div> -->

                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Qty:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" value="<?= $SID_Qty ?>" tabindex="1" name="SID_Qty" placeholder="Qty">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">UOM:</label>
                        <div class="col-xs-7">                            
                            <select class="form-control select-cli" name="SID_UOM" placeholder="UOM" > 
                                <option value="" disabled selected></option>
                                <?php foreach ($uom AS $uom_item): ?>
                                    <?php $selected = $SID_UOM == $uom_item["IUC_FK_UOM_id"] ? "selected" : ""; ?>
                                    <option value="<?= $uom_item["IUC_FK_UOM_id"] ?>" <?= $selected ?>>
                                        <?= $uom_item["AD_Desc"] ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Unit Price:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" value="<?= $SID_UnitPrice ?>" tabindex="1" name="SID_UnitPrice" placeholder="Unit Price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Amount:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly value="<?= $SID_Amount ?>" tabindex="1" name="SID_Amount" placeholder="Amount" value="0">
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
                                    <?php $selected = $SID_CostCenter == $cpc["CPC_Id"] ? "selected" : ""; ?>
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
                            <textarea type="text" class="form-control" value="<?= $SID_Comment ?>" tabindex="1" name="SID_Comment" placeholder="Comment"><?= $SID_Comment ?></textarea>
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
                                        <option value="<?= trim($value['VPPG_Code']) ?>" <?= $value['VPPG_Code'] == $SID_VAT ? 'selected' : '' ?>><?= $value['VPPG_Code'] ?></option>
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
                                        <option value="<?= trim($value['WPPG_Code']) ?>" <?= $value['WPPG_Code'] == $SID_WHT ? 'selected' : '' ?> ><?= $value['WPPG_Code'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" readonly tabindex="1" name="SID_BaseUOM" value="<?= $SID_BaseUOM ?>">
                    <input type="hidden" class="form-control" readonly tabindex="1" name="SID_IPG" value="<?= $SID_IPG ?>">
                </span>
            </form>
            <div id="error-message-container" class="alert alert-danger" role="alert" style="display: none;">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <span id="error-message"></span>
            </div>
            <hr>
            <div class="btn-cont">
                <a id="action-save" type="button" href="#" class="btn btn-default form-btn main-clr">
                    Save
                </a>
                <a type="button" href="<?= $back_url ?>" class="btn btn-default form-btn sub-clr">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    (function ($) {

        var salesInvoiceItemId = "<?= $this->input->get('id') ?>";
        var moduleIndexURL = "<?= $back_url ?>";
        var currentlyAvailableItems = <?= json_encode($items["data"]) ?>;
        var currentlyAvailableItemUOMs = <?= json_encode($uom); ?>;
        var $item_no;
        var $uom;
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
                sortField: 'text',
            });
            $wht = $('select[name=SID_WHT]').selectize({
                sortField: 'text',
            });

            $item_no = $('select[name=SID_ItemNo]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in currentlyAvailableItems) {
                        if (currentlyAvailableItems[i]['IM_Item_id'] == value) {
                            $('input[name=SID_ItemDescription]').val(currentlyAvailableItems[i]['IM_Sales_Desc']);
                            vat.setValue(currentlyAvailableItems[i]['IM_VATProductPostingGroup']);
                            wht.setValue(currentlyAvailableItems[i]['IM_WHTProductPostingGroup']);
                            $('input[name=SID_BaseUOM]').val(currentlyAvailableItems[i]['IM_FK_Attribute_UOM_id']);
                            $('input[name=SID_IPG]').val(currentlyAvailableItems[i]['IM_INVPosting_Group']);

                            displayAvailableUOM(currentlyAvailableItems[i]['IM_Item_id'], currentlyAvailableItems[i]['IM_FK_Attribute_UOM_id']);
                        }
                    }
                }
            });

            $uom = $('select[name=SID_UOM]').selectize({
                sortField: 'text'
            });


            $('select[name=SID_Location]').selectize({
                sortField: 'text'
            });

            $('select[name=SID_CostCenter]').selectize({
                sortField: 'text'
            });

            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            }).mask("9999-99-99");

            vat = $vat[0].selectize;
            wht = $wht[0].selectize;

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

        function displayAvailableUOM(selectedItem, selectedUOM) {

            var url = "<?= $module_url ?>/UOM/" + selectedItem;

            $.get(url, function (response) {
                currentlyAvailableItemUOMs = JSON.parse(response);
                var itemList = [];
                for (var i in currentlyAvailableItemUOMs) {
                    itemList.push({
                        text: currentlyAvailableItemUOMs[i]['AD_Desc'],
                        value: currentlyAvailableItemUOMs[i]['IUC_FK_UOM_id']
                    });
                }

                var uom = $uom[0].selectize;

                uom.clear();
                uom.clearOptions();
                uom.load(function (callback) {
                    callback(itemList);
                });


                //  default value
                for (var i in currentlyAvailableItems) {
                    if (currentlyAvailableItems[i]['IM_Item_id'] == selectedItem) {
                        uom.setValue(currentlyAvailableItems[i]['IM_FK_Attribute_UOM_id']);
                    }
                }

                if (selectedUOM) {
                    uom.setValue(selectedUOM);
                }

                enableItemRelatedFields(true);

            });

            enableItemRelatedFields(false);

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

        function enableItemRelatedFields(enable) {
            var uom = $uom[0].selectize;
            if (enable) {
                uom.enable();
            } else {
                uom.disable();
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

            formData.append('type', 'update-details');
            formData.append('id', salesInvoiceItemId);
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