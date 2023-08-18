<?php
    include("../../../theme/config.php");
    // include('configuration.php');

    $sql = " SELECT DISTINCT plant, floor , location FROM [SERE].[dbo].[tbl_insp_header] where plant ='BLP'";
    $sqlres = sqlsrv_query($conn, $sql);
?>
        <table>
            <tr>
                <th>Label</th>
                <th>Qr Code</th>
            </tr>
<?php
    while ($res = sqlsrv_fetch_array($sqlres)) {


        $data = $res['plant'].';'.$res['floor'].';'.$res['location']; 
        $item = $data.'.png';
?>
    <tr>
        <td><?= $data; ?></td>
        <td><img src="./Qr/<?= $item ?>" width="60"/></td>
    </tr>
<?php
    }


?>
        </table>