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
				        <label for="sel1" class="control-label">PO-100001</label>
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Document Date:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">04/21/15</label>
				      </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">External Do No.:</label>
					  <div class="col-xs-7">
					         <label for="sel1" class="control-label">[External Do No.]</label>
					   </div>
					</div>
					<div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Priority Level:</label>
				      <div class="col-xs-7">
					         <label for="sel1" class="control-label">High</label>
					   </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Remarks:</label>
				      <div class="col-xs-7">
				         <label class="control-label" for="">[Remarks]</label>
				      </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Status:</label>
					  <div class="col-xs-7">
					       <label for="sel1" class="control-label">Approved</label>
					   </div>
					</div>
				</span>
				<span class="col-md-6">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Transaction Type</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">Partial</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Vendor No.</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">V-100001</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Vendor Name:</label>
				      <div class="col-xs-7">
				         <label class="control-label" for="">VENDOR A</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Vendor Address:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">SUCAT, PARANAQUE</label>
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Vendor Ref No.:</label>
				      <div class="col-xs-7">
				         <label class="control-label" for="">[Vendor Ref No.]</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Payment Terms:</label>
				      <div class="col-xs-7">
					         <label for="sel1" class="control-label">30 Days</label>
					   </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Exp Delivery Date:</label>
				      <div class="col-xs-7">
					       <label class="control-label" for="">05/06/15</label>
					   </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Date Required:</label>
				      <div class="col-xs-7">
					        <label class="control-label" for="">04/28/15</label>
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
						<th>Asset Tag</th>
						<th>Location</th>
						<th>QTY</th>
						<th>CY</th>
						<th>UOM</th>
						<th>Unit Price</th>
						<th>Catalogue Price</th>
						<th>Discount</th>
						<th>Amount</th>
						<th>Amount in LCY</th>
						<th>Estimated Landed Cost</th>
						<th>Qty to Receive</th>
						<th>Qty Received</th>
						<th>Comment</th>
						<th>Store</th>
						<th>Refference From</th>
						<th>Refference To</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Machine</td>
						<td>FA100001</td>
						<td>Drummania V7</td>
						<td></td>
						<td>HO-Whse</td>
						<td>2</td>
						<td>PC</td>
						<td>USD</td>
						<td>1,000.00</td>
						<td>1,000.00</td>
						<td></td>
						<td>2,000.00</td>
						<td>100,000.00</td>
						<td>110,000.00</td>
						<td>2</td>
						<td>2</td>
						<td>[comment]</td>
						<td>SM - Naga</td>
						<td>PR-100001</td>
						<td>RR-100001</td>
					</tr>
					<tr>
						<td>Machine</td>
						<td>FA100002</td>
						<td>Battle Gear</td>
						<td></td>
						<td>HO-Whse</td>
						<td>1</td>
						<td>Unit</td>
						<td>USD</td>
						<td>1,000.00</td>
						<td>1,000.00</td>
						<td></td>
						<td>1,000.00</td>
						<td>50,000.00</td>
						<td>55,000.00</td>
						<td>1</td>
						<td>1</td>
						<td>[comment]</td>
						<td>SM - Naga</td>
						<td>PR-100001</td>
						<td>RR-100001 </td>
					</tr>			 
					<tr>
						<td>Machine</td>
						<td>FA100003</td>
						<td>Indiana Jones</td>
						<td></td>
						<td>HO-Whse</td>
						<td>1</td>
						<td>Unit</td>
						<td>USD</td>
						<td>1,000.00</td>
						<td>1,000.00</td>
						<td></td>
						<td>1,000.00</td>
						<td>50,000.00</td>
						<td>55,000.00</td>
						<td>1</td>
						<td>1</td>
						<td>[comment]</td>
						<td>SM - Naga</td>
						<td>PR-100001</td>
						<td>RR-100001</td>
					</tr>		  
				</tbody>
				<tfoot>
					<tr>
						<td>TOTAL:</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>4,000.00</td>
						<td></td>
						<td></td>
						<td>200,000.00</td>
						<td>220,000.00</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>