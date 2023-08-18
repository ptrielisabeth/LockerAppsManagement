<?php
include("../../theme/config.php");

session_start();
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
$date = date('Y/m/d H:i:s');
// $user = $_SESSION['iduser'];

$id = $_POST['id'];

// $old = md5($_POST['old_pass']);
$new = md5($_POST['new_pass']);
$confirm = md5($_POST['confirm_pass']);

// $username = ($_SESSION['name']);

$res = sqlsrv_query($conn, "SELECT * FROM tb_user_locker WHERE id_user = '".$id."'");
$row = sqlsrv_fetch_array($res);


// if ($row['password'] == $old) {
    if ($new == $confirm) {

    
        sqlsrv_query($conn, "UPDATE tb_user_locker set password='" . $new . "' WHERE id_user = '".$id."' ") or die(print_r(sqlsrv_errors()));
        echo 'success';
    } else {
        echo 'confirm pass';
    }
    // echo $new;
    // echo $confirm;

