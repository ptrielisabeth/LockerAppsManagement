<?php
include("../../theme/config.php");
include("partial/header.php");
session_start();

date_default_timezone_set('Asia/Jakarta');
$date = date('Y/m/d H:i:s');
$user = $_SESSION['iduser'];

if (isset($_POST['upload'])) {

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
    }

    $file = $_FILES['image']['name'];

    $action = "Adding Committe Chart For " . $title . "";

    sqlsrv_query($conn, "INSERT INTO tb_log (id_user,dates,actions) VALUES ('$user','$date','$action')") or die(print_r(sqlsrv_errors()));

    sqlsrv_query($conn, "INSERT INTO tbl_managechart (title, img, stats) VALUES('$title','$file','$status')") or die(print_r(sqlsrv_errors()));
   
    header("location: managechart.php?status=Insert Succesfully");
}
