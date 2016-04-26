<?php 
	$location 	= $this->session->userdata('location');
    $dlocation 	= $this->session->userdata('dlocation')['SP_StoreID'];
    $dcompany 	= $this->session->userdata('dlocation')['SP_FK_CompanyID'];
?>
<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
          	<a class="cls-btn pull-right" href="<?= $this->input->get('refFrom') ? base_url("app/".$this->uri->segment(2)."/document-approval"): base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
			  Close
			</a>
			<?=$functions?>
      	</h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="1" value="<?=$data['RQ_DocNo']?>" name="RQ_DocNo" placeholder="Document No.">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Purpose:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="1" value="<?=$data['RQ_Purpose']?>" name="RQ_DocNo" placeholder="Purpose">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly tabindex="4" value="<?=$data['RQ_Remarks']?>" name="RQ_Remarks" value=""  placeholder="Remarks">
				       </div> 
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="2" value="<?=format($data['RQ_DocDate'])?>" name="RQ_DocDate" value="<?=date("m/d/Y",time())?>" placeholder="Document Date">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Needed:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="" tabindex="2" value="<?=format($data['RQ_DateNeeded'])?>" name="RQ_DateNeeded" placeholder="Date Needed">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="1" value="<?=$data['RQ_Company']?>" name="RQ_DocNo" placeholder="Document No.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" readonly tabindex="1" value="<?=$data['RQ_Location']?>" name="RQ_DocNo" placeholder="Document No.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Attachment
				      <?php if($data['RQ_Attachment']){ ?>
				      	<span class="glyphicon glyphicon-download-alt" data-toggle="tooltip" data-placement="right" title="Download as ZIP" data-id="<?=$id?>" id="d-zip"></span> 
				      <?php } ?>
				      	:
				      </label>
				      	<div class="col-xs-7 attachment-head">
					      	<?php
				      			if($data['RQ_Attachment']){
				      				$attachment = json_decode($data['RQ_Attachment']);
				      				foreach ($attachment as $key => $value) {
				      		?>
	      					<div class="row container-fluid">
	      						<a href="<?=base_url().'uploads/'.$value?>" download class="uploaded-att control-label">
	      							<label class="control-label" for=""><?=$value?></label>
	      						</a>
	      					</div>
				      		<?php }} ?>
				    	</div>
				    </div>
				</span>
			</form>
			<div class="details">Details</div>
			<?=generate_table($table)?>
		</div>
	</div>
</div>
<div class="modal fade" id="doc-tracking-rq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Document Tracking</h4>
          </div>
          <div class="modal-body">
            <table id="doc-tracking-tbl-rq" class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th data-dynatable-column="DT_DocNo">Document No</th>
                  <th data-dynatable-column="DT_EntryDate">Entry Date</th>
                  <th data-dynatable-column="DT_Sender">Sender</th>
                  <th data-dynatable-column="DT_Location">Location</th>
                  <th data-dynatable-column="Position">Approver Position</th>                                
                  <th data-dynatable-column="ApprovedBy">Approver ID</th>
                  <th data-dynatable-column="DateApproved">Date Approved</th>
                  <th data-dynatable-column="DT_Status">Status</th>
                  <th data-dynatable-column="DT_Remarks">Remarks</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>
<script type="text/javascript">


