<?php
    session_start();
    // error_reporting(0);
    include("../../theme/config.php");

    $sesa_id = $_SESSION['userid'];
    $file_name=$_FILES['upl_file']['name'];
    $head_id = $_POST['head_id'];
    $id = $_POST['id'];
    $direktori = "./Pictures/";
    $time = time();
    $newfileName = $head_id.$id."_after_".$time.$file_name;

    if(isset($_FILES['upl_file']['name'])){
        if(move_uploaded_file($_FILES['upl_file']['tmp_name'],$direktori.$newfileName)){
            $sql = "UPDATE [dbo].[tbl_insp_detail] SET [pict_after]='$newfileName', [record_date_update] = getdate(), user_id = '$sesa_id' WHERE [insp_id]='$id' AND [insp_head_id]='$head_id'";
            $prosess = sqlsrv_query($conn, $sql);
            if ($prosess) {
                echo "success";
            } else {
                echo "failed";
            }
        } 
    }