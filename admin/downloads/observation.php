<?php
include("../../../theme/config.php");
session_start();
$date = date('d/m/Y');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=Observation Locker($date).csv");
header("Pragma: no-cache");
header("Expires: 0");

if(isset($_GET['userplant']) && $_SESSION['userplant']=='All'){
    $msd_plant = $_GET['userplant'];
} else {
    $msd_plant = $_SESSION['userplant'];
}
if($msd_plant=='All'){
    $query = "SELECT plant,locker_id,description,floor,location,img,status FROM tbl_observation";
} else {
    $query = "SELECT plant,locker_id,description,floor,location,img,status FROM tbl_observation";
}


$data= array();
if ($result = sqlsrv_query($conn, $query) or die(print_r(sqlsrv_errors()))) {
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }
}
$headers = ["Plant", "Locker ID", "Observation Description", "Floor", "Location", "Image", "Status"];

$output = fopen("php://output", "w");
fputcsv($output, $headers);
foreach ($data as $val) {
    fputcsv($output, $val);
}
fclose($output);
?>