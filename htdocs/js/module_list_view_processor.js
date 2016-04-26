
/* global _module, base_url, _class, dynatable_generator */

/**
 * Dependencies:
 *  dynatable_generator.js, module_detail_list_view_processor
 * @returns {ModuleListViewProcessor}
 */
function ModuleListViewProcessor() {
    this.detailTableSelector = null;
    this.moduleDetailListViewProcessor = new ModuleDetailListViewProcessor();
}

(function () {

    /**
     * Facade method: initializeHeaderTable + initializeDetailTable     
     */
    ModuleListViewProcessor.prototype.initializeTables = function (headerTableSelector, detailTableSelector) {
        this.initializeHeaderTable(headerTableSelector);
        this.detailTableSelector = detailTableSelector;
    };

    ModuleListViewProcessor.prototype.initializeHeaderTable = function (headerTableSelector) {
        dynatable_generator.generate(headerTableSelector, base_url + "app/" + _module + "/" + _class + "/header_data");

        var context = this;

        $(document).on('click', '.action-view-head-details', function () {
            var id = $(this).data('id');
            var docNo = $(this).data('document-no');
            $('#currently-selected-doc-no').html(": " + docNo);
            context.moduleDetailListViewProcessor.initializeTable(context.detailTableSelector, id);
        });

        $(document).on('click', '.l-del', function () {
            _this = $(this);
            confirm("Delete Record?", function (confirmed) {
                if (confirmed) {
                    $.post(base_url + 'app/' + _module + "/" + _class + '/process', {id: _this.data('id'), type: 'delete'}, function (data) {
                        console.log(data);
                        if (data >= 1) {
                            alert('Deleted!');
                            setTimeout(function () {
                                location.reload();
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

    };

})();