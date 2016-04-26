<?=$header?>
<div id="main-container" class="row nopad">
    <div class="col-sm-12 nopad">
        <div id="content">
            <div id="header">
                <div id="main-nav" class="collapse navbar-collapse nopad">
                  <nav class="navbar navbar-default" style="min-height:50px;border-bottom-left-radius:4px;border-bottom-right-radius:4px;" id="top-nav">
                    <div class="container-fluid">
                      <ul class="nav nav-pills navbar-right">
                        <li><a href="<?=base_url()?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
                       </ul>
                    </div><!-- /.container-fluid -->
                  </nav>
                </div>
            </div>
            <div id="content-container" class="container-fluid">
                <div class="col-md-3" style="float:none;margin:80px auto;" id="login-cont">
                    <div  class="panel">
                        <?= isset($error)&&$error==1?"Invalid Login":""?>
                        <div id="login-cont" class="panel-heading">
                            <div class="panel-title">
                                <h5>Login</h5>
                            </div> 
                        </div>
                        <div class="panel-body">
                            <div id="data-container" class="container-fluid">
                                <form method="POST" action="<?=base_url()?>login/verify">
                                   <div class="form-group">
                                      <label class="control-label" for="">Username</label>
                                      <div class="">
                                        <input type="text" class="form-control" id="" tabindex="1" name="U_User_id" placeholder="Username">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label" for="">Password</label>
                                      <div class="">
                                        <input type="password" class="form-control" id="" tabindex="1" name="U_Password" placeholder="Password">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default form-btn main-clr pull-right">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
<?=$footer?>