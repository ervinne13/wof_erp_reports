
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $title ?>
            <?php 
                $module = isset($_SERVER['HTTP_REFERER'])? explode('/',$_SERVER['HTTP_REFERER']):'';
                $module = end($module);
            ?>
            <a class="cls-btn pull-right" href="<?= isset($_SERVER['HTTP_REFERER']) && $module == 'document-approval' ?$_SERVER['HTTP_REFERER']: base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
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
                        <label class="control-label col-xs-5">Doc. No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $GJ_DocNo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Reference No.:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $GJ_RefNo ?>">                     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Remarks:</label>
                        <div class="col-xs-7">  
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $GJ_Remarks ?>">                          
                        </div>
                    </div>
                </span>
                <span class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Doc. Date:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $GJ_DocDate ?>">                          
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" for="">Status:</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $GJ_Status ?>">                          
                        </div>
                    </div>
                </span>                
            </form>
            <div class="details">Details</div>
            <div id="details-data-container" class="container-fluid">
                <?= generate_table($detail_table) ?>
            </div>

            <div class="form-group">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                    <label class="control-label col-xs-5">Running Total:</label>
                    <label class="control-label"><?= $GJ_Amount ?></label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="account-summary" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Account Summary</h4>
            </div>
            <div class="modal-body">
                <table id="tbl-account-summary" class="dynatable table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th data-dynatable-column="GJD_AccountNo">Account No.</th>
                            <th data-dynatable-column="GJD_AccountName">Account Name</th>
                            <th data-dynatable-column="GJD_Debit">Debit</th>
                            <th data-dynatable-column="GJD_Credit">Credit</th>
                            <th data-dynatable-column="GJD_Amount">Amount</th>
                            <th data-dynatable-column="GJD_CY">CY</th>
                            <th data-dynatable-column="GJD_AmountLCY">Amount LCY</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>js/dynatable_generator.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/module_detail_list_view_processor.js"></script>

<script type="text/javascript">

    /* global dynatable_generator, _module, base_url, _class */

    (function () {

        var accountSummaryTable;

        $(document).ready(function () {
            var moduleDetailListViewProcessor = new ModuleDetailListViewProcessor();
            moduleDetailListViewProcessor.initializeTable('#tbl-general-journal-detail', '<?= $this->input->get('id') ?>');

            var ajaxURL = base_url + "app/" + _module + "/" + _class + "/detail_data?id=<?= $this->input->get('id') ?>";
            accountSummaryTable = dynatable_generator.generate('#tbl-account-summary', ajaxURL);

            initializeEvents();

        });

        function initializeEvents() {

            $('#account-summary').on('hide.bs.modal', function () {
                $('#account-summary').removeData('bs.modal');
            });

            $('#account-summary').on('shown.bs.modal', function () {
                accountSummaryTable.process();
            });

            $('#show-account-summary').click(function (e) {
                e.preventDefault();
                $('#account-summary').modal('show');
            });
        }
    })();

</script>