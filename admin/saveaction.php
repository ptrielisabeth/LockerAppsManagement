<?php
    session_start();
    error_reporting(0);
    include("../../theme/config.php");


    $sesa_id = $_SESSION['userid'];
    $head_id = $_POST['head_id'];
    $id = $_POST['id'];
    $action = $_POST['action'];

            $sql = "UPDATE [dbo].[tbl_insp_detail] SET [action]='$action', [record_date_update] = getdate(), user_id = '$sesa_id' WHERE [insp_id]='$id' AND [insp_head_id]='$head_id'";
            $prosess = sqlsrv_query($conn, $sql);
    
            if ($prosess) {
                echo "success";
                header("Location: actionsum_detail.php?id=$head_id");
            } else {
                echo "failed";
            }
    