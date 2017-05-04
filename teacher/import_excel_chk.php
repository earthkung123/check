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
            $Teacher_id = $emapData[0];
            $Teacher_sex = $emapData[1];
            $Teacher_Titlename = $emapData[2];
            $Teacher_NameTH = $emapData[3];
            $Teacher_NameENG = $emapData[4];
			$Class_ID = $emapData[5];
            $Faculty_ID = $emapData[6];
            $Major_ID = $emapData[7];
            
             $sql = "INSERT INTO `Teacher`(`Teacher_ID`,`Teacher_sex`,`Teacher_titlename`, `Teacher_NameTH`, `Teacher_NameENG`, `Class_ID`, `Faculty_ID`, `Major_ID`) 
            VALUES ('$Teacher_id','$Teacher_sex','$Teacher_Titlename','$Teacher_NameTH','$Teacher_NameENG','$Class_ID','$Faculty_ID','$Major_ID') ";
            $query = $connect->query(iconv('utf-8','utf-8',$sql)) or die("ERROR");
			echo "<SCRIPT LANGUAGE='JavaScript'>
alert('Import Success')
location.href = 'teacher-view.php';
</script>";
        }
        fclose($file);
		echo"<body onload=\"window.alert('CSV File has been successfully Imported');\">";
		echo '<meta http-equiv="refresh" content="0; url=teacher.php" >';
		exit();	

    }
    else
        echo 'Invalid File:Please Upload CSV File';
?>
