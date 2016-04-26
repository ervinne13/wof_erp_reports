<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?=$title?>
            <?=$function?>
        </h3>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">
            <?=generate_table($tableVPG)?>
        </div>
        <legend></legend>
        <div id="data-container" class="container-fluid">
            <?=generate_table($table)?>
        </div>
    </div>
</div>
<script type="text/javascript">
var vpg = $('#tbl-vat-posting-group').bind('dynatable:init', function(e, dynatable) {
     $('#dynatable-search-tbl-vat-posting-group').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");

        $(document).on('click','#tbl-vat-posting-group .l-del',function(){
            _this = $(this);
              confirm("Delete Record?", function(confirmed) {
                if(confirmed){ 
                  $.post(base_url+'app/'+ 'financial-management' + "/" +'vat_posting_group'+'/process',{id:_this.data('id'),type:'delete'},function(data){
                    if(data == 1){
                        alert('Deleted!');
                        setTimeout(function(){
                          dynatable.process();
                        }, 500);
                    }else{
                        alert(data);
                    }
                  }).error(function(){
                    alert('Error!');
                  });
                }
              });

        });
        
        $('.activate').on('click',function(){
            id = [];
            $('tableVPG .doc:checkbox:checked').each(function(){
                id.push($(this).attr('id'));
            });
            data = [];
            data.push({name:'id',value:JSON.stringify(id)},{name:'type',value:'activate'});
            confirm("Activate Account?", function(confirmed) {
                if(confirmed){
                    $.post(base_url+'app/'+ 'financial-management' + "/" +'vat_posting_group'+'/process',data,function(){
                        dynatable.process();
                    });
                }
            });
        });

        $('.deactivate').on('click',function(){
            id = [];
            $('tableVPG .doc:checkbox:checked').each(function(){
                id.push($(this).attr('id'));
            });
            data = [];
            data.push({name:'id',value:JSON.stringify(id)},{name:'type',value:'deactivate'});
            confirm("Deactivate Account?", function(confirmed) {
                if(confirmed){
                   $.post(base_url+'app/'+ 'financial-management' + "/" +'vat_posting_group'+'/process',data,function(){
                        dynatable.process();
                    });
                }
            });
        });
        
        $('#dynatable-search-tbl-vat-posting-group .clear').on('click',function(){
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
                scrollContainer: function($table){
                    return $table.closest('.table-container');
                }
        });
    }).bind('dynatable:afterUpdate', function(e, dynatable) {
        $('[data-toggle="tooltip"]').tooltip(); 
    }).bind('dynatable:ajax:success', function(e, dynatable) {
        $(this).floatThead('reflow');
    }).dynatable({
        dataset: {
            ajax: true,
            ajaxUrl: base_url + "app/"+ _module + "/" + _class + "/vpg_data",
            ajaxOnLoad: true,
            records: []
        },
        features: {
            pushState: false,
        },
        inputs: {
            processingText: '<img  id="loader" src="'+base_url+'css/assets/data_loader.gif" />'
          }
    }).data('dynatable');


    var vps = $('#tbl-vat-setup').bind('dynatable:init', function(e, dynatable) {
         $('#dynatable-search-tbl-vat-setup').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
            
        
         $(document).on('click','#tbl-vat-setup .l-del',function(){
            _this = $(this);
              confirm("Delete Record?", function(confirmed) {
                if(confirmed){ 
                  $.post(base_url+'app/'+ _module + "/" +_class+'/process',{id:_this.data('id'),type:'delete'},function(data){
                    if(data == 1){
                        alert('Deleted!');
                        setTimeout(function(){
                          dynatable.process();
                        }, 500);
                    }else{
                        alert(data);
                    }
                  }).error(function(){
                    alert('Error!');
                  });
                }
              });

        });

           $('.activate').on('click',function(){
            id = [];
            $('table .doc:checkbox:checked').each(function(){
                id.push($(this).attr('id'));
            });
            data = [];
            data.push({name:'id',value:JSON.stringify(id)},{name:'type',value:'activate'});
            confirm("Activate Account?", function(confirmed) {
                if(confirmed){
                    $.post(base_url + "app/"+ _module + "/" + _class + "/process",data,function(){
                        dynatable.process();
                    });
                }
            });
        });

        $('.deactivate').on('click',function(){
            id = [];
            $('table .doc:checkbox:checked').each(function(){
                id.push($(this).attr('id'));
            });
            data = [];
            data.push({name:'id',value:JSON.stringify(id)},{name:'type',value:'deactivate'});
            confirm("Deactivate Account?", function(confirmed) {
                if(confirmed){
                    $.post(base_url + "app/"+ _module + "/" + _class + "/process",data,function(){
                        dynatable.process();
                    });
                }
            });
        });
    

        $('#dynatable-search-tbl-vat-setup .clear').on('click',function(){
            dynatable.sorts.clear();
            dynatable.queries.remove("search");
            $('[type=search]').val('');
            $(".dynatable-arrow").remove();
            dynatable.process();
        });


        $(this).wrap('<div class="table-container"></div>')
        var $demo1 = $(this);
            $demo1.floatThead({
                scrollContainer: function($table){
                    return $table.closest('.table-container');
                }
        });
    }).bind('dynatable:afterUpdate', function(e, dynatable) {
        $('[data-toggle="tooltip"]').tooltip(); 
    }).bind('dynatable:ajax:success', function(e, dynatable) {
        $(this).floatThead('reflow');
    }).dynatable({
        dataset: {
            ajax: true,
            ajaxUrl: base_url + "app/"+ _module + "/" + _class + "/data",
            ajaxOnLoad: true,
            records: []
        },
        features: {
            pushState: false,
        },
        inputs: {
            processingText: '<img  id="loader" src="'+base_url+'css/assets/data_loader.gif" />'
          }
    }).data('dynatable');
    
</script>