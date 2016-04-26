(function ( $ ) {
           
    function button(elem,target){
        return elem.after('<a class="input-group-addon" href="'+target+'" data-toggle="modal" data-target="#NoSeriesModal"> \
                            <span class="glyphicon glyphicon-option-horizontal"></span> \
                        </a> \
                        ');
    }
    function modal(){
        return $('body').append(' \
                          <div id="NoSeriesModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"> \
                          <div class="modal-dialog modal-md"> \
                            <div class="modal-content"> \
                             <div class="modal-header"> \
                                <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> \
                                <h4 class="modal-title">No Series</h4> \
                             </div> \
                              <div class="modal-body"> \
                                <img  id="loader" class="center-block img-responsive" src="'+base_url+'css/assets/data_loader.gif" /> \
                              </div> \
                              <div class="modal-footer"> \
                                    <button class="btn btn-default form-btn sub-clr" data-dismiss="modal" aria-hidden="true">Close</button> \
                              </div> \
                            </div> \
                          </div> \
                        </div> \
                          ');
    }
    
  $.fn.numseries = function(options){
            
            var settings = $.extend({
                target  : '',
                method  : 'add',
                modal:{
                        target: '',
                        selecttarget: '',
                      }
            }, options );

            var _this = this;

            _this.on('beforeSend',settings.beforeSend);
            _this.on('afterSend',settings.afterSend);
            _this.on('sendFailed',settings.sendFailed);
            _this.on('modal:afterSend',settings.modal.afterSend);
            _this.on('modal:sendFail',settings.modal.sendFail);
                   
            _this.attr('readonly',true);

            _this.on('proccess',function(){
                switch(settings.method){
                    case 'add':
                        $.get(settings.target,function(data){
                            result = JSON.parse(data);
                            if(result.rows == 0){
                                _this.attr('readonly',false);
                                _this.trigger('afterSend',result);
                            }else{
                                _this.trigger('beforeSend');
                                _this.parent().addClass('input-group primary');
                                if(result.rows == 1){
                                    _this.val(result.data).attr('readonly',true);
                                    _this.trigger('afterSend',result);
                                }else{
                                    if($('#NoSeriesModal').length !=1){
                                        modal();
                                    }
                                    
                                    $('#NoSeriesModal').on('hide.bs.modal', function () { 
                                        $('#NoSeriesModal').removeData('bs.modal');
                                    });
                                    
                                    $('#NoSeriesModal').on('show.bs.modal', function () {
                                        $('#NoSeriesModal .modal-content .modal-body').html('<img  id="loader" class="center-block img-responsive" src="'+base_url+'css/assets/data_loader.gif" />'); 
                                    });
                                                            
                                    button(_this,settings.modal.target);
                                
                                }
                            }
                        }).error(function(){
                            _this.trigger('sendFailed');
                            _this.attr('readonly',false);
                        });
                    break;
                    case 'update':
                        $.get(settings.target+'_update',function(data){
                            result = JSON.parse(data);
                            if(result.rows == 0){
                                _this.attr('readonly',false);
                            }else{
                                _this.attr('readonly',true);
                            }
                        }).error(function(){
                            _this.trigger('sendFailed');
                            _this.attr('readonly',false);
                        });
                    break;
                    default: return false;
                
            };
        });
        
        $(document).on('click','#series-ok',function(){
            var btn = $(this);
            var lbl = btn.text();
            var ns  = $('input[name=NS_Id]:checked');
            if(ns.length == 1){
                btn.text('Processing...').attr('disabled',true);
                $.post(settings.modal.selecttarget,{type:'docseries','NS_Id':ns.val()},function(data){
                    res = JSON.parse(data);
                    if(res.result == 1){
                        _this.val(res.data).attr('readonly',true).next('.input-group-addon').hide();
                        _this.trigger('modal:afterSend',res);
                    }else{
                        _this.trigger('modal:sendFailed');
                    }
                    $('#NoSeriesModal').modal('hide');
                }).error(function(){
                    btn.text(lbl).attr('disabled',false);
                    _this.trigger('modal:sendFailed');
                });
            }else{
                alert('Select series!');
            }   
        });

        this['setting'] = settings;
        this['process'] = _this.trigger('proccess',settings);

        return this;
    };

}( jQuery ));

