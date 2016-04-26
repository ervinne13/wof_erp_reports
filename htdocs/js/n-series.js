(function ( $ ) {
    
    $.fn.noseries = function(options) {
        
        var noSeries = function() {
            if(! $.fn.modal.Constructor)
                return false;
            if($('#NoSeriesModal').length == 1)
                return true;
            return true;
        }
        if ( noSeries() ){

            var settings = $.extend({
                target  : false,
                btn1    : false,
                repbtn1 : false,
                btn2    : false,
                repbtn2 : false,
                method  : 'add',
                extra   : ''
            }, options );

            _this = this;

            if(!settings.target){
                console.log('target not defined');
                return false;
            }
            _this.attr('readonly',true);
            switch(settings.method){
                case 'add':
                    $.get(settings.target+"/getseries",{extra:settings.extra},function(data){
                        result = JSON.parse(data);
                        if(result.rows == 0){
                            _this.attr('readonly',false);
                            return false;
                        }else{
                            _this.parent().addClass('input-group primary');
                            if(result.rows == 1){
                                _this.val(result.data).attr('readonly',true);
                                $('#'+settings.btn1).attr({'id':settings.repbtn1});
                                $('#'+settings.btn2).attr({'id':settings.repbtn2});
                                $('#'+settings.repbtn1).attr({'data-id':result.uniqid});
                                $('#'+settings.repbtn2).attr({'data-id':result.uniqid});
                            }else{
                                modal();
                                button(_this,settings.target+'/getseries_res/'+settings.extra);
                                $('#NoSeriesModal').on('hide.bs.modal', function () { 
                                    $('#NoSeriesModal').removeData('bs.modal');
                                });


                                $('#NoSeriesModal').on('show.bs.modal', function () {
                                    $('#NoSeriesModal .modal-content .modal-body').html('<img  id="loader" class="center-block img-responsive" src="'+base_url+'css/assets/data_loader.gif" />'); 
                                });

                                $(document).on('click','#series-ok',function(){
                                    var btn = $(this);
                                    var lbl = btn.text();
                                    var ns  = $('input[name=NS_Id]:checked');
                                    if(ns.length == 1){
                                        btn.text('Processing...').attr('disabled',true);
                                        $.post(settings.target+'/process',{type:'docseries','NS_Id':ns.val(),extra:settings.extra},function(data){
                                            res = JSON.parse(data);
                                            if(res.result == 1){
                                                _this.val(res.data).attr('readonly',true).next('.input-group-addon').hide();
                                                $('#NoSeriesModal').modal('hide');
                                                $('#'+settings.btn1).attr({'id':settings.repbtn1});
                                                $('#'+settings.btn2).attr({'id':settings.repbtn2});
                                                $('#'+settings.repbtn1).attr({'data-id':res.uniqid});
                                                $('#'+settings.repbtn2).attr({'data-id':res.uniqid});
                                            }else{
                                                alert('Failed');
                                            }
                                        }).error(function(){
                                            btn.text(lbl).attr('disabled',false);
                                            alert('Failed!');
                                        });
                                    }else{
                                        alert('Select series!');
                                    }
                                        
                                });
                            }
                        }
                    });
                break;
                case 'update':
                    $.get(settings.target+"/getseries_update",{extra:settings.extra},function(data){
                        result = JSON.parse(data);
                        if(result.rows == 0){
                            _this.attr('readonly',false);
                        }else{
                            _this.attr('readonly',true);
                        }
                    });
                break;
                default: return false;


            }
            
            this['setting'] = settings;
            return this;

        }  else {
            console.log('n-series.js not found')
            alert('Error!');
        }

    }

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

}( jQuery ));