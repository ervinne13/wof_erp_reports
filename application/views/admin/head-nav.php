<div id="main-nav" class="collapse navbar-collapse nopad">
  <nav class="navbar navbar-default" id="top-nav">
    <div class="container-fluid">
      <ul class="nav nav-pills navbar-right">
        <li><a href="<?= base_url('app')?>"><span class="glyphicon glyphicon-alert"></span> Dashboard</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-alert"></span> Notification</a></li>
        <li><a href="<?= base_url()?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
        <li><a href="<?= base_url()?>logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?= $this->session->all_userdata()['u_username']?></a></li>
      </ul>
    </div><!-- /.container-fluid -->
  </nav>
</div>
<ul class="breadcrumb collapse navbar-collapse">
 
</ul>
