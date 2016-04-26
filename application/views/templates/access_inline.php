<?php if($access){ 
	 foreach ($access as $key => $value) { ?>
		<a  
				<?php if(isset($id) && $value['UA_Get'] == 1){ ?>
					href="<?= base_url().'app/'.TRIM($value['UA_Trigger']).'?id='.$id?>"
				<?php }else if(isset($id) && $value['UA_Get'] != 1){ ?>
					href="javascript:void(0)" class="<?=TRIM($value['UA_Trigger'])?>" data-id="<?=$id?>"
				<?php }else{ ?>
					href="<?= base_url().'app/'.TRIM($value['UA_Trigger'])?>"
				<?php } ?>
			data-container="body" data-toggle="tooltip" data-placement="top" title=" <?=$value['UA_AccessName']?>">
			<span class="glyphicon <?=$value['UA_Icon']?> >"></span>
		</a>
<?php } } ?>