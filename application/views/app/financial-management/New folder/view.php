<div class="panel">
	<div class="panel-heading">
	<h3 class="panel-title">
            <?=$title?>
            <a class="cls-btn pull-right" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
        Close
      </a>
            <?=$function?>
        </h3>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">			
				    <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Document No:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['AMLH_DocNo']; ?></label>
                </div>
              </div> 
            <div class="form-group">
                <label class="control-label col-xs-5" for="">Document Date:</label>
                <div class="col-xs-7">
                    <label class="control-label "><?=$data['AMLH_DocDate'];?></label>
                </div>
            </div> 
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Ref Doc.No.:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['AMLH_RefDocNo']; ?></label>
                </div>
            </div> 
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Type:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['AMLH_AmortType']; ?></label>
                </div>
            </div> 
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Amount:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['AMLH_AmortAmount']; ?></label>
                </div>
            </div>
           <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Remaining Amount:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['AMLH_RemAmount']; ?></label>
                </div>
            </div>
          </span>
          <span class="col-md-6">   
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Remarks:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['AMLH_Remarks']; ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Cost Center:</label>
                <div class="col-xs-7">
                   <label for="sel1" class="control-label "><?= $data['AMLH_CostCenter']; ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Period:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['AMLH_Period']; ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">No. of Payment:</label>
                <div class="col-xs-7">
                   <label for="sel1" class="control-label "><?= $data['AMLH_NoOfPayment']; ?></label>
                </div>
            </div>
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Starting Date:</label>
                <div class="col-xs-7">
                   <label for="sel1" class="control-label "><?= $data['AMLH_StartingDate']; ?></label>
                </div>
            </div>
             <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Status:</label>
                <div class="col-xs-7">
                    <label for="sel1" class="control-label "><?= $data['AMLH_Status']; ?></label>
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