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
	                <li><a href="">Cancel</a></li>
	                <li><a href="">Approve Without Tickets</a></li>
	                <li><a href="">Approve With Tickets</a></li>
              	</ul>
              	<a class="cls-btn" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
				  Close
				</a>
            </span>
		</h3>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel">
						<div class="panel-heading">
							<h5 class="panel-title">Header</h5>
						</div>
						<div class="panel-body">
							<form class="form-horizontal row page-form" role="form" class="container-fluid">
								<span class="col-md-6">
									<div class="form-group">
									  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
									  <div class="col-xs-7">
								         <label class="control-label">RD-10001</label> 
									  </div>
									</div>
								    <div class="form-group">
								      <label class="control-label col-xs-5" for="">Document Date:</label>
								      <div class="col-xs-7">
								         <label class="control-label">12/25/15</label> 
									  </div>
								    </div>
								</span>
								<span class="col-md-6">
									<div class="form-group">
									  <label for="sel1" class="control-label col-xs-5">Location:</label>
									  <div class="col-xs-7">
										  <label class="control-label">SM - Megamall</label>
									  </div>
									</div>
									<div class="form-group">
								      <label class="control-label col-xs-5" for="">Remarks:</label>
								      <div class="col-xs-7">
								         <label class="control-label">Remarks</label>
				     				  </div>
								    </div>
								    <div class="form-group">
								      <label class="control-label col-xs-5" for="">Status:</label>
								      <div class="col-xs-7">
								         <label class="control-label">Pending</label>
				     				  </div>
								    </div>
								</span>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="panel">
						<div class="panel-heading">
							<h5 class="panel-title">Item Transaction</h5>
						</div>
						<div class="panel-body">
							<table class="item-tbl table table-striped table-hover table-bordered  table-condensed">
								<thead>
									<tr>
										<th>
										</th>
										<th>Item No.</th>
										<th>Description</th>
										<th>Qty</th>
										<th>Points</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<a href="#" class="">
												<span class="glyphicon glyphicon-trash"></span>
											</a>
										</td>
										<td>FA100002</td>
										<td>Battle Gear</td>
										<td>2</td>
										<td>250</td>
									</tr>
									<tr>
										<td>
											<a href="#" class="">
												<span class="glyphicon glyphicon-trash"></span>
											</a>
										</td>
										<td>FA100003</td>
										<td>Indiana Jones</td>
										<td>2</td>
										<td>150</td>
									</tr>
								</tbody>
							</table>
							<hr>
							<form class="form-horizontal row page-form" role="form" class="container-fluid">
								<div class="pull-right">
									<span class="col-md-12">
										<div class="form-group">
										  <label for="sel1" class="control-label col-xs-5">Total Tickets:</label>
										  <div class="col-xs-7">
											   <input type="text" class="form-control" disabled id=""  value="" tabindex="2" name="u_username" placeholder="">
										  </div>
										</div>
										<div class="form-group">
									      <label class="control-label col-xs-5" for="">Total Points:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id=""  value="" tabindex="2" name="u_username" disabled placeholder="">
					     				  </div>
									    </div>
									</span>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<script type="text/javascript">
	$('.ticket-tbl,.item-tbl').bind('dynatable:init', function(e, dynatable) {
	
    $(this).closest('.tab-pane').find('.dynatable-search').prepend('Date Filter: <input type="search" id="date-from"/><input type="search"  id="date-to"/> ')
	    .append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
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

		//$('a[data-toggle="tab"]').on('shown.bs.tab', initFloatThead);
		initFloatThead();

	    $("#date-from,#date-to").datepicker({ dateFormat: 'yy-mm-dd'});
	  }).dynatable();

	 //  $('.modal').find('.table').bind('dynatable:init', function(e, dynatable) {
		//    $('.modal').find('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
		//     $(this).wrap('<div class="table-container"></div>')
		//     var $demo1 = $(this);
		// 		$demo1.floatThead({
		// 			scrollContainer: function($table){
		// 				return $table.closest('.table-container');
		// 			}
		// 	});

		// 	$("#date-from,#date-to").datepicker({ dateFormat: 'yy-mm-dd'});
		// }).dynatable();

		// $('.modal').on('shown.bs.modal', function (e) {
		// 	_this = $(this);
		// 	_this.find('.table').floatThead('reflow');
		// });
</script>