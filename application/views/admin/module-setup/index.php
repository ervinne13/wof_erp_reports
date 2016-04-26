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
var	table = $('#tbl-module-setup').bind('dynatable:init', function(e, dynatable) {
    	$('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");

    	$('.activate').on('click',function(){
			id = [];
			$('table .ss:checkbox:checked').each(function(){
				id.push($(this).attr('id'));
			});
			data = [];
			data.push({name:'id',value:JSON.stringify(id)},{name:'type',value:'activate'});
			confirm("Activate Module?", function(confirmed) {
		   		if(confirmed){
					$.post(base_url + "admin/module-setup/process",data,function(){
						dynatable.process();
					});
				}
			});
		});

		$('.deactivate').on('click',function(){
			id = [];
			$('table .ss:checkbox:checked').each(function(){
				id.push($(this).attr('id'));
			});
			data = [];
			data.push({name:'id',value:JSON.stringify(id)},{name:'type',value:'deactivate'});
			confirm("Deactivate Module?", function(confirmed) {
	   			if(confirmed){
					$.post(base_url + "admin/module-setup/process",data,function(){
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
		$(this).wrap('<div class="table-container"></div>')
	    var $demo1 = $(this);
			$demo1.floatThead({
				scrollContainer: function($table){
					return $table.closest('.table-container');
				}
		});
		$('[data-toggle="tooltip"]').tooltip();	
	}).bind('dynatable:ajax:success', function(e, dynatable) {
		$(this).floatThead('reflow');
	}).dynatable({
		dataset: {
			ajax: true,
		    ajaxUrl: base_url + "admin/module-setup" + "/data",
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