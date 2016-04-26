<?=$header?>
<div id="main-container" class="container-fluid">
     <nav id="header" class="navbar navbar-default gr-bl">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="" id="logo-container" class="logo navbar-brand">
                <img src="<?= base_url()?>css/assets/wof-logo.jpg" alt="" class="img-circle">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="site-navbar-collapse">
            <ul class="nav navbar-nav navbar-right" id="site-main-menu">
                <?php if(is_logged_in()['status']){ ?>
                <li><a href="<?= base_url()?>app"><span class="glyphicon glyphicon-dashboard" style="font-size:85%;"></span> Dashboard</a></li>
                <li><a href=""><span class="glyphicon glyphicon-alert" style="font-size:85%;"></span> Notification</a></li>
                 <li><a href="<?= base_url()?>logout"><span class="glyphicon glyphicon-off" style="font-size:85%;"></span> Log out</a></li>
                <?php }else{ ?>
                <li><a href="<?= base_url()?>login"><span class="glyphicon glyphicon-log-in" style="font-size:85%;"></span> Login</a></li>
                <?php } ?>
                <li><a href="<?= base_url()?>"><span class="glyphicon glyphicon-home" style="font-size:85%;"></span> Home</a></li>
                <li><a href=""><span class="glyphicon glyphicon-question-sign" style="font-size:85%;"></span> Help</a></li>
                <li><a href=""><span class="glyphicon glyphicon-info-sign" style="font-size:85%;"></span> About</a></li>
                <li><a href=""><span class="glyphicon glyphicon-earphone" style="font-size:85%;"></span> Contact Us</a></li>
            </ul>
        </div>
    </nav>  
    <div id="lower1-container" class="container-fluid">
        <div id="lower2-container" class="row">
            <div  class="well">
             	<div id="content" class="row container-fluid">
                    <h3>Page not found!!!</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$footer?>
