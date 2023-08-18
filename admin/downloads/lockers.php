<?php
include("../../../theme/config.php");
session_start();
$date = date('d/m/Y');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=Data Locker($date).csv");
header("Pragma: no-cache");
header("Expires: 0");

if(isset($_GET['userplant']) && $_SESSION['userplant']=='All'){
    $msd_plant = $_GET['userplant'];
} else {
    $msd_plant = $_SESSION['userplant'];
}
if($msd_plant=='All'){
    $query = "SELECT locker_id,name,talent_id,gender,plant,area,floor,dept,no_phone FROM tbl_locker_data";
} else {
    $query = "SELECT locker_id,name,talent_id,gender,plant,area,floor,dept,no_phone FROM tbl_locker_data";
}


$data= array();
if ($result = sqlsrv_query($conn, $query) or die(print_r(sqlsrv_errors()))) {
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }
}
$headers = ["Locker ID", "Name", "Talent ID", "Gender", "Plant", "Area", "Floor", "Department", "No.Phone"];

$output = fopen("php://output", "w");
fputcsv($output, $headers);
foreach ($data as $val) {
    fputcsv($output, $val);
}
fclose($output);
?>