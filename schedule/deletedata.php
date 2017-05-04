<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body>

<?php
include "../config.php";
$group_id	= $_GET['group_id'];
$Teacher_ID = $_GET['Teacher_ID'];
$Subject_ID = $_GET['Subject_ID'];

$sql = "DELETE FROM teacher_of_subject WHERE Teacher_ID ='$Teacher_ID' AND group_id='$group_id' AND Subject_ID='$Subject_ID' ";
$query = $connect->query($sql) or die ($sql);
$sql = "DELETE FROM student_of_subject WHERE group_id='$group_id' AND Subject_ID='$Subject_ID' ";
$query = $connect->query($sql) or die ($sql);

echo("<script> alert('ลบข้อมูเรียบร้อยแล้ว'); window.location='schedule.php;</script>");
?>


</body>
</html>