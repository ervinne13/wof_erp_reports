<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<?=generate_table($table)?>
		</div>
		<legend>For CV</legend>
		<div id="data-container" class="container-fluid">
			<?=generate_table($tableAPV)?>
		</div>
	</div>
</div>
<script type="text/javascript">
var	table = $('#tbl-check-voucher').bind('dynatable:init', function(e, dynatable) {
		$('#dynatable-search-tbl-check-voucher').prepend('Date Filter: <input type="search" data-dynatable-query="date-from" name="date-from" id="date-from"/><input type="search" data-dynatable-query="date-to" name="date-to" id="date-to"/> ')
    	.append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    	
    	$(this).wrap('<div class="table-container"></div>')
	    var $demo1 = $(this);
			$demo1.floatThead({
				scrollContainer: function($table){
					return $table.closest('.table-container');
				}
		});

    	$(document).on('change','.release',function(e){
		      e.preventDefault();
		      _this     = $(this);
		      id        = _this.attr('id');
		      type      = 'released-check';
		      status	= this.checked ? 1 : 0;
		      dateInput = '<input type="date" placeholder="Date Required" id="dateReleased" >';
		    
		      if(_this.prop('checked') == true){
		      	 message   = '<legend>Release?</legend> \
			                 '+dateInput+' \
			                  ';
			     confirm(message, function(confirmed) {
			     	//$("#dateReleased").datepicker({ dateFormat: 'yy-mm-dd'});
			     	if(confirmed){ 
			     		$.ajax({
		                  	method:'POST',
		                  	dataType:'json',
		                  	data:{	id:id,
		                        	type:type,
		                        	dateReleased:$('#dateReleased').val(),
		                        	status:status	},
		                    url: base_url+'app/'+_module+'/'+_class+'/process',
		                    success: function(results){                            
		                      if(results.status==0){
		                          if(results.message){
		                            alert(results.message);
		                          	dynatable.process();
		                          }else{
		                            alert('Failed');
		                          	dynatable.process();
		                          }
		                        }else{
		                        	dynatable.process();
		                        }
		                        $demo1.floatThead('reflow');
		                    },
		                    error: function() {
		                      alert('Error');
		                    },
		                });
			     	}
			     });
		      }else{
	             $.ajax({
	                  method:'POST',
	                  dataType:'json',
	                  data:{id:id,
	                        type:type,
	                        status:status},
	                    url: base_url+'app/'+_module+'/'+_class+'/process',
	                    success: function(results){                            
	                      if(results.status==0){
	                          if(results.message){
	                            alert(results.message);
	                          	dynatable.process();
	                          }else{
	                            alert('Failed');
	                          	dynatable.process();
	                          }
	                        }else{
	                        	dynatable.process();
	                        }
	                    },
	                    error: function() {
	                      alert('Error');
	                    },
	                });
	            }
		  });

		 $(document).on('change','.cleared',function(e){
		      e.preventDefault();
		      _this     = $(this);
		      id        = _this.attr('id');
		      type      = 'cleared-check';
		      status	= this.checked ? 1 : 0;
	            $.ajax({
	              method:'POST',
	              dataType:'json',
	              data:{id:id,
	                    type:type,
	                	status:status},
	                url: base_url+'app/'+_module+'/'+_class+'/process',
	                success: function(results){                            
	                  if(results.status==0){
	                      if(results.message){
	                        alert(results.message);
	                      	dynatable.process();
	                      }else{
	                        alert('Failed');
	                      	dynatable.process();
	                      }
	                    }else{
	                    	dynatable.process();
	                    }
	                },
	                error: function() {
	                  alert('Error');
	                },
	            });
		  });

    	$('#date-from').on('change', function() {
		  var value = $(this).val();
		  if (value === "") {
		    dynatable.queries.remove("date-from");
		  } else {
		    dynatable.queries.add("date-from",value);
		  }
		  dynatable.process();
		});

		$('#date-to').on('change', function() {
		  var value = $(this).val();
		  if (value === "") {
		    dynatable.queries.remove("date-to");
		  } else {
		    dynatable.queries.add("date-to",value);
		  }
		  dynatable.process();
		});
		
		$('#dynatable-search-tbl-check-voucher .clear').on('click',function(){
			dynatable.sorts.clear();
			dynatable.queries.remove("search");
			dynatable.queries.remove("date-from");
			dynatable.queries.remove("date-to");
			$('[type=search]').val('');
			$(".dynatable-arrow").remove();
			dynatable.process();
		});

		$("#date-from,#date-to").datepicker({ dateFormat: 'mm-dd-yy'}).mask("99-99-9999");
		
    	$('.activate').on('click',function(){
			id = [];
			$('table .doc:checkbox:checked').each(function(){
				id.push($(this).attr('id'));
			});
			data = [];
			data.push({name:'id',value:JSON.stringify(id)},{name:'type',value:'activate'});
			confirm("Activate Account?", function(confirmed) {
		   		if(confirmed){
					$.post(base_url + "app/"+ _module + "/" + _class + "/process",data,function(){
						dynatable.process();
					});
				}
			});
		});

		$('.deactivate').on('click',function(){
			id = [];
			$('table .doc:checkbox:checked').each(function(){
				id.push($(this).attr('id'));
			});
			data = [];
			data.push({name:'id',value:JSON.stringify(id)},{name:'type',value:'deactivate'});
			confirm("Deactivate Account?", function(confirmed) {
	   			if(confirmed){
					$.post(base_url + "app/"+ _module + "/" + _class + "/process",data,function(){
						dynatable.process();
					});
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


	    
	}).bind('dynatable:afterUpdate', function(e, dynatable) {
		$('[data-toggle="tooltip"]').tooltip();	
	}).bind('dynatable:ajax:success', function(e, dynatable) {
		$(this).floatThead('reflow');
    }).dynatable({
		dataset: {
			ajax: true,
		    ajaxUrl: base_url + "app/"+ _module + "/" + _class + "/data",
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

var	apv = $('#tbl-accounts-payable-voucher').bind('dynatable:init', function(e, dynatable) {
    	 $('#dynatable-search-tbl-accounts-payable-voucher').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    		
		$('#dynatable-search-tbl-request-payment .clear').on('click',function(){
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
		    ajaxUrl: base_url + "app/"+ _module + "/" + _class + "/apv_data",
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