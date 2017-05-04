<!DOCTYPE html>
<?php
$group_id = $_GET['group_id'];
$subject_id1 = $_GET['subject_id'];
require_once  "../config.php";
session_start();
if($_SESSION['username'] == "")
{
echo "<SCRIPT LANGUAGE='JavaScript'>
alert('กรุณา Login')
location.href = 'index.php';
</script>";
exit();
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>วิชา <?php echo $subject_id1 ?></title>
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
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="../student/ddsearch.js" type="text/javascript"> </script>
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
          <a class="navbar-brand" href="../teacher-home.php">Teacher</a>
        </div>
        <div style="color: white;
          padding: 15px 50px 5px 50px;
          float: right;
          font-size: 16px;"> <?php echo date("d/F/Y"); ?> &nbsp <a href="../logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
          <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
              <li class="text-center">
                <img src="../assets/img/find_user.png" class="user-image img-responsive"/>
              </li>
              <li class="text-center" ><p style="color:#FFF; font-family: 'Kanit', sans-serif; font-size:20px" >
                <?php
                $sql = "SELECT * FROM teacher WHERE `Teacher_ID`=".$_SESSION["username"]."";
                $query = $connect->query($sql);
                while($rs=$query->fetch_assoc()){
                echo $rs["Teacher_Titlename"]." ".$rs["Teacher_NameTH"];
                }
                ?>
              </p>
            </li>
              <li>
                <a  href="../teacher-home.php"><i class="fa fa-dashboard fa-3x"></i> หน้าแรก</a>
              </li>
              <li>
                <a href="#"><i class="fa fa-user fa-3x"></i> นักศึกษาประจำชั้น<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <?php
                  $sql1 = "SELECT * FROM adviser WHERE Teacher_ID='".$_SESSION["username"]."'";
                  $co = 0;
                  $query1 = $connect->query($sql1) or die ("ErroR");
                  while($rs1=$query1->fetch_array()){
                  if($rs1['class_id1'] != "")
                  {
                  $class[$co] = $rs1['class_id1'];
                  $co++;
                  }
                  if($rs1['class_id2'] != "")
                  {
                  $class[$co] = $rs1['class_id2'];
                  $co++;
                  }
                  if($rs1['class_id3'] != "")
                  {
                  $class[$co] = $rs1['class_id3'];
                  }
                  for($i=0;$i<=$co-1;$i++){
                  $sql2 = "SELECT * FROM class WHERE Class_ID LIKE '".$class[$i]."'";
                  $query2 = $connect->query($sql2) or die ($sql2);
                  while($rs2=$query2->fetch_array()){
                  ?>
                  <li>
                    <a href="mystudent.php?class_id=<?php echo $class[$i] ?>">ห้อง<?php echo $rs2["Class_NameTH"]; ?></a>
                  </li>
                  <?php
                  }
                  }
                  }
                  ?>
                </ul>
              </li>
              <li>
              <a class="active-menu" ><i class="fa fa-table fa-3x"></i> วิชาที่สอน<span class="fa arrow"></span></a>
               <ul class="nav nav-second-level">
              <?php
              $sql2 = "SELECT * FROM `teacher_of_subject` WHERE `teacher_id`=".$_SESSION["username"]."";
              $query2 = $connect->query($sql2);
              while($rs1=$query2->fetch_assoc()){
              $subject_id = $rs1["subject_id"];
              $sql3 = "SELECT * FROM `subject` WHERE `Subject_ID`='$subject_id'";
              $query3 = $connect->query($sql3) or die ("error");
              while($rs2=$query3->fetch_assoc()){
              ?>
                <li>
                  <a href="../teacher/mysubject.php?group_id=<?php echo $rs1["group_id"]; ?>&subject_id=<?php echo $rs1["subject_id"]; ?>">วิชา<?php echo $rs2["Subject_NameTH"]; ?></a>
                </li>
              <?php }
              }?>
            </li>
              </ul>
          </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
          <div id="page-inner">
            <div class="row">
              <div class="col-lg-8">
                <h2></h2>
              </div>
            </div>
            <div class="row"> <div></div></div>
            <div class="col-sm-12 col-lg-10 ">
              <div class="panel panel-primary">
                <div class="panel-heading">
                <?php
                $sql = "SELECT * FROM subject WHERE Subject_ID= '$subject_id1'";
                $query = $connect->query($sql);
                while($row=$query->fetch_assoc()){
                  ?>
                  <h3>วิชา <?php echo $row['Subject_NameTH']  ?> กลุ่ม <?php echo $group_id; ?></h3>
                  <?php
                }
                  ?>
                </div>
                <div class="panel-body">
                  <div  class="row">
                  <div class="col-lg-2 col-sm-3">
                  <a  href="mysubject-studentlist.php?group_id=<?php echo $group_id; ?>&subject_id=<?php echo $subject_id; ?>" class="btn btn-default btn-lg">รายชื่อนักศึกษา</a>
                  <div class="row"> </div>
                  <a  href="mysubject-checkhistory.php?group_id=<?php echo $group_id; ?>&subject_id=<?php echo $subject_id; ?>" class="btn btn-default btn-lg">ประวัติการบันทึกการเข้าชั้นเรียน</a>
                  </div>
                  </div>
                  </div>
                  <div class="row"> </div>
            <div class="panel-footer">
            </div>
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
</body>
</html>