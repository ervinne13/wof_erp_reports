
/* global _class, base_url, _module */

/**
 * @class ModuleHeaderProcessor
 * @param {Object} configs 
 *  The configuration of the module header. 
 * @description 
 *  Abstracts out the functionality of processing saving and updating header records of a module.
 *  IMPORTANT! This class is dependent on certain DOM elements as specified in the configuration or by 
 *  default, only call it's custructor when the document/DOM is ready, otherwise, events and ui 
 *  modifications will not apply!
 * 
 */
function ModuleHeaderProcessor(configs) {

    if (!configs) {
        configs = {};   //  avoid undefined exceptions
    }

    this.form = configs.form ? configs.form : '#' + _class + "-form";
    this.moduleURL = configs.moduleURL ? configs.moduleURL : base_url + 'app/' + _module + "/" + _class;
    this.newEntryURL = configs.newEntryURL ? configs.newEntryURL : base_url + 'app/' + _module + "/" + _class + "/add";
    this.processURL = configs.processURL ? configs.processURL : this.moduleURL + '/process';

    this.detailEditMode = configs.detailEditMode ? configs.detailEditMode : 'new_page';
    this.detailTableSelector = configs.detailTableSelector ? configs.detailTableSelector : null;
    this.changedDetailsReferenceIdList = [];
    this.deletedDetailsReferenceIdList = [];

    //  if set to true, serial number generation will be required and if generation fails,
    //  the module will redirect back to the view to prevent creation of documents that
    //  do not conform to the series setup
    this.isTransactionModule = configs.isTransactionModule ? configs.isTransactionModule : false;

//    this.saveButton = configs.saveButton ? configs.saveButton : "save";
    this.saveNewButton = configs.saveNewButton ? configs.saveNewButton : "save-new";
    this.saveCloseButton = configs.saveCloseButton ? configs.saveCloseButton : "save-close";
    this.updateNewButton = configs.updateNewButton ? configs.updateNewButton : "update-new";
    this.updateCloseButton = configs.updateCloseButton ? configs.updateCloseButton : "update";

    this.errorMessageContainer = configs.errorMessageContainer ? configs.errorMessageContainer : "#error-message-container";
    this.errorMessageText = configs.errorMessageText ? configs.errorMessageText : "#error-message";

    //  make sure that the default action buttons have an action-button class
//    $('#' + this.saveButton).addClass('action-button');
    $('#' + this.saveNewButton).addClass('action-button');
    $('#' + this.saveCloseButton).addClass('action-button');
    $('#' + this.updateNewButton).addClass('action-button');
    $('#' + this.updateCloseButton).addClass('action-button');
}

