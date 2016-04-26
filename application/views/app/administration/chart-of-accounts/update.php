<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Account Code:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="50" disabled value="<?=$data['CA_Account_id']?>" tabindex="1" name="CA_Account_id" placeholder="Account Code">
				      </div>
					</div>
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Debit:</label>
				      <div class="col-xs-7">
				        <input type="checkbox" tabindex="2" name="CA_AccountDebit" <?=$data['CA_AccountDebit']==1?'checked':'' ?> >
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Default Account:</label>
				      <div class="col-xs-7">
				        <input type="checkbox" tabindex="3" name="CA_DefaultAccount" <?=$data['CA_DefaultAccount']==1?'checked':'' ?> >
				      </div>
				    </div>
				    <div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Account Name:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="200" value="<?=$data['CA_AccountName']?>" tabindex="4" name="CA_AccountName" placeholder="Account Name">
				      </div>
					</div>
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Sub Account of:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" id="" maxlength="50" value="<?=$data['CA_SubAccountOf']?>" tabindex="5" name="CA_SubAccountOf" placeholder="Sub Account of">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Description:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" maxlength="200" value="<?=$data['CA_AccountDesc']?>"  tabindex="6" name="CA_AccountDesc" placeholder="Description">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Book Type:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" maxlength="30" value="<?=$data['CA_BookType']?>"  tabindex="7" name="CA_BookType" placeholder="Book Type">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Account Type:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" maxlength="30" value="<?=$data['CA_FK_Attribute_AccountType_id']?>" tabindex="8" name="CA_FK_Attribute_AccountType_id" placeholder="Account Type">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Level:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" value="<?=$data['CA_AccountLevel']?>" tabindex="9" name="CA_AccountLevel" placeholder="Level">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Opening Balance:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control dc-mal" value="0" value="<?=$data['CA_OpeningBalance']?>"  id="" maxlength="20" tabindex="10" name="CA_OpeningBalance" placeholder="Opening Balance">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Balance as of:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  id="" value="<?=$data['CA_BalanceAsOf']?>" tabindex="11" name="CA_BalanceAsOf" placeholder="Balance as of">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Current Balance:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control dc-mal" value="0" value="<?=$data['CA_CurrentBalance']?>" id="" maxlength="20" tabindex="12" name="CA_CurrentBalance" placeholder="Current Balance">
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="13" data-id="<?= $data['id']; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="14" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	$('.dc-mal').maskMoney({thousands:',', decimal:'.', allowZero:false, precision:4});
  
  	$('.dc-mal').maskMoney('mask',this.value);
  	
	check_if_changed($('#' + _class + '-form'),$('#update'));
</script>