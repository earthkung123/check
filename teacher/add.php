<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include '../config.php';
$Teacher_id = $_POST["Teacher_id"];
$Teacher_sex = $_POST["Teacher_sex"];
$Teacher_Titlename = $_POST["Teacher_Titlename"];
$Teacher_NameTHF = $_POST["Teacher_NameTHF"];
$Teacher_NameTHL = $_POST["Teacher_NameTHL"];
$Teacher_NameENGF = $_POST["Teacher_NameENGF"];
$Teacher_NameENGL = $_POST["Teacher_NameENGL"];
$Faculty_ID = $_POST["Faculty_ID"];
$Major_ID = $_POST["Major_ID"];
$teacher_birthday = $_POST["teacher_birthday"];
if ($_FILES['pic']['name']!= '') {
$path='../picture_upload/teacher/';
$file=$_FILES['pic']['name'];
$file_type= strrchr( $file , '.' );
$pic_name='pic_'.$Teacher_id.strtoupper($file_type);
copy ($_FILES['pic']['tmp_name'],$path.$pic_name);
$pic=$pic_name;
}else{$pic = '';}

$expbirthday = explode("-",$teacher_birthday);
// 0 ปี 1เดือน 2วัน
$year = $expbirthday[0]+543;
$Password = $expbirthday[2].$expbirthday[1].$year;



$sqlq = "SELECT  * FROM `numrun` WHERE `name`='teacher_userid' ";

$query = $connect->query($sqlq);

while($rs=$query->fetch_assoc()){
	$update = $rs['num']+1;
	$id = "tech".str_pad($update,6,"0",STR_PAD_LEFT);
}

$sql = "SELECT * FROM teacher where Teacher_ID = '$Teacher_id'";
$Query = mysqli_query($connect,$sql) or die($sql);
$arr = mysqli_num_rows($Query);
if($arr>0){
echo("<script> alert('ข้อมูลซ้ำ'); window.location='teacher-add.php';</script>");
}
else{

$sql = "INSERT INTO `Teacher`(`Teacher_ID`,`Teacher_sex`,`Teacher_titlename`, `Teacher_NameTH`, `Teacher_NameENG`, `teacher_birthday`, `Faculty_ID`, `Major_ID`, `pic`) 
	VALUES ('$Teacher_id','$Teacher_sex','$Teacher_Titlename','$Teacher_NameTHF $Teacher_NameTHL','$Teacher_NameENGF $Teacher_NameENGL','$teacher_birthday','$Faculty_ID','$Major_ID','$pic') ";
	$query = $connect->query($sql) or die("ข้อมูลซ้ำ");

  $sql1 = "INSERT INTO `user`(`user_id`, `username`, `password`) VALUES ('$id','$Teacher_id','$Password')";  
  $query = $connect->query($sql1) or die("ERROR");
  
  $sql2 = "UPDATE `numrun` SET `num`='$update' WHERE `name`='teacher_userid'";
  $query = $connect->query($sql2) or die ("ERROR1");

  $sql3 = "INSERT INTO adviser (Teacher_ID) VALUES ('$Teacher_id')";
	$query = $connect->query($sql3) or die("ERROR2");

  echo("<script> alert('เพิ่มข้อมูลเรียบร้อยแล้ว'); window.location='teacher.php';</script>");
  }
	
?>
<!-- Begin
<SCRIPT LANGUAGE="JavaScript">

alert("เพิ่มข้อมูลเรียบร้อยแล้ว")
//
location.href = "Teacher.php"; End -->
</script>




</body>
</html>