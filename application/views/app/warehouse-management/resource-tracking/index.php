<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
      	</h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<div role="tabpanel">
				<ul class="nav nav-tabs" id="resource-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#vehicle" role="tab" data-toggle="tab">Vehicle</a></li>
				    <li role="presentation"><a href="#space"  role="tab" data-toggle="tab">Space</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="vehicle">
						<table class="vehicle-tbl table table-striped table-hover table-bordered  table-condensed">
							<thead>
								<tr>
									<th>RT#</th>
									<th>TO#</th>
									<th>Schedule</th>
									<th>Vehicle Assigned</th>
									<th>From</th>
									<th>To</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>RT10001</td>
									<td>TO10001</td>
									<td>12/15/2015</td>
									<td>Vehicle100001</td>
									<td>Warehouse</td>
									<td>SM - Megamall</td>
									<td>Delivered</td>
								</tr>
								<tr>
									<td>RT10002</td>
									<td>TO10002</td>
									<td>12/15/2015</td>
									<td>Vehicle100002</td>
									<td>Warehouse</td>
									<td>SM - Megamall</td>
									<td>Ongoing</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div role="tabpanel" class="tab-pane" id="space">
						<table class="space-tbl table table-striped table-hover table-bordered  table-condensed">
							<thead>
								<tr>
									<th>Location</th>
									<th>Description</th>
									<th>Capacity(CBF)</th>
									<th>Available Space(CBF)</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>WH10001</td>
									<td>Warehouse 1</td>
									<td>1000</td>
									<td>250</td>
								</tr>
								<tr>
									<td>WH10002</td>
									<td>Warehouse 2</td>
									<td>800</td>
									<td>100</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td></td>	
									<td>TOTAL:</td>	
									<td>1800</td>	
									<td>350</td>	
								</tr>
							</tfoot>
						</table>
						<div class="details">Details</div>
						<table class="line-tbl table table-striped table-hover table-bordered  table-condensed">
							<thead>
								<tr>
									<th>Type</th>
									<th>Document No.</th>
									<th>Expected Delivery Date</th>
									<th>Space Required(CBM)</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Purchase</td>
									<td>PO10001</td>
									<td>10/10/2015</td>
									<td>50</td>
								</tr>
								<tr>
									<td>Transfer</td>
									<td>TO10001</td>
									<td>10/12/12</td>
									<td>100</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td></td>	
									<td></td>	
									<td>TOTAL:</td>	
									<td>150</td>	
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<script type="text/javascript">
	$('#resource-tabs a').click(function (e) {
	  $(this).tab('show');
	});
	$('.space-tbl').bind('dynatable:init', function(e, dynatable) {
	
    $(this).closest('.tab-pane').find('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
	    $(this).wrap('<div class="table-container"></div>')
	$(this).closest('.tab-pane').find('.dynatable-per-page').append('Location Lvl: <select class="filter col-sm-2" ><option disabled selected>Location Level</option></select> ');
	    
	    var initFloatThead = function(){
		     var $table = $('.table-container table:visible'); //table must be visible to init properly
		     $table.floatThead({
		         //useAbsolutePositioning: true,
		         scrollContainer: function ($table) {
		             return $table.closest('.table-container');
		         }
		     });
		     $table.find('.FakeHeader').hide();
		}

		$('a[data-toggle="tab"]').on('shown.bs.tab', initFloatThead);
		initFloatThead();

	  }).dynatable();

	$('.vehicle-tbl').bind('dynatable:init', function(e, dynatable) {
	
    $(this).closest('.tab-pane').find('.dynatable-search').prepend('Date Filter: <input type="search" id="date-from"/><input type="search"  id="date-to"/> ')
	    .append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
	$(this).closest('.tab-pane').find('.dynatable-per-page').append('Shipper: <select class="filter col-sm-2" ><option disabled selected>Shipper</option></select> ');
	    $(this).wrap('<div class="table-container"></div>')
	    var initFloatThead = function(){
		     var $table = $('.table-container table:visible'); //table must be visible to init properly
		     $table.floatThead({
		         //useAbsolutePositioning: true,
		         scrollContainer: function ($table) {
		             return $table.closest('.table-container');
		         }
		     });
		     $table.find('.FakeHeader').hide();
		}

		$('a[data-toggle="tab"]').on('shown.bs.tab', initFloatThead);
		initFloatThead();

	    $("#date-from,#date-to").datepicker({ dateFormat: 'yy-mm-dd'});
	  }).dynatable();

	$('.line-tbl').bind('dynatable:init', function(e, dynatable) {
	
    
	   $(this).wrap('<div class="table-container"></div>')
	    var initFloatThead = function(){
		     var $table = $('.table-container table:visible'); //table must be visible to init properly
		     $table.floatThead({
		         //useAbsolutePositioning: true,
		         scrollContainer: function ($table) {
		             return $table.closest('.table-container');
		         }
		     });
		     $table.find('.FakeHeader').hide();
		}

		$('a[data-toggle="tab"]').on('shown.bs.tab', initFloatThead);
		initFloatThead();

	    $("#date-from,#date-to").datepicker({ dateFormat: 'yy-mm-dd'});
	  }).dynatable();
</script>