<?php
include("../../theme/config.php");
session_start();

date_default_timezone_set('Asia/Jakarta');
$date = date('Y/m/d H:i:s');
$user = $_SESSION['iduser'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    sqlsrv_query($conn, "INSERT INTO tb_log (id_user,dates,actions) VALUES ('$user','$date','$action')") or die(print_r(sqlsrv_errors()));

    sqlsrv_query($conn, "DELETE FROM tbl_managechart WHERE id = '$id'") or die(print_r(sqlsrv_errors()));

    header("location:managechart.php?pesan=hapus");
}

?>
