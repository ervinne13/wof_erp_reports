<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
          	<span class="dropdown pull-right">
              	<a class="cls-btn" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
				  Close
				</a>
            </span>
      	</h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Item No:</label>
					  <div class="col-xs-7">
				        <label for="sel1" class="control-label">RD100003</label>
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">Coke</label>
				      </div>
				    </div>
				</span>
			</form>
			<div class="details">Details</div>
			<table class="tbl-inv table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>
						</th>
						<th>Location</th>
						<th>On Hand</th>
						<th>On Hold</th>
						<th>In Transit</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>-detailed" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>SM- Megamall</td>
						<td>100</td>
						<td>2</td>
						<td>5</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>-detailed" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>Warehouse</td>
						<td>100</td>
						<td>2</td>
						<td>5</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.tbl-inv').bind('dynatable:init', function(e, dynatable) {
		 $('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'> Clear</a>");
	    $(this).wrap('<div class="table-container"></div>')
	    var $demo1 = $(this);
	    $demo1.floatThead({
	      scrollContainer: function($table){
	        return $table.closest('.table-container');
	      }
	    });
	  }).dynatable();
</script>
