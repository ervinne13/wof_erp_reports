<div class="panel">
  <div class="panel-heading">
    <h5 class="panel-title"><?=$title?></h5>
  </div>
  <div class="panel-body">
    <div id="data-container" class="container-fluid">
      <form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
        <span class="col-md-6">
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
            <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="1" name="PC_DocNo" placeholder="Document No.">
              </div>
          </div>  
          <div class="form-group">
              <label class="control-label col-xs-5" for="">Description:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="15" value="" data-id="" name="PC_Description" placeholder="Description">
              </div>
          </div>                                      
          <div class="form-group">
              <label class="control-label col-xs-5" for="">Location:</label>
              <div class="col-xs-7">
                <?php 
                $location   = $this->session->userdata('location');
                $dlocation  = $this->session->userdata('dlocation')['SP_StoreID'];
                $dcompany   = $this->session->userdata('dlocation')['SP_FK_CompanyID'];
                if(count($location) > 1){ 
                ?>
                <select class="form-control single-default" placeholder="Location" id="lc" name="PC_Location" tabindex="9">
                  <option value="" disabled selected>Location</option>
                  <?php foreach ($location as $key => $value) { ?>
                    <option value="<?=$value['SP_StoreID']?>" <?= $dlocation==$value['SP_StoreID']?'selected':''?> ><?=$value['SP_StoreName']?></option>
                  <?php } ?>
                </select>
                <?php }else{ ?>
                <input type="text" class="form-control" id="" readonly value="<?=$location[0]['SP_StoreID']?>" tabindex="9" name="PC_Location" placeholder="Location">
                <?php } ?>
              </div>
          </div>
        </span>
            <span class="col-md-6">
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Doc. Date:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" disabled tabindex="8" value="<?=date("m/d/Y",time())?>" name= "PC_DocDate" placeholder="Document Date">
              </div>
            </div>  
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Count Date:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" id="" tabindex="14" name="PC_CountDate" placeholder="Count Date">
              </div>
            </div>            
            <div class="form-group">
              <label class="control-label col-xs-5" for="">Status:</label>
              <div class="col-xs-7">
                <input type="text" class="form-control" readonly id="status" tabindex="15" value="" data-id="" name="PC_Status" placeholder="Status">
              </div>
            </div>    
      </span>       
     <div class="container-fluid">
          <legend>Physical Count Sheet</legend>
          <div class="table-container">
            <table id="others-tbl" class="table table-striped table-hover table-bordered  table-condensed">
              <thead>
                <tr>
                  <th class="col-md-1">
                    <a href="javascript:void(0)" class="pre-row">
                      <span class="glyphicon glyphicon-plus"></span>
                    </a>
                  </th>
                  <th class="col-md-2">Count Sheet No</th>
                  <th class="col-md-4">Item Type</th>
                   <th class="col-md-4">Sub Location</th>
                </tr>
              </thead>
              <tbody id ="test">
                <tr class="h-row pcs-row">
                  <td>
                    <a href="javascript:void(0)" class="d-row-n">
                      <span class="glyphicon glyphicon-remove"></span>
                    </a>
                  </td>
                  <td>
                   <div class="form-group container-fluid">
                      <div class="col-md-1 pcs-count-sheet-no">
                     </div>
                   </div>
                  </td>
                  <td>
                    <div class="form-group container-fluid">
                      <div class="col-sm-9">
                        <select class="form-control single-default select-mul pcs-item-type" placeholder="Item Type" multiple id="" name="PCS_ItemType" tabindex="25">
                            <option value="" disabled selected></option>
                            <?php 
                              if(!empty($itemtype)){
                                foreach ($itemtype['data'] as $key => $value) {
                            ?>
                              <option value="<?=trim($value['IT_Id'])?>" ><?=$value['IT_Description']?></option>
                            <?php }} ?>
                        </select>
                      </div>  
                    </div>
                  </td>
                  <td>
                    <div class="form-group container-fluid">
                      <div class="col-sm-9">
                        <select class="form-control single-default select-multi" placeholder="SubLocation" multiple id="" name="PCS_SubLocation" tabindex="25">
                            <option value="" disabled selected>SubLocation</option>
                            <?php 
                              if(!empty($locat)){
                                foreach ($locat['data'] as $key => $value) {
                            ?>
                              <option value="<?=trim($value['LOC_Id'])?>" ><?=$value['LOC_Id']?></option>
                            <?php }} ?>
                        </select>
                      </div>  
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </form>
      <hr>
      <div class="btn-cont">
        <a type="button" tabindex="28" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
          Save
        </a>
        <a type="button" tabindex="29" href="<?= base_url() ?>app/sales-operation/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
           Cancel
        </a>
        <!-- <button type="button" id="test-button">
           Test
        </button> -->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
