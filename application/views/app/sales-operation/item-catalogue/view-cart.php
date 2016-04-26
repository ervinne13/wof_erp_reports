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
	                <li><a href=""  data-toggle="modal" data-target=".rq-h-modal">Convert to RQ</a></li>
              	</ul>
              	<a class="cls-btn" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
				  Close
				</a>
            </span>
      	</h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<div id="rpc-cont" class="row">
				<ul class="row" id="rpc-items-cont">
				  	<li class="col-md-3">
					    <div class="panel thumbnail">
					    	<div class="panel-heading">
						      	<h3 class="panel-title">
						          	Item 1
						          	<button type="button" class="close alert"><span aria-hidden="true">&times;</span></button>
						      	</h3>
						  	</div>
						  	<div class="panel-body">
								<span class="rpc-img-cnt thumbnail-image">
									<img src="<?= base_url('css/assets/wof-logo.jpg') ?>" data-toggle="modal" data-target=".rcp-modal" class="rpc-img img-responsive" >
								</span>
								<hr>
								<form class="form-horizontal">
									<div class="form-group">
									  <label for="sel1" class="control-label col-xs-4">Qty.:</label>
									  <div class="col-xs-8">
									  	<label for="sel1" class="control-label qty">13</label>
								      </div>
									</div>
								</form>
							</div>
					    </div>
				  	</li>
				  		<li class="col-md-3">
					    <div class="panel thumbnail">
					    	<div class="panel-heading">
						      	<h3 class="panel-title">
						          	Item 2
						          	<button type="button" class="close alert"><span aria-hidden="true">&times;</span></button>
						      	</h3>
						  	</div>
						  	<div class="panel-body">
								<span class="rpc-img-cnt thumbnail-image">
									<img src="<?= base_url('css/assets/wof-logo.jpg') ?>" data-toggle="modal" data-target=".rcp-modal" class="rpc-img img-responsive" >
								</span>
								<hr>
								<form class="form-horizontal">
									<div class="form-group">
									  <label for="sel1" class="control-label col-xs-4">Qty.:</label>
									  <div class="col-xs-8">
									  	<label for="sel1" class="control-label qty">3</label>
								      </div>
									</div>
								</form>
							</div>
					    </div>
				  	</li>
				  		<li class="col-md-3">
					    <div class="panel thumbnail">
					    	<div class="panel-heading">
						      	<h3 class="panel-title">
						          	Item 3
						          	<button type="button" class="close alert"><span aria-hidden="true">&times;</span></button>
						      	</h3>
						  	</div>
						  	<div class="panel-body">
								<span class="rpc-img-cnt thumbnail-image">
									<img src="<?= base_url('css/assets/wof-logo.jpg') ?>" data-toggle="modal" data-target=".rcp-modal" class="rpc-img img-responsive" >
								</span>
								<hr>
								<form class="form-horizontal">
									<div class="form-group">
									  <label for="sel1" class="control-label col-xs-4">Qty.:</label>
									  <div class="col-xs-8">
									  	<label for="sel1" class="control-label qty">17</label>
								      </div>
									</div>
								</form>
							</div>
					    </div>
				  	</li>
				  		<li class="col-md-3">
					    <div class="panel thumbnail">
					    	<div class="panel-heading">
						      	<h3 class="panel-title">
						          	Item 4
						          	<button type="button" class="close alert"><span aria-hidden="true">&times;</span></button>
						      	</h3>
						  	</div>
						  	<div class="panel-body">
								<span class="rpc-img-cnt thumbnail-image">
									<img src="<?= base_url('css/assets/wof-logo.jpg') ?>" data-toggle="modal" data-target=".rcp-modal" class="rpc-img img-responsive" >
								</span>
								<hr>
								<form class="form-horizontal">
									<div class="form-group">
									  <label for="sel1" class="control-label col-xs-4">Qty.:</label>
									  <div class="col-xs-8">
									  	<label for="sel1" class="control-label qty">2</label>
								      </div>
									</div>
								</form>
							</div>
					    </div>
				  	</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="modal fade rcp-modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Item 1</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
			<div class="container-fluid">
				<span class="rpc-img-cnt row">
					<img src="<?= base_url('css/assets/wof-logo.jpg') ?>" class="rpc-img" >
				</span>
				<hr>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<hr>
				<form class="form-horizontal">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-9">Qty.:</label>
					  <div class="col-xs-3">
				        <label for="sel1" class="control-label qty">3</label>
				      </div>
					</div>
				</form>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade rq-h-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close alert" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Requisition Header</h4>
      </div>
      <div class="modal-body">
      	<div id="data-container" class="container-fluid">
			<div class="panel-body">
				<div id="data-container" class="container-fluid">
					<form class="form-horizontal row page-form" role="form" class="container-fluid">
						<span class="col-md-6">
							<div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Document No.:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Document No.">
						      </div>
							</div>
						    <div class="form-group">
						      <label class="control-label col-xs-5" for="">Document Date:</label>
						      <div class="col-xs-7">
						        <input type="date" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Document Date.">
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="control-label col-xs-5" for="">Date Required:</label>
						      <div class="col-xs-7">
						        <input type="date" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Date Required">
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="control-label col-xs-5" for="">Remarks:</label>
						      <div class="col-xs-7">
						        <input type="text" class="form-control" id="" tabindex="1" name="u_userid" placeholder="Remarks">
						      </div>
						    </div>
						</span>
						<span class="col-md-6">
							<div class="form-group">
						      <label class="control-label col-xs-5" for="">Ext Doc No:</label>
						      <div class="col-xs-7">
						        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Ext Doc No">
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="control-label col-xs-5" for="">Priority Level:</label>
						      <div class="col-xs-7">
						        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Priority Level">
						      </div>
						    </div>
						    <div class="form-group">
							  <label for="sel1" class="control-label col-xs-5">Reason:</label>
							  <div class="col-xs-7">
						        <input type="text" class="form-control" id="" tabindex="2" name="u_username" placeholder="Reason Code">
						      </div>
							</div>
						</span>
					</form>
				</div>
		    </div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-default form-btn main-clr">Save</button>
		        <button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Back</button>
		     </div>
		</div>
      </div>
    </div>
  </div>
