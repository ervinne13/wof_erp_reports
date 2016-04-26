			
<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">
          	<?=$title?>
          	<a class="cls-btn pull-right" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
			  Close
			</a>
          	<?=$function?>
        </h3>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<div class="row">
				<form class="form-horizontal">
					<span class="col-md-2">
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-7">Expand All:</label>
						  <div class="col-xs-2">
					        <input type="checkbox" class="expand-all">
					      </div>
						</div>
					</span>
					<span class="col-md-2">
						<div class="form-group">
						  <label for="sel1" class="control-label col-xs-7">Select All:</label>
						  <div class="col-xs-2">
					        <input type="checkbox" class="select-all">
					      </div>
						</div>
					</span>
				</form>
			</div>
			<div class="table-container-full">
				<table class="table table-bordered" id="tbl-mdl">
					<thead>
						<tr>
							<th class="col-md-5">Module</th>
							<th class="col-md-3">Access</th>
							<th class="col-md-4">Function</th>
						</tr>
					</thead>
					<tbody>	
						<?=$data?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function () {

	$(document).on('click','td:not(:first-child) .list-group-item',function(){
		$(this).toggleClass('active');
		$(this).find('span').hasClass('glyphicon-unchecked') ? $(this).find('span').removeClass('glyphicon-unchecked').addClass('glyphicon-check') : $(this).find('span').removeClass('glyphicon-check').addClass('glyphicon-unchecked')
	});	
	
	$(document).on('click',".expand-all",function(){
		if($(this).prop('checked')==true){
			$("#tbl-mdl").treetable("expandAll");
		}else{
			$("#tbl-mdl").treetable("collapseAll");
		}
	});

	$(document).on('click',".select-all",function(){
		if($(this).prop('checked')==true){
			$("#tbl-mdl input[type=checkbox]").prop("checked",true).removeAttr('disabled').closest('.checkbox').removeAttr('disabled').removeClass('disabled');
		}else{
			$("#tbl-mdl input[type=checkbox]").prop("checked",false).closest('tr:not([data-tt-parent-id="0"])').find("input[type=checkbox]").attr('disabled',true).closest('.checkbox').attr('disabled',true).addClass('disabled');
		}
	});

	$(document).on('click',".save-setting",function(){
		_this = $(this); 
		data  = [];
		$('#tbl-mdl tbody tr').each(function(){
			func = [];
			acc  = [];
			if($(this).find('td:eq(0) input[type="checkbox"]').prop('checked')==true){
				$(this).find('td:eq(1) input[type="checkbox"]:checked').each(function(){
					acc.push($(this).data('id'));
				});
					acc.push($(this).find('td:eq(0) input[type="checkbox"]:checked').data('id'));
				$(this).find('td:eq(2) input[type="checkbox"]:checked').each(function(){
					func.push($(this).data('id'));
				});
				// console.log(acc);
				// console.log($(this).find('td:eq(0) input[type="checkbox"]:checked').data('module'));
				data.push({name:_this.data('id'),value:[$(this).find('td:eq(0) input[type="checkbox"]').data('module'),JSON.stringify(acc),JSON.stringify(func)]});
			}
		});
		confirm("Save Settings?", function(confirmed) {
		   	if(confirmed){
				$.post(base_url+'app/'+ _module + "/" +_class+'/process',{data:JSON.stringify(data),id:_this.data('id'),type:'settings'},function(){
					window.location = base_url+'app/'+_module+'/'+_class;
				});
			}
		});
		
	});
});

   function recursive_check_child(elem){
	  	if($('[data-tt-parent-id='+elem.closest('tr').data('tt-id')+']').length > 0){
		  	$.each($('[data-tt-parent-id='+elem.closest('tr').data('tt-id')+']'),function(){
	  			if(elem.prop('checked')==false){
	  				elem.closest('tr').find('td:not(td:eq(0)) input[type="checkbox"]').addClass('disabled').attr('disabled',true).prop('checked',false);
	  				elem.closest('tr').find('td:not(td:eq(0)) .checkbox').addClass('disabled').attr('disabled',true).prop('checked',false);
	  				$(this).find('td:not(td:eq(0)) input[type="checkbox"]').addClass('disabled').attr('disabled',true).prop('checked',false);
	  				$(this).find('td:not(td:eq(0)) .checkbox').addClass('disabled').attr('disabled',true).prop('checked',false);
		  			$(this).find('.marker').addClass('disabled').attr('disabled',true).prop('checked',false);
		  		}else{
		  			elem.closest('tr').find('input[type="checkbox"]').removeClass('disabled').removeAttr('disabled').prop('checked',true);
		  			elem.closest('tr').find('.checkbox').removeClass('disabled').removeAttr('disabled').prop('checked',true);
			  		$(this).find('input[type="checkbox"]').removeClass('disabled').removeAttr('disabled').prop('checked',true);
			  		$(this).find('.checkbox').removeClass('disabled').removeAttr('disabled');
			  		$(this).find('.marker').removeClass('disabled').removeAttr('disabled');
	  			}
			  	recursive_check_child($(this).find('.marker'));
		  	});
		}else{
			if(elem.prop('checked')==false){
  				elem.closest('tr').find('td:not(td:eq(0)) input[type="checkbox"]').addClass('disabled').attr('disabled',true).prop('checked',false);
  				elem.closest('tr').find('td:not(td:eq(0)) .checkbox').addClass('disabled').attr('disabled',true);
  				$(this).find('td:not(td:eq(0)) .checkbox').addClass('disabled').attr('disabled',true);
  				$(this).find('td:not(td:eq(0)) input[type="checkbox"]').addClass('disabled').attr('disabled',true).prop('checked',false);
	  			$(this).find('.marker').addClass('disabled').attr('disabled',true).prop('checked',false);
	  		}else{
	  			elem.closest('tr').find('input[type="checkbox"]').removeClass('disabled').removeAttr('disabled').prop('checked',true);
	  			elem.closest('tr').find('.checkbox').removeClass('disabled').removeAttr('disabled').prop('checked',true);
		  		$(this).find('input[type="checkbox"]').removeClass('disabled').removeAttr('disabled').prop('checked',true);
		  		$(this).find('.checkbox').removeClass('disabled').removeAttr('disabled');
		  		$(this).find('.marker').removeClass('disabled').removeAttr('disabled');
  			}
		}
  }
  $('.marker').on('click',function(){
	  	recursive_check_child($(this));
  });
  $("#tbl-mdl").treetable({
		expandable: true,
		indent: 40,
		expanderTemplate: '<b class="drpble glyphicon glyphicon-triangle-right"></b>',
		onNodeCollapse: function(){
			$(this)[0].expander.removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-right');
		},
		onNodeExpand: function(){
			$(this)[0].expander.removeClass('glyphicon-triangle-right').addClass('glyphicon-triangle-bottom');
		},
		onInitialized: function(){
		      $('.treetable  tr[data-tt-parent-id]').each(function(){
		    	if($(this).find('td:eq(0) input[type="checkbox"]').prop('checked')==false){
			    	$('tr[data-tt-parent-id="'+$(this).data('tt-id')+'"]').find('input[data-module]').addClass('disabled').attr('disabled',true);
		    		$('tr[data-tt-parent-id="'+$(this).data('tt-id')+'"] .checkbox').each(function(){
					   $(this).addClass('disabled').attr('disabled',true).find('input[type="checkbox"]').attr('disabled',true);
					});
		    	}
		    	if($(this).find('td:eq(0) input[type="checkbox"]').prop('checked')==false){
		    		$(this).find('.checkbox').each(function(){
		    			$(this).addClass('disabled').attr('disabled',true).find('input[type="checkbox"]').attr('disabled',true);
					});
		    	}
			});
		}
	});

</script>