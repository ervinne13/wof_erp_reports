<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<table class="retrieval-tbl table table-striped table-hover table-bordered  table-condensed">
				<thead>
					<tr>
						<th>
						</th>
						<th>Control #</th>
						<th>Retrieval #</th>
						<th>Period Cover</th>
						<th>Cost</th>
						<th>Val Week 1</th>
						<th>Val Week 2</th>
						<th>Val Week 3</th>
						<th>Val Week 4</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>201501</td>
						<td>Branch-01-0001</td>
						<td>January 2015</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>201502</td>
						<td>Branch-01-0002</td>
						<td>February 2015</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>201503</td>
						<td>Branch-01-0003</td>
						<td>March 2015</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>201504</td>
						<td>Branch-01-0004</td>
						<td>April 2015</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>201505</td>
						<td>Branch-01-0005</td>
						<td>May 2015</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
						<td>1000</td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>201506</td>
						<td>Branch-01-0006</td>
						<td>June 2015</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>201507</td>
						<td>Branch-01-0007</td>
						<td>July 2015</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>201508</td>
						<td>Branch-01-0008</td>
						<td>August 2015</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>201509</td>
						<td>Branch-01-0009</td>
						<td>September 2015</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>201510</td>
						<td>Branch-01-0010</td>
						<td>October 2015</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>201511</td>
						<td>Branch-01-0011</td>
						<td>November 2015</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>
							<a href="<?= base_url().uri_string() ?>/view" class="">
								<span class="glyphicon glyphicon-search"></span>
							</a>
						</td>
						<td>201512</td>
						<td>Branch-01-0012</td>
						<td>December 2015</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
    </div>
</div>
<script type="text/javascript">
	$('.retrieval-tbl').bind('dynatable:init', function(e, dynatable) {
	$('.dynatable-per-page').append('Branch: <select class="filter col-sm-2" ><option disabled selected>Branch</option></select> ');
    $('.dynatable-search').prepend('Date Filter: <input type="search" id="date-from"/> ')
    .append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    $(this).wrap('<div class="table-container"></div>')
    var $demo1 = $(this);
    $demo1.floatThead({
      scrollContainer: function($table){
        return $table.closest('.table-container');
      }
    });
    $("#date-from").datepicker({
        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
        }
    });

    $("#date-from").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
	  }).dynatable();

	  $('li.active a').on('click',function(){
	    return false;
	  });
</script>