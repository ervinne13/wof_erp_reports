<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<table class="presentation table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>
							<a href="<?= base_url().uri_string() ?>/add" class="">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
						<th>Document No.</th>
						<th>Document Date</th>
						<th>Booth Area</th>
						<th>Shift</th>
						<th>Issued To</th>
						<th>Holiday</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
                    <tr>
                        <td>
                            <a href="<?= base_url().uri_string() ?>/edit" class="">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <a href="<?= base_url().uri_string() ?>/view" class="edit">
                                <span class="glyphicon glyphicon-search"></span>
                            </a>
                        </td>
                        <td>CSR-10001</td>
                        <td>03/11/16</td>
                        <td>B1</td>
                        <td>Opening</td>
                        <td>[Cashier]</td>
                        <td>Holiday</td>
                        <td>Open</td>
                    </tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
    $(function() {
        var	table = $('.dynatable').dynatable({
            dataset: {
                ajax: true,
                ajaxUrl: base_url + "app/"+ _module + "/" + _class + "data",
                ajaxOnLoad: true,
                records: []
            },
            features: {
                pushState: false
            },
            inputs: {
                processingText: '<img  id="loader" src="'+base_url+'css/assets/data_loader.gif" />'
            }
        }).data('dynatable');
    });
</script>