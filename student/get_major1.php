<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script type="text/javascript">//alert("sdfsd");</script>
<body>
<?php
require_once("../config.php");
if($_POST["Faculty_ID"] == ""){?>
	<option value="" >ทุกสาขา</option>
    <?php 
	}else {

	$query ="SELECT * FROM major WHERE Faculty_ID = '" . $_POST["Faculty_ID"] . "'";
	$results = $connect->query($query);
?>
	<option value="">ทุกสาขา</option>
<?php
	while($rs=$results->fetch_assoc()) {
?>
	<option value="<?php echo $rs["Major_ID"]; ?>"><?php echo $rs["Major_NameTH"]; ?></option>
  <?php
    echo $rs["Major_ID"];

	}
	
}
?>
</body>
</html>