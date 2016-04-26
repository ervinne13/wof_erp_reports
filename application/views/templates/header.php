<html>
<head>
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/bootstrap.min.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/jquery.dynatable.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/mainstyle.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/fullcalendar.min.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/datepicker.min.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/bootstrap-tour-standalone.min.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/selectize.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/jquery.treetable.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/bootstrap-switch.min.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/bootstrap-editable.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/handsontable.full.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/handsontable.bootstrap.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/handsontable.removeRow.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/style.css<?= '?v='.uniqid() ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/chosen.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/select2.min.css">

	<?php if (isset($css)): ?>
		<?php foreach ($css as $v): ?>
			<link rel="stylesheet" type="text/css" href="<?= $v . '?v=' . uniqid() ?>">
		<?php endforeach ?>
	<?php endif ?>
	
	<script type="text/javascript">
		base_url = "<?= base_url()?>";
		_module  = "<?= $this->uri->segment(2) ?>";
		_class 	 = "<?= $this->uri->segment(3) ?>";
	</script>
	
	<script type="text/javascript" src="<?= base_url()?>js/jquery-2.1.3.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/jquery.dynatable.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/jquery.floatThead.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/moment.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/fullcalendar.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/datepicker.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/bootstrap-tour-standalone.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/selectize.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/bootstrap-prompts-alert.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/scrollToFixed.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/jquery.treetable.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/jquery.maskMoney.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/functions.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/sortmousewidgetcore.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/n-series.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/no.series.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/bootstrap-maxlength.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/mask.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/module_header_processor.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/chosen.jquery.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/handsontable.full.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/handsontable.removeRow.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/handsontable-chosen-editor.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/gridEntry.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/autoNumeric.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/module_processor.js"></script>
	<script type="text/javascript" src="<?= base_url()?>js/select2.min.js"></script>
	
	
	<?php if (isset($js)): ?>
		<?php foreach ($js as $v): ?>
			<script type="text/javascript" src="<?=$v;?>"></script>
		<?php endforeach ?>
	<?php endif ?>
	
	<meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>