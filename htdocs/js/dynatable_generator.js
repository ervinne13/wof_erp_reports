/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global base_url */

//  namespace
var dynatable_generator = {};

dynatable_generator.generate = function (selector, ajaxURL, onTableGenerated) {
    return dynatable_generator.generateWithOptions(selector, ajaxURL, null, onTableGenerated);
};

dynatable_generator.generateWithOptions = function (selector, ajaxURL, options, onTableGenerated) {

    options = dynatable_generator.loadDefaultOptions(options, ajaxURL);
    return $(selector).bind('dynatable:init', function (e, dynatable) {
        $(selector).find('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
        $(selector).find('.clear').on('click', function () {
            dynatable.sorts.clear();
            dynatable.queries.remove("search");
            $('[type=search]').val('');
            $(".dynatable-arrow").remove();
            dynatable.process();
        });

        if (onTableGenerated) {
            onTableGenerated(dynatable);
        }

        $(this).wrap('<div class="table-container"></div>');
        var $demo1 = $(this);
        $demo1.floatThead({
            scrollContainer: function ($table) {
                return $table.closest('.table-container');
            }
        });
    }).bind('dynatable:afterUpdate', function () {
        $('[data-toggle="tooltip"]').tooltip();
    }).bind('dynatable:ajax:success', function () {
        $(this).floatThead('reflow');
    }).dynatable({
        dataset: options.dataset,
        features: options.features,
        inputs: options.inputs
    }).data('dynatable');
};

/**
 * 
 * @param Array options - The initial options
 * @param String ajaxURL - The url where the dynatable data will be fetched
 * @returns {undefined}
 */
dynatable_generator.loadDefaultOptions = function (options, ajaxURL) {

    if (!options) {
        options = {};   //  avoid undefined exception
    }

    //  defaults
    if (!options.dataset) {
        options.dataset = {
            ajax: true,
            ajaxUrl: ajaxURL,
            ajaxOnLoad: true,
            records: []
        };
    }

    if (!options.features) {
        options.features = {
            pushState: false
        };
    }

    if (!options.inputs) {
        options.inputs = {
            processingText: '<img  id="loader" src="' + base_url + 'css/assets/data_loader.gif" />'
        };
    }

    return options;
};