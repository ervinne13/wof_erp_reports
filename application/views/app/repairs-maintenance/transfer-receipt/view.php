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
					<li><a href="">Print</a></li>
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
				         <label class="control-label">RQ-10001</label> 
					  </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				         <label class="control-label">12/25/15</label> 
					  </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Priority Level:</label>
				      <div class="col-xs-7">
				         <label class="control-label">High</label> 
					  </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				         <label class="control-label">[Remarks.]</label> 
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
				      <label class="control-label col-xs-5" for="">Date Required:</label>
				      <div class="col-xs-7">
				         <label class="control-label">12/25/15</label> 
					  </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Transfer From:</label>
					  <div class="col-xs-7">
						  <label class="control-label">Warehouse</label>
					  </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Transfer To:</label>
					  <div class="col-xs-7">
						  <label class="control-label">SM - Megamall</label>
					  </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Shipping Date:</label>
					  <div class="col-xs-7">
						  <label class="control-label">[Reason]</label>
					  </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Shipping ETA:</label>
					  <div class="col-xs-7">
						  <label class="control-label">12/27/15</label>
					  </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Shipping Method:</label>
					  <div class="col-xs-7">
						  <label class="control-label">LAND</label>
					  </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Shipping Agent:</label>
					  <div class="col-xs-7">
						  <label class="control-label">WOF</label>
					  </div>
					</div>
				</span>
			</form>
			<div class="details">Details</div>
			<table class="presentation table table-striped table-hover table-bordered  table-condensed">
				<thead>
					<tr>
						<th>Item Type.</th>
						<th>Item No.</th>
						<th>Description</th>
						<th>Qty</th>
						<th>UOM</th>
						<th>Qty to Ship</th>
						<th>Qty Shipped</th>
						<th>Qty to Receive</th>
						<th>Qty Received</th>
						<th>Comment</th>
						<th>Reference From</th>
						<th>Reference To</th>
						<th>Total Cost</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Machine</td>
						<td>FA100001</td>
						<td>Drumania V7</td>
						<td>2</td>
						<td>Unit</td>
						<td>2</td>
						<td>2</td>
						<td>2</td>
						<td>2</td>
						<td>[Comment]</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>Machine</td>
						<td>FA100002</td>
						<td>Battle Gear</td>
						<td>2</td>
						<td>Unit</td>
						<td>2</td>
						<td>2</td>
						<td>2</td>
						<td>2</td>
						<td>[Comment]</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>Machine</td>
						<td>FA100003</td>
						<td>Indiana Jones</td>
						<td>2</td>
						<td>Unit</td>
						<td>2</td>
						<td>2</td>
						<td>2</td>
						<td>2</td>
						<td>[Comment]</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>Redemption</td>
						<td>RD100001</td>
						<td>Hello Kitty</td>
						<td>2</td>
						<td>Unit</td>
						<td>2</td>
						<td>2</td>
						<td>2</td>
						<td>2</td>
						<td>[Comment]</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
    </div>
</div>
