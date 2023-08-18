<?php
session_start();

	if(!isset($_SESSION['login']))
	{
	 header("Location: index.php");
	}
	else if(isset($_SESSION['login'])!="")
	{
		 $halaman = $_SESSION['login'];
		 header('location:on-'. $halaman);
	}

	if(isset($_GET['logout']))
	{
	 session_destroy();
	 unset($_SESSION['login']);
	 header("Location: index.php?status=logout");
	}
?>