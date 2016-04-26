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
                             <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $SI_DocNo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Customer ID:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $SI_CustomerID ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Customer Name:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $SI_CustomerName ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Address:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $SI_CustomerAddress ?>">
                        </div>
                    </div>
                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Remarks:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $SI_Remarks ?>">
                        </div>
                    </div>              
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                              <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?=format($SI_DocDate)?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">External Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $SI_ExtDocNo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Payment Terms:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $SI_PayTermsID ?>">  
                        </div>
                    </div>
                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Due Date:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= format($SI_DueDate) ?>"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Status:</label>
                        <div class="col-xs-7">
                             <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $SI_Status ?>">  
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Company:</label>
                        <div class="col-xs-7">
                             <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $SI_Company ?>">  
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Location:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $SI_Location ?>">
                        </div>
                    </div>
                </span>
            </form>
            <div class="details">Details</div>
            <div id="details-data-container" class="container-fluid">
                <?= generate_table($table) ?>
            </div>

            <div class="form-group">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                    <label class="control-label col-xs-5">Running Total:</label>
                    <label class="control-label"><?= $SI_Amount ?></label>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var table = $('#tbl-sales-invoice-details').bind('dynatable:init', function (e, dynatable) {
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