<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">No Series ID:</label>
					  <div class="col-xs-7">
				        <label for="sel1" class="control-label "><?= $data['NS_Id']; ?></label>
				      </div>
					</div>
				</span>
				<span class="col-md-6">
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Module:</label>
				      <div class="col-xs-7">
				        <label for="sel1" class="control-label"><?= $data['M_Description']; ?></label>
				      </div>
				    </div>
				</span>
				<div class="table-container">
					<table id="approval-tbl" class="table table-striped table-hover table-bordered  table-condensed">
						<thead>
							<tr>
								<th class="col-md-1">
									<a href="javascript:void(0)" class="pre-row">
										<span class="glyphicon glyphicon-plus"></span>
									</a>
								</th>
								<th class="col-md-1">Sequence</th>
								<th class="col-md-4">Position</th>
								<th class="col-md-4">Amount</th>
								<th class="col-md-1">Unlimited</th>
								<th class="col-md-1">Required</th>
							</tr>
						</thead>
						<tbody>
							<tr class="h-row">
								<td class="col-md-1"> 
									<a href="javascript:void(0)" class="d-row-n">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
								<td class="col-md-1">
								</td>
								<td class="col-md-4">
									<div class="form-group container-fluid">
										<div class="col-sm-9">
											<select class="form-control single-default" id=""  name="" tabindex="33">
											  	<option value="" disabled selected>Position</option>
											  	<?php 
										  		if(!empty($position['data'])){
										  			foreach ($position['data'] as $key => $value) {
											  	?>
											  		<option value="<?=$value['P_Position_id']?>" ><?=$value['P_Position']?></option>
											  	<?php }} ?>
											</select>
										</div>	
									</div>
								</td>
								<td class="col-md-4">
									<div class="form-group container-fluid">
										<div class="col-sm-11">
									 		<input type="text" class="form-control" id="" tabindex="34" name="" placeholder="Quantity">
										</div>
								  	</div>
								</td>
								<td class="col-md-1">
									<div class="form-group container-fluid">
										<div class="col-sm-6">
									 		<input type="checkbox">
										</div>
								  	</div>
								</td>
								<td class="col-md-1">
									<div class="form-group container-fluid">
										<div class="col-sm-6">
									 		<input type="checkbox">
										</div>
								  	</div>
								</td>
							</tr>
							<?php 
							if($data['setup']){ 
							foreach (json_decode($data['setup']) as $key => $result) { 
							$id = uniqid().'old';
							?>
							<tr>
								<td class="col-md-1"> 
									<a href="javascript:void(0)" class="d-row-n">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
								<td class="col-md-1">
									<?= $result->AS_Sequence ?>
								</td>
								<td class="col-md-4">
									<div class="form-group container-fluid">
										<div class="col-sm-9">
											<select class="form-control single-default u-sel" name="pos[<?=$id?>][AS_FK_Position_id]" id=""  name="" tabindex="33">
											  	<option value="" disabled selected>Position</option>
											  	<?php 
										  		if(!empty($position['data'])){
										  			foreach ($position['data'] as $key => $value) {
											  	?>
											  		<option value="<?=$value['P_Position_id']?>" <?=$result->AS_FK_Position_id == $value['P_Position_id'] ? 'selected' : '' ?> ><?=$value['P_Position']?></option>
											  	<?php }} ?>
											</select>
										</div>	
									</div>
								</td>
								<td class="col-md-4">
									<div class="form-group container-fluid">
										<div class="col-sm-11">
									 		<input type="text" name="pos[<?=$id?>][AS_Amount]" value="<?= $result->AS_Amount ?>" class="form-control" id="" tabindex="34" name="" placeholder="Quantity">
										</div>
								  	</div>
								</td>
								<td class="col-md-1">
									<div class="form-group container-fluid">
										<div class="col-sm-6">
									 		<input type="checkbox" name="pos[<?=$id?>][AS_Unlimited]" <?= $result->AS_Unlimited=='1'?"checked":"" ?> >
										</div>
								  	</div>
								</td>
								<td class="col-md-1">
									<div class="form-group container-fluid">
										<div class="col-sm-6">
									 		<input type="checkbox" name="pos[<?=$id?>][AS_Required]" <?= $result->AS_Required=='1'?"checked":"" ?> >
										</div>
								  	</div>
								</td>
							</tr>
							<?php }} ?>
						</tbody>
					</table>
				</div>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="4" data-id="<?= $data["id"]; ?>" id="update" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="5" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/back/<?= $data['id']; ?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
(function ( $ ) {
	
	$(document).on("click","#update",function(){
	    var $btn = $(this);
	    var $lbl = $btn.text();
	    form = $('#'+_class+"-form");
	    data = form.serializeArray();
	    data.push({name:"type",value:'update'},
	          {name:"uniqid",value:$(this).data('id')});
	    $(form).find('input[type=checkbox]').each(function() {
	      data.push({ name: this.name, value: this.checked ? 1 : 0 });
	    });
	    
	    confirm("Save Entry?", function(confirmed) {
	        if(confirmed){ 
	        $btn.attr('disabled',true).text('Processing..');
	        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
	          if(data.result == 0){
	            error_message(data.errors);
	          $btn.attr('disabled',false).text($lbl);
	          }else{
	            alert('Saved!');
	             window.location = base_url+'app/administration/'+_class;
	          }
	        },'json').error(function(){
	          alert('Error!');
	          $btn.attr('disabled',false).text($lbl);
	        });
	      }
	    });
	});
  
	$('.pre-row').on('click',function(){
		_this 	= $(this);
		row 	= _this.closest('table').find('tbody tr.h-row').clone();
		_this.closest('table').find('tbody').append(row.show(300).removeClass('h-row'));
		id = (new Date()).getTime();
		row.find('td:eq(1)').text($('tbody tr').length-1);
		stize(row.find('td:eq(2) select').attr('name','pos['+id+'][AS_FK_Position_id]'));
		row.find('td:eq(3) input').attr('name','pos['+id+'][AS_Amount]');
		row.find('td:eq(4) input').attr('name','pos['+id+'][AS_Unlimited]');
		row.find('td:eq(5) input').attr('name','pos['+id+'][AS_Required]');
	});

	$('#approval-tbl tbody').sortable({
		update: function( event, ui ) {
			$('#approval-tbl tbody tr:not(.h-row)').each(function(){
				$(this).find('td:eq(1)').text($(this).index())
			});
		}
	});

	$sel = $('.u-sel').each(function(){
		stize($(this));
	});

	function stize(elem){
		$el = elem.selectize({
                      sortField: 'text',
                      plugins: {
						'dropdown_header': {
							title: 'Position'
						}
					  },
					  dropdownParent:'body'
		});
	}

	$(document).on('click','.d-row-n',function(){
		_this = $(this);
		confirm("Delete Row?", function(confirmed) {

	        if(confirmed){ 
				_this.closest('tr').fadeOut(500, function(){ $(this).remove();});
				$('#update').attr('disabled',false);
			}

		});

	});
	
	check_if_changed($('#' + _class + '-form'),$('#update'));
}( jQuery ));

</script>