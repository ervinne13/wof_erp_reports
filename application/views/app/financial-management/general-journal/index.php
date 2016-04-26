
<div class="panel">
    <div class="panel-heading">
        <h5 class="panel-title"><?= $title ?>
        </h5>
    </div>
    <div class="panel-body">
        <label>Header</label>
        <div id="header-data-container" class="container-fluid">
            <?= generate_table($header_table) ?>
        </div>

        <label>Details <span id="currently-selected-doc-no"></span></label>
        <div id="detail-data-container" class="container-fluid">
            <?= generate_table($detail_table) ?>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>js/dynatable_generator.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/module_detail_list_view_processor.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/module_list_view_processor.js"></script>

<script type="text/javascript">

    (function () {

        $(document).ready(function () {
            var moduleListViewProcessor = new ModuleListViewProcessor();
            moduleListViewProcessor.initializeTables('#tbl-general-journal-header', '#tbl-general-journal-detail');

            //  hide the add button
            moduleListViewProcessor.moduleDetailListViewProcessor.showAndSetAddButton('#tbl-general-journal-detail', false);

        });

    })();

</script>