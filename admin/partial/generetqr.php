<?php
    include("../../../theme/config.php");
    include('./phpqrcode/qrlib.php'); 
    // include('configuration.php');

    $sql = "SELECT DISTINCT plant, floor, location FROM [SERE].[dbo].[tbl_insp_header] where plant ='BLP'";
    $sqlres = sqlsrv_query($conn, $sql);
    while ($res = sqlsrv_fetch_array($sqlres)) {
        $data = $res['plant'].';'.$res['floor'].';'.$res['location'];
        $item = $data.'.png';
        if(!file_exists($item)){
            QRcode::png($data, 'Qr/'.$data.'.png');
        }
    }

?>