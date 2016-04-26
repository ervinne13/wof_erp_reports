
<style>
    .machine-table-row {
        cursor: pointer;
    }

    .table > thead > tr > td.active, .table > tbody > tr > td.active, .table > tfoot > tr > td.active, .table > thead > tr > th.active, .table > tbody > tr > th.active, .table > tfoot > tr > th.active, .table > thead > tr.active > td, .table > tbody > tr.active > td, .table > tfoot > tr.active > td, .table > thead > tr.active > th, .table > tbody > tr.active > th, .table > tfoot > tr.active > th {
        background-color: #F78B3E !important;
        color: white !important; 
    }

</style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/dt/dt-1.10.11/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/t/dt/dt-1.10.11/datatables.min.js"></script>

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

            <form>
                <div class="row">

                    <!--Column 1-->
                    <span class="col-md-4">
                        <div class="form-group">
                            <label class="control-label col-xs-5">Document No.:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly name="RV_DocNo" class="form-control" placeholder="Document No." value="<?= $RV_DocNo ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Period:</label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control" name="RV_Period" placeholder="Period" value="<?= $RV_Period ?>">
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
                                            <?php $selected = $location["SP_StoreID"] == $RV_Location ? "selected" : "" ?>
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
                                <input type="text" readonly name="RV_Company" class="form-control" placeholder="Company" value="<?= $RV_Company ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Status:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly name="RV_Status" class="form-control" placeholder="Status" value="<?= $RV_Status ?>">
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

            <hr>

            <div class="row">

                <div class="col-xs-4" id="machine-table-container">
                    <br>

<!--                    <table id="machine-table-header" class="table table-striped" style="table-layout:fixed; margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th>Location</th>
                                <th>Classification</th>
                                <th>Machine Tag</th>
                                <th>Machine Name</th>
                            </tr>
                        </thead>                       
                    </table>-->
                    <div style="overflow-y:auto; overflow-x: hidden; height: 350px;">                       
                        <table id="machine-table" class="table table-striped" style="table-layout:fixed">
                            <thead>
                                <tr>
                                    <th>Location</th>
                                    <th>Classification</th>
                                    <th>Machine Tag</th>
                                    <th>Machine Name</th>
                                </tr>
                            </thead>
                            <tbody id="machine-table-body">

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-xs-8" id="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="tab" role="presentation"><a href="#tab-content-token" aria-controls="token" role="tab" data-toggle="tab">Token</a></li>
                        <li class="tab" role="presentation"><a href="#tab-content-piso-token" aria-controls="piso-token" role="tab" data-toggle="tab">Piso Token</a></li>
                        <li class="tab" role="presentation"><a href="#tab-content-piso-coin" aria-controls="piso-coin" role="tab" data-toggle="tab">Piso Coin</a></li>
                        <li class="tab" role="presentation"><a href="#tab-content-meter-reading" aria-controls="meter-reading" role="tab" data-toggle="tab">Meter Reading</a></li>
                        <li class="tab" role="presentation"><a href="#tab-content-ticket" aria-controls="ticket" role="tab" data-toggle="tab">Ticket</a></li>
                        <li class="tab" role="presentation"><a href="#tab-content-token-variance" aria-controls="token-variance" role="tab" data-toggle="tab">Token Variance</a></li>
                        <li class="tab" role="presentation"><a href="#tab-content-ticket-variance" aria-controls="ticket-variance" role="tab" data-toggle="tab">Ticket Variance</a></li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab-content-token"></div>
                        <div role="tabpanel" class="tab-pane active" id="tab-content-piso-token"></div>
                        <div role="tabpanel" class="tab-pane active" id="tab-content-piso-coin"></div>
                        <div role="tabpanel" class="tab-pane active" id="tab-content-meter-reading"></div>
                        <div role="tabpanel" class="tab-pane active" id="tab-content-ticket"></div>
                        <div role="tabpanel" class="tab-pane active" id="tab-content-token-variance"></div>
                        <div role="tabpanel" class="tab-pane active" id="tab-content-ticket-variance"></div>
                    </div>       

                </div>                

            </div>            

        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>js/underscore-min.js"></script>

<script id="machine-row-template" type="text/html">
    <tr data-id="<%= id %>" data-index="<%= index %>" class="machine-table-row">
        <td><%= MC_SubLocation %></td>
        <td><%= MC_MachineClass %></td>
        <td><%= MC_MachineTag %></td>
        <td><%= IM_Sales_Desc %></td>
    </tr>
</script>

