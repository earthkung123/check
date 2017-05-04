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

	$sql = "SELECT * FROM user WHERE username = '".mysql_real_escape_string($_POST['username'])."' 

	and password = '".mysql_real_escape_string($_POST['pass'])."'";

	$query = $connect->query($sql);
	$objResult = $query->fetch_array();

	if(!$objResult)

	{
			echo("<script> alert('ชื่อผู้ใช้และรหัสผ่านไม่ถูกต้อง !!'); window.location='index.php';</script>");
	}

	else

	{
		$checkuser = substr($objResult['user_id'],0,1);
		if($checkuser == "s")
		{
			//session_write_close();

		    echo "นักเรียน";
		}
		else if($checkuser == "t")
		{
			$_SESSION["username"]  = $objResult['username'];
			session_write_close();
			header("location:teacher-home.php");			
		}


	}

	mysql_close();

?>

<? ob_end_flush() ?>