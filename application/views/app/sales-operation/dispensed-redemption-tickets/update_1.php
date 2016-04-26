
<style>
    .machine-table-row {
        cursor: pointer;
    }

    .table > thead > tr > td.active, .table > tbody > tr > td.active, .table > tfoot > tr > td.active, .table > thead > tr > th.active, .table > tbody > tr > th.active, .table > tfoot > tr > th.active, .table > thead > tr.active > td, .table > tbody > tr.active > td, .table > tfoot > tr.active > td, .table > thead > tr.active > th, .table > tbody > tr.active > th, .table > tfoot > tr.active > th {
        background-color: #F78B3E !important;
        color: white !important; 
    }

</style>

<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>          	
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
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
								  	<?php if(!empty($branch['data'])){
										foreach ($branch['data'] as $key => $value) 											
									{
								  	?>
								  	<!-- auto fill the dropdownbox the default location -->								  	
								  	<option value="<?=$value['SP_StoreID']?>" 								  	
									  	<?=$this->session->userdata('dlocation')['SP_StoreID'] == ($value['SP_StoreID']) ? 'selected' : '' ?> ><?=$value['SP_StoreName']?></option>									
								  	<?php }} ?>
									  	
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
			            <div class="col-md-7">					  
						  <select type="text" class="form-control weekselect" id="" name="DI_WeekNo" data-type='filterbyWeek' tabindex="4" placeholder="Week">
						    <option value="">Select Week</option>
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
			                <input type="text" class="form-control" id="" maxlength="30" readonly value="<?=date("m/d/Y",time())?>" disabled name="DI_DocDate" placeholder="Document Date">
			              </div>
			          </div>

			        <!-- RETRIEVAL DATE -->
		            <div class="form-group">
		              <label for="sel1" class="control-label col-xs-5">Retrival Date:</label>
		              <div class="col-xs-7">
		                <input type="text" class="form-control retDate" id="retDate" maxlength="30" tabindex="2"  readonly value="<?=$retrieval_date_display?>" name="Retdate" placeholder="Retrival Date">
		              </div>
					</div>

			          <!-- COMPANY -->
			         <div class="form-group">
					     <label class="control-label col-xs-5" for="">Company:</label>
					     <div class="col-xs-7">
					       <input type="text" class="form-control" id="com_id" readonly value="<?=count($location) == 1 ? $location[0]['COM_Name']: $dcompany ?>" name="DI_Company" placeholder="Company">
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
			<hr>

			<!-- MACHINE GRID -->
			<span class="col-md-6"> 
			<!-- class = "grid table fixing the sizeview of grid -->
			<div id="tblINV-Machine" class="grid-table"> 

			</div>
			</span>
			<!-- MACHINE GRID -->

		


                <div class="row">
                    <div class="col-xs-4" id="machine-table-container">
                        <br>

                        <!-- MACHINE ITEM HEADER -->
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

                    <!-- TAB -->
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
                    <!--TAB  -->

                </div> 

		
			
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url() ?>js/underscore-min.js"></script>


<!-- MACHINE ITEM -->
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

        var moduleId = "<?= $id ?>";

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
            'pdItems'
        ];

        $(document).ready(function () {
            <?php echo ("12"); ?>
            initializeTemplates();
            initializeUI();
            // initializeEvents();

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


            $('.tab').click(function () {
                var tabId = $(this).find('a').attr('href');
                var location = $('select[name=DI_Location]')[0].selectize.getValue();
                currentTabIndex = tabIdList.indexOf(tabId);

                var medium = getMedium();

                //  machines can only be mediums 0 - 4
                if (medium <= 4) {
                    loadMachines(location, medium);
                } else {
                    showMachineTable(false);
                    loadTabContents(0);
                }
            });

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


        
        function createDispense() {
            var data = {};

            data.DI_DocNo = $('input[name=DI_DocNo]').val();
            data.DI_DocDate = $('input[name=DI_DocDate]').val();
            data.DI_Location = $('select[name=DI_Location]')[0].selectize.getValue();
            data.DI_Period = $('input[name=DI_Period]').val();
            data.DI_Company = $('input[name=DI_Company]').val();
            // data.Retdate = $('input[name=Retdate]').val();

            data.type = "create";

            var url = moduleUrl + "/process";

            $.post(url, data, function (generatedId) {
                console.log(generatedId);

                location.href = moduleUrl + "/update?id=" + generatedId;

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

            var lineNo = $('#current-token-line-no').attr('content');

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

            var lineNo = $('#current-token-line-no').attr('content');

            var rt = {
                RVPC_LineNo: lineNo,
                RVPC_CounterFrom: $('input[name=RVPC_CounterFrom]').val(),
                RVPC_CounterTo: $('input[name=RVPC_CounterTo]').val(),
                RVPC_QtyRetrieved: qtyRetrieved,
                RVPC_PisoToken: $('input[name=RVPC_PisoToken]').val(),
                RVPC_MTC: $('input[name=RVPC_MTC]').val(),
                RVPC_Remarks: $('input[name=RVPC_Remarks]').val()
            };

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

                $('.machine-table-row[data-index=' + currentMachineIndex + ']').click()

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