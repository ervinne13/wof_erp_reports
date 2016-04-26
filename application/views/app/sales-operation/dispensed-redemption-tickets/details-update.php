<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
          	<div class="dropdown pull-right">
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container">
				<span class="col-md-4">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Item Type:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Machine" id="" tabindex="1" name="u_userid" placeholder="Item Type">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Item No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="FA100001" id="" tabindex="1" name="u_userid" placeholder="Item No.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Drummania V7" id="" tabindex="1" name="u_userid" placeholder="Description">
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Asset Tag:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="AS10001" id="" tabindex="1" name="u_userid" placeholder="Asset Tag">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Location:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="HO-Whse" id="" tabindex="1" name="u_userid" placeholder="Location">
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="2" id="" tabindex="2" name="u_username" placeholder="Qty">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Currency:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="USD" id="" tabindex="1" name="u_userid" placeholder="Currency">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">UOM:</label>
				      <div class="col-xs-7">          
				        <input type="text" class="form-control" value="Unit" id="" name="u_password" placeholder="UOM" tabindex="3" >
				      </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Unit Price:</label>
					  <div class="col-xs-7">          
				        <input type="text" class="form-control" value="1,000.00" id="" name="u_password" placeholder="Unit Price" tabindex="3" >
				      </div>
					</div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Catalogue Price:</label>
					  <div class="col-xs-7">          
				        <input type="text" class="form-control" value="1,000.00" id="" name="u_password" placeholder="Catalogue Price" tabindex="3" >
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="" name="u_password">Amount:</label>
				      <div class="col-xs-7">          
				        <input type="text" class="form-control" value="2,000.00" id="" name="u_password" placeholder="Amount" tabindex="3" >
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount in LCY:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="100,000.00" id="" tabindex="1" name="u_userid" placeholder="Amount in LCY">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Comment:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="[Comment]" id="" tabindex="1" name="u_userid" placeholder="Comment">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Store:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="SM - Naga" id="" tabindex="1" name="u_userid" placeholder="Store">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Reference from:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="PR-100001" id="" tabindex="1" name="u_userid" placeholder="Reference from">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Reference to:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="RR-100001" id="" tabindex="1" name="u_userid" placeholder="Reference to">
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="form-group">
				<a type="button" href="#" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))."/view"?>" class="btn btn-default form-btn sub-clr">
				  Back
				</a>
			</div>
		</div>
	</div>
</div>