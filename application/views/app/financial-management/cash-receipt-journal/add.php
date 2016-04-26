
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
                <span class="col-md-4">                    
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="1" name="CRJ_DocNo" placeholder="Document No.">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Customer Name:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="CRJ_CustomerName" tabindex="2" placeholder="Customer Name" > 
                                <option value="" disabled selected>Customer Name</option>
                                <?php foreach ($customers["data"] AS $customer): ?>                                                                
                                    <option value="<?= $customer["C_Name"] ?>" >
                                        <?= $customer["C_Name"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Customer ID:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="3" name="CRJ_CustomerID" placeholder="Customer ID">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">External Document No:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" tabindex="4" name="CRJ_ExtDocNo" placeholder="External Document No.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <textarea type="text" class="form-control" id="" tabindex="5" name="CRJ_Remarks" placeholder="Remarks"></textarea>
                        </div>
                    </div>
                </span><!--/Left Panel-->
                <!--Middle Panel-->
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                            <input type="date" class="form-control datepicker" id="" tabindex="6" name="CRJ_DocDate" placeholder="Document Date." value="<?= $current_date ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Amount:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" tabindex="7" name="CRJ_Amount" placeholder="Amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Bank Account:</label>
                        <div class="col-xs-7">                                                        
                            <select class="form-control select-cli" name="CRJ_BankAccount" tabindex="8" placeholder="Bank Account"> 
                                <option value="" disabled selected>Customer Id</option>
                                <?php foreach ($bank_accounts["data"] AS $bank_account): ?>                                                                
                                    <option value="<?= $bank_account["BA_BankID"] ?>" >
                                        <?= $bank_account["BA_BankID"] ?> (<?= $bank_account["BA_BankName"] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div>                    
                </span><!--/Middle Panel-->
                <!--Right Panel-->
                <span class="col-md-4">
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Location:</label>
                        <div class="col-xs-7">                            
                            <select class="form-control select-cli" name="CRJ_Location" tabindex="9" placeholder="Location">
                                <?php if (count($locations) > 1): ?>
                                    <option value="" disabled selected>Location</option>
                                    <?php foreach ($locations AS $location): ?>                                                                
                                        <option value="<?= $location["SP_StoreID"] ?>">
                                            <?= $location["SP_StoreName"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <input type="text" class="form-control" id="" readonly value="<?= $locations[0]['SP_StoreID'] ?>" tabindex="10" name="CRJ_Location" placeholder="Location">
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Company:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="10" name="CRJ_Company" placeholder="Company">
                        </div>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label class="control-label col-xs-5" for="">CPG:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="10" name="CRJ_CPG" placeholder="CPG">
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
                <a id="save-new" type="button" href="#" tabindex="11" class="btn btn-default form-btn main-clr action-button">
                    Save & New
                </a>
                <a id="save-close" type = "button" href = "#" tabindex="12" class = "btn btn-default form-btn main-clr action-button">
                    Save & Close
                </a>
                <a type = "button" tabindex="13" href = "<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>/" class = "btn btn-default form-btn sub-clr">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>js/module_header_processor"></script>

<script type = "text/javascript">

    (function () {

        //  locally save customer data to lessen ajax calls
        var customerData = <?= json_encode($customers["data"]) ?>;
        var locationsData = <?= json_encode($locations) ?>;

        $(document).ready(function () {

            var moduleHeaderProcessor = new ModuleHeaderProcessor({
                isTransactionModule: true
            });
            moduleHeaderProcessor.initialize();
            moduleHeaderProcessor.loadNumberSeries('input[name=CRJ_DocNo]');

            initializeUI();
        });

        function initializeUI() {
            //  Modify customer name per change in customer id
            $('select[name=CRJ_CustomerName]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in customerData) {
                        if (customerData[i]["C_Name"] == value) {
                            $('input[name=CRJ_CustomerID]').val(customerData[i]["C_Id"]);
                            $('input[name=CRJ_CPG]').val(customerData[i]["C_CustomerPostingGroup"]);
                        }
                    }
                }
            });

            $('select[name=CRJ_BankAccount]').selectize({
                sortField: 'text'
            });

            $('select[name=CRJ_Location]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in locationsData) {
                        if (locationsData[i]["CA_FK_Location_id"] == value) {
                            var companyName = locationsData[i]["COM_Name"];
                            $('input[name=CRJ_Company]').val(companyName);
                        }
                    }
                }
            });

        }

    })();

</script>