(function ( $ ) {

var locJSON   = <?= json_encode($locat['data']); ?>;
  
var locStrucJSON= <?= json_encode($locStructure['data']); ?>;

var detailsFields = [];

_module = 'sales-operation';

// $('#test-button').click(function() {
  
//   var details = [];

//   for (var i = 0; i < detailsFields.length; i ++) {
//     detailsRow = detailsFields[i];
//     details.push({
//       PCS_CS_CountSheetNo: detailsRow.countSheetNo,
//       PCS_ItemType: detailsRow.itemTypeSel[0].selectize.getValue(),
//       PCS_SubLocation: detailsRow.subLocSel[0].selectize.getValue()
//     });

//   }
//   console.log(details);
// });

  // $selectmul = $(".select-mul").selectize({
  //       create: false,
  //       plugins:['restore_on_backspace','remove_button'],
  //       sortField: 'text',
  //       selectOnTab: true
  // });

  //  $selectmul1 = $(".select-multi").selectize({
  //       create: false,
  //       plugins:['restore_on_backspace','remove_button'],
  //       sortField: 'text',
  //       selectOnTab: true
  // });

  //   $selectmul2 = $(".select-multiple").selectize({
  //       create: false,
  //       plugins:['restore_on_backspace','remove_button'],
  //       sortField: 'text',
  //       selectOnTab: true
  // });

$('input[name=PC_CountDate]').datepicker({
    dateFormat:'mm/dd/yy'
  }).mask("99/99/9999");

$('.pre-row').on('click',function(){
    _this   = $(this);
    row   = _this.closest('table').find('tbody tr.h-row').clone();
    _this.closest('table').find('tbody').append(row.show(300).removeClass('h-row'));
    id = (new Date()).getTime();

var countSheetNo = $('#test tr').length-1;
row.find('td:eq(1)').text(countSheetNo);
var itemTypeSel = stize(row.find('.select-mul').attr('name','['+id+'][PCS_ItemType]'));
var subLocSel = stize(row.find('.select-multi').attr('name','['+id+'][PCS_SubLocation]'));

/*get the data upon adding row*/
    detailsFields.push({
      countSheetNo:countSheetNo,
      itemTypeSel: itemTypeSel,
      subLocSel: subLocSel
    });    
  });

$(document).on('click','.d-row-n',function(){
    _this = $(this);
    confirm("Delete Row?", function(confirmed) {

          if(confirmed){ 
        _this.closest('tr').fadeOut(500, function(){ $(this).remove();});
        $('#update').attr('disabled',false);
      }

    });

  });

  if($('select[name=PC_Location]').length > 0){
    $loca = $('select[name=PC_Location]').selectize({
                      sortField: 'text',
                      create: false,
              onItemRemove:function(value){
                $('#com_id').val('');
              },
                      onChange: function(value) {
                        if (!value.length) return;
                        for(var i in locJSON){
                      if(value == locJSON[i]['SP_StoreID']){
                        curLoc = locJSON[i]['LOC_Id'];
                        
                        break;
                      }
                    }
              }
                  });

    loca  = $loca[0].selectize;
    loca.setValue('<?=$dlocation?>');
  }

  $select = $('.select-cli').each(function(index, obj){
                $(this).selectize({
                  sortField: 'text',
                  plugins: {
            'dropdown_header': {
              title: $(obj).attr('placeholder')
            }
          }
                });
              });

  $sel = $('.u-sel').each(function(){
    stize($(this));
  });

function stize(elem){
    $el = elem.selectize({
                      sortField: 'text',
                      plugins: {
            'dropdown_header': {
            }
            },
      
    });

    return $el;
  }

function get_sub(loc_id,subLocArray){
    for(var i in locStrucJSON){
      if(locStrucJSON[i]['LOC_Parent_id'] == loc_id){
        if(locStrucJSON[i]['LOC_Parent_id']){
          subLocArray.push(locStrucJSON[i]['LOC_Id']);
          get_sub(locStrucJSON[i]['LOC_Id'],subLocArray);
        }
      }
    }
    return subLocArray;
}

 $nseries = $('input[name=PC_DocNo]').numseries({
                  target:base_url+'app/'+_module+'/'+_class+'/getseries',
                  method:'add',
                  beforeSend:function(){
                    $('#save-new,#save-close').attr('disabled',true);
                  },
                  afterSend:function(e,data){
                    if(data.rows == 0){
                      alert('No series available!');
                      setTimeout(function(){
                        window.location = base_url + 'app/' + _module + '/' + _class;
                      },1000);
                    }else{
                      $('#save-new').attr({'disabled':false,'id':'update-new'});
                      $('#save-close').attr({'disabled':false,'id':'update'});
                      $('#update-new').attr('data-id',data.uniqid);
                      $('#update').attr('data-id',data.uniqid);
          }
                  },
                  sendFailed:function(){
                    $('#save-new').attr({'disabled':false});
                    $('#save-close').attr({'disabled':false});
                    alert('Series Generation Failed!');
                  },
                  modal:{
                        target:base_url+'app/'+_module+'/'+_class+'/seriesmodal',
                        selecttarget:base_url+'app/'+_module+'/'+_class+'/process',
                        afterSend:function(e,data){
                          $('#save-new').attr({'disabled':false,'id':'update-new'});
                          $('#save-close').attr({'disabled':false,'id':'update'});
                          $('#update-new').attr('data-id',data.uniqid);
                          $('#update').attr('data-id',data.uniqid);
                          },
                        }
              });

  $(document).on("click","#update-new",function(){
      var $btn = $(this);
      var $lbl = $btn.text();
      var form = $('#'+_class+"-form");
      
      confirm("Save Entry?", function(confirmed) {
          if(confirmed){ 
          
            $btn.attr('disabled',true).text('Processing..');
            data = form.serializeArray();            
            //name: is attribute
            data.push({name:"type",value:'update'},
                      {name:"uniqid",value:$btn.data('id')}
                      
                      // {name:"details",value:JSON.stringify(details)}
                      );

          var formData = new FormData();          

          var details = [];

          for (var i = 0; i < detailsFields.length; i ++) {
              detailsRow = detailsFields[i];
              details.push({ //push the object onto the array
              PCS_CS_CountSheetNo: detailsRow.countSheetNo,
              PCS_ItemType: detailsRow.itemTypeSel[0].selectize.getValue(),
              PCS_SubLocation: detailsRow.subLocSel[0].selectize.getValue()
            });
          }

            $(form).find('input[type=checkbox]').each(function() {
               data.push({ name: this.name, value: this.checked ? 1 : 0 });
            });

        $.each(data, function (key, input) {
            formData.append(input.name, input.value);
        });

        formData.append('details', JSON.stringify(details));

      $.ajax({
            url: base_url+'app/sales-operation/physical-count/process',
            type: 'POST',
            data: formData,
            dataType:'json',
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.result == 0){
                  error_message(data.errors);
              }else{
                location.reload();
              }
              $btn.attr('disabled',false).text($lbl);
        },
        error:function(){
          alert('Error!');
                $btn.attr('disabled',false).text($lbl);
        }
        }); 
        }
    });
  });

  $(document).on("click","#update",function(){
      var $btn = $(this);
      var $lbl = $btn.text();
      var form = $('#'+_class+"-form");
      
      confirm("Save Entry?", function(confirmed) {
          if(confirmed){ 
          
            $btn.attr('disabled',true).text('Processing..');
            data = form.serializeArray();            
            //name: is attribute
            data.push({name:"type",value:'update'},
                      {name:"uniqid",value:$btn.data('id')}
                      // {name:"details",value:JSON.stringify(details)}
                      );

          var formData = new FormData();          

          var details = [];

          for (var i = 0; i < detailsFields.length; i ++) {
            detailsRow = detailsFields[i];
            details.push({ //push the object onto the array
              PCS_CS_CountSheetNo: detailsRow.countSheetNo,
              PCS_ItemType: detailsRow.itemTypeSel[0].selectize.getValue(),
              PCS_SubLocation: detailsRow.subLocSel[0].selectize.getValue()
            });
          }

            $(form).find('input[type=checkbox]').each(function() {
               data.push({ name: this.name, value: this.checked ? 1 : 0 });
            });

        $.each(data, function (key, input) {
            formData.append(input.name, input.value);
        });

        formData.append('details', JSON.stringify(details));

    // console.log(details);

      $.ajax({           
            url: base_url+'app/sales-operation/physical-count/process',   //form processing file URL        
            type: 'POST', //method type
            data: formData,
            dataType:'json',
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.result == 0){
                  if (data.error) {
                    alert(data.error);
                  }
                  error_message(data.errors);
              }else{
                alert('Saved!');
                    window.location = base_url+'app/sales-operation/physical-count/update?id=' + $btn.data('id');
              }
              $btn.attr('disabled',false).text($lbl);
        },
        error:function(){
          alert('Error!');
              $btn.attr('disabled',false).text($lbl);
        }
        }); 
          }
      });
  });

}( jQuery ));
</script>
          