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
$Faculty_ID1 = $_POST["Faculty_ID1"];
$Major_ID1 = $_POST["Major_ID1"];
$Faculty_ID = $_POST["Faculty_ID"];
$Major_ID = $_POST["Major_ID"];
$teacher_birthday = $_POST["teacher_birthday"];
$pic = $_POST['pic'];
$pic1 = $_POST['pic1'];
if ($_FILES['pic']['name']!= '') {
$path='../picture_upload/teacher/';
$file=$_FILES['pic']['name'];
$file_type= strrchr( $file , '.' );
$pic_name='pic_'.$Teacher_id.strtoupper($file_type);
copy ($_FILES['pic']['tmp_name'],$path.$pic_name);
$pic=$pic_name;
}else{$pic = $pic1;}

if($Faculty_ID != $Faculty_ID1 || $Major_ID != $Major_ID1)
{
	$sql = "UPDATE Teacher SET Teacher_NameTH='$Teacher_NameTHF $Teacher_NameTHL',Teacher_Titlename='$Teacher_Titlename'
,Teacher_NameENG='$Teacher_NameENGF $Teacher_NameENGL'
,Faculty_ID='$Faculty_ID',Major_ID='$Major_ID',Teacher_sex='$Teacher_sex',teacher_birthday='$teacher_birthday',pic='$pic'
 WHERE Teacher_ID ='$Teacher_id'";
$query = $connect->query($sql) or die("ผิดพลาด");
$sql1 = "UPDATE adviser SET class_id1 = '' , class_id2 = '' , class_id3 = ''
WHERE Teacher_ID ='$Teacher_id'";
$query1 = $connect->query($sql1) or die("ผิดพลาด");
}else{
$sql = "UPDATE Teacher SET Teacher_NameTH='$Teacher_NameTHF $Teacher_NameTHL',Teacher_Titlename='$Teacher_Titlename'
,Teacher_NameENG='$Teacher_NameENGF $Teacher_NameENGL'
,Faculty_ID='$Faculty_ID',Major_ID='$Major_ID',Teacher_sex='$Teacher_sex',teacher_birthday='$teacher_birthday',pic='$pic'
 WHERE Teacher_ID ='$Teacher_id'";
$query = $connect->query($sql) or die("ผิดพลาด");
}
?>

<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
alert("แก้ไขข้อมูลเรียบร้อยแล้ว")
// End 
location.href = "Teacher-view.php";
</script>

</body>
</html>