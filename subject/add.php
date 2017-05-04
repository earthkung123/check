<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
include '../config.php';
$Subject_id = $_POST["Subject_id"];
$Subject_NameTH = $_POST["Subject_NameTH"];
$Subject_NameENG = $_POST["Subject_NameENG"];
$Credit = $_POST["Credit"];

$sql = "INSERT INTO `Subject`(`Subject_ID`,`Subject_NameTH`, `Subject_NameENG`,`Subject_Credit`)
VALUES ('$Subject_id','$Subject_NameTH','$Subject_NameENG','$Credit') ";
$query = $connect->query($sql) or die("ข้อมูลซ้ำ");
echo("<script> alert('เพิ่มข้อมูลเรียบร้อยแล้ว'); window.location='subject.php';</script>");

?>



</body>
</html>