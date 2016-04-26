
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
            <?php 
//                $module = isset($_SERVER['HTTP_REFERER'])? explode('/',$_SERVER['HTTP_REFERER']):'';
//                $module = end($module);
            ?>
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
                <!--Left Panel-->
                <span class="col-md-4">
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $CRJ_DocNo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Customer ID:</label>
                        <div class="col-xs-7">
                             <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $CRJ_CustomerID ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Customer Name:</label>
                        <div class="col-xs-7">
                             <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $CRJ_CustomerName ?>">
                        </div>
                    </div>
                </span>
                <span class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Ext. Doc No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $CRJ_ExtDocNo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for=""> Remarks: </label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $CRJ_Remarks ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= format($CRJ_DocDate) ?>">
                        </div> 
                    </div>
                   </span><!--/Left Panel-->
                <!--Right Panel-->
                <span class="col-md-4">
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Amount:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= numeric($CRJ_Amount)?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Location / Store:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $CRJ_Location ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Status:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $CRJ_Status ?>">
                        </div>
                    </div>
                </span><!--/Right Panel-->
            </form>
            <div class="details">Details</div>
            <div id="details-data-container" class="container-fluid">
                <?= generate_table($table) ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_customer_ledger_entries" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <div id="customer-ledger-invoices-data-container" class="container-fluid">
                    <?= generate_table($table_customer_ledger_invoices) ?>
                </div>
                <div id="modal-error" class="alert alert-danger" role="alert" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <?php if (count($customer_ledger_entries["data"]) > 0): ?>
                    <button id="action-generate-entries" type="button" class="btn btn-primary">Generate Entries</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('#action-generate-entries').click(function () {
            displayModalError(false);
            var selectedCustomerLedgerEntries = $('input:checkbox.customer_ledger_item:checked').map(function () {
                return {
                    CL_DocType: $(this).data('cl_doctype'),
                    CL_DocNo: $(this).data('cl_docno'),
                    CL_DocDate: $(this).data('cl_docdate'),
                    CL_DocAmount: $(this).data('cl_docamount')
                };
            }).get();

            console.log(selectedCustomerLedgerEntries);

            if (selectedCustomerLedgerEntries.length <= 0) {
                displayModalError("You must select at least one customer ledger entry.");
                return;
            }

            var url = base_url + 'app/' + _module + "/" + _class + "/create_details";
            var params = {
                crj_document_no: "<?= $CRJ_DocNo ?>",
                customer_ledger_entries: selectedCustomerLedgerEntries
            };

            console.log(params);

            $.post(url, params, function (response) {
                console.log(response);
                response = JSON.parse(response);

                if (response && response.result == 1) {
                    location.reload();
                } else if (response && response.error) {
                    displayModalError(response.error);
                } else {
                    displayModalError("An unknown error occurred, please try again later");
                }
            });

        });

        var customerLedgerEntriesTable = $('#tbl-customer-ledger-invoices').bind('dynatable:init', function (e, dynatable) {
            $('#tbl-customer-ledger-invoices').find('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");

            $('.clear').on('click', function () {
                dynatable.sorts.clear();
                dynatable.queries.remove("search");
                $('[type=search]').val('');
                $(".dynatable-arrow").remove();
                dynatable.process();
            });

            $(this).wrap('<div class="table-container"></div>')
            $(this).floatThead({
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
                ajaxUrl: base_url + "app/" + _module + "/" + _class + "/customer_ledger_invoices_data",
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

        $('#modal_customer_ledger_entries').on('shown.bs.modal', function (event) {
            customerLedgerEntriesTable.process();
        });

    });

    function displayModalError(errorMessage) {
        if (errorMessage) {
            $('#modal-error').css('display', 'block');
            $('#modal-error').html(errorMessage);
        } else {
            $('#modal-error').css('display', 'none');
            $('#modal-error').html("");
        }
    }

    var table = $('#tbl-cash-receipt-details-journal').bind('dynatable:init', function (e, dynatable) {
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
            $('#modal_customer_ledger_entries').modal('show');
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