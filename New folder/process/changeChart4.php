<?php
  include("../../theme/config.php");
session_start();
// error_reporting(0);

$f3datefrom = $_POST['f3datefrom'];
$f3dateto = $_POST['f3dateto'];



$qry_bay1 ="SELECT status, count(status) as jml FROM [SERE].[dbo].[tbl_insp_header] WHERE insp_date 
BETWEEN '$f3datefrom' AND '$f3dateto' GROUP BY status";

$qry_bay2= sqlsrv_query($conn, $qry_bay1);

$pie = array();

        while ($data_chart6 = sqlsrv_fetch_array($qry_bay2)) {
          $pie[] = array("y" => $data_chart6['jml'], "label" => $data_chart6['status']);
  }
echo json_encode($pie);

// echo $qry_bay1;
?>