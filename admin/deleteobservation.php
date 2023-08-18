<?php
include("../../theme/config.php");
session_start();

date_default_timezone_set('Asia/Jakarta');
$date = date('Y/m/d H:i:s');
$user = $_SESSION['iduser'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $log = sqlsrv_query($conn, "SELECT * FROM tbl_observation");
    $data = sqlsrv_fetch_array($log);

    $no = $data['obserID'];

    if ($id == 'all') {

        $action = "Deleting All Observation ";

        sqlsrv_query($conn, "INSERT INTO tb_log (id_user,dates,actions) VALUES ('$user','$date','$action')") or die(print_r(sqlsrv_errors()));

        sqlsrv_query($conn, "DELETE FROM tbl_observation") or die(mysql_error());
    } else {

        $action = "Deleting Locker No." . $no . "";

        sqlsrv_query($conn, "INSERT INTO tb_log (id_user,dates,actions) VALUES ('$user','$date','$action')") or die(print_r(sqlsrv_errors()));

        sqlsrv_query($conn, "DELETE FROM tbl_observation WHERE obserID='$id'") or die(mysql_error());
        
    }
    if ($_SESSION['login'] == 'dtadmin' ) {
        header("location:observation.php?pesan=hapus");
    } else {
        header("location:observation.php?pesan=hapus");
    }
}


