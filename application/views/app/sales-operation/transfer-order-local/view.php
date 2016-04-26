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
                <span class="col-md-6">
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $TOL_DocNo ?></label> 
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Transfer From:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $TOL_TransferFrom ?></label> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Transfer To:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $TOL_TransferTo ?></label> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Remarks:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $TOL_Remarks ?></label>
                        </div>
                    </div>
                </span>
                <span class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $TOL_DocDate ?></label> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for=""><?= $transfer_type == "incoming" ? "Date Received" : "Date Transferred" ?></label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $TOL_PostingDate ?></label> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Company:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $TOL_Company ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Status:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $TOL_Status ?></label>
                        </div>
                    </div>                    
                </span>
            </form>
            <div class="details">Details</div>
            <div class="container-fluid">            
                <?= generate_table($table) ?>
            </div>
        </div>
    </div>
</div>	
<script type="text/javascript">

    (function () {

        var id = '<?= $this->input->get('id') ?>';
        var toType = '<?= $this->input->get('type') ?>';

        $(document).ready(function () {

            setupTable();

            $('#post_to').click(function (e) {
                e.preventDefault();
                post();
            });

        });

        function post() {
            confirm('Post?', function (confirmed) {
                if (confirmed) {
                    $.ajax({
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            id: id,
                            type: 'post',
                            toL_type: toType
                        },
                        url: base_url + 'app/' + _module + '/' + _class + '/process',
                        success: function (results) {
                            if (results.status == 0) {
                                if (results.message) {
                                    alert(results.message);
                                } else {
                                    alert('Failed');
                                }
                            } else {
                                if (type == 'cancel') {
                                    window.location = base_url + 'app/' + _module + '/' + _class;
                                }
                                alert('Success!');
                                location.reload();
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(jqXHR.responseText);
                        }
                    });
                }

            });
        }

        function setupTable() {
            $('#tbl-transfer-order-details').bind('dynatable:init', function (e, dynatable) {
                var dateFilter = $('#template-date-filter').html();
                var locationAndCompanyFilter = $('#template-location-and-company-filter').html();
                $('#dynatable-search-tbl-transfer-order-details')
                        .prepend(dateFilter)
                        .prepend(locationAndCompanyFilter)
                        .append("<a  href='javascript:void(0)' class='clear'>Clear</a>");

                $('#dynatable-search-tbl-transfer-order-details > .date-from').on('change', function () {
                    var value = $(this).val();
                    if (value === "") {
                        dynatable.queries.remove("date-from");
                    } else {
                        dynatable.queries.add("date-from", value);
                    }
                    console.log(dynatable);

                    dynatable.process();
                });

                $('#dynatable-search-tbl-transfer-order-details > .date-to').on('change', function () {
                    var value = $(this).val();
                    if (value === "") {
                        dynatable.queries.remove("date-to");
                    } else {
                        dynatable.queries.add("date-to", value);
                    }
                    dynatable.process();
                });

                $("#dynatable-search-tbl-transfer-order-details > .date-filter").datepicker({dateFormat: 'mm-dd-yy'}).mask("99-99-9999");

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
                    ajaxUrl: base_url + "app/" + _module + "/" + _class + "/details_data?id=" + "<?= $this->input->get('id') ?>",
                    ajaxOnLoad: true,
                    records: []
                },
                features: {
                    pushState: false,
                },
                inputs: {
                    processingText: '<img id="loader" src="' + base_url + 'css/assets/data_loader.gif" />'
                }
            }).data('dynatable');
        }

    })();

</script>
