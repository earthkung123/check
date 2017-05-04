<!DOCTYPE html>
<?php
$Select_ID = $_POST['Select_ID'];
include "../config.php";
session_start();
  if($_SESSION['admin_id'] == "")
  {
echo "<SCRIPT LANGUAGE='JavaScript'>
alert('กรุณา Login')
location.href = '../admin.php';
</script>";
    exit();
  }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>แก้ไขข้อมูลอาจารย์</title>
  <!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
                <script scr="js/dropdown.js" type="text/javascript" ></script>
               <script language="javascript">
          function ThaiOnly(input) {
          var regex = /[^ก-๙]/gi;
          input.value = input.value.replace(regex, "");
          }
          function englishOnly(input) {
          var regex = /[^a-zA-Z]/gi;
          input.value = input.value.replace(regex, "");
          }
          
          
          function CheckNum(){
          if (event.keyCode < 48 || event.keyCode > 57){
          event.returnValue = false;
          }
          }
        </script>
            <script>
    function Class (value) {
    value = value + 1;
    document.getElementById('divInput'+value+'').innerHTML='<select name="task'+value+'" ><div id="divInput'+(value+1)+'"><button type="button" onClick="tikkystoreInput('+value+')">+</button></div>';

    }
    </script>

      </script>

  </head>
        
<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../admin-backend.php">BACK END</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> <?php echo $_SESSION["date"] ?> &nbsp; <a href="../logout-admin.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
        <li class="text-center">
                    <img src="../assets/img/find_user.png" class="user-image img-responsive"/>
          </li>
        
          
                    <li>
                        <a class="active-menu"  href="../admin-backend.php"><i class="fa fa-dashboard fa-3x"></i> หน้าแรก</a>
                    </li>
                     <li>
                        <a  href="../ui.html"><i class="fa fa-desktop fa-3x"></i> UI Elements</a>
                    </li>
                    <li>
                        <a  href="../tab-panel.html"><i class="fa fa-qrcode fa-3x"></i> Tabs & Panels</a>
                    </li>
               <li  >
                        <a   href="../chart.html"><i class="fa fa-bar-chart-o fa-3x"></i> Morris Charts</a>
                    </li> 
                      <li  >
                        <a  href="../table.html"><i class="fa fa-table fa-3x"></i> Table Examples</a>
                    </li>
                    <li  >
                        <a  href="../form.html"><i class="fa fa-edit fa-3x"></i> Forms </a>
                    </li>       
          
                             
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>
                               
                            </li>
                        </ul>
                      </li>  
                  <li  >
                        <a  href="../blank.html"><i class="fa fa-square-o fa-3x"></i> Blank Page</a>
                    </li> 
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Teacher Data                    </h2>
                    </div>
                </div> 
                <div class="row"> <div></div></div>
                
                 <div class="col-lg-10"> 
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>แก้ไขข้อมูลอาจารย์</h3>
                        </div>
                        <div class="panel-body">
<?php
$sql="SELECT adviser.*,teacher.*
FROM adviser
INNER JOIN teacher ON adviser.Teacher_ID LIKE teacher.Teacher_ID
WHERE adviser.Teacher_ID LIKE '".$Select_ID."'  ";
$class_id1 = $_POST['class_id1'];
$class_id2 = $_POST['class_id2'];
$class_id3 = $_POST['class_id3'];
$tem = mysqli_query($connect,$sql);
$row3=mysqli_fetch_array($tem);
$Teacher_ID = explode(" ",$row3['Teacher_ID']);
$Teacher_NameTH = explode(" ",$row3['Teacher_NameTH']);
$Teacher_NameENG = explode(" ",$row3['Teacher_NameENG']);
?>

<form class='form-horizontal' id='frm_teacher' action="editadviser.php" method="post" enctype='multipart/form-data'>
<input type='hidden' name='Teacher_id' value="<?php echo $row3['Teacher_id']?>">
<input type='hidden' name='pic' value="<?php echo $row3['pic']?>" >
<input type='hidden' name='pic1' value="<?php echo $row3['pic']?>" >


