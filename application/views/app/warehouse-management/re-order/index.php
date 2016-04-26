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
					<li><a href="<?= base_url().uri_string() ?>/item-catalogue">Item Catalogue</a></li>
					<li><a href="">Convert to RQ</a></li>
              	</ul>
            </span>
      	</h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<table class="r-o-tbl table table-striped table-hover table-bordered  table-condensed">
				<thead>
					<tr>
						<th><input type='checkbox'></th>
						<th>Item No.</th>
						<th>Description</th>
						<th>Re-Order Point</th>
						<th>On-Hand Qty</th>
						<th>Qty to Order</th>
						<th>Additional Forecast Qty</th>
						<th>Qty on Order</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type='checkbox'></td>
						<td>FA100001</td>
						<td>Hllo Kitty</td>
						<td>1000</td>
						<td>700</td>
						<td>300</td>
						<td>
							<a href="" data-toggle="modal" data-target=".r-o-modal" class="">
								<span class="glyphicon glyphicon-plus-sign"></span>
							</a>
						</td>
						<td>200</td>
					</tr>	  
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade r-o-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Additional Forecast Qty</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-12">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-3">Qty:</label>
					  <div class="col-xs-9">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Qty">
				      </div>
					</div>
				</span>
			</form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default form-btn main-clr">Save</button>
      </div>
    </div>
  </div>
</div>	
<script type="text/javascript">
	$('.r-o-tbl').bind('dynatable:init', function(e, dynatable) {
    $('.dynatable-per-page').append('Type: <select class="filter col-sm-2" ><option disabled selected>Type</option></select> ');
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