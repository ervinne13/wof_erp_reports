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
	                <li><a href="">Send Approval Request</a></li>
					<li><a href="">Cancel Approval Request</a></li>
					<li><a href="">Reopen</a></li>
					<li><a href="">Approve (for approvers only)</a></li>
					<li><a href="">Reject (for approvers only)</a></li>
					<li><a href="">Print</a></li>
					<li><a href="">Post</a></li>
					<li><a href="">Track Document</a></li>
					<li><a href="">Create ATD</a></li>
              	</ul>
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
					  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
					  <div class="col-xs-7">
				        <label class="control-label" for="">CSR10001</label>
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">12/12/2015</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">[Remarks]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">Pending</label>
				      </div>
				    </div>
				</span>
				<span class="col-md-6">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Cashier #:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">CS10001:</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Cashier Name:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">[Cashier]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">SM - Megamall:</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Total Cash Collection:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">10,000.00:</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Total Sales:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for=""></label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Cash Overage/Shortage:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for=""></label>
				      </div>
				    </div>
				</span>
			</form>
			<div class="details">Details</div>
			<div role="tabpanel">
				<ul class="nav nav-tabs" id="csr-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#tokens"  role="tab" data-toggle="tab">Tokens</a></li>
				    <li role="presentation" ><a href="#tickets" role="tab" data-toggle="tab">Tickets</a></li>
				    <li role="presentation"><a href="#piso"  role="tab" data-toggle="tab">Piso</a></li>
				    <li role="presentation"><a href="#others"  role="tab" data-toggle="tab">Other Sales</a></li>
				    <li role="presentation"><a href="#change-fund"  role="tab" data-toggle="tab">Change Fund</a></li>
				    <li role="presentation"><a href="#cash-collection"  role="tab" data-toggle="tab">Cash Collection</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="tokens">
						<div class="table-container ">
							<table id="tokens-tbl" class="table table-striped table-hover table-bordered  table-condensed">
								<thead>
									<tr>
								      <th rowspan="2"></th>
								      <th rowspan="2">Tocken Pack</th>
								      <th colspan="7">Issuance</th>
								      <th rowspan="2">Return</th>
								      <th rowspan="2">Sold Packs</th>
								      <th rowspan="2">Peso Sales</th>
								    </tr>
								    <tr>
								      <th>1st</th>
								      <th>2nd</th>
								      <th>3rd</th>
								      <th>4th</th>
								      <th>5th</th>
								      <th>6th</th>
								      <th>Total</th>
								    </tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="Single" data-target=".token-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
										</td>
										<td>Single</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="10 + 1" data-target=".token-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
										</td>
										<td>10+1</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="10 + 2" data-target=".token-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
										</td>
										<td>10+2</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="20 + 3" data-target=".token-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
										</td>
										<td>20+3</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="20 + 5" data-target=".token-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
										</td>
										<td>20+5</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="40 + 10" data-target=".token-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
										</td>
										<td>40+10</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="40 + 12" data-target=".token-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
										</td>
										<td>40+12</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>Token Sales</td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="tickets">
						<div class="table-container">
							<table id="tickets-tbl" class="table table-striped table-hover table-bordered  table-condensed">
								<thead>
									<tr>
								      <th rowspan="2">
								      		<a href="" data-toggle="modal" title="40 + 12" data-target=".ticket-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
								      </th>
								      <th rowspan="2">Particulars</th>
								      <th colspan="2">Issuance</th>
								      <th colspan="2">Return</th>
								      <th rowspan="2">Sold QTY</th>
								      <th rowspan="2">Peso Sales</th>
								      <th rowspan="2">ISSUED BY:</th>
								      <th rowspan="2">RECEIVED BY:</th>
								    </tr>
								    <tr>
								      <th>Begining</th>
								      <th>Ending</th>
								      <th>Begining</th>
								      <th>Ending</th>
								    </tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>Ticket Sales</td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="piso">
						<div class="table-container">
							<table id="piso-tbl" class="table table-striped table-hover table-bordered  table-condensed">
								<thead>
									<tr>
								      <th rowspan="2"></th>
								      <th colspan="7">Issuance</th>
								      <th rowspan="2">Return</th>
								      <th rowspan="2">Sold Packs</th>
								      <th rowspan="2">Peso Sales</th>
								    </tr>
								    <tr>
								      <th>1st</th>
								      <th>2nd</th>
								      <th>3rd</th>
								      <th>4th</th>
								      <th>5th</th>
								      <th>6th</th>
								      <th>Total</th>
								    </tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<a href="" data-toggle="modal"  data-target=".piso-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
										</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>PISO Sales</td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="others">
						<div class="table-container">
							<table id="others-tbl" class="table table-striped table-hover table-bordered  table-condensed">
								<thead>
									<tr>
										<th>
											<a href="" data-toggle="modal"  data-target=".others-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
										</th>
										<th>Particulars</th>
										<th>Issued</th>
										<th>Returned</th>
										<th>Sold Qty</th>
										<th>Peso Sales</th>
										<th>ISSUED BY:</th>
										<th>RECEIVED BY:</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>Other Sales</td>
										<td></td>
										<td></td>
										<td></td>	
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="change-fund">
						<div class="table-container">
							<table id="coin-tbl" class="table table-striped table-hover table-bordered  table-condensed">
								<thead>
									<tr>
										<th>
										</th>
										<th>Type</th>
										<th>Issuance</th>
										<th>ISSUED BY:</th>
										<th>RECEIVED BY:</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<a href="" data-toggle="modal"  data-target=".coin-add-modal" class="">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td>Coins</td>
										<td>100.00</td>
										<td>[issuer]</td>
										<td>[receiver]</td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal"  data-target=".bill-add-modal" class="">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td>Bill</td>
										<td>100.00</td>
										<td>[issuer]</td>
										<td>[receiver]</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="cash-collection">
						<div class="table-container">
							<table id="cash-tbl" class="table table-striped table-hover table-bordered  table-condensed">
								<thead>
									<tr>
										<th colspan="4">Breakdown</th>
									</tr>
									<tr>
										<th></th>
										<th>Denomination</th>
										<th>Quantity</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="1000.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
											<a href="" data-toggle="modal" title="1000.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td>1,000.00</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="500.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
											<a href="" data-toggle="modal" title="500.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td>500.00</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="200.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
											<a href="" data-toggle="modal" title="200.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td>200.00</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="100.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
											<a href="" data-toggle="modal" title="100.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td>100.00</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="50.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
											<a href="" data-toggle="modal" title="50.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td>50.00</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="20.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
											<a href="" data-toggle="modal" title="20.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td>20.00</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="10.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
											<a href="" data-toggle="modal" title="10.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td>10.00</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="5.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
											<a href="" data-toggle="modal" title="5.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td>5.00</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title="1.00"  data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
											<a href="" data-toggle="modal" title="1.00" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td>1.00</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="" data-toggle="modal" title=".25" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-plus"></span>
											</a>
											<a href="" data-toggle="modal" title=".25" data-target=".cash-add-modal" class="">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td>.25</td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<div class="modal fade coin-add-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Coin Issuance</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-12">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Issuance:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Issuance">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Issued By:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Issued By">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Received By:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Received By">
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
<div class="modal fade bill-add-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Bills Issuance</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-12">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Issuance:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Issuance">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Issued By:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Issued By">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Received By:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Received By">
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
<div class="modal fade cash-add-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-12">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Quantity:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Quantity">
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

