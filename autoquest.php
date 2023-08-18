<?php
include 'config.php';
error_reporting(0);
$user = $_POST['search'];
$list = sqlsrv_query($conn,"SELECT * FROM tb_user_locker WHERE username='$user'");
$getlist = sqlsrv_fetch_array($list);
$output = $getlist['ask'];
echo $output;
?>