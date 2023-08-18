<?php
	$serverName = "10.155.152.114";
	$connectionInfo = array( "Database"=>"wip_supermarket", "UID"=>"dt", "PWD"=>"Dt@123","ReturnDatesAsStrings"=> true);
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
	// if( $conn ) {
		// echo "Connection established.<br />";
	// }else{
		 // echo "Connection could not be established.<br />";
		 // die( print_r( sqlsrv_errors(), true));
	// }
?>