<div class="modal fade token-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-12">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Quantity:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Quantity">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Issued By:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Issued By">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Received By:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Received By">
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

<div class="modal fade piso-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Piso Sales</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-12">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Quantity:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Quantity">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Issued By:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Issued By">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Received By:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Received By">
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

<div class="modal fade ticket-modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tickets Sales</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-12">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-4">Particulars:</label>
					  <div class="col-xs-8">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Particulars">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-4">Issuance Begining:</label>
					  <div class="col-xs-8">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Issuance Begining">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-4">Issuance Ending:</label>
					  <div class="col-xs-8">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Issuance Ending">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-4">Returns Begining:</label>
					  <div class="col-xs-8">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Returns Begining">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-4">Returns Ending:</label>
					  <div class="col-xs-8">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Returns Ending">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-4" for="">Issued By:</label>
				      <div class="col-xs-8">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Issued By">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-4" for="">Received By:</label>
				      <div class="col-xs-8">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Received By">
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

<div class="modal fade others-modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Other Sales</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
	        <form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-12">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-4">Particulars:</label>
					  <div class="col-xs-8">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Particulars">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-4">Issued:</label>
					  <div class="col-xs-8">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Issued">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-4">Returned:</label>
					  <div class="col-xs-8">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Returned">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-4" for="">Issued By:</label>
				      <div class="col-xs-8">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Issued By">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-4" for="">Received By:</label>
				      <div class="col-xs-8">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Received By">
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

	$('.token-modal').on('show.bs.modal', function (e) {
		$(this).find('.modal-title').text(e.relatedTarget.title);
		
	});

	$('.cash-add-modal').on('show.bs.modal', function (e) {
		$(this).find('.modal-title').text(e.relatedTarget.title);
		
	});

    $('#csr-tabs a').click(function (e) {
	  $(this).tab('show');
	});

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


$('a[data-toggle="tab"]').on('shown.bs.tab', initFloatThead);
initFloatThead()
</script>