<?php
//error_reporting(0);
include 'config.php';
$forget_count = $_COOKIE["forget_count"];
if (isset($_POST['btn-pass'])) {
	$username = ($_POST['username']);
	$upass1 =  md5($_POST['password1']);
	$upass2 =  md5($_POST['password2']);
	$ans = ($_POST['answer']);
	$res = sqlsrv_query($conn, "SELECT * FROM tb_user_locker WHERE username='$username'") or die( print_r( sqlsrv_errors(), true));
	$row = sqlsrv_fetch_array($res);
	if ($upass1 == $upass2 && strtolower($ans) == strtolower($row['ans'])) {
		sqlsrv_query($conn, "UPDATE tb_user_locker SET password='" . $upass1 . "' WHERE username='" . $username . "'");
		header('location:forget-password.php?success=1');
	} else {
		header('location:forget-password.php?error=1');
		setcookie("forget_count", $forget_count+1, time()+3600);
	}
}
?>