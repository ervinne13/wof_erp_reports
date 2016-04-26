<?=$header?>
<style>
.head-table{
	margin:10px 0 20px 0;
}
.head-table tr td.table-label{
	text-align:right;
	width:80px;
	padding-right:5px;
}
.head-table tr td.table-td-bordered{
	text-align:center;
	border:1px solid #000000;
	padding:5px 20px !important;
}
.shaded-of-gray{
	background-color:#BDBDBD;
}
h4.full-colored{
	background: #3D6A7D;
	float:left;
	width:100%;
	padding:10px;
	color:#fff;
}
.table-bordered thead tr th{
	text-align:center;
}

.nav-tabs{
	margin-bottom: 10px;
}
.un-bordered{
	border:0 !important;
	text-align:center;
	background:transparent
}
</style>


	      	<div id="content-container" class="container-fluid">
	       		<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">
							<?=$title?>
							<?php if (!empty($functions)): ?>
								<span class="dropdown pull-right">
									<a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
										Functions
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu functions" role="menu" aria-labelledby="dropdownMenu1">
										<li>
											<?= $functions ?>
										</li>
									</ul>
								</span>
							<?php endif ?>
						</h3>
					</div>
					<div class="panel-body">
						<div id="data-container" class="container-fluid">
						
<form action="<?=base_url()?>app/sales-operation/<?=$module;?>/<?=$save_page?>/<?=$issuances['IS_DocNo']?>" method="POST">			
<div class="row">
	<div class="col-xs-4">
		<table class="head-table">
			<tr>
				<td class="table-label">Doc. No.:</td>
				<td class="table-td-bordered shaded-of-gray"><?=$issuances['IS_DocNo']?></td>
			</tr>
			<tr>
				<td class="table-label">Booth Area: </td>
				<td class="table-td-bordered <?=($module == 'returns')?'shaded-of-gray':'';?>">
					<?php 
						if($module == 'returns'){
							echo $issuances['IS_BoothArea'];
						}else{
							echo '<input type="text" name="IS_BoothArea" value="'.$issuances['IS_BoothArea'].'" class="un-bordered" />';
						}
					?>
				</td>
			</tr>
			<tr>
				<td class="table-label">Shift: </td>
				<td class="table-td-bordered <?=($module == 'returns')?'shaded-of-gray':'';?>">
					<?php 
						if($module == 'returns'){
							echo $issuances['IS_Shift'];
						}else{
							echo '<input type="text" name="IS_Shift" value="'.$issuances['IS_Shift'].'" class="un-bordered" />';
						}
					?>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-xs-4">
		<table class="head-table">
			<tr>
				<td class="table-label">Doc. Date: </td>
				<td class="table-td-bordered shaded-of-gray"><?=$issuances['IS_DocDate']?></td>
			</tr>
			<tr>
				<td class="table-label">Issued To:</td>
				<td class="table-td-bordered <?=($module == 'returns')?'shaded-of-gray':'';?>">
					<?php 
						if($module == 'returns'){
							echo $issuances['IS_IssuedTo'];
						}else{
							echo '<input type="text" name="IS_IssuedTo" value="'.$issuances['IS_IssuedTo'].'" class="un-bordered" />';
						}
					?>
				</td>
			</tr>
			<tr>
				<td class="table-label">Status: </td>
				<td class="table-td-bordered shaded-of-gray"><?=$issuances['IS_IssuanceStatus']?></td>
			</tr>
		</table>
	</div>
	<div class="col-xs-4">
		<table class="head-table">
			<tr>
				<td class="table-label">Company:</td>
				<td class="table-td-bordered shaded-of-gray"><?=$issuances['IS_Company']?></td>
			</tr>
			<tr>
				<td class="table-label">Branch: </td>
				<td class="table-td-bordered <?=($module == 'returns')?'shaded-of-gray':'';?>">
					<?php 
						if($module == 'returns'){
							echo $issuances['IS_Location'];
						}else{
							echo '<input type="text" name="IS_Location" value="'.$issuances['IS_Location'].'" class="un-bordered" />';
						}
					?>
				</td>
			</tr>
			<tr>
				<td class="table-label">Holiday: </td>
				<td class="table-td-bordered <?=($module == 'returns')?'shaded-of-gray':'';?>">
					<?php if($module == 'returns'): ?>
						<label> <input type="radio" name="holiday" <?=($issuances['IS_Holiday']==1?'checked="checked"':'')?> value="1" disabled> Yes </label>
						<label> <input type="radio" name="holiday" <?=($issuances['IS_Holiday']==0?'checked="checked"':'')?> value="0" disabled> No </label>
					<?php else: ?>
						<label> <input type="radio" name="holiday" <?=($issuances['IS_Holiday']==1?'checked="checked"':'')?> value="1"> Yes </label>
						<label> <input type="radio" name="holiday" <?=($issuances['IS_Holiday']==0?'checked="checked"':'')?> value="0"> No </label>
					<?php endif; ?>
				</td>
			</tr>
		</table>
	</div>
	
	<h4 class="full-colored">Details</h4>
	<ul class="nav nav-tabs" id="">
		<li role="presentation" data-page_name="is_token" class="<?=$this->router->fetch_method() == 'details' ? 'active' : NULL;?>"><a href="<?=site_url('app/sales-operation/' . $module .  '/details/' . $issuances['IS_DocNo']);?>">Token</a></li>
		<li role="presentation" data-page_name="is_ticket" class="<?=$this->router->fetch_method() == 'is_ticket' ? 'active' : NULL;?>"><a href="<?=site_url('app/sales-operation/' . $module .  '/is_ticket/' . $issuances['IS_DocNo']);?>">Ticket</a></li>
		<li role="presentation" data-page_name="is_ccf" class="<?=$this->router->fetch_method() == 'is_ccf' ? 'active' : NULL;?>"><a href="<?=site_url('app/sales-operation/' . $module .  '/is_ccf/' . $issuances['IS_DocNo']);?>">Coin change Fund</a></li>
		<li role="presentation" data-page_name="is_dc" class="<?=$this->router->fetch_method() == 'is_dc' ? 'active' : NULL;?>"><a href="<?=site_url('app/sales-operation/' . $module .  '/is_dc/' . $issuances['IS_DocNo']);?>">Data Card</a></li>
		<li role="presentation" data-page_name="is_wt" class="<?=$this->router->fetch_method() == 'is_wt' ? 'active' : NULL;?>"><a href="<?=site_url('app/sales-operation/' . $module .  '/is_wt/' . $issuances['IS_DocNo']);?>">Wrist Tag</a></li>
		<li role="presentation" data-page_name="is_sc" class="<?=$this->router->fetch_method() == 'is_sc' ? 'active' : NULL;?>"><a href="<?=site_url('app/sales-operation/' . $module .  '/is_sc/' . $issuances['IS_DocNo']);?>">Socks</a></li>

		<?php if ($module == 'returns'): ?>
			<li role="presentation" data-page_name="cash_breakdown" class=""><a href="#"></a></li>
		<?php endif ?>
	</ul>
