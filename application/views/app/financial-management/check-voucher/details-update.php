<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="check-voucher-details-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
				     <div class="form-group">
				      <label class="control-label col-xs-5" tabindex="1" for="">Comment:</label>
				      <div class="col-xs-7">
				        <textarea name="CVD_Comment"><?=$data['CVD_Comment']?></textarea>
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="2" data-id="<?= $data['mid']; ?>" data-loc="<?=$data['id']?>" id="update-det" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="3" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/dback/?id=<?=$data['id']?>&mid=<?=$data['mid']?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

  $(document).on("click","#update-det",function(){
	    var $btn = $(this);
	    var $lbl = $btn.text();
	    form = $('#check-voucher-details-form');
	    data = form.serializeArray();
	    data.push({name:"type",value:'update-details'},
	          	{name:"uniqid",value:$(this).data('id')},
	          	{name:"uniqfid",value:$(this).data('loc')});
    
	    confirm("Save Entry?", function(confirmed) {
	        if(confirmed){ 
	        $btn.attr('disabled',true).text('Processing..');
	        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
	          if(data.result == 0){
	            error_message(data.errors);
	          $btn.attr('disabled',false).text($lbl);
	          }else{
	            alert('Saved!');
	            window.location = base_url+'app/'+_module+'/'+_class+'/view/?id='+$btn.data('loc');
	          }
	        },'json').error(function(){
	          alert('Error!');
	          $btn.attr('disabled',false).text($lbl);
	        });
	      }
	    });
	  });

	
</script>