<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?>
		<?=$function?>
		</h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<?=generate_table($table)?>
		</div>
	</div>
</div>
<script type="text/javascript">
var	table = $('.dynatable').bind('dynatable:init', function(e, dynatable) {
    	$('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
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

	
</script>