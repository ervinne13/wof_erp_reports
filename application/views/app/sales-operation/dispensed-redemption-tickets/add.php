

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>          	
        </h3>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">

            <div class="row">
                <span>* Select Period, Week, and Branch to generate a document number</span>
            </div>

            <div class="row">
                <form id="<?= $this->uri->segment(3) ?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
                    <span class="col-md-6">
                        <!-- DOC. NO -->
                        <div class="form-group">
                            <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control" disabled id="" tabindex="1" name="DI_DocNo" placeholder="Document No.">
                            </div>
                        </div>		

                        <!-- BRANCH -->					
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Branch:</label>
                            <div class="col-xs-7">

                                <select class="form-control single-default" id="branch" placeholder="Branch" name="DI_Location" tabindex="3">
                                    <option value="" disabled selected>Branch</option>
                                    <?php
                                    if (!empty($branch['data'])) {
                                        foreach ($branch['data'] as $key => $value) {
                                            ?>
                                            <!-- auto fill the dropdownbox the default location -->								  	
                                            <option value="<?= $value['SP_StoreID'] ?>" 								  	
                                                    <?= $this->session->userdata('dlocation')['SP_StoreID'] == ($value['SP_StoreID']) ? 'selected' : '' ?> ><?= $value['SP_StoreName'] ?></option>									
                                                <?php }
                                            } ?>

                                </select>
                            </div>
                        </div>


                        <!-- PERIOD -->
                        <div class="form-group">
                            <label for="sel1" class="control-label col-xs-5">Period:</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control periodPicker" id="period" tabindex="3" name="DI_Period" placeholder="Period">                    
                            </div>
                        </div>



                        <!-- WEEK NO -->
                        <div class="form-group">
                            <label for="sel1" class="control-label col-xs-5">Week No:</label>
                            <div class="col-xs-7">
                                <select name="DI_WeekNo" class="form-control select-cli">
                                    <option value="1">Week 1</option>
                                    <option value="2">Week 2</option>
                                    <option value="3">Week 3</option>
                                    <option value="4">Week 4</option>
                                </select>
                            </div>
                        </div>


                    </span>


                    <span class="col-md-6"> 
                        <!--DOC DATE  -->
                        <div class="form-group">
                            <label for="sel1" class="control-label col-xs-5">Doc. Date:</label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control" id="" maxlength="30" readonly value="<?= date("m/d/Y", time()) ?>" disabled name="DI_DocDate" placeholder="Document Date">
                            </div>
                        </div>

                        <!-- RETRIEVAL DATE -->
                        <div class="form-group">
                            <label for="sel1" class="control-label col-xs-5">Reading Date:</label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control" id="retDate" tabindex="2"  value="<?= $retrieval_date_display ?>" name="DI_RetrievalDate" placeholder="Retrival Date">                            
                                            <!-- <input type="text" class="form-control" tabindex="2" id="retDate" value="<?= $retrieval_date_display ?>" name="DI_RetrievalDate" placeholder="Retrival Date"> -->

                            </div>
                        </div>		

                        <!-- COMPANY -->
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Company:</label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control" id="com_id" readonly value="<?= count($location) == 1 ? $location[0]['COM_Name'] : $dcompany ?>" name="DI_Company" placeholder="Company">
                            </div>
                        </div>

                        <!-- STATUS -->
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Status:</label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control" readonly id="status"  value="" data-id="" name="DI_Status" placeholder="Status">
                            </div>
                        </div>	
                    </span>

                </form>
            </div>
            <hr>

            <!-- 			<div class="btn-cont">
                                            <a type="button" tabindex="16" id="save" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
                                              Save
                                            </a>
                                            <a type="button" tabindex="17" id="save-next"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
                                              Save & Next
                                            </a>
                                            <a type="button" tabindex="18" href="<?= base_url() ?>app/<?= $this->uri->segment(2) ?>/<?= $this->uri->segment(3) ?>" class="btn btn-default form-btn sub-clr">
                                               Cancel
                                            </a>
                                    </div>  -->
        </div>
    </div>
</div>

<script type="text/javascript">

    (function () {

        var nsId = '<?= $nsId["NS_Id"] ?>';

        var locationsData = <?= json_encode($location) ?>;
        var moduleUrl = base_url + 'app/' + _module + "/" + _class;


        $(document).ready(function () {

            initializeUI();
        });

        function initializeUI() {

            //  collapse nav bar by default
            $('.navbar-collapse').click();

            //PERIOD
            $('input[name=DI_Period]').datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'M-yy',
                onClose: function (dateText, inst) {
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                    refreshDocNo();
                    createDispense();
                },
                onSelect: function (val) {
                    refreshDocNo();
                    createDispense();
                }
            });

            //RETRIEVAL DATE
            $('input[name=DI_RetrievalDate]').datepicker({
                onClose: function (dateText, inst) {
                    if ($('input[name=DI_Period]').val() != '') {
                        refreshDocNo();
                        createDispense();
                    }

                }
            });


            //WEEK
            $('select[name=DI_WeekNo]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    if ($('input[name=DI_Period]').val() != '') {
                        refreshDocNo();
                        createDispense();
                    }
                }

            });

            //BRANCH
            $('select[name=DI_Location]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in locationsData) {
                        if (locationsData[i]["SP_StoreID"] == value) {
                            var companyName = locationsData[i]["COM_Name"];
                            $('input[name=DI_Company]').val(companyName);
                        }
                    }

                    refreshDocNo();
                    createDispense();
                }
            });

        }


        function refreshDocNo() {

            var branch = $('select[name=DI_Location]')[0].selectize.getValue();
            var period = $('input[name=DI_Period]').val();

            var docNo = branch + "-" + nsId + "-" + period;

            $('input[name=DI_DocNo]').val(docNo);

        }


        function createDispense() {
            var data = {};

            data.DI_DocNo = $('input[name=DI_DocNo]').val();
            data.DI_DocDate = $('input[name=DI_DocDate]').val();
            data.DI_Location = $('select[name=DI_Location]')[0].selectize.getValue();
            data.DI_Period = $('input[name=DI_Period]').val();
            data.DI_Company = $('input[name=DI_Company]').val();
            data.DI_RetrievalDate = $('input[name=DI_RetrievalDate]').val();


            data.type = "create";

            var url = moduleUrl + "/process";

            $.post(url, data, function (generatedId) {
                console.log(generatedId);
                location.href = moduleUrl + "/update?id=" + generatedId;

            });

            alert("Please wait while the browser reloads...");

        }

    })();

</script>