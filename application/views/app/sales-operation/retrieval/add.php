
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
            <span class="dropdown pull-right">
                <a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    Functions
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li><a href="">Cancel</a></li>
                    <li><a href="">Approve Without Tickets</a></li>
                    <li><a href="">Approve With Tickets</a></li>
                </ul>
                <a class="cls-btn" href="<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>" >
                    Close
                </a>
            </span>
        </h3>
    </div>    
    <div class="panel-body">        
        <div id="data-container" class="container-fluid">            

            <div class="row">
                <span>* Select Period, Week, and Branch to generate a document number</span>
            </div>

            <div class="row">
                <form id="retrieval-form">
                    <div class="row">

                        <!--Column 1-->
                        <span class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-xs-5">Document No.:</label>
                                <div class="col-xs-7">
                                    <input type="text" readonly name="RV_DocNo" class="form-control" placeholder="Document No.">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="control-label col-xs-5">Period:</label>
                                <div class="col-xs-7">
                                    <input type="text" class="form-control" name="RV_Period" placeholder="Period">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="control-label col-xs-5">Week:</label>
                                <div class="col-xs-7">
                                    <select name="RV_Week" class="form-control select-cli">
                                        <option value="1">Week 1</option>
                                        <option value="2">Week 2</option>
                                        <option value="3">Week 3</option>
                                        <option value="4">Week 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="control-label col-xs-5">Retrieval Date:</label>
                                <div class="col-xs-7">
                                    <input type="text" value="<?= $current_date_display ?>" class="form-control" name="RV_RetrievalDate" placeholder="Retrieval Date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="control-label col-xs-5">Partial:</label>
                                <div class="col-xs-2">
                                    <input type="checkbox" class="form-control" name="RV_Partial">
                                </div>
                            </div>
                        </span>
                        <!--/Column 1-->
                        <!--Column 2-->
                        <span class="col-md-4">
                            <div class="form-group">
                                <label  class="control-label col-xs-5">Document Date:</label>
                                <div class="col-xs-7">
                                    <input type="text" value="<?= $current_date_display ?>" readonly class="form-control" name="RV_DocDate" placeholder="Document Date" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="control-label col-xs-5">Branch:</label>
                                <div class="col-xs-7">                            
                                    <select class="form-control select-cli" name="RV_Location" placeholder="Location">
                                        <?php if (count($locations) > 1): ?>
                                            <option value="" disabled selected>Location</option>
                                            <?php foreach ($locations AS $location): ?>
                                                <?php $selected = $location["SP_StoreID"] == $default_location["CA_FK_Location_id"] ? "selected" : "" ?>
                                                <option value="<?= $location["SP_StoreID"] ?>" <?= $selected ?>>
                                                    <?= $location["SP_StoreName"] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <input type="text" class="form-control" id="" readonly value="<?= $locations[0]['SP_StoreID'] ?>" name="RV_Location" placeholder="Location">
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="control-label col-xs-5">Company:</label>
                                <div class="col-xs-7">
                                    <input type="text" readonly name="RV_Company" class="form-control" placeholder="Company" value="<?= $company ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="control-label col-xs-5">Status:</label>
                                <div class="col-xs-7">
                                    <input type="text" readonly name="RV_Status" class="form-control" placeholder="Status">
                                </div>
                            </div>
                        </span>
                        <!--/Column 2-->
                        <!--Column 3-->
                        <span class="col-md-4">
                            <div class="row">
                                <span class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-xs-5">Week 1:</label>
                                        <div class="col-xs-7">
                                            <input type="text" readonly name="RV_Week1Amount" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label col-xs-5">Week 2:</label>
                                        <div class="col-xs-7">
                                            <input type="text" readonly name="RV_Week2Amount" class="form-control">
                                        </div>
                                    </div>
                                </span>
                                <span class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-xs-5">Week 3:</label>
                                        <div class="col-xs-7">
                                            <input type="text" readonly name="RV_Week3Amount" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label col-xs-5">Week 4:</label>
                                        <div class="col-xs-7">
                                            <input type="text" readonly name="RV_Week4Amount" class="form-control">
                                        </div>
                                    </div>
                                </span>
                            </div>                        
                        </span>                    
                        <!--/Column 3-->
                    </div>
                </form>
            </div>

            <hr>

            <div class="row">
            </div>            

        </div>
    </div>
</div>
<script type="text/javascript">

    (function () {

        var locationsData = <?= json_encode($locations) ?>;
        var moduleUrl = base_url + 'app/' + _module + "/" + _class;

        $(document).ready(function () {

            initializeUI();
        });

        function initializeUI() {

            //  collapse nav bar by default
            $('.navbar-collapse').click();

            $('input[name=RV_Period]').datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'M-yy',
                onClose: function (dateText, inst) {
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                    refreshDocNo();
                    createRetrieval();
                },
                onSelect: function (val) {
                    refreshDocNo();
                    createRetrieval();
                }
            });

            $('input[name=RV_RetrievalDate]').datepicker({
                onClose: function (dateText, inst) {
                    refreshDocNo();
                    createRetrieval();
                }
            });

            $('select[name=RV_Week]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    refreshDocNo();
                    createRetrieval();
                }
            });

            $('select[name=RV_Location]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in locationsData) {
                        if (locationsData[i]["SP_StoreID"] == value) {
                            var companyName = locationsData[i]["COM_Name"];
                            $('input[name=RV_Company]').val(companyName);
                        }
                    }

                    refreshDocNo();
                    createRetrieval();
                }
            });

        }

        function refreshDocNo() {

            var branch = $('select[name=RV_Location]')[0].selectize.getValue();
            var period = $('input[name=RV_Period]').val();
//            var weekNo = $('select[name=RV_Week]')[0].selectize.getValue();

//            var docNo = branch + "-" + period + "-" + weekNo;
            var docNo = branch + "-" + period;

            $('input[name=RV_DocNo]').val(docNo);

        }

        function createRetrieval() {
            var data = {};

            data.RV_DocNo = $('input[name=RV_DocNo]').val();
            data.RV_DocDate = $('input[name=RV_DocDate]').val();
            data.RV_Location = $('select[name=RV_Location]')[0].selectize.getValue();
            data.RV_Week = $('select[name=RV_Week]')[0].selectize.getValue();
            data.RV_Period = $('input[name=RV_Period]').val();
            data.RV_Company = $('input[name=RV_Company]').val();
            data.RV_RetrievalDate = $('input[name=RV_RetrievalDate]').val();

            data.type = "create";

            var url = moduleUrl + "/process";

            $.post(url, data, function (generatedId) {
                console.log(generatedId);

                location.href = moduleUrl + "/edit?id=" + generatedId;

            });

            alert("Please wait while the browser reloads...");

        }

    })();

</script>