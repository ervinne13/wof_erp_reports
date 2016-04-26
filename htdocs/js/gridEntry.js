// SAMPLE

// var grid  = $('#sample').gridEntry({
// tableData: <?=json_encode($data)?>,
// gridConfig:{
//     colHeaders:[  
//                 "Doc No.",
//                 "Doc Date",
//                 "Ext. Doc No.",
//                 "Supplier Name",
//                 "Payment Terms",
//                 "Due Date",
//                 "Amount",
//                 "Reason",
//                 "Status"],
//     columns: [
//             {
//                 data: "RPH_DocNo",
//                 readOnly: true
//             }, {
//                 data: "RPH_DocDate",
//                 readOnly: true
//             }, {
//                 data: "RPH_ExtDocNo",
//                 type: 'date',
//                 dateFormat: 'YYYY-MM-DD'
//             }, {
//                 data: "RPH_SupplierName",
//                 type: 'autocomplete',
//                 strict: true,
//                 allowInvalid: false,
//                 source: ["yellow", "red", "orange", "green", "blue", "gray", "black", "white"]
//             }, {
//                 data: "RPH_SupplierName",
//                 type: 'autocomplete',
//                 strict: true,
//                 allowInvalid: false,
//                 source: ["yellow", "red", "orange", "green", "blue", "gray", "black", "white"]
//             }, 
//             {
//                 data: "RPH_DueDate",
//                 type: 'autocomplete',
//                 source: ["yellow", "red", "orange", "green", "blue", "gray", "black", "white"]
//             }, {
//                 data: "RPH_Amount",
//                 type: 'autocomplete',
//                 source: ["yellow", "red", "orange", "green", "blue", "gray", "black", "white"]
//             }, {
//                 data: "RPH_Reason",
//                 type: 'autocomplete',
//                 source: ["yellow", "red", "orange", "green", "blue", "gray", "black", "white"]
//             }, {
//                 data: "RPH_Status",
//                 type: 'autocomplete',
//                 source: ["yellow", "red", "orange", "green", "blue", "gray", "black", "white"]
//             }],
//     }

// });

function defaultValueRenderer(instance, td, row, col, prop, value, cellProperties) {
    var args = arguments;

    if (args[5] === null && isEmptyRow(instance, row)) {
      args[5] = tpl[col];
      td.style.color = '#999';
    }
    else {
      td.style.color = '';
    }
    Handsontable.renderers.TextRenderer.apply(this, args);
  }

function totalTextRenderer(instance, td, row, col, prop, value, cellProperties){
    if(row == instance.countRows() - 1){
        td.style.fontWeight = 'bold';
        td.style.textAlign = 'right';
        td.innerText = 'Total: ';
        cellProperties.readOnly = true;
        return;
    } else {
        cellProperties.readOnly = false;
    }

    Handsontable.TextRenderer.apply(this, arguments);
}

function totalTextRenderer1(instance, td, row, col, prop, value, cellProperties){
    if(row == instance.countRows() - 1){
        td.style.fontWeight = 'bold';
        td.style.textAlign = 'right';
        td.innerText = 'Total: ';
        cellProperties.readOnly = true;
        return;
    } else {
        cellProperties.readOnly = false;
    }

    Handsontable.NumericRenderer.apply(this, arguments);
}

function totalTextRendererDisabled(instance, td, row, col, prop, value, cellProperties){
    if(row == instance.countRows() - 1){
        td.style.fontWeight = 'bold';
        td.style.textAlign = 'right';
        td.innerText = 'Total: ';
        cellProperties.readOnly = true;
        return;
    }
    Handsontable.TextRenderer.apply(this, arguments);
}

function autoCompleteRenderer(instance, td, row, col, prop, value, cellProperties){
    if(row == instance.countRows() - 1){
        td.innerText = '';
        cellProperties.readOnly = true;
        return;
    } else {
        cellProperties.readOnly = false;
    }
    Handsontable.AutocompleteRenderer.apply(this, arguments);
}

function checkRenderer(instance, td, row, col, prop, value, cellProperties){
    if(row == instance.countRows() - 1){
        td.innerText = '';
        cellProperties.readOnly = true;
        return;
    } else {
        cellProperties.readOnly = false;
    }
    Handsontable.CheckboxRenderer.apply(this, arguments);
}

function emptyRenderer(instance, td, row, col, prop, value, cellProperties) {
    if(row == instance.countRows() - 1){
        td.innerText = '';
        cellProperties.readOnly = true;
        value = null;
        return;
    } else {
        cellProperties.readOnly = false;
    }
    Handsontable.TextRenderer.apply(this, arguments);
}

