<?php if($access){ 
	 foreach ($access as $key => $value) { ?>
		<a  
				<?php if(isset($id) && $value['UA_GetInside'] == 1){ ?>
					href="<?= base_url().'app/'.TRIM($value['UA_TriggerInside']).'?id='.$id?>"
				<?php }else if(isset($id) && $value['UA_GetInside'] != 1){ ?>
					href="" class="<?=TRIM($value['UA_TriggerInside'])?>" data-id="<?=$id?>"
				<?php }else{ ?>
					href="<?= base_url().'app/'.TRIM($value['UA_TriggerInside'])?>"
				<?php } ?>
				
				<?php 
					if(isset($params)){ 
					foreach ($params as $attr => $val) {
				?>
						<?=$attr.'='.$val?>
				<?php }} ?>
				
			data-container="body" data-toggle="tooltip" data-placement="top" title="<?=$value['UA_AccessName']?>">
			<span class="glyphicon <?=$value['UA_Icon']?> >"></span>
		</a>
<?php } } ?>