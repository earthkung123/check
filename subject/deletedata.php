<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Data</title>

<link rel="stylesheet" href="css/buttons.css">
<link href="stylesheet.css"  rel="stylesheet">
<script type="text/javascript" src="js/buttons.js"></script>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

</head>

<body>

<?php
include "../config.php";

$sql = "DELETE FROM subject WHERE Subject_id ='".$_POST["Subject_ID"]."'";
$query = $connect->query($sql) or die ("ไม่ติดนะ");

?>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
alert("ลบข้อมูเรียบร้อยแล้ว")
// End -->
location.href = "subject-view.php";
</script>

</body>
</html>