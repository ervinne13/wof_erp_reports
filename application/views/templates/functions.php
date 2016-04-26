<?php  if($function){  ?>
<span class="dropdown pull-right">
	<a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
    	Functions
    	<span class="caret"></span>
  	</a>
  	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
  		<?php foreach ($function as $key => $value) { ?>
        	<li>
	        	<a href="javascript:void(0)" class="<?= TRIM($value['F_Trigger']) ?>" 
		        	<?php if(isset($attr)){ foreach ($attr as $data => $val) {
		        		echo "$data='$val'";
		        	} } ?> 
	        	><?= TRIM($value['F_FunctionName']) ?></a>
        	</li>
  		<?php } ?>
  	</ul>
</span>
<?php } ?>