</div>	
<script type="text/javascript">
	function ulWriter(rowIndex, record, columns, cellWriter) {
	  var cssClass = "span4", li;
	  if (rowIndex % 3 === 0) { cssClass += ' first'; }
	  li = '<li class="col-md-3"><div class="panel thumbnail"><div class="panel-heading"><h3 class="panel-title">'+record.item+'</h3></div><div class="panel-body"><span class="rpc-img-cnt thumbnail-image">' + record.thumbnail + '</span><hr><form class="form-horizontal"><div class="form-group"><label for="sel1" class="control-label col-xs-9">Qty.:</label><div class="col-xs-3"><label for="sel1" class="control-label">'+record.qty+'</label></div></div></form></div></li>';
	  return li;
	}
	// Function that creates our records from the DOM when the page is loaded
	function ulReader(index, li, record) {
	  var $li = $(li),
	      $caption = $li.find('.caption');
		  record.thumbnail = $li.find('.thumbnail-image').html();
		  record.item = $li.find('.panel-title').html();
		  record.qty = $li.find('.qty').text();
	}

	$('#rpc-items-cont').dynatable({
	  	table: {
	    	bodyRowSelector: 'li'
	  	},
	  	dataset: {
	    	perPageDefault: 12,
	    	perPageOptions: [4, 8, 12]
	  	},
	  	writers: {
	    	_rowWriter: ulWriter
	  	},
	 	readers: {
	    	_rowReader: ulReader
	  	},
	  	features: {
	   		pushState: false,
		},
		inputs: {
		    processingText: '<img  id="loader" src="'+base_url+'css/assets/data_loader.gif" />'
		},
		// dataset: {
		//     records: [{
		// 			    "thumbnail": "Weezer",
		// 			    "item": "El Scorcho",
		// 			    "qty":"3"
		// 			  },
		// 			  {
		// 			    "thumbnail": "test",
		// 			    "item": "test",
		// 			    "qty":"2"

		// 			  }]
		// }
	});
</script>