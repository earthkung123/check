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
if ($_FILES['pic']['name']!= '') {
$path='../picture_upload/student/';
$file=$_FILES['pic']['name'];
$file_type= strrchr( $file , '.' );
$pic_name='pic_'.$student_id.strtoupper($file_type);
copy ($_FILES['pic']['tmp_name'],$path.$pic_name);
$pic=$pic_name;
}else{$pic = '';}

$expbirthday = explode("-",$student_birthday);
// 0 ปี 1เดือน 2วัน
$year = $expbirthday[0]+543;
$Password = $expbirthday[2].$expbirthday[1].$year;


$sqlq = "SELECT  * FROM `numrun` WHERE `name`='student_userid' ";

$query = $connect->query($sqlq);

while($rs=$query->fetch_assoc()){
	$update = $rs['num']+1;
	$id = "st".str_pad($update,6,"0",STR_PAD_LEFT);
}

$sql = "SELECT * FROM student where student_id = '$student_id'";
$Query = mysqli_query($connect,$sql) or die($sql);
$arr = mysqli_num_rows($Query);
if($arr>0)
{echo("<script> alert('รหัสนักศึกษาซ้ำ'); window.location='student.php';</script>");

}else{$sql = "INSERT INTO `student`(`Student_ID`,`student_sex`,`student_titlename`, `Student_NameTH`, `Student_NameENG`, `Class_ID`, `Faculty_ID`, `Major_ID`, `Student_Address`, `Student_Telephone`, `student_birthday`, `Semes_Start`, `status`, `pic`) 
	VALUES ('$student_id','$student_sex','$student_sex','$Student_NameTHF $Student_NameTHL','$Student_NameENGF $Student_NameENGL','$Class_ID','$Faculty_ID','$Major_ID','$Student_Address','$Student_Telephone','$student_birthday','$Semes_Start','$status','$pic') ";
echo $Class_ID;
	$query = $connect->query($sql) or die("<script> alert('รหัสนักศึกษาซ้ำ'); window.location='student-add.php';</script>");

  $sql1 = "INSERT INTO `user`(`user_id`, `username`, `password`) VALUES ('$id','$student_id','$Password')";  
  $query = $connect->query($sql1) or die("ERROR");
  
  $sql2 = "UPDATE `numrun` SET `num`='$update' WHERE `name`='student_userid'";
  $query = $connect->query($sql2) or die ("ERROR1");

echo("<script> alert('เพิ่มนักศึกษาเรียบร้อยแล้ว'); window.location='student.php';</script>");
}
//}
?>





</body>
</html>