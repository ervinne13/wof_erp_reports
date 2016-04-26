<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
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
				      <label class="control-label col-xs-5" for="">Machine Tag:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="[Machine tag]" id="" tabindex="1" name="u_userid" placeholder="Item No.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="Drummania V7" id="" tabindex="1" name="u_userid" placeholder="Description">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Qty:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="1" id="" tabindex="1" name="u_userid" placeholder="Qty">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">UOM:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="unit" id="" tabindex="2" name="u_username" placeholder="UOM">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">CY:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" value="USD" id="" tabindex="1" name="u_userid" placeholder="CY">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="sel1" class="control-label col-xs-5">Comment:</label>
				      <div class="col-xs-7">          
				        <input type="text" class="form-control" value="[comment]" id="" name="u_password" placeholder="Comment" tabindex="3" >
				      </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Cost Center:</label>
					  <div class="col-xs-7">          
				        <input type="text" class="form-control" value="SM - Naga" id="" name="u_password" placeholder="Cost Center" tabindex="3" >
				      </div>
					</div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
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