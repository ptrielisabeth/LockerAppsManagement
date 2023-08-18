<?php
include("../../config.php");
session_start();
$date = date('d/m/Y');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=Rpt_fire(printed: $date).csv");
header("Pragma: no-cache");
header("Expires: 0");

if(isset($_GET['plant']) && $_SESSION['plant']=='All'){
    $user_plant = $_GET['plant'];
} else {
    $user_plant = $_SESSION['plant'];
}

if($user_plant=='All'){
    $query = "SELECT nomor_apar,brand,tipe,berat,plant,lokasi,convert(varchar,expired,103),stats FROM tbl_apar";
} else {
    $query = "SELECT nomor_apar,brand,tipe,berat,plant,lokasi,convert(varchar,expired,103),stats FROM tbl_apar WHERE plant '$user_plant'";
}

$data = array();
if ($result = sqlsrv_query($conn, $query) or die(print_r(sqlsrv_errors()))) {
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }
}
$headers = ["Code No.", "Brand", "Medium", "Size", "Plant", "Location", "Expired Date", "Status"];

$output = fopen("php://output", "w");
fputcsv($output, $headers);
foreach ($data as $val) {
    fputcsv($output, $val);
}
fclose($output);
?>