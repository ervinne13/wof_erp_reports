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
	                <li><a href="">Approve</a></li>
	                <li><a href="">Void</a></li>
	                <li><a href="">Print Retrieval Report</a></li>
	                <li><a href="">Month End Closing</a></li>
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
								      <label class="control-label col-xs-5" for="">Control #</label>
								      <div class="col-xs-7">
								        <label class="control-label" for="">201501</label>
								      </div>
								    </div>
								    <div class="form-group">
								      <label class="control-label col-xs-5" for="">Retrieval #:</label>
								      <div class="col-xs-7">
								        <label class="control-label" for="">Branch-01-0001</label>
								      </div>
								    </div>
								    <div class="form-group">
								      <label class="control-label col-xs-5" for="">Period:</label>
								      <div class="col-xs-7">
								        <label class="control-label" for="">January 2015</label>
								      </div>
								    </div>
								</span>
								<span class="col-md-6">
									<div class="form-group">
									  <label for="sel1" class="control-label col-xs-5">Company:</label>
									  <div class="col-xs-7">
								        <label for="sel1" class="control-label">[Company]</label>
								      </div>
									</div>
									<div class="form-group">
								      <label class="control-label col-xs-5" for="">Branch:</label>
								      <div class="col-xs-7">
								        <label class="control-label" for="">[Branch]</label>
								      </div>
								    </div>
								    <div class="form-group">
								      <label class="control-label col-xs-5" for="">Date:</label>
								      <div class="col-xs-7">
								       <input type="text" class="form-control" id="" tabindex="1" name="" placeholder="">
				   					  </div>
								    </div>
								</span>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="panel">
						<div class="panel-heading">
							<h5 class="panel-title">Machines</h5>
						</div>
						<div class="panel-body">
							<form class="form-horizontal row page-form" role="form" class="container-fluid">
								<table class="machine-tbl table table-striped table-hover table-bordered  table-condensed">
								<thead>
									<tr>
										<th>Machine #</th>
										<th>Description</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>FA100001</td>
										<td>Machine 1</td>
									</tr>
									<tr>
										<td>FA100002</td>
										<td>Machine 2</td>
									</tr>
									<tr>
										<td>FA100003</td>
										<td>Machine 3</td>
									</tr>
									<tr>
										<td>FA100004</td>
										<td>Machine 4</td>
									</tr>
									<tr>
										<td>FA100005</td>
										<td>Machine 5</td>
									</tr>
									<tr>
										<td>FA100006</td>
										<td>Machine 6</td>
									</tr>
									<tr>
										<td>FA100007</td>
										<td>Machine 7</td>
									</tr>
									<tr>
										<td>FA100008</td>
										<td>Machine 8</td>
									</tr>
									<tr>
										<td>FA100009</td>
										<td>Machine 9</td>
									</tr>
									<tr>
										<td>FA1000010</td>
										<td>Machine 10</td>
									</tr>
								</tbody>
							</table>
							</form>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="panel">
						<div class="panel-heading">
							<h5 class="panel-title">Retrieved</h5>
						</div>
						<div class="panel-body">
						<form class="form-horizontal row page-form container-fluid" role="form">
							<div role="tabpanel">
								<ul class="nav nav-tabs" id="front-tabs" role="tablist">
								    <li role="presentation" class="active"><a href="#tokens" role="tab" data-toggle="tab">Tokens</a></li>
								    <li role="presentation"><a href="#piso-tokens"  role="tab" data-toggle="tab">Piso Token</a></li>
								    <li role="presentation"><a href="#piso-coins"  role="tab" data-toggle="tab">Coin Operated</a></li>
								    <li role="presentation"><a href="#game-rides"  role="tab" data-toggle="tab">Game & Ride Tickets</a></li>
								    <li role="presentation"><a href="#redemption-ticket"  role="tab" data-toggle="tab">Redemption Tickets</a></li>
								    <li role="presentation"><a href="#machine-meter-reading"  role="tab" data-toggle="tab">Machine Meter Reading</a></li>
								    <li role="presentation"><a href="#mtc"  role="tab" data-toggle="tab">MTC</a></li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="tokens">
										<div class="table-container">
											<table class="table table-striped table-hover table-bordered  table-condensed">
												<thead>
													<tr>
														<th colspan='2'>Counter Reading</th>
														<th rowspan='2'>Total</th>
														<th rowspan='2'>Free</th>
														<th rowspan='2'>Retrieved Qty</th>
													</tr>
													<tr>
														<th>Begging</th>
														<th>Ending</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><input  type="text"></td>
														<td><input  type="text"></td>
														<td><input  type="text"></td>
														<td><input  type="text"></td>
														<td></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="piso-tokens">
										<div class="table-container">
											<table class="table table-striped table-hover table-bordered  table-condensed">
												<thead>
													<tr>
														<th colspan='2'>Counter Reading</th>
														<th rowspan='2'>Total</th>
														<th rowspan='2'>Free</th>
														<th rowspan='2'>Retrieved Qty</th>
													</tr>
													<tr>
														<th>Begging</th>
														<th>Ending</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><input  type="text"></td>
														<td><input  type="text"></td>
														<td><input  type="text"></td>
														<td><input  type="text"></td>
														<td></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="piso-coins">
										<div class="table-container">
											<table class="table table-striped table-hover table-bordered  table-condensed">
												<thead>
													<tr>
														<th colspan='2'>Counter Reading</th>
														<th rowspan='2'>Total</th>
														<th rowspan='2'>Free</th>
														<th rowspan='2'>Retrieved Qty</th>
													</tr>
													<tr>
														<th>Begging</th>
														<th>Ending</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><input  type="text"></td>
														<td><input  type="text"></td>
														<td><input  type="text"></td>
														<td><input  type="text"></td>
														<td></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="game-rides">
										<span class="col-md-8">
										  	<div class="form-group">
											  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
											  <div class="col-xs-7">
										        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Document No.">
										      </div>
											</div>
											<div class="form-group">
										      <label class="control-label col-xs-5" for="">Document Date:</label>
										      <div class="col-xs-7">
										        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Document Date">
										      </div>
										    </div>
										    <div class="form-group">
										      <label class="control-label col-xs-5" for="">Transaction Date:</label>
										      <div class="col-xs-7">
										        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Transaction Date">
										      </div>
										    </div>
										    <div class="form-group">
										      <label class="control-label col-xs-5" for="">Qty Retrieved:</label>
										      <div class="col-xs-7">
										        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Qty Retrieved">
										      </div>
										    </div>
											  <div class="form-group">
										      <label class="control-label col-xs-5" for="">Remarks:</label>
										      <div class="col-xs-7">
										        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Remarks">
										      </div>
										    </div>
										</span>
									</div>
									<div role="tabpanel" class="tab-pane" id="redemption-ticket">
										<span class="row">
											<div class="table-container">
												<table class="table table-striped table-hover table-bordered  table-condensed">
													<thead>
														<tr>
															<th colspan='5'>Issuance</th>
															<th colspan='3'>Reading</th>
															<th rowspan='2'>Qty Total Issued</th>
															<th rowspan='2'>Total Reamaining</th>
														</tr>
														<tr>
															<th>Date</th>
															<th>Time</th>
															<th>Deck #</th>
															<th>Begining</th>
															<th>Ending</th>
															<th>Date</th>
															<th>Time</th>
															<th>Ending</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td></td>
															<td></td>
															<td><input  type="text"></td>
															<td><input  type="text"></td>
															<td><input  type="text"></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td><input  type="text"></td>
															<td><input  type="text"></td>
															<td><input  type="text"></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td><input  type="text"></td>
															<td><input  type="text"></td>
															<td><input  type="text"></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
													</tbody>
												</table>
											</div>
										</span>
									</div>
									<div role="tabpanel" class="tab-pane" id="machine-meter-reading">
										<table class="table table-striped table-hover table-bordered">
							 				<thead>
												<tr>
													<th>
														<a href="" class="">
															<span class="glyphicon glyphicon-plus"></span>
														</a>
													</th>
													<th>Meter #</th>
													<th>Begining</th>
													<th>Ending</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td></td>
													<td>1</td>
													<td><input  type="text"></td>
													<td><input  type="text"></td>
												</tr>
												<tr>
													<td></td>
													<td>2</td>
													<td><input  type="text"></td>
													<td><input  type="text"></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div role="tabpanel" class="tab-pane" id="mtc">
										<table class="table table-striped table-hover table-bordered">
							 				<thead>
												<tr>
													<th>Type</th>
													<th>Total Qty</th>
													<th>Total Cost</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Quantum</td>
													<td><input  type="text"></td>
													<td><input  type="text"></td>
												</tr>
												<tr>
													<td>Gold</td>
													<td><input  type="text"></td>
													<td><input  type="text"></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</form>
						<hr>
							<div class="container-fluid">
								<div class="form-group row">
									<a type="button" href="#" class="pull-right btn btn-default form-btn main-clr">
									  Save
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<div class="modal fade mtc-modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">MTC</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <table class="table table-striped table-hover table-bordered">
	 				<thead>
						<tr>
							<th>Type</th>
							<th>Total Qty</th>
							<th>Total Cost</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Quantum</td>
							<td><input  type="text"></td>
							<td><input  type="text"></td>
						</tr>
						<tr>
							<td>Gold</td>
							<td><input  type="text"></td>
							<td><input  type="text"></td>
						</tr>
					</tbody>
			</table>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default form-btn main-clr">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade token-modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tokens</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <table class="table table-striped table-hover table-bordered">
 				<thead>
					<tr>
						<th>
							<a href="" class="">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th>Meter #</th>
						<th>Begining</th>
						<th>Ending</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td>1</td>
						<td><input  type="text"></td>
						<td><input  type="text"></td>
					</tr>
					<tr>
						<td></td>
						<td>2</td>
						<td><input  type="text"></td>
						<td><input  type="text"></td>
					</tr>
				</tbody>
			</table>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default form-btn main-clr">Save</button>
      </div>
    </div>
  </div>
