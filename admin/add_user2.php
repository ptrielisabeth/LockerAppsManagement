<?php
include("../../theme/config.php");
session_start();

date_default_timezone_set('Asia/Jakarta');
$date = date('Y/m/d H:i:s');

if (isset($_GET['btn-input'])) {
	$name = $_GET['name'];
	$username = $_GET['username'];
	$password = MD5($_GET['password']);
	$ask = $_GET['ask'];
	$ans = $_GET['ans'];
	$level = $_GET['user_level'];
	$plant = $_GET['user_plant'];

	$action = "Adding User " . $username . "";

	sqlsrv_query($conn, "INSERT INTO tb_log (id_user,dates,actions) VALUES ('$user','$date','$action')") or die(print_r(sqlsrv_errors()));

	if (sqlsrv_query($conn, "INSERT INTO tb_user_locker(name,username,password,user_level,ask,ans,plant) VALUES('$name','$username','$password','$level','$ask','$ans','$plant')")) {
		header("Location: ../act_register.php?success=1");
	} else {
		$errorsql = print_r(sqlsrv_errors());
		$error_input = "<div class='alert alert-danger alert-dismissable' 	 style='position: fixed; top: 50; left: 0; width: 100%; z-index:1001;'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Terjadi kesalahan saat menginputkan data. Silahkan coba lagi.('" . print_r(sqlsrv_errors()) . "')</strong>
		</div>";
		echo $errorsql;
		header("Location: ../act_register.php?error=1");
	}
}
