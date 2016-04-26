<div class="panel">
    <div class="panel-heading">
        <h5 class="panel-title"><?= $title ?></h5>
    </div>
    <div class="panel-body">
        <div class="panel-body">
            <div id="data-container" class="container-fluid">
                <?= generate_table($table) ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    (function () {

        $('.dynatable').bind('dynatable:init', function (e, dynatable) {
            var dateFilter = $('#template-date-filter').html();
            $('#dynatable-search-' + 'tbl-' + _class)
                    .prepend(dateFilter)
                    .append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
            $('.activate').on('click', function () {
                id = [];
                $('table .u_userid:checkbox:checked').each(function () {
                    id.push($(this).attr('id'));
                });
                data = [];
                data.push({name: 'id', value: JSON.stringify(id)}, {name: 'type', value: 'activate'});
                confirm("Activate Account?", function (confirmed) {
                    if (confirmed) {
                        $.post(base_url + "app/" + _module + "/" + _class + "/process", data, function () {
                            dynatable.process();
                        });
                    }
                });
            });

            $('#date-from').on('change', function () {
                var value = $(this).val();
                if (value === "") {
                    dynatable.queries.remove("date-from");
                } else {
                    dynatable.queries.add("date-from", value);
                }
                dynatable.process();
            });

            $('#date-to').on('change', function () {
                var value = $(this).val();
                if (value === "") {
                    dynatable.queries.remove("date-to");
                } else {
                    dynatable.queries.add("date-to", value);
                }
                dynatable.process();
            });

            $("#date-from,#date-to").datepicker({dateFormat: 'mm-dd-yy'}).mask("99-99-9999");

            $('.deactivate').on('click', function () {
                id = [];
                $('table .u_userid:checkbox:checked').each(function () {
                    id.push($(this).attr('id'));
                });
                data = [];
                data.push({name: 'id', value: JSON.stringify(id)}, {name: 'type', value: 'deactivate'});
                confirm("Deactivate Account?", function (confirmed) {
                    if (confirmed) {
                        $.post(base_url + "app/" + _module + "/" + _class + "/process", data, function () {
                            dynatable.process();
                        });
                    }
                });
            });

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

            $('td').each(function () {
                var value = $(this).html();
                console.log(value);
            });

        }).dynatable({
            dataset: {
                ajax: true,
                ajaxUrl: base_url + "app/" + _module + "/" + _class + "/data",
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

    })();
</script>