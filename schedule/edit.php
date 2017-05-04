<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
session_start();
include '../config.php';
$group_id	= $_GET['group_id'];
$Teacher_ID = $_GET['Teacher_ID'];
$Subject_ID = $_GET['Subject_ID'];



$sql = "SELECT * FROM teacher_of_subject where subject_id = '$Subject_ID' AND group_id = '$group_id'";
$Query = mysqli_query($connect,$sql) or die($sql);
$arr = mysqli_num_rows($Query);
$sql1 = "UPDATE `teacher_of_subject` SET group_id='$group_id',subject_id='$Subject_ID',teacher_id='$Teacher_ID' WHERE group_id='".$_SESSION["group_id"]."' AND subject_id='".$_SESSION["Subject_ID"]."' AND teacher_id='".$_SESSION["Teacher_ID"]."' ";
$_SESSION["Subject_ID"] = "";
$_SESSION["Teacher_ID"] = "";
$_SESSION["group_id"] = "";
$query1 = $connect->query($sql1) or die($sql1);
echo("<script> alert('แก้ไขตารางสอนเรียบร้อยแล้ว'); window.location='schedule.php';</script>");


?>




</body>
</html>