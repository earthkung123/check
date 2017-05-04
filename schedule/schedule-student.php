<!DOCTYPE html>
<?php
$group_id = $_GET['group_id'];
$Subject_ID = $_GET['Subject_ID'];
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
                        </div>
                        <div class="row"> <div></div></div>
                        <div class="col-sm-push-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                 <?php
                $sql = "SELECT * FROM subject WHERE Subject_ID= '$Subject_ID'";
                $query = $connect->query($sql);
                while($row=$query->fetch_assoc()){
                  ?>
          <h3>ข้อมูลนักศึกษาวิชา <?php echo $row['Subject_NameTH'] ?> กลุ่ม <?php echo $group_id ?></h3>
                                    <?php 
                                }
                                     ?>
                                </div>
                                <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTables-example">
                    <thead>
                        <tr>
                        <td align='center'><strong>เลขที่ </strong></td>
                            <td align='center'><strong>รหัสนักศึกษา </strong></td>
                            <td align='center'><strong>ชื่อนักศึกษา </strong></td>
                            <td align='center'><strong>คณะ</strong></td>
                            <td align='center'><strong>สาขา </strong></td>
                            <td align='center'><strong>ห้อง</strong></td>
                            <td align='center'><strong>สถานะ </strong></td>
                            <td width="8%"></td>
                            <td width="8%"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT student.*,student_of_subject.status as sstatus,faculty.Faculty_NameTH,major.Major_NameTH,class.Class_NameTH
FROM student
INNER JOIN faculty ON student.Faculty_ID = faculty.Faculty_ID
INNER JOIN major ON student.Major_ID = major.Major_ID
INNER JOIN class ON student.Class_ID = class.Class_ID
INNER JOIN student_of_subject ON student.Student_ID = student_of_subject.student_id
WHERE student_of_subject.group_id = '$group_id' AND student_of_subject.subject_id = '$Subject_ID'";
                        $Query= mysqli_query($connect,$sql);
                         $i = 1;
                        while($arr = mysqli_fetch_array($Query)){
                        $autoid = $arr['Student_ID'];
                        if($arr['student_sex']==0)$titlename = "นาย";
                        else $titlename = "นางสาว";
                        if($arr['sstatus'] == 0)$status = "ปกติ";
                        else if($arr['sstatus'] == 1) $status = "ถอน";
                        $classname = explode(" ",$arr['Class_NameTH']);
                        ?>
                        <tr valign='top'>
                        <td align='center'><?php echo $i; $i++; ?></td>
                            <td align='center'><?php echo $arr['Student_ID'] ?></td>
                        <td align='center'><?php echo $titlename." ".$arr['Student_NameTH'] ?></td>
                            <td align='center'><?php echo $arr['Faculty_NameTH'] ?></td>
                            <td align='center'><?php echo $arr['Major_NameTH'] ?></td>
                            <td align='center'><?php echo $classname[1] ?></td>
                            <td align='center'><?php echo $status ?></td>
                          <?php  if($arr['sstatus'] ==0){
                          ?>

<td align="center"><form name="drop" method="post" action="drop.php?group_id=<?php echo $group_id ?>&Subject_ID=<?php echo $Subject_ID ?>&status=1">
    <input type="hidden" name="Student_ID" value="<?php echo $arr['Student_ID'] ?>"/>
    <input type="submit"  value="ถอน" class="btn btn-danger btn-mi"  onclick="return confirm('คุณต้องการที่จะถอนรายวิชา <?php echo $titlename." ".$arr['Student_NameTH'] ?> หรือไม่ ?')"/>
</form></td>
<?php 
}else{
    ?><td align="center"><form name="redrop" method="post" action="drop.php?group_id=<?php echo $group_id ?>&Subject_ID=<?php echo $Subject_ID ?>&status=0">
    <input type="hidden" name="Student_ID" value="<?php echo $arr['Student_ID'] ?>"/>
    <input type="submit"  value="ปกติ" class="btn btn-success btn-mi"  onclick="return confirm('คุณต้องการที่จะยกเลิกการถอนรายวิชา <?php echo $titlename." ".$arr['Student_NameTH'] ?> หรือไม่ ?')"/>
</form></td>
<?php } ?>
<td align="center"><form name="deleat" method="post" action="deletestudent.php?group_id=<?php echo $group_id ?>&Subject_ID=<?php echo $Subject_ID ?>">
    <input type="hidden" name="Student_ID" value="<?php echo $arr['Student_ID'] ?>"/>
    <input type="submit"  value="ลบ" class="btn btn-danger btn-mi"  onclick="return confirm('คุณต้องการที่จะลบข้อมูล <?php echo $titlename." ".$arr['Student_NameTH'] ?> หรือไม่ ?')"/>
</form></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        <div class="panel-footer" align="center">
    <a href="schedule-student-addone.php?group_id=<?php echo $group_id ?>&Subject_ID=<?php echo $Subject_ID ?>" class="btn btn-primary btn-lg">เพิ่มนักศึกษารายบุคคล</a>
     <!-- <a  href="schedule-student-addclass.php?group_id=<?php echo $group_id ?>&Subject_ID=<?php echo $Subject_ID ?>"  class="btn btn-info btn-lg">เพิ่มนักศึกษารายห้อง</a> -->
    <a href="schedule.php" class="btn btn-warning btn-lg">ย้อนกลับ</a>
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