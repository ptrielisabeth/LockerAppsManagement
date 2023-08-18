<?php
   session_start();
   // error_reporting(0);
   include("../../theme/config.php");

   $idno = $_POST['idno'];
   $id = $_POST['id'];
   // $insp_head_id = $_POST['insp_head_id'];
   // $insp_id = $_POST['insp_id'];
   $status=$_POST['status'];
   $plant=$_POST['plant'];
   $shift_floor = $_POST['shift_floor'];
   $shift= $_POST['shift'];
   $location= $_POST['location'];
   $shift_type = $_POST['shift_type'];
   $inspecting= $_POST['inspecting'];
   // $list_upload = $_POST['list_upload'];
   // $pict_after = $_POST['pict_after'];
   // $description = $_POST['description'];
   // $record_date = new DateTime();

   $sqlBf = sqlsrv_query($conn, "SELECT TOP 1 insp_head_id FROM tbl_insp_header WHERE plant='$plant' AND shift='$shift' AND floor='$shift_floor' AND typeofcheck='$shift_type'");
   $getId = sqlsrv_fetch_array($sqlBf);
   $catchId = $getId['insp_head_id'];
   // $sql = "UPDATE tbl_insp_detail set record_date_update=getdate() where insp_id='$id' AND [insp_head_id]='$idno'";
   //    $sql = "";
   //    if ($status != null || $status != "") { //untuk update status
         $sql = "UPDATE tbl_insp_detail set status='$status' where insp_id='$id' AND [insp_head_id]='$idno'";
   //    } else if ($pict_after != null || $pict_after != "") { //untuk update pic after
   //       $sql = "UPDATE tbl_insp_detail set pict_after='$pict_after' where insp_id='$id' AND [insp_head_id]='$idno'";
   //    } else { //submit remark
   //    }

      // $sql = "update tbl_insp_tmp set [status]='$status' where insp_id='$id' AND [id_no]=$idno";
      // echo $sql;
      $prosess = sqlsrv_query($conn, $sql);

      if($prosess){
         echo "Success";
      }
      else {
         echo "Failed";
      }
        // if ($prosess) {
        //     header('Location: form_inspect.php?msg=success');
        // } else {
        //     header('Location: form_inspect.php?msg=failed');
        // }