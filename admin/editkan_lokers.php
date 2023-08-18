<?php

include("../../theme/config.php");

        $locker_id = $_POST['locker_id'];
        $nama = $_POST['name'];
        $no_phone = $_POST['no_phone'];
        $gender = $_POST['gender'];
        $talent_id = $_POST['talent_id'];
        
        $q = "update [dbo].[tbl_locker_data]
        set
                talent_id = '" .$talent_id. "'
              ,name =  '" .$nama. "'
              ,gender =  '" .$gender. "'
              ,no_phone =  '" .$no_phone. "'
        where locker_id = " .$locker_id. "";
        echo $q;
        sqlsrv_query($conn, $q);
        header("location: map_lockers.php");