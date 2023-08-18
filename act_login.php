<?php
error_reporting(0);
session_set_cookie_params(3600*3600*24*5, "/");
session_start();
include ("config.php");
$error_login = "";
if (isset($_SESSION['login']) != "") {
	$halaman = $_SESSION['login'];
	header('location:' . $halaman);
	exit();
}
$login_count = $_COOKIE["login_count"];
if (isset($_POST['btn-login'])) {
	$username = ($_POST['username']);
	$upass = ($_POST['password']);
	$res = sqlsrv_query($conn, "SELECT * FROM tb_user_locker WHERE username='$username'") or die( print_r( sqlsrv_errors(), true));
	$row = sqlsrv_fetch_array($res);
	if ($row['password'] == md5($upass)) {

		$_SESSION['login'] = $row['user_level'];
		$_SESSION['userlevel'] = $row['user_level'];
		$_SESSION['iduser'] = $row['id_user'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['plant'] = $row['plant'];
		$_SESSION['userplant'] = $row['plant'];

		header('location:admin');
	} else {
		header('location:index.php?error=1');
		setcookie("login_count", $login_count+1, time()+600);
	}
}
?>