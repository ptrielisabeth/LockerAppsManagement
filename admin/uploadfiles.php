<?php
    session_start();
    error_reporting(0);
    include("../../theme/config.php");

    $sesa_id = $_SESSION['userid'];
    $file_name=$_FILES['upl_file']['name'];
    $head_id = $_POST['head_id'];
    $id = $_POST['id'];
    $direktori = "./Pictures/";
    $newfileName = $head_id.$id."_before_".$file_name;

    if(isset($_FILES['upl_file']['name'])){
        $qryx = "SELECT TOP 1 [list_upload] FROM [SERE].[dbo].[tbl_insp_detail] WHERE [insp_id]='$id' AND [insp_head_id]='$head_id'";
        $exe_qry = sqlsrv_query($conn, $qryx);
        $old_file = sqlsrv_fetch_array($exe_qry);
        $get_old_file = $old_file['list_upload'];
        $path = 'Pictures/'.$get_old_file;
        if (file_exists($path)){
            unlink($path);
        }
        // echo 'Pictures/'.$get_old_file;
        
        if(move_uploaded_file($_FILES['upl_file']['tmp_name'],$direktori.$newfileName)){

            $sql = "UPDATE [dbo].[tbl_insp_detail] SET [list_upload]='$newfileName', [record_date_update] = getdate(), user_id = '$sesa_id' WHERE [insp_id]='$id' AND [insp_head_id]='$head_id'";
            $prosess = sqlsrv_query($conn, $sql);
    
            if ($prosess) {
                $sql = "UPDATE [dbo].[tbl_insp_header] SET [status]='open' WHERE [insp_head_id]='$head_id'";
                $prosess2 = sqlsrv_query($conn, $sql);
                if ($prosess2) {
                echo "success";
                }else{
                echo "failed";
                }
            } else {
                echo "failed";
            }
        }
    }