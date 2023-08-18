<?php
	error_reporting(0);
	$serverName = "10.155.152.114";
	$connectionInfo = array( "Database"=>"SG_Picking", "UID"=>"dt", "PWD"=>"Dt@123","ReturnDatesAsStrings"=> true);
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
	// if ( $conn )  
	// {  
	// 	echo "Statement executed.<br>\n";  
	// 	list($sesa_id) = sqlsrv_fetch_array(sqlsrv_query($conn, "SELECT sesa_id FROM mst_users"));
	// 	echo $sesa_id;
	// }   
	// else   
	// {  
	// 	echo "Error in statement execution.\n";  
	// 	die( print_r( sqlsrv_errors(), true));  
	// } 
?>