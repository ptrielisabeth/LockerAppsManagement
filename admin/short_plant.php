
<?php
    include("../../theme/config.php");
    session_start();
    // error_reporting(0);

    $f8datefrom = $_POST['f2datefrom'];
    $f8dateto = $_POST['f2dateto'];
    $plant= $_POST['plant'];
    
$sql1= "SELECT insp_id, insp_nm, count(insp_nm) as jml FROM [SERE].[dbo].[v_insp_result] where plant='$plant' and insp_date
BETWEEN '$f8datefrom' AND '$f8dateto' GROUP by insp_nm, insp_id order by insp_id";

// echo $sql1;

$sql= "SELECT location, count(location) as jml FROM [SERE].[dbo].[tbl_insp_header] WHERE plant='$plant' and insp_date BETWEEN '$f8datefrom' AND '$f8dateto' 
GROUP by location order by location";

$qrybay = "SELECT DATENAME(month,insp_date) AS month, COUNT(*) AS count FROM tbl_insp_header  WHERE plant='$plant' and
insp_date BETWEEN '$f8datefrom' AND '$f8dateto' GROUP BY DATENAME(month,insp_date)";

$qry_bay1 ="SELECT status, count(status) as jml FROM [SERE].[dbo].[tbl_insp_header] WHERE  plant='$plant' and insp_date 
BETWEEN '$f8datefrom' AND '$f8dateto' GROUP BY status";
//  echo $qry_bay1;

$qry_bay5 = sqlsrv_query($conn, $sql1);
if (sqlsrv_has_rows($qry_bay5)){
    while ($data_chart = sqlsrv_fetch_array($qry_bay5)) {
        $chartline1[] = array("y" => $data_chart['jml'], "label" => $data_chart['insp_nm']);
    }
} else{
    $chartline1[] = array("y" => 0, "label" => "data not found");
}
    

$qry_bay = sqlsrv_query($conn, $sql);
if (sqlsrv_has_rows($qry_bay)){
    while ($data_chart5 = sqlsrv_fetch_array($qry_bay)) {
        $chartline[] = array("y" => $data_chart5['jml'], "label" => $data_chart5['location']);
    }
} else{
    $chartline[] = array("y" => 0, "label" => "data");
}


    
$qry_bay7= sqlsrv_query($conn, $qrybay);
if (sqlsrv_has_rows($qry_bay7)){
    while ($data_chart7 = sqlsrv_fetch_array($qry_bay7)) {
    $column3[] = array("y" => $data_chart7['count'], "label" => $data_chart7['month']);
    }
} else{
    $column3[] = array("y" => 0, "label" => "data");
}



$qry_bay2= sqlsrv_query($conn, $qry_bay1);
if (sqlsrv_has_rows($qry_bay2)){
    while ($data_chart6 = sqlsrv_fetch_array($qry_bay2)) {
    $pie[] = array("y" => $data_chart6['jml'], "label" => $data_chart6['status']);
    }
} else{
    $pie[] = array("y" => 0, "label" => "data");
}

    $data1 = array("satu" => $chartline1);
    $data2 = array("dua" => $chartline);
    $data3 = array("tiga" => $column3);
    $data4 = array("empat" => $pie);

    $data = array_merge($data1, $data2, $data3, $data4);

    echo json_encode($data);
// echo json_encode($chartline1);



