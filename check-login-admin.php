<? ob_start() ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

<style type="text/css">

<!--

-->

</style>

</head>



<?php
	session_start();
	
	include 'config.php';

	$sql = "SELECT * FROM admin WHERE admin_user = '".mysql_real_escape_string($_POST['username'])."' 

	and admin_pass = '".mysql_real_escape_string($_POST['pass'])."'";

	$query = $connect->query($sql);
	$objResult = $query->fetch_array();

	if(!$objResult)

	{
			echo("<script> alert('ชื่อผู้ใช้และรหัสผ่านไม่ถูกต้อง !!'); window.location='admin.php';</script>");
	}

	else

	{
		
			$_SESSION["admin_name"] = $objResult["admin_name"];
			$_SESSION["admin_id"] = $objResult["admin_id"];
			$_SESSION["date"]  = date("d/F/Y");

			session_write_close();

		    header("location:admin-backend.php");

	}

	mysql_close();

?>

<? ob_end_flush() ?>