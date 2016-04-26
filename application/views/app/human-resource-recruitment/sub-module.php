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
	      	<li><a href="#" data-toggle="collapse" data-target="#purchasing">Purchasing<span class="glyphicon glyphicon-plus-sign pull-right"></span></a>
	            <ul class="nav collapse sub" id="purchasing">
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
	              	<li><a href="#">Sub Link 1</a></li>
	              	<li><a href="#">Sub Link 2</a></li>
	              	<li><a href="#">Sub Link 3</a></li>
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

  	<!-- <div class="collapse navbar-collapse navbar-ex1-collapse">
	    <ul class="nav navbar-nav">
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
  	</div> --><!-- /.navbar-collapse -->
</nav>