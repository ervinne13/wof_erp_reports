<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<div class="cont-tbl">
				<table class="h-1 table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>
								<a href="<?= base_url().uri_string() ?>/add" class="">
									<span class="glyphicon glyphicon-plus"></span>
								</a>
							</th>
							<th></th>
							<th>Document No.</th>
							<th>Document Date</th>
							<th>Count Date</th>
							<th>Remarks</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<a href="<?= base_url().uri_string() ?>/edit" class="">
									<span class="glyphicon glyphicon-edit"></span>
								</a>
							</td>
							<td><input type='checkbox'></td>
							<td>PY-10001</td>
							<td>12/02/15</td>
							<td>12/03/15</td>
							<td>[Remarks]</td>
							<td>Pending</td>
						</tr>
						<tr>
							<td>
								<a href="<?= base_url().uri_string() ?>/edit" class="">
									<span class="glyphicon glyphicon-edit"></span>
								</a>
							</td>
							<td><input type='checkbox'></td>
							<td>PY-10002</td>
							<td>11/02/15</td>
							<td>11/03/15</td>
							<td>[Remarks]</td>
							<td>Pending</td>
						</tr>
						<tr>
							<td>
								<a href="<?= base_url().uri_string() ?>/edit" class="">
									<span class="glyphicon glyphicon-edit"></span>
								</a>
							</td>
							<td><input type='checkbox'></td>
							<td>PY-10004</td>
							<td>10/02/15</td>
							<td>10/03/15</td>
							<td>[Remarks]</td>
							<td>Pending</td>
						</tr>	
					</tbody>
				</table>
			</div>
			<div class="details">Count Sheet</div>
			<div class="cont-tbl">
				<table class="h-2 table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>
								<a href="<?= base_url().uri_string() ?>/count-sheet-add" class="">
									<span class="glyphicon glyphicon-plus"></span>
								</a>
							</th>
							<th>Count Sheet No.</th>
							<th>Count Date</th>
							<th>Location</th>
							<th>Remarks</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<a href="<?= base_url().uri_string() ?>/count-sheet-edit" class="">
									<span class="glyphicon glyphicon-edit"></span>
								</a>
								<a href="<?= base_url().uri_string() ?>/view" class="edit">
									<span class="glyphicon glyphicon-search"></span>
								</a>
							</td>
							<td>CS-10001</td>
							<td>12/02/15</td>
							<td>SM - Megamall</td>
							<td>[Remarks]</td>
							<td>Pending</td>
						</tr>
						<tr>
							<td>
								<a href="<?= base_url().uri_string() ?>/count-sheet-edit" class="">
									<span class="glyphicon glyphicon-edit"></span>
								</a>
								<a href="<?= base_url().uri_string() ?>/view" class="edit">
									<span class="glyphicon glyphicon-search"></span>
								</a>
							</td>
							<td>CS-10002</td>
							<td>12/02/15</td>
							<td>SM - Megamall</td>
							<td>[Remarks]</td>
							<td>Pending</td>
						</tr>
						<tr>
							<td>
								<a href="<?= base_url().uri_string() ?>/count-sheet-edit" class="">
									<span class="glyphicon glyphicon-edit"></span>
								</a>
								<a href="<?= base_url().uri_string() ?>/view" class="edit">
									<span class="glyphicon glyphicon-search"></span>
								</a>
							</td>
							<td>CS-10003</td>
							<td>12/02/15</td>
							<td>SM - Megamall</td>
							<td>[Remarks]</td>
							<td>Pending</td>
						</tr>	
					</tbody>
				</table>
			</div>
		</div>
    </div>
</div>
<script type="text/javascript">
 $('.h-1').bind('dynatable:init', function(e, dynatable) {
    $(this).closest('.cont-tbl').find('.dynatable-search').prepend('Date Filter: <input type="search" id="date-from"/><input type="search"  id="date-to"/> ')
    .append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    $(this).wrap('<div class="table-container"></div>')
    var $demo1 = $(this);
    $demo1.floatThead({
      scrollContainer: function($table){
        return $table.closest('.table-container');
      }
    });
    $("#date-from,#date-to").datepicker({ dateFormat: 'yy-mm-dd'});
  }).dynatable();

 $('.h-2').bind('dynatable:init', function(e, dynatable) {
    $(this).closest('.cont-tbl').find('.dynatable-search').prepend('Date Filter: <input type="search" id="date-from"/><input type="search"  id="date-to"/> ')
    .append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    $(this).wrap('<div class="table-container"></div>')
    var $demo1 = $(this);
    $demo1.floatThead({
      scrollContainer: function($table){
        return $table.closest('.table-container');
      }
    });
    $("#date-from,#date-to").datepicker({ dateFormat: 'yy-mm-dd'});
  }).dynatable();
</script>