/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function ModuleDetailProcessor(id, configs) {

    if (!configs) {
        configs = {};   //  avoid undefined exceptions
    }

    this.id = id;

    this.redirectTo = configs.redirectTo ? configs.redirectTo : "view";
    this.form = configs.form ? configs.form : '#' + _class + "-form";
    this.moduleURL = configs.moduleURL ? configs.moduleURL : base_url + 'app/' + _module + "/" + _class;
    this.moduleHeaderURL = configs.moduleHeaderURL ? configs.moduleHeaderURL : this.moduleURL + "/" + configs.redirectTo + "?id=" + id;
    this.processURL = configs.processURL ? configs.processURL : this.moduleURL + '/process';

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
    ModuleDetailProcessor.prototype.enableActionButtons = function (enable) {
        if (enable) {
            $('.action-button').removeAttr('disabled');
        } else {
            $('.action-button').attr('disabled', 'disabled');
        }
    };

    ModuleDetailProcessor.prototype.showError = function (show, message) {
        if (show) {
            $(this.errorMessageContainer).css("display", "block");
            $(this.errorMessageText).html(message);
        } else {
            $(this.errorMessageContainer).css("display", "none");
            $(this.errorMessageText).html("");
        }
    };

    ModuleDetailProcessor.prototype.redirectBack = function () {
        var _this = this;
        setTimeout(function () {
            window.location = _this.moduleURL;
        }, 1000);
    };

    //  </editor-fold>

    //  
    //  <editor-fold defaultstate="collapsed" desc="Public API Functions">

    //  Facade function, initializeDatepickers + initializeActions
    ModuleDetailProcessor.prototype.initialize = function () {
        this.initializeDatepickers();
        this.initializeActions();
    };

    ModuleDetailProcessor.prototype.initializeDatepickers = function () {
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).mask("9999-99-99");
    };

    ModuleDetailProcessor.prototype.initializeActions = function () {

        //  context reference
        var _this = this;

        $('#' + this.saveNewButton).unbind('click');
        $('#' + this.saveNewButton).click(function () {
            confirm("Save Entry?", function (confirmed) {
                if (confirmed) {
                    _this.enableActionButtons(false);
                    _this.processAdd('create_new', function () {
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
                    _this.processAdd('close', function () {
                        location.href = _this.moduleHeaderURL;
                    });
                }
            });
        });

        $('#' + this.updateNewButton).unbind('click');
        $('#' + this.updateNewButton).click(function () {
            confirm("Save Entry?", function (confirmed) {
                if (confirmed) {
                    _this.enableActionButtons(false);
                    _this.processUpdate('create_new', function () {
                        location.href = _this.newEntryURL;
                    });
                }
            });
        });

        $('#' + this.updateCloseButton).unbind('click');
        $('#' + this.updateCloseButton).click(function () {
            confirm("Save Entry?", function (confirmed) {
                if (confirmed) {
                    _this.enableActionButtons(false);
                    _this.processUpdate('close', function () {
                        location.href = _this.moduleHeaderURL;
                    });
                }
            });
        });

    };

    ModuleDetailProcessor.prototype.processAdd = function (postSaveAction, onFinishCallback) {
        this.save({
            type: 'add-details',
            post_save_action: postSaveAction,
            id: this.id
        }, onFinishCallback);
    };

    ModuleDetailProcessor.prototype.processUpdate = function (postSaveAction, onFinishCallback) {
        this.save({
            type: 'update-details',
            post_save_action: postSaveAction,
            id: this.id
        }, onFinishCallback);
    };

    ModuleDetailProcessor.prototype.save = function (additionalFormData, onFinishCallback) {

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
                    error_message(data.errors);
                } else {

                    if (data.post_save_action == "create_new") {
                        var baseURL = base_url + 'app/' + _module + "/" + _class;
                        var createNewURL = baseURL + "/view/add?id=" + data.header_doc_no_hash + "&redirectTo=edit";
                        location.href = createNewURL;
                    } else if (onFinishCallback) {
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

    //  </editor-fold>

})();