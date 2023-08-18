<?php
include("../../theme/config.php");

error_reporting(0);
session_start();

$id = $_POST['insp_head_id'];
$id_x = $_POST['ib'];

?>

<?php
$b = "SELECT  a.insp_list_eng,a.insp_list_idn,b.* FROM mst_inspection a,tbl_insp_detail b WHERE a.insp_id=b.insp_id AND b.insp_head_id = '$id_x' AND a.insp_id='$id'";
$result = sqlsrv_query($conn, $b);
?>
<div class="row">
    <div class="col-md-12">
        <center>
            <?php $data = sqlsrv_fetch_array($result); ?>
            <img src="./Pictures/<?= $data['pict_after'] ?>" height="450px" />
        </center>
    </div>
</div>