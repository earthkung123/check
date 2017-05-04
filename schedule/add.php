<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
include '../config.php';
$group_id	= $_POST['group_id'];
$Teacher_ID = $_POST['Teacher_ID'];
$Subject_ID = $_POST['Subject_ID'];
$date = $_POST['date'];
$time_start = $_POST['time_start'];
$time_end = $_POST['time_end'];

$sql = "SELECT * FROM teacher_of_subject where subject_id = '$Subject_ID' AND group_id = '$group_id'";
$Query = mysqli_query($connect,$sql) or die($sql);
$arr = mysqli_num_rows($Query);
if($arr>0){
echo("<script> alert('วิชานี้มีกลุ่มนี้อยู่แล้ว กรุณาเลือกกลุ่มอื่น'); window.location='schedule-add.php?Subject_ID=$Subject_ID&Teacher_ID=$Teacher_ID&group_id=$group_id';</script>");

}else
{
$sql1 = "INSERT INTO `teacher_of_subject`(`group_id`, `subject_id`, `teacher_id`) VALUES ('$group_id','$Subject_ID','$Teacher_ID')";
$query1 = $connect->query($sql1) or die($sql1);
$sql2 = "INSERT INTO `time_of_subject`(`group_id`, `subject_id`, `subject_start`, `subject_end`) VALUES ('$group_id','$Subject_ID','$time_start','$time_end')";
$query2 = $connect->query($sql2) or die($sql2);
echo("<script> alert('เพิ่มตารางสอนเรียบร้อยแล้ว'); window.location='schedule.php';</script>");
}


?>




</body>
</html>