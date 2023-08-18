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

  
</head>

</html>
