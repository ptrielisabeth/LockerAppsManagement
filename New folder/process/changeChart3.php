<?php
  include("../../theme/config.php");
session_start();
error_reporting(0);

$f3datefrom = $_POST['f3datefrom'];
$f3dateto = $_POST['f3dateto'];


$qrybay = "SELECT DATENAME(month,insp_date) AS month, COUNT(*) AS count FROM tbl_insp_header  WHERE
insp_date BETWEEN '$f3datefrom' AND '$f3dateto' GROUP BY DATENAME(month,insp_date)";

$qry_bay7= sqlsrv_query($conn, $qrybay);

      while ($data_chart7 = sqlsrv_fetch_array($qry_bay7)) {
        $column3[] = array("y" => $data_chart7['count'], "label" => $data_chart7['month']);
  }
echo json_encode($column3);

// echo $qrybay;
?>