</div>	
<div class="modal fade piso-t-modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">PISO Tokens</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <table class="table table-striped table-hover table-bordered">
 				<thead>
					<tr>
						<th>
							<a href="" class="">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th>Meter #</th>
						<th>Begining</th>
						<th>Ending</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td>1</td>
						<td><input  type="text"></td>
						<td><input  type="text"></td>
					</tr>
					<tr>
						<td></td>
						<td>2</td>
						<td><input  type="text"></td>
						<td><input  type="text"></td>
					</tr>
				</tbody>
			</table>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default form-btn main-clr">Save</button>
      </div>
    </div>
  </div>
</div>	
<div class="modal fade piso-c-modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">PISO COINS</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <table class="table table-striped table-hover table-bordered">
 				<thead>
					<tr>
						<th>
							<a href="" class="">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th>Meter #</th>
						<th>Begining</th>
						<th>Ending</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td>1</td>
						<td><input  type="text"></td>
						<td><input  type="text"></td>
					</tr>
					<tr>
						<td></td>
						<td>2</td>
						<td><input  type="text"></td>
						<td><input  type="text"></td>
					</tr>
				</tbody>
			</table>
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
	// $('.item-tbl').bind('dynatable:init', function(e, dynatable) {
	
 //    $(this).closest('.tab-pane').find('.dynatable-search').prepend('Date Filter: <input type="search" id="date-from"/><input type="search"  id="date-to"/> ')
	//     .append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
	//     $(this).wrap('<div class="table-container"></div>')
	    
	//     var initFloatThead = function(){
	// 	     var $table = $('.table-container table:visible'); //table must be visible to init properly
	// 	     $table.floatThead({
	// 	         //useAbsolutePositioning: true,
	// 	         scrollContainer: function ($table) {
	// 	             return $table.closest('.table-container');
	// 	         }
	// 	     });
	// 	     $table.find('.FakeHeader').hide();
	// 	}

	// 	//$('a[data-toggle="tab"]').on('shown.bs.tab', initFloatThead);
	// 	initFloatThead();

	//     $("#date-from,#date-to").datepicker({ dateFormat: 'yy-mm-dd'});
	//   }).dynatable();

	$('.machine-tbl').bind('dynatable:init', function(e, dynatable) {
	
    $('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
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
	$('#front-tabs a').click(function (e) {
	  $(this).tab('show');
	});
</script>