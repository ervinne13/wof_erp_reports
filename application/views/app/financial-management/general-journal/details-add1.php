
<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">
			<?=$title?>
		</h3>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form class="form-horizontal row page-form" role="form" class="container-fluid" id="detail_add">
				<span class="col-md-4">
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Account Type:</label>
					  <div class="col-xs-7">
					  	<input type="text" class="form-control" id="acc_type" tabindex="1" name="acc_type" placeholder="Account Type">
				      </div>
					</div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Account No:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="acc_no" tabindex="1" name="acc_no" placeholder="Account No" readonly="">
				      </div>
				    </div>
				     <div class="form-group">
				      <label class="control-label col-xs-5" for="">Account Name:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="acc_name" tabindex="1" name="acc_name" placeholder="Account Name" readonly="">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Amount:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="acc_amount" tabindex="1" name="acc_amount" placeholder="Amount">
				      </div>
				    </div>
				</span>
				<span class="col-md-4">
					<div class="form-group">
				      <label class="control-label col-xs-5" for="">Currency:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="acc_currency" tabindex="2" name="acc_currency" placeholder="Currency" readonly="">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Cost Center:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="cost_center" tabindex="2" name="cost_center" placeholder="Cost Center" readonly="">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Comment:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="comment" tabindex="2" name="comment" placeholder="Comment">
				      </div>
				    </div>
				    <!--div class="form-group">
				      <label class="control-label col-xs-5" for="">Bal. Account Type:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="bal_acc_type" tabindex="2" name="bal_acc_type" placeholder="Bal. Account Type">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Bal. Account No.:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="bal_acc_no" tabindex="2" name="bal_acc_no" placeholder="Bal. Account No.">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Bal. Account Name:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" id="bal_acc_name" tabindex="1" name="bal_acc_name" placeholder="Bal. Account Name">
				      </div>
				    </div-->
				</span>
				<span class="col-md-4"> 
					
				</span>
			</form>
			<div class="btn-cont">
				<a type="button" href="#" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))."/view"?>" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))."/view"?>" class="btn btn-default form-btn sub-clr">
				  Back
				</a>
			</div>
		</div>
	</div>
</div>

<div id="openModal" class="modalDialog">
    <div> <a href="#close" title="Close" class="close">X</a>
    	<span id="modalContent">
        </span>
    </div>
</div>
<script>
	$(function() {
		var accountType = ['Bank Account','Customer Account','G/L Account','Vendor Account'];
		
		$("#acc_type").autocomplete({
			source : accountType,
			change : function(){
				var account_type = jQuery.inArray($(this).val(), accountType);
				if(account_type >= 0){
					$('#acc_no').prop('readonly', false);
				}else{
					alert('Invalid Account Type!');
				}
			}
		});

		$('#acc_no').focus(function(){
			var account_type = jQuery.inArray($("#acc_type").val(), accountType);
			if(account_type < 0){
				alert('Invalid Account Type!');
				$('#acc_no').prop('readonly', true);
			}
		});

		$('#acc_no').keyup(function(){
			if(event.keyCode == 13 || event.which == 13){
				var acc_no = $(this).val();
				var acc_type = $('#acc_type').val();
				if(acc_no != ''){

					$.ajax({
						type: "POST",
						url: base_url + "app/financial-management/general-journal/get_accounts", 
						data: {acc_no:acc_no,acc_type:acc_type},
						dataType:'json',
						cache: false,
						success: function(data){
							
							if(data.row == 1){
								$('#acc_name').val(data.acc_name);
								$('#acc_no').val(data.acc_no);
							}else if(data.row > 1){
								$('#acc_name').val('');
								$('#modalContent').html(data.html);
								window.location.href='#openModal';
							}else{
								$('#acc_name').val('');
								alert("Account # '" + acc_no + "' does not exist!");
							}
						},
						error: function(data, exception, errorThrown){
							alert(data.status + ' ' + data.responseText + ' ' + exception + ' ' + errorThrown);
						}
					});
				}else{
					alert('Invalid Account No.!')
				}
				
			}
		});
		$('#acc_no').on('change', function(){
			
			var acc_no = $(this).val();
			var acc_type = $('#acc_type').val();
			if(acc_no != ''){

				$.ajax({
					type: "POST",
					url: base_url + "app/financial-management/general-journal/get_accounts", 
					data: {acc_no:acc_no,acc_type:acc_type},
					dataType:'json',
					cache: false,
					success: function(data){
						
						if(data.row == 1){
							$('#acc_name').val(data.acc_name);
							$('#acc_no').val(data.acc_no);
						}else if(data.row > 1){
							$('#acc_name').val('');
							$('#modalContent').html(data.html);
							window.location.href='#openModal';
						}else{
							$('#acc_name').val('');
							alert("Account # '" + acc_no + "' does not exist!");
						}
					},
					error: function(data, exception, errorThrown){
						alert(data.status + ' ' + data.responseText + ' ' + exception + ' ' + errorThrown);
					}
				});
			}else{
				alert('Invalid Account No.!')
			}
		});
		function select_account(acc_no, acc_name){
			alert('Hi');
		}
		$('#account_det').on('click', function(){
			
			//$('#acc_no').val($(this).attr('acc_no'));
			//$('#acc_name').val($(this).attr('acc_name'));
		});
	});
</script>


	