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
                        <label class="control-label col-xs-5">Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="1" name="CA_DocNo" placeholder="Document No." value="<?= $CA_DocNo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Employee Name:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="2" name="CA_EmployeeName" placeholder="Employee Name" value="<?= $CA_EmployeeName ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Purpose:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="3" name="CA_Purpose" value="<?= $CA_Purpose ?>">                               
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="4" name="CA_Remarks" placeholder="Remarks" value="<?= $CA_Remarks ?>">
                        </div>
                    </div>
                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="5" name="CA_DocDate" placeholder="Document Date." value="<?= $CA_DocDate ?>">
                        </div>                        
                    </div>
                    <!--Date Needed-->
                    <div class="form-group">
                        <label class="control-label col-xs-5">Date Needed:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="6" name="CA_DateFrom" placeholder="From" value="<?= $CA_DateFrom ?>">                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5"></label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="7" name="CA_DateTo" placeholder="To" value="<?= $CA_DateTo ?>">
                        </div>
                    </div>
                    <!--/Date Needed-->
                    <div class="form-group">
                        <label class="control-label col-xs-5">CA Amount:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="8" name="CA_Amount" placeholder="Amount" value="<?= $CA_Amount ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5">CA Request Status:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="9" name="CA_RequestStatus" placeholder="CA Request Status" value="<?= $CA_RequestStatus ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">CA Liquidation Status:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly class="form-control" tabindex="10" name="CA_LiquidationStatus" placeholder="Liquidation Request Status" value="<?= $CA_LiquidationStatus ?>">
                        </div> 
                    </div>
                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Company:</label>
                        <div class="col-xs-7">
                            <input type="text" readonly name="CA_Company"  tabindex="11" class="form-control" placeholder="Company" value="<?= $CA_Company ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Location:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" readonly value="<?= $CA_Location ?>" name="CA_Location" placeholder="Location">                                
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Liquidation Amount:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" readonly value="<?=$CA_LiquidationAmount?>" name="" placeholder="Liquidation Amount">                                
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Excess CA:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" readonly value="<?=$CA_LiquidationAmount ? $excess : ''?>" name="" placeholder="Excess CA">                                
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">PR No. / ATD No.:</label>
                        <div class="col-xs-7">
                        <?php if($CA_LiquidationAmount ){?>
                            <label class="control-label" for="">
                                <a href="#" id="CA_ATDNo" data-type="text" data-pk="<?=$CA_DocNo?>" data-url="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/process" data-title="PR / ATD No."><?=$CA_ATDNo?></a>
                            </label>
                        <?php }else{ ?>
                            <input type="text" class="form-control" id="" readonly value="">
                        <?php } ?>
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

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/bootstrap-editable.css">
<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-editable.min.js"></script>
<script type="text/javascript">
    
    $('#CA_ATDNo').editable({
        params:{type:'customUpdate'},
    });

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
