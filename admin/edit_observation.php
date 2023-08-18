<?php

include("../../theme/config.php");

if(isset($_POST['status_observation']))
{
        $locker_id = $_POST['locker_id'];
        $status_observation = $_POST['status_observation'];
    
        $query ="UPDATE tbl_observation SET status='" .$status_observation. "' where locker_id='" .$locker_id. "'";
        sqlsrv_query($conn, $query);
        header("location: observation_keeper.php");
}
