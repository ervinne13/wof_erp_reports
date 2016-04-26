<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
          	<span class="dropdown pull-right">
				<a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                	Functions
                	<span class="caret"></span>
              	</a>
              	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
	                <li><a href="">Activate</a></li>
					<li><a href="">Deactivate</a></li>
				</ul>
            </span>
      	</h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<table class="item-tbl table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>
							<a href="<?= base_url().uri_string() ?>/add" class="">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th><input type='checkbox'></th>
						<th>Type</th>
						<th>Item No.</th>
						<th>Purchase Description</th>
						<th>Sales Description</th>
						<th>Short Description</th>
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
						<td><input type='checkbox'></td>
						<td>Redemption</td>
						<td>RD100001</td>
						<td>Hello Kitty</td>
						<td>Hello Kitty</td>
						<td>Hello Kitty</td>
						<td>Active</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/edit" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="<?= base_url().uri_string() ?>/view" class="edit">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td><input type='checkbox'></td>
						<td>Redemption</td>
						<td>RD100002</td>
						<td>Coke</td>
						<td>Coke</td>
						<td>Coke</td>
						<td>Active</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/edit" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="<?= base_url().uri_string() ?>/view" class="edit">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td><input type='checkbox'></td>
						<td>Machine</td>
						<td>MA100001</td>
						<td>Indiana Jones</td>
						<td>Indiana Jones</td>
						<td>Indiana Jones</td>
						<td>Active</td>
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