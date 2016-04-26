<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
     <h4 class="modal-title">No Series</h4>
</div>
<div class="modal-body">
	<div id="data-container" class="container-fluid">
		<div id="data-container" class="container-fluid">
		    <table id="series-tbl" class="table table-striped table-hover table-bordered">
					<thead>
					<tr>
						<th></th>
						<th>No Series ID</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data as $key => $value) {?>
					<tr>
						<td>
					 		<input type="radio" name="NS_Id" value="<?=$value['id']?>" >
						</td>
						<td><?=$value['NS_Id']?></td>
						<td><?=$value['NS_Description']?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default form-btn sub-clr" data-dismiss="modal">Close</button>
    <button type="button" id="series-ok" class="btn btn-default form-btn main-clr">Ok</button>    
</div>
