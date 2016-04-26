
<?php
$index_url = base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3));
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
                <!--Left Panel-->
                <span class="col-md-5">                    
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" readonly id="" tabindex="1" name="DCM_DocNo" placeholder="Document No.">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Customer Name:</label>
                        <div class="col-xs-7">
                            <select class="form-control select-cli" name="DCM_CustomerName" tabindex="2" placeholder="Customer Name" > 
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
                            <input type="text" class="form-control" readonly id="" tabindex="3" name="DCM_CustomerID" placeholder="Customer ID">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <textarea type="text" class="form-control" id="" tabindex="4" name="DCM_Remarks" placeholder="Remarks"></textarea>
                        </div>
                    </div>
                </span><!--/Left Panel-->
                <!--Right Panel-->
                <span class="col-md-5">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                            <input type="date" class="form-control datepicker" id="" tabindex="5" name="DCM_DocDate" placeholder="Document Date." value="<?= $current_date ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Ref. Document No:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" tabindex="6" name="DCM_RefDocNo" placeholder="Ref. Document No.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">External Document No:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" tabindex="7" name="DCM_ExtDocNo" placeholder="External Document No.">
                        </div>
                    </div>
                    <div class="form-group" hidden>
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
                <a id="save-new" type="button" tabindex="9" href="#" class="btn btn-default form-btn main-clr action-button">
                    Save & New
                </a>
                <a id="save-close" type = "button" tabindex="10" href = "#" class = "btn btn-default form-btn main-clr action-button">
                    Save & Close
                </a>
                <a type = "button" href = "<?= $index_url ?>/" tabindex="11" class = "btn btn-default form-btn sub-clr">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>js/module_header_processor"></script>

<script type = "text/javascript">

    //  locally save customer data to lessen ajax calls
    var customerData = <?= json_encode($customers["data"]) ?>;
    var moduleIndexURL = "<?= $index_url ?>";

    $(function () {

        $(document).ready(function () {

            _module = 'financial-management';

            var moduleHeaderProcessor = new ModuleHeaderProcessor({
                isTransactionModule: true
            });
            moduleHeaderProcessor.initialize();
            moduleHeaderProcessor.loadNumberSeries('input[name=DCM_DocNo]');

            initializeUI();
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
    })();

</script>