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
					  	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['CV_DocNo'] ?>">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Doc. Date:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= format($data['CV_DocDate']) ?>">
					  </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier ID:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['CV_SupplierID'] ?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Supplier Name:</label>
				      <div class="col-xs-7">
				      		<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['CV_SupplierName'] ?>">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Supplier Address:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['CV_SupplierAddress'] ?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Payment Terms:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['CV_PaymentTerms'] ?>">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Needed:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= format($data['CV_DateRequired']) ?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Due Date:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= format($data['CV_DueDate']) ?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Ext Doc No.:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['CV_ExtDocNo'] ?>">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Bank:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['CV_Bank'] ?>">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Currency:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['CV_Currency'] ?>">
				       </div> 
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Check No.:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['CV_CheckNo'] ?>">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Check Date:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= format($data['CV_CheckDate']) ?>">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Check Amount:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= numeric($data['CV_CheckAmount'])?>">
				       </div> 
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['CV_Remarks'] ?>">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control" id="" disabled tabindex="9" value ="<?= $data['CV_Status'] ?>">
				      </div>
				    </div>
				</span>
			</form>
			<div class="details">Details</div>
			<?=generate_table($table)?>
		</div>
	</div>
</div>
<div class="modal fade" id="cv-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">CV Details</h4>
          </div>
          <div class="modal-body">
            <table id="cv-tbl" class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th data-dynatable-column="checkbox" data-dynatable-no-sort='true'><input type="checkbox"></th>
                  <th data-dynatable-column="CVD_RefDocNo">Ref Doc. No.</th>
                  <th data-dynatable-column="CVD_RefDocDate">Ref Doc. Date</th>
                  <th data-dynatable-column="CVD_Amount">Amount</th>
                  <th data-dynatable-column="CVD_Remarks">Remarks</th>
                  <th data-dynatable-column="CVD_Comment">Comment</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default form-btn main-clr" data-id="<?= $data['CV_DocNo'] ?>" id="convert-items">Convert</button>
      </div>
        </div>
    </div>
</div>

<script type="text/javascript">

var $cv_item,table;
 
 

 $(document).on('click','#split-check',function(e){
      e.preventDefault();
      _this     = $(this);
      id        = _this.data('id');
      type      = _this.attr('id');
      message   = '<legend>Split Into?</legend> \
                  <input type=text id="split_into" placeholder="Split Into"> \
                  ';
      confirm(message, function(confirmed) {
        if(confirmed){ 
        split_into   = $('#split_into').val();
             $.ajax({
                  method:'POST',
                  dataType:'json',
                  data:{id:id,
                        type:type,
                        split_into:split_into},
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
                    error: function(a,b,c) {
                      alert('Error');
                    },
                });
          }
      });
  });

 $cv_item =  $('#cv-tbl').bind('dynatable:init', function(e, dynatable) {
   					$(this).wrap('<div class="table-container"></div>');
   					$(this).floatThead({
			          scrollContainer: function($table){
			            return $table.closest('.table-container');
			          }
			      	});
				}).dynatable({
				      	inputs: {
				          	processingText: '<img  id="loader" src="'+base_url+'css/assets/data_loader.gif" />'
				      	}
				}).data('dynatable');

  $('#cv-modal').on('hide.bs.modal', function () { 
    	$cv_item.settings.dataset.originalRecords = '';
    	$cv_item.process();
  });

  $('#convert-items').on('click',function(){
  	$btn = $(this);
  	var data = [];
  	$('#cv-modal table tbody tr').each(function(){
  		_this = $(this).find('td:eq(0) input[type=checkbox]');
  		if(_this.prop('checked') == true){
	  		details =  _this.data('doc');
	  		details['CVD_Comment']   = $(this).find('.cv_comment').val();
	  		details['CVD_PFK_DocNo'] = $btn.data('id');
  			data.push(details);
  		}
  	});
  	confirm("Convert APV?", function(confirmed) {
    	if(confirmed){ 
		  	$.ajax({
			        url:  base_url + "app/"+_module+"/"+_class+"/process/",
			        type: 'post',
			        data: {type:'convert',data:JSON.stringify(data)},
			        dataType:'json',
			        success: function(data) {
			        	if(data==1){
			        		alert('Saved');
			        		$('#cv-modal').modal('toggle');
			        		location.reload();
			        	}else{
			        		alert('Failed');
			        	}
					},
					error:function(){
						alert('Error!');
					}
			    });
		    }
		});
  });

  $('#cv-modal').on('shown.bs.modal', function (event) {
      $.ajax({
	        url:  base_url + "app/"+_module+"/"+_class+"/items/",
	        type: 'get',
	        data: {id:$(event.relatedTarget).data('id')},
	        dataType:'json',
	        success: function(data) {
	           $cv_item.records.updateFromJson({records: data});
			   $cv_item.records.init();
			   $cv_item.process();
			   $('#cv-tbl').floatThead('reflow');
			},
			error:function(){
				alert('Error!');
			}
	    });
 	});

table = $('#tbl-check-voucher-details').bind('dynatable:init', function(e, dynatable) {
    	$('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
	
		$(document).on('click','.det-delete',function(e){
			e.preventDefault();
		 	_this = $(this);
		      confirm("Delete Record?", function(confirmed) {
		        if(confirmed){ 
		          $.post(base_url+'app/'+ _module + "/" +_class+'/process',{id:_this.data('id'),type:'delete-details'},function(data){
		            if(data == 1){
		            	alert('Deleted!');
		            	setTimeout(function(){
						  location.reload();
						}, 500);
		            }else{
		            	alert('Failed!');
		            }
		          }).error(function(){
		            alert('Error!');
		          });
		        }
		    });
		});

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


	// update_functions();
 //  	function update_functions(){

	// 	if(typeof(EventSource) !== "undefined") {
	// 	    var source = new EventSource(base_url + "app/"+ _module + "/" + _class + "/data_update?" + $.param(table.params));

	// 	    source.onmessage = function(event) {
	//     		if($.param(JSON.parse(event.data)) !== $.param($result)){
	// 	    		table.process();
	// 	    	}
 //    			source.close();
 //    			setTimeout(function(){
	// 				update_functions();
 //    			},5000);
	// 	    };
	// 	} else {
	// 	   console.log("not supported");
	// 	}

 //    }
</script>