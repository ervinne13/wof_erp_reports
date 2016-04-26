<?=$header?>
<div id="main-container" class="row nopad" style="overflow:auto">
	<div id="content-container" class="container-fluid">
		<div role="tabpanel">
			<ul class="nav nav-tabs" id="front-tabs" role="tablist">
			    <li role="presentation"><a href="#redeem" role="tab" data-toggle="tab">Redeem Items</a></li>
			    <li role="presentation"><a href="#discounted"  role="tab" data-toggle="tab">Discounted</a></li>
			    <li role="presentation"><a href="#for-sale"  role="tab" data-toggle="tab">For Sale</a></li>
			    <li role="presentation"><a href="#free"  role="tab" data-toggle="tab">Free Tokens</a></li>
			    <li role="presentation"><a href="#low-points"  role="tab" data-toggle="tab">Low Points</a></li>
			    <li class="pull-right">
			    	<a type="button" href="<?= base_url("app/".$this->uri->segment(2)) ?>/" class="btn btn-default form-btn sub-clr">
					  Back
					</a>
			    </li> <li class="pull-right">
			    	<a type="button" href="" class="btn btn-default form-btn main-clr">
					  EOD
					</a>
			    </li>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade" id="redeem">
					<div class="col-md-3">
						<div class="panel row">
							<div class="panel-heading">
								<h5 class="panel-title">Details</h5>
							</div>
							<div class="panel-body" >
								<form class="form-horizontal row page-form" role="form" class="container-fluid">
									<span class="col-md-12">
										<legend class="form-heading"><span>Transaction</span></legend>
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
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Redeem Without Tickets:</label>
									      <div class="col-xs-7">
									        <input type="checkbox"  name="p_type">
									      </div>
									    </div>
									    <legend class="form-heading"><span>Ticket</span></legend>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Coupon Code:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Qty:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
				 						<button type="submit" class="btn btn-default form-btn sub-clr pull-right">Void</button>
									    <legend class="form-heading"><span>Items</span></legend>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Item Code:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Quantity:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									</span>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="panel row">
							<div class="panel-body">
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
										         <input type="text" class="form-control" id=""  value="400" tabindex="2" name="u_username" disabled placeholder="">
						     				  </div>
										    </div>
										</span>
									</div>
								</form>
								<hr>
								<div class="table-container">
									<table class="table table-striped table-hover table-bordered  table-condensed">
										<thead>
											<tr>
												<th>Item No.</th>
												<th>Description</th>
												<th>Qty</th>
												<th>Points</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>FA100002</td>
												<td>Battle Gear</td>
												<td>2</td>
												<td>250</td>
											</tr>
											<tr>
												<td>FA100003</td>
												<td>Indiana Jones</td>
												<td>2</td>
												<td>150</td>
											</tr>
										</tbody>
									</table>
								</div>
								<nav>
									<ul class="pagination">
										<li>
									      <a href="#" aria-label="Previous">
									        <span aria-hidden="true"><<</span>
									      </a>
									    </li>
									    <li><a href="#"><</a></li>
									    <li><a href="#">></a></li>
									    <li>
									      <a href="#" aria-label="Next">
									        <span aria-hidden="true">>></span>
									      </a>
									    </li>
									    <li>
									      <a href="">
											  Delete
									      </a>
									    </li>
									    <li>
									      <a href="">
											  Redeem
									      </a>
									    </li>
									    <li>
									      <a href="">
											  Approve
									      </a>
									    </li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="discounted">
					<div class="col-md-3">
						<div class="panel row">
							<div class="panel-heading">
								<h5 class="panel-title">Details</h5>
							</div>
							<div class="panel-body" >
								<form class="form-horizontal row page-form" role="form" class="container-fluid">
									<span class="col-md-12">
										<legend class="form-heading"><span>Transaction</span></legend>
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
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Low Points:</label>
									      <div class="col-xs-7">
									        <input type="checkbox"  name="p_type">
									      </div>
									    </div>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Redeem Without Tickets:</label>
									      <div class="col-xs-7">
									        <input type="checkbox"  name="p_type">
									      </div>
									    </div>
									    <legend class="form-heading"><span>VIP</span></legend>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Scan VIP:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									    <div class="form-group">
										  <label for="sel1" class="control-label col-xs-5">VIP INFO:</label>
										  <div class="col-xs-7">
									         <label class="control-label">[VIP INFO]</label> 
										  </div>
										</div>
									    <legend class="form-heading"><span>Ticket</span></legend>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Coupon Code:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Qty:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
				 						<button type="submit" class="btn btn-default form-btn sub-clr pull-right">Void</button>
									    <legend class="form-heading"><span>Items</span></legend>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Item Code:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Quantity:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									</span>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="panel row">
							<div class="panel-body">
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
										         <input type="text" class="form-control" id=""  value="320" tabindex="2" name="u_username" disabled placeholder="">
						     				  </div>
										    </div>
										</span>
									</div>
								</form>
								<hr>
								<div class="table-container">
									<table class="table table-striped table-hover table-bordered  table-condensed">
										<thead>
											<tr>
												<th>Item No.</th>
												<th>Description</th>
												<th>Qty</th>
												<th>Points</th>
												<th>Discount</th>
												<th>Total Points</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>FA100002</td>
												<td>Battle Gear</td>
												<td>2</td>
												<td>250</td>
												<td>20%</td>
												<td>200</td>
											</tr>
											<tr>
												<td>FA100003</td>
												<td>Indiana Jones</td>
												<td>2</td>
												<td>150</td>
												<td>20%</td>
												<td>120</td>
											</tr>
										</tbody>
									</table>
								</div>
								<nav>
									<ul class="pagination">
										<li>
									      <a href="#" aria-label="Previous">
									        <span aria-hidden="true"><<</span>
									      </a>
									    </li>
									    <li><a href="#"><</a></li>
									    <li><a href="#">></a></li>
									    <li>
									      <a href="#" aria-label="Next">
									        <span aria-hidden="true">>></span>
									      </a>
									    </li>
									    <li>
									      <a href="">
											  Delete
									      </a>
									    </li>
									    <li>
									      <a href="">
											  Redeem
									      </a>
									    </li>
									    <li>
									      <a href="">
											  Approve
									      </a>
									    </li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="for-sale">
					<div class="col-md-3">
						<div class="panel row">
							<div class="panel-heading">
								<h5 class="panel-title">Details</h5>
							</div>
							<div class="panel-body" >
								<form class="form-horizontal row page-form" role="form" class="container-fluid">
									<span class="col-md-12">
										<legend class="form-heading"><span>Transaction</span></legend>
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
				 						<button type="submit" class="btn btn-default form-btn sub-clr pull-right">Void</button>
									    <legend class="form-heading"><span>Cash Tendered</span></legend>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Total:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									    <legend class="form-heading"><span>Items</span></legend>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Item Code:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Quantity:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									</span>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="panel row">
							<div class="panel-body">
								<form class="form-horizontal row page-form" role="form" class="container-fluid">
									<div class="pull-right">
										<span class="col-md-12">
											<div class="form-group">
											  <label for="sel1" class="control-label col-xs-5">Total Cash:</label>
											  <div class="col-xs-7">
												   <input type="text" class="form-control" disabled id=""  value="" tabindex="2" name="u_username" placeholder="">
											  </div>
											</div>
											<div class="form-group">
										      <label class="control-label col-xs-5" for="">Total Price:</label>
										      <div class="col-xs-7">
										         <input type="text" class="form-control" id=""  value="800" tabindex="2" name="u_username" disabled placeholder="">
						     				  </div>
										    </div>
										</span>
									</div>
								</form>
								<hr>
								<div class="table-container">
									<table class="table table-striped table-hover table-bordered  table-condensed">
										<thead>
											<tr>
												<th>Item No.</th>
												<th>Description</th>
												<th>Qty</th>
												<th>Price</th>
												<th>Total Price</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>FA100002</td>
												<td>Battle Gear</td>
												<td>2</td>
												<td>250</td>
												<td>500</td>
											</tr>
											<tr>
												<td>FA100003</td>
												<td>Indiana Jones</td>
												<td>2</td>
												<td>150</td>
												<td>300</td>
											</tr>
										</tbody>
									</table>
								</div>
								<nav>
									<ul class="pagination">
										<li>
									      <a href="#" aria-label="Previous">
									        <span aria-hidden="true"><<</span>
									      </a>
									    </li>
									    <li><a href="#"><</a></li>
									    <li><a href="#">></a></li>
									    <li>
									      <a href="#" aria-label="Next">
									        <span aria-hidden="true">>></span>
									      </a>
									    </li>
									    <li>
									      <a href="">
											  Delete
									      </a>
									    </li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="free">
					<div class="col-md-3">
						<div class="panel row" >
							<div class="panel-heading">
								<h5 class="panel-title">Details</h5>
							</div>
							<div class="panel-body">
								<form class="form-horizontal row page-form" role="form" class="container-fluid">
									<span class="col-md-12">
										<legend class="form-heading"><span>Transaction</span></legend>
										<div class="form-group">
										  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
										  <div class="col-xs-7">
									         <label class="control-label">FR-10001</label> 
										  </div>
										</div>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Document Date:</label>
									      <div class="col-xs-7">
									         <label class="control-label">12/25/15</label> 
										  </div>
									    </div>
									    <button type="submit" class="btn btn-default form-btn sub-clr pull-right">Void</button>
									    <legend class="form-heading"><span>Transaction Type</span></legend>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Type:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Code:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									    <legend class="form-heading"><span>VIP Info</span></legend>
										<div class="form-group">
										  <label for="sel1" class="control-label col-xs-5">Client Name:</label>
										  <div class="col-xs-7">
									         <label class="control-label">[Client Name]</label> 
										  </div>
										</div>
				 						<legend class="form-heading">
				 							<span>Items</span>
				 						</legend>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Item Code:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									    <div class="form-group">
									      <label class="control-label col-xs-5" for="">Quantity:</label>
									      <div class="col-xs-7">
									         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
				 						  </div>
									    </div>
									</span>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="panel row">
							<div class="panel-body">
								<form class="form-horizontal row page-form" role="form" class="container-fluid">
									<div class="pull-right">
										<span class="col-md-12">
											<div class="form-group">
										      <label class="control-label col-xs-5" for="">Total Qty:</label>
										      <div class="col-xs-7">
										         <input type="text" class="form-control" id=""  value="1" tabindex="2" name="u_username" disabled placeholder="">
						     				  </div>
										    </div>
										</span>
									</div>
								</form>
								<hr>
								<div class="table-container">
									<table class="table table-striped table-hover table-bordered  table-condensed">
										<thead>
											<tr>
												<th>Item Code</th>
												<th>Description</th>
												<th>Qty</th>
												<th>UOM</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>TK100001</td>
												<td>10+2</td>
												<td>1</td>
												<td>Pack</td>
											</tr>
										</tbody>
									</table>
								</div>
								<nav>
									<ul class="pagination">
										<li>
									      <a href="#" aria-label="Previous">
									        <span aria-hidden="true"><<</span>
									      </a>
									    </li>
									    <li><a href="#"><</a></li>
									    <li><a href="#">></a></li>
									    <li>
									      <a href="#" aria-label="Next">
									        <span aria-hidden="true">>></span>
									      </a>
									    </li>
									    <li>
									      <a href="" data-toggle="modal" data-target=".promo-modal">
											  Create Promo
									      </a>
									    </li>
									    <li>
									      <a href="">
											  Delete
									      </a>
									    </li>
									    <li>
									      <a href="">
											  Issue
									      </a>
									    </li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="low-points">
					<div class="col-md-12">
						<div class="panel row">
							<div class="panel-body">
								<form class="form-horizontal row page-form" role="form" class="container-fluid">
									<div class="pull-right">
										<span class="col-md-12">
											<div class="form-group">
										      <label class="control-label col-xs-5" for="">Total:</label>
										      <div class="col-xs-7">
										         <input type="text" class="form-control" id=""  value="0" tabindex="2" name="u_username" disabled placeholder="">
						     				  </div>
										    </div>
										</span>
									</div>
								</form>
								<hr>
								<div class="table-container">
									<table class="table table-striped table-hover table-bordered  table-condensed">
										<thead>
											<tr>
												<th>Item Code</th>
												<th>Description</th>
												<th>Points</th>
												<th>Qty</th>
												<th>Total Points</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>TK100001</td>
												<td>Candy</td>
												<td>2</td>
												<td><input type="text"></td>
												<td></td>
											</tr>
											<tr>
												<td>TK100002</td>
												<td>Candy2</td>
												<td>2</td>
												<td><input type="text"></td>
												<td></td>
											</tr>
											<tr>
												<td>TK100003</td>
												<td>Candy3</td>
												<td>3</td>
												<td><input type="text"></td>
												<td></td>
											</tr>
											<tr>
												<td>TK100004</td>
												<td>Candy4</td>
												<td>2</td>
												<td><input type="text"></td>
												<td></td>
											</tr>
										</tbody>
									</table>
								</div>
								<nav>
									<ul class="pagination">
									    <li>
									      <a href="">
											  Issue
									      </a>
									    </li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade promo-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create Promo</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	       <form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-8">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Promo Title:</label>
					  <div class="col-xs-7">
				         <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="">
					  </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Promo Code:</label>
					  <div class="col-xs-7">
				         <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="">
					  </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Promo Start:</label>
				      <div class="col-xs-7">
				          <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="">
					  </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Promo End:</label>
				      <div class="col-xs-7">
				         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
					  </div>
				    </div>
				    <legend>Items</legend>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Item Code:</label>
				      <div class="col-xs-7">
				         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
					  </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Quantity:</label>
				      <div class="col-xs-7">
				         <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="">
					  </div>
				    </div>
				</span>
			</form>
			<table class="table table-striped table-hover table-bordered  table-condensed">
				<thead>
					<tr>
						<th>Item Code</th>
						<th>Description</th>
						<th>Qty</th>
						<th>UOM</th>
					</tr>
				</thead>
				<tbody>
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
	$('#front-tabs a').click(function (e) {
	  $(this).tab('show');
	});
</script>
<?=$footer?>