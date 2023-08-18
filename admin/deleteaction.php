<?php
session_start();
// error_reporting(0);

include("../../theme/config.php");

$id=$_POST['id'];

if (isset($_POST['id'])) {
$data=sqlsrv_query($conn, "DELETE  tbl_insp_header WHERE insp_head_id='$id'") or die(print_r(sqlsrv_errors()));
if ($data){
    echo "ok";
}
else {
    echo "not ok";
}
}