<!DOCTYPE html>
<?php

require_once  "../config.php";
$Subject_ID= (isset($_GET['Subject_ID'])) ? $_GET['Subject_ID'] : '';
$Teacher_ID= (isset($_GET['Teacher_ID'])) ? $_GET['Teacher_ID'] : '';
$group_id =  (isset($_GET['group_id'])) ? $_GET['group_id'] : '';
$page= (isset($_GET['page'])) ? $_GET['page'] : '';
$strSearch= (isset($_GET['strSearch'])) ? $_GET['strSearch'] : '';
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
        <title>ข้อมูลอาจารย์</title>
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
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="ddsearch.js" type="text/javascript"> </script>
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
                            <div class="col-lg-12">
                                <h2>Teacher Data   </h2>
                            </div>
                        </div>
                        <div class="row"> <div></div></div>
                        <div class="col-sm-push-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3>ข้อมูลอาจารย์</h3>
                                </div>
                                <div class="panel-body">
                                    <div class='alert alert-info' role='alert'>
                                        <div class="row">
                                            <?php
                                            if($page==''){
                                            $Search=(isset($_POST['Search'])) ? $_POST['Search'] : '';
                                            $Search2=(isset($_POST['Search2'])) ? $_POST['Search2'] : '';
                                            }else{
                                            $Search=(isset($_GET['Search'])) ? $_GET['Search'] : '';
                                            $Search2=(isset($_GET['Search2'])) ? $_GET['Search2'] : '';
                                            }
                                            ?>
                                            <form name="form1" method="post" action="teacher-view.php?show=OK&strSearch=Y" class='navbar-form navbar-left' role='search'>
                                                <div class='form-group' >
                                                    <select name='Search2' class='form-control'>
                                                        <option value="Teacher_ID" <?php if($Search2=="Teacher_ID"){ echo 'selected'; }?>>Teacher_ID</option>
                                                        <option value="Teacher_NameTH" <?php if($Search2=="Teacher_NameTH"){ echo 'selected'; }?>>Teacher_NameTH</option>
                                                    </select>
                                                    <input name='Search' type='text' class='form-control' style='width:auto'  placeholder='Enter Keyword...'  value='<?php echo $Search?>'  onFocus="this.value ='' ;">
                                                    <select name="Faculty_ID" id="faculty" class="form-control" onChange="getMajor(this.value);clearYears(this.value)">
                                                        <option value="" >ทุกคณะ</option>
                                                        <?php
                                                        $sql = "SELECT * FROM faculty ";
                                                        $query = $connect->query($sql);
                                                        while($rs=$query->fetch_assoc()){
                                                        ?>
                                                        <option value="<?php echo $rs["Faculty_ID"]; ?>"><?php echo $rs["Faculty_NameTH"] ?></option>
                                                        <?php
                                                        } echo $rs["Faculty_ID"];
                                                        ?>
                                                    </select>
                                                    <select name="Major_ID" class="form-control" id="major-list" onChange="getYears(this.value);" >
                                                        <option value="">ทุกสาขา</option>
                                                    </select><select name="sex" class="form-control"  >
                                                    <option value="">ทุกเพศ</option>
                                                    <option value="0">ชาย</option>
                                                    <option value="1">หญิง</option>
                                                </select>
                                                <button type='submit' class='btn btn-default' value='Search'>Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <td align='center'><strong>รหัสอาจารย์ </strong></td>
                                                <td align='center'><strong>ชื่ออาจารย์ </strong></td>
                                                <td align='center'><strong>คณะ</strong></td>
                                                <td align='center'><strong>สาขา </strong></td>
                                                <td width="8%"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if($strSearch=="Y"){
                                            $Faculty_ID = $_POST["Faculty_ID"];
                                            $Major_ID = $_POST["Major_ID"];
                                            $sex = $_POST["sex"];
                                            $sql1 = "SELECT teacher.*,faculty.Faculty_NameTH,major.Major_NameTH
                                            FROM teacher
                                            INNER JOIN faculty ON teacher.Faculty_ID = faculty.Faculty_ID
                                            INNER JOIN major ON teacher.Major_ID = major.Major_ID
                                            Where ".$Search2." LIKE '%".$Search."%' AND faculty.Faculty_ID LIKE '%".$Faculty_ID."%' AND major.Major_ID LIKE '%".$Major_ID."%'";
                                            $Query = mysqli_query($connect,$sql1);
                                            }else{
                                            $Query= mysqli_query($connect,"SELECT teacher.*,faculty.Faculty_NameTH,major.Major_NameTH
                                            FROM teacher
                                            INNER JOIN faculty ON teacher.Faculty_ID = faculty.Faculty_ID
                                            INNER JOIN major ON teacher.Major_ID = major.Major_ID");
                                            }
                                            while($arr = mysqli_fetch_array($Query)){
                                            ?>
                                            <tr valign='top'>
                                                <td align='center'><?php echo $arr['Teacher_ID'] ?></td>
                                                <td align='center'><?php echo $arr['Teacher_Titlename']." ".$arr['Teacher_NameTH'] ?></td>
                                                <td align='center'><?php echo $arr['Faculty_NameTH'] ?></td>
                                                <td align='center'><?php echo $arr['Major_NameTH'] ?></td>
     <form name="edit" method="post" action="schedule-edit.php?Subject_ID=<?php echo $Subject_ID ?>&Teacher_ID=<?php echo $arr['Teacher_ID'] ?>&group_id=<?php echo $group_id ?>">
                                    <td> <input type="submit" name="edit" value="เลือก" class="btn btn-info" onclick="return confirm('คุณต้องเลือก <?php echo $titlename." ".$arr['Teacher_NameTH'] ?> หรือไม่ ?');"/>
                                                </td>
                                            </form>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
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