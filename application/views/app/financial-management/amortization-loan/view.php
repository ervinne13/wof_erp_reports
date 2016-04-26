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
      <?php if($functions){ ?>  
            <span class="dropdown pull-right">
        <a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
            Functions
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu functions" role="menu" aria-labelledby="dropdownMenu1">
            <li>
              <?=$functions?>
            </li>
          </ul>
      </span>
      <?php } ?>
        </h3>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">			
				    <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
                <div class="col-xs-7">
                   <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['AMLH_DocNo']; ?>">
                </div>
              </div> 
            <div class="form-group">
                <label class="control-label col-xs-5" for="">Doc. Date:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= format($data['AMLH_DocDate']) ?>">
                </div>
            </div> 
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Bank Account:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['AMLH_BankAccount']; ?>">
                </div>
            </div>
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Loan Amount:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= numeric($data['AMLH_LoanAmount']); ?>">
                </div>
            </div>
        </span>
        <span class="col-md-4">  
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Running Balance:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= numeric($data['AMLH_RunningBalance']); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Ext. DocNo:</label>
                <div class="col-xs-7">
                   <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['AMLH_ExtDocNo']; ?>">
                </div>
            </div> 
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Remarks:</label>
                <div class="col-xs-7">
                   <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['AMLH_Remarks']; ?>">
                </div>
            </div>
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">No. of Months:</label>
                <div class="col-xs-7">
                   <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['AMLH_NoOfMonths']; ?>">
                </div>
            </div>
          </span>
          <span class="col-md-4"> 
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Annual Interest Rate:</label>
                <div class="col-xs-7">
                     <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= numeric($data['AMLH_AnnualInterestRate'])."%"; ?>">
                </div>
            </div>
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Company:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['AMLH_Company']; ?>">
                </div>
            </div>
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Cost Center:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['AMLH_CostCenter']; ?>">
                </div>
            </div>
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Status:</label>
                <div class="col-xs-7">
                     <input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['AMLH_Status']; ?>">
                </div>
            </div>
				</span>
			</form>
      <div class="details">Details</div>
      <?=generate_table($table)?>
    </div>
			<hr>
			
	</div>
</div>
<script type="text/javascript">
var table = $('#tbl-amortization-loan-details').bind('dynatable:init', function(e, dynatable) {
      $('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
  

  $(document).on('click','.det-update',function(){
        window.location = base_url+'app/'+ _module + "/" +_class+ '/view/update/?id=' + $(this).data('id');
    });
      
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
    $('.clear').on('click',function(){
      dynatable.sorts.clear();
      dynatable.queries.remove("search");
      $('[type=search]').val('');
      $(".dynatable-arrow").remove();
      dynatable.process();
    });

    $("#date-from,#date-to").datepicker({ dateFormat: 'yy-mm-dd'});

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
        ajaxUrl: base_url + "app/"+ _module + "/" + _class + "/details-data/?id="+"<?=$this->input->get('id')?>",
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