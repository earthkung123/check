<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include '../config.php';
$student_id	= $_POST['Select_ID'];
$group_id = $_GET['group_id'];
$Subject_ID = $_GET['Subject_ID'];

$sql2 = "SELECT * FROM student_of_subject where subject_id = '$Subject_ID' AND group_id = '$group_id'";
$Query = mysqli_query($connect,$sql2) or die($sql2);

$sql = "SELECT * FROM student_of_subject where subject_id = '$Subject_ID' AND group_id = '$group_id' AND student_id = '$student_id'";
$Query = mysqli_query($connect,$sql) or die($sql);
$arr = mysqli_num_rows($Query);
if($arr>0){
echo("<script> alert('มีนักศึกษาคนนี้ในตารางเรียนนี้แล้ว'); window.location='schedule-student-addone.php?group_id=$group_id&Subject_ID=$Subject_ID';</script>");

}else
{
$sql1 = "INSERT INTO `student_of_subject`(`group_id`, `subject_id`, `student_id`) VALUES ('$group_id','$Subject_ID','$student_id')";
$query1 = $connect->query($sql1) or die($sql1);
echo("<script> alert('เพิ่มนักศึกษาเรียบร้อยแล้ว'); window.location='schedule-student.php?group_id=$group_id&Subject_ID=$Subject_ID';</script>");
}

?>




</body>
</html>