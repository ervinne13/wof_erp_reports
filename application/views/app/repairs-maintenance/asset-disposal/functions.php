<?php  if($function){  ?>
<span class="dropdown pull-right">
	<a href="" class="dropdown-toggle function-rq" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
    	Functions
    	<span class="caret"></span>
  	</a>
  	<ul class="dropdown-menu rq-function" role="menu" aria-labelledby="dropdownMenu1">
  		<?php foreach ($function as $key => $value) { ?>
        	<li>
	        	<a href="" id="<?= $key ?>"  
	        	><?= $value ?></a>
        	</li>
  		<?php } ?>
  	</ul>
</span>
<?php } ?>