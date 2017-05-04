<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
include '../config.php';
$subject_id = $_GET["subject_id"];
$group_id = $_GET['group_id'];
$date = date("Y-m-d");
$time = date("H:i:s");


foreach($_POST['student_id'] AS $a ) {
               $student_id[] = $a;
          }
  foreach($_POST['check'] AS $b ) {
               $check[] = $b;
			   }
foreach($_POST['comment'] AS $d ) {
               $comment[] = $d;
}
          
foreach($_POST['no'] AS $e ) {
               $no[] = $e;
}
$c = "SELECT * FROM `studentlist` WHERE group_id = '$group_id' AND subject_id = '$subject_id' ";
$query = $connect->query($c) or die($c);
$count = mysqli_num_rows($query);

$count1 = count($student_id);
$count2 = count($check);
//echo $count1;
//echo $count2;
for($i=0;$i<=$count1-1;$i++){
	$count++;
$sql = "INSERT INTO `studentlist`(`studentlist_id`, `group_id`, `subject_id`, `student_id`, `checks`, `date`, `time`, `comment`) VALUES ('$group_id/$subject_id/$count','$group_id','$subject_id','$student_id[$i]','$check[$i]','$date','$time','$comment[$i]')";
echo $sql."<br>";
$query = $connect->query($sql) or die("ข้อมูลซ้ำ");
echo("<script> alert('บันทึกเรียบร้อยแล้ว'); window.location='../teacher-home.php';</script>");
}
?>




</body>
</html>