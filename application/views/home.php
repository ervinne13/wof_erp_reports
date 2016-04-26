<?=$header?>
<div id="main-container" class="row nopad">
    <div class="col-sm-12 nopad">
        <div id="content">
            <div id="header">
                <div id="main-nav" class="collapse navbar-collapse nopad">
                  <nav class="navbar navbar-default" style="margin-bottom:30px; min-height:50px;border-bottom-left-radius:4px;border-bottom-right-radius:4px;" id="top-nav">
                    <div class="container-fluid">
                      <ul class="nav nav-pills navbar-right">
                        <li><a href="<?= base_url()?>"><span class="glyphicon glyphicon-home" style="font-size:85%;"></span> Home</a></li>
                        <li><a href=""><span class="glyphicon glyphicon-question-sign" style="font-size:85%;"></span> Help</a></li>
                        <li><a href=""><span class="glyphicon glyphicon-info-sign" style="font-size:85%;"></span> About</a></li>
                        <li><a href=""><span class="glyphicon glyphicon-earphone" style="font-size:85%;"></span> Contact Us</a></li>
                         <?php if(is_logged_in()['status']){ ?>
                        <li><a href="<?= base_url()?>app"><span class="glyphicon glyphicon-dashboard" style="font-size:85%;"></span> Dashboard</a></li>
                        <li><a href=""><span class="glyphicon glyphicon-alert" style="font-size:85%;"></span> Notification</a></li>
                        <li><a href="<?= base_url()?>logout"><span class="glyphicon glyphicon-off" style="font-size:85%;"></span> Log out</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?= $this->session->userdata('U_Username')?></a></li>
                        <?php }else{ ?>
                        <li><a href="<?= base_url()?>login"><span class="glyphicon glyphicon-log-in" style="font-size:85%;"></span> Login</a></li>
                        <?php } ?>
                      </ul>
                    </div><!-- /.container-fluid -->
                  </nav>
                </div>
            </div>
            <div id="content-container" class="container-fluid">
                <div class="col-md-12"  id="login-cont">
                 	<div id="content" class="row container-fluid">
                        <div>
                            <div class="col-sm-4">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Module 1</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                   
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Module 2</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                   
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Module 3</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="col-sm-4">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Module 4</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                   
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Module 5</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                   
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Module 6</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$footer?>
<script type="text/javascript">
     $(document).ready(function () {
    
      $(window).resize(function() {
          hideElements();  
          $('#header').trigger('resize.ScrollToFixed');
      });  

  });

</script>