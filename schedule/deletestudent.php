<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body>

<?php
include "../config.php";
$student_id	= $_POST['Student_ID'];
$group_id = $_GET['group_id'];
$Subject_ID = $_GET['Subject_ID'];

$sql = "DELETE FROM `student_of_subject` WHERE subject_id = '$Subject_ID' AND group_id = '$group_id' AND student_id = '$student_id'";
$query = $connect->query($sql) or die ("ไม่ติดนะ");
echo("<script> alert('ลบนกัศึกษาออกจากตารางเรียนเรียบร้อยแล้ว'); window.location='schedule-student.php?group_id=$group_id&Subject_ID=$Subject_ID';</script>");
?>

</body>
</html>