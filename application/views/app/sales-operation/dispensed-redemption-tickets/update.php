
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

<div style="display: none;">
    <input id="editable-week-no" value="<?= $DI_WeekNo ?>">
</div>

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
                    <li><a id="action-finalize" href="javascript:void(0)">Finalize</a></li>
                    <!--          <li><a href="">Post</a></li>
                             <li><a href="">Approve With Tickets</a></li> -->
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
                    <span class="col-md-6">
                        <!-- DOC. NO -->
                        <div class="form-group">
                            <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control" disabled id="" value="<?= $DI_DocNo ?>" tabindex="1" name="DI_DocNo" placeholder="Document No.">
                            </div>
                        </div>      

                        <!-- BRANCH -->                 
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Branch:</label>
                            <div class="col-xs-7">

                                <select class="form-control single-default" id="branch" placeholder="Branch" name="DI_Location" tabindex="3">
                                    <option value="" disabled selected>Branch</option>
                                    <?php if (count($location) > 1): ?>                                       
                                        <?php foreach ($location AS $locations): ?>
                                            <?php $selected = $locations["SP_StoreID"] == $DI_Location ? "selected" : "" ?>
                                            <option value="<?= $locations["SP_StoreID"] ?>" <?= $selected ?>>
                                                <?= $locations["SP_StoreName"] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <input type="text" class="form-control" id="" readonly value="<?= $location[0]['SP_StoreID'] ?>" name="DI_Location" placeholder="Branch">
                                    <?php endif; ?>                      
                                </select>
                            </div>
                        </div>


                        <!-- PERIOD -->
                        <div class="form-group">
                            <label for="sel1" class="control-label col-xs-5">Period:</label>
                            <div class="col-md-7">                                
                                <input type="text" class="form-control periodPicker" name="DI_Period" placeholder="Period" value="<?= $DI_Period ?>">
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
                                <input type="text" readonly name="DI_Status" class="form-control" placeholder="Status" value="<?= $DI_Status ?>">
                            </div>
                        </div>  
                    </span>                   
                </div>
            </form>

            <hr>

            <div class="row">

                <div class="col-xs-4" id="machine-table-container">
                    <br>

                    <table id="machine-table-header" class="table table-striped" style="table-layout:fixed; margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th>Location</th>
                                <th>Classification</th>
                                <th>Machine Tag</th>
                                <th>Machine Name</th>
                            </tr>
                        </thead>                       
                    </table>
                    <div style="overflow-y:auto; height: 230px;">
                        <table id="machine-table" class="table table-striped" style="table-layout:fixed">
                            <tbody id="machine-table-body">

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-xs-8" id="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="tab" role="presentation"><a href="#tab-content-dispense-ticket" aria-controls="dispense-ticket" role="tab" data-toggle="tab">Dispensed Ticket</a></li>
                        <li class="tab" role="presentation"><a href="#tab-content-pd-items" aria-controls="pd-items" role="tab" data-toggle="tab">PD Items Count</a></li>                       
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab-content-dispense-ticket"></div>
                        <div role="tabpanel" class="tab-pane active" id="tab-content-pd-items"></div>
                    </div>         

                </div>                

            </div>            

        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>js/underscore-min.js"></script>

<script id="machine-row-template" type="text/html">

    <tr data-id="<%= id %>" data-index="<%= index %>" class="machine-table-row">
        <td><%= MC_Location %></td>
        <td><%= MC_MachineClass %></td>
        <td><%= MC_MachineTag %></td>
        <td><%= IM_Sales_Desc %></td>
    </tr>
</script>

