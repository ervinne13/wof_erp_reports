<style>
    .selectize-dropdown {
        z-index: 99999999 !important
    }
</style>

<div class="panel">
    <div class="panel-heading">
        <h5 class="panel-title"><?= $title ?></h5>
    </div>
    <div class="panel-body">

        <div class="actions-container row">
            <span class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-xs-5">Show:</label>
                    <div class="col-xs-7">
                        <select class="form-control select-cli per-page-count-filter" name="per-page-count-filter">
                            <option value="15"> 15</option>
                            <option value="30"> 30</option>
                            <option value="50"> 50</option>
                            <option value="100">100</option>
                            <option value="9999">ALL</option>
                        </select>
                    </div>
                </div>
            </span>
            <span class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-xs-5">Location Filter:</label>
                    <div class="col-xs-7">
                        <select class="form-control select-cli location-filter" name="location-filter" placeholder="Location">
                            <?php if (count($user_locations) > 1): ?>
                                <option value="" disabled selected>Location</option>
                                <?php foreach ($user_locations AS $location): ?>                                        
                                    <option value="<?= $location["SP_StoreID"] ?>">
                                        <?= $location["SP_StoreName"] ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <input type="text" class="form-control" readonly value="<?= $user_locations[0]['SP_StoreID'] ?>" name="TO_TransferTo" placeholder="Transfer To">
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </span>
            <span class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-xs-5">Company Filter:</label>
                    <div class="col-xs-7">                        
                        <select class="form-control select-cli company-filter" name="company-filter" placeholder="Company">
                            <option value="" disabled selected>Location</option>
                            <?php foreach ($companies AS $company): ?>                                        
                                <option value="<?= $company["COM_Id"] ?>">
                                    <?= $company["COM_Name"] ?>
                                </option>
                            <?php endforeach; ?>                            
                        </select>
                    </div>
                </div>
            </span>
        </div>

        <br>
        <legend>Incoming</legend>
        <div id="data-to-incoming-container" class="container-fluid">            
            <?= generate_table($incoming_to_table) ?>
        </div>
        <legend>Outgoing</legend>
        <div id="data-to-outgoing-container" class="container-fluid">            
            <?= generate_table($outgoing_to_table) ?>
        </div>
        <legend>Pending RQ</legend>
        <div id="data-to-outgoing-container" class="container-fluid">            
            <?= generate_table($pending_rq_to_table) ?>
        </div>
    </div>
</div>

<script id="template-date-filter" type="text/html">
    Date Filter: 
    <input type="search" data-dynatable-query="date-from" name="date-from" class="date-filter date-from"/>
    <input type="search" data-dynatable-query="date-to" name="date-to" class="date-filter date-to"/> 
</script>

<script type="text/javascript">

    (function () {

        var userLocationsData = <?= json_encode($user_locations) ?>;
        var userCompaniesData = <?= json_encode($companies) ?>;
        var defaultLocation = userLocationsData[0]["SP_StoreID"];


        var url = window.location.href;
        var split = url.split("/");

        var moduleHeader = split[5];

        var paginationEnabled = <?= $pagination ?>;

        $(document).ready(function () {

//        alert(paginationEnabled);

            var incomingAjaxURL = base_url + "app/" + moduleHeader + "/transfer-order-local/data?type=incoming";
            var outgoingAjaxURL = base_url + "app/" + moduleHeader + "/transfer-order-local/data?type=outgoing";
            var pendingRQAjaxURL = base_url + "app/" + moduleHeader + "/transfer-order-local/pendingRQ";

            var incomingDataTable = setupTable('tbl-to-incoming', incomingAjaxURL);
            var outgoingDataTable = setupTable('tbl-to-outgoing', outgoingAjaxURL);
            var pendingRQDataTAble = setupTable('tbl-to-pending-rq', pendingRQAjaxURL);

            $('.per-page-count-filter').selectize({
                sortField: 'text',
                onChange: function (value) {
                    incomingDataTable.paginationPerPage.set(value);
                    outgoingDataTable.paginationPerPage.set(value);
                    pendingRQDataTAble.paginationPerPage.set(value);

                    incomingDataTable.process();
                    outgoingDataTable.process();
                    pendingRQDataTAble.process();
                }
            });

            $('.location-filter').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in userLocationsData) {
                        if (userLocationsData[i]["SP_StoreID"] == value) {
                            var companyName = userLocationsData[i]["COM_Name"];
                            console.log(companyName);
                            console.log(value);

                            if (value === "") {
                                incomingDataTable.queries.remove("location");
                                outgoingDataTable.queries.remove("location");
                                pendingRQDataTAble.queries.remove("location");
                            } else {
                                incomingDataTable.queries.add("location", value);
                                outgoingDataTable.queries.add("location", value);
                                pendingRQDataTAble.queries.add("location", value);
                            }

                            incomingDataTable.process();
                            outgoingDataTable.process();
                            pendingRQDataTAble.process();
                        }
                    }
                }
            });

            $('.company-filter').selectize({
                sortField: 'text',
                onChange: function (value) {
                    for (var i in userCompaniesData) {
                        if (userCompaniesData[i]["COM_Id"] == value) {
                            if (value === "") {
                                incomingDataTable.queries.remove("company");
                                outgoingDataTable.queries.remove("company");
                                pendingRQDataTAble.queries.remove("company");
                            } else {
                                incomingDataTable.queries.add("company", value);
                                outgoingDataTable.queries.add("company", value);
                                pendingRQDataTAble.queries.add("company", value);
                            }

                            incomingDataTable.process();
                            outgoingDataTable.process();
                            pendingRQDataTAble.process();
                        }
                    }
                }
            });

        });

        function setupTable(tableName, ajaxURL) {
            return $('#' + tableName).bind('dynatable:init', function (e, dynatable) {
                var dateFilter = $('#template-date-filter').html();
                var locationAndCompanyFilter = $('#template-location-and-company-filter').html();
                $('#dynatable-search-' + tableName)
                        .prepend(dateFilter)
                        .prepend(locationAndCompanyFilter)
                        .append("<a  href='javascript:void(0)' class='clear'>Clear</a>");

                $('#dynatable-search-' + tableName + ' > .date-from').on('change', function () {
                    var value = $(this).val();
                    if (value === "") {
                        dynatable.queries.remove("date-from");
                    } else {
                        dynatable.queries.add("date-from", value);
                    }
                    console.log(dynatable);

                    dynatable.process();
                });

                $('#dynatable-search-' + tableName + ' > .date-to').on('change', function () {
                    var value = $(this).val();
                    if (value === "") {
                        dynatable.queries.remove("date-to");
                    } else {
                        dynatable.queries.add("date-to", value);
                    }
                    dynatable.process();
                });

                $("#dynatable-search-" + tableName + " > .date-filter").datepicker({dateFormat: 'mm-dd-yy'}).mask("99-99-9999");

                $('.clear').on('click', function () {
                    dynatable.sorts.clear();
                    dynatable.queries.remove("search");
                    dynatable.queries.remove("date-from");
                    dynatable.queries.remove("date-to");
                    $('[type=search]').val('');
                    $(".dynatable-arrow").remove();
                    dynatable.process();
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
                    ajaxUrl: ajaxURL,
                    ajaxOnLoad: true,
                    records: []
                },
                features: {
                    pushState: false,
//                    paginate: paginate
                    paginate: false
                },
                inputs: {
                    processingText: '<img id="loader" src="' + base_url + 'css/assets/data_loader.gif" />'
                }
            }).data('dynatable');
        }

    })();


</script>