<?php
include '../config.php';
session_start();

date_default_timezone_set('Asia/Jakarta');
$date = date('Y/m/d H:i:s');
$user = $_SESSION['user_id'];

if (isset($_POST['date_sticker'])) {
    $no_aid = $_POST['plant'];
    $tipe = $_POST['badge_id'];
    $plant = $_POST['sesa_id'];
    $floor = $_POST['name'];
    $area = $_POST['plat_no'];
    $status = "Not Inspected";

    if (isset($_FILES['image'])) {
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        // $file_type = $_FILES['image']['type'];
        // $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "images/" . $file_name);
        } else {
            print_r($errors);
        }
    }
    $file = $_FILES['image']['name'];

    $action = "Adding New FAB Data Code No. " . $no_aid . "";

    sqlsrv_query($conn, "INSERT INTO tb_log (id_user,dates,actions) VALUES ('$user','$date','$action')") or die(print_r(sqlsrv_errors()));

    sqlsrv_query($conn, "INSERT INTO tbl_aid (no_aid,tipe,plant,lantai,area,stats,img) VALUES ('" . $no_aid . "','" . $tipe . "','" . $plant . "','" . $floor . "','" . $area . "','" . $status . "','" . $file . "')") or die(print_r(sqlsrv_errors()));

    header("location:aid.php?pesan=insert data successfully");
}