<div class='form-group'>
<label class='col-sm-3 control-label'>รหัสอาจารย์</label>
<div class='col-sm-3' align='left'>
<input name='Teacher_id' id='Teacher_id'  type='text' class="form-control" value="<?php echo $row3['Teacher_ID'] ?>" maxlength="13" onKeyPress="CheckNum()" readonly/>
</div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>ชื่ออาจารย์ (TH)</label>
<div class='col-sm-4' align='left'>
<input type="text" name="Teacher_NameTHF" class="form-control" id="Teacher_NameTHF" onKeyUp="ThaiOnly(this)"  data-fv-notempty='true' data-fv-notempty-message='กรุณากรอกชื่ออาจารย์' value="<?php echo $row3['Teacher_Titlename']." ".$Teacher_NameTH[0]." ".$Teacher_NameTH[1] ?>" readonly/>
</div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>ชื่ออาจารย์ (Eng)</label>
<div class='col-sm-4' align='left'>
<input type="text" name="Teacher_NameTHF" class="form-control" id="Teacher_NameTHF" onKeyUp="ThaiOnly(this)"  data-fv-notempty='true' data-fv-notempty-message='กรุณากรอกชื่ออาจารย์' value="<?php echo $Teacher_NameENG[0]." ".$Teacher_NameENG[1] ?>" readonly/>
</div>
</div>

<?php $d = substr(str_replace("0","/", $row3['class_id1']),3,3); ?>
<div class='form-group'>
<label class='col-sm-3 control-label'>ที่ปรึกษา</label>
<div class='col-sm-3' align='left'>
<select  name="Class_ID1" id="class1" class="form-control">
<option value="">ไม่เลือก</option>
<?php 
$sql1 = "SELECT * FROM class WHERE Major_ID = '".$row3["Major_ID"]."'";
$query1 = $connect->query($sql1);

while($rs1=$query1->fetch_assoc()){
?>
<option value="<?php echo $rs1['Class_ID'];?>"<?php if($class_id1==$rs1['Class_ID']){ echo 'selected'; }?> ><?php echo $rs1['Class_NameTH']; ?></option>
<?php
} echo $rs1["Class_ID"];

?>
</select>
</div>
</div>


<div class='form-group'>
<label class='col-sm-3 control-label'>ที่ปรึกษา</label>
<div class='col-sm-3' align='left'>
<select  name="Class_ID2" id="class2" class="form-control">
<option value="" >ไม่เลือก</option>
<?php 
$sql1 = "SELECT * FROM class WHERE Major_ID = '".$row3["Major_ID"]."'";
$query1 = $connect->query($sql1);

while($rs1=$query1->fetch_assoc()){
?>
<option value="<?php echo $rs1['Class_ID'];?>"<?php if($class_id2==$rs1['Class_ID']){ echo 'selected'; }?>><?php echo $rs1['Class_NameTH']; ?></option>
<?php
}
?>
</select>
</div>
</div>


<div class='form-group'>
<label class='col-sm-3 control-label'>ที่ปรึกษา</label>
<div class='col-sm-3' align='left'>
<select  name="Class_ID3" id="class3" class="form-control">
<option value="" >ไม่เลือก</option>
<?php
$sql1 = "SELECT * FROM class WHERE Major_ID = '".$row3["Major_ID"]."'";
$query1 = $connect->query($sql1);

while($rs1=$query1->fetch_assoc()){
?>
<option value="<?php echo $rs1['Class_ID']; ?>"<?php if($class_id3==$rs1['Class_ID']){ echo 'selected'; }?> ><?php echo $rs1['Class_NameTH']; ?></option>
<?php
}
?>
</select>
</div>
</div>


 <div class="panel-footer">
 <input class="btn btn-success btn-lg" type="submit" name="btnsave" value="แก้ไขข้อมูล" " > &nbsp;
  <button type='button' class='btn btn-danger btn-lg' onClick="document.location.href='teacher-adviser.php?show=OK'">ย้อนกลับ</button></div>

                        </form>
                      </div>
           </div>
     <!-- /. ROW  -->
                  <hr />
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="../assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="../assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
    
    <script src="../js/dropdown.js"></script>
   
</body>
</html>
