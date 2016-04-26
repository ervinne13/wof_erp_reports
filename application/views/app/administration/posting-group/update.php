<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Posting Group Code:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="30" disabled value="<?= $data['PG_Id']; ?>" tabindex="1" name="PG_Id" placeholder="Posting Group Code">
				      </div>
					</div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Description:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="50" value="<?= $data['PG_Description']; ?>" tabindex="2" name="PG_Description" placeholder="Description">
				      </div>
					</div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="3" data-id="<?= $data['id']; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="4" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	check_if_changed($('#' + _class + '-form'),$('#update'));
</script>