<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">
			<?=$title?>
			<a class="cls-btn pull-right" href="<?=base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3)."/update?id=".$this->input->get('id'))?>" >
	        Close
	      </a>
		</h3>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<?=generate_table($table)?>
		</div>
	</div>
</div>
<script type="text/javascript">
var	table = $('#tbl-supplier-ledger').bind('dynatable:init', function(e, dynatable) {
    	$('#dynatable-search-tbl-supplier-ledger').prepend('Date Filter: <input type="search" data-dynatable-query="date-from" name="date-from" id="date-from"/><input type="search" data-dynatable-query="date-to" name="date-to" id="date-to"/> ')
    	.append("<a  href='javascript:void(0)' class='clear'>Clear</a>");

    	// var options = []; 
    	// $('#tbl-customer-ledger th').each(function(){
    	// 	options.push({id:$(this).data('dynatable-column'),value:$(this).text())})
    	// });

    	var options = $('#tbl-supplier-ledger th').map(function () {
                return '<option value='+$(this).data('dynatable-column')+'>'+$(this).text()+'</option>';
                
            }).get();

    	$('#dynatable-per-page-tbl-supplier-ledger').after(' Filter By: <select id="supplier-filter"><option value="">-Select-</option>'+options+'</select>')
   		
   		$('#supplier-filter').change(function(){
   		var value = $(this).val();
		  if (value === "") {
		    dynatable.queries.remove("supplier-filer");
		  } else {
		    dynatable.queries.add("supplier-filer",value);
		  }
		  dynatable.process();
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


		$('.clear').on('click',function(){
			dynatable.sorts.clear();
			dynatable.queries.remove("search");
			dynatable.queries.remove("supplier-filer");
			dynatable.queries.remove("date-from");
			dynatable.queries.remove("date-to");
			$('[type=search]').val('');
			$('#supplier-filter').val('');
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
		    ajaxUrl: base_url + "app/administration/supplier/supplier_ledger_data?id=<?= $this->input->get('id') ?>",
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