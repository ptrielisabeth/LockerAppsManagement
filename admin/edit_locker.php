<?php

include("../../theme/config.php");

if(isset($_POST['locker_id1']))
{
    $locker_id = $_POST['locker_id1'];
    $name = $_POST['name1'];
    $talent_id = $_POST['talent_id1'];
    $gender = $_POST['gender1'];
    $plant = $_POST['plant1'];
    $area = $_POST['area1'];
    $floor = $_POST['floor1'];
    $dept = $_POST['dept1'];
    $no_phone = $_POST['no_phone1'];
    $img = $_POST['img1'];

    if (isset($_FILES['img'])) {
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        // $file_type = $_FILES['image']['type'];
        // $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "imgprofile/" . $file_name);
        } else {
            print_r($errors);
        }
    }
    $file = $_FILES['image']['name'];

    $query ="UPDATE tbl_locker_data SET name='" .$name. "', talent_id='" .$talent_id. "', gender='" .$gender. "', plant='" .$plant. "', area='" .$area. "', floor='" .$floor. "', dept='" .$dept. "', no_phone='" .$no_phone. "', img='" .$img. "' where locker_id='" .$locker_id. "'";
    $query_run = sqlsrv_query($conn, $query);
}