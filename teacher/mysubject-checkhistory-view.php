<!DOCTYPE html>
<?php
$group_id = $_GET['group_id'];
$subject_id = $_GET['subject_id'];
$date = $_GET['date1'];
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
    <title>วิชา <?php echo $subject_id ?></title>
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
    <!-- TIME -->
    <script type="text/javascript" src="../js/date_time.js"></script>
    <style>
	input:checked {
    background: #dddddd;
}
</style>
    <?php date_default_timezone_set('Asia/Bangkok');?>
    <?
                
                
                ?>

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
                  <a href="../teacher/mysubject.php?group_id=<?php echo $group_id ?>&subject_id=<?php echo $subject_id; ?>">วิชา<?php echo $rs2["Subject_NameTH"]; ?></a>
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
            <div class="col-sm-12 col-lg-12 ">
                  <div  class="row">
                  <?php
                  $year = date("Y")+543;
                $today = date ("d/m/$year");  ?>
                 <div class="col-lg-1 col-lg-push-11"> <span id="date_time"></span></div>
             <script type="text/javascript">window.onload = date_time('date_time');</script>
                  <div class="table-responsive">
                   <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                  <td align='center'><strong>เลขที่</strong></td>
                    <td align='center'><strong>ชื่อนักศึกษา </strong></td>
                    <td width="8%" align='center'><strong>เรียน</strong></td>.
                    <td width="8%" align='center'><strong>สาย</strong></td>
                    <td width="8%" align='center'><strong>ขาด</strong></td>
                    <td width="8%" align='center'><strong>ลา</strong></td>
                    <td width="8%" align='center'><strong>หมายเหตุ</strong></td>
                  </tr>
                </thead>
                <tbody>
                  <?php
$sql ="SELECT studentlist.*,student.Student_NameTH 
FROM studentlist
INNER JOIN student ON studentlist.student_id = student.Student_ID
WHERE group_id = '$group_id' AND subject_id = '$subject_id' AND date = '$date'";
                  $Query= mysqli_query($connect,$sql) or die ($sql);
                  while($arr = mysqli_fetch_array($Query)){
                  ?>
                  <tr valign='top'>
                    <td align='center'><?php echo $arr['Student_NameTH']; ?></td>   
                    <input type="hidden" name="student_id[]" value="<?php echo $arr['Student_ID']; ?>">
              <td align="center"><input  type="radio" name="check[<?php echo $no ?>]" <?php if($arr['checks']=='0') echo 'checked';?> value="0" style="background:none" disabled></td>
              <td align="center"><input  type="radio" name="check[<?php echo $no ?>]" <?php if($arr['checks']=='1') echo 'checked';?> value="1" disabled></td>
              <td align="center"><input  type="radio" name="check[<?php echo $no ?>]" <?php if($arr['checks']=='2') echo 'checked';?> value="2" disabled></td>
              <td align="center"><input  type="radio" name="check[<?php echo $no ?>]" <?php if($arr['checks']=='3') echo 'checked';?> value="3" disabled></td>
              <td align="center"> <input type="text" class="form-control" name="comment[<?php echo $no ?>]" value="<?php echo $arr['comment'] ?>" readonly> </td>
                  </tr>
                  <?php
                  }
                  ?>
                  </tr>
                </tbody>
                </table>
                <div class="panel-footer" align="center">
                 <a  href="mysubject-checkhistory.php?group_id=<?php echo $group_id; ?>&subject_id=<?php echo $subject_id; ?>" class="btn btn-danger btn-lg">ย้อนกลับ</a>
              </div>

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