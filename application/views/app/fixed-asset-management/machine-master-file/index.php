<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?><!-- 
          	<span class="dropdown pull-right">
				<a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                	Functions
                	<span class="caret"></span>
              	</a>
              	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
	                <li><a href="">Activate</a></li>
					<li><a href="">Deactivate</a></li>
				</ul>
            </span> -->
      	</h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<table class="presentation table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>
							<a href="<?= base_url().uri_string() ?>/add" class="">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th>Machine ID (Asset ID)</th>
						<th>Machine Code (Item Code)</th>
						<th>Machine Name</th>
						<th>Machine Type</th>
						<th>Transfer Cost</th>
						<th>Sales Sharing</th>
						<th>Payback</th>
						<th>Payout</th>
						<th>Company</th>
						<th>Store / Location</th>
						<th>FA Posting Group</th>
						<th>Status</th>

					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/edit" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="<?= base_url().uri_string() ?>/view" class="edit">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>Machine ID (Asset ID)</td>
						<td>Machine Code (Item Code)</td>
						<td>Machine Name</td>
						<td>Machine Type</td>
						<td>Transfer Cost</td>
						<td>Sales Sharing</td>
						<td>Payback</td>
						<td>Payout</td>
						<td>Company</td>
						<td>Store / Location</td>
						<td>FA Posting Group</td>
						<td>Status</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.item-tbl').bind('dynatable:init', function(e, dynatable) {
    $('.dynatable-per-page').append('Type: <select class="filter col-sm-2"><option disabled selected>Type</option></select> ');
    $('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    $(this).wrap('<div class="table-container"></div>')
    var $demo1 = $(this);
    $demo1.floatThead({
      scrollContainer: function($table){
        return $table.closest('.table-container');
      }
    });
  }).dynatable();

</script>