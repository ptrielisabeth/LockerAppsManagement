<?php
  include("../../theme/config.php");
session_start();
error_reporting(0);

$f8datefrom = $_POST['f2datefrom'];
$f8dateto = $_POST['f2dateto'];



$sql1= "SELECT insp_id, insp_nm, count(insp_nm) as jml FROM [SERE].[dbo].[v_insp_result] where insp_date
BETWEEN '$f8datefrom' AND '$f8dateto' GROUP by insp_nm, insp_id order by insp_id";


$qry_bay5 = sqlsrv_query($conn, $sql1);

    while ($data_chart = sqlsrv_fetch_array($qry_bay5)) {
      $chartline1[] = array("y" => $data_chart['jml'], "label" => $data_chart['insp_nm']);
  }
echo json_encode($chartline1);

// echo $sql1;
?>