<!DOCTYPE html>
<?php
$sex_id           = $_POST['sex_id'];
$Faculty_NameTH   = $_POST['Faculty_NameTH'];
$Major_NameTH     = $_POST['Major_NameTH'];
$Class_NameTH     = $_POST['Class_NameTH'];
$Select_ID        = $_POST['Select_ID'];
//$class_id         = $_POST['Class_']
require_once  "../config.php";
$page= (isset($_GET['page'])) ? $_GET['page'] : '';
$strSearch= (isset($_GET['strSearch'])) ? $_GET['strSearch'] : '';
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
    <title>ข้อมูลนักศึกษา</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
    <!-- TABLE STYLES-->
        <link href="../assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="../student/ddsearch.js" type="text/javascript"> </script>
  </head>
  <body>
    <div id="wrapper">
    <?php
      $sql="select student.*,sex.*
      from student
      INNER JOIN sex on student.student_sex = sex.sex_id
      where student.Student_ID ='".$Select_ID."' AND sex.sex_id ='".$sex_id."'   ";
      $tem = mysqli_query($connect,$sql);
      $row3=mysqli_fetch_array($tem);
      if($row3['student_sex']==0){
      $titlename = "นาย";
      $titlename1 ="Mr.";
      }else{
      $titlename = "นางสาว";
      $titlename1 = "Ms.";
      }
      if($row3['pic']!=""){
      $images = "../picture_upload/student/".$row3['pic'];
      $new_images = "../picture_upload/student/MyResize/".$row3['pic'];
      $width=200; //*** Fix Width & Heigh (Autu caculate) ***//
      $size=GetimageSize($images);
      $height=round($width*$size[1]/$size[0]);
      $images_orig = ImageCreateFromJPEG($images);
      $photoX = ImagesX($images_orig);
      $photoY = ImagesY($images_orig);
      $images_fin = ImageCreateTrueColor($width, $height);
      ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
      ImageJPEG($images_fin,$new_images);
      ImageDestroy($images_orig);
      ImageDestroy($images_fin);
      }else
      {
      $new_images = "";
      }
      ?>
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
                <a   href="../teacher-home.php"><i class="fa fa-dashboard fa-3x"></i> หน้าแรก</a>
              </li>
              <li>
                <a class="active-menu" href="#"><i class="fa fa-user fa-3x"></i> นักศึกษาประจำชั้น<span class="fa arrow"></span></a>
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
              <a href="#"><i class="fa fa-table fa-3x"></i> วิชาที่สอน<span class="fa arrow"></span></a>
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
                  <a href="../teacher/mysubject.php?group=<?php echo $rs1["group"]; ?>&subject_id=<?php echo $rs1["subject_id"]; ?>">วิชา<?php echo $rs2["Subject_NameTH"]; ?></a>
                </li>
              <?php }
              }?>
            </li>
                </li>
              </ul>
              <li>
                <a   href="../student/chart.html"><i class="fa fa-bar-chart-o fa-3x"></i> Morris Charts</a>
              </li>
              <li  >
                <a  href="../student/table.html"><i class="fa fa-table fa-3x"></i> Table Examples</a>
              </li>
              <li  >
                <a  href="../student/form.html"><i class="fa fa-edit fa-3x"></i> Forms </a>
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
              <div class="table-responsive table-bordered col-lg-5 col-lg-push-3">
                <table class="table" >
                  <tr>  <td colspan="3" align="center"> <a data-toggle='lightbox' href="../picture_upload/student/<?php echo $row3['pic']?>" class='img-thumbnail'  TARGET='_blank' ><?php if($new_images==''){?>
                    <img id='pic' src="../picture_upload/noimg.gif">
                    <?php }else{?>
                    <img  width="200" id='pic' src="<?php echo $new_images ?>" >
                    <?php }?>
                  </a>
                </tr>
                <tr>
                  <thead>
                    <td colspan="3" class="text-center">ข้อมูลนักศึกษา</td>
                  </tr>
                  <tr>
                  </thead>
                  <td ><strong>รหัสนักศึกษา</strong></td>
                  <td><?php echo $row3['Student_ID'] ?></td>
                </tr>
                <tr>
                  <td align="left"><strong>ชื่อนักศึกษา(TH)</strong></td>
                  <td><?php echo $titlename.$row3['Student_NameTH'] ?></td>
                </tr>
                <tr>
                  <td align="left"><strong>ชื่อนักศึกษา(ENG)</strong></td>
                  <td><?php echo $titlename1.$row3['Student_NameENG'] ?></td>
                </tr>
                <tr>
                  <td align="left"><strong>คณะ</strong></td>
                  <td><?php echo $Faculty_NameTH; ?></td>
                </tr>
                <tr>
                  <td align="left"><strong>สาขา</strong></td>
                  <td><?php echo $Major_NameTH; ?></td>
                </tr>
                <tr>
                  <td align="left"><strong>ห้อง</strong></td>
                  <td><?php echo $Class_NameTH; ?></td>
                </tr>
                <tr>
                  <td align="left"><strong>ที่อยู่</strong></td>
                  <td><?php echo $row3['Student_Address'] ?></td>
                </tr>
                <tr>
                  <td align="left"><strong>เบอร์โทรศัพท์</strong></td>
                  <td><?php echo $row3['Student_Telephone'] ?></td>
                </tr>
                <tr>
                  <td align="left"><strong>วันเกิด</strong></td>
                  <td><?php echo $row3['student_birthday'] ?></td>
                </tr>
                <tr>
                  <td align="left"><strong>ปีที่เข้าศึกษา</strong></td>
                  <td><?php echo $row3['Semes_Start'] ?></td>
                </tr>
                <?php
                if($row3['status'] == 0){ ?>
                <tr class="info">
                  <td align="left" ><strong>สถานะ</strong></td>
                  <td>ปกติ</td>
                  <?php
                  }else if($row3['status'] == 1){ ?>
                  <tr class="success">
                    <td align="left" ><strong>สถานะ</strong></td>
                    <td>จบการศึกษา</td>
                    <?php
                    }
                    else{ ?>
                    <tr class="danger">
                      <td align="left" ><strong>สถานะ</strong></td>
                      <td>พ้นสภาพ</td>
                      <?php
                      }
                      ?>
                    </tr>
                  </table>
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
  <!-- DATA TABLE SCRIPTS -->
        <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
        $(document).ready(function () {
        $('#dataTables-example').dataTable();
        });
        </script>
  <!-- CUSTOM SCRIPTS -->
  <script src="../assets/js/custom.js"></script>
</body>
</html>