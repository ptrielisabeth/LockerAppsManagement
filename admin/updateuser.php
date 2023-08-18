<?php

include("../../theme/config.php");
session_start();

date_default_timezone_set('Asia/Jakarta');
$date = date('Y/m/d H:i:s');
// $user = $_SESSION['iduser'];

$id = $_POST['id'];

$name = $_POST['name'];
$ask = $_POST['ask'];
$ans = $_POST['ans'];
$old = md5($_POST['old_pass']);
$new1 = md5($_POST['new_pass1']);
$new2 = md5($_POST['new_pass2']);
$s1 = 0;
$s2 = 0;
$s3 = 0;
$username = ($_SESSION['name']);

$res = sqlsrv_query($conn, "SELECT * FROM tb_user_locker WHERE id_user = $id");
$row = sqlsrv_fetch_array($res);


if ($row['name'] !== $name || $name !== ""){
    sqlsrv_query($conn, "UPDATE tb_user_locker set name='" . $name . "' WHERE id_user = $id ") or die(print_r(sqlsrv_errors()));
    $s1=1;
}
if ($ask !== "" && $ans !== "" || $ans !== $row['ans']){
    if (!isset($_POST['ask']) || $ask ==""){
        $ask = $row['ask'];
    }
    sqlsrv_query($conn, "UPDATE tb_user_locker set ask='" . $ask . "', ans='" . $ans . "' WHERE id_user = $id ") or die(print_r(sqlsrv_errors()));
    $s2=1;
}
if ($old !== "" || $new1 !== "" || $new2 !== ""){
    if ($row['password'] == $old) {
        if ($new1 == $new2) {
            sqlsrv_query($conn, "UPDATE tb_user_locker set password='" . $new1 . "' WHERE id_user = $id ") or die(print_r(sqlsrv_errors()));
            $s3=1;
        } else {
            echo 'New Password not match';
        }
    } else {
        echo 'Wrong password';
    }
}
header("location:user-control.php?updated_name=$s1&updated_q=$s2&updated_pass=$s3");
?>