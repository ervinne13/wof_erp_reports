<?=$header?>
<button type="button" class="btn collapse navbar-collapse" id="toggle-nav">
  <span class="glyphicon glyphicon-triangle-left"></span>
</button>
<div id="main-container" class="row nopad">
  <div class="col-sm-2 nopad " id="left-cont" style="<?=isset($hide_nav) ? 'display:none' : NULL;?>">
    <?=$navs?>
  </div>
  <div class="nopad <?=isset($hide_nav) ? 'col-sm-12' : 'col-sm-10';?>" id="right-cont">
    <div id="content">
      <div id="header" class="container-fluid">
        <?=$head?>
      </div>
      <div id="content-container" class="container-fluid">
        <?=$content?>
      </div>
    </div> 
  </div>
</div>
<div class="modal fade bottom form">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    </div>
  </div>
</div>  
<?=$footer?>