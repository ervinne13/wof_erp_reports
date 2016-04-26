<div id="main-nav" class="collapse navbar-collapse nopad">
  <nav class="navbar navbar-default" id="top-nav">
    <div class="container-fluid">
      <ul class="nav nav-pills navbar-right">
        <li class="dropdown">
          <a href="#" id="notifDdown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-alert notif-icon"></span> Notification
          </a>
          <ul class="dropdown-menu notif-D-down" aria-labelledby="notifDdown">
            <!-- <li><a href="#three" class="notifs">test</a></li>  -->
          </ul>
        </li>
        <!-- <li><a href="#"><span class="glyphicon glyphicon-alert"></span> Notification</a></li> -->
        <li><a href="<?= base_url()?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
        <li><a href="<?= base_url()?>logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
        <li><a href="<?= base_url()?>app/administration/users/profile" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#profile-mod"><span class="glyphicon glyphicon-user"></span> <?= $this->session->userdata('U_Username')?></a></li>
      </ul>
    </div><!-- /.container-fluid -->
  </nav>
  <nav class="navbar navbar-default" id="btm-nav">
    <div class="container-fluid">
      <ul class="nav nav-pills nav-justified">
        <li <?=$this->uri->segment(1)=='app' && $this->uri->segment(2) == "" ?"class='active'":"" ?>><a href="<?= base_url()?>app"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
        <?php if(!empty($mod_group)){
          $ctr = 0;
          foreach ($mod_group as $key => $value) {
        ?>
        <?php
          if($ctr == 4 && count($mod_group) > 4){
        ?>
          </ul>
          <ul class="nav nav-pills nav-justified">
        <?php
          }
        ?>
             <li <?=$this->uri->segment(2)==$value['M_Trigger']?"class='active'":"" ?>><a href="<?= base_url()?>app/<?=$value['M_Trigger']?>"><span class="glyphicon <?=$value['M_Icon']?>"></span> <?=$value['M_Description']?></a></li>
        <?php
          $ctr ++;
        ?>

        <?php }} ?>
              <!-- <li <?=$this->uri->segment(2)=='returns'?"class='active'":"" ?>><a href="<?= base_url()?>app/returns"><span class="glyphicon glyphicon-file"></span> Returns</a></li> -->


          </ul>
       <!--  <li <?=$this->uri->segment(2)=='administration'?"class='active'":"" ?>><a href="<?= base_url()?>app/administration"><span class="glyphicon glyphicon-cog"></span> Administration</a></li>
        <li <?=$this->uri->segment(2)=='purchasing'?"class='active'":"" ?>><a href="<?= base_url()?>app/purchasing"><span class="glyphicon glyphicon-shopping-cart"></span> Purchasing</a></li>
        <li <?=$this->uri->segment(2)=='financial-management'?"class='active'":"" ?>><a href="<?= base_url()?>app/financial-management"><span class="glyphicon glyphicon-usd"></span> Financial Management</a></li>
        <li <?=$this->uri->segment(2)=='sales-operation'?"class='active'":"" ?>><a href="<?= base_url()?>app/sales-operation"><span class="glyphicon glyphicon-tasks"></span> Store Operation</a></li>
       -->
      <!-- <ul class="nav nav-pills nav-justified">
        <li <?=$this->uri->segment(2)=='warehouse-management'?"class='active'":"" ?>><a href="<?= base_url()?>app/warehouse-management"><span class="glyphicon glyphicon-home"></span> Warehouse Management & Logistics</a></li>
        <li <?=$this->uri->segment(2)=='human-resource-recruitment'?"class='active'":"" ?>><a href="<?= base_url()?>app/human-resource-recruitment"><span class="glyphicon glyphicon-user"></span> Human Resource & Recruitment</a></li>
        <li <?=$this->uri->segment(2)=='reports'?"class='active'":"" ?>><a href="<?= base_url()?>app/reports"><span class="glyphicon glyphicon-file"></span> Reports</a></li>



      </ul> -->
    </div><!-- /.container-fluid -->
  </nav>
</div>

<ul class="breadcrumb collapse navbar-collapse">

  <li><a href="<?= base_url()?>app">&nbsp<span class="glyphicon glyphicon-home"></span>&nbsp</a></li>

</ul>
<script type="text/javascript">
     function getNotifs(){

      if(typeof(EventSource) !== "undefined") {
          var source = new EventSource(base_url + "app/document-tracking/getNotifs");

          source.onmessage = function(event) {
           updateNotifs(JSON.parse(event.data));
           source.close();
           setTimeout(function(){
           getNotifs();
           },10000);
          };
      } else {
         console.log("not supported");
      }

    }

    function updateNotifs(data){

      $('.notif-D-down').html('<img  id="loader" src="'+base_url+'css/assets/data_loader.gif" />');

      html = '';

      if(data){
        $('.notif-icon').css('color','#ff1a1a');
        $.each(data,function(index){
          console.log(data[index]);
          html += "<li><a href='"+data[index].DT_TargetURL+"' class='notifs'>Pending approval for Document No. "+data[index].DT_DocNo+"</a></li>"
        });
      }else{
        html += "<li><a href='javascript:void(0)' class='notifs'>No pending!</li>"
      }

      $('.notif-D-down').html(html);

    }

    $(document).ready(function(){
      getNotifs();
    });
</script>







