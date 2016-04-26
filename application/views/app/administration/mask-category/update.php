<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Level:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="<?= $data['MC_Level'] ?>" tabindex="1" name="MC_Level" placeholder="Level ID">
				      </div>
					</div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Description:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="100" value="<?= $data['MC_Desc'] ?>" tabindex="2" name="MC_Desc" placeholder="Description">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Width:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" value="<?= $data['MC_Width'] ?>" tabindex="3" name="MC_Width" placeholder="Width">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Label Use:</label>
				      <div class="col-xs-7">
				        <input type="checkbox" tabindex="4"  name="MC_LabelUse" <?= $data['MC_LabelUse']==1?'checked':''?> >
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="5" data-id="<?= md5($data['MC_Level']); ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="6" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= md5($data['MC_Level']); ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('input[name=uc_date]').datepicker();
</script>