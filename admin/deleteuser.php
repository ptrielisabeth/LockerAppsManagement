<?php

include("../../theme/config.php");
session_start();

date_default_timezone_set('Asia/Jakarta');
$date = date('Y/m/d H:i:s');
$user = $_SESSION['iduser'];

if (isset($_GET['name'])) {
    $name = $_GET['name'];

    $action = "Deleting User " . $name . "";
    // echo "INSERT INTO tb_log (id_user,dates,actions) VALUES ('$user','$date','$action')";
    sqlsrv_query($conn, "INSERT INTO tb_log (id_user,dates,actions) VALUES ('$user','$date','$action')") or die(print_r(sqlsrv_errors()));

    sqlsrv_query($conn, "DELETE FROM tb_user_locker WHERE name='$name'") or die(print_r(sqlsrv_errors()));

    header("location: mst_users.php?pesan=hapus");
}
