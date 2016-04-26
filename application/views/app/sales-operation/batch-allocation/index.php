<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<table class="presentation table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>
						</th>
						<th>Document No.</th>
						<th>Document Date</th>
						<th>Ref No.</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="edit">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>IO-10001</td>
						<td>12/02/15</td>
						<td>BR-10001</td>
						<td>Pending</td>
					</tr>	
				</tbody>
			</table>
		</div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

  	$('.modal').find('.table').bind('dynatable:init', function(e, dynatable) {
	   $('.modal').find('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
	    $(this).wrap('<div class="table-container"></div>')
	    var $demo1 = $(this);
			$demo1.floatThead({
				scrollContainer: function($table){
					return $table.closest('.table-container');
				}
		});

		$("#date-from,#date-to").datepicker({ dateFormat: 'yy-mm-dd'});
	}).dynatable();

	$('.modal').on('shown.bs.modal', function (e) {
		_this = $(this);
		_this.find('.table').floatThead('reflow');
	});

});
</script>