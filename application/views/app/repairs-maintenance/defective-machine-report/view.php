<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
            <a class="cls-btn pull-right" href="<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>" >
                Close
            </a>
            <?php if ($functions): ?>
                <span class="dropdown pull-right">
                    <a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        Functions
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu functions" role="menu" aria-labelledby="dropdownMenu1">
                        <li>
                            <?= $functions ?>
                        </li>
                    </ul>
                </span>
            <?php endif ?>
        </h3>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">
            <form class="form-horizontal row page-form" role="form" class="container-fluid">
                <div class="row">
                    <span class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-xs-5">Document No.:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_DocNo ?></label>                                
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Reference No.:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_RefNo ?></label>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Remarks:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_Remarks ?></label>                                
                            </div>
                        </div>                   
                    </span>
                    <span class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Document Date:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_DocDate ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Location:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_Location ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Company:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_Company ?></label>
                            </div>
                        </div>
                    </span>
                </div>

                <br>

                <div class="row">
                    <span class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-xs-5">Item Description:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_ItemDescription ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Asset ID:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_AssetID ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Item No:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_ItemNo ?></label>
                            </div>
                        </div>                   
                    </span>
                    <span class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Nature of Defect:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_NatureOfDefect ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Job Needed:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_JobNeeded ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Technician:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_Technician ?></label>
                            </div>
                        </div>
                    </span>
                </div>

                <br>

                <div class="row">
                    <span class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-xs-5">Date Down:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_DateDown ?></label>
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Date Operational:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_DateOperational ?></label>
                            </div>
                        </div>
                    </span>
                    <span class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-xs-5" for="">Downtime Days:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_DowntimeDays ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-xs-5">Status:</label>
                            <div class="col-xs-7">
                                <label class="control-label"><?= $DMR_Status ?></label>
                            </div>
                        </div>                        
                    </span>
                </div>
            </form>
            <div class="details">Details</div>
            <div id="details-data-container" class="container-fluid">
                <?= generate_table($table) ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(function () {
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
                ajaxUrl: base_url + "app/" + _module + "/" + _class + "/details_data/?id=" + "<?= $this->input->get('id') ?>",
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