<?php
if ( $_FILES['file']['error'] ) {
die("upload error ");

}

//======Connect DB======================//  
include "../config.php";
//======End Connect DB======================//  

//======Get data from Excel======================//       

echo $filename=$_FILES["file"]["tmp_name"];
if($_FILES["file"]["size"] > 0)
    {
        $file = fopen($filename, "r");
        //$sql_data = "SELECT * FROM prod_list_1 ";
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
				$student_id = $emapData[0];
				$student_sex = $emapData[1];
				$Student_NameTH = $emapData[2];
				$Student_NameENG = $emapData[3];
				$Major_ID = $emapData[5];
				$Class_ID = $emapData[6];
				$Student_Address = $emapData[7];
				$Student_Telephone = $emapData[8];
				$Semes_Start = $emapData[9];
				
$sql = "INSERT INTO `student`(`Student_ID`,`student_sex`,`student_titlename`, `Student_NameTH`, `Student_NameENG`, `Class_ID`, `Faculty_ID`, `Major_ID`, `Student_Address`, `Student_Telephone`, `Semes_Start`) 
VALUES ('$student_id','$student_sex','$student_sex','$Student_NameTH','$Student_NameENG','$Class_ID','$Faculty_ID','$Major_ID','$Student_Address','$Student_Telephone','$Semes_Start') ";
            $query = $connect->query(iconv('utf-8','utf-8',$sql)) or die("ERROR");
			echo "<SCRIPT LANGUAGE='JavaScript'>
alert('Import Success')
location.href = 'student-view.php';
</script>";
        }
        fclose($file);
		echo"<body onload=\"window.alert('CSV File has been successfully Imported');\">";
		echo '<meta http-equiv="refresh" content="0; url=student.php" >';
		exit();	

    }
    else
        echo 'Invalid File:Please Upload CSV File';
?>
