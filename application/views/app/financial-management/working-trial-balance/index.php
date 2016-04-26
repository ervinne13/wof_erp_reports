
<style>
    table thead tr th {
        text-align: center;
    }
    table thead tr.data {
        display:none;
    }

    .ui-datepicker-calendar {
        display: none;
    }

    input {
        height: 20px !important;
    }

</style>

<div class="panel">
    <div class="panel-heading">
        <h5 class="panel-title"><?= $title ?>
            <span class="dropdown pull-right">
                <a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    Functions
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu wtb-functions" role="menu" aria-labelledby="dropdownMenu1">
                    <li><a href="" id="print">Print</a></li>
                    <li><a href="" id="close-book">Close Book</a></li>
                </ul>
            </span>
        </h5>     
    </div>
    <div class="panel-body">
        <div class="row form-horizontal">
       <!--<input type="search" id="dynatable-query-search-tbl-working-trial-balance" data-dynatable-query="search">-->
            <div class="col-md-4">
                <label class="col-md-3">Company:</label>
                <div class="col-md-9">                    
                    <select type="search" id="select-company" class="select-company" tabindex="1">
                        <option value="" disabled selected></option>
                        <?php foreach ($companies AS $company): ?>                                                                
                            <option value="<?= $company["COM_Id"] ?>">
                                <?= $company["COM_Name"] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <label class="col-md-3">Period:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control month-year-picker" id="period" tabindex="2">                    
                </div>
            </div>
            <div class="col-md-4">
                <a href="javascript:void(0)" id="action-toggle-lock" data-locked="0">Lock</a>
                <img id="lock-loading" src="<?= base_url() ?>img/loading.gif" alt="Loading ..." style="display: none;">
                <a href="javascript:void(0)" class='clear'>Clear</a>
            </div>
        </div>

        <br>
        <div id="data-container" class="container-fluid">
            <table class='table table-striped table-hover table-bordered table-condensed dynatable' id="tbl-working-trial-balance">
                <thead>
                    <tr class="data">
                        <th rowspan="2" data-dynatable-column="COA_Account_id" data-dynatable-no-sort="true">Account Code</th>
                        <th rowspan="2" data-dynatable-column="COA_AccountName" data-dynatable-no-sort="true" style="text-align: left;">Account Name</th>
                        <th rowspan="2" data-dynatable-column="GL_Beginning_Balance" data-dynatable-no-sort="true">Beginning Balance</th>
                        <!--Disbursement-->
                        <th data-dynatable-column="GL_Disbursement_Debit" data-dynatable-no-sort="true">Debit</th>
                        <th data-dynatable-column="GL_Disbursement_Credit" data-dynatable-no-sort="true">Credit</th>
                        <!--Cash Receipt-->
                        <th data-dynatable-column="GL_Cash_Receipt_Debit" data-dynatable-no-sort="true">Debit</th>
                        <th data-dynatable-column="GL_Cash_Receipt_Credit" data-dynatable-no-sort="true">Credit</th>
                        <!--General Journal-->
                        <th data-dynatable-column="GL_General_Journal_Debit" data-dynatable-no-sort="true">Debit</th>
                        <th data-dynatable-column="GL_General_Journal_Credit" data-dynatable-no-sort="true">Credit</th>
                        <!--Sales-->
                        <th data-dynatable-column="GL_Sales_Debit" data-dynatable-no-sort="true">Debit</th>
                        <th data-dynatable-column="GL_Sales_Credit" data-dynatable-no-sort="true">Credit</th>
                        <!--Total-->
                        <th data-dynatable-column="GL_Debit" data-dynatable-no-sort="true">Debit</th>
                        <th data-dynatable-column="GL_Credit" data-dynatable-no-sort="true">Credit</th>
                        <th rowspan="2" data-dynatable-column="GL_Ending_Balance" data-dynatable-no-sort="true">Ending Balance</th>                        
                    </tr>
                    <tr>
                        <th rowspan="2">Account Code</th>
                        <th rowspan="2">Account Name</th>
                        <th rowspan="2">Beginning Balance</th>
                        <th colspan="2">Disbursement</th>
                        <th colspan="2">Cash Receipt</th>
                        <th colspan="2">General Journal</th>
                        <th colspan="2">Sales</th>
                        <th colspan="2">Total</th>
                        <th rowspan="2">Ending Balance</th>                        
                    </tr>
                    <tr>                      
                        <!--Disbursement-->
                        <th>Debit</th>
                        <th>Credit</th>
                        <!--Cash Receipt-->
                        <th>Debit</th>
                        <th>Credit</th>
                        <!--General Journal-->
                        <th>Debit</th>
                        <th>Credit</th>
                        <!--Sales-->
                        <th>Debit</th>
                        <th>Credit</th>
                        <!--Total-->
                        <th>Debit</th>
                        <th>Credit</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">

    (function () {

        var currentlyAvailableCompanies = <?= json_encode($companies) ?>;

        var currentURL = base_url + "app/" + _module + "/" + _class;
        var dataURL = base_url + "app/" + _module + "/" + _class + "/data";

        var table;

        var currentlySelectedMonth = null;
        var currentlySelectedYear = null;
        var currentlySelectedCompany = null;
        var currentlySelectedCompanyLockDate = null;

        $(document).ready(function () {
            initializeUI();
            initializeEvents();
        });

        function initializeUI() {
            table = $('.dynatable').bind('dynatable:init', function (e, dynatable) {
                $('.dynatable-search').html('');

                $('.clear').on('click', function () {
                    dynatable.sorts.clear();
                    dynatable.queries.remove("search");
                    $('[type=search]').val('');
                    $(".dynatable-arrow").remove();
                    dynatable.process();
                });

                $('.month-year-picker').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'MM yy',
                    onClose: function (dateText, inst) {
                        currentlySelectedMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        currentlySelectedYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).datepicker('setDate', new Date(currentlySelectedYear, currentlySelectedMonth, 1));
//                        refreshTableWithPeriod();
                        updateLockStatus();
                        refreshFilteredTable(currentlySelectedCompany);
                    }
                });

                $('#select-company').selectize({
                    sortField: 'text',
                    onChange: function (value) {

                        for (var i in currentlyAvailableCompanies) {
                            if (currentlyAvailableCompanies[i]["COM_Id"] == value) {
                                currentlySelectedCompanyLockDate = currentlyAvailableCompanies[i]["COM_LockDate"];
                                updateLockStatus();
                            }
                        }

                        refreshFilteredTable(value);
                    }
                });

                $(this).wrap('<div class="table-container"></div>')
                var $demo1 = $(this);
                $demo1.floatThead({
                    scrollContainer: function ($table) {
                        return $table.closest('.table-container');
                    }
                });
            }).bind('dynatable:afterUpdate', function (e, dynatable) {
                $('[data-toggle="tooltip"]').tooltip();
            }).bind('dynatable:ajax:success', function (e, dynatable) {
                $(this).floatThead('reflow');
            }).dynatable({
                dataset: {
                    ajax: true,
                    ajaxUrl: dataURL,
                    ajaxOnLoad: true,
                    records: []
                },
                features: {
                    pushState: false,
                    paginate: false
                },
                inputs: {
                    processingText: '<img  id="loader" src="' + base_url + 'css/assets/data_loader.gif" />'
                },
                table: {
                    headRowSelector: 'thead tr.data'
                }
            }).data('dynatable');

        }

        function initializeEvents() {
            $('.wtb-functions li a').click(function (e) {
                e.preventDefault();

                var _this = $(this);

                confirm(_this.text() + '?', function (confirmed) {
                    if (confirmed) {
                        switch (_this.attr('id')) {
                            case 'print':
                                popup(addPeriodToGetRequest(currentURL + '/print_document'), '800', '800');
                                break;
                            case 'close-book':
                                closeBook();
                                break;
                        }
                    }
                });
            });

            $('#action-toggle-lock').click(function (e) {
                e.preventDefault();

                toggleLock($(this).data('locked'));
            });

        }

