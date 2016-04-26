
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/jquery.datetimepicker.css"/>

<script type="text/javascript" src="<?= base_url() ?>js/jquery.datetimepicker.full.min.js"></script>

<?php
$editable = $JO_Technician == $U_Username;
$readonly = !$editable ? "readonly" : "";
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
                <div class="row">
                    <span class="col-md-6">
                        <div class="form-group">
                            <label for="sel1" class="control-label col-xs-5">Document No.:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly class="form-control" tabindex="1" name="JO_DocNo" placeholder="Document No." value="<?= $JO_DocNo ?>">
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Reference No.:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly class="form-control" tabindex="2" name="JO_RefNo" placeholder="JO-xxxxxx" value="<?= $JO_RefNo ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Remarks:</label>
                            <div class="col-xs-7">
                                <input type="text" <?= $readonly ?> class="form-control" tabindex="3" name="JO_Remarks" placeholder="Remarks" value="<?= $JO_Remarks ?>">
                            </div>
                        </div>                   
                    </span>
                    <span class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Document Date:</label>
                            <div class="col-xs-7">
                                <input type="text" <?= $readonly ?> readonly class="form-control" tabindex="4" name="JO_DocDate" placeholder="Document Date" value="<?= $JO_DocDate ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Location:</label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control" tabindex="5" readonly value="<?= $JO_Location ?>" name="JO_Location" placeholder="Location">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-5">Company:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly name="JO_Company" tabindex="6" class="form-control" placeholder="Company" value="<?= $JO_Company ?>">
                            </div>
                        </div>
                    </span>
                </div>

                <br>

                <div class="row">
                    <span class="col-md-6">
                        <div class="form-group">
                            <label for="sel1" class="control-label col-xs-5">Item Description:</label>
                            <div class="col-xs-7">                                
                                <input type="text" class="form-control" tabindex="5" readonly value="<?= $JO_ItemDescription ?>" name="JO_ItemDescription">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Asset ID:</label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control" tabindex="5" readonly value="<?= $JO_AssetID ?>" name="JO_AssetID">                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Item No:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly class="form-control" tabindex="9" name="JO_ItemNo" value="<?= $JO_ItemNo ?>">
                            </div>
                        </div>                   
                    </span>
                    <span class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Nature of Defect:</label>
                            <div class="col-xs-7">
                                <input <?= $readonly ?> type="text" class="form-control" tabindex="10" name="JO_NatureOfDefect" value="<?= $JO_NatureOfDefect ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Job Needed:</label>
                            <div class="col-xs-7">
                                <select <?= $readonly ?> class="form-control select-cli" tabindex="11" name="JO_JobNeeded">
                                    <option value="" disabled selected>Reason</option>
                                    <?php foreach ($reasons AS $reason): ?>
                                        <?php $selected = $reason["RM_FK_Reason_id"] == $JO_JobNeeded ? "selected" : "" ?>
                                        <option value="<?= $reason["RM_FK_Reason_id"] ?>" <?= $selected ?>>
                                            <?= $reason["R_Description"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-5">Technician:</label>
                            <div class="col-xs-7">
                                <input type="text" readonly name="" tabindex="12" class="form-control" value="<?= $JO_Technician ?>">
                            </div>
                        </div>
                    </span>
                </div>

                <br>

                <div class="row">
                    <span class="col-md-6">
                        <div class="form-group">
                            <label for="sel1" class="control-label col-xs-5">Date Down:</label>
                            <div class="col-xs-7">                                
                                <input readonly type="text" class="form-control datetimepicker" tabindex="13" name="JO_DateDown" placeholder="Date Down" value="<?= $JO_DateDown ?>">
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Date Operational:</label>
                            <div class="col-xs-7">
                                <input <?= $readonly ?> type="text" class="form-control datetimepicker" tabindex="14" name="JO_DateOperational" placeholder="Date Operational" value="<?= $JO_DateOperational ?>">
                            </div>
                        </div>
                    </span>
                    <span class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Downtime Days:</label>
                            <div class="col-xs-7">
                                <input <?= $readonly ?> type="text" readonly class="form-control" tabindex="15" name="JO_DowntimeDays" value="<?= $JO_DowntimeDays ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Status:</label>
                            <div class="col-xs-7">
                                <input <?= $readonly ?> type="text" readonly class="form-control" tabindex="16" name="JO_Status" value="<?= $JO_Status ?>">
                            </div>
                        </div>                        
                    </span>
                </div>

            </form>

            <hr>

            <div id="tbl-details" class="grid-table"></div>

            <hr>

            <div id="details-data-container" class="container-fluid">
                <?= generate_table($dmr_table) ?>
            </div>
            <hr>

            <div class="btn-cont">                
                <a id="action-update-close" tabindex="12" type="button" href="#" class="btn btn-default form-btn main-clr">
                    Save
                </a>
                <a type="button" tabindex="13" href="<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>/" class="btn btn-default form-btn sub-clr">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    (function () {

        var detailTable;

        var currentUser = "<?= $U_Username ?>";

        $(document).ready(function () {

            initializeUI();

            detailTable = initializeDetailTable();

            var moduleProcessor = new ModuleProcessor({
                isTransactionModule: true,
                detailTable: detailTable,
                processDetailsData: processDetailsData
            });

            moduleProcessor.initialize();

        });

        function initializeUI() {

            $('select[name=JO_JobNeeded]').selectize();

            $('.datetimepicker').datetimepicker({
                format: 'm/d/Y h:i A',
                onClose: function (currentTime) {
                    refreshDowntimeDays();
                }
            });

        }

        function initializeDetailTable() {
            return $('#tbl-details').gridEntry({
                tableData: <?= json_encode($details['data']) ?>,
                gridConfig: {
                    minSpareRows: 1,
                    colHeaders: [
                        "Date",
                        "Action Taken",
                        "Technician"
                    ],
                    colWidths: [30, 120],
                    columns: [
                        {
                            data: "JOD_Date",
                            type: 'date',
                            dateFormat: 'MM/DD/YYYY',
                            correctFormat: true
                        },
                        {
                            data: "JOD_ActionTaken",
                            renderer: emptyRenderer
                        }, {
                            data: "JOD_UserID",
                            renderer: userIdRenderer
                        }
                    ]
                }
            });
        }

        function userIdRenderer(instance, td, row, col, prop, value, cellProperties) {

            cellProperties.readOnly = false;

            if (row == instance.countRows() - 1) {
                td.innerText = '';
                value = null;
                return;
            } else {
                td.innerText = currentUser;
                value = currentUser;
            }

            Handsontable.renderers.TextRenderer.apply(this, arguments);
        }

        function processDetailsData(details) {

            var processableDetails = [];

            for (var i in details) {
                if (details[i]["JOD_Date"]) {
                    details[i]["JOD_UserID"] = currentUser;
                    processableDetails.push(details[i]);
                }
            }

            return JSON.stringify(processableDetails);
        }

        function refreshDowntimeDays() {
            var dateDown = $('input[name=JO_DateDown]').datetimepicker('getValue');
            var dateOperational = $('input[name=JO_DateOperational]').datetimepicker('getValue');

            if (dateDown && dateOperational) {
                var timeDiff = Math.abs(dateDown.getTime() - dateOperational.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                //  If [Downtime Days] is less than 2, [Downtime Days] = 0
                if (diffDays < 2) {
                    diffDays = 0;
                }

                $('input[name=JO_DowntimeDays]').val(diffDays);
            }

        }

        $('#tbl-defective-machine-report-details').bind('dynatable:init', function (e, dynatable) {
            $('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");

            $(document).on('click', '.det-delete', function (e) {
                e.preventDefault();

                _this = $(this);
                confirm("Delete Record?", function (confirmed) {
                    if (confirmed) {
                        $.post(base_url + 'app/' + _module + "/" + _class + '/process', {id: _this.data('id'), type: 'delete-details'}, function (data) {
                            if (data == 1) {
                                alert('Deleted!');
                                setTimeout(function () {
                                    dynatable.process();
                                }, 500);
                            } else {
                                alert('Failed!');
                            }
                        }).error(function () {
                            alert('Error!');
                        });
                    }
                });
            });

            $(document).on('click', '.det-update', function (e) {
                e.preventDefault();
                window.location = base_url + 'app/' + _module + "/" + _class + '/view/update/?id=' + $(this).data('id');
            });

            $(document).on('click', '.det-add', function (e) {
                e.preventDefault();
                window.location = base_url + 'app/' + _module + "/" + _class + '/view/add/?id=' + $(this).data('id');
            });

            $('.clear').on('click', function () {
                dynatable.sorts.clear();
                dynatable.queries.remove("search");
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
                ajaxUrl: base_url + "app/" + _module + "/defective-machine-report/details_data/?dmrDocNo=" + "<?= $JO_RefNo ?>",
                ajaxOnLoad: true,
                records: []
            },
            features: {
                pushState: false,
            },
            inputs: {
                processingText: '<img  id="loader" src="' + base_url + 'css/assets/data_loader.gif" />'
            }
        }).data('dynatable');

    })();

</script>