(function () {

    //
    //  <editor-fold defaultstate="collapsed" desc="Public UI Utility Functions">      
    ModuleHeaderProcessor.prototype.enableActionButtons = function (enable) {
        if (enable) {
            $('.action-button').removeAttr('disabled');
        } else {
            $('.action-button').attr('disabled', 'disabled');
        }
    };

    ModuleHeaderProcessor.prototype.showError = function (show, message) {
        if (show) {
            $(this.errorMessageContainer).css("display", "block");
            $(this.errorMessageText).html(message);
        } else {
            $(this.errorMessageContainer).css("display", "none");
            $(this.errorMessageText).html("");
        }
    };

    ModuleHeaderProcessor.prototype.switchToUpdateMode = function (uniqueId) {
        $('#' + this.saveNewButton).attr({'disabled': false, 'id': this.updateNewButton});
        $('#' + this.saveCloseButton).attr({'disabled': false, 'id': this.updateCloseButton});
        $('#' + this.updateNewButton).attr('data-id', uniqueId);
        $('#' + this.updateCloseButton).attr('data-id', uniqueId);

        this.initializeActions();
    };

    ModuleHeaderProcessor.prototype.redirectBack = function () {
        var _this = this;
        setTimeout(function () {
            window.location = _this.moduleURL;
        }, 1000);
    };

    //  </editor-fold>

    //  
    //  <editor-fold defaultstate="collapsed" desc="Public API Functions">

    ModuleHeaderProcessor.prototype.loadNumberSeries = function (numberSeriesFieldSelector, onNumberSeriesLoaded) {

        //  context reference
        var _this = this;

        $(numberSeriesFieldSelector).numseries({
            target: _this.moduleURL + '/getseries',
            method: 'add',
            beforeSend: function () {
                _this.enableActionButtons(false);
            },
            afterSend: function (e, data) {
                if (data.rows == 0) {
                    alert('No series available!');
                    if (_this.isTransactionModule) {
                        _this.redirectBack();
                    }
                } else {
                    console.log("ModuleHeaderProcessor", data);
                    _this.switchToUpdateMode(data.uniqid);

                    if (onNumberSeriesLoaded) {
                        onNumberSeriesLoaded(data.uniqid);
                    }

                }
            },
            sendFailed: function () {
                _this.enableActionButtons(true);
                alert('Series Generation Failed!');
                if (_this.isTransactionModule) {
                    _this.redirectBack();
                }
            },
            modal: {
                target: _this.moduleURL + '/seriesmodal',
                selecttarget: _this.moduleURL + '/process',
                afterSend: function (e, data) {
                    _this.switchToUpdateMode(data.uniqid);
                    if (onNumberSeriesLoaded) {
                        onNumberSeriesLoaded(data.uniqid);
                    }
                }
            }
        });

    };

    //  Facade function, initializeDatepickers + initializeActions
    ModuleHeaderProcessor.prototype.initialize = function () {
        this.initializeDatepickers();
        this.initializeActions();
    };

    ModuleHeaderProcessor.prototype.initializeDatepickers = function () {
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).mask("9999-99-99");
    };

    ModuleHeaderProcessor.prototype.initializeActions = function () {

        //  context reference
        var _this = this;

        $('#' + this.saveNewButton).unbind('click');
        $('#' + this.saveNewButton).click(function () {
            confirm("Save Entry?", function (confirmed) {
                if (confirmed) {
                    _this.enableActionButtons(false);
                    _this.processAdd(function () {
                        location.href = _this.newEntryURL;
                    });
                }
            });
        });

        $('#' + this.saveCloseButton).unbind('click');
        $('#' + this.saveCloseButton).click(function () {
            confirm("Save Entry?", function (confirmed) {
                if (confirmed) {
                    _this.enableActionButtons(false);
                    _this.processAdd(function () {
                        location.href = _this.moduleURL;
                    });
                }
            });
        });

        $('#' + this.updateNewButton).unbind('click');
        $('#' + this.updateNewButton).click(function () {
            var uniqueId = $(this).data('id');
            confirm("Save Entry?", function (confirmed) {
                if (confirmed) {
                    _this.enableActionButtons(false);
                    _this.processUpdate(uniqueId, function () {
                        location.href = _this.newEntryURL;
                    });
                }
            });
        });

        $('#' + this.updateCloseButton).unbind('click');
        $('#' + this.updateCloseButton).click(function () {
            var uniqueId = $(this).data('id');
            confirm("Save Entry?", function (confirmed) {
                if (confirmed) {
                    _this.enableActionButtons(false);
                    _this.processUpdate(uniqueId, function () {
                        location.href = _this.moduleURL;
                    });
                }
            });
        });

    };

    ModuleHeaderProcessor.prototype.processAdd = function (onFinishCallback) {
        this.save({type: 'add'}, onFinishCallback);
    };

    ModuleHeaderProcessor.prototype.processUpdate = function (uniqueId, onFinishCallback) {
        this.save({
            type: 'update',
            uniqid: uniqueId
        }, onFinishCallback);
    };

    ModuleHeaderProcessor.prototype.save = function (additionalFormData, onFinishCallback) {

        var form = $(this.form);
        var data = form.serializeArray();
        var formData = new FormData();

        for (var key in additionalFormData) {
            formData.append(key, additionalFormData[key]);
        }

        $('.attachment').each(function () {
            if ($(this)[0].files.length > 0) {
                formData.append('file[]', $(this)[0].files[0]);
            }
        });

        $(form).find('input[type=checkbox]').each(function () {
            data.push({name: this.name, value: this.checked ? 1 : 0});
        });

        $.each(data, function (key, input) {
            formData.append(input.name, input.value);
        });

        if (this.detailEditMode == 'inline') {
            formData.append('deleted_details', JSON.stringify(this.deletedDetailsReferenceIdList));
            formData.append('details', JSON.stringify(this.loadDetails()));
//            data.push({name: 'details', value: this.loadDetails()});            
        }

        console.log("ModuleHeaderProcessor", formData);

        //  context reference
        var _this = this;

        $.ajax({
            url: _this.processURL,
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                if (data.result == 0) {
                    if (data.errors) {
                        error_message(data.errors);
                    }

                    if (_this.detailEditMode == 'inline' && data.batch_save_errors) {
                        _this.showBatchSaveErrors(data.batch_save_errors);
                    }
                } else {
                    if (onFinishCallback) {
                        onFinishCallback(data);
                    }
                }
                _this.enableActionButtons(true);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);

                if (jqXHR.responseText) {
                    _this.showError(true, jqXHR.responseText);
                } else {
                    alert('Error!');
                }

                _this.enableActionButtons(true);
            }
        });

        this.enableActionButtons(false);
        this.showError(false);

    };

    ModuleHeaderProcessor.prototype.showBatchSaveErrors = function (batchSaveErrors) {

        for (var i in batchSaveErrors) {
            var referenceId = batchSaveErrors[i].reference_id;
            var errors = batchSaveErrors[i].errors;

            for (var fieldName in errors) {
                $('#label_error_' + referenceId + "_" + fieldName).attr('title', errors[fieldName]);
                $('#label_error_' + referenceId + "_" + fieldName).css('display', 'inline');
            }

        }

    };

    ModuleHeaderProcessor.prototype.loadDetails = function () {

        var details = [];
        for (var i in this.changedDetailsReferenceIdList) {

            var referenceId = this.changedDetailsReferenceIdList[i];
            var row = {};
            $('[data-reference-id=' + referenceId + ']').each(function () {
                if ($(this).attr('name')) {
                    var value;

                    if ($(this).hasClass('editable') || $(this).hasClass('editable-select') || $(this).hasClass('editable-disabled')) {
                        var rawValue = $(this).editable('getValue');
                        value = rawValue[referenceId + "_" + $(this).attr('name')];
                    } else {
                        value = $(this).html();
                    }

                    if (value && typeof value === "string") {
                        value = value.trim();
                    }

                    row[$(this).attr('name')] = value;
                }

            });

            row.reference_id = referenceId;
            row.data_type = $('tr[data-reference-id=' + referenceId + ']').data('type');

            console.log(row);

            details.push(row);
        }

        return details;

    };

    // </editor-fold>
})();
