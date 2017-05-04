<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include '../config.php';
$Subject_id = $_POST["Subject_id"];
$Subject_NameTH = $_POST["Subject_NameTH"];
$Subject_NameENG = $_POST["Subject_NameENG"];
$Subject_Credit = $_POST["Subject_Credit"];
echo $Subject_Credit;


$sql = "UPDATE Subject SET Subject_NameTH='$Subject_NameTH ',Subject_NameENG='$Subject_NameENG',Subject_Credit='$Subject_Credit' WHERE Subject_ID ='$Subject_id'";
$query = $connect->query($sql) or die("ผิดพลาด");
?>


<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
alert("แก้ไขข้อมูลเรียบร้อยแล้ว")
// End  -->
location.href = "Subject-view.php";
</script>

</body>
</html>