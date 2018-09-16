<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo GSASSETS_DBOARD;?>images/favicon.png" type="image/png">

  <title><?php echo $title; ?></title>

  <link href="<?php echo GSASSETS_DBOARD;?>css/dboard_loader.css" rel="stylesheet">
  
  <script type="text/javascript" charset="utf-8">
    var base_url    = '<?php echo base_url(); ?>';
    var index_page  = '<?php echo index_page(); ?>/';
    var site        = '<?php echo site_url(); ?>';
  </script>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

</head>

<body>
<!-- Preloader -->
<div id="preloader">
  <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>
<!-- Preloader -->

<section>

  <div class="leftpanel">

    <div class="logopanel">
        <h1><span>[</span> <?php echo $app_name;?> <span>]</span></h1>
    <!-- <h5>Project Management Information System</h5> -->
    </div><!-- logopanel -->

    <div class="leftpanelinner">

        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">
            <div class="media userlogged">
                <img alt="" src="<?php echo GSASSETS_DBOARD;?>images/photos/loggeduser.png" class="media-object">
                <div class="media-body">
                    <h4><?php echo $this->session->userdata('realNameAkses');?></h4>
                    <span>"Life is so..."</span>
                </div>
            </div>

            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li><a href="<?php echo site_url('user_manage/profile'); ?>"><i class="fa fa-user"></i> <span>Profile</span></a></li>
              <li><a href="<?php echo site_url('user_manage/uppasswd'); ?>"><i class="fa fa-unlock"></i> <span>Update Password</span></a></li>
              <li><a href="<?php echo site_url('auth/logout'); ?>"><i class="fa fa-sign-out"></i> <span>Log Out</span></a></li>
            </ul>
        </div>

      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li class="<?php echo $clDbd;?>"><a href="<?php echo site_url('main'); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="nav-parent <?php echo $clUsr?>"><a href="#"><i class="glyphicon glyphicon-user"></i> <span>Users Management</span></a>
          <ul class="children" style="<?php echo $styUsr?>">
            <li class="<?php echo $clGroup?>"><a href="<?php echo site_url('group_manage'); ?>"><i class="fa fa-caret-right"></i> Group Users</a></li>
            <li class="<?php echo $clUsr?>"><a href="<?php echo site_url('user_manage'); ?>"><i class="fa fa-caret-right"></i> Users</a></li>
          </ul>
        </li>
        <li class="nav-parent <?php echo $clRef?>"><a href="#"><i class="fa fa-folder-open"></i> <span>Referency Management</span></a>
          <ul class="children" style="<?php echo $styRef?>">
            <li class="<?php echo $clRef?>"><a href="<?php echo site_url('company_manage'); ?>"><i class="fa fa-caret-right"></i> Company</a></li>
          </ul>
        </li>
        <li class="<?php echo $clPm;?>"><a href="<?php echo site_url('project_manage'); ?>"><i class="fa fa-gears"></i> <span>Project Management</span></a></li>
      </ul>

      <div class="infosummary">
        <h5 class="sidebartitle sidebarhr">
        </h5>
      </div><!-- infosummary -->

    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->

  <div class="mainpanel">

    <div class="headerbar">

      <a class="menutoggle"><i class="fa fa-bars"></i></a>

      <form class="searchform" action="<?php echo site_url('main/search/'); ?>" method="post">
        <input type="text" class="form-control" name="keyword" placeholder="Input Project Name/Code/Company here..." />
      </form>


      <div class="header-right">
        <ul class="headermenu">
          <li>
            <div class="btn-group">
              <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i>
                <!-- <span class="badge">2</span> -->
              </button>
              <div class="dropdown-menu dropdown-menu-head pull-right">
                <h5 class="title"><?php echo $countUser->num_rows();?> Registered Users</h5>
                <ul class="dropdown-list user-list">
                  <?php 
                    foreach($countUser->result() as $queryUser){
                  ?>
                  <li class="new">
                    <div class="thumb"><a href="#"><img src="<?php echo GSASSETS_DBOARD;?>images/photos/user1.png" alt="" /></a></div>
                    <div class="desc">
                      <h5>
                        <a href="#"><?php echo $queryUser->RealName;?></a>
                      </h5>
                    </div>
                  </li>
                  <?php }?>
                  <li class="new"><a href="<?php echo site_url('user_manage'); ?>">See All Users</a></li>
                </ul>
              </div>
            </div>
          </li>
          <!-- SEPARATOR -->
          <li>
            <div class="btn-group" style="display:none;">
              <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                <i class="glyphicon glyphicon-globe"></i>
                <span class="badge">5</span>
              </button>
              <div class="dropdown-menu dropdown-menu-head pull-right">
                <h5 class="title">You Have 5 New Notifications</h5>
                <ul class="dropdown-list gen-list">
                  <li class="new">
                    <a href="#">
                    <span class="descnotif">
                      <span class="name">
                        Lorem ipsum Laboris ullamco labore ullamco.
                      </span>
                      <span class="msg">Lorem ipsum Laboris ullamco labore ullamco.</span>
                    </span>
                    </a>
                  </li>
                  <li class="new">
                    <a href="#">
                    <span class="descnotif">
                      <span class="name">
                        Lorem ipsum Laboris ullamco labore ullamco.
                      </span>
                      <span class="msg">Lorem ipsum Laboris ullamco labore ullamco.</span>
                    </span>
                    </a>
                  </li>
                  <li class="new">
                    <a href="#">
                    <span class="descnotif">
                      <span class="name">
                        Lorem ipsum Laboris ullamco labore ullamco.
                      </span>
                      <span class="msg">Lorem ipsum Laboris ullamco labore ullamco.</span>
                    </span>
                    </a>
                  </li>
                  <li class="new">
                    <a href="#">
                    <span class="descnotif">
                      <span class="name">
                        Lorem ipsum Laboris ullamco labore ullamco.
                      </span>
                      <span class="msg">Lorem ipsum Laboris ullamco labore ullamco.</span>
                    </span>
                    </a>
                  </li>
                  <li class="new">
                    <a href="#">
                    <span class="descnotif">
                      <span class="name">
                        Lorem ipsum Laboris ullamco labore ullamco.
                      </span>
                      <span class="msg">Lorem ipsum Laboris ullamco labore ullamco.</span>
                    </span>
                    </a>
                  </li>
                  <li class="new"><a href="#">See All Notifications</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo GSASSETS_DBOARD;?>images/photos/loggeduser.png" alt="" />
                <?php echo $this->session->userdata('realNameAkses');?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li><a href="<?php echo site_url('user_manage/profile'); ?>"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                <li><a href="<?php echo site_url('user_manage/uppasswd'); ?>"><i class="fa fa-unlock"></i> Update Password</a></li>
                <li><a href="<?php echo site_url('auth/logout'); ?>"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>
          <li style="display:none;">
            <button id="chatview" class="btn btn-default tp-icon chat-icon">
                <i class="glyphicon glyphicon-comment"></i>
            </button>
          </li>
        </ul>
      </div><!-- header-right -->

    </div><!-- headerbar -->

    <div class="pageheader">
      <h2><i class="fa fa-home"></i> <?php echo $mainmenu; ?> <span><?php echo $subttl; ?></span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('main/home'); ?>"><?php echo $app_name; ?></a></li>
          <li class="active"><?php echo $subttl; ?></li>
        </ol>
      </div>
    </div>
    
    <script src="<?php echo GSASSETS_DBOARD;?>js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/jquery-ui-1.10.3.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/bootstrap.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/modernizr.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/jquery.sparkline.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/toggles.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/retina.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/jquery.cookies.js"></script>

    <script src="<?php echo GSASSETS_DBOARD;?>js/flot/jquery.flot.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/flot/jquery.flot.resize.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/flot/jquery.flot.spline.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/flot/jquery.flot.symbol.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/flot/jquery.flot.crosshair.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/flot/jquery.flot.categories.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/flot/jquery.flot.pie.min.js"></script>

    <!--
    <script src="<?php //echo GSASSETS_DBOARD;?>js/morris.min.js"></script>
    -->

    <script src="<?php echo GSASSETS_DBOARD;?>js/jquery.datatables.min.js"></script>
    <script src="<?php echo GSASSETS_DBOARD;?>js/select2.min.js"></script>

    <script src="<?php echo GSASSETS_DBOARD;?>js/custom.js"></script>
    
    <script src="<?php echo GSASSETS_DBOARD;?>js/Chart.js/Chart.js"></script>
    <!--
    -->

    <?php echo $this->load->view($content, $get); ?>
  
  </div><!-- mainpanel -->

</section>

<!-- 
<script src="<?php //echo GSASSETS_DBOARD;?>js/chart_line_home.js"></script>
-->
</body>

</html>