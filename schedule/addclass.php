<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include '../config.php';
$group_id = $_GET['group_id'];
$Subject_ID = $_GET['Subject_ID'];
$Faculty_ID = $_POST["Faculty_ID"];
$Major_ID = $_POST["Major_ID"];
$Class_ID = $_POST["Class_ID"];

$sql = "SELECT * FROM student where Faculty_ID = '$Faculty_ID' AND Major_ID = '$Major_ID' AND Class_ID = '$Class_ID'";
$Query = mysqli_query($connect,$sql) or die($sql);
$count = mysqli_num_rows($Query);
//echo $count;
$result = array();
$result1 = array();
 while($arr = mysqli_fetch_array($Query)){

	array_push($result,$arr);
}
for($i=0;$i<=$count-1;$i++){
	//echo $result[$i]['Student_ID']." ";
$sql1 = "SELECT * FROM student_of_subject where student_id = '".$result[$i]['Student_ID']."' AND group_id = '$group_id' AND subject_id = '$Subject_ID' ";
$Query1 = mysqli_query($connect,$sql1) or die($sql1);
$count1 = mysqli_num_rows($Query1);
 while($arr1 = mysqli_fetch_array($Query1)){
array_push($result1,$arr1);
 	}
}
$count1 = count($result1);
if($count!=count($result1)){
for($s=0;$s<=count($result1)-1;$s++){
for($t=0;$t<=$count-1;$t++){
	if($result[$t]['Student_ID']!=$result1[$s]['student_id']){
$sql2 = "INSERT INTO `student_of_subject`(`group_id`, `subject_id`, `student_id`) VALUES ('$group_id','$Subject_ID','".$result[$t]['Student_ID']."')";
echo $sql2;
$query1 = $connect->query($sql2) or die($sql2);
echo("<script> alert('เพิ่มนักศึกษาเรียบร้อยแล้ว ซ้ำ $count1 คน'); window.location='schedule-student.php?group_id=$group_id&Subject_ID=$Subject_ID';</script>");
}else{}
}
	}
}else{echo("<script> alert('มีนักศึกษาห้อง $Class_ID อยู่แล้ว'); window.location='schedule-student.php?group_id=$group_id&Subject_ID=$Subject_ID';</script>");}
if($count1==0)
{
	for($i=0;$i<=$count-1;$i++){
	$sql3 = "INSERT INTO `student_of_subject`(`group_id`, `subject_id`, `student_id`) VALUES ('$group_id','$Subject_ID','".$result[$i]['Student_ID']."')";
$query1 = $connect->query($sql3) or die($sql3);
echo("<script> alert('เพิ่มนักศึกษาเรียบร้อยแล้ว ซ้ำ $count1 คน'); window.location='schedule-student.php?group_id=$group_id&Subject_ID=$Subject_ID';</script>");
}
}
?>




</body>
</html>