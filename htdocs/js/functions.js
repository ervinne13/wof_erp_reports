 $.fn.serializeObject = function()
  {
      var o = {};
      var a = this.serializeArray();
      $.each(a, function() {
          if (o[this.name] !== undefined) {
              if (!o[this.name].push) {
                  o[this.name] = [o[this.name]];
              }
              o[this.name].push(this.value || '');
          } else {
              o[this.name] = this.value || '';
          }
      });
      return o;
  };
  
function check_if_changed(form,button){
    var form_data = form.serialize();
    button.attr('disabled',true);
    $(document).on('change',form.find(':input,select'),function(){
      if(form.serialize() != form_data){
        button.attr('disabled',false);
      }else{
        button.attr('disabled',true);
      }
    });
  };

function getdescription(){

  var ident = "";

     $('.select-iden').each(function(){
      ident += " "+$(this).find('option:selected').text();
     });
     
  $('input[name=IM_Sales_Desc]').val($('select[name=IM_FK_SubCategory_id] option:selected').text()+ident);
};

function getitemidadd(){
    
  $('input[name=IM_Item_id]').val($('select[name=IM_FK_Category_id]').val() +"-"+
                                  $('select[name=IM_FK_SubCategory_id]').val());

};

function getitemidupdate(){
  var str = $('input[name=IM_Item_id]').val();
  var result = str.split('-');
  var id = result[result.length -1];
  $('input[name=IM_Item_id]').val($('select[name=IM_FK_Category_id]').val() +"-"+
                                  $('select[name=IM_FK_SubCategory_id]').val()+"-"+id);

};

function error_message(data){
  
  $('.form-group').removeClass('has-error').find('div:first .alert').remove();
  $.each(data,function(index,value){
            _this = $('[name="'+index+'"]');
            _this.before(
              '<div class="alert alert-danger" role="alert"> \
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> \
                  <span class="sr-only">Error:</span> \
                  ' + value + ' \
              </div>'
              ).closest('.form-group').addClass('has-error');
          });
  $('.form-group.has-error .form-control:first').focus();
  $('.form-group').not('.has-error').find('div:first .alert').remove();
};

function popup(url, title, w, h) {

  var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
  var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
  width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
  height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

  var left = ((width / 2) - (w / 2)) + dualScreenLeft;
  var top = ((height / 2) - (h / 2)) + dualScreenTop;
  var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

  if (window.focus) {
  newWindow.focus();
  }
}

function number_format(number, decimals, dec_point, thousands_sep) {

  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}


function in_array(needle, haystack, argStrict) {

  var key = '',
    strict = !! argStrict;

  if (strict) {
    for (key in haystack) {
      if (haystack[key] === needle) {
        return true;
      }
    }
  } else {
    for (key in haystack) {
      if (haystack[key] == needle) {
        return true;
      }
    }
  }

  return false;
}