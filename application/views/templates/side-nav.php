<nav class="navbar navbar-default" id="side-nav" role="navigation">
	<div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mob-nav">
	      <span class="sr-only">Toggle navigation</span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	    </button>
	    <a class="navbar-brand" href="#"><img src="<?=base_url('css/assets/wof-logo.jpg')?>" class=""></a>
  	</div>

  	<div class="collapse hidden-nav" id="mob-nav">
	    <ul class="nav navbar-nav">
	      	<?= $all_mod ?>
	    </ul>
  	</div>

  	<div class="collapse navbar-collapse navbar-ex1-collapse">
	    <ul class="nav navbar-nav">
	      	<?= $sub_mod?>
		</ul>
  	</div><!-- /.navbar-collapse -->
</nav>