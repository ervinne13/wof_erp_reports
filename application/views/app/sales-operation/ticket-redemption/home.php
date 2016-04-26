<div class="panel">
	<div class="panel-heading">
		<span class="dropdown pull-right">
			<a href="" class="dropdown-toggle function" data-toggle="dropdown" aria-expanded="true">
		    	Functions
		    	<span class="caret"></span>
		  	</a>
		  	<ul class="dropdown-menu" role="menu" >
		        <li><a href="javascript:void(0)" onclick="redemption.voidModal();">Void</a></li>
		  	</ul>
		</span>

		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<ul class="nav nav-tabs side-coupon-tab">
			<li class="<?=$type == 'good_coupon' ? 'active' : NULL;?>"><a href="<?=site_url('app/sales-operation/ticket-redemption?type=good_coupon');?>" onclick="redemption.goodCoupon();">Good Coupon</a></li>
			<?php if ($approval): ?>
				<li class="<?=$type == 'faded_coupon' ? 'active' : NULL;?>"><a href="<?=site_url('app/sales-operation/ticket-redemption?type=faded_coupon');?>" onclick="redemption.goodCoupon();">Faded Coupon</a></li>
				<li class="<?=$type == 'low_point' ? 'active' : NULL;?>"><a href="<?=site_url('app/sales-operation/ticket-redemption?type=low_point');?>" onclick="redemption.lowPoint();">Low Point</a></li>
			<?php endif ?>
		</ul>
		
		<div class="row">
		<div class="col-md-4">

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="good_coupon">
					<div class="col-md-12 form-horizontal row">
						<?=$this->load->view('app/sales-operation/ticket-redemption/tab-form', NULL, TRUE);?>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8">

			<div class="row ticket-points form ">

				<div class="col-md-6 form-horizontal">

					<div class="form-group">
						<div class="col-md-2 control-label">Tickets:</div>
						<div class="col-md-7">
							<input type="text" class="form-control text-center" id="ticket-count-field" readonly>
						</div>
						<div class="col-md-4"></div>
					</div>
				</div>

				<div class="col-md-6 form-horizontal ">
					<div class="form-group">
						<div class="col-md-5 control-label">Total Points:</div>
						<div class="col-md-7">
							<input type="text" class="form-control text-center" id="total-points" readonly>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-5 control-label">Remaining Points:</div>
						<div class="col-md-7">
							<input type="text" class="form-control text-center" id="remaining-points" readonly>
						</div>
					</div>
				</div>

			</div>

			<table class="table table-striped table-bordered table-condensed" id="item-table">
				<thead class="text-center">
					<th></th>
					<th>Barcode</th>
					<th>Item Code</th>
					<th>Description</th>
					<th>Qty</th>
					<th>Points</th>
					<th>Total</th>
				</thead>

				<tbody class="text-center">
					<?php foreach ($tickets as $key => $v): ?>
							<tr class="table-item" data-hash="<?=md5(rand(1, 100))?>" 
											  data-desc="<?=htmlentities($v['IM_Sales_Desc']);?>" 
											  data-quantity="<?=$v['RDD_Qty'];?>" 
											  data-points="<?=$v['RDD_PointsPerQty'];?>" 
											  data-code="<?=$v['RDD_ItemNo'];?>" 
											  data-total-points="<?=$v['RDD_TotalPoints'];?>">
							<td>
								<a href="#" class="icon-act" onclick="redemption.edit(this);">
									<span class="glyphicon glyphicon-edit"></span>
								</a>

								<a href="#" class="icon-act" onclick="redemption.trash(this);">
									<span class="glyphicon glyphicon-remove"></span>
								</a>
							</td>
							<td></td>
							<td><?=$v['RDD_ItemNo'];?></td>
							<td><?=$v['IM_Sales_Desc'];?></td>
							<td><?=$v['RDD_Qty'];?></td>
							<td><?=$v['RDD_PointsPerQty'];?></td>
							<td data-total="<?=$v['RDD_TotalPoints'];?>"><?=$v['RDD_TotalPoints'];?></td>
						</tr>
						<?php endforeach ?>
				</tbody>

			</table>
			
			<input type="hidden" name="item_type" value="<?=$type;?>" id="item-type">
			
			<?php if ($type == 'low_point'): ?>
				<button class="btn btn-default form-btn main-clr act-btn disabled" type="button" disabled onclick="redemption.redeem();">Save</button>
			<?php else: ?>
				<button class="btn btn-default form-btn main-clr act-btn disabled" type="button" disabled onclick="redemption.redeem();">Redeem</button>
			<?php endif ?>

			<button class="btn btn-default form-btn sub-clr act-btn disabled" type="button" disabled onclick="redemption.cancel();">Cancel</button>
		</div>
		</div>
		
	</div>

</div>

<?=$this->load->view('app/sales-operation/ticket-redemption/popup', NULL, TRUE);?>
<?=$this->load->view('app/sales-operation/ticket-redemption/list', NULL, TRUE);?>
