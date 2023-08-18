<!-- Info Halaman -->
<?php
// include 'session-config.php'; // memanggil session config
include("../../theme/config.php");

if (isset($_POST['submit'])) {
	$locker_id = $_POST['locker_id'];
	$name = $_POST['name'];
    $talent_id = $_POST['talent_id'];
    $gender = $_POST['gender_locker'];
	$plant = $_POST['plant_locker'];
    $area = $_POST['area_locker'];
    $floor = $_POST['floor_locker'];
	$dept = $_POST['dept_locker'];
	$no_phone = $_POST['no_phone'];

	if (isset($_FILES['image'])) {
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

    sqlsrv_query($conn, "INSERT INTO tbl_locker (locker_id,name,talent_id,gender,plant,area,floor,dept,no_phone,img) VALUES ('" . $locker_id . "','" . $name . "','" . $talent_id . "','" . $gender . "','" . $plant . "','" . $area . "','" . $floor . "','" . $dept . "','" . $no_phone . "','" . $file . "')") or die(print_r(sqlsrv_errors()));

	header("location:data_lockers.php?pesan=insert data successfully");
	
}
?>