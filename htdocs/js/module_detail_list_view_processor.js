/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global dynatable_generator, _module, base_url, _class, _ */

ModuleDetailListViewProcessor.MODE_INLINE_EDIT = 1;
ModuleDetailListViewProcessor.MODE_MODAL_EDIT = 2;  //  not yet supported
ModuleDetailListViewProcessor.MODE_NEW_PAGE_EDIT = 3;

function ModuleDetailListViewProcessor(config) {

    if (!config) {
        config = {};
    }

    this.tableSelector = null;
    this.cachedDetailTable = null;
    this.redirectTo = "view";
    this.doBeforeAddDetailRedirect = config.doBeforeAddDetailRedirect ? config.doBeforeAddDetailRedirect : null;
    this.doOnRowAdded = config.doOnRowAdded ? config.doOnRowAdded : null;
    this.mode = config.mode ? config.mode : ModuleDetailListViewProcessor.MODE_NEW_PAGE_EDIT;

    if (config.redirectTo && config.redirectTo == "edit") {
        this.redirectTo = config.redirectTo;
    }

//    console.log(this.doBeforeAddDetailRedirect);

    if (this.mode == ModuleDetailListViewProcessor.MODE_INLINE_EDIT) {
        this.newRowTemplate = _.template($("script#new-row-template").html());
    }

}

(function () {

    ModuleDetailListViewProcessor.prototype.showAndSetAddButton = function (tableSelector, show, id) {

        var href = base_url + "app/det-add";

        if (show) {
            $(tableSelector).find('a[href="' + href + '"]').css('display', 'block');
            $(tableSelector).find('a[href="' + href + '"]').addClass('det-add');
            $(tableSelector).find('a[href="' + href + '"]').attr('data-id', id);
        } else {
            $(tableSelector).find('a[href="' + href + '"]').css('display', 'none');
        }
    };

    /**
     * 
     * @param String tableSelector - the selector of the table to be initialized/used as detail table
     * @param boolean force - If set to true, this will always recreate the table as a dynatable instead of processing the cached detail table previously set    
     */
    ModuleDetailListViewProcessor.prototype.initializeTable = function (tableSelector, id, force) {
        if (this.cachedDetailTable && !force) {
            var ajaxURL = base_url + "app/" + _module + "/" + _class + "/detail_data?id=" + id;
            this.cachedDetailTable.settings.dataset.ajaxUrl = ajaxURL;
            this.cachedDetailTable.process();
        } else {
            var context = this;
            var ajaxURL = base_url + "app/" + _module + "/" + _class + "/detail_data?id=" + id;

            if (this.mode == ModuleDetailListViewProcessor.MODE_NEW_PAGE_EDIT) {
                this.cachedDetailTable = dynatable_generator.generate(tableSelector, ajaxURL, function (dynatable) {
                    onTableGenerated(dynatable, context);
                    context.showAndSetAddButton(tableSelector, true, id);
                });

                this.tableSelector = tableSelector;
            } else if (this.mode == ModuleDetailListViewProcessor.MODE_INLINE_EDIT) {

                var options = {
                    features: {
                        pushState: false,
                        paginate: false
                    }
                };

//                this.cachedDetailTable = dynatable_generator.generateWithOptions(tableSelector, ajaxURL, options, function (dynatable) {
//                    onTableGenerated(dynatable, context);
//                    context.showAndSetAddButton(tableSelector, true, id);
//                });

                this.tableSelector = tableSelector;

                prepareAddEventInlineEdit(this);

            } else {
                console.error("ModuleDetailListViewProcessor", "Unrecognized mode: " + this.mode);
            }

        }
    };

    function onTableGenerated(dynatable, moduleDetailListViewProcessor) {

        $(document).on('click', '.det-delete', function () {
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

            var targetUrl = base_url + 'app/' + _module + "/" + _class + '/view/update/?id=' + $(this).data('id');

            if (moduleDetailListViewProcessor.redirectTo == "edit") {
                targetUrl += "&redirectTo=edit";
            }

            window.location = targetUrl;
        });

        if (moduleDetailListViewProcessor.mode == ModuleDetailListViewProcessor.MODE_NEW_PAGE_EDIT) {
            prepareAddEventNewPageEdit(moduleDetailListViewProcessor);
        } else if (moduleDetailListViewProcessor.mode == ModuleDetailListViewProcessor.MODE_INLINE_EDIT) {
            prepareAddEventInlineEdit(moduleDetailListViewProcessor);
        } else {
            console.error("ModuleDetailListViewProcessor", "Unrecognized mode: " + this.mode);
        }

    }

    function prepareAddEventInlineEdit(moduleDetailListViewProcessor) {
//        $(document).on('click', '.det-add', function (e) {
//            e.preventDefault();
//
//            var rowCount = $(moduleDetailListViewProcessor.tableSelector + ' tr').length;
//
//            var rowHTML = moduleDetailListViewProcessor.newRowTemplate({
//                reference_id: rowCount
//            });
//            $(moduleDetailListViewProcessor.tableSelector + ' tr:last').after(rowHTML);
//
//            if (moduleDetailListViewProcessor.doOnRowAdded) {
//                moduleDetailListViewProcessor.doOnRowAdded(rowCount);
//            }
//        });
    }

    function prepareAddEventNewPageEdit(moduleDetailListViewProcessor) {
        $(document).on('click', '.det-add', function (e) {
            e.preventDefault();

            var targetUrl = base_url + 'app/' + _module + "/" + _class + '/view/add/?id=' + $(this).data('id');

            if (moduleDetailListViewProcessor.redirectTo == "edit") {
                targetUrl += "&redirectTo=edit";
            }

            if (moduleDetailListViewProcessor.doBeforeAddDetailRedirect) {
                moduleDetailListViewProcessor.doBeforeAddDetailRedirect(function () {
                    window.location = targetUrl;
                });
            } else {
                window.location = targetUrl;
            }

        });
    }

})();