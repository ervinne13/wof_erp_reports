window._originalAlert = window.alert;
window.alert = function(text) {
    var bootStrapAlert = function() {
        if(! $.fn.modal.Constructor)
            return false;
        if($('#windowAlertModal').length == 1)
            return true;
        $('body').append(' \
                          <div id="windowAlertModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"> \
                          <div class="modal-dialog modal-sm"> \
                            <div class="modal-content"> \
                             <div class="modal-header"> \
                                <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> \
                                <h4 class="modal-title">Alert</h4> \
                             </div> \
                              <div class="modal-body"> \
                                <p> alert text </p> \
                              </div> \
                              <div class="modal-footer"> \
                                    <button class="btn btn-default form-btn sub-clr" data-dismiss="modal" aria-hidden="true">Close</button> \
                              </div> \
                            </div> \
                          </div> \
                        </div> \
                          ');
        return true;
    }
    if ( bootStrapAlert() ){
        $('#windowAlertModal .modal-body p').text(text);
        $('#windowAlertModal').modal({backdrop:"static",keyboard:false});
    }  else {
        console.log('bootstrap was not found');
        window._originalAlert(text);
    }
}
window._originalConfirm = window.confirm;
window.confirm = function(text, cb) {
    var initTemplate = function(){
      if($('#windowConfirmModal').length == 1)
        return true;
      $('body').append(' \
                        <div id="windowConfirmModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"> \
                          <div class="modal-dialog modal-sm"> \
                            <div class="modal-content"> \
                             <div class="modal-header"> \
                                <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> \
                                <h4 class="modal-title">Confirm</h4> \
                             </div> \
                              <div class="modal-body"> \
                                <p> alert text </p> \
                              </div> \
                              <div class="modal-footer"> \
                                <button class="btn btn-default form-btn main-clr" data-dismiss="modal" aria-hidden="true">Ok</button> \
                                <button class="btn btn-default form-btn sub-clr" data-dismiss="modal" aria-hidden="true">Cancel</button> \
                              </div> \
                            </div> \
                          </div> \
                        </div> \
                      ');
    }

    var bootStrapConfirm = function() {
      if(! $.fn.modal.Constructor)
          return false;

      $('body').off('click', '#windowConfirmModal .main-clr');
      $('body').off('click', '#windowConfirmModal .sub-clr');

      function confirm() { cb(true); }
      function deny() { cb(false); }

      $('body').on('click', '#windowConfirmModal .main-clr', confirm);
      $('body').on('click', '#windowConfirmModal .sub-clr', deny);

      return true;
    }

    initTemplate()

    if ( bootStrapConfirm() ){
        $('#windowConfirmModal .modal-body p').html(text);
        $('#windowConfirmModal').modal({backdrop:"static",keyboard:false});
    }  else {
        console.log('bootstrap was not found');
        cb(window._originalConfirm(text));
    }
}