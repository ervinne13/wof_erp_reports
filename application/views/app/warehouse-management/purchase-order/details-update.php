<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="request-payment-details-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount:</label>
				      <div class="col-xs-7">
				      	<label class="control-label" for=""><?=$data['APVD_Amount']?></label>
				       </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Line Discount %:</label>
				      <div class="col-xs-7">
				      	<input type="text" class="form-control"  value="<?=$data['APVD_LineDiscPerc']?>"  name="APVD_LineDiscPerc" tabindex="1" name="" placeholder="Line Discount %">
					  </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Line Discount Amount:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control"  value="<?=$data['APVD_LineDiscAmount']?>"  name="APVD_LineDiscAmount" tabindex="2" name="" placeholder="Line Discount Amount">
				      </div>
				    </div>
				</span>
			</form>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="3" data-id="<?= $data['mid']; ?>" data-loc="<?=$data['id']?>" id="update-det" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="4" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/dback/?id=<?=$data['id']?>&mid=<?=$data['mid']?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
  var $data = <?=json_encode($data)?>;

  $('input[name=APVD_LineDiscAmount]').on('change',function(){
  	_this = $(this);
  	discountAmount 	= parseFloat(_this.val());
  	amount 		 	= parseFloat($data.APVD_Amount);
  	total 			= 0; 
  	if (discountAmount && discountAmount < amount) {
       total  = (discountAmount / amount) * 100;
    } else {
        alert("Discount amount shouldn't be higher than amount!");
        _this.val(0);
    }
  	$('input[name=APVD_LineDiscPerc]').val(parseFloat(total.toFixed(2)));
  });

  $('input[name=APVD_LineDiscPerc]').on('change',function(){
  	_this = $(this);
  	discountPerc = parseFloat(_this.val());
  	amount 		 = parseFloat($data.APVD_Amount);
  	$('input[name=APVD_LineDiscAmount]').val(parseFloat((amount * discountPerc) / 100).toFixed(2));
  });

  $(document).on("click","#update-det",function(){
	    var $btn = $(this);
	    var $lbl = $btn.text();
	    form = $('#request-payment-details-form');
	    data = form.serializeArray();
	    data.push({name:"type",value:'update-details'},
	          	{name:"uniqid",value:$(this).data('id')},
	          	{name:"uniqfid",value:$(this).data('loc')});
	    $(form).find('input[type=checkbox]').each(function() {
	      data.push({ name: this.name, value: this.checked ? 1 : 0 });
	    });
	    
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