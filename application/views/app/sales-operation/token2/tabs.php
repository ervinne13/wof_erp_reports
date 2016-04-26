<ul class="nav nav-tabs side-coupon-tab" >
	<li class="<?=$this->uri->segment(4) == 'details' ? 'active' : NULL ;?>">
		<a href="<?=site_url('app/sales-operation/token/details');?>"  >Free Token / Ticket Issuance</a>
	</li>
	<li class="<?=$this->uri->segment(4) == 'fgc_setup' ? 'active' : NULL ;?>">
		<a href="<?=site_url('app/sales-operation/token/fgc_setup');?>" >FGC/GRC Setup</a>
	</li>
	<li class="<?=$this->uri->segment(4) == 'promo_setup' ? 'active' : NULL ;?>">
		<a href="<?=site_url('app/sales-operation/token/promo_setup');?>"  >VIP/Promo Setup</a>
	</li>
</ul>