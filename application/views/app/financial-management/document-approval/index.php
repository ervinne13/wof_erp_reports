<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">
			<?=$title?>
			<?=$functions?>
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
    	$('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
	  	
		$('.clear').on('click',function(){
			dynatable.sorts.clear();
			dynatable.queries.remove("search");
			$('[type=search]').val('');
			$(".dynatable-arrow").remove();
			dynatable.process();
		});

		$('.batch-approve').on('click',function(){
			confirm("Approve?", function(confirmed) {
	   			if(confirmed){
					$('table .doc:checkbox:checked').each(function(index){
						id 	 = $(this).data('id');
						type = 'approve';
						target = $(this).data('target');
						$.post(base_url + "app/"+ target + "/process",{id:id,type:type},function(){
							if((index+1)==$('table .doc:checkbox:checked').length){
			    				dynatable.process();		
							}
						});
					});
				}
			});

		});

		$(document).on('click','.view-doc',function(){
			window.location = base_url + 'app/financial-management/document-approval/view/' + $(this).data('id');
		})

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
		    ajaxUrl: base_url + "app/financial-management/document-approval/data",
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