
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
                <span class="col-md-4">                    
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="1" name="SI_DocNo" value="<?= $SI_DocNo ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Customer Name:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="SI_CustomerName" placeholder="Customer Name" tabindex="2"> 
                                <option value="" disabled selected>Customer Name</option>                                
                                <?php foreach ($customers["data"] AS $customer): ?>
                                    <?php $selected = $SI_CustomerName == $customer["C_Name"] ? "selected" : "" ?>
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
                            <input type="text" class="form-control" readonly id="" tabindex="3" name="SI_CustomerID" value="<?= $SI_CustomerID ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Customer Address:</label>
                        <div class="col-xs-7">
                            <textarea type="text" class="form-control" readonly id="" tabindex="4" name="SI_CustomerAddress" placeholder="Customer Address"><?= $SI_CustomerAddress ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <textarea type="text" class="form-control" id="" tabindex="5" name="SI_Remarks" placeholder="Remarks"><?= $SI_Remarks ?></textarea>
                        </div>
                    </div>
                </span><!--/Column 1-->

                <!--Column 2-->
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                            <input type="date" class="form-control datepicker" id="" tabindex="6" name="SI_DocDate" value="<?= $SI_DocDate ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">External Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" tabindex="7" name="SI_ExtDocNo" placeholder="External Doc. No.:" value="<?= $SI_ExtDocNo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Payment Terms:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="SI_PayTermsID" placeholder="Payment Terms:" tabindex="8"> 
                                <option value="" disabled selected>Customer Id</option>
                                <?php foreach ($payment_terms["data"] AS $payment_term): ?>
                                    <?php $selected = $SI_PayTermsID == $payment_term["PT_Id"] ? "selected" : "" ?>
                                    <option value="<?= $payment_term["PT_Id"] ?>" <?= $selected ?>>
                                        <?= $payment_term["PT_Id"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Due Date:</label>
                        <div class="col-xs-7">
                            <input type="date" class="form-control" readonly id="" tabindex="9" name="SI_DueDate" value="<?= $SI_DueDate ?>">
                        </div>
                    </div>
                </span><!--/Column 2-->

                <!--Column 3-->
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Company:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="10" name="SI_Company" value="<?= $SI_Company ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Location:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="SI_Location" placeholder="Location" tabindex="11"> 
                                <?php if (count($locations) > 1): ?>
                                    <option value="" disabled selected>Location</option>
                                    <?php foreach ($locations AS $location): ?>
                                        <?php $selected = $SI_Location == $location["SP_StoreID"] ? "selected" : "" ?>
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
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Customer Posting Group:</label>
                        <div class="col-xs-7">
                            <select class="form-control single-default" placeholder="CPG" id="" name="SI_CPG" tabindex="12">
                                <option value="" disabled selected>Customer Posting Group</option>
                                <?php if (!empty($CPG)): ?>
                                    <?php foreach ($CPG['data'] as $key => $value): ?>                                        
                                        <option value="<?= trim($value['CPG_Code']) ?>" <?= $SI_CPG == $value['CPG_Code']? 'selected':'' ?> ><?= $value['CPG_Code'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">VAT Posting Group:</label>
                        <div class="col-xs-7">
                            <select class="form-control single-default" placeholder="VAT" id="" name="SI_VAT" tabindex="13">
                                <option value="" disabled selected>VAT Posting Group</option>
                                <?php if (!empty($VAT)): ?>
                                    <?php foreach ($VAT['data'] as $key => $value): ?>                                        
                                        <option value="<?= trim($value['VBPG_Code']) ?>" <?= $SI_VAT == $value['VBPG_Code']? 'selected':'' ?> ><?= $value['VBPG_Code'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">WHT Posting Group:</label>
                        <div class="col-xs-7">
                            <select class="form-control single-default" placeholder="WHT" id="" name="SI_WHT" tabindex="14">
                                <option value="" disabled selected>WHT Posting Group</option>
                                <?php
                                if (!empty($WHT)) {
                                    foreach ($WHT['data'] as $key => $value) {
                                        ?>
                                        <option value="<?= trim($value['WBPG_Code']) ?>"  <?= $SI_WHT == $value['WBPG_Code']? 'selected':'' ?> ><?= $value['WBPG_Code'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>           
                </span><!--/Column 3--> 
                <legend>Details</legend>          
            </form>
             <hr>
                <div id="tbl-details" class="grid-table">
                </div>
             <hr>
            <div id="error-message-container" class="alert alert-danger" role="alert" style="display: none;">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <span id="error-message"></span>
            </div>
            <hr>
            <div class="btn-cont">
                <a id="update" type="button" tabindex="12" href="#" class="btn btn-default form-btn main-clr">
                    Save
                </a>
                <a type="button" tabindex="13" href="<?= $module_index_url ?>" class="btn btn-default form-btn sub-clr">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>js/module_header_processor.js"></script>

<script type="text/javascript">

    (function () {

        var customerData = <?= json_encode($customers["data"]) ?>;
        var locationsData = <?= json_encode($locations) ?>;
        var tableData = <?= json_encode($details['data']) ?>;

        var itemType        = <?= json_encode(array_column($itemtype['data'],'IT_Id'))?>;

        var items           = <?= json_encode($item['data'])?>;
    
        var itemCode        = <?= json_encode(array_column($item['data'],'IM_Item_id'))?>;

        var itemDescription = <?= json_encode(array_column($item['data'],'IM_Sales_Desc'))?>;
    
        var uom             = <?= json_encode($uom)?>;

        var $selectPaymentTerms;

        var cpg, $cpg;
        var vat, $vat;
        var wht, $wht;

        $(document).ready(function () {

            var detailTable = initializeDetailTable();

            var moduleHeaderProcessor = new ModuleHeaderProcessor({
                isTransactionModule: true,
                detailTable: detailTable
            });

            moduleHeaderProcessor.initialize();

            initializeUI();
        });

        function initializeUI() {
            $selectPaymentTerms = $('select[name=SI_PayTermsID]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    if (!value.length)
                        return;
                    $.ajax({
                        url: base_url + 'app/financial-management/sales-invoice/due_date',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            SI_PayTermsID: value,
                            SI_DocDate: $('input[name=SI_DocDate]').val()
                        },
                        beforeSend: function () {
                            $('input[name=SI_DueDate]').val('');
                        },
                        error: function () {
                            $('input[name=SI_DueDate]').val('');
                        },
                        success: function (res) {
                            $('input[name=SI_DueDate]').val(res);
                        }
                    });
                }
            });
            //  Modify customer name per change in customer id
            $('select[name=SI_CustomerName]').selectize({
                sortField: 'text',
                onChange: onCustomerNameChanged
            });

            $('select[name=SI_Location]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in locationsData) {
                        if (locationsData[i]["CA_FK_Location_id"] == value) {
                            var companyName = locationsData[i]["COM_Name"];
                            $('input[name=SI_Company]').val(companyName);
                        }
                    }
                }
            });

            $cpg = $('select[name=SI_CPG]').selectize({
                sortField: 'text'
            });

            $vat = $('select[name=SI_VAT]').selectize({
                sortField: 'text'
            });

            $wht = $('select[name=SI_WHT]').selectize({
                sortField: 'text'
            });

            cpg = $cpg[0].selectize;
            vat = $vat[0].selectize;
            wht = $wht[0].selectize;

        }


        function initializeDetailTable() {
            return $('#tbl-details').gridEntry({
                tableData: tableData,
                gridConfig: {
                    minSpareRows: 1,
                    colHeaders: [
                    "Item Type",
                    "Item No.",
                    "Item Description",
                    "Location",
                    "Qty",
                    "UOM",
                    "Unit Price",
                    "Amount",
                    "CPC",
                    "Comment",
                    "VAT Posting Group",
                    "WHT Posting Group",

                    ],
        columns: [
                {
                    data: "SID_ItemTypeID",
                    type: 'dropdown',
                    allowInvalid: false,
                    strict: true,
                    trimDropdown: true,
                    source:itemType,
                    renderer: autoCompleteRenderer
                 
                }, {
                    data: "SID_ItemNo",
                    type: 'dropdown',
                        trimDropdown: true,
                        strict: true,
                        source:function(change,process){
                            instance = $('#tbl-details').handsontable('getInstance');
                            itemCodeData = [];
                            for(var i in items){
                                if(instance.getDataAtCell(this.row, 0) == items[i].IM_FK_ItemType_id){
                                    itemCodeData.push(items[i].IM_Item_id);
                                }
                            }
                            process(itemCodeData);
                        },
                        renderer: autoCompleteRenderer
                }, {
                    data: "SID_ItemDescription",                
                    type: 'dropdown',
                        trimDropdown: true,                        
                        strict: true,
                        source:function(change,process){
                            instance = $('#tbl-details').handsontable('getInstance');
                            itemDescData = [];
                            for(var i in items){
                                if(instance.getDataAtCell(this.row, 0) == items[i].IM_FK_ItemType_id){
                                    itemDescData.push(items[i].IM_Sales_Desc);
                                }
                            }
                            process(itemDescData);
                        },
                        renderer: autoCompleteRenderer
                }, {
                    data: "SID_Location",
                    renderer:autoCompleteRenderer
                    // renderer:totalTextRenderer
                }, {
                    data: "SID_Qty",
                    type: 'numeric',
                    format: '0,0.00',
                    validator: requiredValidator,
                    allowInvalid:false,
                    strict: true,
                    readOnly:false,
                    // renderer:renderTotal
                },{
                    data: "SID_UOM",
                    renderer:autoCompleteRenderer
                    // renderer:renderTotal                  
                },{
                    data: "SID_UnitPrice",
                    type: 'numeric',
                    format: '0,0.00',
                    validator: requiredValidator,
                    allowInvalid:false,
                    strict: true,
                    readOnly:false,
                },{
                    data: "SID_Amount",
                    type: 'numeric',
                    format: '0,0.00',
                    validator: requiredValidator,
                    allowInvalid:false,
                    strict: true,
                    readOnly:false,
                    // renderer:totalTextRenderer
                },
                {
                    data: "SID_CostCenter",
                   renderer:autoCompleteRenderer
                },{
                    data: "SID_Comment",
                    renderer:autoCompleteRenderer
                    // renderer:totalTextRenderer
                },
                {
                    data: "SID_VAT",
                   renderer:autoCompleteRenderer
                },{
                    data: "SID_WHT",
                    renderer:autoCompleteRenderer
                    // renderer:totalTextRenderer
                },
                ],  

               afterChange:function(change,source){
                    if(change !==null || source !='loadData'){

                        if ($.inArray(change[0][1], ['SID_Qty', 'SID_UnitPrice']) != -1) {

                                 qty = this.getDataAtRowProp(change[0][0], 'SID_Qty') || 0;
                                 unitprice = this.getDataAtRowProp(change[0][0], 'SID_UnitPrice') || 0;                             
                                 amount = qty * unitprice; 
                                 this.setDataAtRowProp(change[0][0], 'SID_Amount', amount);       
                                    }

                        if(change[0][1] == 'SID_ItemNo' && source != 'cascade'){
                            for(var i in items){
                                if(this.getDataAtRowProp(change[0][0], 'SID_ItemNo') == items[i].IM_Item_id){
                                    this.setDataAtRowProp(change[0][0],'SID_ItemDescription',items[i].IM_Sales_Desc,'cascade');
                                    this.setDataAtRowProp(change[0][0],'SID_UOM',items[i].AD_Code);
                                    this.setDataAtRowProp(change[0][0],'SID_VAT',items[i].IM_VATProductPostingGroup);
                                    this.setDataAtRowProp(change[0][0],'SID_WHT',items[i].IM_WHTProductPostingGroup);
                                }
                            }
                        };
                        if(change[0][1] == 'SID_ItemDescription' && source != 'cascade'){
                            for(var i in items){
                                if(this.getDataAtRowProp(change[0][0], 'SID_ItemDescription') == items[i].IM_Sales_Desc){
                                    this.setDataAtRowProp(change[0][0],'SID_ItemNo',items[i].IM_Item_id,'cascade');
                                    this.setDataAtRowProp(change[0][0],'SID_UOM',items[i].AD_Code);
                                    this.setDataAtRowProp(change[0][0],'SID_VAT',items[i].IM_VATProductPostingGroup);
                                    this.setDataAtRowProp(change[0][0],'SID_WHT',items[i].IM_WHTProductPostingGroup);
                                }
                            }
                        };        
                        if(change[0][1] == 'SID_ItemType'){
                            ctr = 0;
                            for(var i in items){
                                if(change[0][3] == items[i].IM_FK_ItemType_id){
                                    ctr++;
                                }
                            }
                            if(ctr == 0){
                                this.setDataAtRowProp(change[0][0],'SID_ItemNo',null);
                                this.setDataAtRowProp(change[0][0],'SID_ItemDescription',null);
                                this.setDataAtRowProp(change[0][0],'SID_UOM',null);
                            }

                             this.setDataAtRowProp(change[0][0],'SID_Location',locationsData.getValue());
                                 
                        };

                    }
                },           
            }
    
        });
    }


        function onCustomerNameChanged(customerName) {
            for (var i in customerData) {
                if (customerData[i]["C_Name"] == customerName) {

                    var address = customerData[i]["C_Address1"];
                    var paymentTerms = customerData[i]["C_FK_PayTerms"];

                    if (customerData[i]["C_Address2"]) {
                        address += ", " + customerData[i]["C_Address2"];
                    }

                    if (customerData[i]["C_Address3"]) {
                        address += ", " + customerData[i]["C_Address3"];
                    }

                    $('input[name=SI_CustomerID]').val(customerData[i]["C_Id"]);
                    $('textarea[name=SI_CustomerAddress]').val(address);

                    cpg.setValue(customerData[i]['C_CustomerPostingGroup']);
                    vat.setValue(customerData[i]['C_VATPostingGroup']);
                    wht.setValue(customerData[i]['C_WHTPostingGroup']);

                    if (paymentTerms) {
                        $selectPaymentTerms[0].selectize.setValue(paymentTerms);
                    }
                }
            }
        }


        ///grid


       

    })();


</script>