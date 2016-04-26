<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<table class="tbl-inv table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>
						</th>
						<th>Item No.</th>
						<th>Description</th>
						<th>On Hand</th>
						<th>On Hold</th>
						<th>In Transit</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>RD100001</td>
						<td>Hello Kitty</td>
						<td>100</td>
						<td>2</td>
						<td>5</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>RD100003</td>
						<td>Coke</td>
						<td>100</td>
						<td>10</td>
						<td>10</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>MA100003</td>
						<td>Indiana Jones</td>
						<td>5</td>
						<td>1</td>
						<td>1</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade adv-s-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Advance Filter</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <form id="" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-12">
					<div class="form-group">
				      	<label class="control-label col-xs-4" for="">Type:</label>
				      	<div class="col-xs-8">
					      	<select class="form-control single-default select-cli" id="" name="u_p_positionid" tabindex="5">
							  	<option value="" selected>Type</option>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-4" for="">Sub Type:</label>
				      	<div class="col-xs-8">
					      	<select class="form-control single-default select-cli" id="" name="u_p_positionid" tabindex="5">
							  	<option value="" selected>Sub Type</option>
							</select>
						</div>
				    </div>
				     <div class="form-group">
				      	<label class="control-label col-xs-4" for="">Category:</label>
				      	<div class="col-xs-8">
					      	<select class="form-control single-default select-cli" id="" name="u_p_positionid" tabindex="5">
							  	<option value="" selected>Category</option>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-4" for="">Location:</label>
				      	<div class="col-xs-8">
					      	<select class="form-control single-default select-cli" id="" name="u_p_positionid" tabindex="5">
							  	<option value="" selected>Location</option>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-4" for="">Gender:</label>
				      	<div class="col-xs-8">
					      	<select class="form-control single-default select-cli" id="" name="u_p_positionid" tabindex="5">
							  	<option value="" selected>Gender</option>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-4" for="">Department:</label>
				      	<div class="col-xs-8">
					      	<select class="form-control single-default select-cli" id="" name="u_p_positionid" tabindex="5">
							  	<option value="" selected>Department</option>
							</select>
						</div>
				    </div>
				    <div class="form-group">
				      	<label class="control-label col-xs-4" for="">Class:</label>
				      	<div class="col-xs-8">
					      	<select class="form-control single-default select-cli" id="" name="u_p_positionid" tabindex="5">
							  	<option value="" selected>Class</option>
							</select>
						</div>
				    </div>
				</span>
			</form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default form-btn main-clr">Go</button>
      </div>
    </div>
  </div>
</div>	
<script type="text/javascript">
	$('.tbl-inv').bind('dynatable:init', function(e, dynatable) {
		$('.dynatable-per-page').append("<a  href='' data-toggle='modal' data-target='.adv-s-modal' class='clear'><span class='glyphicon glyphicon-plus-sign'></span> Advance Filter</a>");
	    $('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'> Clear</a>");
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