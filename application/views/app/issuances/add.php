<?=$header?>

<style>
.table-bordered thead tr th, .table-bordered tbody tr td{
	text-align:center;
}
.table-bordered thead tr th a, .table-bordered tbody tr td a{
	display: block;
	margin:0 auto !important;
}

.radion-label{
	line-height: 1;
	margin-right: 10px;
}

.radion-label input{
	margin-top: -5px;
}


</style>

<div id="main-container" class="row nopad">
	<div class="col-sm-12 nopad">
	    <div id="content">
	      	<div id="header">
	        	<?=$head?>
	      	</div>
	      	<div id="content-container" class="container-fluid">
	       		<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title"><?=$title?></h3>
					</div>
					<div class="panel-body">
						<div id="data-container" class="container-fluid">
						
						
<div class="row">
	<form method="POST" class="form-horizontal row page-form form" role="form">
		<span class="col-md-6">
			<div class="form-group">
				<label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
				<div class="col-xs-7 input-group primary">
					<input type="text" class="form-control" id="" tabindex="1" name="DocNo" placeholder="Document No.">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-5" for="">Booth Area:</label>
				<div class="col-xs-7">
					<input type="text" class="form-control" id="" tabindex="1" name="booth_area" placeholder="">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-5" for="">Shift:</label>
				<div class="col-xs-7">
					<input type="text" class="form-control" id="" tabindex="1" name="shift" placeholder="">
				</div>
			</div>
			
			
		</span>
		
		<span class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-xs-5" for="">Issue To:</label>
			  <div class="col-xs-7">
				<select class="form-control single-default" placeholder="Request To" id="" name="RQL_RequestTo" tabindex="-1" >
					<option value="[Cashier]" selected="selected">[Cashier]</option>
				</select>
			  </div>
			</div>
			<!--
			<div class="form-group">
				<label for="sel1" class="control-label col-xs-5">Doc. Date:</label>
				<div class="col-xs-7 input-group primary">
					<input type="text" class="form-control" id="" tabindex="1" name="DocDate">
				</div>
			</div>
			-->
			<div class="form-group">
				<label class="control-label col-xs-5" for="">Holiday:</label>
				<div class="col-xs-7">
				<div class="radio">
					<label class="radion-label" ><input id="c-no" type="radio"  name="holiday" value="0" checked="checked"> No</label>
						<label class="radion-label" ><input id="c-yes" type="radio" name="holiday" value="1">Yes</label>
					
				</div>
						
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-5" for="">Status:</label>
				<div class="col-xs-7">
					<input type="text" class="form-control" id="" tabindex="1" name="status" value="" placeholder="">
				</div>
			</div>
		</span>
		<span class="col-md-6 ">
			<div class="form-group">
				<div class="col-md-offset-5 col-md-7">
					<button type="submit" name="save" class="btn btn-default form-btn main-clr">Save</button>
					<a type="button" tabindex="20" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
					   Cancel
					</a>
				</div>
				
			</div>
			
		</span>
	</form>
</div>


						</div>
					</div>
				</div>
	      	</div>
	    </div> 
	</div>
</div>
<?=$footer?>
<script type="text/javascript">
	
	$('#calendar').fullCalendar({
		header: {
			      left: 'prev,next today',
			      center: 'title',
			      right: 'month,agendaWeek,agendaDay'
			    },
		editable: true,
	});

</script>