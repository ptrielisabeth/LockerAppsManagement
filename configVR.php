<?php
//sqlsrv_connect("localhost","root","");
//$conn = 
//sqlsrv_select_db("safetynew");

//$serverName = "wfsg10301"; //serverName\instanceName
$serverNameVR = "10.155.152.114"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
//$connectionInfo = array("Database" => "SERE", "UID" => "blpuser", "PWD" => "BLP123456#");
$connectionInfoVR = array("Database" => "VR", "UID" => "dt_user", "PWD" => "Password#1");
$connVR = sqlsrv_connect( $serverNameVR, $connectionInfoVR);

if( $connVR ) {
      //echo "Connection established.<br />";
}else{
      echo "Connection could not be established.<br />";
      die( print_r( sqlsrv_errors(), true));
 }
?>