</div>


<input type="hidden" name="return_page" value="<?=!empty($return_page)?$return_page:'details'?>" />



<div id="details_container">
	<?=!empty($page_ui)?$page_ui:'';?>
</div>
</form>



						</div>
					</div>
				</div>
	      	</div>

	      	<input type="hidden" id="module-name" value="<?=$module;?>">
<script type="text/javascript">
	
	$('#calendar').fullCalendar({
		header: {
			      left: 'prev,next today',
			      center: 'title',
			      right: 'month,agendaWeek,agendaDay'
			    },
		editable: true,
	});
	
	
$(document).ready(function(){

	var module = $('#module-name').val();
	
	// set default active page
	$('#default_active_nav_tab').attr('class','active');
	
	// change page on nav tab clicked
	$('#nav_tabs_menu li').on('click', function(){
		var page_name = $(this).data('page_name');
		var me = $(this);
		
		$.ajax({
			dataType:"JSON",
			type:"POST",
			data:{},
			url: '<?=base_url()?>app/sales-operation/' + module + '/'+page_name+'/<?=$issuances['IS_DocNo']?>',
			success:function(response){
				
				$('#details_container').html(response);
				$('#nav_tabs_menu li').removeClass('active');
				me.attr('class','active');

				if(module == 'returns')
					returns.init();
			}
		})
		
	})
	
	
});
	

</script>