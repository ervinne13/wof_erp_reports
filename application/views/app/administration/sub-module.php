<nav class="navbar navbar-default" id="side-nav" role="navigation">
	<div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mob-nav">
	      <span class="sr-only">Toggle navigation</span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	    </button>
	    <a class="navbar-brand" href="#"><img src="<?=base_url('css/assets/wof-logo.jpg')?>" class="img-circle"></a>
  	</div>

  	<div class="collapse hidden-nav" id="mob-nav">
	    <ul class="nav navbar-nav">
	      	<li><a href="#" data-toggle="collapse" data-target="#administration">Administration<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
	            <ul class="nav collapse sub" id="administration">
	              	<li><a href="#">Sub Link 1</a></li>
	              	<li><a href="#">Sub Link 2</a></li>
	              	<li><a href="#">Sub Link 3</a></li>
	            </ul>
	      	</li>
	      	<li><a href="#" data-toggle="collapse" data-target="#min-purchasing">Purchasing<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
	            <ul class="nav collapse sub" id="min-purchasing">
              		<li>
						<a href="<?= base_url('app/purchasing/purchase-request')?>">
							Purchase Request (PR)
						</a>
					</li>
					<li>
						<a href="<?= base_url('app/purchasing/purchase-order')?>">
							Purchase Order (PO)
						</a>
					</li>
					<li>
						<a href="<?= base_url('app/purchasing/requisition')?>">
							Requisition (RQ)
						</a>
					</li>
					<li>
						<a href="<?= base_url('app/purchasing/document-approval')?>">
							Document Approval
						</a>
					</li>
					<li>
						<a href="<?= base_url('app/purchasing/returns')?>">
							Returns
						</a>
					</li>
				</ul>
	      	</li>
	      	<li><a href="#" data-toggle="collapse" data-target="#financial-managment">Financial Management<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
	            <ul class="nav collapse sub" id="financial-managment">
	              	<li><a href="#" data-toggle="collapse" data-target="#min-receivables">Receivables<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
			            <ul class="nav collapse sub-sub" id="min-receivables">
			              	<li><a href="<?= base_url('app/financial-management/sales-invoice')?>">Sales Invoice (SI)</a></li>
							<li><a href="<?= base_url('app/financial-management/cash-receipt-journal')?>">Cash Receipt Journal (CRJ)</a></li>
							<!-- <li><a href="<?= base_url('app/financial-management/post-dated-checks')?>">Post Dated Checks (PDC)</a></li> -->
							<li><a href="<?= base_url('app/financial-management/credit-debit-memo')?>">Credit / Debit Memo</a></li>
						</ul>
		          	</li>
		          	<li><a href="#" data-toggle="collapse" data-target="#min-payables">Payables<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
			            <ul class="nav collapse sub-sub" id="min-payables">
			              	<li><a href="<?= base_url('app/financial-management/accounts-payable-voucher')?>">Accounts Payable Voucher</a></li>
							<li><a href="<?= base_url('app/financial-management/document-approval')?>">Document Approval</a></li>
							<li><a href="<?= base_url('app/financial-management/amortization')?>">Amortization</a></li>
						</ul>
			        </li>
			        <li><a href="#" data-toggle="collapse" data-target="#min-disbursement">Disbursement<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
			            <ul class="nav collapse sub-sub" id="min-disbursement">
			              <li><a href="<?= base_url('app/financial-management/check-voucher')?>">Check Voucher</a></li>
			            </ul>
			        </li>
			        <li><a href="#" data-toggle="collapse" data-target="#min-journal-entries">Journal Entries<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
			            <ul class="nav collapse sub-sub" id="min-journal-entries">
			              	<li><a href="<?= base_url('app/financial-management/general-journal')?>">General Journal</a></li>
							<li><a href="<?= base_url('app/financial-management/document-approval')?>">Document Approval</a></li>
							<li><a href="<?= base_url('app/financial-management/chart-of-accounts')?>">Chart of Accounts</a></li>
							<li><a href="<?= base_url('app/financial-management/working-trial-balance')?>">Working Trial Balance</a></li>
						</ul>
			        </li>
			        <li><a href="#" data-toggle="collapse" data-target="#min-cash-management">Cash Management<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
			            <ul class="nav collapse sub-sub" id="min-cash-management">
			            	<li><a href="#" data-toggle="collapse" data-target="#min-petty-cash-fund">Petty Cash Fund (PCF)<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
					            <ul class="nav collapse sub-sub-sub" id="min-petty-cash-fund">
					              	<li><a href="<?= base_url('app/financial-management/reimbursement')?>">Reimbursement</a></li>	
					            </ul>
					        </li>
			              	<li><a href="<?= base_url('app/financial-management/bank-accounts')?>">Bank Accounts</a></li>
							<li><a href="<?= base_url('app/financial-management/bank-reconcillation')?>">Bank Reconcillation</a></li>
						</ul>
			        </li>
			        <li><a href="#" data-toggle="collapse" data-target="#min-general">General<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
			            <ul class="nav collapse sub-sub" id="min-general">
			              	<li><a href="<?= base_url('app/financial-management/requisition')?>">Requisition (RQ)</a></li>
							<li><a href="<?= base_url('app/financial-management/cash-advance')?>">Cash Advance (CA)</a></li>
							<li><a href="<?= base_url('app/financial-management/request-payment')?>">Request Payment (RP)</a></li>
							<li><a href="<?= base_url('app/financial-management/budget-expense')?>">Budget Expense</a></li>
						</ul>
			        </li>
	            </ul>
	      	</li>
	      	<li><a href="#" data-toggle="collapse" data-target="#warehouse-management-logistics">Warehouse Management & Logistics<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
	            <ul class="nav collapse sub" id="warehouse-management-logistics">
	              	<li><a href="#">Sub Link 1</a></li>
	              	<li><a href="#">Sub Link 2</a></li>
	              	<li><a href="#">Sub Link 3</a></li>
	            </ul>
	      	</li>
	      	<li><a href="#" data-toggle="collapse" data-target="#store-operations">Store Operations<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
	            <ul class="nav collapse sub" id="store-operations">
	              	<li><a href="#">Sub Link 1</a></li>
	              	<li><a href="#">Sub Link 2</a></li>
	              	<li><a href="#">Sub Link 3</a></li>
	            </ul>
	      	</li>
	      	<li><a href="#" data-toggle="collapse" data-target="#human-resource-recruitment">Human Resource & Recruitment<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
	            <ul class="nav collapse sub" id="human-resource-recruitment">
	              	<li><a href="#">Sub Link 1</a></li>
	              	<li><a href="#">Sub Link 2</a></li>
	              	<li><a href="#">Sub Link 3</a></li>
	            </ul>
	      	</li>
	      	<li><a href="#" data-toggle="collapse" data-target="#reports">Reports<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
	            <ul class="nav collapse sub" id="reports">
	              	<li><a href="#">Sub Link 1</a></li>
	              	<li><a href="#">Sub Link 2</a></li>
	              	<li><a href="#">Sub Link 3</a></li>
	            </ul>
	      	</li>
	    </ul>
  	</div>

  	<div class="collapse navbar-collapse navbar-ex1-collapse">
	    <ul class="nav navbar-nav">
	      	<li><a href="#" data-toggle="collapse" data-target="#general">General<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
	            <ul class="nav collapse sub" id="general">
	              	<li><a href="<?= base_url('app/administration/users')?>">Users</a></li>
					<li><a href="<?= base_url('app/administration/position')?>">Position</a></li>
					<li><a href="<?= base_url('app/administration/modules')?>">Modules</a></li>
					<li><a href="<?= base_url('app/administration/no-series')?>">Document Series</a></li>
	            </ul>
	        </li>
			<li><a href="#" data-toggle="collapse" data-target="#settings">Settings<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
	            <ul class="nav collapse sub" id="settings">
	              	<li><a href="#">Company</a></li>
					<li><a href="#" data-toggle="collapse" data-target="#master-files">Master Files<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
			            <ul class="nav collapse sub-sub" id="master-files">
				  			<!-- <li><a href="<?= base_url('app/administration/attributes')?>">Attributes</a></li> -->
				  			<li><a href="#" data-toggle="collapse" data-target="#attributes">Attributes<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
					            <ul class="nav collapse sub-sub-sub" id="attributes">
					              	<li><a href="<?= base_url('app/administration/attributes/color')?>">Color</a></li>
					              	<li><a href="<?= base_url('app/administration/attributes/size')?>">Sizes</a></li>
					              	<li><a href="<?= base_url('app/administration/attributes/size_cat')?>">Size Category</a></li>
					              	<li><a href="<?= base_url('app/administration/attributes/uom')?>">Unit of Measurement</a></li>
					              	<li><a href="<?= base_url('app/administration/attributes/currency')?>">Currency</a></li>
								</ul>
					        </li>
				  			<li><a href="<?= base_url('app/administration/size-grouping')?>">Size Grouping</a></li>
				  			<li><a href="javascript:void(0)">Cost/Profit Center</a></li>
				  			<li><a href="javascript:void(0)">Location/Store Profile</a></li>
				  			<li><a href="javascript:void(0)">POS Terminal</a></li>
				  			<li><a href="javascript:void(0)">Product Definition</a></li>
				  			<li><a href="javascript:void(0)">Customer</a></li>
				  			<li><a href="javascript:void(0)">Supplier</a></li>
				  			<li><a href="javascript:void(0)">Employee</a></li>	
			            </ul>
			        </li>
			        <li><a href="<?= base_url('app/administration/exchange-rate')?>">Exchange Rate</a></li>
			        <li><a href="<?= base_url('app/administration/unit-conversion')?>">Unit Conversion</a></li>
			    </ul>
	        </li>
	        <li><a href="#" data-toggle="collapse" data-target="#module-setup">Module Setup<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
	            <ul class="nav collapse sub" id="module-setup">
	            	<li><a href="#" data-toggle="collapse" data-target="#purchase-setup">Purchase Setup<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
			            <ul class="nav collapse sub-sub" id="purchase-setup">
			              	<li><a href="javascript:void(0)">Payment Terms</a></li>	
			            </ul>
			        </li>
			        <li><a href="#" data-toggle="collapse" data-target="#accounting-setup">Accounting Setup<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
			            <ul class="nav collapse sub-sub" id="accounting-setup">
			              	<li><a href="javascript:void(0)">Liquidation</a></li>	
			            </ul>
			        </li>
	            </ul>
	        </li>
	        <li>
				<a href="javascript:void(0)">
					<span>Document Tracking</span>
				</a>
			</li>
		</ul>
  	</div><!-- /.navbar-collapse -->
</nav>