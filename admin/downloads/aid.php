<?php
include("../../config.php");
session_start();
$date = date('d/m/Y');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=Rpt_aid(printed_$date).csv");
header("Pragma: no-cache");
header("Expires: 0");

if(isset($_GET['plant']) && $_SESSION['plant']=='All'){
    $user_plant = $_GET['plant'];
} else {
    $user_plant = $_SESSION['plant'];
}
if($user_plant=='All'){
    $query = "SELECT no_aid,tipe,plant,lantai,area,stats FROM tbl_aid";
} else {
    $query = "SELECT no_aid,tipe,plant,lantai,area,stats FROM tbl_aid WHERE plant='$user_plant'";
}


$data = array();
if ($result = sqlsrv_query($conn, $query) or die(print_r(sqlsrv_errors()))) {
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }
}
$headers = ["Code no.", "Type", "Plant","Floor","Location","Status"];

$output = fopen("php://output", "w");
fputcsv($output, $headers);
foreach ($data as $val) {
    fputcsv($output, $val);
}
fclose($output);
?>