<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script type="text/javascript">//alert("sdfsd");</script>
<body>
<?php
session_start();
require_once("../config.php");

if($_POST["Major_ID"] == ""){?>
	<option value="" >กรุณาเลือกสาขา</option>
    <?php 
	}else {
	?>
    
    
    <?php

	$query ="SELECT * FROM class WHERE Major_ID = '" . $_POST["Major_ID"] . "'";
	$results = $connect->query($query);
?>
	<option value="">เลือกชั้นปี</option>
<?php
	while($rs=$results->fetch_assoc()) {
		$Class = explode(" ",$rs['Class_NameTH']);
?>
	<option value="<?php echo $rs["Class_ID"]; ?>"><?php  echo $Class[1] ?></option>
<?php
$_SESSION["Class_ID"] = $rs["Class_ID"];
echo $_SESSION["Class_ID"];

	};
}

?>
</body>
</html>