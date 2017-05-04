<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include '../config.php';
$student_id = $_POST["student_id"];
$student_sex = $_POST["student_sex"];
$Student_NameTHF = $_POST["Student_NameTHF"];
$Student_NameTHL = $_POST["Student_NameTHL"];
$Student_NameENGF = $_POST["Student_NameENGF"];
$Student_NameENGL = $_POST["Student_NameENGL"];
$Faculty_ID = $_POST["Faculty_ID"];
$Major_ID = $_POST["Major_ID"];
$Class_ID = $_POST["Class_ID"];
$Student_Address = $_POST["Student_Address"];
$Student_Telephone = $_POST["Student_Telephone"];
$student_birthday = $_POST["student_birthday"];
$Semes_Start = $_POST["Semes_Start"];
$status=$_POST['status'];
$pic = $_POST['pic'];
$pic1 = $_POST['pic1'];
if ($_FILES['pic']['name']!= '') {
$path='../picture_upload/student/';
$file=$_FILES['pic']['name'];
$file_type= strrchr( $file , '.' );
$pic_name='pic_'.$student_id.strtoupper($file_type);
copy ($_FILES['pic']['tmp_name'],$path.$pic_name);
$pic=$pic_name;
}else{$pic = $pic1;}

$sql = "UPDATE student SET Student_NameTH='$Student_NameTHF $Student_NameTHL'
,Student_NameENG='$Student_NameENGF $Student_NameENGL'
,Class_ID='$Class_ID',Faculty_ID='$Faculty_ID',Major_ID='$Major_ID',Student_Address='$Student_Address'
,Student_Telephone='$Student_Telephone',student_birthday = '$student_birthday',Semes_Start='$Semes_Start',student_sex='$student_sex',student_titlename='$student_sex'
,status='$status',pic='$pic'
 WHERE Student_ID ='$student_id'";
$query = $connect->query($sql) or die("ผิดพลาด");
  echo("<script> alert('แก้ไขข้อมูลเรียบร้อยแล้ว'); window.location='student.php';</script>");
?>


</body>
</html>