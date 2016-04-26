<?php
if ($CA_DateFrom) {
    $date_from   = date_create($CA_DateFrom);
    $CA_DateFrom = date_format($date_from, "m/d/Y");
}

if ($CA_DateTo) {
    $date_to   = date_create($CA_DateTo);
    $CA_DateTo = date_format($date_to, "m/d/Y");
}
?>


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
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5">Document No.:</label>
                        <div class="col-xs-7">                            
                            <label class="control-label"><?= $CA_DocNo ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Employee Name:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $CA_EmployeeName ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Purpose:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $CA_Purpose ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $CA_Remarks ?></label>
                        </div>
                    </div>
                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Document Date:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $CA_DocDate ?></label>                            
                        </div>
                    </div>
                    <!--Date Needed-->
                    <div class="form-group">
                        <label class="control-label col-xs-5">Date Needed:</label>
                        <div class="col-xs-7">
                            <label class="control-label">From: <?= $CA_DateFrom ?></label>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5"></label>
                        <div class="col-xs-7">
                            <label class="control-label">To: <?= $CA_DateTo ?></label>                            
                        </div>
                    </div>
                    <!--/Date Needed-->
                    <div class="form-group">
                        <label class="control-label col-xs-5">CA Amount:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $CA_Amount ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5">CA Request Status:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $CA_RequestStatus ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">CA Liquidation Status:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $CA_LiquidationStatus ?></label>                            
                        </div> 
                    </div>
                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Company:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $CA_Company ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Location:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $CA_Location ?></label>
                        </div>
                    </div>
                </span>
            </form>
            <div class="details">Details</div>
            <div id="details-data-container" class="container-fluid">
                <?= generate_table($table) ?>
            </div>
            <hr>
            <div>
                <p>
                    <input type="checkbox"> This is to authorize the company to deduct from my salary the above cash advance in the event of failure
                    of my part to liquidate the same within (5) working days from the day of last expense in accordance with the Company's policy on Cash Advance.
                </p>
            </div>
            <div id="signitory">
                <div class="row"><input type="text" class="pull-right" placeholder="e-signiture"></div>
                <div class="row"><input type="text" class="pull-right" placeholder="Full Name"></div>
                <div class="row"><b class="pull-right">____________________</b></div>
                <div class="row"><p class="pull-right">Signature over printed name</p></div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var table = $('#tbl-cash-advance-details').bind('dynatable:init', function (e, dynatable) {
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
</script>
