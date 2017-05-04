<!DOCTYPE html>
<?php
require_once  "../config.php";
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
                                <a href="../admin-backend.php"><i class="fa fa-dashboard fa-3x"></i> หน้าแรก</a>
                            </li>
                            </ul>
                    </div>
                </nav>
                <!-- /. NAV SIDE  -->
                <div id="page-wrapper" >
                    <div id="page-inner">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>Student Data                    </h2>
                            </div>
                        </div>
                        <div class="row"> <div></div></div>
                        <div class="col-sm-push-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3>ข้อมูลนักศึกษา</h3>
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
                                        <form name="form1" method="post" action="student-view.php?show=OK&strSearch=Y" class='navbar-form navbar-left' role='search'>
                                            <div class='form-group' >
                                                <select name='Search2' class='form-control'>
                                                    <option value="Student_ID" <?php if($Search2=="Student_ID"){ echo 'selected'; }?>>Student_ID</option>
                                                    <option value="Student_NameTH" <?php if($Search2=="Student_NameTH"){ echo 'selected'; }?>>Student_NameTH</option>
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
                                                </select><select name="Class1" class="form-control"  >
                                                <option value="">ทุกชั้นปี</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </select><select name="Class2" class="form-control"  >
                                        <option value="">ทุกห้อง</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
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
                            <td align='center'><strong>รหัสนักศึกษา </strong></td>
                            <td align='center'><strong>ชื่อนักศึกษา </strong></td>
                            <td align='center'><strong>คณะ</strong></td>
                            <td align='center'><strong>สาขา </strong></td>
                            <td align='center'><strong>ห้อง</strong></td>
                            <td align='center'><strong>วันเกิด </strong></td>
                            <td align='center'><strong>เบอร์โทรศัพท์ </strong></td>
                            <td align='center'><strong>สถานะ </strong></td>
                            <td width="8%"></td>
                            <td width="8%"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($strSearch=="Y"){
                            $Faculty_ID = $_POST["Faculty_ID"];
                            $Major_ID = $_POST["Major_ID"];
                            $Class1 = $_POST["Class1"];
                        if($_POST["Class2"] == "")$Class2 = "";
                            else $Class2 = str_pad($_POST["Class2"],2,"0",STR_PAD_LEFT);
                        $sex = $_POST["sex"];
                            $sql1 = "SELECT student.*,faculty.Faculty_NameTH,major.Major_NameTH,class.Class_NameTH
                        FROM student
                        INNER JOIN faculty ON student.Faculty_ID = faculty.Faculty_ID
                        INNER JOIN major ON student.Major_ID = major.Major_ID
                        INNER JOIN class ON student.Class_ID = class.Class_ID
                        Where ".$Search2." LIKE '%".$Search."%' AND faculty.Faculty_ID LIKE '%".$Faculty_ID."%' AND major.Major_ID LIKE '%".$Major_ID."%'
                        AND class.Class_ID LIKE '%$Major_ID$Class1$Class2%' AND student.student_sex LIKE '%$sex%'";
                        $Query = mysqli_query($connect,$sql1);
                        }else{
                        $Query= mysqli_query($connect,"SELECT student.*,faculty.Faculty_NameTH,major.Major_NameTH,class.Class_NameTH
                        FROM student
                        INNER JOIN faculty ON student.Faculty_ID = faculty.Faculty_ID
                        INNER JOIN major ON student.Major_ID = major.Major_ID
                        INNER JOIN class ON student.Class_ID = class.Class_ID");
                        }
                        while($arr = mysqli_fetch_array($Query)){
                        $autoid = $arr['Student_ID'];
                        if($arr['student_sex']==0)$titlename = "นาย";
                        else $titlename = "นางสาว";
                        if($arr['status'] == 0)$status = "ปกติ";
                        else if($arr['status'] == 1) $status = "จบการศึกษา";
                        else $status = "พ้นสภาพ";
                        $classname = explode(" ",$arr['Class_NameTH']);
                        ?>
                        <tr valign='top'>
                            <td align='center'><?php echo $arr['Student_ID'] ?></td>
                            <td align='center'><?php echo $titlename." ".$arr['Student_NameTH'] ?></td>
                            <td align='center'><?php echo $arr['Faculty_NameTH'] ?></td>
                            <td align='center'><?php echo $arr['Major_NameTH'] ?></td>
                            <td align='center'><?php echo $classname[1] ?></td>
                            <td align='center'><?php echo $arr['student_birthday'] ?></td>
                            <td align='center'><?php echo $arr['Student_Telephone'] ?></td>
                            <td align='center'><?php echo $status ?></td>
                            <form name="edit" method="post" action="student-view-editdata.php">
                        <input type='hidden' name='Select_ID' value="<?php echo $arr['Student_ID']?>">
            <input type='hidden' name='Faculty_NameTH' value="<?php echo $arr['Faculty_NameTH']?>">
            <input type='hidden' name='Faculty_ID' value="<?php echo $arr['Faculty_ID']?>">
            <input type='hidden' name='Major_NameTH' value="<?php echo $arr['Major_NameTH']?>">
        <input type='hidden' name='Major_ID' value="<?php echo $arr['Major_ID']?>">
        <input type='hidden' name='Class_NameTH' value="<?php echo $classname[1] ?>" >
            <input type='hidden' name='Class_ID' value="<?php echo $arr['Class_ID'] ?>" >
                            <td> <input type="submit" name="edit" value="แก้ไขข้อมูล" class="btn btn-info" onclick="return confirm('คุณต้องการที่จะแก้ข้อมูล <?php echo $titlename." ".$arr['Teacher_NameTH'] ?> หรือไม่ ?');"/>
                            </td>
                        </form>
<td><form name="deleat" method="post" action="deletedata.php">
    <input type="hidden" name="Student_ID" value="<?php echo $arr['Student_ID'] ?>"/>
    <input type="submit" value="ลบข้อมูล" class="btn btn-danger btn-mi"  onclick="return confirm('คุณต้องการที่จะลบข้อมูล <?php echo $titlename." ".$arr['Student_NameTH'] ?> หรือไม่ ?')"/>
</form></td>
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