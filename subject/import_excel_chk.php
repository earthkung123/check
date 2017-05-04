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
            $Subject_id = $emapData[0];
            $Subject_NameTH = $emapData[1];
            $Subject_NameENG = $emapData[2];
            $Credit = $emapData[3];
            $sql = "INSERT INTO `Subject`(`Subject_ID`,`Subject_NameTH`, `Subject_NameENG`,`Subject_Credit`) 
            VALUES ('$Subject_id','$Subject_NameTH','$Subject_NameENG','$Credit') ";
            $query = $connect->query(iconv('utf-8','utf-8',$sql)) or die("ERROR");
			echo "<SCRIPT LANGUAGE='JavaScript'>
alert('Import Success')
location.href = 'subject-view.php';
</script>";
        }
        fclose($file);
		echo"<body onload=\"window.alert('CSV File has been successfully Imported');\">";
		echo '<meta http-equiv="refresh" content="0; url=subject.php" >';
		exit();	

    }
    else
        echo 'Invalid File:Please Upload CSV File';
?>
