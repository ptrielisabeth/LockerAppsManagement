<?php
  include("../../theme/config.php");
session_start();
error_reporting(0);

$f2datefrom = $_POST['f1datefrom'];
$f2dateto = $_POST['f1dateto'];


// $sql= "SELECT insp_date, location, count(location) as jml FROM tbl_insp_header WHERE location is not null AND
// insp_date BETWEEN '$f2datefrom' AND '$f2dateto' GROUP by location, insp_date order by location";

$sql= "SELECT location, count(location) as jml FROM [SERE].[dbo].[tbl_insp_header] WHERE insp_date BETWEEN '$f2datefrom' AND '$f2dateto' 
GROUP by location order by location";





$qry_bay = sqlsrv_query($conn, $sql);

      while ($data_chart5 = sqlsrv_fetch_array($qry_bay)) {
        $chartline[] = array("y" => $data_chart5['jml'], "label" => $data_chart5['location']);
  }
echo json_encode($chartline);

// echo $sql;
?>