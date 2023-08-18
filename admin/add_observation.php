<!-- Info Halaman -->
<?php
// include 'session-config.php'; // memanggil session config
include("../../theme/config.php");

if (isset($_POST['submit'])) {
    $date = $_POST['date_observation'];
	$description = $_POST['description'];
    $locker_id = $_POST['locker_id'];
	$plant = $_POST['plant_observation'];
    $floor = $_POST['floor_observation'];
    $location = $_POST['location_observation'];
    $img = $_POST['img'];
	$status = $_POST['status_observation'];

    if (isset($_FILES['img'])) {
        $errors = array();
        $file_name = $_FILES['img']['name'];
        $file_tmp = $_FILES['img']['tmp_name'];
        // $file_type = $_FILES['image']['type'];
        // $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "imgobservation/" . $file_name);
        } else {
            print_r($errors);
        }
    }
    $file = $_FILES['img']['name'];


    sqlsrv_query($conn, "INSERT INTO tbl_observation (date,description,locker_id,plant,floor,location,img,status) VALUES ('" . $date . "','" . $description . "','" . $locker_id . "','" . $plant . "','" . $floor . "','" . $location . "','" . $file . "','" . $status . "')") or die(print_r(sqlsrv_errors()));

	header("location:observation.php?pesan=insert data successfully");
	
}
?>