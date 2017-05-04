<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
include '../config.php';
$Teacher_id = $_POST["Teacher_id"];
$Class_ID1 = $_POST["Class_ID1"];
$Class_ID2 = $_POST["Class_ID2"];
$Class_ID3 = $_POST["Class_ID3"];



$sql = "UPDATE adviser SET class_id1='$Class_ID1',class_id2='$Class_ID2',class_id3='$Class_ID3'
 WHERE Teacher_ID ='$Teacher_id'";
$query = $connect->query($sql) or die("ผิดพลาด");
?>

<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
alert("แก้ไขข้อมูลเรียบร้อยแล้ว")
// End  -->
location.href = "teacher-adviser.php";
</script>

</body>
</html>