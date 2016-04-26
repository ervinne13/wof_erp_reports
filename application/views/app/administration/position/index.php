<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">
			<?=$title?>
		</h3>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<?=generate_table($table)?>
		</div>
	</div>
</div>
<script type="text/javascript">


var	table = $('.dynatable').bind('dynatable:init', function(e, dynatable) {
    	$('.dynatable-search').append("<a  href='javascript:void(0)' class='clear'>Clear</a>");
    	
    	$(document).on('click','.l-del',function(){
		 	_this = $(this);
		      confirm("Delete Record?", function(confirmed) {
		        if(confirmed){ 
		          $.post(base_url+'app/'+ _module + "/" +_class+'/process',{id:_this.data('id'),type:'delete'},function(data){
		            if(data == 1){
		            	alert('Deleted!');
		            	setTimeout(function(){
						  dynatable.process();
						}, 500);
		            }else{
		            	alert(data);
		            }
		          }).error(function(){
		            alert('Error!');
		          });
		        }
		      });

	  	});

		$('.clear').on('click',function(){
			dynatable.sorts.clear();
			dynatable.queries.remove("search");
			$('[type=search]').val('');
			$(".dynatable-arrow").remove();
			dynatable.process();
		});

	    $(this).wrap('<div class="table-container"></div>')
	    var $demo1 = $(this);
			$demo1.floatThead({
				scrollContainer: function($table){
					return $table.closest('.table-container');
				}
		});
			
		
	}).bind('dynatable:afterUpdate', function(dom) {
		$('[data-toggle="tooltip"]').tooltip();	
	}).bind('dynatable:ajax:success', function(response,result) {
		$(this).floatThead('reflow');
		// $result    = result;
		// update_table();
    }).dynatable({
		dataset: {
			ajax: true,
		    ajaxUrl: base_url + "app/"+ _module + "/" + _class + "/data",
		    ajaxOnLoad: true,
		    records: []
		},
		features: {
	   		pushState: false,
		},
		inputs: {
		    processingText: '<img  id="loader" src="'+base_url+'css/assets/data_loader.gif" />'
		  }
	}).data('dynatable');

  //   function update_table(){

		// if(typeof(EventSource) !== "undefined") {
		//     var source = new EventSource(base_url + "app/"+ _module + "/" + _class + "/data_update?" + $.param(table.params));

		//     source.onmessage = function(event) {
	 //    		if($.param(JSON.parse(event.data)) !== $.param($result)){
		//     		table.process();
		//     	}
  //   			source.close();
  //   			setTimeout(function(){
		// 			update_table();
  //   			},5000);
		//     };
		// } else {
		//    console.log("not supported");
		// }

  //   }

    

</script>