<script type="text/javascript">

    (function () {

        var nsId = '<?= $nsId["NS_Id"] ?>';
        var moduleId = "<?= $id ?>";

        var $machinetag;


        var locationsData = <?= json_encode($location) ?>;
        var moduleUrl = base_url + 'app/' + _module + "/" + _class;

        var machineRowTemplate;

        var currentTabIndex = 0;
        var currentCounterFrom = 0;
        var machines;
        var currentMachineIndex = 0;

        var tabIdList = [
            '#tab-content-dispense-ticket',
            '#tab-content-pd-items'
        ];

        var tabViews = [
            'dispenseticket',
            'pditems'
        ];

        $(document).ready(function () {

            initializeTemplates();
            initializeUI();
            initializeEvents();

            //  load initial tab
//            reloadCurrentTab();
            //  set current week no
            var currentlyEditableWeekNo = $("#editable-week-no").val();
            $('select[name=DI_WeekNo]')[0].selectize.setValue(currentlyEditableWeekNo);
        });

        function initializeTemplates() {
            machineRowTemplate = _.template($("script#machine-row-template").html());
        }

        function initializeUI() {

            //  collapse nav bar by default
            $('.navbar-collapse').click();

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
                }
            });

            $('select[name=DI_WeekNo]').selectize({
                sortField: 'text',
                onChange: function (value) {
                    //check if week on detail already exist 
                    // checkWeekRec($('input[name=DI_WeekNo]').val());
                    updateHeader();
                    reloadCurrentTab();

                }
            });

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

            //RETRIEVAL DATE PICKER
            $('input[name=DI_RetrievalDate]').datepicker({
                onClose: function (dateText, inst) {
                    updateHeader();
                    reloadCurrentTab();
                }
            });

        }

        // function checkWeekRec(week){
        //     var url = moduleUrl + "/process";
        //     var data = {
        //         DI_DocNo: $('input[name=DI_DocNo]').val(),
        //         DI_WeekNo: $('select[name=DI_WeekNo]')[0].selectize.getValue(),
        //         DI_RetrievalDate: $('input[name=DI_RetrievalDate]').val(),
        //         type: "checkweek"
        //     };

        //     $.post(url, data, function (response) {
        //         response = JSON.parse(response);


        //         if (response.status == 1) {
        //             //  header updated, just silently continue
        //             console.log("header updated");
        //         } else {
        //             alert("Updating header details failed: " + response.message);
        //         }

        //     });

        // }


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


        function updateHeader() {

            var url = moduleUrl + "/process";
            var data = {
                DI_DocNo: $('input[name=DI_DocNo]').val(),
                DI_WeekNo: $('select[name=DI_WeekNo]')[0].selectize.getValue(),
                DI_RetrievalDate: $('input[name=DI_RetrievalDate]').val(),
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


        function reloadCurrentTab() {
            var location = $('select[name=DI_Location]')[0].selectize.getValue();
            var machineclass = getMachineclass();

            loadMachines(location, machineclass);
            loadTabContents(0);

        }



        function initializeEvents() {
            $('#machine-table').on('click', '.machine-table-row', function (event) {
                $(this).addClass('active').siblings().removeClass('active');
                var id = $(this).data('id');
                var index = $(this).data('index');

                $machinetag = id


                currentMachineIndex = index;
                loadTabContents(id);

            });

            initializeDispenseTicketsEvents();
            initializePDItemsEvents();

            $('.tab').click(function () {
                var tabId = $(this).find('a').attr('href');
                var location = $('select[name=DI_Location]')[0].selectize.getValue();
                currentTabIndex = tabIdList.indexOf(tabId);

                var machineclass = getMachineclass();

                reloadCurrentTab();
            });

            $('#action-finalize').click(function () {

                var url = moduleUrl + "/process";
                var data = {
                    type: 'finalize',
                    docId: moduleId,
                    week: $('select[name=DI_WeekNo]')[0].selectize.getValue()
                };

                $.post(url, data, function (response) {
                    response = JSON.parse(response);
                    console.log(response);

                    if (response.status == 1) {
                        alert("finalized");
                        location.href = moduleUrl;
                    } else {
                        alert(response.message);
                    }

                });
            });

        }


        function reloadCurrentTab() {
            var location = $('select[name=DI_Location]')[0].selectize.getValue();
            var machineclass = getMachineclass();

            loadMachines(location, machineclass);
        }


// DISPENSE TICKET EVENTS
        function initializeDispenseTicketsEvents() {
            // $('body').on('click', '#action-save-machine-dispense-ticket', function () {
            //     saveDispenseTicket();
            // });

            $('body').on('click', '#action-save-and-next-machine-dispense-ticket', function () {
                saveDispenseTicket(true);
            });

            $('body').on('change', '.dispense-ticket-field', function () {
                var lineNo = $(this).data('id');

                refreshDispenseDependentValues(lineNo);
            });

        }

        function refreshDispenseDependentValues(lineNo) {

            var from = $('.issue-beg[data-id=' + lineNo + ']').html();
            var to = $('.issue-end[data-id=' + lineNo + ']').html();

            var reading = $('[data-id=' + lineNo + '][name=DIT_Reading]').val();

            var qtyIssued = 0;
            var remaininng = 0;


            // check if reading is not with in the from and to value
            if (reading < from || reading > to) {
                alert('Invalid series value');
                $('[data-id=' + lineNo + '][name=DIT_Reading]').val(0);
            } else {
                if (reading >= from || reading <= to) {
                    qtyIssued = reading - from + 1;
                } else {
                    qtyIssued = to - from + 1;
                }

                remaininng = to - from + 1 - qtyIssued


                $('.qty-issued[data-id=' + lineNo + ']').html(qtyIssued);
                $('.remaining-qty[data-id=' + lineNo + ']').html(remaininng);
            }


            // check if reading is not with in the from and to value

        }


        //SAVE ONLY DISPENSE
        function saveDispenseTicket(loadNextMachine) {

            var dt = [];
            var retrieval_date = $('input[name=DI_RetrievalDate]').val();


            $('.dispense-ticket-row').each(function () {
                var lineNo = $(this).data('id');
                var remaining = parseInt($('.remaining-qty[data-id=' + lineNo + ']').html());
                var issued = parseInt($('.qty-issued[data-id=' + lineNo + ']').html());
                var from = parseInt($('.issue-beg[data-id=' + lineNo + ']').html());
                var to = parseInt($('.issue-end[data-id=' + lineNo + ']').html());
                var reading = parseInt($('[data-id=' + lineNo + '][name=DIT_Reading]').val());

                // var retdate = datetime($('.retrieval-date[data-id=' + lineNo + ']').html()); 
                // $display_date          = $retdate->format('m/d/Y');

                // console.log(retdate);

                if (issued == reading) {
                    remaining = 0;
                } else if (reading == 0) {
                    remaining = to - from + 1;
                }

                var dtItem = {
                    DIT_LineNo: lineNo,
                    DIT_SerialFrom: parseInt($('.issue-beg[data-id=' + lineNo + ']').html()),
                    DIT_SerialTo: parseInt($('.issue-end[data-id=' + lineNo + ']').html()),
                    DIT_QtyIssued: parseInt($('.qty-issued[data-id=' + lineNo + ']').html()),
                    DIT_Remaining: remaining,
                    DIT_Reading: parseInt($('[data-id=' + lineNo + '][name=DIT_Reading]').val()),
                    DIT_Location: $('select[name=DI_Location]')[0].selectize.getValue(),
                    DIT_DeckNo: $('.deck-no[data-id=' + lineNo + ']').html(),
                    DIT_MachineTag: $machinetag,
                    DIT_RetrievalDate: retrieval_date,
                };

                dt.push(dtItem);
                // totalReadingTo += mrItem.RVMR_ReadingTo;

            });

            var url = moduleUrl + "/saveDispenseTicket";
            var data = {
                entries: JSON.stringify(dt)
            };

            save(url, data, loadNextMachine);

        }
// DISPENSE TICKET EVENTS



// PD ITEMS EVENTS
        function initializePDItemsEvents() {
            // $('body').on('click', '#action-save-machine-dispense-ticket', function () {              
            //     savePDItems();
            // });

            $('body').on('click', '#action-save-and-next-machine-pd-ticket', function () {
                savePDItems(true);
            });

            $('body').on('change', '.pditem-field', function () {
                var lineNo = $(this).data('id');

                refreshPDItemsValues(lineNo);
            });

        }

        //SAVE ONLY PD ITEMS       
        function savePDItems(loadNextMachine) {

            var dt = [];
            var retrieval_date = $('input[name=DI_RetrievalDate]').val();

            $('.pditem-row').each(function () {
                var lineNo = $(this).data('id');
                var itemNo = $(this).data('item-no');
                var beg = parseInt($('.issue-beg[data-id=' + lineNo + ']').html());
                var end = parseInt($('[data-id=' + lineNo + '][name=DIP_End]').val());
                var capture = parseInt($('.issue-capture[data-id=' + lineNo + ']').html());

                var dtItem = {
                    DIP_LineNo: lineNo,
                    DIP_DI_DocNo: $('input[name=DI_DocNo]').val(),
                    DIP_Beg: parseInt(beg),
                    DIP_End: parseInt(end),
                    DIP_Captured: parseInt(capture),
                    DIP_Location: $('select[name=DI_Location]')[0].selectize.getValue(),
                    DIP_MachineTag: $machinetag,
                    DIP_ItemNo: itemNo,
                    DIP_RetrievalDate: retrieval_date
                };

                dt.push(dtItem);
                // totalReadingTo += mrItem.RVMR_ReadingTo;

            });

            var url = moduleUrl + "/savePDItems";
            var data = {
                entries: JSON.stringify(dt)
            };

            save(url, data, loadNextMachine);
        }



        function refreshPDItemsValues(lineNo) {

            var from = parseInt($('.pditem-row .issue-beg[data-id=' + lineNo + ']').html());
            var ending = parseInt($('[data-id=' + lineNo + '][name=DIP_End]').val());
            var additionalIssuances = parseInt($('.additional-issueance[data-id=' + lineNo + ']').html());
            var transferOut = parseInt($('.transfer-out[data-id=' + lineNo + ']').html());

            var captureqty = 0;


            // check if ending over or less than the beginning
            if (ending > from) {
                alert('Invalid series value');
                $('[data-id=' + lineNo + '][name=DIP_End]').val(0);
            } else {

                captureqty = from + additionalIssuances - ending - transferOut;

                $('.issue-capture[data-id=' + lineNo + ']').html(captureqty);
            }



            // check if ending over or less than the beginning

        }



// PD ITEMS EVENTS      

        function save(url, values, loadNextMachine) {

            $.post(url, values, function (response) {
                $('.btn').removeAttr('disabled');
                response = JSON.parse(response);

                if (response.status == 1) {
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





        //get Machine class tab index
        function getMachineclass() {
            var machineclass = 'RM';

            //  switch tabs index
            if (currentTabIndex == 0) {
                machineclass = 'RM';
            } else if (currentTabIndex == 1) {
                machineclass = 'PD';
            }

            return machineclass;
        }

        //INITIALIZE TABS

        //INITIALIZE TABS


        //  ====================================================================
        //  Value Loaders
        //  ====================================================================

        function refreshDocNo() {

            var branch = $('select[name=DI_Location]')[0].selectize.getValue();
            var period = $('input[name=DI_Period]').val();

            var docNo = branch + "-" + nsId + "-" + period;

            $('input[name=DI_DocNo]').val(docNo);

        }



        //  ====================================================================
        //  Dynamic Content Loaders
        //  ====================================================================

        function openNextMachine() {

            if (machines.length > currentMachineIndex) {
                currentMachineIndex++;

                $('.machine-table-row[data-index=' + currentMachineIndex + ']').click();
            } else {
                alert('Saved! This is the last machine, will load next tab instead.');
            }
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

        function loadMachines(location, machineclass) {

            var url = moduleUrl + "/machines";
            url += "?location=" + location;

            currentMachineIndex = 0;

            if (machineclass != '') {
                url += "&machineclass=" + machineclass;
            }

            showMachineTable(true);

            //will call and create machine table filter by location and machine class
            $.get(url, function (response) {
                machines = JSON.parse(response);

                $("#machine-table-body").html('');

                //  build table HTML
                for (var i in machines) {
                    machines[i]['index'] = i;
                    var html = machineRowTemplate(machines[i]);

                    $("#machine-table-body").append(html);
                }

                $('.machine-table-row[data-index=' + currentMachineIndex + ']').click()

            });
            //will call and create machine table filter by location and machine class

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

                var currentlyEditableWeekNo = $("#editable-week-no").val();
                var currentWeekNo = $('select[name=DI_WeekNo]')[0].selectize.getValue();

                if (currentWeekNo != currentlyEditableWeekNo) {
                    //  disable editing
                    $("#action-save-and-next-machine-dispense-ticket").css('display', 'none');
                    $("#action-save-and-next-machine-pd-ticket").css('display', 'none');
                }

            });
        }


        // this is to call the  tab view
        function buildSubViewUrl(view, machineId) {
            var url = moduleUrl + "/" + view;
            url += "?docId=" + moduleId;

            url += "&machineId=" + machineId;
            url += "&week=" + $('select[name=DI_WeekNo]')[0].selectize.getValue();
            url += "&location=" + $('select[name=DI_Location]')[0].selectize.getValue();


            return url;
        }

    })();

</script>