function renderTotalDisabled(instance, td, row, col, prop, value,cellProperties) {

    if (row === instance.countRows() - 1) {
        value = getTotal(instance,col);
    }
    cellProperties.readOnly = true;
    Handsontable.NumericRenderer.apply(this, arguments);
}

function renderTotal(instance, td, row, col, prop, value, cellProperties) {
    if (row === instance.countRows() - 1) {
        value = getTotal(instance,col);
        cellProperties.readOnly = true;
        cellProperties.validator = false;
    }else{
        cellProperties.validator = requiredValidator;
        cellProperties.readOnly = false;
    }

    Handsontable.NumericRenderer.apply(this, arguments);
}

function getTotal(instance,col) {
    var total = 0;
    $.each(instance.getData(),function (index, value) {
        total += parseFloat(value[col]) || 0;
    }, 0);
    return total;
}

function requiredValidator(value,callback){
      if ($.trim(value)=='' || value == null) {
        callback(false);
      }else {
        callback(true);
      }
}
    
(function($){

    var gridInstance,
        Default,
        config,
        elem,
        selector;
       

    Default  =  {
                add: true,
                tableData: [],
                gridConfig:{
                                contextMenu: ['remove_row','undo','redo'],
                                // fixedColumnsLeft:1,
                                columnSorting: true,
                                copyPaste: false,
                                fillHandle: false,
                                rowHeaders: true,
                                manualColumnResize: true,
                                stretchH: "all",
                                sortIndicator: true,
                                search:true,
                                tableClassName: ['table', 'table-hover', 'table-striped']
                            }
                };


    function gridInitilize(){

        $(elem).handsontable(config.gridConfig);

        
        return getGridInstance(elem);

    };

    function getGridInstance(){

        gridInstance = $(elem.selector).handsontable('getInstance');
        
        initUI(gridInstance);

        return gridInstance;
    };
    
    function initUI(instance){

        selector   =  $(elem)[0].id;
        
        initSearch();
        
        if(config.add){
            initAddButton(instance);
        }

        initData();
    }

    function initAddButton(instance){

        $add = $('<button />', {
            type: 'button',
            id: 'add-' + selector,
            class: 'btn btn-default form-btn main-clr',
          }).html('<span class="glyphicon glyphicon-plus"></span> <b>Add</b>');
        

        elem.before($add);

        $('#add-' + selector).on('click', function (event) {
            
            instance.alter('insert_row',instance.countRows());
      
        });

    }

  
    function initSearch(){

        // var searchData =  gridInstance.getSourceData();

        $search = $('<input />', {
            type: 'search',
            id: 'dynatable-query-search-' + selector,
            'data-dynatable-query': 'search'
          }),
          
          $searchSpan = $('<span></span>', {
            id: 'dynatable-search-' + selector,
            'class': 'dynatable-search',
            text: 'Search: '
          }).append($search);

        elem.before($searchSpan);

        $('#dynatable-query-search-' + selector).on('keyup', function (event) {

            var queryResult = gridInstance.search.query(this.value);
            gridInstance.render();
    
        });

        // $('#dynatable-query-search-' + selector).on('keyup', function (event) {

        //   var value = ('' + this.value).toLowerCase();
        //   var data = searchData;
        //   var searcharray = [];
        //   if (value) {
        //     $.each(data, function(idx, obj) {
        //       $.each(obj, function(key, val) {
        //         if (('' + val).toLowerCase().indexOf(value) > -1) {
        //           searcharray.push(obj);
        //           return false;
        //         }
        //       });
        //     });
        //     gridInstance.loadData(searcharray);
        //   } else {
        //     gridInstance.loadData(searchData);
        //   }
        // });
        
    };
    
    function initData(){

        gridInstance.loadData(config.tableData);
      
    };


    function customDropdownRenderer(instance, td, row, col, prop, value, cellProperties) {
        
        var selectedId;
        var optionsList = cellProperties.chosenOptions.data;

        if(typeof optionsList === "undefined" || typeof optionsList.length === "undefined" || !optionsList.length) {
            Handsontable.TextCell.renderer(instance, td, row, col, prop, value, cellProperties);
            return td;
        }

        var values = (value + "").split(",");
        value = [];
        for (var index = 0; index < optionsList.length; index++) {

            if (values.indexOf(optionsList[index].id + "") > -1) {
                selectedId = optionsList[index].id;
                value.push(optionsList[index].label);
            }
        }
        value = value.join(", ");

        Handsontable.TextCell.renderer(instance, td, row, col, prop, value, cellProperties);
        return td;
    };


    $.fn.gridEntry = function(configuration){

        config = $.extend(true,{},Default,configuration);
        elem = this;

        return gridInitilize(this);

    };

})(jQuery);


                

                