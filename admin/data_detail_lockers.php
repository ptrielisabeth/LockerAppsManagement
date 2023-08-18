<?php
session_start();
error_reporting(0);
include("../../theme/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Locker</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .center-screen {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;
}
  </style>
</head>
<body>
  <div class="center-screen">
  <div class="card bg-light mb-3 " style="width: 500px;">
  <div class="card-header"><span style="font-weight: bold;">Detail Locker</span></div>
  <div class="card-body">
    <p class="card-text">
    <?php
      $a = "select * from [SERE].[dbo].[tbl_locker_data] where locker_id = '".$_GET['id_loker']."'";
      $actionsum = sqlsrv_query($conn, $a);
      $no=1;
      while ($r = sqlsrv_fetch_array($actionsum)) { 
    ?>
    <div class="">Locker ID =<?= $r['locker_id'] ?></div> 
    <div class="">Name = <?= $r['name'] ?></div>
    <div class="">Talent ID = <?= $r['talent_id'] ?></div>
    <div class="">Department = <?= $r['dept'] ?></div>
    <?php
      }
    ?>
    </p>
  </div>
</div>
</div>
</body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>