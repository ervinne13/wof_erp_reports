<?php foreach ($functions as $key => $value) { ?>
	<a href="" id="<?=$key?>" 
		<?= in_array($key, array('track-document','l-track-document'))?'data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#doc-tracking" ':'' ?>   
		<?= $key == 'create-ammortization'?'data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#ammortization" ':'' ?>   
	data-id="<?=$id?>"><?=$value?></a>
<?php } ?>