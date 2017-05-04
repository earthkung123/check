<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

<?php
include "../config.php";

echo $sql = "DELETE FROM teacher WHERE Teacher_ID ='".$_POST["Teacher_ID"]."'";
$query = $connect->query($sql) or die ($sql);
echo("<script> alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location='teacher-view.php';</script>");
?>

</body>
</html>