<script type="text/javascript">

    (function () {

        var moduleId = "<?= $id ?>";

        var locationsData = <?= json_encode($locations) ?>;
        var moduleUrl = base_url + 'app/' + _module + "/" + _class;

        var machineRowTemplate;

        var currentTabIndex = 0;
        var currentCounterFrom = 0;
        var currentMachineIndex = 0;
        var machines;

        var tabIdList = [
            '#tab-content-token',
            '#tab-content-piso-token',
            '#tab-content-piso-coin',
            '#tab-content-meter-reading',
            '#tab-content-ticket',
            '#tab-content-token-variance',
            '#tab-content-ticket-variance'
        ];

        var tabViews = [
            'token',
            'pisoToken',
            'pisoCoin',
            'meterReading',
            'ticket',
            'tokenVariance',
            'ticketVariance'
        ];

        $(document).ready(function () {

            initializeTemplates();
            initializeUI();
            initializeEvents();

            //  load initial token tab
            reloadCurrentTab();
        });

        function initializeTemplates() {
            machineRowTemplate = _.template($("script#machine-row-template").html());
        }

        function initializeEvents() {
            $('#machine-table').on('click', '.machine-table-row', function (event) {
                $(this).addClass('active').siblings().removeClass('active');
                var id = $(this).data('id');
                var index = $(this).data('index');

                currentMachineIndex = index;
                loadTabContents(id);
            });

            initializeTokenViewEvents();
            initializePisoTokenEvents();
            initializePisoCoinEvents();
            initializeMeterReadingEvents();
            initializeTicketEvents();
            initializeTokenVarianceEvents();
            initializeTicketVarianceEvents();

            $('.tab').click(function () {
                var tabId = $(this).find('a').attr('href');
                currentTabIndex = tabIdList.indexOf(tabId);
                reloadCurrentTab();
            });

        }

        function reloadCurrentTab() {
            var location = $('select[name=RV_Location]')[0].selectize.getValue();

            var medium = getMedium();

            //  machines can only be mediums 0 - 4
            if (medium <= 4) {
                loadMachines(location, medium);
            } else {
                showMachineTable(false);
                loadTabContents(0);
            }
        }

        function initializeTokenViewEvents() {
            $('body').on('click', '#action-save-machine-tokens', function () {
                saveToken();
            });

            $('body').on('click', '#action-save-and-next-machine-tokens', function () {
                saveToken(true);
            });

            $('body').on('change', 'input[name=RVT_CounterFrom]', function () {
                loadQtyRetrieved('RVT');
            });

            $('body').on('change', 'input[name=RVT_CounterTo]', function () {
                loadQtyRetrieved('RVT');
            });
        }

        function initializePisoTokenEvents() {
            $('body').on('click', '#action-save-machine-piso-token', function () {
                savePisoToken();
            });

            $('body').on('click', '#action-save-and-next-machine-piso-token', function () {
                savePisoToken(true);
            });

            $('body').on('change', 'input[name=RVPT_CounterFrom]', function () {
                loadQtyRetrieved('RVPT');
            });

            $('body').on('change', 'input[name=RVPT_CounterTo]', function () {
                loadQtyRetrieved('RVPT');
            });
        }

        function initializePisoCoinEvents() {
            $('body').on('click', '#action-save-machine-piso-coin', function () {
                savePisoCoin();
            });

            $('body').on('click', '#action-save-and-next-machine-piso-coin', function () {
                savePisoCoin(true);
            });

            $('body').on('change', 'input[name=RVPC_CounterFrom]', function () {
                loadQtyRetrieved('RVPC');
            });

            $('body').on('change', 'input[name=RVPC_CounterTo]', function () {
                loadQtyRetrieved('RVPC');
            });
        }

        function initializeMeterReadingEvents() {

            $('body').on('click', '#action-save-machine-machine-reading', function () {
                saveMeterReading();
            });

            $('body').on('click', '#action-save-and-next-machine-machine-reading', function () {
                saveMeterReading(true);
            });

            $('body').on('change', '.meter-reading-field', function () {
                var lineNo = $(this).data('id');
                refreshMeterReadingDependentValues(lineNo);
            });
        }

        function initializeTicketEvents() {
            $('body').on('click', '#action-save-machine-tickets', function () {
                saveTicket();
            });

            $('body').on('click', '#action-save-and-next-machine-tickets', function () {
                saveTicket(true);
            });
        }

        function initializeTokenVarianceEvents() {
            $('body').on('click', '#action-save-token-variance', function () {
                saveTokenVarianceRemarks()();
            });
        }

        function initializeTicketVarianceEvents() {
            $('body').on('click', '#action-save-ticket-variance', function () {
                saveTicketVarianceRemarks()();
            });
        }

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
                }
            });

            $('select[name=RV_Week]').selectize({
                sortField: 'text',
                onChange: function (value) {
//                    refreshDocNo();
//                    createRetrieval();
                    updateHeader();
                    reloadCurrentTab();
                }
            });

            $('input[name=RV_RetrievalDate]').datepicker({
                onClose: function (dateText, inst) {
//                    refreshDocNo();
//                    createRetrieval();
                    updateHeader();
                    reloadCurrentTab();
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

        function openNextMachine() {
            if (machines.length > currentMachineIndex) {
                currentMachineIndex++;
                $('.machine-table-row[data-index=' + currentMachineIndex + ']').click();
            } else {
                alert('Saved! This is the last machine, will load next tab instead.');
            }
        }

        function getMedium() {
            var medium = 0;

            //  switch tabs meter reading with ticket
            if (currentTabIndex == 3) {
                medium = 4;
            } else if (currentTabIndex == 4) {
                medium = 3;
            } else {
                medium = currentTabIndex;
            }

            return medium;
        }

        //  ====================================================================
        //  Value Loaders

        function refreshDocNo() {

            var branch = $('select[name=RV_Location]')[0].selectize.getValue();
            var period = $('input[name=RV_Period]').val();
//            var weekNo = $('select[name=RV_Week]')[0].selectize.getValue();

//            var docNo = branch + "-" + period + "-" + weekNo;
            var docNo = branch + "-" + period;

            $('input[name=RV_DocNo]').val(docNo);

        }


        function loadQtyRetrieved(prefix) {
            var counterBeg = $('input[name=' + prefix + '_CounterFrom]').val();
            var counterEnd = $('input[name=' + prefix + '_CounterTo]').val();

            var qtyRetrieved = counterEnd - counterBeg;

            $('#' + prefix + '_QtyRetrieved').html(qtyRetrieved);
        }

        function refreshMeterReadingDependentValues(lineNo) {

            $('[data-id=' + lineNo + '][name=RVMR_ReadingFrom]').val(currentCounterFrom);

            var from = $('[data-id=' + lineNo + '][name=RVMR_ReadingFrom]').val();
            var to = $('[data-id=' + lineNo + '][name=RVMR_ReadingTo]').val();

            var meterCount = to - from;

            $('#meter-count-' + lineNo).html(meterCount);

            refreshSubTotal();
            refreshVariance();

        }

        function refreshSubTotal() {
            var subTotal = 0;
            $('.meter-count').each(function () {
                var meterCount = parseInt($(this).html());
                subTotal += meterCount;
            });

            $('#sub-total').html(subTotal);
        }

        function refreshVariance() {
            var subTotal = parseInt($('#sub-total').html());
            var qtyRetrieved = parseInt($('#qty-retrieved').html());

            var varianceP = 0;
            var variance = qtyRetrieved - subTotal;

            variance = Math.abs(variance);
            if (subTotal > 0) {
                varianceP = (variance / subTotal) * 100;
            } else {
                varianceP = 0;
            }

            $('#qty-variance').html(variance);
            $('#variance-p').html(varianceP.toPrecision(2) + "%");

        }

        //  ====================================================================
        //  API

        function updateHeader() {

            var url = moduleUrl + "/process";
            var data = {
                RV_DocNo: $('input[name=RV_DocNo]').val(),
                RV_Week: $('select[name=RV_Week]')[0].selectize.getValue(),
                RV_RetrievalDate: $('input[name=RV_RetrievalDate]').val(),
                type: "update"
            };

            $.post(url, data, function (response) {
                response = JSON.parse(response);

                if (response.status == 1) {
                    //  header updated, just silently continue
                    console.log("header updated");
                } else {
                    alert("Updating header details failed: " + response.message);
                }

            });

            $('.btn').attr('disabled', 'disabled');

        }

        function saveToken(loadNextMachine) {
            var qtyRetrieved = $('#RVT_QtyRetrieved').html();
            if (qtyRetrieved < 0) {
                alert("Invalid QTY Retrieved, please check your beg and end counters.");
                return;
            }

            var lastCounterEnd = $('input[name=RVT_CounterTo]').val();
            currentCounterFrom = lastCounterEnd;

            var lineNo = $('#current-token-line-no').attr('content');

            var rt = {
                RVT_LineNo: lineNo,
                RVT_CounterFrom: $('input[name=RVT_CounterFrom]').val(),
                RVT_CounterTo: $('input[name=RVT_CounterTo]').val(),
                RVT_QtyRetrieved: qtyRetrieved,
                RVT_Free: $('input[name=RVT_Free]').val(),
                RVT_MTC: $('input[name=RVT_MTC]').val(),
                RVT_Remarks: $('input[name=RVT_Remarks]').val()
            };

            var url = moduleUrl + "/saveRetrievalToken";

            save(url, rt, loadNextMachine);

        }

        function savePisoToken(loadNextMachine) {
            var qtyRetrieved = $('#RVPT_QtyRetrieved').html();
            if (qtyRetrieved < 0) {
                alert("Invalid QTY Retrieved, please check your beg and end counters.");
                return;
            }

            var lastCounterEnd = $('input[name=RVPT_CounterTo]').val();
            currentCounterFrom = lastCounterEnd;

            var lineNo = $('#current-piso-token-line-no').attr('content');

            var rt = {
                RVPT_LineNo: lineNo,
                RVPT_CounterFrom: $('input[name=RVPT_CounterFrom]').val(),
                RVPT_CounterTo: $('input[name=RVPT_CounterTo]').val(),
                RVPT_QtyRetrieved: qtyRetrieved,
                RVPT_PisoCoin: $('input[name=RVPT_PisoCoin]').val(),
                RVPT_MTC: $('input[name=RVPT_MTC]').val(),
                RVPT_Remarks: $('input[name=RVPT_Remarks]').val()
            };
            
            var url = moduleUrl + "/saveRetrievalPisoToken";

            save(url, rt, loadNextMachine);

        }

        function savePisoCoin(loadNextMachine) {
            var qtyRetrieved = $('#RVPC_QtyRetrieved').html();
            if (qtyRetrieved < 0) {
                alert("Invalid QTY Retrieved, please check your beg and end counters.");
                return;
            }

            var lastCounterEnd = $('input[name=RVPC_CounterTo]').val();
            currentCounterFrom = lastCounterEnd;

            var lineNo = $('#current-piso-coin-line-no').attr('content');

            var rt = {
                RVPC_LineNo: lineNo,
                RVPC_CounterFrom: $('input[name=RVPC_CounterFrom]').val(),
                RVPC_CounterTo: $('input[name=RVPC_CounterTo]').val(),
                RVPC_QtyRetrieved: qtyRetrieved,
                RVPC_PisoToken: $('input[name=RVPC_PisoToken]').val(),
                RVPC_MTC: $('input[name=RVPC_MTC]').val(),
                RVPC_Remarks: $('input[name=RVPC_Remarks]').val()
            };

            console.log(rt);

            var url = moduleUrl + "/saveRetrievalPisoCoin";

            save(url, rt, loadNextMachine);

        }

        function saveMeterReading(loadNextMachine) {

            var mr = [];

            var varianceP = $('#variance-p').html();
            varianceP = varianceP.substring(0, varianceP.length - 1);   //  remove %
            varianceP = parseFloat(varianceP);

            var totalReadingTo = 0;

            $('.meter-reading-row').each(function () {
                var id = $(this).data('id');

                var mrItem = {
                    RVMR_LineNo: id,
                    RVMR_ReadingFrom: parseInt($('[data-id=' + id + '][name=RVMR_ReadingFrom]').val()),
                    RVMR_ReadingTo: parseInt($('[data-id=' + id + '][name=RVMR_ReadingTo]').val()),
                    RVMR_MeterCount: parseInt($('#meter-count-' + id).html()),
                    RVMR_VarianceQty: parseInt($('#qty-variance').html()),
                    RVMR_VarianceP: varianceP,
                    RVMR_Remarks: $('[name=RVMR_Remarks]').val()
                };

                mr.push(mrItem);

                totalReadingTo += mrItem.RVMR_ReadingTo;

            });

            var url = moduleUrl + "/saveMeterReading";
            var data = {
                entries: JSON.stringify(mr)
            };

            save(url, data, loadNextMachine, function () {
                currentCounterFrom = totalReadingTo;
            });

        }

        function saveTicket(loadNextMachine) {

            var tickets = [];

            $('.ticket-row').each(function () {
                var id = $(this).data('id');

                var ticket = {
                    RVTR_LineNo: id,
                    RVTR_QtyRetrieved: parseInt($('[data-id=' + id + '][name=RVTR_QtyRetrieved]').val()),
                    RVTR_Remarks: $('[data-id=' + id + '][name=RVTR_Remarks]').val()
                };

                tickets.push(ticket);

            });

            var url = moduleUrl + "/saveTickets";
            var data = {
                entries: JSON.stringify(tickets)
            };

            save(url, data, loadNextMachine);

        }

        function saveTokenVarianceRemarks() {

            var remarkList = [];

            $('.token-variance-row').each(function () {
                var id = $(this).data('id');

                var tv = {
                    RVTOV_LineNo: id,
                    RVTOV_Remarks: $('[data-id=' + id + '][name=RVTOV_Remarks]').val()
                };

                remarkList.push(tv);

            });

            var url = moduleUrl + "/saveTokenVarianceRemarks";
            var data = {
                entries: JSON.stringify(remarkList)
            };

            save(url, data);

        }

        function saveTicketVarianceRemarks() {

            var remarkList = [];

            $('.ticket-variance-row').each(function () {
                var id = $(this).data('id');

                var tv = {
                    RVTIV_LineNo: id,
                    RVTIV_Remarks: $('[data-id=' + id + '][name=RVTIV_Remarks]').val()
                };

                remarkList.push(tv);

            });

            var url = moduleUrl + "/saveTicketVarianceRemarks";
            var data = {
                entries: JSON.stringify(remarkList)
            };

            save(url, data);
        }

        function save(url, values, loadNextMachine, onSaveCallback) {
            $.post(url, values, function (response) {
                $('.btn').removeAttr('disabled');
                response = JSON.parse(response);

                if (response.status == 1) {
                    if (onSaveCallback) {
                        onSaveCallback();
                    }

                    if (loadNextMachine) {
                        openNextMachine();
                    } else {
                        alert('Saved!');
                    }
                } else {
                    alert(response.message);
                }

            });

            $('.btn').attr('disabled', 'disabled');
        }

        //  ====================================================================
        //  Dynamic Content Loaders

        function refreshWeeklyTotals() {

            //  clear
            $('[name=RV_Week1Amount]').val('');
            $('[name=RV_Week2Amount]').val('');
            $('[name=RV_Week3Amount]').val('');
            $('[name=RV_Week4Amount]').val('');

            var week1 = $('#week-1-total').html();
            var week2 = $('#week-2-total').html();
            var week3 = $('#week-3-total').html();
            var week4 = $('#week-4-total').html();

            if (week1) {
                $('[name=RV_Week1Amount]').val(week1);
            }

            if (week2) {
                $('[name=RV_Week2Amount]').val(week2);
            }

            if (week3) {
                $('[name=RV_Week3Amount]').val(week3);
            }

            if (week4) {
                $('[name=RV_Week4Amount]').val(week4);
            }

            //  reset
            $('#week-1-total').html('');
            $('#week-2-total').html('');
            $('#week-3-total').html('');
            $('#week-4-total').html('');

        }

        function showMachineTable(show) {
            if (show) {
                $("#machine-table-container").css('display', 'block');
                $("#tabs-container").removeClass('col-xs-12');
                $("#tabs-container").addClass('col-xs-8');
            } else {
                $("#tabs-container").removeClass('col-xs-8');
                $("#tabs-container").addClass('col-xs-12');
                $("#machine-table-container").css('display', 'none');
            }
        }

        function loadMachines(location, medium) {

            var url = moduleUrl + "/machines";
            url += "?location=" + location;

            //  medium can only be 0 to 3
            if (medium < 4) {

                url += "&medium=" + medium;
            }

            showMachineTable(true);
            $.get(url, function (response) {
                machines = JSON.parse(response);

                $("#machine-table-body").html('');

                //  build table HTML
                for (var i in machines) {
                    machines[i]['index'] = i;
                    var html = machineRowTemplate(machines[i]);
                    $("#machine-table-body").append(html);
                }

//                $('#machine-table').dataTable({
//                    paging: false
//                });
                $('.machine-table-row[data-index=' + currentMachineIndex + ']').click();

            });

            $("#machine-table-body").html('Loading');
        }

        function loadTabContents(machineId) {
            var view = tabViews[currentTabIndex];
            var id = tabIdList[currentTabIndex];
            $('a[href=' + id + ']').tab('show');
            $(id).html('loading');

            var url = buildSubViewUrl(view, machineId);

            $.get(url, function (html) {
                $(id).html(html);

                if (currentTabIndex == 3) {
                    $('.meter-reading-row').each(function () {
                        var id = $(this).data('id');
                        refreshMeterReadingDependentValues(id);
                    });

                }

                refreshWeeklyTotals();

            });
        }

        function buildSubViewUrl(view, machineId) {
            var url = moduleUrl + "/" + view;
            url += "?docId=" + moduleId;

            if (view == "tokenVariance" || view == "ticketVariance") {
                url += "&week=" + $('select[name=RV_Week]')[0].selectize.getValue();
            } else {
                url += "&machineId=" + machineId;
                url += "&week=" + $('select[name=RV_Week]')[0].selectize.getValue();
                url += "&counter_from=" + currentCounterFrom;
            }

            return url;
        }

    })();

</script>