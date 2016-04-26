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
					<li><a href="">Track Document</a></li>
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
				          <label for="sel1" class="control-label">CAR-100001</label>
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">04/21/15</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Priority Level:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">High</label>
				       </div> 
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Remark:</label>
					   <div class="col-xs-7">
				         <label for="sel1" class="control-label">[Remark]</label>
				      </div>
					</div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">CAR Status:</label>
				      <div class="col-xs-7">
				          <label for="sel1" class="control-label">Approved</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">CAL Status:</label>
				      <div class="col-xs-7">
				          <label for="sel1" class="control-label">Liquidated</label>
				      </div>
				    </div>
				    
				</span>
				<span class="col-md-6">
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Requested By:</label>
					  <div class="col-xs-7">
						  <label for="sel1" class="control-label">Employee A</label>
					  </div>
					</div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Cost Center:</label>
				      <div class="col-xs-7">
				        <label for="sel1" class="control-label">RSD</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Company:</label>
				      <div class="col-xs-7">
				        <label class="control-label " for="">WOF</label>
				       </div> 
				    </div>
					 <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Purpose:</label>
				      <div class="col-xs-7">
				         <label for="sel1" class="control-label">[Purpose]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">1,250.00</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Required:</label>
				      <div class="col-xs-7">
				         <label class="control-label" for="">04/21/15</label>
				      </div>
				    </div>
				</span>
			</form>
			<div class="details">Details</div>
			<table class="presentation table table-striped table-hover table-bordered  table-condensed">
				<thead>
					<tr>
						<th>
							<a href="<?= base_url().uri_string() ?>/liquidation-detail-add" class="">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th>Date</th>
						<th>Receipt No.</th>
						<th>Payee</th>
						<th>Address</th>
						<th>TIN</th>
						<th>Particulars</th>
						<th>Amount</th>
						<th></th>
						<th>VAT</th>
						<th>Net of VAT</th>
						<th>Charge to</th>
						<th>Comment</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/liquidation-detail-update" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="#" class="">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
						<td>01/02/2015</td>
						<td>1234</td>
						<td>Supplier 1</td>
						<td>[Address]</td>
						<td>xxx-xx-xxxx-xx</td>
						<td>Redemption Item</td>
						<td>500.00</td>
						<td><span class="glyphicon glyphicon-check"></span></td>
						<td>53.57</td>
						<td>446.43</td>
						<td>SM-Naga</td>
						<td>[Comment]</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/liquidation-detail-update" class="">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="#" class="">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
						<td>01/02/2015</td>
						<td>1234</td>
						<td>Supplier 1</td>
						<td>[Address]</td>
						<td>xxx-xx-xxxx-xx</td>
						<td>Redemption Item</td>
						<td>700.00</td>
						<td></td>
						<td>75</td>
						<td>625</td>
						<td>SM-Naga</td>
						<td>[Comment]</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td>Total:</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>1200.00</td>
						<td></td>
						<td>128.57</td>
						<td>1071.43</td>
						<td></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
