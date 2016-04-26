<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
            <a class="cls-btn pull-right" href="<?= $this->input->get('refFrom') ? base_url("app/" . $this->uri->segment(2) . "/document-approval") : base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3)) ?>" >
                Close
            </a>
            <?= $functions ?>
        </h3>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">
            <form id="<?= $this->uri->segment(3) ?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
                <span class="col-md-6">
                    <div class="form-group">
                        <label for="sel1" class="control-label col-xs-5">Document No.:</label>
                        <div class="col-xs-7">
                            <label id="document-number" class="control-label"><?= $ADV_DocNo ?></label>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Disposal Type:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $ADV_DisposalType ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Disposal Date:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $ADV_DisposalDate ?></label>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $ADV_Remarks ?></label>                            
                        </div>
                    </div>
                </span>
                <span class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Document Date:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $ADV_DocDate ?></label>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="control-label col-xs-5">Location:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $ADV_Location ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="control-label col-xs-5">Company:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $ADV_Company ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Customer:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $ADV_CustomerID ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Selling Price:</label>
                        <div class="col-xs-7">
                            <label class="control-label"><?= $ADV_SellingPrice ?></label>
                        </div>
                    </div>

                </span>
            </form>

            <hr>
            <div class="details">Details</div>
            <?= generate_table($table) ?>
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


