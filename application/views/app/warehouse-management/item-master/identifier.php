<?php 
if($data){

	if(isset($peritem)){
		$ident = array_column($peritem['data'],'IMI_FK_IdentifierDetails_id');
	}
		
foreach ($data as $key => $value) {
?>
<tr>
	<td><?=$value['ID_Description']?></td>
	<td>
        <select class="form-control single-default select-iden" placeholder="<?=$value['ID_Description']?>" id="" name="IMI_FK_IdentifierDetails_id[]" tabindex="30">
		  	<option value="" disabled selected><?=$value['ID_Description']?></option>
			<?php
			$identifierdetails = json_decode($value['details']); 
			if($identifierdetails){
			foreach ($identifierdetails as $key => $iden) { 
			?>
				<option value="<?=$iden->IDD_Id?>"  <?= isset($ident) && in_array($iden->IDD_Id, $ident)?'selected':'' ?> ><?=$iden->IDD_Description?></option>
			<?php }} ?>
		</select>
	</td>
</tr>
<?php }} ?>
<script type="text/javascript">
	$identifier = $('.select-iden').each(function(index, obj){
		        $(this).selectize({
		          sortField: 'text',
		          plugins: {
						'dropdown_header': {
							title: $(obj).attr('placeholder')
						}
					},
				  onChange:function(value){
				  	getidentifier();
				  },
				  dropdownParent:'body'
		        });
		      });


	function getidentifier(){
		 
		 var ident = ""
		 $('.select-iden').each(function(){
		 	ident += " "+$(this).find('option:selected').text();
		 });

		 $('input[name=IM_Sales_Desc]').val($('select[name=IM_FK_SubCategory_id] option:selected').text()+ident);
	}
</script>