var docID = '<?=$data["RQ_DocNo"]?>';
var doctracktablerq = $('#doc-tracking-tbl-rq').dynatable().data('dynatable');
  
  $(document).on('click','#rq-re-open',function(e){
      e.preventDefault();
      _this     = $(this);
      id    = [];
      type  = _this.attr('id');
      $('.doc').each(function(){
      	__this = $(this);
      	if(__this.prop('checked') == true){
	      	id.push(__this.attr('id'));
	    }
      });
      message   = '<legend>Re Open?</legend> \
                  <textarea id="remarks" placeholder="Remarks"></textarea> \
                  ';
      if(id.length > 0){
	      confirm(message, function(confirmed) {
	        if(confirmed){ 
	        remarks   = $('#remarks').val();
	             $.ajax({
	                  method:'POST',
	                  dataType:'json',
	                  data:{id:JSON.stringify(id),
	                        type:type,
	                        remarks:remarks},
	                    url: base_url+'app/financial-management/requisition/process',
	                    success: function(results){                            
	                      if(results.status==0){
	                          if(results.message){
	                            alert(results.message);
	                          }else{
	                            alert('Failed');
	                          }
	                        }else{
	                          if(type == 'cancel'){
	                            window.location = base_url + 'app/' + _module + '/' +_class;
	                          }
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
		}else{
			alert('No Document Selected!');
		}
  });

  $(document).on('click','#rq-reject',function(e){
      e.preventDefault();
      _this     = $(this);
      id    = [];
      type  = _this.attr('id');
      $('.doc').each(function(){
      	__this = $(this);
      	if(__this.prop('checked') == true){
	      	id.push(__this.attr('id'));
	    }
      });
      message   = '<legend>Reject ?</legend> \
                   <textarea id="remarks" placeholder="Remarks"></textarea> \
                  ';
        if(id.length > 0){
	      confirm(message, function(confirmed) {
	        if(confirmed){ 
	        remarks   = $('#remarks').val();
	             $.ajax({
	                  method:'POST',
	                  dataType:'json',
	                  data:{id:JSON.stringify(id),
	                        type:type,
	                        DT_Remarks:remarks},
	                    url: base_url+'app/financial-management/requisition/process',
	                    success: function(results){                            
	                      if(results.status==0){
	                          if(results.message){
	                            alert(results.message);
	                          }else{
	                            alert('Failed');
	                          }
	                        }else{
	                          if(type == 'cancel'){
	                            window.location = base_url + 'app/' + _module + '/' +_class;
	                          }
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
		}else{
			alert('No Document Selected!');
		}
  });

  $(document).on('click','.rq-function li a:not(#rq-re-open,#rq-reject)',function(e){
      e.preventDefault();
      _this   = $(this);
      id    = [];
      type  = _this.attr('id');
      $('.doc').each(function(){
      	__this = $(this);
      	if(__this.prop('checked') == true){
	      	id.push(__this.attr('id'));
	    }
      });
      if(id.length > 0){
	      confirm(_this.text()+'?', function(confirmed) {
	        
	            if(confirmed){ 
	              switch(_this.attr('id')){
	                case 'print': 
	                  popup(base_url+'app/'+_module+'/'+_class+'/print_document/'+id,'','800','800');
	                break;
	                default:
	                 $.ajax({
	                      method:'POST',
	                      dataType:'json',
	                      data:{id:JSON.stringify(id),
	                          type:type},
	                        url: base_url+'app/financial-management/requisition/process',
	                        success: function(results){                            
	                          if(results.status==0){
	                              if(results.message){
	                                alert(results.message);
	                              }else{
	                                alert('Failed');
	                              }
	                            }else{
	                              if(type == 'cancel'){
	                                window.location = base_url + 'app/' + _module + '/' +_class;
	                              }
	                              alert('Success!');
	                              location.reload();
	                            }
	                        },
	                        error: function(jqXHR,textStatus,errorThrown) {
	                          alert(jqXHR.responseText);
	                        },
	                    });
	                }
	            }

	        });
		}else{
			alert('No Document Selected!');
		}
    });   

  	$('#doc-tracking-rq').on('show.bs.modal', function (event) {
      
      	$('#doc-tracking-tbl-rq').floatThead('reflow');
 
 	 });

  $(document).on('click','#track-document-rq',function(){
	$('#doc-tracking-rq').modal('show');
	dataID = $(this).attr('data-id');
	$.ajax({
		        url: base_url + "app/document-tracking/data/"+dataID,
		        type: 'POST',
		        data: data,
		        dataType:'json',
		        success: function(data) {
					doctracktablerq.records.updateFromJson({records: data.records});
				    doctracktablerq.records.init();
				    doctracktablerq.process();
				},
				error:function(){
					alert('Error!');
				}
		    }); 
	
	});

$('.attachment-head').slimScroll({
          color: '#00f',
          size: '10px',
          height: '70px',
          alwaysVisible: false
      });


var	table = $('#tbl-requisition-details').bind('dynatable:init', function(e, dynatable) {

		select = $('<select/>',{id:'status-filter'});
		select.append('<option value="" >-select-</option><option value="open">Open</option><option value="approved">Approved</option><option value="pending">Pending</option><option value="cancelled">Cancelled</option>');
		$('#dynatable-search-'+'tbl-requisition-details').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    	$('#dynatable-per-page-tbl-requisition-details').after(select);

    	$('#status-filter').on('change', function() {
		  var value = $(this).val();
		  if (value === "") {
		    dynatable.queries.remove("statusFilter");
		  } else {
		    dynatable.queries.add("statusFilter",value);
		    $.ajax({
		        url: base_url + 'app/financial-management/requisition/get_functions',
		        type: 'POST',
		        data: {status:value,
					   docNo:docID},
		        dataType:'json',
		        success: function(data) {
		        	$('.cls-btn').next('.dropdown ').remove();
		        	$('.cls-btn').after(data);
				},
				error:function(){
					alert('Error!');
				}
		    }); 
		  }
		  dynatable.process();
		});

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
		    ajaxUrl: base_url + "app/financial-management/requisition/details-data/?id="+"<?=$this->input->get('id')?>",
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