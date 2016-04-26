<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
          	<span class="dropdown pull-right">
              	<a class="cls-btn" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>/view" >
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
					  <label for="sel1" class="control-label col-xs-5">Item No:</label>
					  <div class="col-xs-7">
				        <label for="sel1" class="control-label">RD100003</label>
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">Coke</label>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <label class="control-label" for="">SM - Megamall</label>
				      </div>
				    </div>
				</span>
			</form>
			<div class="details">Details</div>
			<table class="tbl-inv table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>Document Type</th>
						<th>Document No.</th>
						<th>Document Date</th>
						<th>Posted Date</th>
						<th>Qty</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>TO</td>
						<td>TO10001</td>
						<td>10/15/2015</td>
						<td>10/17/2015</td>
						<td>10</td>
					</tr>
					<tr>
						<td>RR</td>
						<td>RR10001</td>
						<td>10/15/2015</td>
						<td>10/17/2015</td>
						<td>90</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.tbl-inv').bind('dynatable:init', function(e, dynatable) {
		$('.dynatable-per-page').append('Document Type: <select class="filter col-sm-2" ><option disabled selected>Document Type</option></select>');
   		$('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'> Clear</a>");
	    $(this).wrap('<div class="table-container"></div>')
	    var $demo1 = $(this);
	    $demo1.floatThead({
	      scrollContainer: function($table){
	        return $table.closest('.table-container');
	      }
	    });
	  }).dynatable();
</script>