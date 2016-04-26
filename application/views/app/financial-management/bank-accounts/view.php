<div class="panel">
  <div class="panel-heading">
  <h3 class="panel-title">
            <?=$title?>
            <?php 
              $module = isset($_SERVER['HTTP_REFERER'])? explode('/',$_SERVER['HTTP_REFERER']):'';
              $module = end($module);
            ?>
            <a class="cls-btn pull-right" href="<?= isset($_SERVER['HTTP_REFERER']) && $module == 'document-approval' ?$_SERVER['HTTP_REFERER']: base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
        Close
      </a>
        </h3>
  </div>
  <div class="panel-body">
    <div id="data-container" class="container-fluid">
      <form class="form-horizontal row page-form" role="form" class="container-fluid">
        <span class="col-md-4">     
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Bank ID:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['BA_BankID']; ?></label>
                </div>
              </div> 
            <div class="form-group">
                <label class="control-label col-xs-5" for="">Bank Name:</label>
                <div class="col-xs-7">
                    <label class="control-label "><?= $data['BA_BankName']?></label>
                </div>
            </div> 
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Bank Account Type:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['BA_BankAccountType']; ?></label>
                </div>
            </div> 
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Bank Account No.:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['BA_BankAccountNo']; ?></label>
                </div>
            </div> 
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Bank Address:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['BA_BankAddress'] ?></label>
                </div>
            </div>
      </span>
      <span class="col-md-4">  
           <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Swift Code:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['BA_SwiftCode'] ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Contact No.:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['BA_ContactNo']; ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Contact Name :</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['BA_ContactName']; ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Fax No.:</label>
                <div class="col-xs-7">
                   <label for="sel1" class="control-label "><?= $data['BA_FaxNo']; ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Currency:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['BA_Currency'] ?></label>
                </div>
            </div>            
      </span>
      <span class="col-md-4">  
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Bank G/L Account:</label>
                <div class="col-xs-7">
                   <label for="sel1" class="control-label "><?= $data['COA_AccountName']; ?></label>
                </div>
            </div>
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Book Balance:</label>
                <div class="col-xs-7">
                   <label for="sel1" class="control-label "><?= $data['BA_BookBalance']?></label>
                </div>
            </div>
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Date Opened:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label " ><?= date_format(date_create($data['BA_DateOpened']),'m-d-Y'); ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Date Closed:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= date_format(date_create($data['BA_DateClosed']), 'm-d-Y'); ?></label>
                </div>
            </div>
             <div class="form-group">
                <label class="control-label col-xs-5" for="">Active:</label>
                <div class="col-xs-7">
                  <input type="checkbox"   <?=$data['BA_Active']=='1'?'checked':''?>>
                </div>
              </div>     
        </span>
      </form>
      <div class="details">Bank Account Series</div>
        <table class="table table-striped table-hover table-bordered  table-condensed" id="bank-table">
          <thead>
            <tr>
              <th>No. Series Type</th>
              <th>No. Series Code</th>
              <th>Starting No.</th>
              <th>Ending No.</th>
              <th>Last No Used</th>
              <th>Active</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Check No (In Use)</td>
              <td><?= $data['BA_InUseCode']?></td>
              <td><?= $data['BA_InUseStartingNo']?></td>
              <td><?= $data['BA_InUseEndingNo']?></td>
              <td><?= $data['BA_InUseLastNoUsed']?></td>
              <td><input type="checkbox"<?=$data['BA_InUseActive']=='1'?'checked':''?> disabled></td>
            </tr>
             <tr>
              <td>Check No (Reserve)</td>
              <td><?= $data['BA_ReserveCode']?></td>
              <td><?= $data['BA_ReserveStartingNo']?></td>
              <td><?= $data['BA_ReserveEndingNo']?></td>
              <td><?= $data['BA_ReserveLastNoUsed']?></td>
              <td><input type="checkbox"<?=$data['BA_ReserveActive']=='1'?'checked':''?> disabled></td>
            </tr>
             <tr>
              <td>Debit Memo</td>
              <td><?= $data['BA_DMCode']?></td>
              <td><?= $data['BA_DMStartingNo']?></td>
              <td><?= $data['BA_DMEndingNo']?></td>
              <td><?= $data['BA_DMLastNoUsed']?></td>
              <td><input type="checkbox"<?=$data['BA_DMActive']=='1'?'checked':''?> disabled></td>
            </tr>
             <tr>
              <td>Withdrawal</td>
              <td><?= $data['BA_WCode']?></td>
              <td><?= $data['BA_WStartingNo']?></td>
              <td><?= $data['BA_WEndingNo']?></td>
              <td><?= $data['BA_WLastNoUsed']?></td>
              <td><input type="checkbox"<?=$data['BA_WActive']=='1'?'checked':''?> disabled></td>
            </tr>
             <tr>
              <td>Telegraphic Transfer</td>
              <td><?= $data['BA_TTCode']?></td>
              <td><?= $data['BA_TTStartingNo']?></td>
              <td><?= $data['BA_TTEndingNo']?></td>
              <td><?= $data['BA_TTLastNoUsed']?></td>
              <td><input type="checkbox"<?=$data['BA_TTActive']=='1'?'checked':''?> disabled></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <table>
              <tr>
                <th>No Series Type</th>
              </tr>
              <tr>
                  <td>Check No (In Use)</td>
              </tr>
              <tr>
                  <td>Check No (Reserve)</td>
              </tr>
              <tr>
                  <td>Debit Memo</td>
              </tr>
              <tr>
                  <td>Withdrawal</td>
              </tr>
              <tr>
                  <td>Telegraphic Transfer</td>
              </tr>
      </table> -->
  </div>
</div>
<script type="text/javascript">

$('#bank-table').dynatable();
var table = $('#tbl-bank-accounts-series').bind('dynatable:init', function(e, dynatable) {
      $('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
  
  $(document).on('click','.det-update',function(e){
      e.preventDefault();
      window.location = base_url+'app/'+ _module + "/" +_class+ '/view/update/?id=' + $(this).data('id');

    });  
    
    $('.clear').on('click',function(){
      dynatable.sorts.clear();
      dynatable.queries.remove("search");
      $('[type=search]').val('');
      $(".dynatable-arrow").remove();
      dynatable.process();
    });

    $("#date-from,#date-to").datepicker({ dateFormat: 'mm-dd-yy'});

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
        ajaxUrl: base_url + "app/"+ _module + "/" + _class + "/series-data/?id="+"<?=$this->input->get('id')?>",
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