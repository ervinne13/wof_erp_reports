 

  $('.presentation').bind('dynatable:init', function(e, dynatable) {
    $('.dynatable-search').prepend('Date Filter: <input type="search" id="date-from"/><input type="search"  id="date-to"/> ')
    .append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    $(this).wrap('<div class="table-container"></div>')
    var $demo1 = $(this);
    $demo1.floatThead({
      scrollContainer: function($table){
        return $table.closest('.table-container');
      }
    });
    $("#date-from,#date-to").datepicker({ dateFormat: 'mm/dd/yy'});
  }).dynatable();

  // $("#save-new").on("click",function(){
  //   var $btn = $(this);
  //   confirm("Save Entry?", function(confirmed) {
  //       if(confirmed){ 
        
  //       $btn.attr('disabled',true).text('Processing..');
  //       form = $('#'+_class+"-form");
  //       data = form.serializeArray();
  //       data.push({name:"type",value:'add'});
  //       $(form).find('input[type=checkbox]').each(function() {
  //          data.push({ name: this.name, value: this.checked ? 1 : 0 });
  //        });

  //       $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
  //         if(data.result == 0){
  //           error_message(data.errors);
  //         }else{
  //           $('.form-group').removeClass('has-error').find('div:first .alert').remove();
  //           form[0].reset();
  //           $select.each(function(){
  //             $(this)[0].selectize.clear();
  //           });
  //           $selectmul.each(function(){
  //             $(this)[0].selectize.clear();
  //           });
  //           alert('Saved!');
  //         }
  //         $btn.attr('disabled',false).text('Save & New');
  //       },'json').error(function(){
  //         alert('Error!');
  //         $btn.attr('disabled',false).text('Save & New');
  //       });
  //     }
  //   });
  // });

  // $("#save-close").on("click",function(){
  //   var $btn = $(this);
  //   form = $('#'+_class+"-form");
  //   data = form.serializeArray();
  //   data.push({name:"type",value:'add'});
  //   $(form).find('input[type=checkbox]').each(function() {
  //     data.push({ name: this.name, value: this.checked ? 1 : 0 });
  //   });

  //   confirm("Save Entry?", function(confirmed) {
  //       if(confirmed){ 
  //       $btn.attr('disabled',true).text('Processing..');
  //       $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
  //         if(data.result == 0){
  //           error_message(data.errors);
  //         $btn.attr('disabled',false).text('Save & Close');
  //         }else{
  //           alert('Saved!');
  //           window.location = base_url+'app/administration/'+_class;
  //         }
  //       },'json').error(function(){
  //         alert('Error!');
  //         $btn.attr('disabled',false).text('Save & Close');
  //       });
  //     }
  //   });
  // });

  // $(document).on("click","#update-new",function(){
  //   var $btn = $(this);
  //   var $lbl = $btn.text();
  //   form = $('#'+_class+"-form");
  //   data = form.serializeArray();
  //   data.push({name:"type",value:'update'},
  //         {name:"uniqid",value:$(this).attr('data-id')});
  //   $(form).find('input[type=checkbox]').each(function() {
  //     data.push({ name: this.name, value: this.checked ? 1 : 0 });
  //   });
    
  //   confirm("Save Entry?", function(confirmed) {
  //       if(confirmed){ 
  //       $btn.attr('disabled',true).text('Processing..');
  //       $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
  //         if(data.result == 0){
  //           error_message(data.errors);
  //           $btn.attr('disabled',false).text('Save');
  //         }else{
  //           $('.form-group').removeClass('has-error').find('div:first .alert').remove();
  //           form[0].reset();
  //           $select.each(function(){
  //             $(this)[0].selectize.clear();
  //           });
  //           $selectmul.each(function(){
  //             $(this)[0].selectize.clear();
  //           });
  //           alert('Saved!');
  //           $('.primary input').noseries($settings.setting);
  //         }
  //         $btn.attr('disabled',false).text($lbl);
  //       },'json').error(function(){
  //         alert('Error!');
  //         $btn.attr('disabled',false).text($lbl);
  //       });
  //     }
  //   });
  // });

  // $(document).on("click","#update",function(){
  //     var $btn = $(this);
  //     var $lbl = $btn.text();
  //     form = $('#'+_class+"-form");
  //     data = form.serializeArray();
  //     data.push({name:"type",value:'update'},
  //           {name:"uniqid",value:$(this).data('id')});
  //     $(form).find('input[type=checkbox]').each(function() {
  //       data.push({ name: this.name, value: this.checked ? 1 : 0 });
  //     });
      
  //     confirm("Save Entry?", function(confirmed) {
  //         if(confirmed){ 
  //         $btn.attr('disabled',true).text('Processing..');
  //         $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
  //           if(data.result == 0){
  //             error_message(data.errors);
  //             $btn.attr('disabled',false).text($lbl);
  //           }else{
  //             alert('Saved!');
  //             window.location = base_url+'app/administration/'+_class;
  //           }
  //         },'json').error(function(){
  //           alert('Error!');
  //           $btn.attr('disabled',false).text($lbl);
  //         });
  //       }
  //     });
  // });
  
  
  

  // $('.form-modal').on('click',function(){
  //   _this= $(this);
  //   $('.bottom').modal({
  //     remote:_this.data('content'),
  //     show:true,
  //   });
  //   return false;
  // });

  // $('.form').on('hidden.bs.modal', function () {
  //   $(this).removeData('bs.modal');
  // });

  var doctracktable;
  $('#doc-tracking').on('hide.bs.modal', function () { 
    $('#doc-tracking').removeData('bs.modal');
  });

  $('#doc-tracking').on('shown.bs.modal', function (event) {
    doctracktable.process();
  });

  $('#doc-tracking').on('show.bs.modal', function (event) {
      
  doctracktable = $('#doc-tracking-tbl').bind('dynatable:init', function(e, dynatable) {
      $('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");

      $('.clear').on('click',function(){
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
          ajaxUrl: base_url + "app/document-tracking/data/"+$(event.relatedTarget).data('id'),
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
  });

  $(document).on('click','#re-open,#l-re-open',function(e){
      e.preventDefault();
      _this     = $(this);
      id        = _this.data('id');
      type      = _this.attr('id');
      message   = '<legend>Re Open?</legend> \
                  <textarea id="remarks" placeholder="Remarks"></textarea> \
                  ';
      confirm(message, function(confirmed) {
        if(confirmed){ 
        remarks   = $('#remarks').val();
             $.ajax({
                  method:'POST',
                  dataType:'json',
                  data:{id:id,
                        type:type,
                        remarks:remarks},
                    url: base_url+'app/'+_module+'/'+_class+'/process',
                    success: function(results){                            
                      if(results.status==0){
                          if(results.message){
                            alert(results.message);
                          }else{
                            alert('Failed');
                          }
                        }else{
                          alert('Success!');
                           window.location = base_url + 'app/' + _module + '/' +_class + '/update' +location.search;
                        }
                    },
                    error: function() {
                      alert('Error');
                    },
                });
          }
      });
  });

  $(document).on('click','#reject,#l-reject',function(e){
      e.preventDefault();
      _this     = $(this);
      id        = _this.data('id');
      type      = _this.attr('id');
      message   = '<legend>Reject ?</legend> \
                   <textarea id="remarks" placeholder="Remarks"></textarea> \
                  ';
      confirm(message, function(confirmed) {
        if(confirmed){ 
        remarks   = $('#remarks').val();
             $.ajax({
                  method:'POST',
                  dataType:'json',
                  data:{id:id,
                        type:type,
                        DT_Remarks:remarks},
                    url: base_url+'app/'+_module+'/'+_class+'/process',
                    success: function(results){                            
                      if(results.status==0){
                          if(results.message){
                            alert(results.message);
                          }else{
                            alert('Failed');
                          }
                        }else{
                          alert('Success!');
                          location.reload();
                        }
                    },
                    error: function() {
                      alert('Error');
                    },
                });
          }
      });
  });

  $(document).on('click','.functions li a:not(#track-document,#l-track-document,#show-account-summary,#reject,#l-reject,#split-check,#released-check,#returned-check,#cleared-check,#l-re-open,#re-open,#customer,#supplier,#item,#general,#bank,#post_to)',function(e){
      e.preventDefault();
      _this   = $(this);
      id    = _this.data('id'),
      type  = _this.attr('id')
      confirm(_this.text()+'?', function(confirmed) {
          
            if(confirmed){ 
              switch(_this.attr('id')){
                case 'print': 
                  popup(base_url+'app/'+_module+'/'+_class+'/print_document/'+id,'','800','800');
                break;
                default:
                    
                    var url = base_url+'app/'+_module+'/'+_class+'/process';
                    
                    //  for dmr                    
                    if (_this.attr('id') == 'dmr-jo') {
                        url = base_url+'app/'+_module+'/job-order/createFromDMR';
                    }
                    
                 $.ajax({
                      method:'POST',
                      dataType:'json',
                      data:{id:id,
                          type:type},
                        url: url,
                        success: function(results){                            
                          if(results.status==0){
                              if(results.message){
                                alert(results.message);
                              }else{
                                alert('Failed');
                              }
                            }else{
                              switch(type){
                                case 'cancel': 
                                   window.location = base_url + 'app/' + _module + '/' +_class;
                                break;

                                case 'cancel-approval':
                                  window.location = base_url + 'app/' + _module + '/' +_class + '/update' +location.search;
                                break;
                                default:
                                  alert('Success!');
                                  location.reload();
                              }
                            }
                        },
                        error: function(jqXHR,textStatus,errorThrown) {
                          alert(jqXHR.responseText);
                        },
                    });
                }
            }

        });
    });   

  $('.dropdown').on({
    "shown.bs.dropdown": function() { this.closable = false; },
    "click":             function() { this.closable = true; },
    "hide.bs.dropdown":  function() { return this.closable; }
  });
 
  $('[data-toggle="collapse"]').on('click',function(){
    if($(this).find('.glyphicon').hasClass('glyphicon-plus-sign')){
      $(this).find('.glyphicon').removeClass('glyphicon-plus-sign').addClass('glyphicon-minus-sign');
    }else{
      $(this).find('.glyphicon').removeClass('glyphicon-minus-sign').addClass('glyphicon-plus-sign');
    }
  });

  function hideElements() {
    var $containerWidth = $(window).width();
    if ($containerWidth <= 768) {
      $('#right-cont').removeClass('col-sm-12').addClass('col-sm-10');
      $('#left-cont').show();
      $('.dash-nav').show();
      $(window).trigger('resize.ScrollToFixed');
    }else{
      $('.dash-nav').hide();
      $('#mob-nav').removeClass('in');
      $(window).trigger('resize.ScrollToFixed');
    }
  };
  
  $('#toggle-nav').on('click',function(){
    $('.table').floatThead('reflow');
    if($('#right-cont').hasClass('col-sm-10')){
      $('#right-cont').removeClass('col-sm-10').addClass('col-sm-12');
      $('#left-cont').hide();
      $('#toggle-nav span').removeClass('glyphicon-triangle-left').addClass('glyphicon-triangle-right');
      $('#header').trigger('resize.ScrollToFixed');
    }else{
      $('#right-cont').removeClass('col-sm-12').addClass('col-sm-10');
      $('#left-cont').show();
      $('#toggle-nav span').removeClass('glyphicon-triangle-right').addClass('glyphicon-triangle-left');
      $('#header').trigger('resize.ScrollToFixed');
    }
  });

  $('table th input[type=checkbox]').on('click',function(){
    ind   = $(this).closest('th').index();
    check   = this.checked;
    $('tbody tr').each(function(index){
      $(this).find('td:eq('+ind+') input[type=checkbox]').prop('checked', check);
    });

  });

   $('li.active a').on('click',function(){
    return false;
  });

  $(document).ready(function () {
      $('.no-sort').on('click',function(e){
        e.preventDefault();
      });
      $('.no-sort').closest('th').on('click',function(e){
        e.preventDefault();
      });
      hideElements();
      $('.navbar-header').scrollToFixed({
        maxWidth:768,
        zIndex:10004
      });
    
      $('#header').scrollToFixed({
        minWidth:768,
        zIndex:10001,
      });

      $(window).resize(function() {
          hideElements();  
          $('#header').trigger('resize.ScrollToFixed');
      });  
     
     // loc = window.location.pathname.split( '/' );

     // if(loc[4].length > 0 && loc[3].length > 0){
     //   active = base_url+'app/'+loc[3]+'/'+loc[4];
     //   console.log(active);
     //   $('#side-nav a[href="'+active+'"]').addClass('disabled').closest('li').addClass('active');
       
     //   $('#side-nav a[href="'+active+'"]').on('click',function(){
     //      return false;
     //   });
     // }

     // $.fn.bootstrapSwitch.defaults.size = 'mini';

     // $('form input[type=checkbox]:not(table input[type=checkbox])').bootstrapSwitch({ 
     //      'onText':'Yes',
     //      'offText':'No',
     //      onSwitchChange:function(event,state){
     //        $(this).closest('form').trigger('change');
     //      }
     //    });
    
     // $('form input[type=text].form-control:not(table input[type=text].form-control)').maxlength({
     //      warningClass: "label label-info",
     //      limitReachedClass: "label label-warning",
     //      placement: 'top',
     //      preText: 'Used ',
     //      separator: ' of ',
     //      appendToParent:true,
     //      postText: ' character'
     //  });
     

     //#content
     $('#side-nav').slimScroll({
          color: '#00f',
          size: '10px',
          height: '100%',
          alwaysVisible: false
      });

  });  

  $(window).load(function(){
    var segments = $(location).attr('href').split( '/' );
    seg  = segments[5];
    data = JSON.parse(localStorage.getItem(seg));
    if(data && data.length > 0){
      $.each(data,function(index){
        $('a[data-target="'+data[index]+'"]').attr('aria-expanded','true').removeClass('collapsed').find('.glyphicon').removeClass('glyphicon-plus-sign').addClass('glyphicon-minus-sign');
        $(data[index]).attr('aria-expanded','true').addClass('in');
        $('#side-nav').scrollTop(localStorage.getItem('s-scroll'));
      });
    }else{
      localStorage.clear();
    }

   });
  $(window).unload(function() {
    var segments = $(location).attr('href').split( '/' );
    seg = segments[5];
    data = [];
    $('#side-nav a[aria-expanded="true"]').each(function(){
      data.push($(this).data('target'));
    });
    localStorage.setItem(seg,JSON.stringify(data));
    localStorage.setItem('s-scroll',$('#side-nav').scrollTop());
  });

  
