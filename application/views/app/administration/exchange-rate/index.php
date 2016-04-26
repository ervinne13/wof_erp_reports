<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">
			<?=$title?>
			<?=$function?>
		</h3>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<?=generate_table($table)?>
		</div>
	</div>
</div>
<script type="text/javascript">
var	table = $('#tbl-'+_class).bind('dynatable:init', function(e, dynatable) {
    	$('.dynatable-search')
    	.prepend('Date Filter: <input type="search" data-dynatable-query="date-from" name="date-from" id="date-from"/><input type="search" data-dynatable-query="date-to" name="date-to" id="date-to"/>')
    	.append("<a  href='javascript:void(0)' class='clear'>Clear</a>");

    	$('.activate').on('click',function(){
			id = [];
			$('table .doc:checkbox:checked').each(function(){
				id.push($(this).attr('id'));
			});
			data = [];
			data.push({name:'id',value:JSON.stringify(id)},{name:'type',value:'activate'});
			confirm("Activate Exchange Rate?", function(confirmed) {
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
			confirm("Deactivate Exchange Rate?", function(confirmed) {
	   			if(confirmed){
					$.post(base_url + "app/"+ _module + "/" + _class + "/process",data,function(){
						dynatable.process();
					});
				}
			});
		});

		$(document).on('click','.l-del',function(){
		 	_this = $(this);
		      confirm("Delete Record?", function(confirmed) {
		        if(confirmed){ 
		          $.post(base_url+'app/'+ _module + "/" +_class+'/process',{id:_this.data('id'),type:'delete'},function(data){
		            if(data == 1){
		            	alert('Deleted!');
		            	setTimeout(function(){
						  dynatable.process();
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

		$('.approve').on('click',function(){
			id = [];
			$('table .doc:checkbox:checked').each(function(){
				id.push($(this).attr('id'));
			});
			data = [];
			data.push({name:'id',value:JSON.stringify(id)},{name:'type',value:'approve'});
			confirm("Approve?", function(confirmed) {
	   			if(confirmed){
					$.post(base_url + "app/"+ _module + "/" + _class + "/process",data,function(){
						dynatable.process();
					});
				}
			});
		});

		$('.cancel').on('click',function(){
			id = [];
			$('table .doc:checkbox:checked').each(function(){
				id.push($(this).attr('id'));
			});
			data = [];
			data.push({name:'id',value:JSON.stringify(id)},{name:'type',value:'cancel'});
			confirm("Cancel Approval?", function(confirmed) {
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
			dynatable.queries.remove("date-from");
			dynatable.queries.remove("date-to");
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

	$('#date-from').on('change', function() {
	  var value = $(this).val();
	  if (value === "") {
	    table.queries.remove("date-from");
	  } else {
	    table.queries.add("date-from",value);
	  }
	  table.process();
	});

	$('#date-to').on('change', function() {
	  var value = $(this).val();
	  if (value === "") {
	    table.queries.remove("date-to");
	  } else {
	    table.queries.add("date-to",value);
	  }
	  table.process();
	});
	
</script>