<div class="modal fade" id="doc-tracking-rq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Document Tracking</h4>
            </div>
            <div class="modal-body">
                <table id="doc-tracking-tbl-rq" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th data-dynatable-column="DT_DocNo">Document No</th>
                            <th data-dynatable-column="DT_EntryDate">Entry Date</th>
                            <th data-dynatable-column="DT_Sender">Sender</th>
                            <th data-dynatable-column="DT_Location">Location</th>
                            <th data-dynatable-column="Position">Approver Position</th>                                
                            <th data-dynatable-column="ApprovedBy">Approver ID</th>
                            <th data-dynatable-column="DateApproved">Date Approved</th>
                            <th data-dynatable-column="DT_Status">Status</th>
                            <th data-dynatable-column="DT_Remarks">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    (function () {

        var docID = '<?= $ADV_DocNo ?>';
        var doctracktablerq = $('#doc-tracking-tbl-rq').dynatable().data('dynatable');
        var moduleUrl = base_url + 'app/' + _module + "/" + _class;

        $(document).on('click', '#detail-send-approval-request, #detail-cancel, #detail-approve, #detail-reject, #detail-reopen', function (e) {
            e.preventDefault();

            var _this = this;
            var idList = [];
            var docNo = $('#document-number').html();
            var type = $(this).attr('id');
            var actionName = $(this).html();

            //  get selected id
            $('.doc').each(function () {
                _this = $(this);
                if (_this.prop('checked') == true) {
                    idList.push(_this.attr('id'));
                }
            });

            if (idList.length > 0) {

                var message = '<legend>' + actionName + '?</legend>';

                confirm(message, function (confirmed) {
                    if (confirmed) {
                        process(docNo, idList, type);
                    }
                });
            } else {
                alert('No Document Selected!');
            }

        });

        function process(docNo, idList, processType) {
            $.ajax({
                method: 'POST',
                dataType: 'json',
                data: {
                    id: JSON.stringify(idList),
                    docNo: docNo,
                    type: processType
                },
                url: moduleUrl + "/process",
                success: function (results) {
                    if (results.status == 0) {
                        if (results.message) {
                            alert(results.message);
                        } else {
                            alert('Failed');
                        }
                    } else {
                        if (processType == 'cancel') {
                            window.location = moduleUrl;
                        } else {
                            location.reload();
                        }

                        alert('Success!');
                    }
                },
                error: function () {
                    alert('Error');
                }
            });
        }

        $(document).on('click', '#detail-re-open', function (e) {
            e.preventDefault();
            _this = $(this);
            idList = [];
            processType = _this.attr('id');
            $('.doc').each(function () {
                __this = $(this);
                if (__this.prop('checked') == true) {
                    idList.push(__this.attr('id'));
                }
            });
            message = '<legend>Re Open?</legend> \
                  <textarea id="remarks" placeholder="Remarks"></textarea> \
                  ';
            if (idList.length > 0) {
                confirm(message, function (confirmed) {
                    if (confirmed) {
                        remarks = $('#remarks').val();
                        $.ajax({
                            method: 'POST',
                            dataType: 'json',
                            data: {id: JSON.stringify(idList),
                                type: processType,
                                remarks: remarks},
                            url: moduleUrl + "/process",
                            success: function (results) {
                                if (results.status == 0) {
                                    if (results.message) {
                                        alert(results.message);
                                    } else {
                                        alert('Failed');
                                    }
                                } else {
                                    if (processType == 'cancel') {
                                        window.location = moduleUrl;
                                    }
                                    alert('Success!');
                                    location.reload();
                                }
                            },
                            error: function () {
                                alert('Error');
                            },
                        });
                    }
                });
            } else {
                alert('No Document Selected!');
            }
        });

        $(document).on('click', '#detail-reject', function (e) {
            e.preventDefault();
            _this = $(this);
            idList = [];
            processType = _this.attr('id');
            $('.doc').each(function () {
                __this = $(this);
                if (__this.prop('checked') == true) {
                    idList.push(__this.attr('id'));
                }
            });
            message = '<legend>Reject ?</legend> \
                   <textarea id="remarks" placeholder="Remarks"></textarea> \
                  ';
            if (idList.length > 0) {
                confirm(message, function (confirmed) {
                    if (confirmed) {
                        remarks = $('#remarks').val();
                        $.ajax({
                            method: 'POST',
                            dataType: 'json',
                            data: {id: JSON.stringify(idList),
                                type: processType,
                                DT_Remarks: remarks},
                            url: moduleUrl + '/process',
                            success: function (results) {
                                if (results.status == 0) {
                                    if (results.message) {
                                        alert(results.message);
                                    } else {
                                        alert('Failed');
                                    }
                                } else {
                                    if (processType == 'cancel') {
                                        window.location = moduleUrl;
                                    }
                                    alert('Success!');
                                    location.reload();
                                }
                            },
                            error: function () {
                                alert('Error');
                            },
                        });
                    }
                });
            } else {
                alert('No Document Selected!');
            }
        });

        $(document).on('click', '.detail-function li a:not(#detail-re-open,#detail-reject)', function (e) {
            e.preventDefault();
            _this = $(this);
            idList = [];
            processType = _this.attr('id');
            $('.doc').each(function () {
                __this = $(this);
                if (__this.prop('checked') == true) {
                    idList.push(__this.attr('id'));
                }
            });
            if (idList.length > 0) {
                confirm(_this.text() + '?', function (confirmed) {

                    if (confirmed) {
                        switch (_this.attr('id')) {
                            case 'print':
                                popup(base_url + 'app/' + _module + '/' + _class + '/print_document/' + idList, '', '800', '800');
                                break;
                            default:
                                $.ajax({
                                    method: 'POST',
                                    dataType: 'json',
                                    data: {id: JSON.stringify(idList),
                                        type: processType},
                                    url: moduleUrl + '/process',
                                    success: function (results) {
                                        if (results.status == 0) {
                                            if (results.message) {
                                                alert(results.message);
                                            } else {
                                                alert('Failed');
                                            }
                                        } else {
                                            if (processType == 'cancel') {
                                                window.location = moduleUrl;
                                            }
                                            alert('Success!');
                                            location.reload();
                                        }
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        alert(jqXHR.responseText);
                                    },
                                });
                        }
                    }

                });
            } else {
                alert('No Document Selected!');
            }
        });

        $('#doc-tracking-rq').on('show.bs.modal', function (event) {

            $('#doc-tracking-tbl-rq').floatThead('reflow');

        });

        $(document).on('click', '#track-document-rq', function () {
            $('#doc-tracking-rq').modal('show');
            dataID = $(this).attr('data-id');
            $.ajax({
                url: base_url + "app/document-tracking/data/" + dataID,
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    doctracktablerq.records.updateFromJson({records: data.records});
                    doctracktablerq.records.init();
                    doctracktablerq.process();
                },
                error: function () {
                    alert('Error!');
                }
            });

        });

        $('.attachment-head').slimScroll({
            color: '#00f',
            size: '10px',
            height: '70px',
            alwaysVisible: false
        });

        $(document).ready(function () {
            var table = $('#tbl-asset-disposal-details').bind('dynatable:init', function (e, dynatable) {
                var select = $('<select/>', {id: 'status-filter'});
                select.append('<option value="" >-select-</option><option value="open">Open</option><option value="approved">Approved</option><option value="pending">Pending</option><option value="cancelled">Cancelled</option>');
                $('#dynatable-search-' + 'tbl-asset-disposal-details').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
                $('#dynatable-per-page-tbl-asset-disposal-details').after(select);

                $('#status-filter').on('change', function () {
                    var value = $(this).val();
                    if (value === "") {
                        dynatable.queries.remove("statusFilter");
                    } else {
                        dynatable.queries.add("statusFilter", value);
                    }
                    dynatable.process();
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
                    ajaxUrl: moduleUrl + "/details/?id=" + "<?= $this->input->get('id') ?>",
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
        });

    })();

</script>