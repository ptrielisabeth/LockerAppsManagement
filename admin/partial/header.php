<?php $pg = basename(substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'.'))); ?>
<?php
// error_reporting(0);

if(!isset($_SESSION['userid']) && !isset($_SESSION['username']) && !isset($_SESSION['userlevel']))
{
  header("Location: ../index.php");
}



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SERE Portal | Schneider-Electric</title>
  <link rel="icon" href="../../theme/images/icon/fav_icon.ico">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <link rel="stylesheet" href="../../theme/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../theme/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../theme/bootstrap-datepicker/css/bootstrap-datepicker3.css">
  <link rel="stylesheet" href="../../theme/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
  <link rel="stylesheet" href="../../theme/jquery-ui/jquery-ui.css">
  <link rel="stylesheet" href="../../theme/select2/css/select2.css">
  <link rel="stylesheet" href="../../theme/select2/css/select2.min.css">

  <!-- <link rel="stylesheet" href="jabil/plugins/md-bootstrap/css/mdb.css"> -->
  <link rel="stylesheet" href="../../theme/selecpicker/bootstrap-select.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../theme/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../theme/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!--<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">--> <!--problem-->
  <link rel="stylesheet" href="../../theme/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../theme/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../theme/lte/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../theme/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../theme/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../../theme/lte/skins/skin-sch.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../theme/summernote/summernote-bs4.css">
    <!-- Sweet Alert 2 -->
  <link rel="stylesheet" href="../../theme/sweetalert/sweetalert2.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="../../theme/slick/slick/slick.css">
  <link rel="stylesheet" href="../../theme/slick/slick/slick-theme.css">
  <link href="../../theme/jquery/jquery-radiocharm.css" rel="stylesheet">
  <link rel="../stylesheet" href="font-awesome.min.css">

  <style>
    p, h5, .nav-icon {
      color: #fff;
    }
    h5 {
      font-weight: bold;
    }
    
    .active {
      background-color: #fff;
      color: #25CC51;
    }

    #tree {
      font-weight: normal;
    }

    .right {
      float: right;
    }
    #paragraf2 { font-family: Georgia, serif; }
    .gambar{
      padding-left: 20px;
      margin-left: 20px;
    }
    .blink {
  animation: blinker 1s step-start infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
    
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
<div class="wrapper">

  <!-- Navbar -->
  <!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top" style="background-color: #25CC51; "> -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top bg-success">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="nav-icon fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block" style="width: 500%; padding-top: 2%; padding-left: 50%; text-align: center">
        <h5 >KANBAN CALCULATION TOOL</h5>
      </li> -->
    </ul>
    <div style="width: 500%; padding-top: 0%;">
    <h3 style="text-align: center;"><strong>Locker Management</strong></h3>  
    </div> 
    <div style="width: 70%; padding-top: 0%;">
      <img src="../../theme/images/se-lio-logo-white.png" alt="image" widht="70" height="40"/>
    </div> 

 
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- <aside class="main-sidebar sidebar-light-success elevation-4" style="background-color: #25CC51;"> -->
  <aside class="main-sidebar sidebar-light-success elevation-4 bg-success">
    <!-- Brand Logo -->
    
    <!--<a href="../jvn/index.php" class="brand-link">-->
    <a  class="brand-link">
      <img src="../../theme/images/logos.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
      <span class="brand-text font-weight-light"><img src="../../theme/images/se-lio-logo-white.png" width="70%"></span>
    </a>

    <div class="sidebar" >
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../theme/images/header.png" class="img-circle elevation-2 bg-white" alt="User Image">
        </div>
        <div class="info">
        <h4><strong><a href="#" class="d-block" style="color:white"><?php echo $_SESSION['username']; ?></a></strong></h4>
        <span style="color:white">Name : <?=$_SESSION['name'];?></span><br>
		      <span style="color:white">Role  : <?=$_SESSION['userlevel'];?></span><br>
          <span style="color:white">Plant : <?=$_SESSION['userplant'];?></span><br>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <?php if ($_SESSION['userlevel'] == 'admin' || $_SESSION['userlevel'] == 'Keeper'|| $_SESSION['userlevel'] == 'PIC'|| $_SESSION['userlevel'] == 'User') { ?>
            <li class="nav-item">
              <a href="index.php" class="nav-link <?php if($pg =='index'){echo 'active';}?>">
                <i class="fas fa-chart-bar nav-icon"></i>
                <p>Dashboard</p>
              </a>
            </li>
          <?php } ?>

          <?php if ($_SESSION['userlevel'] == 'admin') { ?>
          <li class="nav-item">
            <a href="chart_admin.php" class="nav-link <?php if($pg =='chart_admin'){echo 'active';}?>">
              <i class="fas fa-user nav-icon"></i>
              <p>Committee Structure</p>
            </a>
            </li>
          </li>
          <?php } ?>
          
          <?php if ($_SESSION['userlevel'] == 'User' || $_SESSION['userlevel'] == 'PIC'|| $_SESSION['userlevel'] == 'Keeper') { ?>
          <li class="nav-item">
            <a href="chart.php" class="nav-link <?php if($pg =='chart'){echo 'active';}?>">
              <i class="fas fa-user nav-icon"></i>
              <p>Committee Structure</p>
            </a>
            </li>
          </li>
          <?php } ?>

          <?php if ($_SESSION['userlevel'] == 'admin' || $_SESSION['userlevel'] == 'User') { ?>
            <li class="nav-item">
              <a href="map_lockers.php" class="nav-link <?php if($pg =='map_lockers'){echo 'active';}?>">
              <i class="fas fa-th nav-icon"></i>
                <p>Locker's Map</p>
              </a>
            </li>
          <?php } ?>

          <?php if ($_SESSION['userlevel'] == 'PIC'|| $_SESSION['userlevel'] == 'Keeper') { ?>
            <li class="nav-item">
              <a href="map_lockers2.php" class="nav-link <?php if($pg =='map_lockers'){echo 'active';}?>">
              <i class="fas fa-th nav-icon"></i>
                <p>Locker's Map</p>
              </a>
            </li>
          <?php } ?>

          <?php if ($_SESSION['userlevel'] == 'admin') { ?>
            <li class="nav-item">
              <a href="data_lockers.php" class="nav-link <?php if($pg =='data_lockers'){echo 'active';}?>">
              <i class="nav-icon fas fa-calendar-check"></i>
                <p>Master Locker</p>
              </a>
            </li>
          <?php } ?>
          
          <?php if ($_SESSION['userlevel'] == 'admin' || $_SESSION['userlevel'] == 'Keeper'|| $_SESSION['userlevel'] == 'PIC') { ?>
            <li class="nav-item">
                  <a href="scan_qr.php" class="nav-link <?php if($pg =='scan_qr'){echo 'active';}?>">
                    <i class="nav-icon fa fa-id-card"></i>
                    <p>Search ID</p>
                  </a>
            </li>
          <?php } ?>

          <?php if ($_SESSION['userlevel'] == 'admin' || $_SESSION['userlevel'] == 'PIC') { ?>
          <li class="nav-item">
            <a href="observation.php" class="nav-link <?php if($pg =='observation'){echo 'active';}?>">
              <i class="fas fa-search nav-icon"></i>
              <p>Observation Locker</p>
            </a>
          </li>
          <?php } ?>

          <?php if ( $_SESSION['userlevel'] == 'Keeper') { ?>
          <li class="nav-item">
            <a href="observation_keeper.php" class="nav-link <?php if($pg =='observation_keeper'){echo 'active';}?>">
              <i class="fas fa-search nav-icon"></i>
              <p>Observation Locker</p>
            </a>
          </li>
          <?php } ?>
          
         
          <li class="nav-item has-treeview <?php if($pg =='mst_users' || $pg == 'mst_registration' || $pg == 'userlogin' || $pg == 'profile' ){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if($pg =='mst_users' || $pg == 'mst_registration' || $pg == 'userlogin' || $pg == 'profile'){echo 'active';}?>">
              <i class="nav-icon fas fa-restroom"></i>
              <p>
                User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview" style="margin-left: 10px;">
              <?php if ($_SESSION['userlevel'] == 'admin') { ?>
                <li class="nav-item">
                  <a href="mst_users.php" class="nav-link <?php if($pg =='mst_users'){echo 'active';}?>">
                    <i class="nav-icon fas fa-users"></i>
                    <p>User Management</p>
                  </a>
                </li>
              <?php } ?>
                <li class="nav-item">
                  <a href="user-control.php" class="nav-link <?php if($pg =='user-control'){echo 'active';}?>">
                    <i class="fas fa-key nav-icon"></i>
                    <p>Setting Account</p>
                  </a>
                </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="../logout.php?logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>

        </ul>
      </nav>
  
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <script>
    function RedirectDashboard() {
      //window.location.replace("dash_plan.php");
      window.location.replace("dash_scplanning.php");
    }
  </script>
</body>
</html>
