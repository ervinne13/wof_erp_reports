<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">
			<?=$title?>
		</h3>
	</div>
	
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<?=generate_table($table)?>
		</div>
		<div id="data-container" class="container-fluid">
			<?=generate_table($tableAPV)?>
		</div>
	</div>
</div>
<script type="text/javascript">
var	table = $('#tbl-'+_class).bind('dynatable:init', function(e, dynatable) {
    	$('#dynatable-search-'+'tbl-'+_class).prepend('Date Filter: <input type="search" data-dynatable-query="date-from" name="date-from" id="date-from"/><input type="search" data-dynatable-query="date-to" name="date-to" id="date-to"/> ')
    	.append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    	
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
		
		$('#dynatable-search-'+'tbl-'+_class+' .clear').on('click',function(){
			dynatable.sorts.clear();
			dynatable.queries.remove("search");
			dynatable.queries.remove("date-from");
			dynatable.queries.remove("date-to");
			$('[type=search]').val('');
			$(".dynatable-arrow").remove();
			dynatable.process();
		});


		$('#dynatable-search-tbl-amortization-prepaid-expense .clear').on('click',function(){
			dynatable.sorts.clear();
			dynatable.queries.remove("search");
			dynatable.queries.remove("date-from");
			dynatable.queries.remove("date-to");
			$('[type=search]').val('');
			$(".dynatable-arrow").remove();
			dynatable.process();
		});

		$("#date-from,#date-to").datepicker({ dateFormat: 'mm-dd-yy'}).mask("99-99-9999");

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

var	apv = $('#tbl-accounts-payable-prepaid').bind('dynatable:init', function(e, dynatable) {
    	 $('#dynatable-search-tbl-accounts-payable-prepaid').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    		
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