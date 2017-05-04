<!DOCTYPE html>
<?php
$Subject_ID= (isset($_GET['Subject_ID'])) ? $_GET['Subject_ID'] : '';
$Teacher_ID= (isset($_GET['Teacher_ID'])) ? $_GET['Teacher_ID'] : '';
$group_id =  (isset($_GET['group_id'])) ? $_GET['group_id'] : '';
session_start();
if($_SESSION["Subject_ID"] ==""&&$_SESSION["Teacher_ID"] == ""&&$_SESSION["group_id"] == "")
{
$_SESSION["Subject_ID"] = $_GET['Subject_ID'];
$_SESSION["Teacher_ID"] = $_GET['Teacher_ID'];
$_SESSION["group_id"] = $_GET['group_id'];
}
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
    <title>เพิ่มข้อมูลวิชา</title>
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
    <?php include "../config.php";?>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script scr="js/dropdown.js" type="text/javascript" ></script>
    <script language="javascript">
    function ThaiOnly(input) {
    var regex = /[^ก-๙1-9 ]/gi;
    input.value = input.value.replace(regex, "");
    }
    function englishOnly(input) {
    var regex = /[^a-zA-Z1-9 ]/gi;
    input.value = input.value.replace(regex, "");
    }
    
    
    function CheckNum(){
    if (event.keyCode < 48 || event.keyCode > 57){
    event.returnValue = false;
    }
    }
    </script>
    
    <script language="javascript">
    function ClearForm(){
    document.getElementById("form1").reset();
    }
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
          font-size: 16px;"> <?php echo $_SESSION["date"] ?> &nbsp <a href="../logout-admin.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
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
                <h2>Subject Data                    </h2>
              </div>
            </div>
            <div class="row"> <div></div></div>
            <div class="col-lg-12">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3>เพิ่มข้อมูลวิชา</h3>
                </div>
                <div class="panel-body" align="center">
                  <div class='form-horizontal' >
                    <form action="edit.php?Subject_ID=<?php echo $Subject_ID ?>&Teacher_ID=<?php echo $Teacher_ID ?>&group_id=<?php echo $group_id ?>" method="POST">
                      <div class='form-group'>
                        <label class='col-sm-3 control-label'>กลุ่ม</label>
                        <div class='col-sm-3' align='left'>
                          <select name="group_id1" class="form-control" id="Credit">
                            <option value="1"<?php if($group_id==1){ echo 'selected'; }?>>1</option>
                            <option value="2"<?php if($group_id==2){ echo 'selected'; }?>>2</option>
                            <option value="3"<?php if($group_id==3){ echo 'selected'; }?>>3</option>
                            <option value="4"<?php if($group_id==4){ echo 'selected'; }?>>4</option>
                            <option value="5"<?php if($group_id==5){ echo 'selected'; }?>>5</option>
                            <option value="6"<?php if($group_id==6){ echo 'selected'; }?>>6</option>
                            <option value="7"<?php if($group_id==7){ echo 'selected'; }?>>7</option>
                            <option value="8"<?php if($group_id==8){ echo 'selected'; }?>>8</option>
                            <option value="9"<?php if($group_id==9){ echo 'selected'; }?>>9</option>
                          </select>
                        </div>
                      </div>
                      <div class='form-group'>
                        <div class='col-sm-8 col-lg-3' align='left'>
                          <input type="hidden" maxlength="13" class="form-control" name="Subject_ID1"  onKeyUp="englishOnly(this)" value="<?php echo $Subject_ID ?>" required onKeyPress="CheckNum()" readonly/>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='col-sm-4 col-lg-3 control-label'>ชื่อวิชา(TH)</label>
                        <div class='col-sm-8 col-lg-3' align='left'>
                          <?php
                          $sql1 = "SELECT * FROM subject WHERE Subject_ID = '$Subject_ID'";
                          $Query1 = mysqli_query($connect,$sql1);
                          while($arr1 = mysqli_fetch_array($Query1)){
                          ?>
                          <input type="text" name="Subject_NameTH" class="form-control" id="Subject_NameTH" onKeyUp="ThaiOnly(this)" value="<?php echo $arr1['Subject_NameTH'] ?>" required readonly/>
                          <?php
                          }
                          ?>
                        </div>
                        <div class="col-lg-1">
                        <a href="schedule-edit-subject.php?Subject_ID=<?php echo $Subject_ID ?>&Teacher_ID=<?php echo $Teacher_ID ?>&group_id=<?php echo $group_id ?>" class="btn btn-primary">เลือกวิชา</a>
                        </div>
                      </div>
                      <div class='form-group'>
                        <div class='col-sm-8 col-lg-3' align='left'>
                          <input type="hidden" maxlength="13" class="form-control" name="Teacher_ID1"  onKeyPress="CheckNum()" value="<?php echo $Teacher_ID ?>" required readonly/>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='col-sm-4 col-lg-3 control-label'>ชื่ออาจารย์(TH) <?php echo $_SESSION["Subject_ID"]." ".$_SESSION["Teacher_ID"]." ".$_SESSION["group_id"] ?></label>
                        <div class='col-sm-8 col-lg-3' align='left'>
                          <?php
                          $sql2 = "SELECT * FROM teacher WHERE Teacher_ID = '$Teacher_ID'";
                          $Query2 = mysqli_query($connect,$sql2);
                          while($arr2 = mysqli_fetch_array($Query2)){
                          ?>
                          <input type="text" name="Teacher_NameTH" class="form-control" id="Teacher_NameTH" onKeyUp="ThaiOnly(this)" value="<?php echo $arr2['Teacher_NameTH'] ?>" required readonly/>
                          <?php
                          }
                          ?>
                        </div>
                        <div class="col-lg-1">
                        <a href="schedule-edit-teacher.php?Subject_ID=<?php echo $Subject_ID ?>&Teacher_ID=<?php echo $Teacher_ID ?>&group_id=<?php echo $group_id ?>" class="btn btn-primary">เลือกอาจารย์</a>
                        </div>
                      </div>
                    </div>
                    <div class="panel-footer">
                      <input class="btn btn-success btn-lg" type="submit" name="btnsave" value="บันทึก" > &nbsp;
                    </div>
                  </form>
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
      <script src="../js/dropdown.js"></script>
    </body>
  </html>