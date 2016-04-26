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
	                <li><a href="">Consolidate</a></li>
					<li><a href="" data-toggle="modal" data-target=".confirm-modal">Confirm Deposit</a></li>
              	</ul>
              	<a class="cls-btn" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
				  Close
				</a>
            </span>
      	</h3>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<table class="presentation table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>
							<a href="<?= base_url().uri_string() ?>/add" class="">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th><input type="checkbox"></th>
						<th>Document No.</th>
						<th>Document Date</th>
						<th>Location/Branch</th>
						<th>Cashier #</th>
						<th>Cashier Name</th>
						<th>Shift</th>
						<th>Total Cash Collection</th>
						<th>Total Sales</th>
						<th>Cash Overage/Shortage</th>
						<th>Remarks</th>
						<th>Priority Level</th>
						<th>Deposit Ref#</th>
						<th>Date Deposited</th>
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
						<td><input type="checkbox"></td>
						<td>CSR-10001</td>
						<td>12/02/15</td>
						<td>SM - Megamall</td>
						<td>CS10001</td>
						<td>Cashier</td>
						<td>10:00 AM - 3:00 PM</td>
						<td>10,000.00</td>
						<td></td>
						<td></td>
						<td>[Remarks]</td>
						<td>HIGH</td>
						<td></td>
						<td>12/02/15</td>
						<td>Pending</td>
					</tr>
				</tbody>
			</table>
		</div>
    </div>
</div>
<div class="modal fade confirm-modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Deposit</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
      		<div class="table-container">
		        <table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th><input type="checkbox"></th>
							<th>Document No.</th>
							<th>Document Date</th>
							<th>CSR</th>
							<th>Deposit Ref#</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="checkbox"></td>
							<td>CON-10001</td>
							<td>12/02/15</td>
							<td>CSR10001,CSR10002,CSR10003</td>
							<td><input type="text"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default form-btn main-clr">Conifrm</button>
      </div>
    </div>
  </div>
</div>