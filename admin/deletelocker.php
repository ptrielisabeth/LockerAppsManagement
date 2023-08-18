<?php
include("../../theme/config.php");
session_start();

date_default_timezone_set('Asia/Jakarta');
$date = date('Y/m/d H:i:s');
$user = $_SESSION['iduser'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $log = sqlsrv_query($conn, "SELECT * FROM tbl_locker");
    $data = sqlsrv_fetch_array($log);

    $no = $data['locker_id'];

    if ($id == 'all') {

        $action = "Deleting All Locker ";

        sqlsrv_query($conn, "INSERT INTO tb_log (id_user,dates,actions) VALUES ('$user','$date','$action')") or die(print_r(sqlsrv_errors()));

        sqlsrv_query($conn, "DELETE FROM tbl_locker_data") or die(mysql_error());
    } else {

        $action = "Deleting Locker No." . $no . "";

        sqlsrv_query($conn, "INSERT INTO tb_log (id_user,dates,actions) VALUES ('$user','$date','$action')") or die(print_r(sqlsrv_errors()));

        sqlsrv_query($conn, "DELETE FROM tbl_locker_data WHERE locker_id='$id'") or die(mysql_error());
        
    }
    if ($_SESSION['login'] == 'dtadmin' ) {
        header("location:data_lockers.php?pesan=hapus");
    } else {
        header("location:data_lockers.php?pesan=hapus");
    }
}