//        function refreshTableWithPeriod() {
//            table.settings.dataset.ajaxUrl = addPeriodToGetRequest(dataURL);
//            table.process();
//        }

        /*
         * Refreshes the table with filters company and period
         */
        function refreshFilteredTable(company) {
            currentlySelectedCompany = company;
            var url = addCompanyToGetRequest(dataURL);
            url = addPeriodToGetRequest(url);

            table.settings.dataset.ajaxUrl = url;
            table.process();
        }

        function addCompanyToGetRequest(originalURL) {
            if (currentlySelectedCompany != null && currentlySelectedCompany != '') {

                if (originalURL.indexOf("?") >= 0) {
                    return originalURL + "&company=" + currentlySelectedCompany;
                } else {
                    return originalURL + "?company=" + currentlySelectedCompany;
                }

            } else {
                return originalURL;
            }
        }

        function addPeriodToGetRequest(originalURL) {
            if (currentlySelectedMonth != null && currentlySelectedYear) {

                var currentMonth = parseInt(currentlySelectedMonth) + 1;
                var nextMonth = parseInt(currentlySelectedMonth) + 2;

                var dateFrom = currentlySelectedYear + "-" + pad(currentMonth, 2) + "-1";
                var dateTo = currentlySelectedYear + "-" + pad(nextMonth, 2) + "-1";

                if (originalURL.indexOf("?") >= 0) {
                    return originalURL + "&dateFrom=" + dateFrom + "&dateTo=" + dateTo;
                } else {
                    return originalURL + "?dateFrom=" + dateFrom + "&dateTo=" + dateTo;
                }
            } else {
                return originalURL;
            }
        }

        function pad(numberToPad, width, padding) {
            padding = padding || '0';
            numberToPad = numberToPad + '';
            return numberToPad.length >= width ? numberToPad : new Array(width - numberToPad.length + 1).join(padding) + numberToPad;
        }

        function closeBook() {

            if (!(currentlySelectedMonth && currentlySelectedYear)) {
                alert("Please select period");
                return;
            }

            var currentMonth = parseInt(currentlySelectedMonth) + 1;
            var nextMonth = parseInt(currentlySelectedMonth) + 2;

            var dateFrom = currentlySelectedYear + "-" + pad(currentMonth, 2) + "-1";
            var dateTo = currentlySelectedYear + "-" + pad(nextMonth, 2) + "-1";

            var url = currentURL + "/process";
            var params = {
                date_from: dateFrom,
                date_to: dateTo,
                type: 'close-book'
            };

            $.post(url, params, function (response) {

                try {
                    response = JSON.parse(response);
                } catch (e) {
                    console.error("Unparsable response: " + response + ". " + e);
                }

                console.log(response);

                if (response.status) {
                    alert("success");
                    location.reload();
                } else {
                    if (response.message) {
                        alert(response.message);
                    } else {
                        alert('Failed');
                    }
                }
            });

        }

        function updateLockStatus() {

            var isUnlocked = true;

            if (currentlySelectedCompanyLockDate) {
                var lockDateData = extractMonthAndYearFromDate(currentlySelectedCompanyLockDate);
                isUnlocked = currentlySelectedYear >= lockDateData.year && (parseInt(currentlySelectedMonth) + 1) > lockDateData.month;
            }

            if (isUnlocked) {
                $('#action-toggle-lock').html('Lock');
                $('#action-toggle-lock').attr('data-locked', 0);
            } else {
                $('#action-toggle-lock').html('Unlock');
                $('#action-toggle-lock').attr('data-locked', 1);
            }
        }

        function extractMonthAndYearFromDate(dateString) {
            //  assumes yyyy-mm-dd format
            var splittedDate = dateString.split("-");

            return {
                year: splittedDate[0],
                month: splittedDate[1]
            };

        }

        function toggleLock(isLocked) {

            if (!currentlySelectedCompany) {
                alert('Specify company!');
                return;
            }

            if (currentlySelectedMonth == null || !currentlySelectedYear) {
                alert('Specify lock period!');
                return;
            }

            var url = base_url + "app/" + _module + "/" + _class + "/toggle_lock";
            var params = {
                locked: isLocked,
                company: currentlySelectedCompany,
                month: currentlySelectedMonth,
                year: currentlySelectedYear
            };

            $.post(url, params, function (response) {
                console.log(response);
                showLockToggleButton(true);

                response = JSON.parse(response);

                if (response.status == 1) {
                    if (isLocked) {
                        alert("Unlock success!");
                    } else {
                        alert("Lock success!");
                    }

                    setTimeout(function () {
                        location.reload();
                    }, 3000);

                } else {
                    if (response.message) {
                        alert("Failed! " + response.message);
                    } else {
                        alert("Failed!");
                    }
                }

            });

            showLockToggleButton(false);
        }

        function showLockToggleButton(enable) {
            if (enable) {
                $('#action-toggle-lock').css('display', 'inline');
                $('#lock-loading').css('display', 'none');
            } else {
                $('#action-toggle-lock').css('display', 'none');
                $('#lock-loading').css('display', 'inline');
            }
        }

    })();

</script>