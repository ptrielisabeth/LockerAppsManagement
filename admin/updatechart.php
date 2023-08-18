<?php
session_set_cookie_params(3600*3600*24*5, "/");
session_start();
error_reporting(0);
include("../../theme/config.php");
include("partial/header.php");

date_default_timezone_set('Asia/Jakarta');
$date = date('Y/m/d H:i:s');
$user = $_SESSION['iduser'];

$id = $_GET['id'];
$title = $_POST['title_img'];
$status = "Y";

if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    // $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $file_name);
    } else {
        print_r($errors);
    }


$file = $_FILES['image']['name'];

$action = "Editing Committe Chart For " . $title . "";

sqlsrv_query($conn, "INSERT INTO tb_log (id_user,dates,actions) VALUES ('$user','$date','$action')") or die(print_r(sqlsrv_errors()));

if ($file == "") {
    $update = sqlsrv_query($conn, "UPDATE tbl_managechart SET title = '$title', stats = '$status' WHERE id = '$id'") or die(print_r(sqlsrv_errors()));
    echo "<script language='javascript'>alert('Edit project successfully'); window.location.href='managechart.php';</script>";
} else {
    $update = sqlsrv_query($conn, "UPDATE tbl_managechart SET title = '$title', img = '$file', stats = '$status' WHERE id = '$id'") or die(print_r(sqlsrv_errors()));
    echo "<script language='javascript'>alert('Edit project successfully'); window.location.href='managechart.php';</script>";

}
// $result = sqlsrv_query($update);

header("location: managechart.php?status=Insert Succesfully"); 

}