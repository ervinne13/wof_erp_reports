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
					<li><a href="">Reject</a></li>
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
				         <label class="control-label">BR-10001</label> 
					  </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				         <label class="control-label">12/02/15</label> 
					  </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Remarks:</label>
				      <div class="col-xs-7">
						   <label class="control-label">Remarks</label>
					  </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Status:</label>
				      <div class="col-xs-7">
						   <label class="control-label">Pending</label>
					  </div>
				    </div>
				</span>
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Supplier:</label>
					  <div class="col-xs-7">
				         <label class="control-label">Supplier</label> 
					  </div>
					</div>
				</span>
			</form>
			<div class="details">Details</div>
			 <table class="table table-striped table-hover table-bordered">
	 			<thead>
					<tr>
						<th rowspan="4">Class</th>
						<th rowspan="4">Area</th>
						<th colspan="2"><img src="<?= base_url('css/assets/wof-logo.jpg') ?>" class="rpc-img img-responsive" ></th>
						<th colspan="2"><img src="<?= base_url('css/assets/wof-logo.jpg') ?>" class="rpc-img img-responsive" ></th>
						<th rowspan="4">Total</th>
					</tr>
					<tr>
						<th colspan="2">Item 1</th>
						<th colspan="2">Item 2</th>
					</tr>
					<tr>
						<th colspan="2">10.00</th>
						<th colspan="2">20.00</th>
					</tr>
					<tr>
						<th>Qty</th>
						<th>Total</th>
						<th>Qty</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>C</td>
						<td>Area 1</td>
						<td><input type="text"></td>
						<td></td>
						<td><input type="text"></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>B</td>
						<td>Area 2</td>
						<td><input type="text"></td>
						<td></td>
						<td><input type="text"></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>B</td>
						<td>Area 3</td>
						<td><input type="text"></td>
						<td></td>
						<td><input type="text"></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>C</td>
						<td>Area 4</td>
						<td><input type="text"></td>
						<td></td>
						<td><input type="text"></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
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
<div class="modal fade br-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Batch Allocation Edit</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
      		<form class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-12">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Item Code:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Item Code">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Location:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Location">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Qty">
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