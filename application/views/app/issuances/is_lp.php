<div id="content-container" class="container-fluid">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$title?></h3>
		</div>
		<div class="panel-body row">
			<div id="data-container" class="container-fluid">


				
				<table class="table table-striped table-bordered table-condensed presentation">
					<thead>
						<tr>
							<th class="text-center">
								<a href="<?=base_url().uri_string()?>/add?save">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</a>
							</th>
							<th>Doc. No.</th>
							<th>Doc. Date</th>
							<th>Booth Area</th>
							<th>Shift</th>
							<th>Issued To</th>
							<th class="text-center">Holiday</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>

						<?php foreach($issuances as $issuance ): ?>
							<tr>
								<td class="text-center">
									<a href="javascript:;">
										<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
									</a>
								</td>
								<td><a href="<?=base_url().uri_string()?>/details/<?=$issuance['IS_DocNo'];?>"><?=$issuance['IS_DocNo'];?></a></td>
								<td><?=date('m/d/Y', strtotime($issuance['IS_DocDate']));?></td>
								<td><?=$issuance['IS_BoothArea'];?></td>
								<td><?=$issuance['IS_Shift'];?></td>
								<td><?=$issuance['IS_IssuedTo'];?></td>
								<td class="text-center"><span class="glyphicon glyphicon-<?=($issuance['IS_Holiday']==1)?'check':'unchecked';?>" aria-hidden="true"></span></td>
								<td><?=$issuance['IS_IssuanceStatus'];?></td>

							</tr>
						<?php endforeach; ?>


					</tbody>
				</table>


			</div>
		</div>
	</div>
</div>