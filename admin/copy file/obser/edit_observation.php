<?php

include("../../theme/config.php");

if(isset($_POST['obserID1']))
{
    $description = $_POST['description1'];
    $plant = $_POST['plant1'];
    $floor = $_POST['floor1'];
    $location = $_POST['location1'];
    $status = $_POST['status1'];
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

    $query ="UPDATE tbl_observation SET status='" .$status. "' where obserID ='" .$obserID. "'";
    $query_run = sqlsrv_query($conn, $query);
}