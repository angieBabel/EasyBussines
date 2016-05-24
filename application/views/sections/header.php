<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="<?php echo base_url();?>">
    <title>EasyBusiness</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="css/skins/_all-skins.css">
    <script src="js/interactions.js"></script>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
     <script>
    webshims.setOptions('forms-ext', {types: 'date'});
webshims.polyfill('forms forms-ext');
</script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php/welcome/panel" class="logo">
          <span class="logo-lg"><img src="image/logotipo3.png"width="45" height="45"><b> Easy Business</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" id="menUsuario">
            <!-- <span class="sr-only">Toggle navigation</span> -->
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-search fa-lg"></i>
                </a>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                        <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                          <!-- inner menu: contains the actual data -->
                          <ul class="menu">
                            <li><!-- start message -->
                              <a href="#">
                                <div class="pull-left">
                                  <img src="img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                                </div>
                                <h4>
                                  Support Team
                                  <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                </h4>
                                <p>Why not buy a new awesome theme?</p>
                              </a>
                            </li><!-- end message -->
                            <li>
                              <a href="#">
                                <div class="pull-left">
                                  <img src="img/user4-128x128.jpg" class="img-circle" alt="user image"/>
                                </div>
                                <h4>
                                  Reviewers
                                  <small><i class="fa fa-clock-o"></i> 2 days</small>
                                </h4>
                                <p>Why not buy a new awesome theme?</p>
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                      </ul>

              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <?php   if ($this->session->userdata('correo') != null):?>
                   <a href="index.php/welcome/cierraSesion">
                    <?php echo $this->session->userdata('nombre'); ?>
                      <span class="fa fa-sign-out fa-lg"aria-hidden='true'></span>
                    </a>
                <?php
                endif ?>
              </li>
            </ul>
          </div>
          <div
            class="fb-like"
            data-share="true"
            data-width="450"
            data-show-faces="true">
          </div>
        </nav>
      </header>
