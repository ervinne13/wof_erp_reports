<?php foreach ($functions as $key => $value) { ?>
	<a href="" id="<?=$key?>" 
		<?= in_array($key, array('rq-track-document'))?'data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#doc-tracking" ':'' ?>   
	><?=$value?></a>
<?php } ?>